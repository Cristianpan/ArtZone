<?php $this->extend("templates/layout") ?>

<?php $this->section("title") ?>
<title>Art Zone | Editar Perfil</title>
<?php $this->endSection() ?>

<?php $this->section("css") ?>
<link rel="preload" href="/assets/css/profileEdit.min.css" as="style" />
<link rel="stylesheet" href="/assets/css/profileEdit.min.css" />
<?php $this->endSection() ?>

<?php $this->section("js") ?>
<script src="/assets/js/personalBlockEdit.min.js"></script>
<script src="/assets/js/profileEdit.min.js"></script>
<?php $this->endSection() ?>

<?php $this->section("content") ?>

<main class="container profile">
    <h2 class="profile__title"><?= $userData['name'] . " " . $userData['lastName'] ?>
        <span class="profile__title--span">Mi cuenta</span>
    </h2>

    <form class="profile-form" method="post">

        <div class="profile-form__grid">
            <div class="profile-form__grid-colum">
                <?= validation_show_error('imageProfile', 'alert-error') ?>
                <div class="profile-form__field profile-form__field--file profile-form__field--profile">
                    <?= view("components/filePondInput", ['inputName' => 'imageProfile', 'deleteFiles' => $imageProfile['deleteFiles'] ?? []]) ?>
                </div>
                <div class="profile-form__field profile-form__field--select">
                    <?= validation_show_error('occupationId', 'alert-error') ?>
                    <select id="profesion" name="occupationId" class="profile-form__input profile-form__input--select" required>
                        <option value="">Ocupación</option>
                        <?php foreach ($occupations as $occupation) :
                            $auxOccupation = old('occupationId') ?? $userDetails['occupationId'] ?? '';
                        ?>
                            <option value="<?= $occupation['occupationId'] ?>" <?= $auxOccupation == $occupation['occupationId'] ? 'selected' : '' ?>><?= $occupation['occupationType'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="profile-form__grid-column">
                <?= validation_show_error('imageBackground', 'alert-error') ?>
                <div class="profile-form__field profile-form__field--file">
                    <?= view("components/filePondInput", ['inputName' => 'imageBackground', 'deleteFiles' => $imageBackground['deleteFiles'] ?? []]) ?>
                </div>
            </div>
        </div>
        <div class="profile-form__grid">
            <div class="profile-form__field">
                <label class="profile-form__label" for="name">Nombre(s)</label>
                <?= validation_show_error('name', 'alert-error') ?>
                <input type="text" class="profile-form__input" name="name" id="name" placeholder="Nombre" value="<?= old('name') ?? $userData['name'] ?? '' ?>" required>
            </div>
            <div class="profile-form__field">
                <label class="profile-form__label" for="lastName">Apellido</label>
                <?= validation_show_error('lastName', 'alert-error') ?>
                <input type="text" class="profile-form__input" name="lastName" id="lastName" placeholder="Apellido" value="<?= old('lastName') ?? $userData['lastName'] ?? '' ?>" required>
            </div>
            <div class="profile-form__field">
                <label class="profile-form__label" for="email">Correo electrónico</label>
                <?= validation_show_error('email', 'alert-error') ?>
                <input type="email" class="profile-form__input" name="email" id="email" placeholder="Correo" value="<?= old('email') ?? $userData['email'] ?? '' ?>" required>
            </div>
            <div class="profile-form__field">
                <label class="profile-form__label" for="card">No. de Tarjeta</label>
                <?= validation_show_error('cardNumber', 'alert-error') ?>
                <input type="number" class="profile-form__input" name="cardNumber" id="card" placeholder="No. de Tarjeta" value="<?= old('cardNumber') ?? $userDetails['cardNumber'] ?? ''?>" required minlength="16" maxlength="16">
            </div>
            <div class="profile-form__field profile-form__field--textarea">
                <label for="description" class="profile-form__label">Descripción</label>
                <textarea name="description" id="description" class="profile-form__input profile-form__input--textarea" placeholder="Cuéntanos tu historia"><?= old('description') ?? $userDetails['description'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="buttons">
            <input type="submit" class="buttons__button buttons__button--submit" value="Actualizar">
            <a href="/user/<?= session()->get('user')['userId'] ?>/edit" class="buttons__button buttons__button--cancel">Cancelar</a>
        </div>

        <input type="hidden" name="userDetailId" value="<?= old('userDetailId') ?? $userDetails['userDetailId'] ?? '' ?>">
    </form>
    <input type="hidden" id="imageBackgroundConfig" name="fileImageBackground" value="<?= esc(json_encode($imageBackground)) ?>">
    <input type="hidden" id="imageProfileConfig" name="fileImageProfle" value="<?= esc(json_encode($imageProfile)) ?>">
</main>

<section class="container personals-block-edit">
    <div class="personals-block-edit__header">
        <h2 class="personals-block-edit__title">Bloques Personales</h2>
        <button class="personals-block-edit__add"><img src="/assets/images/plus-icon.svg" alt="add-icon"></button>
    </div>

    <?= view("components/personalBlocks", ['edit' => true, 'personalBlocks' => $personalBlocks]) ?>
    <?php if (!$personalBlocks ?? null) { ?>
        <p class="personal-block-none">¡Registra un nuevo bloque para que te conozcan mejor!</p>
    <?php } ?>
</section>

<section class="container catalog-edit">
    <div class="catalog-edit__header">
        <h2 class="catalog-edit__title">Agregar Obra</h2>
        <a class="catalog-edit__add" href="<?= url_to('item-create', session()->get('user')['userId'])?>"><img src="/assets/images/plus-icon.svg" alt="add-icon"></a>
    </div>
    
    <?php if (!$items ?? null) { ?>
        <p class="personal-block-none">¡Registra una nueva obra!</p>
    <?php } else {
        echo view("/components/catalog");
    } ?>

</section>

<div class="modal modal--flex modal--none">
    <div class="modal__content">
        <h2 class="modal__title">Agregar Nuevo Bloque</h2>
        <form class="modal-form" method="post">
            <div class="modal-form__field">
                <label class="modal-form__label" for="block-name">Titulo</label>
                <input class="modal-form__input" type="text" id="block-name" name="title" placeholder="Ingresa un título a historia" maxlength="30" required>
            </div>
            <div class="modal-form__field">
                <label class="modal-form__label" for="block-description">Descripción</label>
                <textarea class="modal-form__input modal-form__input--textarea" id="block-description" placeholder="¡Cuéntanos sobre tí!" name="description" minlength="100" maxlength="200" required></textarea>
            </div>

            <div class="buttons">
                <input type="submit" class="buttons__button" value="Guardar">
                <input type="reset" class="buttons__button buttons__button--cancelar" value="Cancelar">
            </div>
        </form>

        <input id="userId" type="hidden" name="userId" value="<?= session()->get('user')['userId'] ?>">
    </div>
</div>

<?php $this->endSection() ?>