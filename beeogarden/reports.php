<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BEEOGARDEN - admin interface</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fab fa-forumbee"></i>
            </div>
            <div class="sidebar-brand-text mx-3">beeogarden</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="utilizadores.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Utilizadores</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="campos.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Campos</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="produtos_loja.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Produtos Loja</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="reports.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Reports</span></a>
        </li>
        
        <li class="nav-item active">
            <a class="nav-link" href="publicacoes.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Publicações</span></a>
        </li>
        
        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="login.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                    </li>


                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Example Admin</span>
                        <img class="img-profile rounded-circle" style="height: 50px;" src="img/no_user_yellow.png">
                   </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Reports</h1>

                <?php 
                                    require_once "connections/connection.php";

                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);
                                    $query = "SELECT id_reports, data_report, ref_Utilizador, ref_post, utilizador FROM
                                    reports INNER JOIN utilizador ON ref_Utilizador = id_utilizador"; 
                                    if(mysqli_stmt_prepare($stmt,$query)){
                                        if(mysqli_stmt_execute($stmt)){
                                            mysqli_stmt_bind_result($stmt,$id_reports,$data_report,$ref_Utilizador,$ref_post,$utilizador);
                                            
                                            while(mysqli_stmt_fetch($stmt)){
                                                echo '<div class="card shadow mb-4">';
                                                echo '<div class="card-header py-3">';
                                                echo '<h6 class="m-0 font-weight-bold text-primary"style="position:absolute;width:60%;top:10%;">Report '.$id_reports.'</h6>';
                                                echo '<p style="text-align:right;">'.$id_reports.'</p>';
                                                echo '</div>';
                                                echo '<div class="card-body">';
                                                echo '<p>'.$data_report.'</p>';
                                                echo '<hr>';
                                                echo '<p class="mb-0">Post ID : '.$ref_post.'</p>';
                                                echo '<p class="mb-0">Reportado por : '.$utilizador.'</p>';
                                                echo '</div></div>';
                                            }
                                            mysqli_stmt_close($stmt);
                                            mysqli_close($link);
                                        }else{
                                         //failed execute
                                         
                                            mysqli_stmt_close($stmt);
                                            mysqli_close($link);
                                        }
                                    }else{
                                        //failed prepare
                                        mysqli_stmt_close($stmt);
                                        mysqli_close($link);
                                    }
                                ?>                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.php">Logout</a>
            </div>
        </div>
    </div>
</div>





<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>