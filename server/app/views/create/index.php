<?php ob_start(); ?>
<main class="main-content">
    <form action="createDemand" method="POST" id="create-demand">

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
            <option></option>
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
            <option></option>
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
            <option></option>
            <?php
            foreach ($data['tipos'] as $type) {
                $id = $type['id'];
                $name = $type['nome'];

                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>

        <div id="hidden-okr" style="display: none;">
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
        </div>

        <label for="observation">Observação:</label>
        <textarea id="observation" name="observation" rows="5" cols="100" style="resize:none"></textarea>

        <br>
        <label for="status">status:</label>
        <select id="status" name="status">
            <option value="ATIVO">Ativo</option>
            <option value="CANCELADO">Cancelado</option>
        </select>

        <label for="urgency">Urgente:</label>
        <select id="urgency" name="urgency">
            <option value="TRUE">NÃO</option>
            <option value="FALSE">SIM</option>
        </select>

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
        <div id="addedProcesses" class="sectors-selected"></div>
        <div id="addedDocuments" class="sectors-selected"></div>
        <div id="addedSectors" class="sectors-selected"></div>

        <button type="submit">Criar</button>

    </form>

    <label for="sei-process">Processo SEI:</label>
    <input id="sei-process" name="sei-process" />

    <label for="process-description">Descricao:</label>
    <input id="process-description" name="process-description" />

    <button type="button" id="addProcessButton">Adicionar Processo SEI</button>


    <label for="document">Documento:</label>
    <input id="document" name="document" />

    <label for="document-description">Descricao:</label>
    <input id="document-description" name="document-description" />

    <button type="button" id="addDocButton">Adicionar Documento</button>


    <div class="sectors">
        <label for="sender_agent">Setor a enviar:</label>
        <select id="sender_agent" name="sender_agent">
            <option></option>
            <optgroup label="Setores Internos">
                <?php
                $internalAgent = $data['agentes']['interno'];
                $externalAgent = $data['agentes']['externo'];

                foreach ($internalAgent as $agent) {
                    $id = $agent['id'];
                    $abbreviation = $agent['sigla'];

                    echo "<option value='$id'>$abbreviation</option>";
                }

                echo '</optgroup>';
                echo '<optgroup label="Setores Externos">';

                foreach ($externalAgent as $agent) {
                    $id = $agent['id'];
                    $abbreviation = $agent['sigla'];

                    echo "<option value='$id'>$abbreviation</option>";
                }
                ?>
            </optgroup>
        </select>

        <label for="recipient_agent">Setor a receber:</label>
        <select id="recipient_agent" name="recipient_agent">
            <option></option>
            <optgroup label="Setores Internos">
                <?php
                $internalAgent = $data['agentes']['interno'];

                foreach ($internalAgent as $agent) {
                    $id = $agent['id'];
                    $abbreviation = $agent['sigla'];

                    echo "<option value='$id'>$abbreviation</option>";
                }
                ?>

            </optgroup>
            <optgroup label="Setores Externos">

                <?php
                $externalAgent = $data['agentes']['externo'];
                foreach ($externalAgent as $agent) {
                    $id = $agent['id'];
                    $abbreviation = $agent['sigla'];

                    echo "<option value='$id'>$abbreviation</option>";
                }
                ?>
            </optgroup>
        </select>

        <button type="button" id="addInfoButton">Adicionar Informação</button>



    </div>
</main>
<script src="js/createDemand/index.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/main.php'; ?>