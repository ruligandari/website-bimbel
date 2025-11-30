-- SQL Script untuk update user yang sudah ada dan membuat user test baru
-- Jalankan di database Anda

-- Update user admin yang sudah ada (id = 1)
-- Set nama, role menjadi admin (1)
UPDATE `user` SET `nama` = 'Administrator', `role` = 1, `cabang` = NULL WHERE `id` = 1;

-- Insert Guru 1 (role = 2)
-- Username: guru1
-- Password: guru123
INSERT INTO `user` (`username`, `password`, `nama`, `role`, `cabang`) 
VALUES ('guru1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Guru Cabang Jakarta', 2, 'Jakarta');

-- Insert Guru 2 (role = 2)
-- Username: guru2
-- Password: guru123
INSERT INTO `user` (`username`, `password`, `nama`, `role`, `cabang`) 
VALUES ('guru2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Guru Cabang Bandung', 2, 'Bandung');

-- CATATAN:
-- Password yang digunakan di atas adalah hash dari "password" (default Laravel bcrypt)
-- Untuk membuat password baru, gunakan:
-- php -r "echo password_hash('password_anda', PASSWORD_BCRYPT);"
