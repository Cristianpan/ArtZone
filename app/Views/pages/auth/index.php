<?php $this->extend('pages/auth/layout'); ?>


<?php $this->section("title") ?>
<title>Iniciar Sesión | Art Zone</title>
<?php $this->endSection() ?>


<?php $this->section("content") ?>
<nav class="nav">
    <a class="nav__link" href="/auth/signup">Registrarse</a>
    <a class="nav__link nav__link--active" href="/auth/login">Iniciar Sesión</a>
</nav>
<div class="auth__info">
    <h1 class="auth__title">Art Zone</h1>
    <p class="auth__description">¡Bienvenido de vuelta!</p>
</div>

<form class="form">
    <div class="form__field">
        <input class="form__input" type="text" id="user" name="user" required>
        <label for="user" class="form__label">Usuario</label>
    </div>
    <div class="form__field">
        <input class="form__input" type="password" id="password" name="password" required>
        <label for="password" class="form__label">Contraseña</label>
    </div>

    <a class="form__enlace" href="#">¿Olvidaste tu contraseña?</a>

    <input type="submit" class="form__submit" value="Iniciar Sesión ">
</form>
<?php $this->endSection() ?>