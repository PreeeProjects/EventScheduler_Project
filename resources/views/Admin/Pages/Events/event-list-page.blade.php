@extends('Admin.Components.main-layout')
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
            <h3>Event List</h3>
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb fs-6">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event List</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if($events->isNotEmpty())
                <div class="row align-items-start">
                    @foreach($events as $event)
                            @php
                                $event_date = \Carbon\Carbon::parse($event->event_date);
                                $days_left = (int) now()->diffInDays($event_date, false);
                            @endphp
                            <div class="col-4 col-sm-6 col-m-6 col-xl-6 col-xxl-4">
                                <a href="{{ route('event-view-page', $event->event_id) }}" class="text-decoration-none text-dark">
                                    <div class="d-flex mb-3">
                                        <!-- Calendar Icon -->
                                        <div class="calendar-box text-center">
                                            <div class="calendar-month">
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('M') }}
                                            </div>
                                            <div class="calendar-day">
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('d') }}
                                            </div>
                                        </div>

                                        <div class="ms-2">
                                            <h3 class="text-primary fw-bold mb-0">{{ $event->event_title }}</h3>
                                            <small class="text-muted">Organized by {{ $event->event_organizer }}</small>
                                            <div class="text-dark mt-1"><strong>Time:</strong> {{ $event->event_time_start }}</div>
                                            <div class="text-dark"><strong>Venue:</strong> {{ $event->event_venue }}</div>
                                            <div class="text-dark"><strong>{{ $event->event_audience }}</strong> are invited!</div>
                                            <small class="fst-italic mt-2 d-block text-danger fw-bold">
                                                @if ($days_left > 0)
                                                    {{ $days_left }} day{{ $days_left > 1 ? 's' : '' }} left
                                                @elseif ($days_left === 0)
                                                    Happening today !
                                                @else
                                                    Event ended {{ abs($days_left) }} day{{ abs($days_left) > 1 ? 's' : '' }} ago
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    @endforeach
                </div>
            @else
                <div class="text-center mt-3 mb-3">
                    <h3>No Even List</h3>
                    <small class="fst-italic">Currently, there are no events list to display.</small>
                </div>
            @endif
        </div>
    </div>


@endsection