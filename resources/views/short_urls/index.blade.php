@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 mt-6">

         


{{-- Role-based Invite Button in Header --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Dashboard</h3>
    
    @if(auth()->user()->role === 'SuperAdmin')
        <a href="{{ route('invite.admin') }}" class="btn btn-sm btn-primary">
            Invite Admin
        </a>
    @elseif(auth()->user()->role === 'Admin')
        <a href="{{ route('invite.user') }}" class="btn btn-sm btn-success">
            Invite User
        </a>
    @endif
</div>



            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(auth()->user()->role !== 'SuperAdmin')
                <form action="{{ route('short-urls.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="url" name="original_url" class="form-control" placeholder="Enter URL" required>
                        <button class="btn btn-primary" type="submit">Create Short URL</button>
                    </div>
                </form>
            @endif

            @if (auth()->user()->role === 'SuperAdmin')
                {{-- SuperAdmin View --}}
                @foreach ($companies as $company)
                    <h4 class="mt-4 text-primary">{{ $company->name }}</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Original URL</th>
                                <th>Short URL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($company->users as $user)
                                @foreach ($user->shortUrls as $url)
                                    <tr>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $url->original_url }}</td>
                                        <td>
                                            <a href="{{ url('/s/' . $url->short_code) }}" target="_blank">
                                                {{ url('/s/' . $url->short_code) }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr><td colspan="3">No URLs found for this company.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                @endforeach

            @else
                {{-- Admin or Member View --}}
                <h4>Your Short URLs</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Original URL</th>
                            <th>Short URL</th>
                            <th>Created By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($urls as $url)
                            <tr>
                                <td>{{ $url->original_url }}</td>
                                <td>
                                    <a href="{{ url('/s/' . $url->short_code) }}" target="_blank">
                                        {{ url('/s/' . $url->short_code) }}
                                    </a>
                                </td>
                                <td>{{ $url->user->full_name }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No URLs found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            @endif

        </div>
    </div>
</div>
@endsection
