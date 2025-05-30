<div class="swiper personal-blocks ">
    <div class="swiper-wrapper personal-block-wrapper">
        <?php
        $i = 0; 
         foreach ($personalBlocks as $personalBlock) : ?>
            <div id="block-<?= $personalBlock['personalBlockId'] ?>" class="swiper-slide personal-blocks__block personal-blocks__block--<?= ++$i%3 + 1?>">
                <h3 class="personal-blocks__title"><?= $personalBlock['title'] ?></h3>
                <p class="personal-blocks__text">
                    <?= $personalBlock['description'] ?>
                </p>
                <?php if (isset($edit) && $edit === true) : ?>
                    <div class="personal-blocks-buttons">
                        <button data-id=<?= $personalBlock['personalBlockId']?> class="personal-blocks-buttons__button personal-blocks-buttons__button--edit"> <img data-id=<?= $personalBlock['personalBlockId']?> src="/assets/images/edit-icon.svg" alt="detele-icon"></button>
                        <a data-id=<?= $personalBlock['personalBlockId']?> class="personal-blocks-buttons__button personal-blocks-buttons__button--delete"><img data-id=<?= $personalBlock['personalBlockId']?> src="/assets/images/delete-icon.svg" alt="detele-icon"></a>
                    </div>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
</div>