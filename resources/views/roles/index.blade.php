@extends('layout.mainLayout')

@section('mainContent')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f7fa;
    }

    .container {
        max-width: 1100px;
        margin: 40px auto;
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.08);
    }

    h2 {
        font-size: 32px;
        margin-bottom: 25px;
        color: #333;
    }

    a.create-btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 12px 25px;
        background: #28a745;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        transition: 0.3s;
    }

    a.create-btn:hover {
        background: #218838;
    }

    .success {
        padding: 14px 20px;
        margin-bottom: 25px;
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 6px;
        font-weight: 500;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }

    th, td {
        padding: 14px 18px;
        text-align: center;
    }

    th {
        background: #007bff;
        color: #fff;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    tr:nth-child(even) {
        background: #f8f9fa;
    }

    tr:hover {
        background: #e3f2fd;
        transition: 0.3s;
    }

    td {
        font-weight: 500;
    }

    /* Status badges */
    .yes {
        color: #28a745;
        font-weight: bold;
    }

    .no {
        color: #dc3545;
        font-weight: bold;
    }

    /* Action buttons */
    .btn-edit, .btn-delete {
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s;
        font-weight: 500;
        text-decoration: none;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #212529;
        margin-right: 5px;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    form.inline {
        display: inline-block;
        margin: 0;
    }
</style>

<div class="container">
    <h2>All Roles</h2>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('roles.create') }}" class="create-btn">+ Create New Role</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Create</th>
                <th>Read</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Role Btn</th>
                <th>allowRoleAssigne</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td class="{{ $role->can_create ? 'yes' : 'no' }}">{{ $role->can_create ? 'Yes' : 'No' }}</td>
                <td class="{{ $role->can_read ? 'yes' : 'no' }}">{{ $role->can_read ? 'Yes' : 'No' }}</td>
                <td class="{{ $role->can_update ? 'yes' : 'no' }}">{{ $role->can_update ? 'Yes' : 'No' }}</td>
                <td class="{{ $role->can_delete ? 'yes' : 'no' }}">{{ $role->can_delete ? 'Yes' : 'No' }}</td>
                <td class="{{ $role->canShowRoleOptions ? 'yes' : 'no' }}">{{ $role->canShowRoleOptions ? 'Yes' : 'No' }}</td>
                <td class="{{ $role->allowRoleAssigne ? 'yes' : 'no' }}">{{ $role->allowRoleAssigne ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn-edit">✏️ Edit</a>

                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure to delete this role?');">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
