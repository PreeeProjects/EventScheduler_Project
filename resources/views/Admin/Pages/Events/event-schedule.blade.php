@extends('Admin.Components.main-layout')
@section('section')

    <div class="page-title">
        <div class="row">
            <h3>Schedule an Event</h3>
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fs-6"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fs-6" aria-current="page">Schedule Event</li>
                </ol>
            </nav>
        </div>
    </div>
    <form action="{{ route('event-schedule-validation') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card mb-4">
                    <img src="{{ asset('/assets/compiled/img/events2.png') }}" alt=""
                        style="height: 300px; border-radius: 5px; ">
                </div>
                <hr class="text-dark m-0">
            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5><i class="bi bi-calendar me-2"></i>Event Details</h5>
                        <hr>
                        <label for="first-name-column" class="form-label text-dark fw-bold">Event Title</label>
                        <input type="text" class="form-control" placeholder="Enter Event Title" name="event_title"
                            data-parsley-required="true" required />
                        <div class="row mt-3">
                            <div class="col-6">
                                <label for="first-name-column" class="form-label text-dark fw-bold">Event Venue</label>
                                <input type="text" class="form-control" placeholder="Enter Event Venue" name="event_venue"
                                    data-parsley-required="true" required />
                            </div>
                            <div class="col-6">
                                <label for="first-name-column" class="form-label text-dark fw-bold">Event Audience</label>
                                <input type="text" class="form-control" placeholder="Enter Event Audience"
                                    name="event_audience" data-parsley-required="true" required />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="first-name-column" class="form-label text-dark fw-bold">Date</label>
                                <input type="date" class="form-control" placeholder="Enter Date" name="event_date"
                                    data-parsley-required="true" required />
                            </div>
                            <div class="col-4">
                                <label for="first-name-column" class="form-label text-dark fw-bold">Start Time</label>
                                <input type="time" class="form-control" placeholder="Enter Start Time"
                                    name="event_time_start" data-parsley-required="true" required />
                            </div>
                            <div class="col-4">
                                <label for="first-name-column" class="form-label text-dark fw-bold">End Time</label>
                                <input type="time" class="form-control" placeholder="Enter End Time" name="event_time_end"
                                    data-parsley-required="true" required />
                            </div>
                        </div>
                        <div class="form-group with-title mb-3 mt-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"
                                name="event_description" required></textarea>
                            <label class="text-dark">Description</label>
                        </div>
                        <div>
                            <label class="text-dark fw-bold mt-2">Upload Image/s</label>
                            <p class="card-text"> Upload images to convey message</p>
                            <!-- File uploader with multiple files upload -->
                            <input type="file" class="multiple-files-filepond" multiple multiple name="event_images[]">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5><i class="bi bi-book me-2"></i>Other Details</h5>
                        <hr>
                        <label for="first-name-column" class="form-label text-dark fw-bold">Event Organizer</label>
                        <input type="text" class="form-control" placeholder="Enter Event Title" name="event_organizer"
                            data-parsley-required="true" />

                        <label for="first-name-column" class="form-label text-dark fw-bold mt-3">Event Visitor / s</label>
                        <input type="text" class="form-control" placeholder="Enter Event Title" name="event_visitor"
                            data-parsley-required="true" />
                        <small class="fst-italic">Write N/A if there's no visitor</small>
                        <hr>
                        <h6 class="text-dark fw-bold">List Privacy</h6>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" value="0" id="defaultRadio1" name="privacy" />
                            <label class="form-check-label text-dark fw-bold" for="defaultRadio1">
                                Public:</label> <br>
                            <small>All can see this event schedule</small>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" value="1" id="defaultRadio1" name="privacy" />
                            <label class="form-check-label text-dark fw-bold" for="defaultRadio1">
                                Private:</label> <br>
                            <small>Only the audience you chose can see the event schedule</small>
                        </div>

                        <div class="row">
                            <div class="row g-2">
                                <div class="col-12 col-sm-10 col-md-10 col-xxl-10">
                                    <button type="submit" class="btn btn-primary w-100">
                                        PUBLISH EVENT
                                    </button>
                                </div>
                                <div class="col-12 col-sm-2 col-md-2 col-xxl-2">
                                    <button type="submit" class="btn btn-secondary" name="action" value="save"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Save as draft">
                                        <span class="bi bi-archive"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection