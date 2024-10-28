<?php ob_start(); ?>

<h1>A qual setor na CAJ, você pertence?</h1>
<h2>Setores</h2>

<form action="../auth/saveUser" method="POST">

    <input type="hidden" id="username" name="username" value="<?= $data['username'] ?>">

    <label for="sector">Setores:</label>
    <select id="sector" name="sector" required>
        <?php
        $sectors = $data['setores'];

        foreach ($sectors as $sector) {
            $id = $sector['id'];
            $abbreviation = $sector['sigla'];

            echo "<option value='$id'>$abbreviation</option>";
        }
        ?>
    </select>

    <input type="submit" value="Confirmar">
</form>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../../layouts/login.php'; ?>