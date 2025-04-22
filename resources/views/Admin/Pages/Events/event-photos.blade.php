@extends('admin.components.main-layout')
@section('section')

    <div class="page-title">
        <div class="row">
            <h3>Event Photos</h3>
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb fs-6">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event Photos</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row gallery">
        @if($events->isNotEmpty())
            @foreach($events as $event)
                @php
                    $images = json_decode($event->event_images, true);
                @endphp

                @if($images)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $event->event_id }}">
                                    <img class="w-100" src="{{ asset($images[0]) }}" alt="Event Photo">
                                </a>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="mt-3 mb-0">{{ $event->event_title }}</h4>
                                    <a href="{{ route('event-view-page', $event->event_id) }}"><i
                                            class="bi bi-eye text-end  fs-4 me-2"></i></a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal with Carousel -->
                    <div class="modal fade" id="galleryModal{{ $event->event_id }}" tabindex="-1" role="dialog"
                        aria-labelledby="galleryModalLabel{{ $event->event_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="galleryModalLabel{{ $event->event_id }}">{{ $event->event_title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="carousel{{ $event->event_id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($images as $index => $image)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset($image) }}" class="d-block w-100" alt="Event Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousel{{ $event->event_id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousel{{ $event->event_id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="text-center mt-3 mb-3">
                <h3>No Photos</h3>
                <small class="fst-italic">Currently, there are no events photos to display.</small>
            </div>
        @endif
    </div>

@endsection