@extends('layout.mainLayout')

@section('mainContent')
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f7f9fc;
    }

    .container {
        max-width: 600px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    h2 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    label {
        font-weight: bold;
        color: #333;
    }

    input[type="text"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        transition: border 0.3s;
    }

    input[type="text"]:focus {
        border-color: #007bff;
        outline: none;
    }

    h4 {
        margin-top: 10px;
        font-size: 20px;
        color: #444;
        border-bottom: 2px solid #eee;
        padding-bottom: 5px;
    }

    .permissions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 10px;
    }

    .permissions label {
        font-weight: normal;
        background: #f5f7fb;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #ddd;
        cursor: pointer;
        transition: 0.3s;
    }

    .permissions label:hover {
        background: #e9f2ff;
        border-color: #007bff;
    }

    button {
        margin-top: 15px;
        padding: 14px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        font-weight: bold;
    }

    button:hover {
        background: #0056b3;
    }

    .error-box {
        background: #ffe4e4;
        color: #b30000;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 15px;
        border: 1px solid #ffcccc;
    }

    .error-box ul {
        margin: 0;
        padding-left: 20px;
    }
</style>

<div class="container">
    <h2>Create New Role</h2>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div>
            <label>Role Name:</label>
            <input type="text" name="name" placeholder="e.g. Admin" required>
        </div>

        <h4>Permissions:</h4>
        <div class="permissions">
            <label><input type="checkbox" name="can_create"> Create</label>
            <label><input type="checkbox" name="can_read"> Read</label>
            <label><input type="checkbox" name="can_update"> Update</label>
            <label><input type="checkbox" name="can_delete"> Delete</label>
            <label><input type="checkbox" name="canShowRoleOptions"> canShowRoleOptions</label>
            <label><input type="checkbox" name="can_approve"> Approve</label>
        </div>

        <button type="submit">✅ Create Role</button>
    </form>
</div>
@endsection
