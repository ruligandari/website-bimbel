<?php $this->extend('templates/template'); ?>

<?php $this->section('styles'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<style>
    #tableSiswa td,
    #tableSiswa th {
        font-size: 13px;
        white-space: normal;
        word-break: break-word;
    }
</style>

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
                <h5 class="card-title fw-semibold">Data Siswa</h5>
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnTambahSiswa">Tambah Siswa</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle" id="tableSiswa">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($siswas as $siswa): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($siswa['nama']) ?></td>
                                    <td><?= esc($siswa['username']) ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-success btnEditSiswa"
                                                data-id="<?= $siswa['id'] ?>"
                                                data-nama="<?= esc($siswa['nama']) ?>"
                                                data-username="<?= esc($siswa['username']) ?>">
                                                <i class="ti ti-pencil"></i>
                                            </a>
                                            <form action="<?= base_url('admin/siswa/delete/' . $siswa['id']) ?>" method="post" class="d-inline formDelete">
                                                <input type="hidden" name="_method" value="DELETE">
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
<div class="modal fade" id="modalSiswa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formSiswa" method="post" action="<?= base_url('admin/siswa/store') ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="siswa_id">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
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
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        let table = $('#tableSiswa').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export Excel',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            body: (data) => $(data).text().trim()
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Export PDF',
                    className: 'btn btn-danger btn-sm',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            body: (data) => $(data).text().trim()
                        }
                    }
                }
            ]
        });

        // Tambah Siswa
        $('#btnTambahSiswa').on('click', function() {
            $('#modalSiswa .modal-title').text('Tambah Siswa');
            $('#formSiswa').attr('action', "<?= base_url('admin/siswa/store') ?>");
            $('#siswa_id').val('');
            $('#nama').val('');
            $('#username').val('');
            $('#password').val('');
            $('#password').attr('placeholder', '');
            $('#modalSiswa').modal('show');
        });

        // Edit Siswa
        $(document).on('click', '.btnEditSiswa', function() {
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            let username = $(this).data('username');

            $('#modalSiswa .modal-title').text('Edit Siswa');
            $('#formSiswa').attr('action', "<?= base_url('admin/siswa/update') ?>/" + id);
            $('#siswa_id').val(id);
            $('#nama').val(nama);
            $('#username').val(username);
            $('#password').val('');
            // hint password kosong kalau gak diubah
            $('#password').attr('placeholder', 'Kosongkan jika tidak diubah');
            $('#modalSiswa').modal('show');
        });

        $(document).on('submit', '.formDelete', function(e) {
            e.preventDefault(); // cegah submit langsung

            let form = this;

            Swal.fire({
                title: 'Yakin?',
                text: "Data siswa akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submit manual kalau user klik "Ya"
                }
            });
        });

    });
</script>
<?php $this->endSection(); ?>