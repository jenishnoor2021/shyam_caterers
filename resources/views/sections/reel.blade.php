@if (!empty($reels))
<section class="team-section reel-section">
    <div class="left-bot-bg"><img src="{{ asset('front_assets/images/background/bg-1.png') }}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{ asset('front_assets/images/background/bg-6.png') }}" alt="" title="" loading="lazy"></div>
    <div class="auto-container">
        <h2 class="team-heading" style="padding: 20px;">Our Reels</h2>
        <div class="owl-carousel reels-carousel owl-theme">
            @foreach ($reels as $reel)
            @php
            $posterPath = 'defaults/dishe-1.jpg'; // Default poster

            if (!empty($reel->poster) && file_exists(public_path($reel->poster))) {
            $posterPath = $reel->poster; // Use actual poster if file exists
            }
            @endphp
            <div class="item">
                <video src="{{ asset($reel->file) }}" controls autoplay="" muted="" loop="" preload="metadata" poster="{{ asset($posterPath) }}"></video>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif