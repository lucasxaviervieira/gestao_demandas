<?php ob_start(); ?>

<div class="wrapper">
    <img src="/assets/logo.png" alt="Logo" class="logo">

    <form class="login" action="../auth/saveUser" method="POST">

        <p class="title">A qual setor na CAJ, você pertence?</p>

        <input type="hidden" id="username" name="username" value="<?= $data['username'] ?>">

        <h2>Setores: </h2>
        <select id="sector" name="sector" required>
            <?php foreach ($data['setores'] as $sector): ?>

            <option value='<?= $sector['id'] ?>'><?= $sector['sigla'] ?></option>

            <?php endforeach; ?>
        </select>

        <button type="submit">
            <span class="state">Confirmar</span>
        </button>
    </form>
</div>


<?php
$content = ob_get_clean();
$cssFile = 'login'
?>
<?php include __DIR__ . '/../../layouts/login.php'; ?>