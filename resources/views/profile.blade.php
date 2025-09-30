@extends('layout.mainLayout')

@section('mainContent')
<style>
    body {
        background: #f4f7fb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .profile-container {
        max-width: 650px;
        margin: 50px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .profile-header {
        background: linear-gradient(135deg, #4A90E2, #5A6FF0);
        color: #fff;
        text-align: center;
        padding: 30px 20px;
    }

    .profile-header h2 {
        font-size: 2rem;
        margin-bottom: 8px;
    }

    .profile-header p {
        margin: 0;
        font-size: 1rem;
        opacity: 0.9;
    }

    .profile-details {
        padding: 30px;
    }

    .profile-details table {
        width: 100%;
        border-collapse: collapse;
    }

    .profile-details th,
    .profile-details td {
        padding: 14px 20px;
        text-align: left;
    }

    .profile-details th {
        width: 30%;
        background: #f7f9fc;
        color: #333;
        font-weight: 600;
        border-radius: 10px 0 0 10px;
    }

    .profile-details td {
        background: #ffffff;
        color: #555;
        font-size: 1rem;
        border-radius: 0 10px 10px 0;
    }

    .profile-details tr {
        border-bottom: 1px solid #e5e9f2;
        transition: background 0.3s;
    }

    .profile-details tr:hover {
        background: #f9fbff;
    }

    .back-btn {
        display: inline-block;
        margin: 25px auto 10px;
        padding: 12px 28px;
        background: #4A90E2;
        color: #fff;
        font-size: 1rem;
        text-decoration: none;
        border-radius: 8px;
        transition: background 0.3s, transform 0.2s;
        text-align: center;
    }

    .back-btn:hover {
        background: #3578d4;
        transform: translateY(-2px);
    }

    @media (max-width: 600px) {
        .profile-container {
            margin: 30px 15px;
        }
        .profile-header h2 {
            font-size: 1.8rem;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <h2>👤 Profile Details</h2>
        <p>Your account information overview</p>
    </div>

    <div class="profile-details">
        <table>
            <tr>
                <th>ID</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ ucfirst($user->role_name) }}</td>
            </tr>
            <tr>

        </table>

        <div class="text-center">
            <a href="{{ url('/home') }}" class="back-btn">⬅️ Back to Home</a>
        </div>
    </div>
</div>
@endsection
