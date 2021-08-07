<div class="wrapper">
    <div class="container">
        <header class="header">
            <a href="#/"><img src="<?= PUB ?>/img/logo.png" alt="" class="header_logo" /></a>
            <ul class="header_menu_list">
                <li><a href="<?= DOCUMENT_ROOT ?>" class="header_menu_list_item">Home</a></li>
                <li><a href="<?= DOCUMENT_ROOT ?>/Cake" class="header_menu_list_item">Cakes</a></li>
                <li><a href="#footer" class="header_menu_list_item">About</a></li>
            </ul>
            <div class="header_search">
                <form action="<?= DOCUMENT_ROOT ?>/Cake/search" method="GET">
                    <button class="header_search_button">
                        <img src="<?= PUB ?>/icons/search.png" alt="">
                    </button>
                    <input type="text" placeholder="Search...." name="keyword" />
                </form>
            </div>
            <div class="header_info">
                <div class="header_cart">
                    <img src="<?= PUB ?>/icons/cart.svg" alt="" />
                    <span id="header_cart_number">0</span>
                </div>
                <?php if (isset($_SESSION["user"])) : ?>
                    <div class="header_user">
                        <div class="header_user_image">
                            <img src="<?= PUB ?>/img/<?= $_SESSION["user"]["avatar"] ?>" alt="" />
                        </div>
                        <div class="header_user_dropdown">
                            <ul>
                                <li><a href="#/">Profile</a></li>
                                <li><a href="#/">Cart</a></li>
                                <li><a href="<?= DOCUMENT_ROOT ?>/Account/signOut">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                <?php else : ?>
                    <a href="<?= DOCUMENT_ROOT ?>/Account"><button class="btn btn--primary">Login</button></a>
                <?php endif ?>
                <div class="header_mobile">
                    <img class="header_mobile_icon" src="<?= PUB ?>/icons/menu-mobile.svg" alt="" />
                    <div class="header_mobile_list">
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
                        <ul>
                            <li><a href="#/">Home</a></li>
                            <li><a href="#/">Cakes</a></li>
                            <li><a href="#/">About</a></li>
                            <li><a href="#/">Profile</a></li>
                            <li><a href="#/">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>