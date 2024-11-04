<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestão de Demanda'; ?></title>
    <link rel="icon" type="image/x-icon" href="/assets/logo.png">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/<?= $cssFile ?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <?= $optional ?? ''; ?>

</head>

<body>

    <?php include __DIR__ . '/../components/header.php'; ?>
    <?php include __DIR__ . '/../components/navbar.php'; ?>


    <div class="content">
        <?= $content; ?>
    </div>
</body>

</html>