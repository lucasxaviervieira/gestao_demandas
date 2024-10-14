<?php ob_start(); ?>
<main class="main-content">
    <div class="form-content">
        <div class="form-title">
            <span>
                Criação de Demanda
            </span>
        </div>

        <form action="createDemand" method="POST" id="create-demand">
        </form>

        <div class="grouped">
            <div class="form-group">
                <label for="responsable">Responsável:</label>
                <select form="create-demand" id="responsable" name="responsable">
                    <?php
                    foreach ($data['usuarios'] as $user) {
                        $id = $user['id'];
                        $username = $user['nome_usuario'];

                        echo "<option value='$id'>$username</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="activity">Atividade:</label>
                <select form="create-demand" id="activity" name="activity">
                    <?php
                    foreach ($data['atividades'] as $activity) {
                        $id = $activity['id'];
                        $name = $activity['nome'];

                        echo "<option value='$id'>$name</option>";
                    }
                    ?>
                </select>
            </div>


        </div>

        <div id="hidden-okr" style="display: none;">
            <div class="form-group">
                <label for="okr">OKR:</label>
                <select form="create-demand" id="okr" name="okr">
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
        </div>

        <div class="grouped">

            <div class="form-group">
                <label for="type">Tipo:</label>
                <select form="create-demand" id="type" name="type">
                    <option></option>
                    <?php
                    foreach ($data['tipos'] as $type) {
                        $id = $type['id'];
                        $name = $type['nome'];

                        echo "<option value='$id'>$name</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Localização:</label>
                <select form="create-demand" id="location" name="location">
                    <option></option>
                    <?php
                    foreach ($data['localizacacoes'] as $location) {
                        $id = $location['id'];
                        $name = $location['nome'];

                        echo "<option value='$id'>$name</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="sublocation">Sublocalidade:</label>
                <select form="create-demand" id="sublocation" name="sublocation">
                    <option></option>
                    <?php
                    foreach ($data['sublocalidades'] as $sublocation) {
                        $id = $sublocation['id'];
                        $name = $sublocation['nome'];

                        echo "<option value='$id'>$name</option>";
                    }
                    ?>
                </select>
            </div>

        </div>

        <div class="grouped">

            <div class="form-group">
                <label for="completion-date-limit">Prazo de Conclusão:</label>
                <input form="create-demand" type="date" id="completion-date-limit" name="completion-date-limit">
            </div>

            <div class="form-group">
                <label for="urgency">Urgente:</label>
                <select form="create-demand" id="urgency" name="urgency">
                    <option value="FALSE">não</option>
                    <option value="TRUE">sim</option>
                </select>
            </div>
        </div>

        <div class="sectors">
            <div class="grouped">
                <div class="form-group">

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
                </div>

                <div class="form-group">

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
                </div>
            </div>


            <div class="form-group">
                <button type="button" id="addInfoButton">Adicionar Informação</button>
            </div>

        </div>

        <div class="form-group">
            <div id="addedSectors"></div>
        </div>

        <div class="grouped">

            <div class="form-group">
                <label for="sei-process">N° Processo SEI:</label>
                <input id="sei-process" name="sei-process" />
            </div>

            <div class="form-group">
                <label for="process-description">Descrição:</label>
                <input id="process-description" name="process-description" />
            </div>

        </div>

        <div class="form-group">
            <button type="button" id="addProcessButton">Adicionar Processo SEI</button>
        </div>
        <div class="form-group">
            <div id="addedProcesses"></div>
        </div>

        <div class="grouped">

            <div class="form-group">

                <label for="document">N° Documento:</label>
                <input id="document" name="document" />
            </div>
            <div class="form-group">

                <label for="document-description">Descrição:</label>
                <input id="document-description" name="document-description" />

            </div>

        </div>
        <div class="form-group">
            <button type="button" id="addDocButton">Adicionar Documento</button>
        </div>



        <div class="form-group">
            <div id="addedDocuments"></div>
        </div>


        <div class="grouped">
            <div class="form-group">
                <label for="observation">Observação:</label>
                <textarea form="create-demand" id="observation" name="observation" rows="5" cols="100"
                    style="resize:none"></textarea>

            </div>
        </div>


        <button id="form-button" type="submit" form="create-demand">Criar</button>
    </div>
</main>
<script src="js/createDemand/index.js"></script>
<?php
$content = ob_get_clean();
$cssFile = 'create_demand'
?>
<?php include __DIR__ . '/../../layouts/main.php'; ?>