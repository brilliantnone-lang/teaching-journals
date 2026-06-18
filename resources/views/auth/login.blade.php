<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Jurnal Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --dark-bg: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-white: #f8fafc;
            --text-muted: #94a3b8;
            --success: #10b981;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--dark-bg);
            background-image:
                radial-gradient(circle at 10% 20%, rgba(67, 97, 238, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(16, 185, 129, 0.1) 0%, transparent 40%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 1100px;
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 0;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            display: flex;
            overflow: hidden;
            min-height: 600px;
        }

        /* ======================================== */
        /* KIRI: LOGIN */
        /* ======================================== */
        .login-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .login-section .brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-white);
            margin-bottom: 8px;
        }

        .login-section .brand span {
            color: var(--accent);
        }

        .login-section .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        /* ======================================== */
        /* KANAN: REGISTER */
        /* ======================================== */
        .register-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(0, 0, 0, 0.2);
        }

        .register-section .brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-white);
            margin-bottom: 8px;
        }

        .register-section .brand span {
            color: var(--success);
        }

        .register-section .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        /* ======================================== */
        /* FORM */
        /* ======================================== */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }

        .form-group .input-group {
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            transition: all 0.3s;
        }

        .form-group .input-group:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .form-group .input-group .icon {
            padding: 0 15px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-group .input-group input {
            background: transparent;
            border: none;
            padding: 12px 15px 12px 0;
            color: var(--text-white);
            width: 100%;
            font-size: 0.95rem;
            outline: none;
        }

        .form-group .input-group input::placeholder {
            color: #475569;
        }

        .btn-login {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(67, 97, 238, 0.6);
        }

        .btn-register {
            background: linear-gradient(90deg, #10b981, #059669);
            color: white;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(16, 185, 129, 0.6);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .demo-accounts {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .demo-accounts .demo-title {
            color: var(--text-muted);
            font-size: 0.8rem;
            text-align: center;
            margin-bottom: 10px;
        }

        .demo-accounts .demo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .demo-accounts .demo-item {
            background: rgba(0, 0, 0, 0.2);
            padding: 8px 12px;
            border-radius: 8px;
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .demo-accounts .demo-item strong {
            color: var(--text-white);
            display: block;
            font-size: 0.8rem;
        }

        /* ======================================== */
        /* RESPONSIVE */
        /* ======================================== */
        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                min-height: auto;
            }

            .login-section {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                padding: 30px 25px;
            }

            .register-section {
                padding: 30px 25px;
            }

            .demo-accounts .demo-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="auth-container">
        <!-- ======================================== -->
        <!-- BAGIAN KIRI: LOGIN -->
        <!-- ======================================== -->
        <div class="login-section">
            <div class="brand">📚 Jurnal <span>Mengajar</span></div>
            <div class="subtitle">Masuk ke akun Anda</div>

            @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
            @endif

            @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>

        <!-- ======================================== -->
        <!-- BAGIAN KANAN: REGISTER -->
        <!-- ======================================== -->
        <div class="register-section">
            <div class="brand">📝 Daftar <span>Akun</span></div>
            <div class="subtitle">Buat akun baru untuk guru</div>

            @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>NIP (Opsional)</label>
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-id-card"></i></span>
                        <input type="text" name="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-check-circle"></i></span>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus"></i> Daftar
                </button>
            </form>

            <div style="text-align: center; margin-top: 15px; color: var(--text-muted); font-size: 0.85rem;">
                Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--accent); text-decoration: none; font-weight: 600;">Login</a>
            </div>
        </div>
    </div>

</body>

</html>