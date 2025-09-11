<?php $this->extend('templates/template'); ?>

<?php $this->section('styles'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<?= $this->include('component/modal_tambah_soal') ?>
<?= $this->include('component/modal_edit_soal') ?>
<style>
    #tableSoal td,
    #tableSoal th {
        font-size: 13px;
        white-space: normal;
        /* Supaya teks bisa membungkus */
        word-break: break-word;
    }
</style>

<!-- sweetalert success -->
<?php if (session()->getFlashdata('success')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '<?= session()->getFlashdata('success') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        });
    </script>
<?php endif; ?>
<!-- error -->
<?php if (session()->getFlashdata('error')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= session()->getFlashdata('error') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        });
    </script>
<?php endif; ?>

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
                                        <p class="fw-semibold mb-1">
                                            Level <?= $soal['level'] ?> - <?= $soal['kategori'] ?>
                                        </p>
                                        <span class="fw-normal"><?= $soal['soal'] ?></span>

                                        <?php if (!empty($soal['foto'])): ?>
                                            <div class="mt-2">
                                                <img src="<?= base_url('uploads/soal/' . $soal['foto']) ?>"
                                                    alt="Gambar Soal"
                                                    class="img-fluid rounded border"
                                                    style="max-width: 200px; height: auto;">
                                            </div>
                                        <?php endif; ?>
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
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-success btnEditSoal"
                                                data-id="<?= $soal['id'] ?>"
                                                data-kategori="<?= $soal['kategori_id'] ?>"
                                                data-level="<?= $soal['level'] ?>"
                                                data-soal="<?= htmlspecialchars($soal['soal']) ?>"
                                                data-foto="<?= $soal['foto'] ?>"
                                                data-a="<?= htmlspecialchars($soal['pilihan_a']) ?>"
                                                data-b="<?= htmlspecialchars($soal['pilihan_b']) ?>"
                                                data-c="<?= htmlspecialchars($soal['pilihan_c']) ?>"
                                                data-d="<?= htmlspecialchars($soal['pilihan_d']) ?>"
                                                data-jawaban="<?= $soal['jawaban'] ?>"
                                                data-nilai="<?= $soal['bobot_nilai'] ?>">
                                                <i class="ti ti-pencil"></i>
                                            </a>

                                            <button type="button"
                                                class="btn btn-sm btn-danger btnDeleteSoal"
                                                data-id="<?= $soal['id'] ?>"
                                                data-url="<?= base_url('admin/soal/delete/' . $soal['id']) ?>">
                                                <i class="ti ti-trash"></i>
                                            </button>
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

        // Trigger modal
        $('#btnTambahSoal').on('click', function() {
            $('#modalTambahSoal').modal('show');
        });
    });

    $(document).on('click', '.btnEditSoal', function() {
        let id = $(this).data('id');
        $('#edit_id').val(id);
        $('#edit_kategori_id').val($(this).data('kategori'));
        $('#edit_level').val($(this).data('level'));
        $('#edit_soal').val($(this).data('soal'));
        $('#edit_a').val($(this).data('a'));
        $('#edit_b').val($(this).data('b'));
        $('#edit_c').val($(this).data('c'));
        $('#edit_d').val($(this).data('d'));
        $('#edit_jawaban').val($(this).data('jawaban'));
        $('#edit_nilai').val($(this).data('nilai'));

        let foto = $(this).data('foto');
        if (foto) {
            $('#previewFoto').html('<img src="<?= base_url("uploads/soal") ?>/' + foto + '" class="img-fluid" width="150">');
        } else {
            $('#previewFoto').html('<small class="text-muted">Tidak ada gambar</small>');
        }

        // set action form update
        $('#formEditSoal').attr('action', "<?= base_url('admin/soal/update') ?>/" + id);

        $('#modalEditSoal').modal('show');
    });

    $(document).on('click', '.btnDeleteSoal', function(e) {
        e.preventDefault();
        let url = $(this).data('url');

        Swal.fire({
            title: 'Yakin hapus soal ini?',
            text: "Data tidak bisa dikembalikan setelah dihapus.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // buat form dinamis
                let form = $('<form>', {
                    'method': 'POST',
                    'action': url
                });
                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_method',
                    'value': 'DELETE'
                }));
                $('body').append(form);
                form.submit();
            }
        });
    });
</script>
<?php $this->endSection(); ?>