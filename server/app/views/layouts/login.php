<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestão de Demanda'; ?></title>
    <link rel="icon" type="image/x-icon" href="/assets/logo.png">
    <link rel="stylesheet" href="/css/<?= $cssFile ?>.css">

</head>

<body>

    <div class="content">
        <?= $content; ?>
    </div>
</body>

</html>