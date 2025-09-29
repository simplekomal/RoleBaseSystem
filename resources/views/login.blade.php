<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            overflow: hidden;
        }

        /* Glassmorphism Container */
        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            color: #fff;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
            color: #fff;
        }

        /* Error messages */
        .error-messages {
            background-color: rgba(255, 0, 0, 0.2);
            border-left: 4px solid #ff4c4c;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            color: #ffdddd;
        }

        .error-messages ul {
            list-style: none;
        }

        form .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        form .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #fff;
            opacity: 0.7;
        }

        form input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        form input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        form input:focus {
            border: 1px solid #fff;
            outline: none;
            background: rgba(255, 255, 255, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: none;
            background: #fff;
            color: #2575fc;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #2575fc;
            color: #fff;
        }

        @media (max-width: 500px) {
            .container {
                padding: 30px 20px;
            }
        }

        .forgot-password {
            display: block;
            text-align: right;
            margin-bottom: 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
            
        </form>
        <a style="text-decoration: none;" href="/register"><button style="margin-top: 10px ; " type="submit">Registration</button></a>
    </div>
</body>
</html>
