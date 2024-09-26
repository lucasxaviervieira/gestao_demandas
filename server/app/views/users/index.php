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
<main class="main" id='main'>
    <div id="no-content">
        <div class=""></div>
        SEM DEMANDAS
    </div>
    <div id="ctrl-demand">
        <?php
        $showDatatable = ($data['demandas_limpas'] == []) ? 'hidden' : 'show';
        echo "<span id='toogle-datatable' style='display:none;'>$showDatatable</span>"
        ?>
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
                foreach ($data['demandas_limpas'] as $demands) {

                    $activity = $demands['atividade_demanda'];
                    $location = $demands['localizacao_nome'];
                    $sublocation = $demands['sublocalidade_nome'];
                    $type = $demands['tipo_nome'];
                    $situation = $demands['situacao'];
                    $status = $demands['status'];
                    $priority = $demands['prioridade'];
                    $urgent = $demands['urgente'];
                    $delayed = $demands['atrasado'];
                    $created_date = $demands['data_criado'];
                    $start_date = $demands['data_inicio'];
                    $conclusion_date = $demands['data_concluido'];
                    $deadline_date = $demands['prazo_conclusao'];
                    $predicted_start = $demands['previsao_inicio'];
                    $estimated_delivery = $demands['previsao_entrega'];
                    $days_start = $demands['dias_iniciar'];
                    $days_conclude = $demands['dias_concluir'];
                    $days_late = $demands['dias_atrasado'];
                    $deadline_days = $demands['prazo_dias'];
                    $okr_description = $demands['okr_trimestre_ano'];

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

<script src="js/usersDemand/index.js"></script>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/datatable.php'; ?>