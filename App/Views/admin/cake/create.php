<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/cakes">Mange cake</a></li>
                    <li class="breadcrumb-item active">Create cake</li>
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
                        <h3 class="card-title">Create a cake</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= DOCUMENT_ROOT ?>/admin/Cakes/store" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="type">Category cake</label>
                                <select class="form-control custom-select" name="category" id="type" required>
                                    <option disabled selected="" value="">Select one</option>
                                    <?php foreach ($data["category"] as $index => $value) : ?>
                                        <option value="<?= $value["id"] ?>"><?= $value['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required name="name" type="text" class="form-control" id="name" placeholder="For example: Personalised Bday Red Velvet Jar Cakes">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input required type="text" class="form-control" id="price" placeholder="For example: 100,000 VND" name="price">
                            </div>
                            <div class="form-group">
                                <label for="sale">Sale</label>
                                <input type="text" class="form-control" id="sale" placeholder="For example: 89,000 VND" name="sale">
                            </div>
                            <div class="form-group">
                                <label for="size">Size</label>
                                <input required type="text" class="form-control" id="size" placeholder="For example: 20 cm" name="size">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="7"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pic1">Picture 1 (Default image)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input required type="file" id="pic1" name="image1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pic2">Picture 2</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="pic2" name="image2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pic3">Picture 3</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="pic3" name="image3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pic4">Picture 4</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="pic4" name="image4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="<?= DOCUMENT_ROOT ?>/admin/Cakes" class=" btn btn-secondary">Cancel</a>
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