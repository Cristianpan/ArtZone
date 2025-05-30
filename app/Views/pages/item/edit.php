<?php $this->extend("templates/layout") ?>

<?php $this->section("title") ?>
<title>Art Zone | Editar Obra</title>
<?php $this->endSection() ?>

<?php $this->section("css") ?>
<link rel="preload" href="/assets/css/createItem.min.css" as="style" />
<link rel="stylesheet" href="/assets/css/createItem.min.css" />
<?php $this->endSection() ?>

<?php $this->section("js") ?>
<script src="/assets/js/createItem.min.js"></script>
<script src="/assets/js/formItemFile.min.js"></script>
<?php $this->endSection() ?>


<?php $this->section("content") ?>
<main class="item">
    <h2 class="item__title">Editar Obra</h2>
    <form class="item-form" method="post">
            <?= view("pages/item/form") ?>
            <div class="buttons">
                <input type="submit" class="buttons__button buttons__button--submit" value="Editar">
                <a  href="<?= url_to('item-delete', session()->get('user')['userId'], $item['artItemId']) ?>" class="buttons__button buttons__button--delete">Eliminar</a>
                <a href="<?= url_to('item-edit', session()->get('user')['userId'], $item['artItemId']) ?>" class="buttons__button buttons__button--cancel">Cancelar</a>
            </div>
        </div>
    </form>
</main>

<?php $this->endSection() ?>