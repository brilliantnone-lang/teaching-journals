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
                radial-gradient(circle at 90% 80%, rgba(16, 185, 129, 0.1) 0%, transparent 40%),
                radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 30px 30px;
            min-height: 100vh;
            width: 100%;
            overflow-y: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-white);
            padding: 20px 0;
            position: relative;
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            z-index: 1;
            opacity: 0.6;
            pointer-events: none;
        }

        .orb-1 {
            width: 350px;
            height: 350px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            top: -50px;
            left: -50px;
            animation: orbFloat1 15s infinite alternate ease-in-out;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(45deg, #f72585, #7209b7);
            bottom: -80px;
            right: -80px;
            animation: orbFloat2 18s infinite alternate-reverse ease-in-out;
        }

        .orb-3 {
            width: 250px;
            height: 250px;
            background: linear-gradient(45deg, #4cc9f0, #4361ee);
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: orbFloat3 20s infinite linear;
            opacity: 0.4;
        }

        @keyframes orbFloat1 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, 60px) scale(1.1); }
        }

        @keyframes orbFloat2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-50px, 30px) scale(1.05); }
        }

        @keyframes orbFloat3 {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-40%, -60%) rotate(360deg); }
        }

        .auth-container {
            width: 850px;
            max-width: 95%;
            min-height: 550px; 
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 0;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
            z-index: 10;
            display: flex;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 30px;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .auth-container.right-panel-active .sign-in-container {
            transform: translateX(100%);
            opacity: 0;
            z-index: 1;
        }

        .auth-container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% { opacity: 0; z-index: 1; }
            50%, 100% { opacity: 1; z-index: 5; }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .auth-container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: linear-gradient(135deg, #4361ee 0%, #7209b7 100%);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
            display: flex;
            align-items: center;
            box-shadow: inset 0 0 40px rgba(0,0,0,0.2);
        }

        .auth-container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left { transform: translateX(-20%); }
        .auth-container.right-panel-active .overlay-left { transform: translateX(0); }

        .overlay-right { right: 0; transform: translateX(0); }
        .auth-container.right-panel-active .overlay-right { transform: translateX(20%); }

        /* --- TYPOGRAPHY --- */
        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        p {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.85);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .brand {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-white);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand i {
            color: var(--accent);
            font-size: 1.2rem;
        }

        /* --- INPUTS --- */
        .form-group {
            margin-bottom: 15px;
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
            background: rgba(0, 0, 0, 0.4);
        }

        .form-group .input-group .icon {
            padding: 0 15px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-group .input-group input {
            background: transparent;
            border: none;
            padding: 10px 15px 10px 0;
            color: var(--text-white);
            width: 100%;
            font-size: 0.9rem;
            outline: none;
        }

        .form-group .input-group input::placeholder {
            color: #475569;
        }

        .btn-main {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px -10px rgba(67, 97, 238, 0.6);
        }

        .btn-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -10px rgba(67, 97, 238, 0.7);
            filter: brightness(1.1);
        }
        
        .btn-main i {
            margin-left: 8px;
        }

        .btn-ghost {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 10px 30px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-ghost:hover {
            background: rgba(255,255,255,0.25);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .forgot-link {
            color: var(--text-muted);
            font-size: 0.8rem;
            text-decoration: none;
            margin-top: 8px;
            display: block;
            text-align: center;
            transition: 0.3s;
        }
        
        .forgot-link:hover { color: var(--accent); }

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

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                min-height: auto;
                width: 100%;
                border-radius: 0;
                border: none;
                height: 100vh;
                overflow-y: auto;
            }

            .sign-in-container, .sign-up-container {
                width: 100%;
                position: relative;
                opacity: 1;
                transform: none !important;
                padding: 30px 20px;
                height: auto;
                min-height: 100vh;
            }

            .sign-up-container { display: none; }
            .auth-container.right-panel-active .sign-up-container { display: flex; }
            .auth-container.right-panel-active .sign-in-container { display: none; }
            
            .overlay-container { display: none; }
            
            .mobile-nav-btn {
                display: block;
                margin-top: 20px;
                background: rgba(255,255,255,0.05);
                border: 1px solid var(--glass-border);
                color: var(--text-white);
                padding: 12px;
                border-radius: 10px;
                width: 100%;
                cursor: pointer;
            }
        }
        
        .mobile-nav-btn { display: none; }
    </style>
</head>

<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="auth-container" id="container">
        <div class="form-container sign-up-container">
            <div class="brand">
                <i class="fas fa-chalkboard-teacher"></i> Jurnal Mengajar
            </div>
            
            <h2>Daftar Akun Guru</h2>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 20px;">
                Bergabung untuk mulai mencatat jurnal mengajar secara digital.
            </p>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Buat Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-check-circle"></i></span>
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    </div>
                </div>

                <button class="btn-main">
                    Buat Akun <i class="fas fa-arrow-right"></i>
                </button>
            </form>
            
            <button class="mobile-nav-btn" id="mobileSignIn">Sudah punya akun? Masuk</button>
        </div>

        <div class="form-container sign-in-container">
            <div class="brand">
                <i class="fas fa-chalkboard-teacher"></i> Jurnal Mengajar
            </div>

            <h2>Selamat Datang</h2>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 20px;">
                Silakan masuk ke akun Anda untuk melanjutkan.
            </p>

            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                </div>

                <button class="btn-main" style="margin-top: 10px;">
                    Masuk Akun <i class="fas fa-sign-in-alt"></i>
                </button>
            </form>

            <button class="mobile-nav-btn" id="mobileSignUp">Belum punya akun? Daftar</button>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Sudah Punya Akun?</h1>
                    <p>Untuk tetap terhubung dengan kami, silakan masuk dengan info pribadi Anda.</p>
                    <button class="btn-ghost" id="signIn">Masuk</button>
                </div>
                
                <div class="overlay-panel overlay-right">
                    <h1>Halo, Teman Guru!</h1>
                    <p>Masukkan detail pribadi Anda dan mulailah perjalanan mengajar yang terorganisir.</p>
                    <button class="btn-ghost" id="signUp">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');
        
        const mobileSignUp = document.getElementById('mobileSignUp');
        const mobileSignIn = document.getElementById('mobileSignIn');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        if(mobileSignUp) {
            mobileSignUp.addEventListener('click', () => {
                container.classList.add("right-panel-active");
            });
        }
        if(mobileSignIn) {
            mobileSignIn.addEventListener('click', () => {
                container.classList.remove("right-panel-active");
            });
        }
    </script>
</body>

</html>