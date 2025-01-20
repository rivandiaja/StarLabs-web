@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : '../assets/img/default-avatar.png' }}" alt="Profile Image" class="w-100 border-radius-lg shadow-sm">
                        <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/user-profile" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                <input class="form-control" type="text" id="user-name" name="name" value="{{ auth()->user()->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <input class="form-control" type="email" id="user-email" name="email" value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-phone" class="form-control-label">{{ __('Phone') }}</label>
                                <input class="form-control" type="tel" id="user-phone" name="phone" value="{{ auth()->user()->phone }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-location" class="form-control-label">{{ __('Location') }}</label>
                                <input class="form-control" type="text" id="user-location" name="location" value="{{ auth()->user()->location }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="about">{{ 'About Me' }}</label>
                        <textarea class="form-control" id="about" rows="3" name="about_me">{{ auth()->user()->about_me }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-password" class="form-control-label">{{ __('Password') }}</label>
                                <input class="form-control" type="password" id="user-password" name="password" placeholder="Leave blank to keep current password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-role" class="form-control-label">{{ __('Role') }}</label>
                                <select class="form-control" id="user-role" name="role">
                                    <option value="Admin" {{ auth()->user()->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Creator" {{ auth()->user()->role == 'Creator' ? 'selected' : '' }}>Creator</option>
                                    <option value="Member" {{ auth()->user()->role == 'Member' ? 'selected' : '' }}>Member</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-photo" class="form-control-label">{{ __('Photo') }}</label>
                        <input class="form-control" type="file" id="user-photo" name="photo">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
