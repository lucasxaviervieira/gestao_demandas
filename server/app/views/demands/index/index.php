<?php ob_start();
$demand = $data['demanda_limpa'][0];
$correspondents = $data['correspondentes'];
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
                    <label for="">
                        Responsável:
                    </label>
                    <?php
                    echo "<input value='" . $demand["responsavel_demanda"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Demanda:
                    </label>
                    <?php
                    echo "<input value='" . $demand["atividade_demanda"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Localização:
                    </label>
                    <?php
                    echo "<input value='" . $demand["localizacao_nome"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Sublocalização:
                    </label>
                    <?php
                    echo "<input value='" . $demand["sublocalidade_nome"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Tipo:
                    </label>
                    <?php
                    echo "<input value='" . $demand["tipo_nome"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Situação:
                    </label>
                    <?php
                    echo "<input value='" . $demand["situacao"] . "' disabled>";
                    ?>
                </div>


                <div class='demand-attribute'>
                    <label for="">
                        Prioridade:
                    </label>
                    <?php
                    echo "<input value='" . $demand["prioridade"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Urgente:
                    </label>
                    <?php
                    echo "<input value='" . $demand["urgente"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Status
                    </label>
                    <?php

                    echo "<input value='" . $demand["status"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Atrasado:
                    </label>
                    <?php
                    echo "<input value='" . $demand["atrasado"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Data Início:
                    </label>
                    <?php
                    echo "<input value='" . $demand["data_inicio"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Data Concluido:
                    </label>
                    <?php
                    echo "<input value='" . $demand["data_concluido"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Prazo Conclusão:
                    </label>
                    <?php
                    echo "<input value='" . $demand["prazo_conclusao"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Previsão Início:
                    </label>
                    <?php
                    echo "<input value='" . $demand["previsao_inicio"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Previsão Entrega:
                    </label>
                    <?php
                    echo "<input value='" . $demand["previsao_entrega"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Dias p/ Iniciar:
                    </label>
                    <?php
                    echo "<input value='" . $demand["dias_iniciar"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Dias p/ Concluir:
                    </label>
                    <?php
                    echo "<input value='" . $demand["dias_concluir"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Dias Atrasado:
                    </label>
                    <?php
                    echo "<input value='" . $demand["dias_atrasado"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Prazo de Dias:
                    </label>
                    <?php
                    echo "<input value='" . $demand["prazo_dias"] . "' disabled>";
                    ?>
                </div>


                <div class='demand-attribute'>
                    <label for="">
                        Observação:
                    </label>
                    <?php
                    echo "<input value='" . $demand["observacao"] . "' disabled>";
                    ?>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        OKR:
                    </label>
                    <?php
                    echo "<input value='" . $demand["okr_trimestre_ano"] . "' disabled>";
                    ?>
                </div>



                <div class='demand-attribute'>
                    <label for="">
                        N° de Processo SEI:
                    </label>
                    <div class="addedItems">
                        <?php
                        foreach ($correspondents as $correspondent) {
                            var_dump($correspondent);
                            $correspondent[''];
                        }
                        ?>
                    </div>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        N° de Documento:
                    </label>
                    <div class="addedItems"></div>
                </div>

                <div class='demand-attribute'>
                    <label for="">
                        Setores:
                    </label>
                    <div class="addedItems"></div>
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