<?php $this->extend('pages/auth/layout'); ?>


<?php $this->section("title") ?>
<title>Art Zone | Iniciar Sesión</title>
<?php $this->endSection() ?>


<?php $this->section("content") ?>

<div class="auth__info">
    <h1 class="auth__title">Art Zone</h1>
    <p class="auth__description">¡Bienvenido de vuelta!</p>
</div>

<form class="form" method="post" autocomplete="off" >
    <div class="form__field">
        <label for="email" class="form__label">Correo electrónico</label>
        <?= validation_show_error('email', 'alert-error') ?>
        <input class="form__input" type="text" id="email" name="email" placeholder="Correo" value="<?= old('email') ?? '' ?>">
    </div>
    <div class="form__field">
        <label for="password" class="form__label">Contraseña</label>
        <?= validation_show_error('password', 'alert-error') ?>
        <input class="form__input" type="password" id="password" name="password" placeholder="Contraseña">
    </div>
    <?= validation_show_error('credentials', 'alert-error') ?>
    <div class="form__link-container">
        <a class="form__link" href="#">¿Olvidaste tu contraseña?</a>
    </div>

    <div class="form__link-container">
        <a href="<?= url_to("signup") ?>" class="form__link">¿No tienes una cuenta? Regístrate</a>
    </div>

    <input type="submit" class="form__submit" value="Iniciar Sesión">

</form>

<?php $this->endSection() ?>