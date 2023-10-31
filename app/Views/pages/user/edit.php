<?php $this->extend("templates/layout") ?>

<?php $this->section("title") ?>
<title>Art Zone | Editar Perfil</title>
<?php $this->endSection() ?>

<?php $this->section("css") ?>
<link rel="preload" href="/assets/css/profileEdit.min.css" as="style" />
<link rel="stylesheet" href="/assets/css/profileEdit.min.css" /> 
<?php $this->endSection() ?>

<?php $this->section("js") ?>
<script src="/assets/js/personalBlocks.min.js" ></script>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
<?= view("components/navigationBar") ?>

<h2>Bloques Personales</h2>
<?= view("components/personalBlocks") ?>; 

<?php $this->endSection() ?>