<input id="<?= $inputName ?>" type="file" name="<?= $inputName ?>[]">
<div id="delete-<?= $inputName ?>" class="deleteFile">
    <?php foreach ($deletedFiles ?? [] as $deleteFile) : ?>
        <input type="hidden" name="delete-<?= $inputName ?>[]" value="<?= $deleteFile ?>">
    <?php endforeach; ?>
</div>