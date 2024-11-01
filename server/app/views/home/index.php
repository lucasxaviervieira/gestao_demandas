<?php ob_start(); ?>
<main class="main-content">
    <div class="content-title">
        <span>
            Dashboards
        </span>
    </div>

    <!-- SITUATION OF DEMANDS -->
    <div class="dashboard">
        <div id="situation-of-demands" style="width: 100%;height:100%;"></div>
    </div>

    <!-- DELAYED SITUATIONS -->
    <div class="dashboard">
        <div id="delayed-situations" style="width: 100%;height:100%;"></div>
    </div>

    <!-- ACTIVITY PER SITUATION -->
    <div class="dashboard">
        <div id="demands-per-activities" style="width: 100%;height:100%;"></div>
    </div>

    <script src="js/echarts/situationOfDemands/index.js"></script>
    <script src="js/echarts/delayedSituations/index.js"></script>
    <script src="js/echarts/demandsPerActivities/index.js"></script>
</main>
<?php
$content = ob_get_clean();
$cssFile = "home";
$optional = "<script src='https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js'></script>"
?>
<?php include __DIR__ . '/../layouts/main.php'; ?>