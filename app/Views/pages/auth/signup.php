<?php $this->extend('pages/auth/layout'); ?>


<?php $this->section("title") ?>
<title>Art Zone | Regístro</title>
<?php $this->endSection() ?>


<?php $this->section("content") ?>
<div class="auth__info">
    <h1 class="auth__title">Art Zone</h1>
    <p class="auth__description">¡Registra tu cuenta!</p>
</div>
<form class="form" method="post">
    <?= validation_show_error('name', 'alert-error') ?>
    <div class="form__field">
        <label for="name" class="form__label">Nombre</label>
        <input class="form__input" type="text" id="name" name="name" placeholder="Nombre" required value=<?= old('name') ?>>
    </div>
    <?= validation_show_error('email', 'alert-error') ?>
    <div class="form__field">
        <label for="email" class="form__label">Correo Electrónico</label>
        <input class="form__input" type="email" id="email" name="email" placeholder="Correo" required value=<?= old('email') ?>>
    </div>

    <?= validation_show_error('password', 'alert-error') ?>
    <div class="form__field">
        <label for="password" class="form__label">Contraseña</label>
        <input class="form__input" type="password" id="password" name="password" placeholder="Contraseña" required>
    </div>
    
    <div class="form__link-container">
        <a href="<?=url_to('login')?>" class="form__link">¿Ya tienes una cuenta? Inicia Sesión</a>
    </div>
    
    <input type="submit" class="form__submit" value="Registrarse">

</form>
<?php $this->endSection() ?>