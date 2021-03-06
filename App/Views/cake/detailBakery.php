<div class="container detail">
  <p hidden id="idCake"><?= $data["cakeID"]["id"] ?></p>
  <h3 class="detail-title">Detail</h3>
  <div class="cake-detail">
    <div class="cake-detail-img">
      <div class="img1">
        <img src="<?= PUB ?>/img/cakes/<?= $data["cakeID"]["image"] ?>" alt="" class="current-img" />
      </div>
      <div class="img-diff">
        <?php if ($data["image"] != []) : ?>
          <?php foreach ($data["image"] as $index => $value) : ?>
            <img src="<?= PUB ?>/img/cakes/<?= $value["image"] ?>" alt="" class="" />
          <?php endforeach ?>
        <?php endif ?>
      </div>
    </div>
    <div class="cake-detail-content">
      <h6 class="Best-seller-name"><?= $data["cakeID"]["name"] ?></h6>
      <p class="cake-detail-content-id"><b>Type:</b> <?= $data["type"] ?>.</p>
      <p class="cake-detail-content-id"><b>Size:</b> <?= $data["cakeID"]["size"] ?>.</p>

      <p class="cake-detail-content-id"><b>Description:</b></p>
      <p class="Best-seller-title">
        <?= $data["cakeID"]["description"] ?>
      </p>
      <p class="new-price"><?= number_format($data["cakeID"]["price"]) ?> VND</p>
      <button onclick="addToCart(<?= $data['cakeID']['id'] ?>,<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?>)" class="btn btn--primary">Add to cart +</button>
    </div>
  </div>
</div>
<div class="container">
  <h3 class="detail-title">Product Reviews</h3>
  <div class="comment">
    <div class="comment-list">
      <?php if ($data["comments"] != []) : ?>
        <?php foreach ($data["comments"] as $index => $value) : ?>
          <div class="comment-user">
            <img src="<?= PUB ?>/upload/userAvatar/<?= $data[$value['id']]["avatar"] ?>" alt="" class="comment-img-user" />
            <div class="comment-item">
              <div class="comment-content">
                <p class="comment-name"><?= $data[$value['id']]["name"] ?></p>
                <p class="comment-content-value"><?= $value["comment"] ?></p>
              </div>
              <p class="comment-time">
                <?php if (!isset($_SESSION["user"])) : ?>
                  <i class="fas fa-thumbs-up"></i>
                  <span id="like"><?= $value["likes"] ?></span>
                  <span id="time"><?= $data['time'][$value["id"]] ?> </span>
                  <i class="far fa-clock"></i>
                <?php else : ?>
                  <?php if ($data["like"][$value["id"]] == 1) : ?>
                    <i class="fas fa-thumbs-up like-active comment-cursor" id="icon-like+<?= $value['id'] ?>" onclick="changeState(<?= $value['id'] ?>)"></i>
                  <?php else : ?>
                    <i class="fas fa-thumbs-up comment-cursor" id="icon-like+<?= $value['id'] ?>" onclick="changeState(<?= $value['id'] ?>)"></i>
                  <?php endif ?>
                  <span id="like+<?= $value['id'] ?>"><?= $value["likes"] ?></span>
                  <span id="time+<?= $value['id'] ?>"> <?= $data['time'][$value["id"]] ?> </span>
                  <abbr title="GMT+7"><i class="far fa-clock comment-cursor"></i></abbr>
                <?php endif ?>
              </p>
            </div>
          </div>
        <?php endforeach ?>
      <?php else : ?>
        <p class="cart2-title" id="no-comment">No comments</p>
      <?php endif ?>
    </div>
    <?php if (isset($_SESSION["user"])) : ?>
      <p hidden id="comment-name"><?= $_SESSION["user"]["name"] ?></p>
      <div class="comment-add">
        <img src="<?= PUB ?>/upload/userAvatar/<?= $_SESSION["user"]["avatar"] ?>" alt="" class="comment-img-user" id="comment-img-user" />
        <div class="comment-add-input">
          <input type="text" id="comment-add" placeholder="Add your comment . . ." />
          <button class="comment-btn" onclick="addComment()">Send</button>
        </div>
      </div>
    <?php endif ?>
  </div>
</div>
<script>
  var images = document.querySelector(".img-diff").children;
  images[0].classList.add("active-img");
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
    // if (currentBorder == null) {
    //   images[num].classList.add("active-img");
    //   currentBorder = images[num];
    // }
    currentBorder.classList.remove("active-img");
    images[num].classList.add("active-img");
  }
</script>