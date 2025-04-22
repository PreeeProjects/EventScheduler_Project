@extends('admin.components.main-layout')
@section('section')

    <style>
        .calendar-box {
            width: 60px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-right: 15px;
            font-family: sans-serif;
        }

        .calendar-month {
            background-color: #f44336;
            color: white;
            font-size: 14px;
            padding: 4px 0;
            font-weight: bold;
        }

        .calendar-day {
            background-color: white;
            color: #6b7280;
            font-size: 32px;
            font-weight: bold;
            padding-top: 6px;
        }
    </style>

    <div class="page-title">
        <div class="row">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fs-6"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fs-6" aria-current="page"></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1>Welcome Back, {{ session()->get('first_name') }}!</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">Upcoming Event/s</h4>
                    <small>Stay tuned to the upcoming events!</small>
                    <hr class="mb-4">
                    @if($events->isNotEmpty())
                                <div class="row align-items-start">
                                    @foreach($events as $event)
                                                    @php
                                                        $event_date = \Carbon\Carbon::parse($event->event_date);
                                                        $days_left = (int) now()->diffInDays($event_date, false); // cast to integer
                                                    @endphp

                                                    <a href="{{ route('event-view-page', $event->event_id) }}" class="text-decoration-none text-black">
                                                        <div class="d-flex mb-4">
                                                            <!-- Calendar Icon -->
                                                            <div class="calendar-box text-center">
                                                                <div class="calendar-month">
                                                                    {{ $event_date->format('M') }}
                                                                </div>
                                                                <div class="calendar-day">
                                                                    {{ $event_date->format('d') }}
                                                                </div>
                                                            </div>

                                                            <div class="ms-2">
                                                                <h3 class="text-primary fw-bold mb-0">{{ $event->event_title }}</h3>
                                                                <small class="text-muted">Organized by {{ $event->event_organizer }}</small>
                                                                <div class="mt-1"><strong>Time:</strong> {{ $event->event_time_start }}</div>
                                                                <div><strong>Venue:</strong> {{ $event->event_venue }}</div>
                                                                <div><strong>{{ $event->event_audience }}</strong> are invited!</div>

                                                                <small class="fst-italic mt-2 d-block text-danger fw-bold">
                                                                    @if ($days_left > 0)
                                                                        {{ $days_left }} day{{ $days_left > 1 ? 's' : '' }} left
                                                                    @elseif ($days_left === 0)
                                                                        Happening today
                                                                    @else
                                                                        Event ended {{ abs($days_left) }} day{{ abs($days_left) > 1 ? 's' : '' }} ago
                                                                    @endif
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </a>
                                    @endforeach
                                </div>
                    @else
                        <div class="text-center mt-3 mb-3">
                            <h3>No Event List</h3>
                            <small class="fst-italic">Currently, there are no events to display.</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <!-- Right side content here -->
                </div>
            </div>
        </div>
    </div>

@endsection
