@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit User</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Leave blank to keep current)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Creator" {{ old('role', $user->role) == 'Creator' ? 'selected' : '' }}>Creator</option>
                                <option value="Member" {{ old('role', $user->role) == 'Member' ? 'selected' : '' }}>Member</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            @if($user->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$user->photo) }}" alt="Current Photo" class="avatar avatar-sm">
                                </div>
                            @endif
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>

                        <button type="submit" class="btn bg-gradient-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Tooltip Initialization -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection
