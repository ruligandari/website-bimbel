<?php
$this->extend('templates/auth_template');
$this->section('login');
?>
<div
    class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="<?= base_url() ?>/assets/images/logos/logo_bimba.png" width="150" alt="">
                        </a>
                        <p class="text-center">Silahkan Login Untuk Melanjutkan!</p>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger fade show" role="alert">
                                <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url('auth') ?>" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>