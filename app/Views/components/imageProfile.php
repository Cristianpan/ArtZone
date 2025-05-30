<?php if ($user['userImage']) : ?>
    <img src="/api/files/load?file=<?= $user['userImage'] ?>" alt="Foto de perfil del usuario">
<?php else : ?>
    <div class="image-profile">
        <p class="image-profile__symbol"><?= substr($user['name'], 0, 1) ?></p>
    </div>
<?php endif ?>
