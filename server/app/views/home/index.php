<?php ob_start(); ?>
<main class="main-content">

    <div class="dashboard">
        <!-- ACTIVITY PER SITUATION -->
        <div id="demands-per-situation" style="width: 100%;height:100%;"></div>
    </div>

    <script src="js/echarts/demandsPerSituation/index.js"></script>
</main>
<?php
$content = ob_get_clean();
$cssFile = "home";
$optional = "<script src='https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js'></script>"
?>
<?php include __DIR__ . '/../layouts/main.php'; ?>