<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <h2>Users</h2>
    <select id="userSelect">
        <?php foreach ($users as $user): ?>
        <option value="<?php echo $user['id']; ?>">
            <?php echo $user['nome_usuario']; ?>
        </option>
        <?php endforeach; ?>
    </select>

</body>

</html>