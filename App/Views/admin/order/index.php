<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Orders Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/home">Home</a></li>
                    <li class="breadcrumb-item active">Category manage</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div id="alert"></div>
<?php require_once(VIEW . "/admin/shared/notification.php") ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">All category bakery</h3>
                            <a href="<?= DOCUMENT_ROOT ?>/admin/orders/create"><button class="btn btn-primary ">Create new order</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID order</th>
                                    <th>Customer</th>
                                    <th>Order day</th>
                                    <th>Delivery day</th>
                                    <th>status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["orders"] as $index => $value) : ?>
                                    <tr>
                                        <td><?= $value["id"] ?></td>
                                        <td><?= $data["user"][$value["id"]]["name"] ?> </td>
                                        <td><?= $value["order_date"] ?> </td>
                                        <td><?= $value["delivery_date"] ?> </td>
                                        <td>
                                            <select name="status" class="form-control custom-select" onchange="changeStatus(<?= $value['id'] ?>,this)">
                                                <?php foreach ($data["stt"] as $key => $amount) : ?>
                                                    <option value="<?= $amount["id"] ?>" <?= $amount["id"] == $value["id_status"] ? "selected" : "" ?>>
                                                        <?= $amount["name"] ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </td>
                                        <td><?= number_format($value["total"]) ?>đ </td>
                                        <td class="project-actions text-center">
                                            <a class="btn btn-info btn-sm mb-1" href="<?= DOCUMENT_ROOT ?>/admin/orders/edit/<?= $value["id"] ?>">
                                                <i class="fas fa-info-circle"></i> Details
                                            </a>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure that you want to remove this item?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <a href="<?= DOCUMENT_ROOT ?>/admin/Orders/delete/<?= $value["id"] ?>" class=" btn btn-primary">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID order</th>
                                    <th>Customer</th>
                                    <th>Order day</th>
                                    <th>Delivery day</th>
                                    <th>status</th>
                                    <th>Total</th>
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
<script>
    function changeStatus(id, ops) {
        var option = ops.options[ops.selectedIndex].value;
        var noti = document.getElementById("alert");
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                if (obj == true) {
                    if (noti.children[0] == undefined) {
                        var text = document.createElement("div");
                        text.classList.add("col");
                        text.innerHTML = ` <div class="alert alert-success  alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Success ! </strong> Updated successfully.
                            </div>`
                        noti.appendChild(text);
                    } else {
                        noti.removeChild(noti.children[0]);
                        var text = document.createElement("div");
                        text.classList.add("col");
                        text.innerHTML = ` <div class="alert alert-success  alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Success ! </strong> Updated successfully.
                            </div>`
                        noti.appendChild(text);
                    }
                } else {
                    var text = document.createElement("div");
                    text.classList.add("col");
                    text.innerHTML = ` <div class="alert alert-warning  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success ! </strong> Updated unsuccessfully.
                        </div>`
                    noti.appendChild(text);
                }
            }
        };
        xhttp.open(
            "GET", `<?= DOCUMENT_ROOT ?>/admin/Orders/updateState?id=${id}&value=${option}`,
            true
        );
        xhttp.send();
    }
</script>