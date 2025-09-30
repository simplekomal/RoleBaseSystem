@extends('layout.mainLayout')

@section('mainContent')
<style>
    /* Full-screen setup */
    body, html {
        height: 85%;
        margin: 0;
        background: #eef2f7;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Center the card */
    .full-screen-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 20px;
    }

    /* Card styling */
    .edit-card {
        width: 100%;
        max-width: 500px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 40px 35px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Header */
    .edit-card h4 {
        text-align: center;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    /* Alerts */
    .alert {
        border-radius: 8px;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    /* Form labels and inputs */
    .edit-card label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #495057;
    }

    .edit-card .form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 12px 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .edit-card .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 8px rgba(13, 110, 253, 0.2);
        outline: none;
    }

    /* Buttons */
    .btn-custom {
        border-radius: 8px;
        padding: 12px 25px;
        font-size: 1rem;
        flex: 1;
        min-width: 120px;
        transition: all 0.3s ease;
    }

    .btn-update {
        background: #0d6efd;
        color: #fff;
        border: none;
        margin-right: 10px;
        text-align: center;
    }
    .btn-update:hover {
        background: #0b5ed7;
    }

    .btn-cancel {
        background: #6c757d;
        color: #fff;
        border: none;
        text-decoration: none;
        text-align: center;
    }

    .btn-cancel:hover {
        background: #5c636a;
    }

    /* Button container */
    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .edit-card {
            padding: 25px 20px;
        }
        .button-group {
            flex-direction: column;
        }
        .btn-custom {
            width: 100%;
        }
    }

    input, select {
        margin-bottom: 15px;
        margin-top: 5px;
    }
</style>

<div class="full-screen-container">
    <div class="edit-card">

        {{-- Header --}}
        <h4>Edit User</h4>

        {{-- Success Message --}}
        @if(session('success'))
            <div style="text-align: center;" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('admin.update', $user->id) }}" method="POST" class="d-flex flex-column gap-3">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label for="name" class="form-label">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name"
                    value="{{ old('name', $user->name) }}"
                    class="form-control" 
                    placeholder="Enter full name"
                    required>
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    value="{{ old('email', $user->email) }}"
                    class="form-control" 
                    placeholder="Enter email address"
                    required>
            </div>

            {{-- Role --}}
            <div>
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="form-label">Password (Leave blank to keep current)</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    class="form-control" 
                    placeholder="Enter new password">
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation"
                    class="form-control" 
                    placeholder="Confirm new password">
            </div>

            {{-- Buttons --}}
            <div class="button-group">
                <button type="submit" class="btn btn-custom btn-update">
                    Update
                </button>
                <a href="/admin/users" class="btn btn-custom btn-cancel">
                    Cancel
                </a>
            </div>
        </form>

    </div>
</div>
@endsection
