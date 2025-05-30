<div class="modal modal--none">
    <div class="modal__content">
        <h2 class="modal__title">Realizar pago</h2>
        <form class="payment-form" autocomplete="off">
            <h2 class="payment__price">A pagar $<span><?=$price . " + " . $price * 0.1 . " por envio"?></span></h2>
            <div class="payment-form__section">
                <div class="payment-form__field">
                    <label class="payment-form__label" for="name">Nombre(s)</label>
                    <input class="payment-form__input" type="text" id="name" name="name" placeholder="Ej: Jonathan">
                </div>

                <div class="payment-form__fields">
                    <div class="payment-form__field">
                        <label class="payment-form__label" for="lastName">Apellidos</label>
                        <input class="payment-form__input" type="text" id="lastName" name="lastName" placeholder="Ej: Quevedo" required>
                    </div>
                    <div class="payment-form__field">
                        <label class="payment-form__label" for="email">Correo Electronico</label>
                        <input class="payment-form__input" type="email" id="email" name="email" placeholder="Ej: micorreo@correo.com" required>
                    </div>
                    <div class="payment-form__field">
                        <label class="payment-form__label" for="telephone">Telefono</label>
                        <input class="payment-form__input" type="tel" id="telephone" name="telephone" placeholder="Ej: 9993981242"  pattern="[0-9]{10}" required>
                    </div>
                </div>
            </div>

            <div class="payment-form__section payment-form__section--grid">
                <div class="payment-form__field payment-form__field--grid-1-3">
                    <label class="payment-form__label" for="card">Número de tarjeta</label>
                    <input class="payment-form__input" type="text" id="card" maxlength="16" minlength="16" name="card" placeholder="Ej: 1236158984623578" required>
                </div>
                <div class="payment-form__field">
                    <label class="payment-form__label" for="key">CVV</label>
                    <input class="payment-form__input" type="number" maxlength="3" minlength="3" id="key" name="key" placeholder="Ej: 100" required>
                </div>
                <div class="payment-form__field">
                    <label class="payment-form__label" for="state">Estado</label>
                    <input class="payment-form__input" type="text" id="state" name="state" placeholder="Ej: Yucatán" required>
                </div>
                <div class="payment-form__field">
                    <label class="payment-form__label" for="street">Calle</label>
                    <input class="payment-form__input" type="text" id="street" name="street" placeholder="Ej: 13" required >
                </div>
                <div class="payment-form__field payment-form__field--grid-1-3">
                    <label class="payment-form__label" for="cross">Cruzamientos</label>
                    <input class="payment-form__input " type="text" id="cross" name="cross" placeholder="Ej: 21 y 23" required>
                </div>
                <div class="payment-form__field">
                    <label class="payment-form__label" for="numHouse">No. Casa</label>
                    <input class="payment-form__input" type="text" id="numHouse" name="numHouse" placeholder="Ej: 95A" required>
                </div>
                <div class="payment-form__field">
                    <label class="payment-form__label" for="colony">Colonia</label>
                    <input class="payment-form__input" type="text" id="colony" name="colony" placeholder="Ej: Prado Norte" required>
                </div>
                <div class="payment-form__field">
                    <label class="payment-form__label" for="postalCode">Codigo Postal</label>
                    <input class="payment-form__input" type="number" minlength="5" maxlength="5" id="postalCode" name="postalCode" placeholder="Ej: 97050" required>
                </div>
            </div>

            <div class="payment-buttons">
                <input class="payment-buttons__button payment-buttons__button--submit" type="submit" value="Comprar" id="comprar">
                <button type="button" class="payment-buttons__button payment-buttons__button--cancel">Cancelar</button>
            </div>
        </form>

        <input id="userId" type="hidden" name="userId" value="<?= session()->get('user')['userId'] ?>">
    </div>
</div>