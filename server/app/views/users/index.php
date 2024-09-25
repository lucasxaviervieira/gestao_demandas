<?php ob_start(); ?>
<section class="section">
    <div class="users">
        <ul>

            <?php
            foreach ($data['usuarios'] as $sector => $users) {

                echo "<li><strong>$sector</strong></li>";

                echo "<ul>";
                foreach ($users as $user) {
                    $username = ($user['username']);
                    $id = ($user['id']);

                    echo '<li><a href="/user?id=' . $id . '">' . $username . '</a></li>';
                }
                echo "</ul>";
            }
            ?>
        </ul>
    </div>
</section>
<main class="main">
    <div class="ctrl-demands">
        <table id="datatable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Demanda</th>
                    <th>Localizacao</th>
                    <th>Sublocalização</th>
                    <th>Tipo</th>
                    <th>Situação</th>
                    <th>Status</th>
                    <th>Prioridade</th>
                    <th>Urgente</th>
                    <th>Atrasado</th>
                    <th>Data Inicio</th>
                    <th>Data Concluido</th>
                    <th>Prazo Conclusão</th>
                    <th>Previsão Início</th>
                    <th>Previsão Entrega</th>
                    <th>Dias p/ Iniciar</th>
                    <th>Dias p/ Concluir</th>
                    <th>Dias atrasado</th>
                    <th>Prazo de Dias</th>
                    <th>OKR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data['demandas'] as $demands) {
                    $cleanDemands = [];

                    foreach ($demands as $key => $value) {
                        $cleanDemands[$key] = $value === null ? '-' : $value;
                        if (gettype($value) === 'boolean') {
                            $cleanDemands[$key] = $value == false ? 'não' : 'sim';
                        }
                    }

                    $activity = $cleanDemands['atividade_demanda'];
                    $location = $cleanDemands['localizacao_nome'];
                    $sublocation = $cleanDemands['sublocalidade_nome'];
                    $type = $cleanDemands['tipo_nome'];
                    $situation = $cleanDemands['situacao'];
                    $status = $cleanDemands['status'];
                    $priority = $cleanDemands['prioridade'];
                    $urgent = $cleanDemands['urgente'];
                    $delayed = $cleanDemands['atrasado'];
                    $created_date = $cleanDemands['data_criado'];
                    $start_date = $cleanDemands['data_inicio'];
                    $conclusion_date = $cleanDemands['data_concluido'];
                    $deadline_date = $cleanDemands['prazo_conclusao'];
                    $predicted_start = $cleanDemands['previsao_inicio'];
                    $estimated_delivery = $cleanDemands['previsao_entrega'];
                    $days_start = $cleanDemands['dias_iniciar'];
                    $days_conclude = $cleanDemands['dias_concluir'];
                    $days_late = $cleanDemands['dias_atrasado'];
                    $deadline_days = $cleanDemands['prazo_dias'];
                    $okr_description = $cleanDemands['okr_trimestre_ano'];

                    echo "
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
                        <td>$start_date</td>
                        <td>$conclusion_date</td>
                        <td>$deadline_date</td>
                        <td>$predicted_start</td>
                        <td>$estimated_delivery</td>
                        <td>$days_start</td>
                        <td>$days_conclude</td>
                        <td>$days_late</td>
                        <td>$deadline_days</td>
                        <td>$okr_description</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/datatable.php'; ?>