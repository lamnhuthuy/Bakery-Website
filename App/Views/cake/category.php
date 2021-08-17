<div class="container sweeties">
    <h2 class="title"><?= $data["name"] ?></h2>
    <div class="sweeties-list">
        <ul>
            <?php foreach ($data["cake"] as $index => $value) : ?>
                <li class="sweeties-item">
                    <a href="./Cake/detail/<?= $value["id"] ?>">
                        <img src="<?= PUB ?>/img/cakes/<?= $value["image"] ?>" alt="" />
                    </a>
                    <p class="sweeties_name">
                        <?= $value["name"] ?>
                    </p>
                    <div class="sweeties-prices">
                        <span class="sweeties-prices-new"><?= number_format($value["sale"]) ?> VND</span>
                        <span class="sweeties-prices-old"><?= number_format($value["price"]) ?>VND </span>
                    </div>
                    <button onclick="addToCart(<?= $value['id'] ?>,<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?>)" class="btn btn1">Add to cart +</button>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>