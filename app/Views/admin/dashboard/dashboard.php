<?php
$this->extend('templates/template');
$this->section('content');
?>
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title">Selamat datang, <?= esc(session()->get('nama')) ?>!</h5>
                <p class="card-text">
                    <?php if(session()->get('role') == 1): ?>
                        Anda login sebagai <strong>Administrator</strong>. Anda dapat mengelola data siswa, guru, nilai, dan soal di sistem ini.
                    <?php else: ?>
                        Anda login sebagai <strong>Guru</strong> di cabang <strong><?= esc(session()->get('cabang')) ?></strong>. Anda dapat mengelola data siswa dan nilai.
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>