<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'OPBM RT 1'); ?> - Kampung Digital</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f9fafb; }

        .admin-nav {
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .admin-nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
        }

        .admin-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; flex-shrink: 0; }
        .admin-logo {
            width: 48px; height: 48px;
            background: #047857; color: white;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px;
            flex-shrink: 0;
        }
        .admin-brand-title { font-weight: 700; font-size: 15px; color: #1f2937; line-height: 1.2; }
        .admin-brand-sub   { font-size: 12px; color: #6b7280; line-height: 1.2; }

        .admin-menu { display: flex; align-items: center; gap: 4px; flex: 1; justify-content: center; }
        .admin-menu-item {
            padding: 8px 16px;
            font-size: 14px;
            color: #374151;
            text-decoration: none;
            border-radius: 9999px;
            display: inline-flex; align-items: center; gap: 4px;
            white-space: nowrap;
            transition: background 0.2s, color 0.2s;
            border: none; background: transparent; cursor: pointer; font-family: inherit;
        }
        .admin-menu-item:hover { color: #047857; }
        .admin-menu-item.active { background: #ecfdf5; color: #047857; font-weight: 600; }

        .admin-dropdown { position: relative; }
        .admin-dropdown-menu {
            position: absolute;
            top: 100%; left: 0;
            margin-top: 4px;
            background: white;
            min-width: 220px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            padding: 8px;
            opacity: 0; visibility: hidden;
            transition: opacity 0.2s, visibility 0.2s;
            border: 1px solid #f3f4f6;
        }
        .admin-dropdown:hover .admin-dropdown-menu { opacity: 1; visibility: visible; }
        .admin-dropdown-menu a {
            display: block;
            padding: 8px 12px;
            font-size: 14px;
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.15s;
        }
        .admin-dropdown-menu a:hover { background: #ecfdf5; color: #047857; }

        .admin-right { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
        .admin-user {
            display: flex; align-items: center; gap: 8px;
            padding: 6px 14px;
            background: #f3f4f6;
            border-radius: 9999px;
        }
        .admin-user-avatar {
            width: 28px; height: 28px;
            background: #059669;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 12px; font-weight: 700;
        }
        .admin-user-name { font-size: 14px; color: #374151; font-weight: 500; }

        .admin-btn-beranda {
            display: inline-flex; align-items: center; gap: 8px;
            background: #047857; color: white;
            padding: 10px 20px;
            border-radius: 9999px;
            font-size: 14px; font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }
        .admin-btn-beranda:hover { background: #065f46; }

        .admin-btn-logout {
            background: #ef4444; color: white;
            padding: 10px 16px;
            border-radius: 9999px;
            font-size: 13px; font-weight: 600;
            border: none; cursor: pointer;
            transition: background 0.2s;
        }
        .admin-btn-logout:hover { background: #dc2626; }

        .admin-hamburger { display: none; background: none; border: none; padding: 8px; cursor: pointer; color: #374151; }
        .admin-mobile-menu { display: none; padding: 12px 24px 20px; border-top: 1px solid #f3f4f6; margin-top: 8px; }
        .admin-mobile-menu.open { display: block; }
        .admin-mobile-section {
            font-size: 11px; font-weight: 700; color: #9ca3af;
            text-transform: uppercase; letter-spacing: 0.05em;
            padding: 12px 12px 6px;
        }
        .admin-mobile-menu a {
            display: block;
            padding: 10px 12px;
            font-size: 14px;
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.15s;
        }
        .admin-mobile-menu a:hover,
        .admin-mobile-menu a.active { background: #ecfdf5; color: #047857; font-weight: 600; }

        .admin-main { max-width: 1280px; margin: 0 auto; padding: 32px 24px; }
        .admin-footer { text-align: center; color: #6b7280; font-size: 14px; padding: 24px; }

        /* FLASH TOAST */
        .flash-toast {
            position: fixed;
            top: 80px;
            right: 24px;
            z-index: 9999;
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            color: white;
            padding: 14px 20px;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(16, 185, 129, 0.35);
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 14px;
            max-width: 380px;
            animation: flash-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .flash-toast.fade-out {
            animation: flash-out 0.35s ease-out forwards;
        }
        @keyframes flash-in {
            from { opacity: 0; transform: translateX(120%) scale(0.9); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes flash-out {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(120%) scale(0.9); }
        }
        .flash-toast-icon {
            width: 32px; height: 32px;
            background: rgba(255,255,255,0.25);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .flash-toast-close {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            border-radius: 50%;
            width: 24px; height: 24px;
            cursor: pointer;
            font-size: 16px;
            line-height: 1;
            flex-shrink: 0;
            transition: background 0.2s;
        }
        .flash-toast-close:hover { background: rgba(255,255,255,0.35); }

        @media (max-width: 1024px) {
            .admin-menu { display: none; }
            .admin-hamburger { display: block; }
            .admin-user { display: none; }
        }
        @media (max-width: 640px) {
            .admin-btn-beranda { display: none; }
            .admin-btn-logout { display: none; }
            .admin-nav-inner { padding: 12px 16px; }
            .admin-main { padding: 20px 16px; }
            .flash-toast { top: 70px; right: 16px; left: 16px; max-width: none; }
        }
    </style>
</head>
<body>

    <?php
        $userRole = Auth::user()->role ?? 'rt';
        $isBendahara = $userRole === 'bendahara';
        $isAdmin = in_array($userRole, ['rt', 'super_admin']);
    ?>

    <nav class="admin-nav" x-data="{ open: false }">
        <div class="admin-nav-inner">

            <a href="<?php echo e(route('dashboard')); ?>" class="admin-brand">
                <div class="admin-logo">RT</div>
                <div>
                    <div class="admin-brand-title">Informasi Warga</div>
                    <div class="admin-brand-sub">RT 01 - Kampung Digital</div>
                </div>
            </a>

            <div class="admin-menu">
                <?php if($isBendahara): ?>
                    
                    <a href="<?php echo e(route('pembayaran.index')); ?>" class="admin-menu-item <?php echo e(request()->routeIs('pembayaran.*') ? 'active' : ''); ?>">
                        Iuran OPBM
                    </a>
                <?php else: ?>
                    
                    <a href="<?php echo e(route('dashboard')); ?>" class="admin-menu-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">Beranda</a>

                    <div class="admin-dropdown">
                        <button class="admin-menu-item <?php echo e(request()->routeIs('jadwal.*') || request()->routeIs('pendaftaran.*') || request()->routeIs('laporan.*') || request()->routeIs('pembayaran.*') || request()->routeIs('kelola.akun.*') ? 'active' : ''); ?>">
                            Kelola
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="admin-dropdown-menu">
                            <a href="<?php echo e(route('jadwal.index')); ?>">Jadwal OPBM</a>
                            <a href="<?php echo e(route('pendaftaran.index')); ?>">Pendaftaran Warga</a>
                            <a href="<?php echo e(route('pembayaran.index')); ?>">Iuran OPBM</a>
                            <a href="<?php echo e(route('laporan.index')); ?>">Laporan Warga</a>
                            <?php if($isAdmin): ?>
                            <a href="<?php echo e(route('kelola.akun.index')); ?>" style="border-top:1px solid #f3f4f6; margin-top:4px; padding-top:12px; color:#047857; font-weight:600;">🔑 Kelola Akun</a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="admin-dropdown">
                        <button class="admin-menu-item <?php echo e(request()->routeIs('umkm.*') || request()->routeIs('dokumentasi.*') || request()->routeIs('pengurus.*') ? 'active' : ''); ?>">
                            Konten
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="admin-dropdown-menu">
                            <a href="<?php echo e(route('umkm.index')); ?>">UMKM Warga</a>
                            <a href="<?php echo e(route('dokumentasi.index')); ?>">Dokumentasi</a>
                            <a href="<?php echo e(route('pengurus.index')); ?>">Struktur Pengurus</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="admin-right">
                <a href="<?php echo e(route('profile.edit')); ?>" class="admin-user" style="text-decoration:none; cursor:pointer; transition: background 0.2s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                    <?php if(Auth::user()->foto && Storage::disk('public')->exists(Auth::user()->foto)): ?>
                        <img src="<?php echo e(asset('storage/' . Auth::user()->foto)); ?>" style="width:28px; height:28px; border-radius:50%; object-fit:cover;">
                    <?php else: ?>
                        <div class="admin-user-avatar"><?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 1))); ?></div>
                    <?php endif; ?>
                    <span class="admin-user-name"><?php echo e(Auth::user()->name ?? ''); ?></span>
                    <svg width="12" height="12" fill="none" stroke="#6b7280" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </a>

                <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin:0;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="admin-btn-logout">Logout</button>
                </form>

                <button class="admin-hamburger" @click="open = !open">
                    <svg x-show="!open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="admin-mobile-menu" :class="{ 'open': open }">
            <?php if($isBendahara): ?>
                <a href="<?php echo e(route('pembayaran.index')); ?>" class="<?php echo e(request()->routeIs('pembayaran.*') ? 'active' : ''); ?>">Iuran OPBM</a>
            <?php else: ?>
                <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">Beranda</a>

                <div class="admin-mobile-section">Kelola</div>
                <a href="<?php echo e(route('jadwal.index')); ?>" class="<?php echo e(request()->routeIs('jadwal.*') ? 'active' : ''); ?>">Jadwal OPBM</a>
                <a href="<?php echo e(route('pendaftaran.index')); ?>" class="<?php echo e(request()->routeIs('pendaftaran.*') ? 'active' : ''); ?>">Pendaftaran</a>
                <a href="<?php echo e(route('pembayaran.index')); ?>" class="<?php echo e(request()->routeIs('pembayaran.*') ? 'active' : ''); ?>">Iuran OPBM</a>
                <a href="<?php echo e(route('laporan.index')); ?>" class="<?php echo e(request()->routeIs('laporan.*') ? 'active' : ''); ?>">Laporan</a>
                <?php if($isAdmin): ?>
                <a href="<?php echo e(route('kelola.akun.index')); ?>" class="<?php echo e(request()->routeIs('kelola.akun.*') ? 'active' : ''); ?>">🔑 Kelola Akun</a>
                <?php endif; ?>

                <div class="admin-mobile-section">Konten</div>
                <a href="<?php echo e(route('umkm.index')); ?>" class="<?php echo e(request()->routeIs('umkm.*') ? 'active' : ''); ?>">UMKM Warga</a>
                <a href="<?php echo e(route('dokumentasi.index')); ?>" class="<?php echo e(request()->routeIs('dokumentasi.*') ? 'active' : ''); ?>">Dokumentasi</a>
                <a href="<?php echo e(route('pengurus.index')); ?>" class="<?php echo e(request()->routeIs('pengurus.*') ? 'active' : ''); ?>">Struktur Pengurus</a>
            <?php endif; ?>

            <div style="margin-top:12px; padding-top:12px; border-top:1px solid #f3f4f6;">
                <div style="display:flex; align-items:center; gap:8px; padding:8px 12px;">
                    <div class="admin-user-avatar"><?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 1))); ?></div>
                    <span style="font-size:14px; color:#374151; font-weight:500;"><?php echo e(Auth::user()->name ?? ''); ?></span>
                </div>
                <form method="POST" action="<?php echo e(route('logout')); ?>" style="padding: 4px 12px;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="admin-btn-logout" style="width:100%;">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="admin-main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="admin-footer">
        &copy; <?php echo e(date('Y')); ?> Kampung Digital OPBM RT 01 - Kota Jambi Bahagia
    </footer>

    <?php if(session('success')): ?>
    <div class="flash-toast" id="flashToast">
        <div class="flash-toast-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <span style="flex:1;"><?php echo e(session('success')); ?></span>
        <button class="flash-toast-close" onclick="dismissFlash()">×</button>
    </div>
    <script>
        function dismissFlash() {
            const t = document.getElementById('flashToast');
            if (t) {
                t.classList.add('fade-out');
                setTimeout(() => t.remove(), 350);
            }
        }
        setTimeout(dismissFlash, 4000);
    </script>
    <?php endif; ?>

</body>
</html><?php /**PATH C:\laragon\www\opbm-rt1\resources\views/layouts/app.blade.php ENDPATH**/ ?>