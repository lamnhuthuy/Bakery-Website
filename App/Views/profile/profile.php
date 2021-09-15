<div class="container">
    <h3 class="detail-title">Profile</h3>
    <form class="profile" action="<?= DOCUMENT_ROOT ?>/Profile/Update" enctype="multipart/form-data" method="POST" onsubmit="return checkUpdateUser()">
        <div class="profile-info">
            <div class="profile-info-name">
                <label for="p-username">User name:</label>
                <input required name="username" type="text" id="p-username" value="<?= $data["user"]["name"] ?>" />
            </div>
            <div class="profile-info-name">
                <label for="p-email">Email:</label>
                <input required name="email" type="email" id="p-email" value="<?= $data["user"]["email"] ?>" onchange="getDataAjax(this.value)" />
            </div>
            <small id="mail-err" style="color: #d93025; font-size:1.3rem"></small>
            <div class="profile-info-name">
                <label for="p-phone">Phone:</label>
                <input required name="phone" type="text" id="p-phone" value="<?= $data["user"]["phone"] ?>" />
            </div>
            <small id="phone-err" style="color: #d93025; font-size:1.3rem"></small>
            <div class="profile-info-name">
                <label for="p-address">Address:</label>
                <input name="address" type="text" id="p-address" value="<?= $data["user"]["address"] ?>" />
            </div>
            <input type="submit" class="btn btn--primary" value="Save">
        </div>
        <div class="profile-image">
            <div class="profile-overlay"></div>
            <p class="cart2-title">Avatar Customer</p>
            <div class="profile-image-cover">
                <label for="p-img">
                    <img src="<?= PUB ?>/upload/userAvatar/<?= $data["user"]["avatar"] ?>" alt="" id="profile-image" />
                </label>
                <label for="p-img">
                    <div class="profile-camera">
                        <i class="fas fa-camera"></i>
                    </div>
                </label>
            </div>
            <p class="profile-image-name"><?= $data["user"]["name"] ?></p>
            <label for="p-img" class="btn btn--primary">Upload image</label>
            <input name="avatar" type="file" id="p-img" onchange="readURL(this)" />
        </div>
    </form>
    <h3 class="detail-title">History</h3>
    <div class="history">
        <div class="history-list">
            <?php if ($data["order"] !== []) : ?>
                <?php foreach ($data["order"] as $index => $value) : ?>
                    <div class="history-list-item">
                        <p class="cart2-title cart2-title-border">Bill ID: #<?= $value["id"] ?></p>
                        <div class="history-item-all">
                            <?php foreach ($data["order_detail"][$value["id"]] as $count => $item) : ?>
                                <div class="history-list-item-content">
                                    <img src="<?= PUB ?>/img/cakes/<?= $data["cake_detail"][$value["id"]][$item["id_cake"]]["image"] ?>" alt="" class="cart1-conatain-img" />
                                    <div class="cart-detail">
                                        <p class="cart-detail-name history-item-title">
                                            <?= $data["cake_detail"][$value["id"]][$item["id_cake"]]["name"] ?>
                                        </p>
                                        <p class="cart-detail-name history-item-title">Size: <?= $data["cake_detail"][$value["id"]][$item["id_cake"]]["size"] ?> cm</p>
                                        <p style="text-decoration: line-through;" class="
                                 cart-detail-name 
                                 history-item-title
                                    ">
                                            Price: <?= number_format($data["cake_detail"][$value["id"]][$item["id_cake"]]["price"]) ?> VND
                                        </p>
                                        <p class="
                                 cart-detail-name cart-detail-name-color
                                 history-item-title
                                    ">
                                            Price sale: <?= number_format($data["cake_detail"][$value["id"]][$item["id_cake"]]["sale"]) ?> VND
                                        </p>
                                        <p class="cart-detail-name history-item-title">Quantity:<?= $item["amount"] ?></p>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            <p class="history-item-all-total">
                                Total:
                                <span class="total"> <?= number_format($value["total"]) ?> VND.</span>
                            </p>
                            <p class="history-item-all-total">
                                Status:
                                <span class="total"><?= $data["status"][$value["id"]] ?>. </span>
                            </p>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <p class="cart2-title">You are not buying.</p>
            <?php endif ?>
        </div>
    </div>
</div>
</body>
<script>
    var img = document.getElementById("profile-image");
    var avt = document.querySelector(".header_user_image img")
    var documentRoot = document.getElementById("documentRoot").innerHTML;

    function readURL(input) {
        if (input.files) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e) {
                img.src = e.target.result;
            };
        }
    }
    // AJAX To Check user defined
    function getDataAjax(str) {
        var documentRoot = document.getElementById("documentRoot").innerHTML;
        var emailSignUp = document.getElementById("p-email");
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                if (emailSignUp.value !== "") {
                    if (obj.email == emailSignUp.value) {
                        document.getElementById("mail-err").innerHTML =
                            '<i class="fas fa-exclamation-triangle"></i> Your email already exists.';
                    } else {
                        document.getElementById("mail-err").innerHTML = "";
                    }
                }
            }
        };
        xhttp.open("POST", documentRoot + "/Account/checkUser");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`email=${str}`);
    }

    function checkPhone(phone) {
        var res = true;
        if (phone.length !== 10) {
            res = '<i class="fas fa-exclamation-triangle"></i> Phone must be have 10 numbers.';
            return res;
        }
        if (phone.charAt(0) !== '0')
            res = '<i class="fas fa-exclamation-triangle"></i> First number is 0.';
        return res;
    }

    function checkUpdateUser() {
        var res = true;
        var phoneVal = document.getElementById("p-phone");
        var phoneMess = document.getElementById("phone-err");
        var phone = checkPhone(phoneVal.value);
        if (phone !== true) {
            phoneMess.innerHTML = phone;
            res = false;
        } else phoneMess.innerHTML = "";
        if (document.getElementById("mail-err").innerHTML !== "") {
            res = false;
        }
        return res;
    }
</script>