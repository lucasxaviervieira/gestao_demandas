<?php ob_start(); ?>
<?php
$showDatatable = ($data['demandas_limpas'] == []) ? 'hidden' : 'show';
?>
<section class="section">
    <ul>
        <li class='sector'><strong>Setores</strong></li>
        <?php foreach ($data['setores'] as $sector => $sectors): ?>
            <ul>
                <?php foreach ($sectors as $sector): ?>
                    <li class="section-options">
                        <a href="/sector?id=<?= $sector['id'] ?>"> <?= $sector['sigla'] ?> </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </ul>
</section>

<span id='toogle-datatable' style='display:none;'><?= $showDatatable ?></span>
<main class="main" id='main' style="opacity:0">
    <div id="no-content">
        SEM DEMANDAS
    </div>
    <div id="ctrl-demand">
        <table id="datatable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Responsável</th>
                    <th>Demanda</th>
                    <th>Localização</th>
                    <th>Sublocalização</th>
                    <th>Tipo</th>
                    <th>Situação</th>
                    <th>Status</th>
                    <th>Prioridade</th>
                    <th>Urgente</th>
                    <th>Atrasado</th>
                    <th>Data Início</th>
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
                <?php foreach ($data['demandas_limpas'] as $demands): ?>
                    <tr>
                        <td> <?= $demands['id'] ?> </td>
                        <td> <?= $demands['responsavel_demanda'] ?> </td>
                        <td> <?= $demands['atividade_demanda'] ?> </td>
                        <td> <?= $demands['localizacao_nome'] ?> </td>
                        <td> <?= $demands['sublocalidade_nome'] ?> </td>
                        <td> <?= $demands['tipo_nome'] ?> </td>
                        <td> <?= $demands['situacao'] ?> </td>
                        <td> <?= $demands['status'] ?> </td>
                        <td> <?= $demands['prioridade'] ?> </td>
                        <td> <?= $demands['urgente'] ?> </td>
                        <td> <?= $demands['atrasado'] ?> </td>
                        <td> <?= $demands['data_inicio'] ?> </td>
                        <td> <?= $demands['data_concluido'] ?> </td>
                        <td> <?= $demands['prazo_conclusao'] ?> </td>
                        <td> <?= $demands['previsao_inicio'] ?> </td>
                        <td> <?= $demands['previsao_entrega'] ?> </td>
                        <td> <?= $demands['dias_iniciar'] ?> </td>
                        <td> <?= $demands['dias_concluir'] ?> </td>
                        <td> <?= $demands['dias_atrasado'] ?> </td>
                        <td> <?= $demands['prazo_dias'] ?> </td>
                        <td> <?= $demands['okr_trimestre_ano'] ?> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>


<script src="js/demands/index.js"></script>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../../layouts/datatable.php'; ?>