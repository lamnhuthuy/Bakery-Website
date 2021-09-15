<?php if (isset($_SESSION['alert'])) : ?>
    <?php if ($_SESSION['alert']['status'] == 'true') : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> <?= $_SESSION["alert"]["mes"] ?>
        </div>
        <?php unset($_SESSION['alert']); ?>
    <?php elseif ($_SESSION['alert']['status'] == 'false') : ?>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Warning!</strong> <?= $_SESSION["alert"]["mes"] ?>
        </div>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>
<?php endif; ?>