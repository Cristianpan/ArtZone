<?php $this->extend("templates/layout") ?>

<?php $this->section("title") ?>
<title>Art Zone</title>
<?php $this->endSection() ?>

<?php $this->section("css") ?>

<link rel="preload" href="/assets/css/home.min.css" as="style" />
<link rel="stylesheet" href="/assets/css/home.min.css" />
<?php $this->endSection() ?>

<?php $this->section("content") ?>

<main class="container home">
    <?= view("components/gallery") ?>
</main>
<?php $this->endSection() ?>