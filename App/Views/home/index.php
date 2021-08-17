<div class="hide-banner">
  <div class="banner">
    <img src="<?= PUB ?>/img/banner/banner.png" alt="" class="banner-img" />
    <img src="<?= PUB ?>/img/banner/banner1.png" alt="" class="banner-img" />
    <img src="<?= PUB ?>/img/banner/banner2.png" alt="" class="banner-img" />
    <img src="<?= PUB ?>/img/banner/banner3.png" alt="" class="banner-img" />
  </div>
</div>

<div class="wrapper">
  <div class="container category">
    <h2 class="title">Experience Flavours</h2>
    <ul>
      <?php foreach ($data["category"] as $index => $value) : ?>
        <li class="category_item">
          <a href="<?= DOCUMENT_ROOT ?>/Category?type=<?= $value["id"] ?>">
            <img src="<?= PUB ?>/img/categories/<?= strtolower(str_replace(" ", "", $value["name"])) ?>.jfif" alt="" />
            <p class="category_name"><?= $value["name"] ?></p>
            <p class="category_title"><?= $value["description"] ?></p>
          </a>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>
<div class="container-fluid best-seller-background">
  <div class="container best-seller">
    <svg width="34" height="35" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg" class="left-arrow">
      <circle cx="17" cy="17.9402" r="16.5" transform="rotate(-180 17 17.9402)" stroke="#848484" />
      <path d="M12.2387 16.935L18.8388 11.1495C19.1571 10.8704 19.6732 10.8704 19.9915 11.1495L20.7613 11.8242C21.079 12.1028 21.0797 12.5543 20.7626 12.8335L15.5319 17.4402L20.7626 22.0469C21.0797 22.3261 21.079 22.7776 20.7613 23.0561L19.9915 23.7309C19.6732 24.0099 19.1571 24.0099 18.8388 23.7309L12.2387 17.9454C11.9204 17.6664 11.9204 17.214 12.2387 16.935Z" fill="#848484" />
    </svg>
    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" class="right-arrow">
      <circle cx="17" cy="17" r="16.5" stroke="#848484" />
      <path d="M21.7613 18.0052L15.1612 23.7907C14.8429 24.0698 14.3268 24.0698 14.0085 23.7907L13.2387 23.1159C12.921 22.8374 12.9203 22.3859 13.2374 22.1067L18.4681 17.5L13.2374 12.8933C12.9203 12.6141 12.921 12.1626 13.2387 11.8841L14.0085 11.2093C14.3268 10.9302 14.8429 10.9302 15.1612 11.2093L21.7613 16.9948C22.0796 17.2738 22.0796 17.7262 21.7613 18.0052Z" fill="#848484" />
    </svg>
    <h2 class="title">Best Seller</h2>
    <div class="content-frame">
      <div class="best-contain">
        <?php foreach ($data["bestSellers"] as $index => $value) : ?>
          <div class="Best-seller-content">
            <img src="<?= PUB ?>/img/cakes/<?= $value["image"] ?>" alt="" />
            <div class="Best-seller-info">
              <h6 class="Best-seller-name"><?= $value["name"] ?></h6>
              <p class="Best-seller-title">
                <?= $value["description"] ?>
              </p>
              <p class="new-price"><?= number_format($value["sale"]) ?> VND</p>
              <p class="old-price"><?= number_format($value["price"]) ?> VND</p>
              <button onclick="addToCart(<?= $value['id'] ?>,<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?>)" class="btn btn--primary">Add to cart +</button>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <div class="pagging">
      <ul>
        <li class="pagging-item pagging-active"></li>
        <li class="pagging-item"></li>
        <li class="pagging-item"></li>
        <li class="pagging-item"></li>
        <li class="pagging-item"></li>
      </ul>
    </div>
  </div>
