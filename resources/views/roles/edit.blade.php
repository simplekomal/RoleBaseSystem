@extends('layout.mainLayout')

@section('mainContent')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f7fa;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.08);
    }

    h2 {
        font-size: 28px;
        margin-bottom: 25px;
        color: #333;
        text-align: center;
    }

    label {
        font-weight: 500;
        display: block;
        margin-bottom: 6px;
        margin-top: 15px;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        outline: none;
        transition: 0.3s;
    }

    input[type="text"]:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }

    .permissions label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        cursor: pointer;
    }

    .permissions input[type="checkbox"] {
        margin-right: 8px;
        accent-color: #007bff; /* checkbox color */
    }

    .btn-submit {
        margin-top: 25px;
        padding: 12px 25px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        width: 100%;
    }

    .btn-submit:hover {
        background-color: #218838;
    }

    .error-list {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 6px;
        padding: 12px 15px;
        margin-bottom: 20px;
    }

    .error-list ul {
        margin: 0;
        padding-left: 20px;
    }
</style>

<div class="container">
    <h2>Edit Role</h2>

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Role Name:</label>
        <input type="text" name="name" id="name" value="{{ $role->name }}" required>

        <h4 style="margin-top:25px;">Permissions:</h4>
        <div class="permissions">
            <label><input type="checkbox" name="can_create" {{ $role->can_create ? 'checked' : '' }}> Create</label>
            <label><input type="checkbox" name="can_read" {{ $role->can_read ? 'checked' : '' }}> Read</label>
            <label><input type="checkbox" name="can_update" {{ $role->can_update ? 'checked' : '' }}> Update</label>
            <label><input type="checkbox" name="can_delete" {{ $role->can_delete ? 'checked' : '' }}> Delete</label>
            <label><input type="checkbox" name="canShowRoleOptions" {{ $role->canShowRoleOptions ? 'checked' : '' }}> canShowRoleOptions</label>
            <label><input type="checkbox" name="can_approve" {{ $role->can_approve ? 'checked' : '' }}> Approve</label>
        </div>

        <button type="submit" class="btn-submit">Update Role</button>
    </form>
</div>
@endsection
