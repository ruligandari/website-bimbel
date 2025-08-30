<?php $this->extend('templates/template'); ?>

<?php $this->section('styles'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<style>
    #tableSoal td,
    #tableSoal th {
        font-size: 13px;
        white-space: normal;
        /* Supaya teks bisa membungkus */
        word-break: break-word;
    }
</style>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card">
            <div class="card-header">
                <!-- tambahkan button create soal, posisi saling berjauhan dengan title -->
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold">Data Soal</h5>
                    <a href="javascript:void(0)" class="btn btn-primary" id="btnTambahSoal">Tambah Soal</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-striped align-middle" id="tableSoal">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <p class="fw-semibold mb-0">Id</p>
                                </th>
                                <th class="border-bottom-0">
                                    <p class="fw-semibold mb-0">Soal</p>
                                </th>
                                <th class="border-bottom-0">
                                    <p class="fw-semibold mb-0">Pilihan A</p>
                                </th>
                                <th class="border-bottom-0">
                                    <p class="fw-semibold mb-0">Pilihan B</p>
                                </th>
                                <th class="border-bottom-0">
                                    <p class="fw-semibold mb-0">Pilihan C</p>
                                </th>
                                <th class="border-bottom-0">
                                    <p class="fw-semibold mb-0">Pilihan D</p>
                                </th>
                                <th class="border-bottom-0">
                                    <p class="fw-semibold mb-0">Jawaban</p>
                                </th>
                                <th class="border-bottom-0">
                                    <p class="fw-semibold mb-0">Nilai</p>
                                </th>
                                <th class="border-bottom-0">
                                    <p class="fw-semibold mb-0">Actions</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($soals as $soal): ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <p class="fw-normal mb-0"><?= $no++ ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="fw-semibold mb-1">Level <?= $soal['level'] ?> - <?= $soal['kategori'] ?></p>
                                        <span class="fw-normal"><?= $soal['soal'] ?></span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $soal['pilihan_a'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $soal['pilihan_b'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $soal['pilihan_c'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $soal['pilihan_d'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $soal['jawaban'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $soal['bobot_nilai'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex gap-2">
                                            <a href="<?= base_url('admin/soal/edit/' . $soal['id']) ?>" class="btn btn-sm btn-success"><i class="ti ti-pencil"></i></a>
                                            <form action="<?= base_url('admin/soal/delete/' . $soal['id']) ?>" method="post" class="d-inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#tableSoal').DataTable({
            responsive: true,
        });
    });
</script>
<?php $this->endSection(); ?>