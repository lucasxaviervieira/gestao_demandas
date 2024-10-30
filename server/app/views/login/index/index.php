<?php ob_start(); ?>

<div class="wrapper">
    <img src="/assets/logo.png" alt="Logo" class="logo">
    <form class="login" action="auth" method="POST">
        <p class="title">Entre na sua Conta</p>
        <input type="text" name="username" placeholder="nome de usuário" required autofocus />
        <i class="fa fa-user"></i>
        <input type="password" name="password" placeholder="senha" required />
        <i class="fa fa-key"></i>
        <button type="submit">
            <i class="spinner"></i>
            <span class="state">Login</span>
        </button>
    </form>
</div>

<?php
$content = ob_get_clean();
$cssFile = 'login'
?>
<?php include __DIR__ . '/../../layouts/login.php'; ?>