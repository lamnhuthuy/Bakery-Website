<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/categories">Mange categories</a></li>
                    <li class="breadcrumb-item active">Update category</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php require_once(VIEW . "/admin/shared/notification.php") ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update category item</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= DOCUMENT_ROOT ?>/admin/Categories/update/<?= $data["category"]["id"] ?>" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required name="name" type="text" class="form-control" id="name" value="<?= $data["category"]["name"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="7"><?= $data["category"]["description"] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pic1">Picture 1</label>
                                <div class="input-group d-flex align-items-center">
                                    <?php if ($data["category"]['image'] != "") : ?>
                                        <img src="<?= PUB . '/img/categories/' . $data["category"]['image'] ?>" style="max-width: 200px;" class="rounded" alt="Image category">
                                        <div class="custom-file" style="margin-left: 20px;">
                                            <input type="file" id="pic1" name="image">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="<?= DOCUMENT_ROOT ?>/admin/Categories" class=" btn btn-secondary">Cancel</a>
                                <input type="submit" value="Save" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>