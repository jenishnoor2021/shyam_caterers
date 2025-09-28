<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class RefreshFacebookToken extends Command
{
  protected $signature = 'facebook:refresh-token';
  protected $description = 'Refresh long-lived Facebook tokens';

  public function handle()
  {
    $company = Company::whereNotNull('fb_access_token')->first();

    if ($company && $company->fb_token_expires_at) {

      // Only refresh if expires in ≤10 days
      if ($company->fb_token_expires_at->diffInDays(now()) <= 10) {

        $response = Http::get('https://graph.facebook.com/v23.0/oauth/access_token', [
          'grant_type' => 'fb_exchange_token',
          'client_id' => config('services.instagram.client_id'),
          'client_secret' => config('services.instagram.client_secret'),
          'fb_exchange_token' => $company->fb_access_token,
        ]);

        Log::info('FB Token Refresh Response:', $response->json());

        if ($response->successful()) {
          $data = $response->json();

          $company->fb_access_token = $data['access_token'];

          if (isset($data['expires_in'])) {
            $company->fb_token_expires_at = now()->addSeconds($data['expires_in']);
          }

          $company->save();

          $this->info("✅ Token refreshed for company ID: {$company->id}");
        } else {
          $this->error("❌ Failed to refresh token for company ID: {$company->id}");
          Log::info('else Failed to refresh token for company ID');
        }
      } else {
        $this->info("ℹ️ Token still valid for company ID: {$company->id}");
        Log::info('else Only refresh if expires in ≤10 days');
      }
    } else {
      $this->info("ℹ️ No company with fb_access_token found");
      Log::info('FB Token Refresh else condition last:');
    }
  }
}
