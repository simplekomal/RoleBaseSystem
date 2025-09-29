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
            text-align: center;
            margin-bottom: 30px;
            color: #333;
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
</head>

    <div class="container">
        <h1>All Users</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                      <?php

                    use Illuminate\Support\Facades\Auth;

                        if (Auth::user()->role == 'owner' || Auth::user()->role == 'admin') {
                            echo " <th style='    display: flex;
                            justify-content: center;'>Edit</th>";
                        }
                    
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $id = 1;
                    ?>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="{{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}">{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->created_at->format('d M Y, H:i') }}</td>

                    <?php
                    if(Auth::user()->role == 'owner' || Auth::user()->role == 'admin' ){
                        if($user->role == 'user' || $user->role == 'admin' ){
                            
                            if($user->role == 'admin' && Auth::user()->role == 'owner'){
                                echo "<td style='    display: flex;
                                justify-content: center;'><a href='/admin/users/edit/$user->id'><i class='fa fa-edit'></i></a></td>";
                            }

                            
                            
                                if($user->role == 'user' && Auth::user()->role == 'owner' || Auth::user()->role == 'admin' && $user->role != 'admin'){
                                echo "<td style='    display: flex;
                                justify-content: center;'><a href='/admin/users/edit/$user->id'><i class='fa fa-edit'></i></a></td>";
                            }else if(Auth::user()->role != 'owner'){
                                     echo "<td style='    display: flex;s
                                justify-content: center;'>No Authorization</td>";
                            }
                            
                            
                            }
                            else{

                                    if( Auth::user()->role == 'owner'){
                                echo "<td style='    display: flex;
                                justify-content: center;'><a href='/admin/users/edit/$user->id'><i class='fa fa-edit'></i></a></td>";
                            }else{

                                echo "<td style='    display: flex;s
                                justify-content: center;'>No Authorization</td>";
                                }
                            }
                    }


                
                    ?>  
                    </tr>
                    <?php
                    $id++;
                    ?>
                @endforeach
            </tbody>
        </table>
    </div>

        

@endsection

