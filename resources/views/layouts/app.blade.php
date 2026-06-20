<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jurnal Mengajar')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
        }

        /* ======================================== */
        /* MAIN CONTENT */
        /* ======================================== */
        .main-content {
            margin-left: 260px;
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ======================================== */
        /* PAGE CONTENT */
        /* ======================================== */
        .page-content {
            padding: 24px;
            flex: 1;
        }

        /* ======================================== */
        /* RESPONSIVE */
        /* ======================================== */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }

        /* ======================================== */
        /* CARD DARK */
        /* ======================================== */
        .card-dark {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            color: #f8fafc;
        }

        .card-dark .card-header {
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #f8fafc;
            font-weight: 600;
        }

        .card-dark .card-body {
            color: #e2e8f0;
        }

        .table-dark-custom {
            color: #e2e8f0;
        }

        .table-dark-custom th {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
        }

        .table-dark-custom td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            color: #e2e8f0;
        }

        .table-dark-custom tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- ========================================== -->
    <!-- SIDEBAR (Panggil sesuai role) -->
    <!-- ========================================== -->
    @auth
        @if(Auth::user()->role === 'admin')
            @include('admin.sidebar')
        @else
            @include('guru.sidebar')
        @endif
    @endauth

    <!-- ========================================== -->
    <!-- MAIN CONTENT -->
    <!-- ========================================== -->
    <div class="main-content">

        <!-- ========================================== -->
        <!-- HEADER (Panggil sesuai role) -->
        <!-- ========================================== -->
        @auth
            @if(Auth::user()->role === 'admin')
                @include('admin.header')
            @else
                @include('guru.header')
            @endif
        @endauth

        <!-- ========================================== -->
        <!-- PAGE CONTENT -->
        <!-- ========================================== -->
        <div class="page-content">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- ========================================== -->
        <!-- FOOTER (Panggil sesuai role) -->
        <!-- ========================================== -->
        @auth
            @if(Auth::user()->role === 'admin')
                @include('admin.footer')
            @else
                @include('guru.footer')
            @endif
        @endauth

    </div>

    <!-- Overlay untuk mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle untuk mobile
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (toggleBtn && sidebar && overlay) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                    overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
                });

                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('open');
                    overlay.style.display = 'none';
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>