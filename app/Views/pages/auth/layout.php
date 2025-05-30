<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->renderSection("title") ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="preload" href="/assets/css/global.min.css" as="style" />
    <link rel="stylesheet" href="/assets/css/global.min.css" />

    <link rel="preload" href="/assets/css/auth.min.css" as="style" />
    <link rel="stylesheet" href="/assets/css/auth.min.css" />
</head>

<body class="auth">
    <main class="auth__container">
        <?php $this->renderSection('content'); ?>
    </main>
    <?php
    if (session()->has('response')) {
        $response = session()->get('response');
    ?>
        <div id="alertElement" data-response="<?= esc(json_encode($response)) ?>"></div>
    <?php } ?>


    <script src="/assets/js/alertElement.min.js"></script>

    <script>
        localStorage.removeItem('cartItems');
    </script>

    <?php $this->renderSection('js'); ?>
</body>

</html>