<?php $this->extend("templates/layout") ?>
<?php $this->section("title") ?>
<title>Art Zone | Carrito</title>
<?php $this->endSection() ?>

<?php $this->section("css") ?>
<link rel="stylesheet" href="/assets/css/cart.min.css" />
<?php $this->endSection() ?>

<?php $this->section("js") ?>
<script src="/assets/js/cart.min.js"></script>
<script src="/assets/js/paymentForm.min.js"></script>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
<div class="container">
    <h1 class="cart-item__title">Carrito de Compras</h1>
</div>
<div class="cart-item container">
    <main class="cart-item__container cart-item__container--table">
        <div class="table__row--head">
            <table class="table cart-item__table">
                <thead class="table__head">
                    <tr class="table__row">
                        <th class="table__th"></th>
                        <th class="table__th">Producto</th>
                        <th class="table__th"></th>
                        <th class="table__th">Total</th>
                    </tr>
                </thead>

                <tbody class="table__body cart-item-container">
                </tbody>
            </table>
        </div>
    </main>

    <section class="cart-item__container cart-item__container--payment">
        <div class="payment">
            <h3 class="payment__header">Detalle de compra</h3>
            <table class="table payment__details">
                <tbody class="table__body">
                    <tr class="table__row">
                        <td class="table__td">
                            <p class="payment__label">Productos</p>
                        </td>
                        <td class="table__td">
                            <p id="amount" class="payment__info">0</p>
                        </td>
                    </tr>
                    <tr class="table__row">
                        <td class="table__td">
                            <p class="payment__label">Subtotal</p>
                        </td>
                        <td class="table__td">
                            <p id="subtotal" class="payment__info">$0.00</p>
                        </td>
                    </tr>
                    <tr class="table__row">
                        <td class="table__td">
                            <p  class="payment__label">Costo de envío</p>
                        </td>
                        <td class="table__td">
                            <p id="shippingCost" class="payment__info">$0.00</p>
                        </td>
                    </tr>
                    <tr class="table__row">
                        <td class="table__td">
                            <p class="payment__label payment__label--total">Total</p>
                        </td>
                        <td class="table__td">
                            <p id="total" class="payment__info payment__info--total">$0.00</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button class="payment__button">Pagar</button>
        </div>
    </section>
</div>
<?= view("components/paymentForm", ['price' => 0]) ?>
<?php $this->endSection() ?>