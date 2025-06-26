@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">Invite Admin / Member</h3>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('invite.user') }}"> {{-- 👈 Make sure route exists --}}
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" id="name" class="form-control" placeholder="Enter name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" id="email" class="form-control" placeholder="Enter email" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="Admin">Admin</option>
                                <option value="Member">Member</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Invite User</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
