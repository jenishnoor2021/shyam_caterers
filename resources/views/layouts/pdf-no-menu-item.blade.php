<?php

use App\Models\Functio;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 0px;
        }

        body {
            font-family: sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        ul {
            padding-left: 20px;
        }

        .fullpage-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .page {
            position: relative;
            width: 100%;
            height: 100vh;
            page-break-after: always;
        }

        .overlay-text {
            position: absolute;
            top: 40%;
            width: 100%;
            text-align: center;
            color: white;
            z-index: 1;
        }

        .event-content {
            padding: 150px 30px 100px;
        }

        .header-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 130px;
            object-fit: contain;
        }

        .footer-img {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>

<body>

    <!-- ✅ Cover Page (First Page) -->
    <div class="page">
        <img src="{{ public_path('images/cover.jpg') }}" class="fullpage-image">
        <div class="overlay-text">
            <h1 style="font-size: 40px;">શુભ સંગ મેનુ</h1>
            <p style="font-size: 20px;">{{ $booking->customer_name }} - {{ $booking->event_date }}</p>
        </div>
    </div>

    @foreach($menus as $menu)
    @php
    $function = Functio::find($menu->function_id);
    $name = $function ? $function->function_type : 'Unknown';

    $event = collect($eventDetails)->firstWhere('fun_id', (string) $menu->function_id);

    $eventDateTime = $event['datetime'] ?? null;
    $eventDate = $eventDateTime ? \Carbon\Carbon::parse($eventDateTime)->format('d-m-Y') : 'N/A';
    $eventTime = $eventDateTime ? \Carbon\Carbon::parse($eventDateTime)->format('h:i A') : 'N/A';
    $eventPersons = $event['person'] ?? 'N/A';
    @endphp
    <div class="page">
        <!-- Header Image -->
        <img src="{{ public_path('images/header.png') }}" class="header-img">

        <!-- Footer Image -->
        <img src="{{ public_path('images/footer-strip.png') }}" class="footer-img">

        <div class="event-content">

            <!-- Exact Booking Info Box (with underlines like the image) -->
            <div style="text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 10px;">
                {{ $booking->event_type }}
            </div>
            <div style="border: 2px solid #000; padding: 10px; margin: 15px 0; font-size: 12px;">
                <table width="100%" style="font-size: 12px; border-collapse: collapse;">
                    <tr style="padding: 8px;">
                        <td colspan="2" style="padding: 2px;">
                            <span style="color: #0033CC;"><strong>Customer Name:</strong></span>
                            <span style="display: inline-block; border-bottom: 1px solid #000; width: 76%;">
                                {{ $booking->customer_name }}
                            </span>
                        </td>
                        <td></td>
                    </tr>
                    <tr style="padding: 8px;">
                        <td colspan="2" style="padding: 2px; width: 74%;">
                            <span style="color: #0033CC;"><strong>Address:</strong></span>
                            <span style="display: inline-block; border-bottom: 1px solid #000; width: 85%;">
                                {{ $booking->address }}
                            </span>
                        </td>
                        <td style="padding: 2px;">
                            <span style="color: #0033CC;"><strong>Order No:</strong></span>
                            <span style="display: inline-block; border-bottom: 1px solid #000; width: 70%;">
                                206
                            </span>
                        </td>
                    </tr>
                    <tr style="padding: 8px;">
                        <td style="padding: 2px; width: 32%;">
                            <span style="color: #0033CC;"><strong>Venue:</strong></span>
                            <span style="display: inline-block; border-bottom: 1px solid #000; width: 80%;">
                                {{ $booking->venue }}
                            </span>
                        </td>
                        <td style="padding: 2px; width: 32%;">
                            <span style="color: #0033CC;"><strong>Mobile:</strong></span>
                            <span style="display: inline-block; border-bottom: 1px solid #000; width: 75%;">
                                {{ $booking->phone_no }}
                            </span>
                        </td>
                        <td style="padding: 2px; width: 33%;">
                            <span style="color: #0033CC;"><strong>Booking:</strong></span>
                            <span style="display: inline-block; border-bottom: 1px solid #000; width: 70%;">
                                {{ $booking->event_date }}
                            </span>
                        </td>
                    </tr>
                    <tr style="padding: 8px;">
                        <td colspan="2" style="padding: 4px;">
                            <span style="color: #0033CC;"><strong>Meal Type:</strong></span>
                            <span style="display: inline-block; border-bottom: 1px solid #000; width: 84%;">
                                REGULAR + SWAMINARAYAN MENU
                            </span>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>

            <!-- <div style="border-bottom: 1px solid #000; padding-bottom: 10px; text-align: center;">
                <strong>શુભ સંગ મેનુ - {{ $booking->customer_name }} | [venue] | {{ $booking->event_date }}</strong>
            </div> -->

            <div style="margin-top: 15px;">
                <p><strong>Date:</strong> {{ $eventDate }} &nbsp;</p>
                <p><strong>Time:</strong> {{ $eventTime }} &nbsp;</p>
                <p><strong>Persons:</strong> {{ $eventPersons }} &nbsp;</p>
                <p><strong>Type:</strong> {{ strtoupper($name) }}</p>
            </div>

            @php
            $items = json_decode($menu->items, true);
            $half = ceil(count($items) / 2);
            @endphp

            <ul style="margin-top: 30px;">
                @foreach(array_slice($items, 0, $half) as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach

    <!-- ✅ Footer Page (Last Page) -->
    <div class="">
        <img src="{{ public_path('images/footer.jpg') }}" class="fullpage-image">
    </div>

</body>

</html>