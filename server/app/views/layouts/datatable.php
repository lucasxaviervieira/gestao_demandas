<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Gestão de Demanda'; ?></title>
    <link rel="icon" type="image/x-icon" href="/assets/logo.png">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/datatable.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script>
        let screenHeight = screen.height;
        let scrollY = screenHeight - screenHeight * 0.35
        $(document).ready(function() {
            new DataTable('#datatable', {
                scrollX: true,
                scrollY: scrollY,
                info: false,
                paging: false,
                language: {
                    search: "Pesquisar:",
                    searchPlaceholder: "Digite para pesquisar...",
                    zeroRecords: "Nenhum registro correspondente encontrado."
                }
            });
            $('#column_filter').on('keyup', function() {
                table.column(1).search(this.value).draw();
            });
        });
    </script>

</head>

<body>

    <?php include __DIR__ . '/../components/header.php'; ?>
    <?php include __DIR__ . '/../components/navbar.php'; ?>


    <div class="content">
        <?php echo $content; ?>
    </div>
</body>

</html>