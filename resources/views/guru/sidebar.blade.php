<!-- Sidebar Guru -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Jurnal Mengajar</span>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-label">Menu Utama</li>
        <li>
            <a href="{{ route('guru.dashboard') }}" class="{{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('journals.index') }}" class="{{ request()->routeIs('journals.*') ? 'active' : '' }}">
                <i class="fas fa-book"></i> Jurnal Saya
            </a>
        </li>
        <li>
            <a href="{{ route('journals.create') }}" class="{{ request()->routeIs('journals.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i> Buat Jurnal
            </a>
        </li>

        <li class="menu-label">Lainnya</li>
        <li>
            <a href="#">
                <i class="fas fa-user"></i> Profil Saya
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-calendar-alt"></i> Kalender
            </a>
        </li>
    </ul>
</aside>

<style>
    .sidebar {
        width: 260px;
        height: 100vh;
        background: rgba(15, 23, 42, 0.95);
        backdrop-filter: blur(10px);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
        position: fixed;
        left: 0;
        top: 0;
        overflow-y: auto;
        transition: all 0.3s ease;
        z-index: 999;
        padding: 20px 0;
    }

    .sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    .sidebar-brand {
        padding: 0 24px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sidebar-brand i {
        font-size: 1.6rem;
        color: #4cc9f0;
    }

    .sidebar-brand span {
        font-size: 1rem;
        font-weight: 700;
        color: #f8fafc;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0 12px;
        margin: 0;
    }

    .sidebar-menu .menu-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #475569;
        padding: 12px 12px 6px;
        font-weight: 600;
    }

    .sidebar-menu li {
        margin-bottom: 2px;
    }

    .sidebar-menu li a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        color: #94a3b8;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.3s;
        font-size: 0.85rem;
    }

    .sidebar-menu li a:hover {
        background: rgba(67, 97, 238, 0.1);
        color: #f8fafc;
    }

    .sidebar-menu li a.active {
        background: rgba(67, 97, 238, 0.2);
        color: #4cc9f0;
    }

    .sidebar-menu li a.active i {
        color: #4cc9f0;
    }

    .sidebar-menu li a i {
        width: 20px;
        text-align: center;
        font-size: 1rem;
        color: #64748b;
        transition: all 0.3s;
    }

    .sidebar-menu li a:hover i {
        color: #f8fafc;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        /* Overlay saat sidebar terbuka di mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }

        .sidebar.open ~ .sidebar-overlay {
            display: block;
        }
    }
</style>