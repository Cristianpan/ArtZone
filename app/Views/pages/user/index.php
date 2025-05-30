<?php $this->extend("templates/layout") ?>

<?php $this->section("title") ?>
<title>Art Zone | Usuario</title>
<?php $this->endSection() ?>

<?php $this->section("css") ?>

<link rel="preload" href="/assets/css/profile.min.css" as="style" />
<link rel="stylesheet" href="/assets/css/profile.min.css" />
<?php $this->endSection() ?>

<?php $this->section("js") ?>
<script src="/assets/js/personalBlocksSwiper.min.js"></script>
<?php $this->endSection() ?>


<?php $this->section("content") ?>

<div class="profile">
    <?php if ($userData['imageBackground']) : ?>
        <img class="profile__background" src="/api/files/load?file=<?= $userData['imageBackground'] ?>">
    <?php endif ?>
    <div class="profile__picture">
        <?= view("components/imageProfile", ['user' => $userData]) ?>
    </div>
</div>

<section class="profile-data container">
    <div class="profile__content">

        <h1 class="profile__name"><?= $userData['userName'] ?></h1>
        <p class="profile__job"><?= $userData['occupation'] ?></p>
    </div>
    <div class="about">
        <p class="about__description"><?= $userData['description'] ?></p>
    </div>
</section>

<section class="container">
    <?= view("components/personalBlocks", ['personalBlocks' => $userData['personalBlocks'] ?? []]) ?>
</section>

<section class="container catalog">
    <?php if ($userData['artItems']) : ?>
        <h2 class="catalog__title">Catálogo</h2>
        <?= view("components/gallery", ['items' => $userData['artItems']]) ?>
    <?php endif ?>
</section>
<?php $this->endSection() ?>