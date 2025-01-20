{{-- resources/views/users/show.blade.php --}}
@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>User Details</h6>
                </div>
                <div class="card-body">
                    <h5>Name: {{ $user->name }}</h5>
                    <p>Email: {{ $user->email }}</p>
                    <p>Role: {{ $user->role }}</p>

                    @if($user->photo)
                        <div>
                            <img src="{{ asset('storage/'.$user->photo) }}" alt="User Photo" class="avatar avatar-sm">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
