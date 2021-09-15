<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/orders">Mange orders</a></li>
                    <li class="breadcrumb-item active">Create order</li>
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
                        <h3 class="card-title">Create new order</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= DOCUMENT_ROOT ?>/admin/orders/store" method="POST" onsubmit="return checksumit()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user">ID User</label>
                                <input required name="user" type="text" class="form-control" id="user" onchange="ajaxGetUser(this.value)">
                                <div id="messErrorUser" class="text-danger mb-1">

                                </div>
                                <div class="form-group">
                                    <label for="order-date">Order date:</label>
                                    <input required name="order-date" type="date" class="form-control" id="order-date" onchange="validateDate()">
                                </div>
                                <div class="form-group">
                                    <label for="delivery-date">Delivery date:</label>
                                    <input required name="delivery-date" type="date" class="form-control" id="delivery-date" onchange="validateDate()">
                                    <div id="messError" class="text-danger mb-1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control custom-select" required>
                                        <option value="" selected disabled>Select one</option>
                                        <?php foreach ($data["stt"] as $key => $amount) : ?>
                                            <option value="<?= $amount["id"] ?>">
                                                <?= $amount["name"] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= DOCUMENT_ROOT ?>/admin/Orders" class=" btn btn-secondary">Cancel</a>
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
<script>
    function ajaxGetUser(id) {
        var mess = document.getElementById("messErrorUser");
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                console.log(obj);
                if (obj == false) {
                    mess.innerHTML = "Can't found customer where id = " + id + " !";
                } else mess.innerHTML = "";
            }
        };
        xhttp.open(
            "GET", `<?= DOCUMENT_ROOT ?>/admin/Orders/getUser?id=${id}`,
            true
        );
        xhttp.send();
    }

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

    function checksumit() {
        var res1 = validateDate();
        var mess = document.getElementById("messErrorUser");
        if (res1 && (mess.innerHTML == "")) {
            return true;
        } else return false
    }
</script>