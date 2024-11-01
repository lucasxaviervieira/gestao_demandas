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
                    <?php foreach ($data['demandas_separadas']['NOT_STARTED'] as $demands): ?>

                    <?php
                        $demandId = $demands['id'];
                        $jsCode = "window.open(`/demand?id=$demandId`, `_blank`)";
                        $redirect = "onclick='$jsCode'";
                        ?>

                    <tr>
                        <td class='start-sticky'>
                            <form action='../moveDemand/startDemand' method='POST'>
                                <input type='hidden' name='id' value='<?= $demandId ?>'>
                                <button type='submit' class='start-button'>
                                    Iniciar
                                </button>
                            </form>
                        </td>
                        <td <?= $redirect ?>><?= $demands['atividade_demanda']; ?></td>
                        <td <?= $redirect ?>><?= $demands['localizacao_nome']; ?></td>
                        <td <?= $redirect ?>><?= $demands['sublocalidade_nome']; ?></td>
                        <td <?= $redirect ?>><?= $demands['tipo_nome']; ?></td>
                        <td <?= $redirect ?>><?= $demands['situacao']; ?></td>
                        <td <?= $redirect ?>><?= $demands['status']; ?></td>
                        <td <?= $redirect ?>><?= $demands['prioridade']; ?></td>
                        <td <?= $redirect ?>><?= $demands['urgente']; ?></td>
                        <td <?= $redirect ?>><?= $demands['atrasado']; ?></td>
                        <td <?= $redirect ?>><?= $demands['okr_trimestre_ano']; ?></td>
                    </tr>
                    <?php endforeach; ?>


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
                    <?php foreach ($data['demandas_separadas']['IN_PROGRESS'] as $demands): ?>

                    <?php
                        $demandId = $demands['id'];
                        $jsCode = "window.open(`/demand?id=$demandId`, `_blank`)";
                        $redirect = "onclick='$jsCode'";
                        ?>

                    <tr>
                        <td class='start-sticky'>
                            <form action='../moveDemand/finishDemand' method='POST'>
                                <input type='hidden' name='id' value='<?= $demandId ?>'>
                                <button type='submit' class='finish-button'>
                                    Finalizar
                                </button>
                            </form>
                        </td>
                        <td <?= $redirect ?>> <?= $demands['atividade_demanda'] ?></td>
                        <td <?= $redirect ?>> <?= $demands['localizacao_nome'] ?></td>
                        <td <?= $redirect ?>> <?= $demands['sublocalidade_nome'] ?></td>
                        <td <?= $redirect ?>> <?= $demands['tipo_nome'] ?></td>
                        <td <?= $redirect ?>> <?= $demands['situacao'] ?></td>
                        <td <?= $redirect ?>> <?= $demands['status'] ?></td>
                        <td <?= $redirect ?>> <?= $demands['prioridade'] ?></td>
                        <td <?= $redirect ?>> <?= $demands['urgente'] ?></td>
                        <td <?= $redirect ?>> <?= $demands['atrasado'] ?></td>
                        <td <?= $redirect ?>> <?= $demands['okr_trimestre_ano'] ?></td>
                    </tr>

                    <?php endforeach; ?>

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
                    <?php foreach ($data['demandas_separadas']['FINISHED'] as $demands): ?>

                    <?php
                        $demandId = $demands['id'];
                        $jsCode = "window.open(`/demand?id=$demandId`, `_blank`)";
                        $redirect = "onclick='$jsCode'";
                        ?>

                    <tr>
                        <td <?= $redirect ?>> <?= $demands['atividade_demanda']; ?></td>
                        <td <?= $redirect ?>> <?= $demands['localizacao_nome']; ?></td>
                        <td <?= $redirect ?>> <?= $demands['sublocalidade_nome']; ?></td>
                        <td <?= $redirect ?>> <?= $demands['tipo_nome']; ?></td>
                        <td <?= $redirect ?>> <?= $demands['situacao']; ?></td>
                        <td <?= $redirect ?>> <?= $demands['status']; ?></td>
                        <td <?= $redirect ?>> <?= $demands['prioridade']; ?></td>
                        <td <?= $redirect ?>> <?= $demands['urgente']; ?></td>
                        <td <?= $redirect ?>> <?= $demands['atrasado']; ?></td>
                        <td <?= $redirect ?>> <?= $demands['okr_trimestre_ano']; ?></td>
                    </tr>
                    <?php endforeach; ?>


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