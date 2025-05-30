<?php $this->extend("templates/layout") ?>
<?php $this->section("title") ?>
<title>Art Zone | Obra</title>
<?php $this->endSection() ?>

<?php $this->section("css") ?>
<link rel="stylesheet" href="/assets/css/orders.min.css">
<?php $this->endSection() ?>

<?php $this->section("js") ?>
<script src="/assets/js/order.min.js"></script>

<?php $this->endSection() ?>

<?php $this->section("content") ?>
<main class="order container">
    <h1 class="order__title">Ordenes de Compra</h1>

    <?= empty($orders) ? "<p> No cuenta con ordenes de compra </p>": '' ?>

    <?php foreach ($orders as $key => $order) : ?>
        <div class="order-card">
            <div id="<?= $order['orderId'] ?>" class="order-card__body order-card__body--none">
                <?php
                $total = 0; 
                foreach ($order['artItems'] as $artItem) : 
                $total += floatval($artItem['price'])?>
                    <div class="order-card__products">
                        <h3 class="order-card__title">Obras Compradas</h3>
                        <div class="order-card__product">
                            <div class="order-card__product-image">
                                <img src="/api/files/load?file=<?= $artItem['image'] ?>" alt="Imagen producto">
                            </div>
                            <div class="order-card__product-data">
                                <p class="order-card__product-title">Titulo: <?= $artItem['name'] ?></p>
                                <p class="order-card__product-autor">Autor: <?= $artItem['userName'] . " " . $artItem['lastName'] ?></p>
                                <p class="order-card__product-price">$<?= $artItem['price'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

                <div class="order-card__shipping-details">
                    <h3 class="order-card__title">Detalles de Envio</h3>
                    <ul class="order-card__shipping-container">
                        <li class="order-card__shipping-detail"><span>Nombre(s):</span> <?= $order['shipping']['name'] ?></li>
                        <li class="order-card__shipping-detail"><span>Apellidos:</span> <?= $order['shipping']['lastName'] ?></li>
                        <li class="order-card__shipping-detail"><span>Correo:</span> <?= $order['shipping']['email'] ?></li>
                        <li class="order-card__shipping-detail"><span>Teléfono:</span> <?= $order['shipping']['telephone'] ?></li>
                        <li class="order-card__shipping-detail"><span>Estado:</span> <?= $order['shipping']['state'] ?></li>
                        <li class="order-card__shipping-detail"><span>Calle:</span> <?= $order['shipping']['street'] ?></li>
                        <li class="order-card__shipping-detail"><span>Cruzamientos:</span> <?= $order['shipping']['cross'] ?></li>
                        <li class="order-card__shipping-detail"><span>No. Casa:</span> <?= $order['shipping']['numHouse'] ?></li>
                        <li class="order-card__shipping-detail"><span>Colonia:</span> <?= $order['shipping']['colony'] ?></li>
                        <li class="order-card__shipping-detail"><span>Codigo Postal:</span> <?= $order['shipping']['postalCode'] ?></li>
                    </ul>
                </div>
            </div>

            <div class="order-card__footer">
                <p class="order-card__text"><span>Fecha de compra:</span> <?= (new DateTime($order['date']))->format("d/m/Y") ?></p>
                <p class="order-card__text"><span>Costo Total:</span> $<?= $total?></p>
                <button data-orderId="<?= $order['orderId'] ?>" class="order-card__button">Ver más</button>
            </div>
        </div>
    <?php endforeach ?>
</main>
<?php $this->endSection() ?>