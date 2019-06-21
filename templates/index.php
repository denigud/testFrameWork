<?php include __DIR__ . '/header.php'

 ?>

<div class="alert alert-info" role="alert">

    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a href="<?= App\Router::getFull('Home') ?>" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Home</a>
            <a href="<?= App\Router::getFull('About')?>" class="btn btn-secondary btn-lg" role="button" aria-disabled="true">About</a>
            <a href="<?= App\Router::getFull('Text', ['page'=>5])?>" class="btn btn-secondary btn-lg" role="button" aria-disabled="true">Page 5</a>
        </form>
    </nav>

    <?= $this->param ?>
</div>

<?php include __DIR__ . '/footer.php'?>
