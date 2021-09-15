<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cakes Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/home">Home</a></li>
                    <li class="breadcrumb-item active">Cakes manage</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php require_once(VIEW . "/admin/shared/notification.php") ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">All cakes bakery</h3>
                            <a href="<?= DOCUMENT_ROOT ?>/admin/cakes/create"><button class="btn btn-primary ">Add cake</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Cake</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["cake"] as $index => $value) : ?>
                                    <tr>
                                        <td><?= $value["id"] ?></td>
                                        <td><?= $value["name"] ?> </td>
                                        <td><?= number_format($value["price"]) ?> VND</td>
                                        <td><?= $value["size"] ?></td>
                                        <td><img style="max-width: 80px;" class="rounded" src="<?= PUB ?>/img/cakes/<?= $value["image"] ?>" alt=""></td>
                                        <td class="project-actions text-center">
                                            <a class="btn btn-info btn-sm mb-1" href="<?= DOCUMENT_ROOT ?>/admin/Cakes/edit/<?= $value["id"] ?>">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <br>
                                            <button class="btn btn-danger btn-sm mb-1 " data-toggle="modal" data-target="#deleteModal<?= $value["id"] ?>">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?= $value["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete cake</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure that you want to remove this item?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <a href="<?= DOCUMENT_ROOT ?>/admin/Cakes/delete/<?= $value["id"] ?>" class=" btn btn-primary">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID Cake</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>