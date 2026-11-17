
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | MotoCare Service</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background: #f4f5f7;
            color: #17191f;
        }

        /* SIDEBAR */
        .sidebar {
            width: 255px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #17191f;
            padding: 28px 18px;
            z-index: 1000;
            animation: slideIn .6s ease;
        }

        .brand {
            color: #ffffff !important;
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 40px;
            letter-spacing: -1px;
        }

        .brand span {
            color: #ffffff !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        .menu-label {
            color: #777d89;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            margin: 25px 12px 12px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            color: #aeb3bd;
            text-decoration: none;
            border-radius: 9px;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
            transition: .3s;
        }

        .sidebar a i {
            font-size: 17px;
            transition: .3s;
        }

        /* MENU AKTIF */
        .sidebar a.active-dashboard {
            background: #ffffff;
            color: #17191f;
            transform: translateX(4px);
            box-shadow: 0 5px 15px rgba(255,255,255,.12);
        }

        .sidebar a.active-pelanggan {
            background: #FF454B;
            color: #ffffff;
            transform: translateX(4px);
            box-shadow: 0 5px 15px rgba(255,69,75,.25);
        }

        .sidebar a.active-kendaraan {
            background: #00CFE8;
            color: #101820;
            transform: translateX(4px);
            box-shadow: 0 5px 15px rgba(0,207,232,.25);
        }

        .sidebar a.active-daftar-service {
            background: #95D600;
            color: #142000;
            transform: translateX(4px);
            box-shadow: 0 5px 15px rgba(149,214,0,.25);
        }

        .sidebar a.active-data-service {
            background: #FF9800;
            color: #241500;
            transform: translateX(4px);
            box-shadow: 0 5px 15px rgba(255,152,0,.25);
        }

        .sidebar a.active-pembayaran {
            background: #737b89;
            color: #ffffff;
            transform: translateX(4px);
            box-shadow: 0 5px 15px rgba(115,123,137,.2);
        }

        .sidebar a:not([class*="active-"]):hover {
            background: #292d36;
            color: #ffffff;
            transform: translateX(4px);
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 255px;
            padding: 30px 38px;
            min-height: 100vh;
            background: #f4f5f7;
            box-sizing: border-box;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .topbar h6 {
            font-weight: 700;
            margin: 0;
        }

        .topbar small {
            color: #858b96;
        }

        .content-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 25px rgba(0,0,0,.035);
            animation: fadeUp .7s ease both;
        }

        /* =================================
           KHUSUS HALAMAN DAFTAR SERVICE
        ================================= */

        body.daftar-service-layout {
            background: #17191f;
        }

        .daftar-service-layout .main-content {
            min-height: 100vh;
            padding: 0;
            background:
                linear-gradient(
                    rgba(15,18,23,.88),
                    rgba(15,18,23,.94)
                ),
                url('/images/motogp-k.jfif') center center / cover fixed no-repeat;
        }

        .daftar-service-layout .topbar {
            margin: 0;
            padding: 30px 38px 0;
            color: white;
        }

        .daftar-service-layout .topbar h6 {
            color: white;
        }

        .daftar-service-layout .topbar small {
            color: #bfc4cc;
        }

        .daftar-service-layout .service-page {
            background: transparent !important;
            margin: 0 !important;
            width: 100% !important;
            min-height: calc(100vh - 90px);
            padding: 30px 38px !important;
            box-sizing: border-box;
            border-radius: 0 !important;
        }

        /* =================================
           KHUSUS HALAMAN DATA PELANGGAN
        ================================= */

        body.customer-layout {
            background: #090a0e;
            color: white;
        }

        .customer-layout .main-content {
            background: transparent;
            color: white;
        }

        .customer-layout .topbar h6 {
            color: white;
        }

        .customer-layout .topbar small {
            color: #d0d0d0;
        }

        /* =================================
           KHUSUS HALAMAN DATA SERVICE
        ================================= */

        body.data-service-layout {
            background: #17191f;
            color: white;
        }

        .data-service-layout .main-content {
            min-height: 100vh;
            padding: 0;
            background:
                linear-gradient(
                    115deg,
                    rgba(12,14,19,.88),
                    rgba(12,14,19,.72)
                ),
                url('/images/mekanik.jfif') center center / cover fixed no-repeat;
            box-sizing: border-box;
        }

        .data-service-layout .topbar {
            margin: 0;
            padding: 30px 38px;
            color: white;
        }

        .data-service-layout .topbar h6 {
            color: white;
        }

        .data-service-layout .topbar small {
            color: #bfc4cc;
        }

        .data-service-layout .workshop-page {
            width: 100%;
            min-height: calc(100vh - 90px);
            margin: 0 !important;
            padding: 0 38px 38px !important;
            box-sizing: border-box;
            background: transparent !important;
            border-radius: 0 !important;
        }

        /* =================================
           KHUSUS HALAMAN PEMBAYARAN
        ================================= */

        body.payment-layout {
            background: #17191f;
            color: #ffffff;
        }

        .payment-layout .main-content {
            min-height: 100vh;
            padding: 0;
            background:
                radial-gradient(
                    circle at 85% 10%,
                    rgba(245,158,11,.12),
                    transparent 35%
                ),
                linear-gradient(
                    120deg,
                    #17191f,
                    #222630
                );
            box-sizing: border-box;
            color: #ffffff;
        }

        .payment-layout .topbar {
            margin: 0;
            padding: 30px 38px;
            color: #ffffff;
        }

        .payment-layout .topbar h6 {
            color: #ffffff;
        }

        .payment-layout .topbar small {
            color: #bfc4cc;
        }

        .payment-layout .payment-page {
            width: 100%;
            min-height: calc(100vh - 90px);
            margin: 0 !important;
            padding: 0 38px 38px !important;
            box-sizing: border-box;
            background: transparent !important;
            color: #ffffff;
            border-radius: 0 !important;
        }

        .payment-layout .payment-page h1,
        .payment-layout .payment-page h2,
        .payment-layout .payment-page h3,
        .payment-layout .payment-page h4,
        .payment-layout .payment-page h5,
        .payment-layout .payment-page h6,
        .payment-layout .payment-page label {
            color: #ffffff;
        }

        /* DASHBOARD HERO */
        .hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 85% 20%, rgba(215,25,32,.45), transparent 35%),
                linear-gradient(115deg, #17191f, #292d36);
            border-radius: 18px;
            padding: 40px;
            color: white;
            min-height: 245px;
            display: flex;
            align-items: center;
            margin-bottom: 28px;
            animation: fadeUp .7s ease both;
        }

        .hero::after {
            content: 'MOTO';
            position: absolute;
            right: 15px;
            bottom: -40px;
            font-size: 125px;
            font-weight: 800;
            color: rgba(255,255,255,.035);
            letter-spacing: -10px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: clamp(25px, 3vw, 38px);
            font-weight: 800;
            letter-spacing: -1.5px;
        }

        .hero h1 span {
            color: #ff343d;
        }

        .hero p {
            color: #c4c7ce;
            font-size: 13px;
            max-width: 460px;
            line-height: 1.8;
        }

        .btn-service {
            display: inline-block;
            padding: 12px 19px;
            background: #d71920;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            transition: .3s;
        }

        .btn-service:hover {
            background: #f02a33;
            color: white;
            transform: translateY(-3px);
        }

        .stat-card {
            border: 0;
            border-radius: 14px;
            padding: 20px;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,.035);
            transition: .3s;
            animation: fadeUp .7s ease both;
        }

        .stat-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 12px 25px rgba(0,0,0,.09);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 21px;
            margin-bottom: 18px;
        }

        .stat-card h6 {
            color: #858b96;
            font-size: 12px;
        }

        .stat-card h2 {
            font-size: 28px;
            font-weight: 800;
        }

        .section-title {
            font-weight: 800;
            font-size: 17px;
        }

        /* ANIMATIONS */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 75px;
                padding: 20px 10px;
            }

            .brand {
                font-size: 12px;
                text-align: center;
            }

            .brand span,
            .menu-label,
            .sidebar a span {
                display: none;
            }

            .sidebar a {
                justify-content: center;
                padding: 14px 5px;
            }

            .main-content {
                margin-left: 75px;
                padding: 20px 14px;
            }

            .hero {
                padding: 25px;
            }

            .daftar-service-layout .main-content {
                padding: 0;
            }

            .daftar-service-layout .topbar {
                padding: 20px 15px 0;
            }

            .daftar-service-layout .service-page {
                padding: 20px 15px !important;
            }

            .data-service-layout .main-content {
                padding: 0;
            }

            .data-service-layout .topbar {
                padding: 20px 15px;
            }

            .data-service-layout .workshop-page {
                padding: 0 15px 25px !important;
            }

            .payment-layout .main-content {
                padding: 0;
            }

            .payment-layout .topbar {
                padding: 20px 15px;
            }

            .payment-layout .payment-page {
                padding: 0 15px 25px !important;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body class="{{ request()->is('daftar-service*') ? 'daftar-service-layout' : (request()->is('pelanggan*') ? 'customer-layout' : (request()->is('data-service*') ? 'data-service-layout' : (request()->is('pembayaran*') ? 'payment-layout' : ''))) }}">

    <aside class="sidebar">

        <div class="brand">
            <i class="bi bi-gear-wide-connected text-danger"></i>
            MOTO<span>CARE.</span>
        </div>

        <div class="menu-label">MENU UTAMA</div>

        <a href="/" class="{{ request()->is('/') ? 'active-dashboard' : '' }}">
            <i class="bi bi-grid-1x2"></i>
            <span>Dashboard</span>
        </a>

        <div class="menu-label">MANAJEMEN BENGKEL</div>

        <a href="/pelanggan" class="{{ request()->is('pelanggan*') ? 'active-pelanggan' : '' }}">
            <i class="bi bi-people"></i>
            <span>Data Pelanggan</span>
        </a>

        <a href="/kendaraan" class="{{ request()->is('kendaraan*') ? 'active-kendaraan' : '' }}">
            <i class="bi bi-bicycle"></i>
            <span>Data Kendaraan</span>
        </a>

        <a href="/daftar-service" class="{{ request()->is('daftar-service*') ? 'active-daftar-service' : '' }}">
            <i class="bi bi-clipboard-check"></i>
            <span>Daftar Service</span>
        </a>

        <a href="/data-service" class="{{ request()->is('data-service*') ? 'active-data-service' : '' }}">
            <i class="bi bi-tools"></i>
            <span>Data Service</span>
        </a>

        <a href="/pembayaran" class="{{ request()->is('pembayaran*') ? 'active-pembayaran' : '' }}">
            <i class="bi bi-wallet2"></i>
            <span>Pembayaran</span>
        </a>

        <div class="menu-label">INFORMASI</div>

        <a href="#" title="Informasi sistem">
            <i class="bi bi-info-circle"></i>
            <span>Informasi Sistem</span>
        </a>

    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h6>MotoCare Service</h6>
                <small>Sistem Informasi Manajemen Bengkel</small>
            </div>

            <div class="text-end">
                <span class="badge text-bg-danger">ADMIN</span>
            </div>
        </div>

        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
