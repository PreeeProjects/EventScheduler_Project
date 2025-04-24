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
            <h3>Event Details</h3>
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fs-6"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fs-6" aria-current="page">Event Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <img src="{{ asset('/assets/compiled/img/events2.png') }}" alt=""
                    style="height: 300px; border-radius: 5px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-6 col-md-12">
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
                                    <h2 class="text-primary fw-bold mb-0">{{ $event->event_title }}</h2>
                                    <small class="text-muted fs-6">Organized by {{ $event->event_organizer }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-6 col-md-12 text-end mt-4 d-flex justify-content-end gap-2">

                            {{-- Edit Event --}}
                            <div class="">
                                <a href="{{ route('event-edit-page', $event->event_id) }}"
                                    class="btn btn-outline-secondary">
                                    <i class="bi bi-pen-fill me-1"></i>
                                    Edit Event
                                </a>
                            </div>

                            {{-- Delete Event --}}
                            <form action="{{ route('event-saved-delete', $event->event_id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this saved event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-x-circle me-1"></i> Delete Event
                                </button>
                            </form>

                            {{-- Publish Event --}}
                            <form action="{{ route('publish-event', $event->event_id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-share me-1"></i> Publish Event
                                </button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h3>{{ $event->event_title }}</h3>
                    <hr>
                    <p class="fs-5" style="text-align: justify;">{{ $event->event_description }}</p>
                </div>
            </div>

            @php $images = json_decode($event->event_images, true); @endphp
            @if($images)
                <div class="card">
                    <div class="card-body">
                        <h4>Image / s</h4>
                        <hr>
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $event->event_id }}">
                                        <img class="w-100" src="{{ asset($images[0]) }}" alt="Event Photo">
                                    </a>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <h4 class="mb-0">{{ $event->event_title }}</h4>
                                        <a href="{{ route('event-view-page', $event->event_id) }}">
                                            <i class="bi bi-eye text-end fs-4 me-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>


        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5> <i class="bi bi-calendar me-2"></i>Date & Time</h5>
                    <div class="text-dark">
                        <p class="mb-0">{{ $event->event_date }}</p>
                        <p>{{ $event->event_time_start}} - {{ $event->event_time_end }}</p>
                    </div>

                    <h5><i class="bi bi-map me-2"></i>Location</h5>
                    <div class="text-dark">
                        <p class="mb-0">{{ $event->event_venue }}</p>
                    </div>
                    <h5 class="mt-3">
                        <i class="bi bi-person me-2"></i>Audience
                    </h5>
                    <div class="text-dark">
                        <p class="mb-0">{{ $event->event_audience }}</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4>Event/s you may like</h4>
                    <hr>

                    @if($events->isNotEmpty())
                        <div class="row align-items-start">
                            @foreach($events as $event)
                                <a href="{{ route('event-edit-page', $event->event_id) }}" class="text-decoration-none text-dark">
                                    <div class="d-flex mb-3">
                                        <!-- Calendar Icon -->
                                        <div class="calendar-box text-center">
                                            <div class="calendar-month">
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('M') }}
                                            </div>
                                            <div class="calendar-day">
                                                {{ \Carbon\Carbon::parse($event->_start)->format('d') }}
                                            </div>
                                        </div>

                                        <div class="ms-2">
                                            <h3 class="text-primary fw-bold mb-0">{{ $event->event_title }}</h3>
                                            <small class="text-muted">Organized by {{ $event->event_organizer }}</small>
                                            <div class="text-dark mt-1"><strong>Time:</strong> {{ $event->event_time_start }}
                                            </div>
                                            <div class="text-dark"><strong>Venue:</strong> {{ $event->event_venue }}</div>
                                            <div class="text-dark"><strong>{{ $event->event_audience }}</strong> are invited!
                                            </div>
                                            <small class="text-muted fst-italic mt-2"> posted
                                                {{ $event->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </a>

                            @endforeach
                        </div>
                    @else
                        <div class="text-center mt-5 mb-5">
                            <h3 class="mb-0">NO OTHER EVENT</h3>
                            <small class="fst-italic">Currently, there are no events list to display.</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Image Modal with Carousel --}}
    @if($images)
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a id="downloadBtn{{ $event->event_id }}" class="btn btn-success" download>
                            <i class="bi bi-download me-2"></i>Download Image
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @if($images)
                const carousel = document.querySelector('#carousel{{ $event->event_id }}');
                const downloadBtn = document.querySelector('#downloadBtn{{ $event->event_id }}');

                function updateDownloadLink() {
                    const activeImg = carousel.querySelector('.carousel-item.active img');
                    if (activeImg) {
                        downloadBtn.setAttribute('href', activeImg.getAttribute('src'));
                    }
                }

                updateDownloadLink();
                carousel.addEventListener('slid.bs.carousel', updateDownloadLink);
            @endif
                                                });
    </script>
@endpush
