inquiry.blade.php

<h2>Hey, It's me {{ $data->customer_name }}</h2>
<br>

<strong>User details: </strong><br>
<strong>Name: </strong>{{ $data->customer_name }} <br>
<strong>Email: </strong>{{ $data->email }} <br>
<strong>Contact: </strong>{{ $data->phone_no }} <br>
<strong>Address: </strong>{{ $data->address }} <br>
<strong>Venue: </strong>{{ $data->venue }} <br>
<strong>Event Type: </strong>{{ $data->event_type }} <br>
<strong>Event Date: </strong>{{ $data->event_date }} <br>

Thank you