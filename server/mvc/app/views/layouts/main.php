<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Gestão de Demanda'; ?></title>
    <link rel="stylesheet" href="/css/index.css">

</head>

<body>

    <?php include __DIR__ . '/../components/navbar.php'; ?>


    <div class="content">
        <?php echo $content; ?>
    </div>
</body>

</html>