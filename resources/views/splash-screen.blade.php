<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Mengajar Guru</title>

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
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
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
            width: 100%;
            overflow-y: auto;
            display: flex;
            color: var(--text-white);
            padding: 20px 0;
        }

        .main-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
            z-index: 10;
            gap: 20px;
            padding: 0 20px;
            align-items: center;
        }

        .left-section {
            flex: 1;
            padding: 2rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            z-index: 20;
            animation: slideInLeft 1s ease-out forwards;
            min-height: 500px;
        }

        .app-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            color: var(--success);
            font-weight: 600;
            width: fit-content;
            margin-bottom: 2rem;
            backdrop-filter: blur(5px);
        }

        .app-badge i {
            margin-right: 8px;
        }

        h1 {
            font-size: 3rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p.description {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
            max-width: 500px;
            line-height: 1.6;
        }

        .btn-wrapper {
            position: relative;
            display: inline-block;
        }

        .btn-main {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            padding: 18px 40px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px -10px rgba(67, 97, 238, 0.6);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px -10px rgba(67, 97, 238, 0.7);
        }

        .btn-main i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .btn-main:hover i {
            transform: translateX(5px);
        }

        .right-section {
            flex: 1.2;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1000px;
            padding: 20px 0;
        }

        .dashboard-preview {
            width: 90%;
            height: auto;
            min-height: 550px;
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2rem;
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transform: rotateY(-5deg) rotateX(3deg);
            transition: transform 0.5s ease;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            animation: floatDashboard 6s ease-in-out infinite;
        }

        .dashboard-preview:hover {
            transform: rotateY(-3deg) rotateX(2deg) scale(1.01);
        }

        .dash-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 0.8rem;
            flex-wrap: wrap;
            gap: 10px;
        }

        .header-left h3 {
            font-size: 1rem;
            color: var(--text-white);
        }

        .header-left span {
            font-size: 0.75rem;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-right {
            text-align: right;
        }

        .header-right .date {
            font-size: 0.85rem;
            font-weight: 600;
        }

        .header-right .time {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .dash-content {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            grid-template-rows: auto auto 1fr;
            gap: 0.8rem;
            flex: 1;
        }

        .card-info {
            grid-column: 1 / -1;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 0.8rem 1rem;
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .info-item span {
            display: block;
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .info-item strong {
            font-size: 0.9rem;
            color: var(--text-white);
        }

        .card-topic {
            grid-column: 1 / 2;
            background: rgba(67, 97, 238, 0.1);
            border: 1px solid rgba(67, 97, 238, 0.2);
            border-radius: 12px;
            padding: 1rem;
        }

        .topic-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            color: var(--accent);
            font-size: 0.8rem;
            font-weight: 600;
        }

        .topic-content h4 {
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .topic-content p {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-style: italic;
        }

        .card-presensi {
            grid-column: 2 / 3;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 1rem;
        }

        .presensi-title {
            font-size: 0.8rem;
            margin-bottom: 0.8rem;
            display: flex;
            justify-content: space-between;
        }

        .presensi-total {
            color: var(--success);
            font-weight: bold;
        }

        .presensi-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .p-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            padding: 5px 10px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 6px;
        }

        .p-label {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }

        .bg-hadir {
            background: var(--success);
        }

        .bg-sakit {
            background: var(--warning);
        }

        .bg-izin {
            background: var(--info);
        }

        .bg-alpa {
            background: var(--danger);
        }

        .p-names {
            color: var(--text-muted);
            font-size: 0.75rem;
            text-align: right;
            max-width: 100px;
        }

        /* Card: Catatan */
        .card-activity {
            grid-column: 1 / -1;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
        }

        .act-title {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .act-desc {
            background: rgba(0, 0, 0, 0.3);
            padding: 0.8rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #e2e8f0;
            border-left: 3px solid var(--accent);
            word-wrap: break-word;
        }

        /* Background Orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 1;
            opacity: 0.5;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: var(--primary);
            top: -100px;
            left: -100px;
            animation: orbFloat 10s infinite alternate;
        }

        .orb-2 {
            width: 300px;
            height: 300px;
            background: var(--success);
            bottom: -50px;
            right: 10%;
            animation: orbFloat 12s infinite alternate-reverse;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes floatDashboard {
            0% {
                transform: rotateY(-5deg) rotateX(3deg) translateY(0px);
            }

            50% {
                transform: rotateY(-5deg) rotateX(3deg) translateY(-10px);
            }

            100% {
                transform: rotateY(-5deg) rotateX(3deg) translateY(0px);
            }
        }

        @keyframes orbFloat {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(30px, 50px);
            }
        }

        @media (max-width: 1024px) {
            .main-container {
                flex-direction: column;
                padding: 10px;
                gap: 10px;
            }

            .left-section {
                padding: 2rem 1.5rem;
                text-align: center;
                align-items: center;
                min-height: auto;
            }

            .right-section {
                padding: 10px 0;
                height: auto;
                perspective: none;
                width: 100%;
            }

            .dashboard-preview {
                transform: none !important;
                width: 100%;
                animation: none;
                height: auto;
                min-height: auto;
                padding: 1.5rem;
            }

            .dash-content {
                grid-template-columns: 1fr;
            }

            .card-info,
            .card-topic,
            .card-presensi,
            .card-activity {
                grid-column: 1 / -1;
            }

            h1 {
                font-size: 2rem;
            }

            p.description {
                font-size: 0.95rem;
            }

            .btn-main {
                padding: 14px 30px;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .left-section {
                padding: 1.5rem 1rem;
            }

            .dashboard-preview {
                padding: 1rem;
            }

            .card-info {
                flex-direction: column;
                gap: 0.5rem;
            }

            .dash-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-right {
                text-align: left;
                width: 100%;
            }

            h1 {
                font-size: 1.6rem;
            }

            .p-row {
                flex-wrap: wrap;
                gap: 4px;
            }

            .p-names {
                max-width: 100%;
                text-align: left;
            }
        }
    </style>
</head>

<body>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="main-container">
        <section class="left-section">
            <div class="app-badge">
                <i class="fas fa-chalkboard-teacher"></i> Jurnal Mengajar Guru
            </div>

            <h1>Catat Jurnal<br>Mengajarmu.</h1>

            <p class="description">
                Sistem digital untuk pencatatan jurnal mengajar harian,<br>
                presensi siswa, dan refleksi pembelajaran secara terintegrasi.
            </p>

            <div class="btn-wrapper">
                <a href="{{ route('login') }}" class="btn-main">
                    <span>Masuk Akun Anda</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <p style="color: #94a3b8; font-size: 0.85rem; margin-top: 15px;">
                <i class="fas fa-lock" style="margin-right: 6px;"></i>
                Silakan login atau daftar terlebih dahulu
            </p>
        </section>

        <section class="right-section">
            <div class="dashboard-preview">
                <!-- Header -->
                <div class="dash-header">
                    <div class="header-left">
                        <span>Jurnal Mengajar Harian</span>
                        <h3 id="teacherName">Budi Santoso - Guru PAI</h3>
                    </div>
                    <div class="header-right">
                        <div class="date" id="currentDay">Rabu, 17 Juni 2026</div>
                        <div class="time" id="currentTime">07:30 - 08:40 WITA</div>
                    </div>
                </div>

                <div class="dash-content">
                    <div class="card-info">
                        <div class="info-item">
                            <span>KELAS / SEMESTER</span>
                            <strong id="className">XI IPA 1 / 2</strong>
                        </div>
                        <div class="info-item">
                            <span>MATA PELAJARAN</span>
                            <strong style="color: var(--accent);" id="subjectName">Pendidikan Agama Islam</strong>
                        </div>
                        <div class="info-item">
                            <span>NIP GURU</span>
                            <strong id="nipNumber">198503212010011001</strong>
                        </div>
                        <div class="info-item">
                            <span>JAM KE</span>
                            <strong id="lessonNumber">Ke-2 s.d Ke-4</strong>
                        </div>
                    </div>

                    <div class="card-topic">
                        <div class="topic-header">
                            <i class="fas fa-book"></i> MATERI & TOPIK
                        </div>
                        <div class="topic-content">
                            <h4 id="materialTitle">Akhlak Mulia dalam Kehidupan</h4>
                            <p id="materialDesc">"Bab 5: Meneladani Sifat-sifat Terpuji"</p>
                        </div>
                    </div>

                    <div class="card-presensi">
                        <div class="presensi-title">
                            <span>REKAP PRESENSI</span>
                            <span class="presensi-total">Total: <span id="totalStudent">32</span> Siswa</span>
                        </div>
                        <div class="presensi-list">
                            <div class="p-row">
                                <div class="p-label">
                                    <div class="dot bg-hadir"></div> Hadir
                                </div>
                                <div class="p-names" id="hadirCount">28 Siswa</div>
                            </div>
                            <div class="p-row">
                                <div class="p-label">
                                    <div class="dot bg-sakit"></div> Sakit
                                </div>
                                <div class="p-names" id="sakitNames">Aisyah, Rizki</div>
                            </div>
                            <div class="p-row">
                                <div class="p-label">
                                    <div class="dot bg-izin"></div> Izin
                                </div>
                                <div class="p-names" id="izinNames">Dewi</div>
                            </div>
                            <div class="p-row">
                                <div class="p-label">
                                    <div class="dot bg-alpa"></div> Alpa
                                </div>
                                <div class="p-names" id="alpaNames">Fajar, Gilang</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-activity">
                        <div class="act-title">CATATAN SAAT MENGAJAR</div>
                        <div class="act-desc" id="teachingNotes">
                            "Siswa antusias dalam diskusi kelompok. Pembelajaran berjalan kondusif."
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const dummyData = [{
                teacher: 'Budi Santoso - Guru PAI',
                class: 'XI IPA 1 / 2',
                subject: 'Pendidikan Agama Islam',
                nip: '198503212010011001',
                lesson: 'Ke-2 s.d Ke-4',
                material: 'Akhlak Mulia dalam Kehidupan',
                desc: '"Bab 5: Meneladani Sifat-sifat Terpuji"',
                total: 32,
                hadir: 28,
                sakit: 'Aisyah, Rizki',
                izin: 'Dewi',
                alpa: 'Fajar, Gilang',
                notes: '"Siswa antusias dalam diskusi kelompok. Pembelajaran berjalan kondusif."'
            },
            {
                teacher: 'Siti Rahmah - Guru Matematika',
                class: 'XII MIPA 2 / 1',
                subject: 'Matematika Wajib',
                nip: '198705152010012002',
                lesson: 'Ke-1 s.d Ke-3',
                material: 'Trigonometri Lanjutan',
                desc: '"Rumus-rumus Identitas Trigonometri"',
                total: 30,
                hadir: 26,
                sakit: 'Bagas',
                izin: 'Citra, Deni',
                alpa: 'Eko',
                notes: '"Beberapa siswa masih kesulitan dengan rumus. Perlu pendampingan khusus."'
            },
            {
                teacher: 'Agus Wijaya - Guru Bahasa Inggris',
                class: 'X IIS 2 / 2',
                subject: 'Bahasa Inggris',
                nip: '199001102015021003',
                lesson: 'Ke-3 s.d Ke-5',
                material: 'Report Text',
                desc: '"Struktur dan Ciri-ciri Report Text"',
                total: 28,
                hadir: 25,
                sakit: 'Fitri',
                izin: 'Gita, Hadi',
                alpa: 'Indra',
                notes: '"Praktik membuat report text tentang hewan langka."'
            },
            {
                teacher: 'Dewi Lestari - Guru Biologi',
                class: 'XI MIPA 3 / 1',
                subject: 'Biologi',
                nip: '198908152014031004',
                lesson: 'Ke-4 s.d Ke-6',
                material: 'Sistem Ekskresi Manusia',
                desc: '"Ginjal dan Proses Pembentukan Urin"',
                total: 29,
                hadir: 27,
                sakit: 'Joko',
                izin: 'Kiki',
                alpa: 'Lina, Mita',
                notes: '"Siswa mengikuti pembelajaran dengan baik. Ada 2 siswa yang perlu bimbingan."'
            }
        ];

        const randomIndex = Math.floor(Math.random() * dummyData.length);
        const data = dummyData[randomIndex];

        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const now = new Date();
        const dayName = days[now.getDay()];
        const dateStr = now.getDate().toString().padStart(2, '0');
        const monthStr = (now.getMonth() + 1).toString().padStart(2, '0');
        const yearStr = now.getFullYear();
        const fullDate = dayName + ', ' + dateStr + '-' + monthStr + '-' + yearStr;

        document.getElementById('teacherName').textContent = data.teacher;
        document.getElementById('className').textContent = data.class;
        document.getElementById('subjectName').textContent = data.subject;
        document.getElementById('nipNumber').textContent = data.nip;
        document.getElementById('lessonNumber').textContent = data.lesson;
        document.getElementById('materialTitle').textContent = data.material;
        document.getElementById('materialDesc').textContent = data.desc;
        document.getElementById('totalStudent').textContent = data.total;
        document.getElementById('hadirCount').textContent = data.hadir + ' Siswa';
        document.getElementById('sakitNames').textContent = data.sakit;
        document.getElementById('izinNames').textContent = data.izin;
        document.getElementById('alpaNames').textContent = data.alpa;
        document.getElementById('teachingNotes').textContent = data.notes;
        document.getElementById('currentDay').textContent = fullDate;
    </script>

</body>

</html>