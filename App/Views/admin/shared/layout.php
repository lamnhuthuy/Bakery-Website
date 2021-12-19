<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geek's Bakery-Admin</title>
    <link rel="shortcut icon" href="<?= PUB ?>/icons/favio.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= PUB . "/admin" ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= PUB . "/admin" ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= PUB . "/admin" ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= PUB . "/admin" ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= PUB . "/admin" ?>/dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php if (strpos($view, "login") !== false) : ?>
            <?php require_once(VIEW .  $view . ".php") ?>
        <?php else : ?>
            <?php require_once(VIEW . "/admin/shared/header.php") ?>
            <?php require_once(VIEW . "/admin/shared/sidebar.php") ?>
            <div class="content-wrapper">
                <?php require_once(VIEW .  $view . ".php") ?>
            </div>
            <?php require_once(VIEW . "/admin/shared/footer.php") ?>
        <?php endif ?>
    </div>


    <!-- jQuery -->
    <script src="<?= PUB . "/admin" ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= PUB . "/admin" ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= PUB . "/admin" ?>/dist/js/adminlte.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?= PUB . "/admin" ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= PUB . "/admin" ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $(function() {
            $("#myTable").DataTable({
                "paging": true,
                "ordering": true,
                "responsive": true,
                "lengthChange": true,
                "searching": true,
                "autoWidth": false,
                "buttons": ["copy", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');
        });
    </script>

</body>

</html>