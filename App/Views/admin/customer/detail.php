<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Information</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/customers">Mange customers</a></li>
                    <li class="breadcrumb-item active">Information customer</li>
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
                        <h3 class="card-title">Customer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input disabled name="name" type="text" class="form-control" id="name" value="<?= $data["user"]["name"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input disabled name="phone" type="text" class="form-control" id="phone" value="<?= $data["user"]["phone"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input disabled name="address" type="text" class="form-control" id="address" value="<?= $data["user"]["address"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input disabled name="email" type="text" class="form-control" id="email" value="<?= $data["user"]["email"] ?>">
                        </div>
                        <?php if ($data["order"] != []) : ?>
                            <div class="form-group">
                                <label>All bills: <?= count($data["order"]) ?></label>
                                <?php foreach ($data["order"] as $index => $value) : ?>
                                    <div class="mb-3 border-bottom">
                                        <label> #<?= $value["id"] ?></label>
                                        <?php foreach ($data["order_detail"][$value["id"]] as $count => $item) : ?>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <img style="max-width: 100px;" src="<?= PUB ?>/img/cakes/<?= $data["cake_detail"][$value["id"]][$item["id_cake"]]["image"] ?>" alt="" class="rounded">
                                                </div>
                                                <div class="col-sm-9">
                                                    <div> <span class="text-info">Name: </span>
                                                        <?= $data["cake_detail"][$value["id"]][$item["id_cake"]]["name"] ?>.
                                                    </div>
                                                    <div> <span class="text-info">Price: </span>
                                                        <?= number_format($data["cake_detail"][$value["id"]][$item["id_cake"]]["price"]) ?> VND.
                                                    </div>
                                                    <div> <span class="text-info">price sale: </span>
                                                        <?= number_format($data["cake_detail"][$value["id"]][$item["id_cake"]]["sale"]) ?> VND.
                                                        <div><span class="text-info">Quantity: </span>
                                                            <?= $item["amount"] ?>.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                        <div class="row-sm-3">
                                            <div> <span class="text-primary">Order day: </span>
                                                <?= $value["order_date"] ?>.
                                            </div>
                                            <div> <span class="text-primary">Status: </span>
                                                <?= $data["status"][$value["id"]] ?>.
                                            </div>
                                            <div> <span class="text-danger">Total: </span>
                                                <?= number_format($value["total"]) ?> VND.
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <a href="<?= DOCUMENT_ROOT ?>/admin/Customers" class=" btn btn-secondary">Exit</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>