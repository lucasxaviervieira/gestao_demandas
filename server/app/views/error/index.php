<?php ob_start(); ?>

<div class="wrapper">
    <img src="/assets/logo.png" alt="Logo" class="logo">
    <div class="login" style="text-align: center">
        <p class="title">Página não encontrada</p>
        <div>Erro 404</div>
        <a href="../">
            <button>
                Voltar para a tela inicial
            </button>
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();
$cssFile = 'login'
?>
<?php include __DIR__ . '/../layouts/login.php'; ?>