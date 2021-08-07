<div class="container detail">
  <h3 class="detail-title">Detail</h3>
  <div class="cake-detail">
    <div class="cake-detail-img">
      <div class="img1">
        <img src="<?= PUB ?>/img/cakes/<?= $data["cakeID"]["image"] ?>" alt="" class="current-img" />
      </div>
      <div class="img-diff">
        <img src="<?= PUB ?>/img/cakes/2.3.jpg" alt="" class="" />
        <img src="<?= PUB ?>/img/cakes/1.3.jpg" alt="" />
        <img src="<?= PUB ?>/img/cakes/5.1.jpg" alt="" />
        <img src="<?= PUB ?>/img/cakes/2.3.jpg" alt="" class="" />
        <img src="<?= PUB ?>/img/cakes/1.3.jpg" alt="" />
        <img src="<?= PUB ?>/img/cakes/5.1.jpg" alt="" />
      </div>
    </div>
    <div class="cake-detail-content">
      <h6 class="Best-seller-name">Blue bery Mousse</h6>
      <p class="cake-detail-content-id"><b> Mã SP:</b> <?= $data["cakeID"]["id_cake_type"] ?></p>
      <p class="cake-detail-content-id"><b> Loại:</b> Fruits</p>
      <p class="cake-detail-content-id"><b> Kích cỡ:</b><?= $data["cakeID"]["size"] ?></p>
      <p class="cake-detail-content-id"><b>Mô tả:</b></p>
      <p class="Best-seller-title">
        <?= $data["cakeID"]["description"] ?>
      </p>
      <p class="new-price"><?= number_format($data["cakeID"]["price"]) ?> VND</p>
      <button class="btn btn--primary">Add to cart +</button>
    </div>
  </div>
</div>
<script>
  var images = document.querySelector(".img-diff").children;
  for (let index = 0; index < images.length; index++) {
    images[index].onclick = function(e) {
      let src = e.target.getAttribute("src");
      let currentImg = document.querySelector(".current-img");
      currentImg.setAttribute("src", src);
      createBorder(index);
    };
  }

  function createBorder(num) {
    var currentBorder = document.querySelector(".active-img");
    if (currentBorder == null) {
      images[num].classList.add("active-img");
      currentBorder = images[num];
    }
    currentBorder.classList.remove("active-img");
    images[num].classList.add("active-img");
  }
</script>