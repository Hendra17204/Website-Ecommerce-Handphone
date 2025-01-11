<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Sidebar Styles */
        .sidebar {
            background-color: #343a40;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
            /* Menyembunyikan sidebar */
        }

        .sidebar .sidebar-header {
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        .sidebar .sidebar-menu {
            padding: 0;
            list-style: none;
        }

        .sidebar .sidebar-menu li {
            padding: 15px 20px;
            border-bottom: 1px solid #495057;
        }

        .sidebar .sidebar-menu li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            padding: 16px 6px;
            border-radius: 20px;
            width: 100%;
        }

        .sidebar .sidebar-menu li a:hover {
            background-color: #495057;
            padding-left: 25px;
        }

        .sidebar .sidebar-footer {
            padding: 20px;
            text-align: center;
        }

        .sidebar-footer form button {
            padding: 2% 40%;
        }

        .toggle-sidebar {
            background: none;
            border: none;
            color: white;
            font-size: 1.5em;
            cursor: pointer;
            margin-right: 20px;
        }

        /* Header Styles */
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            text-align: left;
            position: fixed;
            top: 0;
            left: 250px;
            /* Menyesuaikan dengan lebar sidebar */
            right: 0;
            z-index: 99;
            /* Pastikan header di atas konten */
            transition: all 0.3s ease;
            /* Tambahkan transisi */
        }

        .header.full-width {
            left: 0;
            /* Pindahkan ke kiri saat sidebar ditutup */
            width: 100%;
            /* Lebar penuh */
        }

        .header h1 {
            margin: 0;
            margin-left: 10px;
            /* Mengatur margin kiri untuk jarak dari tombol */
            font-size: 1.5em;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 250px;
            padding: 70px 20px;
            /* Menambahkan padding atas untuk header */
            transition: all 0.3s ease;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .header {
                left: 0;
                right: 0;
            }

            .header h1 {
                margin-left: 0;
                /* Menghapus margin kiri pada layar kecil */
            }
        }
    </style>
</head>

<body>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 class="text-light">Ecommerce Handphone</h3>
        </div>
        <ul class="sidebar-menu list-unstyled">
            <li class="mb-3">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none text-light">
                    <i class="fas fa-home fa-lg me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role === 'admin')
                <li class="mb-3">
                    <a href="{{ route('products.index') }}"
                        class="d-flex align-items-center text-decoration-none text-light">
                        <i class="fas fa-box fa-lg me-3"></i>
                        <span>Produk</span>
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('users.index') }}"
                        class="d-flex align-items-center text-decoration-none text-light">
                        <i class="fas fa-users fa-lg me-3"></i>
                        <span>User</span>
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('transactions.index') }}"
                        class="d-flex align-items-center text-decoration-none text-light">
                        <i class="fas fa-money-bill-wave fa-lg me-3"></i>
                        <span>Transaksi</span>
                    </a>
                </li>
            @endif
        </ul>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-light logout-button">Logout</button>
            </form>
        </div>
    </div>

    <div class="header" id="header">
        <button class="toggle-sidebar" id="toggleSidebar">
            <i class="fas fa-bars"></i> <!-- Ikon untuk membuka/menutup sidebar -->
        </button>
        <h1 class="d-inline-block ms-3"> <!-- Menambahkan kelas d-inline-block dan margin start -->
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none text-light">
                    <span>Admin</span>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none text-light">
                    <span>User</span>
                </a>
            @endif
        </h1>
    </div>

    <main class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @yield('content') <!-- Konten utama akan ditampilkan di sini -->
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        // JavaScript untuk membuka dan menutup sidebar      
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const header = document.getElementById('header');
        const mainContent = document.querySelector('.main-content');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            header.classList.toggle('full-width'); // Menambahkan kelas full-width pada header    

            // Mengatur margin konten utama berdasarkan status sidebar  
            if (sidebar.classList.contains('hidden')) {
                mainContent.style.marginLeft = '0'; // Konten penuh saat sidebar tertutup  
                toggleSidebar.innerHTML = '<i class="fas fa-bars"></i>'; // Ganti ikon menjadi "bars"  
            } else {
                mainContent.style.marginLeft = '250px'; // Konten dengan margin saat sidebar terbuka  
                toggleSidebar.innerHTML = '<i class="fas fa-times"></i>'; // Ganti ikon menjadi "X"  
            }
        });
    </script>

</body>

</html>
