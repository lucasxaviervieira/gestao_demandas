<?php
$sectorId = $data['sectorId'][0]['id'];
$userId = $data['userId'][0]['id'];
$sectorLink = "/sector?id=$sectorId";
$userLink = "/user?id=$userId";
?>
<navbar class="navbar">
    <ul>
        <li>
            <a href="/home" id="navbar-first">
                Dashboards (em breve)
            </a>
        </li>
        <li>
            <a href="<?= $sectorLink ?>" id="navbar-second">
                Setores
            </a>

        </li>
        <li>
            <a href="<?= $userLink ?>" id="navbar-third">
                Usuários
            </a>
        </li>
        <li>
            <a href="/my" id="navbar-fourth">
                Minhas Demandas
            </a>
        </li>
        <li class="create-demand">
            <a href="/create" id="navbar-fifth">
                Criar Demanda
            </a>
        </li>
    </ul>
</navbar>