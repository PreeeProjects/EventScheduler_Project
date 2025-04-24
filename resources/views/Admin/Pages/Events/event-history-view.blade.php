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
                        <div class="col-xl-6 col-md-12">
                            <div class="d-flex mb-3">
                                <div class="calendar-box text-center">
                                    <div class="calendar-month">
                                        {{ \Carbon\Carbon::parse($events->event_date)->format('M') }}
                                    </div>
                                    <div class="calendar-day">
                                        {{ \Carbon\Carbon::parse($events->event_date)->format('d') }}
                                    </div>
                                </div>
                                <div class="ms-2">
                                    <h2 class="text-primary fw-bold mb-0">{{ $events->event_title }}</h2>
                                    <small class="text-muted fs-6">Organized by {{ $events->event_organizer }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 text-end mt-4 d-flex justify-content-end gap-2">
                            <form action="{{ route('event-history-delete', $events->event_id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this saved event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="bi bi-trash me-2"></i>Delete
                                </button>
                            </form>
                            <div>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalCenter">
                                    <i class="bi bi-upload me-2"></i>Upload Photos
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h3>{{ $events->event_title }}</h3>
                    <hr>
                    <p class="fs-5" style="text-align: justify;">{{ $events->event_description }}</p>
                </div>
            </div>

            @php $images = json_decode($events->event_images, true); @endphp
            @if($images)
                <div class="card">
                    <div class="card-body">
                        <h4>Image / s</h4>
                        <hr>
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $events->event_id }}">
                                        <img class="w-100" src="{{ asset($images[0]) }}" alt="Event Photo">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5><i class="bi bi-calendar me-2"></i>Date & Time</h5>
                    <p class="mb-0">{{ $events->event_date }}</p>
                    <p>{{ $events->event_time_start }} - {{ $events->event_time_end }}</p>

                    <h5 class="mt-3"><i class="bi bi-map me-2"></i>Location</h5>
                    <p>{{ $events->event_venue }}</p>

                    <h5 class="mt-3"><i class="bi bi-person me-2"></i>Audience</h5>
                    <p>{{ $events->event_audience }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Modal with Carousel --}}
    @if($images)
        <div class="modal fade" id="galleryModal{{ $events->event_id }}" tabindex="-1" role="dialog"
            aria-labelledby="galleryModalLabel{{ $events->event_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $events->event_title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="carousel{{ $events->event_id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($images as $index => $img)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($img) }}" class="d-block w-100" alt="Event Image">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carousel{{ $events->event_id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carousel{{ $events->event_id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <a id="downloadBtn{{ $events->event_id }}" class="btn btn-success" download>
                            <i class="bi bi-download me-2"></i>Download Image
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Upload Photos Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Upload Photos/s
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('event-history-upload-images', $events->event_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH') {{-- Since your route uses PATCH method --}}

                    <div class="modal-body">
                        <div>
                            <p class="card-text"> Upload images to share your experience!</p>
                            <input type="file" class="multiple-files-filepond" multiple name="event_history_images[]">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>

                        <button type="submit" class="btn btn-success ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Upload</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @if($images)
                const carousel = document.querySelector('#carousel{{ $events->event_id }}');
                const downloadBtn = document.querySelector('#downloadBtn{{ $events->event_id }}');

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