<!DOCTYPE html>
<html>

<head>
    <title>Users</title>
</head>

<body>
    <h1>Users List</h1>
    <?php foreach ($users as $user): ?>
    <p><?php echo $user['name']; ?></p>
    <?php endforeach; ?>
</body>

</html>