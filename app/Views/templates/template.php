<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.min.css" />
    <?= $this->renderSection('styles'); ?>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?= $this->include('component/sidebar') ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?= $this->include('component/header') ?>
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <?= $this->renderSection('content'); ?>
                <!--  Row 1 End -->
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/sidebarmenu.js"></script>
    <script src="<?= base_url() ?>/assets/js/app.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="<?= base_url() ?>/assets/js/dashboard.js"></script>
    <?= $this->renderSection('script'); ?>
</body>

</html>