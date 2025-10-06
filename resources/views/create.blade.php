@extends('layout.mainLayout')

@section('mainContent')
<style>
    /* This cammand is used for the testing add-profile-page  */
    body, html {
        height: 85%;
        margin: 0;
        background: #eef2f7;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .full-screen-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 20px;
    }

    .add-card {
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

    .add-card h4 {
        text-align: center;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .alert {
        border-radius: 8px;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .add-card label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #495057;
    }

    .add-card .form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 12px 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 5px;
        margin-bottom: 15px;
    }

    .add-card .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 8px rgba(13, 110, 253, 0.2);
        outline: none;
    }

    .btn-custom {
        border-radius: 8px;
        padding: 12px 25px;
        font-size: 1rem;
        flex: 1;
        min-width: 120px;
        transition: all 0.3s ease;
    }

    .btn-add {
        background: #0d6efd;
        color: #fff;
        border: none;
        text-align: center;
    }

    .btn-add:hover {
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

    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    @media (max-width: 576px) {
        .add-card {
            padding: 25px 20px;
        }
        .button-group {
            flex-direction: column;
        }
        .btn-custom {
            width: 100%;
        }
    }
</style>

<div class="full-screen-container">
    <div class="add-card">

        {{-- Header --}}
        <h4>Add New User</h4>

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
        <form action="{{ route('admin.store') }}" method="POST" class="d-flex flex-column gap-3">
            @csrf

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Enter full name" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email address" required>
            </div>

            <div>
                
                @can('allowRoleAssigne')
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" 
                            {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>


            

                @endcan
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password" required>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-custom btn-add">Add User</button>
                <a href="/admin/users" class="btn btn-custom btn-cancel">Cancel</a>
            </div>
        </form>

    </div>
</div>
@endsection
