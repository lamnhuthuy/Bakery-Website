<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/orders">Mange orders</a></li>
                    <li class="breadcrumb-item active">Update order</li>
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
                        <h3 class="card-title">Update order</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= DOCUMENT_ROOT ?>/admin/orders/update/<?= $data["orders"]["id"] ?>" method="POST" onsubmit="return validateDate()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID Order</label>
                                <input disabled name="id" type="text" class="form-control" id="id" value="<?= $data["orders"]["id"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="user">ID User</label>
                                <input disabled name="user" type="text" class="form-control" id="user" value="<?= $data["user"]["id"] ?>">
                                <div>
                                    <span class="text-info">Name: </span>
                                    <?= $data["user"]["name"] ?>.
                                </div>
                                <div>
                                    <span class="text-info">Email: </span>
                                    <?= $data["user"]["email"] ?>.
                                </div>
                                <div>
                                    <span class="text-info">Phone: </span>
                                    <?= $data["user"]["phone"] ?>.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order-date">Order date:</label>
                                <input required name="order-date" type="date" class="form-control" id="order-date" value="<?= $data["orders"]["order_date"] ?>" onchange="validateDate()">
                            </div>
                            <div class="form-group">
                                <label for="delivery-date">Delivery date:</label>
                                <input required name="delivery-date" type="date" class="form-control" id="delivery-date" value="<?= $data["orders"]["delivery_date"] ?>" onchange="validateDate()">
                                <div id="messError" class="text-danger mb-1">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control custom-select">
                                    <?php foreach ($data["stt"] as $key => $amount) : ?>
                                        <option value="<?= $amount["id"] ?>" <?= $amount["id"] == $data["orders"]["id_status"] ? "selected" : "" ?>>
                                            <?= $amount["name"] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <?php if ($data["order_detail"] != false) : ?>
                                <?php foreach ($data["order_detail"] as $index => $value) : ?>
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="id_cake<?= $index ?>">ID cake:</label>
                                                <input required type="text" class="form-control" id="id_cake<?= $index ?>" value="<?= $value["id_cake"] ?> ">
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="amount<?= $index ?>">Amount:</label>
                                                <input required type="number" class="form-control" id="amount<?= $index ?>" value="<?= $value["amount"] ?>" min="1" max="99" onchange="updateTotal(<?= $value['id_order'] ?>,<?= $value['id_cake'] ?>,this.value)">
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex align-items-end justify-content-between">
                                            <div class="form-group">
                                                <button onclick="event.preventDefault()" class="btn btn-danger btn-sm mb-1 " data-toggle="modal" data-target="#deleteModal<?= $value["id_cake"] ?>">
                                                    <i class="fas fa-trash"></i> Delete.
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?= $value["id_cake"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete item</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure that you want to remove this cake in order?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <a href="<?= DOCUMENT_ROOT ?>/admin/Orders/deleteOneProduct/<?= $value["id_order"] ?>/<?= $value["id_cake"] ?>" class=" btn btn-primary">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="price">Total (Auto update):</label>
                                <input required name="price" type="text" class="form-control text-danger" id="price" value="<?= number_format($data["orders"]["total"]) ?> VND">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="<?= DOCUMENT_ROOT ?>/admin/Orders" class=" btn btn-secondary">Cancel</a>
                                <div>
                                    <button onclick="event.preventDefault()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#plusModal">
                                        Plus +
                                    </button>
                                    <input type="submit" value="Save" class="btn btn-success">
                                </div>
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
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="plusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add cake in order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= DOCUMENT_ROOT ?> /admin/orders/plus/<?= $data["orders"]["id"] ?>" method="POST">
                    <div class="form-group">
                        <label for="id">ID cake</label>
                        <input name="id" type="text" class="form-control" id="id">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input max="99" min="1" name="amount" type="number" class="form-control" id="amount">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function validateDate() {
        if (document.getElementById("order-date") && document.getElementById("delivery-date")) {
            var order = new Date(document.getElementById("order-date").value);
            var delivery = new Date(document.getElementById("delivery-date").value);
            if (delivery < order) {
                document.getElementById("messError").innerHTML = " Delivery date must not be less than order date!";
                return false;
            } else {
                document.getElementById("messError").innerHTML = "";
            }
            return true;
        }
    }

    function updateTotal(id_order, id_cake, amount) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                if (obj.mes == true) {
                    var input = document.getElementById("price");
                    input.value = new Intl.NumberFormat().format(parseInt(obj.total)) + " VND";
                }
            }
        };
        xhttp.open(
            "GET", `<?= DOCUMENT_ROOT ?>/admin/Orders/getToTal?id_order=${id_order}&id_cake=${id_cake}&amount=${amount}`,
            true
        );
        xhttp.send();
    }
</script>