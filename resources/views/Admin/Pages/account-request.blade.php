@extends('admin.components.main-layout')
@section('section')

    <div class="page-title">
        <div class="row">
            <h3>Account Request for Approval</h3>
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fs-6"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fs-6" aria-current="page">Account Request</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                @if($users->isNotEmpty())
                    <table class="table table-striped" id="account-request">
                        <thead>
                            <tr>
                                <th class="text-dark fw-bold">Name</th>
                                <th class="text-dark fw-bold">Email</th>
                                <th class="text-dark fw-bold">Username</th>
                                <th class="text-dark fw-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-dark fw-bold">{{ $user->full_name }}</td>
                                    <td class="text-dark">{{ $user->email }}</td>
                                    <td class="text-dark">{{ $user->username }}</td>
                                    <td class="text-dark">
                                        <div class="btn-group dropup me-1 mb-1">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item fw-bold" href="#">
                                                    <i class="bi bi-eye fs-5 me-2"></i>
                                                    View</a>
                                                <form action="{{ route('account-approve', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item fw-bold">
                                                        <i class="bi bi-person-x me-2 fs-5"></i> Approve
                                                    </button>
                                                </form>
                                                <hr class="m-0">
                                                <form action="{{ route('account-decline', $user->id) }}" methood="post">
                                                    @csrf
                                                    @method('PATCH')
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
