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
            padding: 170px 30px 120px;
        }

        .header-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 160px;
            object-fit: contain;
        }

        .footer-img {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            object-fit: contain;
        }

        /* .event-content .section-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        } */

        .section-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: flex-start;
            margin: 0 !important;
            /* width: 50%;
            float: left; */
        }

        .section-grid:nth-child(1),
        .section-grid:nth-child(2) {
            top: 50px;
        }

        /* .section-grid:nth-child(3) {
            clear: both;
        } */

        .menu-section {
            padding: 10px;
            width: 90% !important;
            margin-bottom: 15px;
            box-sizing: border-box;
            min-height: 250px;
            position: relative;
            margin: 0 !important;
        }

        .menu-section h4 {
            margin-top: 0;
            font-size: 14px;
            text-transform: uppercase;
        }

        .menu-section ul {
            margin-top: 10px;
            padding-left: 20px;
            list-style-type: disc;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <!-- ✅ Cover Page (First Page) -->
    <div class="page">
        <img src="{{ public_path('images/cover.jpg') }}" class="fullpage-image">
        <!-- <div class="overlay-text">
            <h1 style="font-size: 40px;">શુભ પ્રસંગ મેનુ</h1>
            <p style="font-size: 20px;">{{ $booking->customer_name }} - {{ $booking->event_date }}</p>
        </div> -->
    </div>

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

            <div style="width: 100%;margin: 0 !important;">
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


                @php
                $selectedItems = json_decode($menu->items, true);
                $half = ceil(count($selectedItems) / 2);
                @endphp
                <!-- Grid of Menu Sections -->
                <table class="section-grid" style="display:inline-block;width: 49%;position:relative;">
                    <div class="menu-section" style="width:100%;">
                        <table style="background: #e9ecef; padding: 5px; font-size: 12px; margin-bottom: 5px;width:100%;">
                            <tr style="width: 100%;">
                                <td><strong style="width: 50%;">Date:</strong> {{ $eventDate }}</td>
                                <td><strong style="width: 50%;">Time:</strong> {{ $eventTime }}</td>
                            </tr>
                            <tr style="width: 100%;">
                                <td>
                                    <h4 style="margin: 0;padding:0;width: 70%;">{{ strtoupper($name) }}</h4>
                                </td>
                                <td><strong style="width: 30%;">Persons:</strong> {{ $eventPersons }}</td>
                            </tr>
                        </table>
                        @php
                        $rawItems = json_decode($menu->items, true);
                        $itemsGrouped = [];

                        if (is_array($rawItems)) {
                        foreach ($selectedItems as $entry){
                        $itemId = $entry['item_id'] ?? null;

                        if (!$itemId) continue;

                        $item = $items->get((int) $itemId); // Use collection method

                        if (!$item || !$item->Categories) continue;

                        $categoryName = $item->Categories->category_name ?? 'Unknown';

                        $itemsGrouped[$categoryName][] = $item->item_name;
                        }
                        }
                        $sr_no = 1;
                        @endphp
                        <table width="100%" style="border-collapse: collapse; font-size: 12px; margin-top: 10px;">
                            @foreach ($itemsGrouped as $category => $itemList)
                            <tr>
                                <td style="width: 25%; vertical-align: top; font-weight: bold; padding: 5px;">
                                    {{ strtoupper($category) }}
                                </td>
                                <td style="padding: 5px;">
                                    <ul style="margin: 0; padding-left: 20px;list-style: none;">
                                        @foreach ($itemList as $itemName)
                                        <li>({{ $sr_no }})&nbsp;{{ $itemName }}</li>
                                        @php
                                        $sr_no++;
                                        @endphp
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                </table>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ✅ Footer Page (Last Page) -->
    <div class="">
        <img src="{{ public_path('images/footer.jpg') }}" class="fullpage-image">
    </div>

</body>

</html>