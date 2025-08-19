<?php

use App\Models\Functio;
?>

<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: sans-serif;
    }

    h2 {
      text-align: center;
      text-decoration: underline;
      color: red;
    }

    .section {
      margin-top: 20px;
    }

    .columns {
      display: flex;
      justify-content: space-between;
    }

    .column {
      width: 48%;
    }
  </style>
</head>

<body>
  @foreach($menus as $menu)
  @php
  $function = Functio::find($menu->function_id);
  $name = $function ? $function->function_type : 'Unknown';
  @endphp
  <div class="section">
    <h2>{{ strtoupper($name) }}</h2>
    <div class="columns">
      @php
      $items = json_decode($menu->items, true);
      $half = ceil(count($items) / 2);
      @endphp
      <div class="column">
        @foreach(array_slice($items, 0, $half) as $item)
        <p>{{ $item }}</p>
        @endforeach
      </div>
      <div class="column">
        @foreach(array_slice($items, $half) as $item)
        <p>{{ $item }}</p>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach
</body>

</html>