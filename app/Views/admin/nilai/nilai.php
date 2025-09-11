<?php $this->extend('templates/template'); ?>

<?php $this->section('styles'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.css" />

<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<style>
    #tableNilai td,
    #tableNilai th {
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <!-- tambahkan button create soal, posisi saling berjauhan dengan title -->
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold">Data Nilai</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-striped align-middle" id="tableNilai">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    Id
                                </th>
                                <th class="border-bottom-0">
                                    Siswa
                                </th>
                                <th class="border-bottom-0">
                                    Nilai Numerik
                                </th>
                                <th class="border-bottom-0">
                                    Nilai Color
                                </th>
                                <th class="border-bottom-0">
                                    Nilai Greeting
                                </th>
                                <th class="border-bottom-0">
                                    Nilai Family
                                </th>
                                <th class="border-bottom-0">
                                    Total Nilai
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($nilais as $nilai): ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <p class="fw-normal mb-0"><?= $no++ ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="fw-semibold mb-1">
                                            <?= $nilai['nama'] ?>
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $nilai['nilai_numerik'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $nilai['nilai_color'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $nilai['nilai_greeting'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $nilai['nilai_family'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $nilai['total_nilai'] ?></p>
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
<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#tableNilai').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="ti ti-file-spreadsheet"></i> Export Excel',
                className: 'btn btn-success btn-sm',
                exportOptions: {
                    columns: ':visible',
                    format: {
                        body: function(data, row, column, node) {
                            // ambil teks murni dari HTML cell
                            return $(data).text().trim();
                        }
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="ti ti-file-text"></i> Export PDF',
                className: 'btn btn-danger btn-sm',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: ':visible',
                    format: {
                        body: function(data, row, column, node) {
                            return $(data).text().trim();
                        }
                    }
                }
            }
        ]
    });
</script>
<?php $this->endSection(); ?>