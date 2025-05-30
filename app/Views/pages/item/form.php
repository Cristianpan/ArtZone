<div class="item-form__section item-form__section--image">
    <div class="item-form__field--filepond">
        <?= view("components/filePondInput", ['inputName' => 'artItemFile', 'deleteFiles' => $artItemFiles['deleteFiles'] ?? []]) ?>
    </div>
</div>

<div class="item-form__section item-form__section--inputs">
    <h2 class="item__title item__title--tablet"><?= isset($item) ? 'Editar' : 'Registrar' ?> Obra</h2>
    <div class="item-form__field">
        <label for="name" class="item-form__label">Nombre</label>
        <?= validation_show_error('name', 'alert-error') ?>
        <input type="text" class="item-form__input" id="name" name="name" value="<?= old('name') ?? $item['name'] ?? '' ?>" placeholder="Titulo de la obra" required>
    </div>

    <?= validation_show_error('artStyleId', 'alert-error') ?>
    <?= validation_show_error('artTypeId', 'alert-error') ?>
    <div class="item-form__fields">
        <select name="artTypeId" class="item-form__input item-form__input--select" required>
            <option value="" selected disabled>Tipo de arte</option>
            <?php
            $auxArtType = old('artTypeId') ?? $item['artTypeId'] ?? '';
            foreach ($artTypes as $value) : ?>
                <option value="<?= $value['artTypeId'] ?>" <?= $auxArtType == $value['artTypeId'] ? 'selected' : '' ?>><?= $value['artType'] ?></option>
            <?php endforeach ?>
        </select>
        <select name="artStyleId" class="item-form__input item-form__input--select" required>
            <option value="" selected disabled>Estilo de arte</option>
            <?php
            $auxArtStyle = old('artStyleId') ?? $item['artStyleId'] ?? '';
            foreach ($artStyles as $value) : ?>
                <option value="<?= $value['artStyleId'] ?>" <?= $auxArtStyle == $value['artStyleId'] ? 'selected' : '' ?>><?= $value['artStyleType'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="item-form__field item-form__field--textarea">
        <label for="shortDescription" class="item-form__label">Descripción corta</label>
        <?= validation_show_error('shortDescription', 'alert-error') ?>
        <textarea class="item-form__input item-form__input--textarea-short" name="shortDescription" id="shortDescription" placeholder="Intruduce tu obra" required maxlength="60"><?= old('shortDescription') ?? $item['shortDescription'] ?? '' ?></textarea>
    </div>

    <div class="item-form__field item-form__field--textarea">
        <label for="description" class="item-form__label">Descripción</label>
        <?= validation_show_error('description', 'alert-error') ?>
        <textarea class="item-form__input item-form__input--textarea" name="description" id="description" required placeholder="Cuéntanos más sobre ella"><?= old('description') ?? $item['description'] ?? '' ?></textarea>
    </div>

    <div class="item-form__field">
        <label for="materials" class="item-form__label">Materiales</label>
        <?= validation_show_error('materials', 'alert-error') ?>
        <input type="text" class="item-form__input" id="materials" name="materials" value="<?= old('materials') ?? $item['materials'] ?? '' ?>" placeholder="Ej: Acrílico, acuarelas" required>
    </div>

    <label for="width" class="item-form__label">Medidas</label>
    <div class="item-form__fields--2">
        <div class="item-form__field">
            <?= validation_show_error('width', 'alert-error') ?>
            <input type="number" step="0.1" class="item-form__input" id="width" name="width" value="<?= old('width') ?? $item['width'] ?? '' ?>" placeholder="100 cm" required>
        </div>
        <div class="item-form__field">
            <?= validation_show_error('height', 'alert-error') ?>
            <input type="number" step="0.1" class="item-form__input" id="height" name="height" value="<?= old('height') ?? $item['height'] ?? '' ?>" placeholder="100 cm" required>
        </div>
    </div>

    <div class="item-form__fields--2">
        <div class="item-form__field">
            <label for="origin" class="item-form__label">Origen</label>
            <?= validation_show_error('localOrigin', 'alert-error') ?>
            <input type="text" class="item-form__input" id="origin" name="localOrigin" value="<?= old('localOrigin') ?? $item['localOrigin'] ?? '' ?>" placeholder="Ej: Mérida" required>
        </div>

        <div class="item-form__field">
            <label for="price" class="item-form__label">Precio</label>
            <?= validation_show_error('price', 'alert-error') ?>
            <input type="number" class="item-form__input" id="price" name="price" step="0.1" min="0" value="<?= old('price') ?? $item['price'] ?? '' ?>" placeholder="100.00">
        </div>
    </div>

    <input type="hidden" id="artItemFilesConfig" value="<?= esc(json_encode($artItemFiles)) ?>">