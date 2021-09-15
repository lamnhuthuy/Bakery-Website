<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/cakes">Mange cake</a></li>
                    <li class="breadcrumb-item active">Update cake</li>
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
                        <h3 class="card-title">Update cake</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= DOCUMENT_ROOT ?>/admin/Cakes/update/<?= $data["cake"]["id"] ?>" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="type">Category cake</label>
                                <select class="form-control" name="category" id="type">
                                    <?php foreach ($data["category"] as $index => $value) : ?>
                                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $data['cake']['id_cake_type'] ? "selected" : "" ?>><?= $value['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input value="<?= $data["cake"]["name"] ?>" type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input value="<?= number_format($data["cake"]["price"]) ?> VND" type="text" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="sale">Sale</label>
                                <input required type="text" class="form-control" id="sale" name="sale" value="<?= $data["cake"]["sale"] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="size">Size</label>
                                <input value="<?= $data["cake"]["size"] ?> cm" type="text" class="form-control" id="size" name="size" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="8"><?= $data["cake"]["description"] ?></textarea>

                            </div>
                            <?php foreach ($data["image"] as $index => $value) : ?>
                                <div class="form-group">
                                    <label for="pic<?= $index + 1 ?>">Picture <?= $index + 1 ?></label>
                                    <div class="input-group d-flex align-items-center">
                                        <?php if ($value['image'] == "") : ?>
                                            <div class="custom-file">
                                                <input type="file" id="pic<?= $index + 1 ?>" name="image<?= $index + 1 ?>">
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($value['image'] != "") : ?>
                                            <img src="<?= PUB . '/img/cakes/' . $value['image'] ?>" style="max-width: 200px;" class="rounded" alt="Image cake <?= $value['image'] ?>">
                                            <div class="custom-file" style="margin-left: 20px;">
                                                <input type="file" id="pic<?= $index + 1 ?>" name="image<?= $index + 1 ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= DOCUMENT_ROOT ?>/admin/Cakes" class=" btn btn-secondary">Cancel</a>
                                    <input type="submit" value="Save" class="btn btn-success">
                                </div>
                            </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>