</div>
<div class="container sweeties">
  <h2 class="title">Sweeties</h2>
  <div class="sweeties-list">
    <ul>
      <?php foreach ($data["cakePerPage"] as $index => $value) : ?>
        <li class="sweeties-item">
          <a href="./Cake/detail/<?= $value["id"] ?>">
            <img src="<?= PUB ?>/img/cakes/<?= $value["image"] ?>" alt="" />
          </a>
          <p class="sweeties_name">
            <?= $value["name"] ?>
          </p>
          <div class="sweeties-prices">
            <span class="sweeties-prices-new"><?= number_format($value["sale"]) ?> VND</span>
            <span class="sweeties-prices-old"><?= number_format($value["price"]) ?>VND</span>
          </div>
          <button onclick="addToCart(<?= $value['id'] ?>,<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?>)" class="btn btn1">Add to cart +</button>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
  <div class="sweeties_pagging">
    <?php if ($data["page"] - 1 <= 0) : ?>
      <svg width="34" height="35" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="17" cy="17.9402" r="16.5" transform="rotate(-180 17 17.9402)" stroke="#848484" />
        <path d="M12.2387 16.935L18.8388 11.1495C19.1571 10.8704 19.6732 10.8704 19.9915 11.1495L20.7613 11.8242C21.079 12.1028 21.0797 12.5543 20.7626 12.8335L15.5319 17.4402L20.7626 22.0469C21.0797 22.3261 21.079 22.7776 20.7613 23.0561L19.9915 23.7309C19.6732 24.0099 19.1571 24.0099 18.8388 23.7309L12.2387 17.9454C11.9204 17.6664 11.9204 17.214 12.2387 16.935Z" fill="#848484" />
      </svg>
    <?php else : ?>
      <a href="<?= DOCUMENT_ROOT ?>?page=<?= $data["page"] - 1 ?>">
        <svg width="34" height="35" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg" class="pagging-arrow">
          <circle cx="17" cy="17.9402" r="16.5" transform="rotate(-180 17 17.9402)" stroke="#848484" />
          <path d="M12.2387 16.935L18.8388 11.1495C19.1571 10.8704 19.6732 10.8704 19.9915 11.1495L20.7613 11.8242C21.079 12.1028 21.0797 12.5543 20.7626 12.8335L15.5319 17.4402L20.7626 22.0469C21.0797 22.3261 21.079 22.7776 20.7613 23.0561L19.9915 23.7309C19.6732 24.0099 19.1571 24.0099 18.8388 23.7309L12.2387 17.9454C11.9204 17.6664 11.9204 17.214 12.2387 16.935Z" fill="#848484" />
        </svg>
      </a>
    <?php endif ?>

    </a>
    <?php for ($i = 1; $i <=  $data["pageCount"]; $i++) : ?>
      <a <?= $i == $data["page"] ? ' onclick="event.preventDefault()"' : "" ?> class="sweeties_pagging_item <?= $i == $data["page"] ? "sweeties_pagging_item-active" : "" ?>" href="<?= DOCUMENT_ROOT ?>?page=<?= $i ?>"><?= $i ?></a>
    <?php endfor ?>
    <?php if ($data["page"] + 1 <= $data["pageCount"]) : ?>
      <a href="<?= DOCUMENT_ROOT ?>?page=<?= $data["page"] + 1 ?>">
        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" class="pagging-arrow">
          <circle cx="17" cy="17" r="16.5" stroke="#848484" />
          <path d="M21.7613 18.0052L15.1612 23.7907C14.8429 24.0698 14.3268 24.0698 14.0085 23.7907L13.2387 23.1159C12.921 22.8374 12.9203 22.3859 13.2374 22.1067L18.4681 17.5L13.2374 12.8933C12.9203 12.6141 12.921 12.1626 13.2387 11.8841L14.0085 11.2093C14.3268 10.9302 14.8429 10.9302 15.1612 11.2093L21.7613 16.9948C22.0796 17.2738 22.0796 17.7262 21.7613 18.0052Z" fill="#848484" />
        </svg>
      </a>
    <?php else : ?>
      <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="17" cy="17" r="16.5" stroke="#848484" />
        <path d="M21.7613 18.0052L15.1612 23.7907C14.8429 24.0698 14.3268 24.0698 14.0085 23.7907L13.2387 23.1159C12.921 22.8374 12.9203 22.3859 13.2374 22.1067L18.4681 17.5L13.2374 12.8933C12.9203 12.6141 12.921 12.1626 13.2387 11.8841L14.0085 11.2093C14.3268 10.9302 14.8429 10.9302 15.1612 11.2093L21.7613 16.9948C22.0796 17.2738 22.0796 17.7262 21.7613 18.0052Z" fill="#848484" />
      </svg>
    <?php endif ?>

  </div>
</div>