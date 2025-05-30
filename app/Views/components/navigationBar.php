<?php
$user = session()->get('user');
?>

<header class="header">
    <a class="header__logo" href="/">Art Zone</a>

    <div class="header__grid">
        <form class="search" action="/">
            <label for="search" class="search__button"><img src="/assets/images/search-icon.svg" class="search__icon"></label>
            <input type="search" class="search__input" name="search" id="search" placeholder="Escriba el nombre de la obra o del artista" value="<?= session()->getFlashdata('search') ?? ''?>">
        </form>

        <nav class="navigation" id="navigation">
            <a class="navigation__cart" href="<?= url_to('shoppingCart')?>">
                <img class="navigation__cart-image" src="/assets/images/shopping-cart.svg" alt="">
            </a>
            <div class="navigation__container">
                <a class="navigation__link navigation__link--profile">
                    <?= view('components/imageProfile', ['user' => $user]) ?>
                </a>

                <div class="navigation__dropdown">
                    <a class="navigation__link navigation__link--dropdown user" href="<?= url_to('user', $user['userId']) ?>">
                        <div class="user__image">
                            <?= view('components/imageProfile', ['user' => $user]) ?>
                        </div>

                        <div class="user__info">
                            <p class="user__text"><?= session()->get('user')['name'] ?><span class="user__text--gray"><?= session()->get('user')['email'] ?></span></p>
                        </div>
                    </a>
                    <a class="navigation__link navigation__link--dropdown" href="<?= url_to('user-edit', session()->get('user')['userId']) ?>">Editar Perfil</a>
                    <a class="navigation__link navigation__link--dropdown" href="<?= url_to('sales', session()->get('user')['userId']) ?>">Ver ordenes de venta</a>
                    <a class="navigation__link navigation__link--dropdown" href="<?= url_to('orders', session()->get('user')['userId']) ?>">Ver ordenes de compra</a>
                    <a class="navigation__link navigation__link--dropdown" href="<?= url_to('logout') ?>">Cerrar Sesión</a>
                </div>
            </div>
        </nav>

    </div>
</header>