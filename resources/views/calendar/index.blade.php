@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Calendar</h1>
        
        <!-- Calendar -->
        <div id="calendar"></div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach($events as $event)
                        {
                            title: '{{ $event['title'] }}',
                            start: '{{ $event['start'] }}',
                            end: '{{ $event['end'] }}'
                        },
                    @endforeach
                ]
            });

            calendar.render();
        });
    </script>
@endpush
