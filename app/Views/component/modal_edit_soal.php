<div class="modal fade" id="modalEditSoal" tabindex="-1" aria-labelledby="modalEditSoalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formEditSoal" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditSoalLabel">Edit Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" name="kategori_id" id="edit_kategori_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategoris as $kategori): ?>
                                <option value="<?= $kategori['id'] ?>"><?= $kategori['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Level -->
                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select class="form-select" name="level" id="edit_level" required>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                            <option value="4">Level 4</option>
                        </select>
                    </div>

                    <!-- Soal -->
                    <div class="mb-3">
                        <label class="form-label">Soal</label>
                        <textarea class="form-control" name="soal" id="edit_soal" rows="3" required></textarea>
                    </div>

                    <!-- Foto -->
                    <div class="mb-3">
                        <label class="form-label">Gambar (Opsional)</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <div id="previewFoto" class="mt-2"></div>
                    </div>

                    <!-- Pilihan -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilihan A</label>
                            <input type="text" class="form-control" name="pilihan_a" id="edit_a" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilihan B</label>
                            <input type="text" class="form-control" name="pilihan_b" id="edit_b" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilihan C</label>
                            <input type="text" class="form-control" name="pilihan_c" id="edit_c" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilihan D</label>
                            <input type="text" class="form-control" name="pilihan_d" id="edit_d" required>
                        </div>
                    </div>

                    <!-- Jawaban -->
                    <div class="mb-3">
                        <label class="form-label">Jawaban Benar</label>
                        <select class="form-select" name="jawaban" id="edit_jawaban" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>

                    <!-- Nilai -->
                    <div class="mb-3">
                        <label class="form-label">Nilai</label>
                        <input type="number" class="form-control" name="bobot_nilai" id="edit_nilai" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>