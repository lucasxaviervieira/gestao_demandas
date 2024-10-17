<?php ob_start();
$demand = $data['demanda_limpa'][0];
$correspondents = $data['correspondentes'];
$processes = $data['processos'];
$documents = $data['documentos'];
?>

<main class="main-content">

    <div class="container">
        <div class="title-container">
            <span>
                Demanda
            </span>
        </div>
        <div class="content-container">

            <div class="demand">
                <div class='demand-attribute'>
                    <label>
                        Responsável:
                    </label>
                    <?php
                    echo "<input value='" . $demand["responsavel_demanda"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Demanda:
                    </label>
                    <?php
                    echo "<input value='" . $demand["atividade_demanda"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Localização:
                    </label>
                    <?php
                    echo "<input value='" . $demand["localizacao_nome"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Sublocalização:
                    </label>
                    <?php
                    echo "<input value='" . $demand["sublocalidade_nome"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Tipo:
                    </label>
                    <?php
                    echo "<input value='" . $demand["tipo_nome"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Situação:
                    </label>
                    <?php
                    echo "<input value='" . $demand["situacao"] . "' disabled>";
                    ?>
                </div>


                <div class='demand-attribute'>
                    <label>
                        Prioridade:
                    </label>
                    <?php
                    echo "<input value='" . $demand["prioridade"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Urgente:
                    </label>
                    <?php
                    echo "<input value='" . $demand["urgente"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Status:
                    </label>
                    <?php

                    echo "<input value='" . $demand["status"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Atrasado:
                    </label>
                    <?php
                    echo "<input value='" . $demand["atrasado"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Data Início:
                    </label>
                    <?php
                    echo "<input value='" . $demand["data_inicio"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Data Concluido:
                    </label>
                    <?php
                    echo "<input value='" . $demand["data_concluido"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Prazo Conclusão:
                    </label>
                    <?php
                    echo "<input value='" . $demand["prazo_conclusao"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Previsão Início:
                    </label>
                    <?php
                    echo "<input value='" . $demand["previsao_inicio"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Previsão Entrega:
                    </label>
                    <?php
                    echo "<input value='" . $demand["previsao_entrega"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Dias p/ Iniciar:
                    </label>
                    <?php
                    echo "<input value='" . $demand["dias_iniciar"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Dias p/ Concluir:
                    </label>
                    <?php
                    echo "<input value='" . $demand["dias_concluir"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Dias Atrasado:
                    </label>
                    <?php
                    echo "<input value='" . $demand["dias_atrasado"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Prazo de Dias:
                    </label>
                    <?php
                    echo "<input value='" . $demand["prazo_dias"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Observação:
                    </label>
                    <?php
                    echo "<input value='" . $demand["observacao"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label>
                        OKR:
                    </label>
                    <?php
                    echo "<input value='" . $demand["okr_trimestre_ano"] . "' disabled>";
                    ?>
                </div>
            </div>

            <div class="added">
                <div class='added-item'>
                    <label>
                        N° de Documento:
                    </label>
                    <div class="grouped">
                        <table>
                            <thead>
                                <tr>
                                    <th>Referência</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($processes as $process) {
                                    $reference = $process['referencia'];
                                    $description = $process['descricao'];

                                    $tr = "
                                    <tr>
                                        <td><input value='$reference'disabled></td>
                                        <td><input value='$description'disabled></td>
                                    </tr>
                                    ";
                                    echo $tr;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class='added-item'>
                    <label>
                        N° de Processo SEI:
                    </label>
                    <div class="grouped">
                        <table>
                            <thead>
                                <tr>
                                    <th>Referência</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($documents as $document) {
                                    $reference = $document['referencia'];
                                    $description = $document['descricao'];

                                    $tr = "
                                    <tr>
                                        <td><input value='$reference'disabled></td>
                                        <td><input value='$description'disabled></td>
                                    </tr>
                                    ";
                                    echo $tr;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class='added-item'>
                    <label>
                        Setores:
                    </label>
                    <div class="grouped">
                        <table>
                            <thead>
                                <tr>
                                    <th>Enviar</th>
                                    <th>Receber</th>
                                    <th>Respondido</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($correspondents as $correspondent) {

                                    $sender = $correspondent['remetente_sigla'];
                                    $recipient = $correspondent['destinatario_sigla'];

                                    $checkbox = "<input type='checkbox' checked='checked' onclick='return false'>";

                                    if (!isset($correspondent['data_respondido'])) {
                                        $checkbox = "<input type='checkbox' onclick='return false'>";
                                    };

                                    $tr = "
                                    <tr>
                                        <td><input value='$sender'disabled></td>
                                        <td><input value='$recipient'disabled></td>
                                        <td>$checkbox</td>
                                    </tr>
                                    ";
                                    echo $tr;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <form action="../UpdateCptDate/" method="POST">
                        <?php
                        $demandId = $demand['id'];
                        echo "<input type='hidden' name='id' value='$demandId'>"
                        ?>
                        <button type='submit' class="response">Responder</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>
<?php
$content = ob_get_clean();
$cssFile = 'demand'
?>
<?php include __DIR__ . '/../../layouts/main.php'; ?>