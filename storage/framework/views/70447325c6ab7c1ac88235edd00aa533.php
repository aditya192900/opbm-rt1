<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard OPBM RT 01</h1>
    <p class="text-gray-500">Ringkasan kegiatan Kampung Digital RT 01</p>
</div>


<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
        <p class="text-gray-500 text-sm uppercase">Warga Terdaftar OPBM</p>
        <p class="text-4xl font-bold text-green-600 mt-2"><?php echo e($totalPendaftar); ?></p>
        <p class="text-xs text-gray-400 mt-1"><?php echo e($totalPendaftarAktif); ?> aktif</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
        <p class="text-gray-500 text-sm uppercase">Jadwal Penjemputan</p>
        <p class="text-4xl font-bold text-blue-600 mt-2"><?php echo e($totalJadwal); ?></p>
        <p class="text-xs text-gray-400 mt-1">zona aktif</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
        <p class="text-gray-500 text-sm uppercase">Laporan Warga</p>
        <p class="text-4xl font-bold text-yellow-600 mt-2"><?php echo e($totalLaporan); ?></p>
        <p class="text-xs text-gray-400 mt-1"><?php echo e($totalLaporanPending); ?> pending</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500">
        <p class="text-gray-500 text-sm uppercase">UMKM Warga</p>
        <p class="text-4xl font-bold text-purple-600 mt-2"><?php echo e($totalUmkm); ?></p>
        <p class="text-xs text-gray-400 mt-1">usaha terdaftar</p>
    </div>
</div>


<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <a href="<?php echo e(route('jadwal.index')); ?>" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-bold text-lg text-green-700">Jadwal OPBM</h3>
        <p class="text-gray-500 text-sm mt-1">Lihat jadwal penjemputan sampah</p>
    </a>
    <a href="<?php echo e(route('pendaftaran.index')); ?>" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-bold text-lg text-blue-700">Pendaftaran</h3>
        <p class="text-gray-500 text-sm mt-1">Daftar layanan OPBM</p>
    </a>
    <a href="<?php echo e(route('laporan.index')); ?>" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-bold text-lg text-yellow-700">Laporan Warga</h3>
        <p class="text-gray-500 text-sm mt-1">Lapor masalah sampah</p>
    </a>
    <a href="<?php echo e(route('umkm.index')); ?>" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-bold text-lg text-purple-700">UMKM Warga</h3>
        <p class="text-gray-500 text-sm mt-1">Direktori usaha warga RT 1</p>
    </a>
</div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-bold text-lg mb-4">Laporan Terbaru</h3>
        <?php $__empty_1 = true; $__currentLoopData = $laporanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="border-b py-3 last:border-b-0">
                <p class="font-semibold"><?php echo e($l->judul); ?></p>
                <p class="text-gray-500 text-sm">oleh <?php echo e($l->user->name ?? 'Anonim'); ?> - <?php echo e($l->created_at->diffForHumans()); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-400 text-sm">Belum ada laporan.</p>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-bold text-lg mb-4">Pendaftar Terbaru</h3>
        <?php $__empty_1 = true; $__currentLoopData = $pendaftarTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="border-b py-3 last:border-b-0">
                <p class="font-semibold"><?php echo e($p->nama_kepala_keluarga); ?></p>
                <p class="text-gray-500 text-sm"><?php echo e($p->zona); ?> - <?php echo e($p->created_at->diffForHumans()); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-400 text-sm">Belum ada pendaftar.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\opbm-rt1\resources\views/dashboard.blade.php ENDPATH**/ ?>