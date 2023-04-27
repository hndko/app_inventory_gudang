<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('_includes/head') ?>
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