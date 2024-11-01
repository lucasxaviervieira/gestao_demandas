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
                    <input value='<?= $demand["responsavel_demanda"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Demanda:
                    </label>
                    <input value='<?= $demand["atividade_demanda"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Localização:
                    </label>
                    <input value='<?= $demand["localizacao_nome"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Sublocalização:
                    </label>
                    <input value='<?= $demand["sublocalidade_nome"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Tipo:
                    </label>
                    <input value='<?= $demand["tipo_nome"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Situação:
                    </label>
                    <input value='<?= $demand["situacao"] ?>' disabled>
                </div>


                <div class='demand-attribute'>
                    <label>
                        Prioridade:
                    </label>
                    <input value='<?= $demand["prioridade"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Urgente:
                    </label>
                    <input value='<?= $demand["urgente"] ?>' disabled>
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
                    <input value='<?= $demand["atrasado"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Data Início:
                    </label>
                    <input value='<?= $demand["data_inicio"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Data Concluido:
                    </label>
                    <input value='<?= $demand["data_concluido"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Prazo Conclusão:
                    </label>
                    <input value='<?= $demand["prazo_conclusao"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Previsão Início:
                    </label>
                    <input value='<?= $demand["previsao_inicio"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Previsão Entrega:
                    </label>
                    <input value='<?= $demand["previsao_entrega"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Dias p/ Iniciar:
                    </label>
                    <input value='<?= $demand["dias_iniciar"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Dias p/ Concluir:
                    </label>
                    <input value='<?= $demand["dias_concluir"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Dias Atrasado:
                    </label>
                    <input value='<?= $demand["dias_atrasado"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Prazo de Dias:
                    </label>
                    <input value='<?= $demand["prazo_dias"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        Observação:
                    </label>
                    <input value='<?= $demand["observacao"] ?>' disabled>
                </div>

                <div class='demand-attribute'>
                    <label>
                        OKR:
                    </label>
                    <input value='<?= $demand["okr_trimestre_ano"] ?>' disabled>
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
                                <?php foreach ($processes as $process): ?>
                                <tr>
                                    <td><input value='<?= $process['referencia']; ?>' disabled></td>
                                    <td><input value='<?= $process['descricao']; ?>' disabled></td>
                                </tr>
                                <?php endforeach; ?>
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
                                <?php foreach ($documents as $document): ?>
                                <tr>
                                    <td><input value='<?= $document['referencia']; ?>' disabled></td>
                                    <td><input value='<?= $document['descricao']; ?>' disabled></td>
                                </tr>
                                <?php endforeach; ?>
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
                                <?php foreach ($correspondents as $correspondent): ?>

                                <?php
                                    $checkbox = (isset($correspondent['data_respondido'])) ? 'checked="checked"' : ''
                                    ?>

                                <tr>
                                    <td><input value='<?= $correspondent['remetente_sigla'] ?>' disabled></td>
                                    <td><input value='<?= $correspondent['destinatario_sigla'] ?>' disabled></td>
                                    <td><input type='checkbox' <?= $checkbox ?> onclick='return false'></td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <form action="../UpdateCptDate/" method="POST">
                        <input type='hidden' name='id' value='<?= $demand['id'] ?>'>
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