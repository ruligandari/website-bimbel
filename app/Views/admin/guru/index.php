<?php $this->extend('templates/template'); ?>

<?php $this->section('styles'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<!-- SweetAlert Flash -->
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold">Data Guru</h5>
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnTambahGuru">Tambah Guru</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle" id="tableGuru">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Cabang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($gurus as $guru): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($guru['nama']) ?></td>
                                    <td><?= esc($guru['username']) ?></td>
                                    <td><?= esc($guru['cabang']) ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-success btnEditGuru"
                                                data-id="<?= $guru['id'] ?>"
                                                data-nama="<?= esc($guru['nama']) ?>"
                                                data-username="<?= esc($guru['username']) ?>"
                                                data-cabang="<?= esc($guru['cabang']) ?>">
                                                <i class="ti ti-pencil"></i>
                                            </a>
                                            <form action="<?= base_url('admin/guru/delete/' . $guru['id']) ?>" method="post" class="d-inline formDelete">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="ti ti-trash"></i>
                                                </button>
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

<!-- Modal Tambah/Edit -->
<div class="modal fade" id="modalGuru" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formGuru" method="post" action="<?= base_url('admin/guru/store') ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="guru_id">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>

                    <div class="mb-3">
                        <label for="cabang" class="form-label">Cabang</label>
                        <input type="text" class="form-control" name="cabang" id="cabang" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<!-- jQuery and Bootstrap already loaded in template, don't reload -->
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#tableGuru').DataTable({
            responsive: true
        });

        // Tambah Guru
        $('#btnTambahGuru').on('click', function() {
            $('#modalGuru .modal-title').text('Tambah Guru');
            $('#formGuru').attr('action', "<?= base_url('admin/guru/store') ?>");
            $('#guru_id').val('');
            $('#nama').val('');
            $('#username').val('');
            $('#cabang').val('');
            $('#password').val('');
            $('#password').attr('placeholder', '');
            $('#password').attr('required', true);
            $('#modalGuru').modal('show');
        });

        // Edit Guru
        $(document).on('click', '.btnEditGuru', function() {
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            let username = $(this).data('username');
            let cabang = $(this).data('cabang');

            $('#modalGuru .modal-title').text('Edit Guru');
            $('#formGuru').attr('action', "<?= base_url('admin/guru/update') ?>/" + id);
            $('#guru_id').val(id);
            $('#nama').val(nama);
            $('#username').val(username);
            $('#cabang').val(cabang);
            $('#password').val('');
            $('#password').attr('placeholder', 'Kosongkan jika tidak diubah');
            $('#password').removeAttr('required');
            $('#modalGuru').modal('show');
        });

        // Delete confirmation
        $(document).on('submit', '.formDelete', function(e) {
            e.preventDefault();
            let form = this;

            Swal.fire({
                title: 'Yakin?',
                text: "Data guru akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
<?php $this->endSection(); ?>
