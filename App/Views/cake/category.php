<div class="container sweeties">
    <h2 class="title"><?= $data["name"] ?></h2>
    <div class="sort">
        <p class="Sort-header">Sort
            <i class="fas fa-caret-right"></i>
        </p>
        <div class="sort-content">
            <a href="./Category?type=<?= $data["type"] ?>&sort=1">Price: Low to hight</a>
            <a href="./Category?type=<?= $data["type"] ?>&sort=2">Price: Hight to low</a>
            <a href="./Category?type=<?= $data["type"] ?>&sort=3">Alphabet: A-Z</a>
            <a href="./Category?type=<?= $data["type"] ?>&sort=4">Size: Small to large </a>
        </div>
    </div>
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