<?php $this->extend("templates/layout") ?>
<?php $this->section("title") ?>
<title>Art Zone | Obra</title>
<?php $this->endSection() ?>

<?php $this->section("css") ?>
<link rel="stylesheet" href="/assets/css/art-item.min.css" />
<?php $this->endSection() ?>

<?php $this->section("js") ?>
<script src="/assets/js/artItem.min.js"></script>
<script src="/assets/js/paymentForm.min.js"></script>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
<div class="art-item">
    <div class="art-item__container art-item__container--image">
        <div class="art-item__content--image">
            <img class="art-item__image" src="/api/files/load?file=<?= $artItem['image'] ?>" alt="Imagen de la obra de arte">

            <a class="art-item__autor" href="<?= url_to('user', $artItem['userId']) ?>"><?= $artItem['autor'] ?></a>
        </div>

    </div>

    <div class="art-item__container art-item__container--data">
        <div class="art-item__header">
            <h1 class="art-item__title"><?= $artItem['name'] ?></h1>
            <h2 class="art-item__header-autor"><?= $artItem['autor'] ?></h2>
            <p class="art-item__price">$ <?= $artItem['price'] ?></p>
        </div>

        <div class="art-item__info">
            <div class="art-item__navigation">
                <button id="description" class="art-item__btn-navigation art-item__btn-navigation--active">Descripción</button>
                <button id="details" class="art-item__btn-navigation">Detalles</button>
            </div>

            <div class="art-item__carousel">
                <section class="art-item__section description art-item__section--active">
                    <p class="art-item__description"><?= $artItem['description'] ?></p>
                </section>

                <section class="art-item__section details">
                    <ul class="art-item__info-details">
                        <li class="art-item__info-detail">
                            <span class="art-item__info-detail--span">Titulo: </span>
                            <?= $artItem['name'] ?>
                        </li>
                        <li class="art-item__info-detail">
                            <span class="art-item__info-detail--span">Medidas: </span>
                            <?= $artItem['measurement'] ?>
                        </li>
                        <li class="art-item__info-detail">
                            <span class="art-item__info-detail--span">Tipo de arte: </span>
                            <?= $artItem['artType'] ?>
                        </li>
                        <li class="art-item__info-detail">
                            <span class="art-item__info-detail--span">Estilo: </span>
                            <?= $artItem['artStyleType'] ?>
                        </li>
                        <li class="art-item__info-detail">
                            <span class="art-item__info-detail--span">Materiales: </span>
                            <?= $artItem['materials'] ?>
                        </li>
                        </li>
                        <li class="art-item__info-detail">
                            <span class="art-item__info-detail--span">Lugar de Origen: </span>
                            <?= $artItem['localOrigin'] ?>
                        </li>
                    </ul>
                </section>

            </div>
        </div>


        <?php if ($artItem['userId'] !== session()->get('user')['userId'] && $artItem['isSold'] != "1") : ?>
            <div class="art-item__buttons">
                <button data-userId="<?=$artItem['userId']?>" data-price="<?= $artItem['price'] ?>" data-artItemId="<?= $artItem['artItemId'] ?>" class="art-item__button art-item__button--buy">Comprar</button>
                <button class="art-item__button art-item__button--add-cart" data-userId="<?= $artItem['userId']?>" data-artItemId="<?= $artItem['artItemId'] ?>">Agregar al carrito</button>
            </div>
        <?php endif ?>
    </div>
</div>

<?= view("components/paymentForm", ['price' => $artItem['price']]) ?>
<?php $this->endSection() ?>