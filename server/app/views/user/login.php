<?php ob_start(); ?>

<h2>Login com Servidor LDAP</h2>

<form action="auth" method="POST">
    <label for="username">Usuário:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="submit" value="Login">
</form>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/login.php'; ?>