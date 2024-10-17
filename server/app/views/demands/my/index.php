<?php ob_start(); ?>

<main class="main-content">
    <div class="container">
        <div class="title-container">
            <span id="first">
                Não Iniciadas
            </span>
        </div>
        <div class="content-container">
            <table>
                <thead>
                    <tr>
                        <th class="start-sticky">Iniciar</th>
                        <th>Demanda</th>
                        <th>Localização</th>
                        <th>Sublocalização</th>
                        <th>Tipo</th>
                        <th>Situação</th>
                        <th>Status</th>
                        <th>Prioridade</th>
                        <th>Urgente</th>
                        <th>Atrasado</th>
                        <th>OKR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['demandas_separadas']['NOT_STARTED'] as $demands) {

                        $demandId = $demands['id'];
                        $activity = $demands['atividade_demanda'];
                        $location = $demands['localizacao_nome'];
                        $sublocation = $demands['sublocalidade_nome'];
                        $type = $demands['tipo_nome'];
                        $situation = $demands['situacao'];
                        $status = $demands['status'];
                        $priority = $demands['prioridade'];
                        $urgent = $demands['urgente'];
                        $delayed = $demands['atrasado'];
                        $okr_description = $demands['okr_trimestre_ano'];

                        $form = "
                        <form action='../moveDemand/startDemand' method='POST'>
                            <input type='hidden' name='id' value='$demandId'>
                            <button type='submit'class='start-button'>
                                Iniciar
                            </button>
                        </form>
                        ";

                        $jsCode = "window.open(`/demand?id=$demandId`, `_blank`)";
                        $redirect = "onclick='$jsCode'";

                        $tr = "
                        <tr>
                            <td class='start-sticky'>$form</td>
                            <td $redirect>$activity</td>
                            <td $redirect>$location</td>
                            <td $redirect>$sublocation</td>
                            <td $redirect>$type</td>
                            <td $redirect>$situation</td>
                            <td $redirect>$status</td>
                            <td $redirect>$priority</td>
                            <td $redirect>$urgent</td>
                            <td $redirect>$delayed</td>
                            <td $redirect>$okr_description</td>
                        </tr>
                        ";
                        echo $tr;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <div class="title-container">
            <span id="second">
                Em Progresso
            </span>
        </div>
        <div class="content-container">
            <table>
                <thead>
                    <tr>
                        <th class="start-sticky">Finalizar</th>
                        <th>Demanda</th>
                        <th>Localização</th>
                        <th>Sublocalização</th>
                        <th>Tipo</th>
                        <th>Situação</th>
                        <th>Status</th>
                        <th>Prioridade</th>
                        <th>Urgente</th>
                        <th>Atrasado</th>
                        <th>OKR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['demandas_separadas']['IN_PROGRESS'] as $demands) {

                        $demandId = $demands['id'];
                        $activity = $demands['atividade_demanda'];
                        $location = $demands['localizacao_nome'];
                        $sublocation = $demands['sublocalidade_nome'];
                        $type = $demands['tipo_nome'];
                        $situation = $demands['situacao'];
                        $status = $demands['status'];
                        $priority = $demands['prioridade'];
                        $urgent = $demands['urgente'];
                        $delayed = $demands['atrasado'];
                        $okr_description = $demands['okr_trimestre_ano'];

                        $form = "
                        <form action='../moveDemand/finishDemand' method='POST'>
                            <input type='hidden' name='id' value='$demandId'>
                            <button type='submit'class='finish-button'>
                                Finalizar
                            </button>
                        </form>
                        ";

                        $jsCode = "window.open(`/demand?id=$demandId`, `_blank`)";
                        $redirect = "onclick='$jsCode'";

                        $tr = "
                        <tr>
                            <td class='start-sticky'>$form</td>
                            <td $redirect>$activity</td>
                            <td $redirect>$location</td>
                            <td $redirect>$sublocation</td>
                            <td $redirect>$type</td>
                            <td $redirect>$situation</td>
                            <td $redirect>$status</td>
                            <td $redirect>$priority</td>
                            <td $redirect>$urgent</td>
                            <td $redirect>$delayed</td>
                            <td $redirect>$okr_description</td>
                        </tr>
                        ";
                        echo $tr;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <div class="title-container">
            <span id="third">
                Finalizadas
            </span>
        </div>
        <div class="content-container">
            <table>
                <thead>
                    <tr>
                        <th>Demanda</th>
                        <th>Localização</th>
                        <th>Sublocalização</th>
                        <th>Tipo</th>
                        <th>Situação</th>
                        <th>Status</th>
                        <th>Prioridade</th>
                        <th>Urgente</th>
                        <th>Atrasado</th>
                        <th>OKR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['demandas_separadas']['FINISHED'] as $demands) {

                        $demandId = $demands['id'];
                        $activity = $demands['atividade_demanda'];
                        $location = $demands['localizacao_nome'];
                        $sublocation = $demands['sublocalidade_nome'];
                        $type = $demands['tipo_nome'];
                        $situation = $demands['situacao'];
                        $status = $demands['status'];
                        $priority = $demands['prioridade'];
                        $urgent = $demands['urgente'];
                        $delayed = $demands['atrasado'];
                        $okr_description = $demands['okr_trimestre_ano'];

                        $jsCode = "window.open(`/demand?id=$demandId`, `_blank`)";
                        $redirect = "onclick='$jsCode'";

                        $tr = "
                        <tr>
                            <td $redirect>$activity</td>
                            <td $redirect>$location</td>
                            <td $redirect>$sublocation</td>
                            <td $redirect>$type</td>
                            <td $redirect>$situation</td>
                            <td $redirect>$status</td>
                            <td $redirect>$priority</td>
                            <td $redirect>$urgent</td>
                            <td $redirect>$delayed</td>
                            <td $redirect>$okr_description</td>
                        </tr>
                        ";
                        echo $tr;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
$content = ob_get_clean();
$cssFile = 'my_demand'
?>
<?php include __DIR__ . '/../../layouts/main.php'; ?>