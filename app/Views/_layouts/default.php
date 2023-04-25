<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?= $this->include('_includes/navbar') ?>

        <?= $this->include('_includes/aside') ?>

        <div class="content-wrapper">


            <?= $this->renderSection('content') ?>
        </div>

        <?= $this->include('_includes/footer') ?>
    </div>

    <?= $this->include('_includes/javascript') ?>
</body>

</html>