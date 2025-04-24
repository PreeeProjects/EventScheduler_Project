@extends('admin.components.main-layout')
@section('section')

    <div class="page-title">
        <div class="row">
            <h3>Event History</h3>
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fs-6"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fs-6" aria-current="page">Event History</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                @if($events->isNotEmpty())
                    <table class="table table-striped" id="account-request">
                        <thead>
                            <tr>
                                <th class="text-dark fw-bold">Event</th>
                                <th class="text-dark fw-bold">Date</th>
                                <th class="text-dark fw-bold">Organized by</th>
                                <th class="text-dark fw-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td class="text-dark fw-bold">{{ $event->event_title }}</td>
                                    <td class="text-danger">{{ $event->event_date }}</td>
                                    <td class="text-dark">{{ $event->event_organizer }}</td>
                                    <td class="text-dark">
                                        <div class="btn-group dropup me-1 mb-1">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item fw-bold"
                                                    href="{{ route('event-history-view', $event->event_id) }}">
                                                    <i class="bi bi-eye fs-5 me-2"></i>
                                                    View</a>
                                                <hr class="m-0">
                                                <form action="{{ route('event-history-delete', $event->event_id) }}" methood="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger fw-bold">
                                                        <i class="bi bi-trash me-2 fs-5"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center mt-3">
                        <h3>No Requested Account</h3>
                        <p class="fst-italic">No accounts to display</p>
                    </div>
                @endif
            </div>
        </div>

    </section>

    <script>
        new DataTable('#account-request');
    </script>
@endsection