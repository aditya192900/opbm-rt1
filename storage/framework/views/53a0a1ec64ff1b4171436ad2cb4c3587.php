

<?php $__env->startSection('title', 'Pendaftaran OPBM'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .badge-new {
        display: inline-flex; align-items: center; gap: 3px;
        background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
        color: white;
        font-size: 10px; font-weight: 800;
        padding: 3px 8px;
        border-radius: 9999px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        animation: pulse-new 1.5s ease-in-out infinite;
        margin-left: 6px;
    }
    @keyframes pulse-new {
        0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
        70% { box-shadow: 0 0 0 8px rgba(239, 68, 68, 0); }
        100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }
    .notification-alert { animation: slide-down 0.5s ease-out; }
    @keyframes slide-down {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .refresh-indicator {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 11px; color: #6b7280;
        padding: 4px 10px; background: #f3f4f6;
        border-radius: 9999px;
    }
    .refresh-dot {
        width: 6px; height: 6px;
        background: #10b981; border-radius: 50%;
        animation: blink 2s ease-in-out infinite;
    }
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }
    .row-new {
        background: linear-gradient(90deg, #fef3c7 0%, #fffbeb 30%, transparent 100%);
        border-left: 3px solid #f59e0b;
    }
    .row-new:hover {
        background: linear-gradient(90deg, #fde68a 0%, #fef3c7 30%, #fafafa 100%);
    }
    .bell-shake { animation: bell-ring 0.6s ease-in-out; transform-origin: top center; }
    @keyframes bell-ring {
        0%, 100% { transform: rotate(0); }
        15% { transform: rotate(15deg); }
        30% { transform: rotate(-15deg); }
        45% { transform: rotate(10deg); }
        60% { transform: rotate(-10deg); }
        75% { transform: rotate(5deg); }
    }
    .new-toast {
        position: fixed; top: 20px; right: 20px; z-index: 9999;
        background: white; border-radius: 16px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        padding: 16px 20px;
        display: flex; align-items: center; gap: 12px;
        min-width: 320px;
        border-left: 5px solid #10b981;
        animation: toast-in 0.4s ease-out;
    }
    @keyframes toast-in {
        from { opacity: 0; transform: translateX(100%); }
        to { opacity: 1; transform: translateX(0); }
    }
    .new-toast.fade-out { animation: toast-out 0.4s ease-out forwards; }
    @keyframes toast-out {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(100%); }
    }
</style>

<div class="flex justify-between items-center mb-6 flex-wrap gap-3">
    <div>
        <h1 class="text-2xl font-bold">Pendaftaran Layanan OPBM</h1>
        <p class="text-gray-500 text-sm">Data warga RT 01 yang mendaftar program OPBM</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="refresh-indicator">
            <span class="refresh-dot"></span>
            <span>Auto-refresh 5s</span>
        </div>
        <button id="toggleSound" onclick="toggleSound()"
                class="inline-flex items-center gap-1.5 text-xs bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-3 py-2 rounded-full font-semibold transition">
            <svg id="soundIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
            </svg>
            <span id="soundLabel">Suara: ON</span>
        </button>
        <a href="<?php echo e(route('pendaftaran.create')); ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-full shadow-sm font-medium text-sm transition">
            + Tambah Manual
        </a>
    </div>
</div>

<?php if($totalPending > 0): ?>
<div class="notification-alert bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-500 p-5 rounded-2xl mb-6 shadow-sm">
    <div class="flex items-start gap-4">
        <div class="w-12 h-12 rounded-full bg-yellow-500 flex items-center justify-center flex-shrink-0 bell-shake">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
        </div>
        <div class="flex-1">
            <h3 class="font-bold text-yellow-800 text-lg">🔔 Ada <?php echo e($totalPending); ?> Pendaftar Baru!</h3>
            <p class="text-sm text-yellow-700 mt-1 leading-relaxed">
                Klik tombol <strong>Konfirmasi</strong> hijau untuk mengaktifkan pendaftar secara langsung.
            </p>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">No</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">No HP</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Alamat</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Blok</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $isNew = $p->status === 'pending' && $p->created_at->diffInHours(now()) < 24;
                ?>
                <tr class="transition <?php echo e($isNew ? 'row-new' : 'hover:bg-emerald-50/30'); ?>">
                    <td class="px-6 py-4 text-sm text-gray-500"><?php echo e($pendaftarans->firstItem() + $i); ?></td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-bold text-xs flex-shrink-0" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                                <?php echo e(strtoupper(substr($p->nama_kepala_keluarga, 0, 2))); ?>

                            </div>
                            <div class="flex items-center flex-wrap">
                                <span class="font-semibold text-gray-800"><?php echo e($p->nama_kepala_keluarga); ?></span>
                                <?php if($isNew): ?>
                                    <span class="badge-new">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        NEW
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($p->no_hp); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?php echo e(\Illuminate\Support\Str::limit($p->alamat, 30)); ?></td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold"><?php echo e($p->zona); ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <?php if($p->status == 'aktif'): ?>
                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold">Aktif</span>
                        <?php elseif($p->status == 'pending'): ?>
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                        <?php else: ?>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2 text-sm whitespace-nowrap">
                        <?php if($p->status == 'pending'): ?>
                            <form action="<?php echo e(route('pendaftaran.update', $p)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="nama_kepala_keluarga" value="<?php echo e($p->nama_kepala_keluarga); ?>">
                                <input type="hidden" name="no_hp" value="<?php echo e($p->no_hp); ?>">
                                <input type="hidden" name="alamat" value="<?php echo e($p->alamat); ?>">
                                <input type="hidden" name="zona" value="<?php echo e($p->zona); ?>">
                                <input type="hidden" name="status" value="aktif">
                                <button type="submit"
                                        onclick="return confirm('Konfirmasi <?php echo e($p->nama_kepala_keluarga); ?> sebagai peserta aktif?')"
                                        class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-full text-xs font-semibold transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Konfirmasi
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo e(route('pendaftaran.edit', $p)); ?>" class="text-blue-600 hover:underline">Edit</a>
                        <?php endif; ?>
                        <form action="<?php echo e(route('pendaftaran.destroy', $p)); ?>" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-400">Belum ada pendaftar.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6"><?php echo e($pendaftarans->links()); ?></div>

<script>
(function() {
    const currentPendingIds = <?php echo json_encode($pendaftarans->where('status', 'pending')->pluck('id')->values(), 512) ?>;
    const STORAGE_KEY = 'opbm_seen_pending_ids';
    const SOUND_KEY = 'opbm_sound_enabled';

    let soundEnabled = localStorage.getItem(SOUND_KEY) !== 'false';
    updateSoundButton();

    let seenIds = [];
    try { seenIds = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]'); } catch(e) { seenIds = []; }

    if (seenIds.length === 0 && currentPendingIds.length > 0) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(currentPendingIds));
    } else {
        const newIds = currentPendingIds.filter(id => !seenIds.includes(id));
        if (newIds.length > 0) {
            if (soundEnabled) playDingSound();
            showNewToast(newIds.length);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(currentPendingIds));
        }
    }

    function playDingSound() {
        try {
            const AudioCtx = window.AudioContext || window.webkitAudioContext;
            const ctx = new AudioCtx();
            playTone(ctx, 880, 0.15, 0);
            playTone(ctx, 1174, 0.15, 0.18);
            playTone(ctx, 1568, 0.25, 0.36);
            setTimeout(() => {
                const ctx2 = new AudioCtx();
                playTone(ctx2, 880, 0.15, 0);
                playTone(ctx2, 1174, 0.15, 0.18);
                playTone(ctx2, 1568, 0.25, 0.36);
            }, 800);
        } catch(e) {}
    }

    function playTone(ctx, freq, duration, delay) {
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.type = 'sine';
        osc.frequency.value = freq;
        osc.connect(gain);
        gain.connect(ctx.destination);
        const startTime = ctx.currentTime + delay;
        gain.gain.setValueAtTime(0, startTime);
        gain.gain.linearRampToValueAtTime(0.3, startTime + 0.02);
        gain.gain.exponentialRampToValueAtTime(0.01, startTime + duration);
        osc.start(startTime);
        osc.stop(startTime + duration);
    }

    function showNewToast(count) {
        const toast = document.createElement('div');
        toast.className = 'new-toast';
        toast.innerHTML = `
            <div style="width:44px; height:44px; background:linear-gradient(135deg,#10b981,#047857); border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <svg style="width:24px; height:24px; color:white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <div style="flex:1;">
                <p style="font-weight:800; color:#065f46; font-size:14px; margin:0;">🔔 ${count} Pendaftar Baru!</p>
                <p style="color:#6b7280; font-size:12px; margin:4px 0 0 0;">Warga baru mendaftar program OPBM</p>
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.classList.add('fade-out');
            setTimeout(() => toast.remove(), 400);
        }, 6000);
    }

    window.toggleSound = function() {
        soundEnabled = !soundEnabled;
        localStorage.setItem(SOUND_KEY, soundEnabled ? 'true' : 'false');
        updateSoundButton();
    };

    function updateSoundButton() {
        const label = document.getElementById('soundLabel');
        if (label) label.textContent = soundEnabled ? 'Suara: ON' : 'Suara: OFF';
    }

    // Delay refresh: kalau ada flash message, tunggu 4 detik (biar toast selesai dulu)
    const hasFlash = <?php echo e(session('success') ? 'true' : 'false'); ?>;
    const delay = hasFlash ? 8000 : 5000;

    let paused = false;
    ['mousedown', 'keydown', 'touchstart'].forEach(evt => {
        document.addEventListener(evt, () => {
            paused = true;
            clearTimeout(window.__pauseTimeout);
            window.__pauseTimeout = setTimeout(() => { paused = false; }, 15000);
        }, { passive: true });
    });

    setTimeout(function() {
        if (!paused) window.location.reload();
        else setTimeout(() => window.location.reload(), 8000);
    }, delay);
})();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\opbm-rt1\resources\views/pendaftaran/index.blade.php ENDPATH**/ ?>