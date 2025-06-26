@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <h3 class="mb-4">Invite Admin + Company</h3>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.invite') }}"> {{-- No action added, stays same --}}
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" id="name" class="form-control" placeholder="Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" id="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input name="company_name" id="company_name" class="form-control" placeholder="Company Name" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Invite Admin</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
