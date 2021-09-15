<div class="login-page">
    <div class="login-box">
        <div class="card ">
            <div class="card-body login-card-body">
                <div class="login-logo text-danger border-bottom">
                    <b>Greek's Bakery Admin</b>
                </div>
                <p class="text-center text-dark"> Log in with your account administrator to access the site management. <i class="fas fa-sign-in-alt"></i></p>

                <form action="<?= DOCUMENT_ROOT ?>/admin/Login/checkAdmin" method="POST">
                    <div class="form-group mb-3">
                        <label for="admin">ID Admin</label>
                        <input required name="admin" id="admin" type="text" class="form-control" placeholder="Example">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input required name="password" id="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <p class="text-center mt-2 text-primary">Login to start your session now.</p>
                    <div class="row">
                        <div class="col">
                            <input type="submit" name="submit" type="submit" class="btn btn-primary btn-block" value="Sign In">
                        </div>
                        <!-- /.col -->
                    </div>
                    <?php if (isset($_SESSION["messAdmin"])) : ?>
                        <p class="login-box-msg mt-3 text-danger"><?= $_SESSION["messAdmin"] ?>.</p>
                        <?php unset($_SESSION["messAdmin"]) ?>
                    <?php endif ?>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>