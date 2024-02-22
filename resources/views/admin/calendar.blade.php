@extends('layouts.layouts')
@section('content')
    

<div class='dashboard-container'>
    <div>
        @include('layouts.sidebar')
    </div>
    <div id='calendar'>

    </div>
</div>


<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($events)
        });
        calendar.render();
    });

</script>