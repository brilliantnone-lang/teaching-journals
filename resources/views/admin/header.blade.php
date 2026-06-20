<!-- Header Admin -->
<header class="header">
    <div class="header-container">
        <!-- Left: Brand & Toggle -->
        <div class="header-left">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="brand">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Jurnal Mengajar</span>
            </div>
        </div>

        <!-- Right: User Info -->
        <div class="header-right">
            <div class="user-info">
                <div class="avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">
                        <i class="fas fa-user-shield"></i> {{ Auth::user()->role }}
                    </div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</header>

<style>
    .header {
        background: rgba(15, 23, 42, 0.9);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding: 12px 24px;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1400px;
        margin: 0 auto;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .sidebar-toggle {
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 8px;
        transition: all 0.3s;
        display: none;
    }

    .sidebar-toggle:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #f8fafc;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #f8fafc;
    }

    .brand i {
        font-size: 1.4rem;
        color: #4cc9f0;
    }

    .brand span {
        font-size: 1.1rem;
        font-weight: 700;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 4px 12px 4px 4px;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.05);
    }

    .user-info .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f72585, #7209b7);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
        color: white;
    }

    .user-info .user-name {
        font-size: 0.85rem;
        font-weight: 500;
        color: #f8fafc;
    }

    .user-info .user-role {
        font-size: 0.65rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .logout-btn {
        background: transparent;
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        transition: all 0.3s;
        cursor: pointer;
    }

    .logout-btn:hover {
        background: rgba(239, 68, 68, 0.1);
        border-color: #ef4444;
    }

    @media (max-width: 768px) {
        .sidebar-toggle {
            display: block;
        }
        .user-info .user-name {
            display: none;
        }
        .user-info .user-role {
            display: none;
        }
        .brand span {
            display: none;
        }
        .logout-btn span {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
        }
    });
</script>