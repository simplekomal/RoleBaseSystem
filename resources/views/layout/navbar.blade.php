    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f0f2f5;
        }

        /* Navbar container */
        .navbar {
            width: 100%;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* Logo */
        .logo {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
        }

        .logo i {
            margin-right: 10px;
            color: #ffdd00;
        }

        /* Nav links */
        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
        }

        .nav-links li a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-links li a:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        /* Button style */
        .nav-btn {
            background: #fff;
            color: #2575fc;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background: #2575fc;
            color: #fff;
        }

        /* Responsive menu for mobile */
        @media (max-width: 768px) {
            .navbar {
                flex-wrap: wrap;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                display: none;
                margin-top: 15px;
            }

            .nav-links li {
                text-align: center;
                margin-bottom: 10px;
            }

            .nav-links.show {
                display: flex;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
                font-size: 24px;
                color: #fff;
            }
        }

        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }
    </style>

<nav class="navbar">
    <a href="#" class="logo">RoleBaseSystem</a>
    <ul class="nav-links">
        <li><a href="/home">Home</a></li>
        <li><a href="/about">About</a></li>
        
        
        @can('canShowRoleOptions')
        <li><a href="/roles">Roles</a></li>
        
        @endcan
        
        <li><a href="/admin/users">Employees</a></li>
        
        <li><a href="/profile">Profile</a></li>

        <li><a href="/logout">Logout</a></li>



    </ul>
    <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>
</nav>

@yield('content')
<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('show');
    }
</script>

