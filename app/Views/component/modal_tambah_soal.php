<div class="modal fade" id="modalTambahSoal" tabindex="-1" aria-labelledby="modalTambahSoalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/soal/store') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahSoalLabel">Tambah Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori Soal</label>
                        <select class="form-select" name="kategori_id" id="kategori_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategoris as $kategori): ?>
                                <option value="<?= $kategori['id'] ?>"><?= $kategori['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Level (wajib pilih) -->
                    <div class="mb-3">
                        <label for="level" class="form-label">Level Soal</label>
                        <select class="form-select" name="level" id="level" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                            <option value="4">Level 4</option>
                        </select>
                    </div>

                    <!-- Soal -->
                    <div class="mb-3">
                        <label for="soal" class="form-label">Soal</label>
                        <textarea class="form-control" name="soal" id="soal" rows="3" required></textarea>
                    </div>

                    <!-- upload gambar opsional -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">Gambar (Opsional)</label>
                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                        <div class="form-text">Kosongkan jika soal tidak membutuhkan gambar.</div>
                    </div>

                    <!-- Pilihan -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pilihan_a" class="form-label">Pilihan A</label>
                            <input type="text" class="form-control" name="pilihan_a" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pilihan_b" class="form-label">Pilihan B</label>
                            <input type="text" class="form-control" name="pilihan_b" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pilihan_c" class="form-label">Pilihan C</label>
                            <input type="text" class="form-control" name="pilihan_c" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pilihan_d" class="form-label">Pilihan D</label>
                            <input type="text" class="form-control" name="pilihan_d" required>
                        </div>
                    </div>

                    <!-- Jawaban -->
                    <div class="mb-3">
                        <label for="jawaban" class="form-label">Jawaban Benar</label>
                        <select name="jawaban" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>

                    <!-- Bobot Nilai -->
                    <div class="mb-3">
                        <label for="bobot_nilai" class="form-label">Nilai</label>
                        <input type="number" class="form-control" name="bobot_nilai" required>
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