<?php ob_start(); ?>
<main class="main">
    <form action="#">
        <br>
        <hr>
        <br>

        <label for="activity">Atividade:</label>
        <select id="activity" name="activity">
            <?php
            foreach ($data['atividades'] as $activity) {
                $id = $activity['id'];
                $name = $activity['nome'];

                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>

        <label for="location">Localização:</label>
        <select id="location" name="location">
            <?php
            foreach ($data['localizacacoes'] as $location) {
                $id = $location['id'];
                $name = $location['nome'];

                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>

        <label for="sublocation">Sublocalidade:</label>
        <select id="sublocation" name="sublocation">
            <?php
            foreach ($data['sublocalidades'] as $sublocation) {
                $id = $sublocation['id'];
                $name = $sublocation['nome'];

                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>

        <label for="type">Tipo:</label>
        <select id="type" name="type">
            <?php
            foreach ($data['tipos'] as $type) {
                $id = $type['id'];
                $name = $type['nome'];

                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>

        <label for="okr">OKR:</label>
        <select id="okr" name="okr">
            <?php
            foreach ($data['okr'] as $okr) {
                $id = $okr['id'];
                $trimester = $okr['trimestre'];
                $year = $okr['ano'];

                echo "<option value='$id'>$year/$trimester</option>";
            }
            ?>
        </select>

        <label for="observation">Observação:</label>
        <textarea id="observation" name="observation" rows="5" cols="100" style="resize:none"></textarea>

        <br>
        <hr>
        <br>
        <label for="status">status:</label>
        <select id="status" name="status">
            <option value="ATIVO">Ativo</option>
            <option value="CANCELADO">Cancelado</option>
        </select>

        <label for="urgency">Urgente:</label>
        <select id="urgency" name="urgency">
            <option value="false">NÃO</option>
            <option value="true">SIM</option>
        </select>

        <label for="start_date">Data de Início:</label>
        <input type="date" id="start_date" name="start_date">

        <label for="responsable">Responsável:</label>
        <select id="responsable" name="responsable">
            <?php
            foreach ($data['usuarios'] as $user) {
                $id = $user['id'];
                $username = $user['nome_usuario'];

                echo "<option value='$id'>$username</option>";
            }
            ?>
        </select>

    </form>
</main>

<script>
const select = document.getElementById('activity');
select.addEventListener('change', function handleChange(event) {
    const selectedValue = select.value;
    const selectedText = select.options[selectedValue - 1].text;
    if (selectedText == 'OKR') {
        console.log('show okr options')
    }

})
</script>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/main.php'; ?>