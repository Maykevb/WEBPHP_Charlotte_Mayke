@extends('layouts.app')

@section('content')
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>
<body>
<div style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%;">
    <h1>{{__('Pick-up aanvragen kalender')}}</h1>
    <div id='calendar'></div>
</div>

<script>
    $(document).ready(function () {

        var SITEURL = "{{ url('/') }}";

        var calendar = $('#calendar').fullCalendar({
            editable: false,
            events: SITEURL + "/fullcalender",
            selectable: false
        });
    });
</script>
</body>
@endsection
