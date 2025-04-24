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
                    <li class="breadcrumb-item active fs-6" aria-current="page">Events</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4>Welcome Back, {{ session()->get('first_name') }}!</h4>
            <small>Keep updated and gain experience through different events!</small>
        </div>
    </div>

    <div class="row">
        <!-- Upcoming Events -->
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">Upcoming Event/s</h4>
                    <small>Stay tuned to the upcoming events!</small>
                    <hr class="mb-4">
                    @if($events->isNotEmpty())
                                @foreach($events as $event)
                                            @php
        $event_date = \Carbon\Carbon::parse($event->event_date);
        $days_left = now()->diffInDays($event_date, false);
                                            @endphp
                                            <a href="{{ route('event-view-page', $event->event_id) }}" class="text-decoration-none text-black">
                                                <div class="d-flex mb-4">
                                                    <div class="calendar-box text-center">
                                                        <div class="calendar-month">{{ $event_date->format('M') }}</div>
                                                        <div class="calendar-day">{{ $event_date->format('d') }}</div>
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
                                                                Happening today!
                                                            @else
                                                                Event ended {{ abs($days_left) }} day{{ abs($days_left) > 1 ? 's' : '' }} ago
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                @endforeach
                    @else
                        <div class="text-center mt-3 mb-3">
                            <h3>No Event List</h3>
                            <small class="fst-italic">Currently, there are no events to display.</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Image Previews -->
        <div class="col-8">
            <div class="page-content">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Schedule</h6>
                                       <a href="{{ route('event-schedule') }}">
                                        <h6 class="font-extrabold mb-0 fst-italic">Click here</h6>
                                       </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Accounts</h6>
                                        <h6 class="font-extrabold mb-0">183.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div> <br>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Events</h6>
                                        <h6 class="font-extrabold mb-0">112</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div> <br>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Photos</h6>
                                        <h6 class="font-extrabold mb-0">112</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           @foreach($events as $event)
            @php $images = json_decode($event->event_images, true); @endphp
            @if($images)
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>{{ $event->event_title }}</h4>
                        <hr>
                        <div class="row mb-2">
                            <div class="col text-dark">
                                <small class="me-3"><i class="bi bi-geo-alt-fill me-2"></i>{{ $event->event_venue }}</small>
                                <small class="me-3"><i class="bi bi-calendar me-2"></i>{{ $event->event_date }}</small>
                                <small class="me-3"><i class="bi bi-clock me-2"></i>{{ $event->event_time_start }}</small>
                                <small class="fw-bold text-primary"><i class="bi bi-people me-2"></i>{{ $event->event_audience}} are invited!</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $event->event_id }}">
                                            <img class="w-100" src="{{ asset($images[0]) }}" alt="Event Photo">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Modal with Carousel -->
                <div class="modal fade" id="galleryModal{{ $event->event_id }}" tabindex="-1" role="dialog"
                    aria-labelledby="galleryModalLabel{{ $event->event_id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $event->event_title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="carousel{{ $event->event_id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($images as $index => $img)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ asset($img) }}" class="d-block w-100" alt="Event Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $event->event_id }}"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $event->event_id }}"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <a id="downloadBtn{{ $event->event_id }}" class="btn btn-success" download>
                                    <i class="bi bi-download me-2"></i>Download Image
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @pushOnce('scripts')
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            @foreach($events as $e)
                                const carousel{{ $e->event_id }} = document.querySelector('#carousel{{ $e->event_id }}');
                                const downloadBtn{{ $e->event_id }} = document.querySelector('#downloadBtn{{ $e->event_id }}');

                                function updateDownloadLink{{ $e->event_id }}() {
                                    const activeImg = carousel{{ $e->event_id }}.querySelector('.carousel-item.active img');
                                    if (activeImg) {
                                        downloadBtn{{ $e->event_id }}.setAttribute('href', activeImg.getAttribute('src'));
                                    }
                                }

                                updateDownloadLink{{ $e->event_id }}();
                                carousel{{ $e->event_id }}.addEventListener('slid.bs.carousel', updateDownloadLink{{ $e->event_id }});
                            @endforeach
                                    });
                    </script>
                @endPushOnce
            @endif
        @endforeach

        </div>
    </div>

@endsection
