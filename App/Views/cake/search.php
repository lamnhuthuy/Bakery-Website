<div class="container sweeties">
    <h2 class="title">Cakes</h2>
    <p style="margin-bottom: 15px; font-size:20px;">Search for keyword: <b><?= $data['keyword'] ? $data["keyword"] :  $data["keyword"] ?></b></p>
    <div class="sweeties-list">
        <ul>
            <?php foreach ($data["cake"] as $index => $value) : ?>
                <li class="sweeties-item">
                    <a href="#/">
                        <img src="<?= PUB ?>/img/cakes/<?= $value["image"] ?>" alt="" />
                    </a>
                    <p class="sweeties_name">
                        <?= $value["name"] ?>
                    </p>
                    <div class="sweeties-prices">
                        <span class="sweeties-prices-new"><?= number_format($value["price"]) ?> VND</span>
                    </div>
                    <button class="btn btn1">Add to cart +</button>

                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>