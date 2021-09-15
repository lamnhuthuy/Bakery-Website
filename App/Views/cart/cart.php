<div class="container">
  <p hidden> <?= DOCUMENT_ROOT ?></p>
  <h3 class="detail-title">Cart</h3>
  <form class="cart-control" action="<?= DOCUMENT_ROOT ?>/Cart/checkOut" method="POST" onsubmit="return checkOutCart()">
    <div class="cart1">
      <?php if (!isset($_SESSION["user"])) : ?>
        <p class="cart-error">Your cart is empty !</p>
        <p class="cart-error">Please Login to buy.</p>
      <?php else : ?>
        <?php if ($data["amount"] == 0) : ?>
          <p class="cart-error">Your cart is empty !</p>
        <?php else : ?>
          <?php foreach ($data["cake"] as $index => $value) : ?>
            <div id="product+<?= $value["id"] ?>" class="cart1-conatain">
              <input type="hidden" id="price+<?= $index ?>" value="<?= $value["sale"] ?>">
              <img src="<?= PUB ?>/img/cakes/<?= $value["image"] ?>" alt="" class="cart1-conatain-img" />
              <div class="cart-detail">
                <p class="cart-detail-name"><?= $value["name"] ?>.</p>
                <p class="cart-detail-name">Size: <?= $value["size"] ?>.</p>
                <p style="text-decoration: line-through;" class="cart-detail-name cart-detail-name-color">
                  Price: <span><?= number_format($value["price"]) ?>
                  </span>
                  VND
                </p>
                <p class="cart-detail-name cart-detail-name-color">
                  Price sale: <span><?= number_format($value["sale"]) ?>
                  </span>
                  VND
                </p>
                <label for="amount+<?= $index ?>">Quantity:</label>
                <input type="number" name="" value="<?= $data["amountCake"][$index] ?>" id="amount+<?= $index ?>" min="1" max="99" onchange="onchangetotal(<?= $value['id'] ?>,<?= $_SESSION['user']['id'] ?>,this.value)" />
              </div>
              <div class="cart1-delete" onclick="deleteProduct(<?= $value['id'] ?>,<?= $_SESSION['user']['id'] ?>)">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 92.132 92.132" style="enable-background: new 0 0 92.132 92.132" xml:space="preserve">
                  <g>
                    <g>
                      <path fill="#f3455a" d="M2.141,89.13c1.425,1.429,3.299,2.142,5.167,2.142c1.869,0,3.742-0.713,5.167-2.142l33.591-33.592L79.657,89.13
                c1.426,1.429,3.299,2.142,5.167,2.142c1.867,0,3.74-0.713,5.167-2.142c2.854-2.854,2.854-7.48,0-10.334L56.398,45.205
               l31.869-31.869c2.855-2.853,2.855-7.481,0-10.334c-2.853-2.855-7.479-2.855-10.334,0L46.065,34.87L14.198,3.001
                c-2.854-2.855-7.481-2.855-10.333,0c-2.855,2.853-2.855,7.481,0,10.334l31.868,31.869L2.143,78.795
               C-0.714,81.648-0.714,86.274,2.141,89.13z"></path>
                    </g>
                  </g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                </svg>
              </div>
            </div>
          <?php endforeach ?>
        <?php endif ?>
      <?php endif ?>

    </div>
    <div class="cart2">
      <p class="cart2-title">Delivery Information</p>
      <?php if (!isset($_SESSION["user"])) : ?>
        <p class="cart-error">You are not logged in. </p>
        <p class="cart-error">Please login to order!</p>
      <?php else : ?>
        <div class="cart2-user">
          <p class="cart2-user-name">User name:</p>
          <p><?= $_SESSION["user"]["name"] ?>.</p>
        </div>
        <div class="cart2-user">
          <p class="cart2-user-name">Phone:</p>
          <p><?= $_SESSION["user"]["phone"] ?>.</p>
        </div>
        <p class="cart2-user-name cart2-user-name-margin">Address:</p>
        <p class="cart2-user-name cart2-user-name-margin">
          <?= $_SESSION["user"]["address"] ?> .
        </p>
        <p class="cart2-user-name cart2-user-name-margin">
          Total:
          <span id="total"><?= number_format($data["total"], 0) ?> VND</span>
        </p>
        <input type="submit" class="btn btn--primary" value="Check Out">
      <?php endif ?>

    </div>
  </form>
</div>
<script>
  function onchangetotal(cakeID, userID, amount) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var obj = JSON.parse(this.responseText);
        var total = document.getElementById("total");
        total.innerText = new Intl.NumberFormat().format(obj) + " VND";
      }
    };
    xhttp.open("POST", "<?= DOCUMENT_ROOT . "/Cart/updateCart" ?>");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id_cake=${cakeID}&id_user=${userID}&amount=${amount}`);
  }

  function deleteProduct(cakeID, userID) {
    var contain = document.getElementById("product+" +
      cakeID);
    contain.classList.add("opacity");
    contain.addEventListener("transitionend", (e) => {
      e.target.style.display = "none";
    })
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var obj = JSON.parse(this.responseText);
        refreshCartNumber(obj.amount);
        var total = document.getElementById("total");
        total.innerText = new Intl.NumberFormat().format(obj.total) + " VND";
      }
    };
    xhttp.open("POST", "<?= DOCUMENT_ROOT . "/Cart/deleteCart" ?>");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id_cake=${cakeID}&id_user=${userID}`);
  }

  function checkOutCart() {
    var rs = confirm("Are you sure to buy cake at Greek's Bakery ?");
    if (rs == true) {
      return true;
    } else return false;
  }
</script>