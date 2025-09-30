@extends('layout.mainLayout')

@section('cssLinks')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
@endsection

@section('mainContent')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f0f2f5;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1000px;
        margin: 50px auto;
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }

    h1 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        color: #333;
    }

    .btn-add-user {
        background: #0d6efd;
        color: #fff;
        padding: 8px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-add-user:hover {
        background: #0b5ed7;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: #fff;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background: rgba(99, 132, 255, 0.1);
    }

    .role-user {
        color: #2575fc;
        font-weight: bold;
    }

    .role-admin {
        color: #ff4c4c;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        table, thead, tbody, th, td, tr {
            display: block;
        }

        thead tr {
            display: none;
        }

        tr {
            margin-bottom: 15px;
            background: #f9f9f9;
            border-radius: 8px;
            padding: 10px;
        }

        td {
            padding-left: 50%;
            position: relative;
        }

        td::before {
            position: absolute;
            left: 15px;
            width: 45%;
            white-space: nowrap;
            font-weight: 600;
        }

        td:nth-of-type(1)::before { content: "ID"; }
        td:nth-of-type(2)::before { content: "Name"; }
        td:nth-of-type(3)::before { content: "Email"; }
        td:nth-of-type(4)::before { content: "Role"; }
        td:nth-of-type(5)::before { content: "Created At"; }
    }
</style>

<div class="container">
    <h1>
        All Users
        
            @can('canCreateUser')
                <a href="{{ route('admin.create') }}" class="btn-add-user">
                    <i class="fa fa-plus"></i> Add User
                </a>
                
            @endcan


    </h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                    <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php $id = 1; ?>
            
         @foreach($users as $index => $user)
<tr>
    <td>{{ $index + 1 }}</td> <!-- auto-increment index -->
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ ucfirst($user->role_name) }}</td> <!-- role_name from join -->
    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y, H:i') }}</td>

    <td style="display: flex; justify-content: center;">
        @can('canUpdateUser')
            <a href="{{ url('/admin/users/edit/' . $user->id) }}">
                <i class="fa fa-edit"></i>
            </a>
        @endcan

        @can('canDeleteUser')
            <a style="margin-left: 20px;" href="{{ url('/admin/users/delete/' . $user->id) }}"
               onclick="return confirm('Are you sure you want to delete this user?')">
                <i class="fa fa-trash"></i>
            </a>
        @endcan

        @if(!auth()->user()->can('canUpdateUser') && !auth()->user()->can('canDeleteUser'))
            <span style="margin-left: 10px;">No Authorized</span>
        @endif
    </td>
</tr>
@endforeach

        </tbody>
    </table>
</div>

@endsection
