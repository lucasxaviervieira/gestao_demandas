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

                        $demand_id = $demands['id'];
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
                            <input type='hidden' name='id' value='$demand_id'>
                            <button type='submit'class='start-button'>
                                Iniciar
                            </button>
                        </form>
                        ";

                        $tr = "
                        <tr>
                            <td class='start-sticky'>$form</td>
                            <td>$activity</td>
                            <td>$location</td>
                            <td>$sublocation</td>
                            <td>$type</td>
                            <td>$situation</td>
                            <td>$status</td>
                            <td>$priority</td>
                            <td>$urgent</td>
                            <td>$delayed</td>
                            <td>$okr_description</td>
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

                        $demand_id = $demands['id'];
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
                            <input type='hidden' name='id' value='$demand_id'>
                            <button type='submit'class='finish-button'>
                                Finalizar
                            </button>
                        </form>
                        ";

                        $tr = "
                        <tr>
                            <td class='start-sticky'>$form</td>
                            <td>$activity</td>
                            <td>$location</td>
                            <td>$sublocation</td>
                            <td>$type</td>
                            <td>$situation</td>
                            <td>$status</td>
                            <td>$priority</td>
                            <td>$urgent</td>
                            <td>$delayed</td>
                            <td>$okr_description</td>
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

                        $tr = "
                        <tr>
                            <td>$activity</td>
                            <td>$location</td>
                            <td>$sublocation</td>
                            <td>$type</td>
                            <td>$situation</td>
                            <td>$status</td>
                            <td>$priority</td>
                            <td>$urgent</td>
                            <td>$delayed</td>
                            <td>$okr_description</td>
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
<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../../layouts/main.php'; ?>