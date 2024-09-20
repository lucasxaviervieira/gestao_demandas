<?php ob_start(); ?>
<section class="section">
    <div class="title">usuarios:</div>
    <div class="users">
        <ul>
            <li>sector & username</li>
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
        <ul>
            <li>
                Atividade $$$$$$$$$$$ Situacao
            </li>
            <?php
            foreach ($data['demandas'] as $demands) {
                $activity = $demands['atividade_demanda'];
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
                // var_dump($demands);

                echo '<li>' . $activity . ' ' . $situation . '</li>';
            }
            ?>
        </ul>
    </div>
</main>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/main.php'; ?>