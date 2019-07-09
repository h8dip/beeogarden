<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BEEOGARDEN - campos</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
<?php 
include_once "scripts/check_admin.php";

checkAdmin();
?>
<!-- Page Wrapper -->
<div id="wrapper">

<?php 
        include_once "components/Sidebar.php"
?>


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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                        <img class="img-profile rounded-circle" style="height: 50px;" src="img/no_user_yellow.png">
                   </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Tabela Compras Concluidas Registadas</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Compras </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <?php 
                        if(isset($_GET['page'])){
                            $name_of_page = "compras.php?page=".htmlspecialchars($_GET['page']);
                          }else{ 
                            $name_of_page = "compras.php";
                          }

                        include_once "components/search_entry.php"
                            ?></div>
                            <div class="row"><div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 157px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 257px;">Preço Total</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 257px;">Comprador</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 257px;">Produtos</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 257px;">Compra Concluida</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 157px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 257px;">Preço Total</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 257px;">Comprador</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 257px;">Produtos</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 257px;">Compra Concluida</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php 
                                    require_once "connections/connection.php";

                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);

                                    $link2 = new_db_connection();
                                    $stmt2 = mysqli_stmt_init($link2);

                                    if(isset($_POST['select_entries'])){
                                        if(!empty($_POST['select_entries'])){
                                            if(is_numeric($_POST['select_entries'])){
                                                $items_per_page = $_POST['select_entries'];
                                            }else{
                                                $items_per_page = 10;
                                            }
                                        }else{$items_per_page = 10;}
                                    }else{$items_per_page = 10;}
                                    $current_page = 1;
                                    if(isset($_GET['page']) & !empty($_GET['page'])){
                                        $current_page= $_GET['page'];
                                    }

                                    $start = ($current_page * $items_per_page) - $items_per_page;
                                    
                                    $ctQ = "SELECT COUNT(*) FROM compras";
                                    $count = 0;
                                    if(mysqli_stmt_prepare($stmt,$ctQ)){
                                        if(mysqli_stmt_execute($stmt)){
                                            mysqli_stmt_bind_result($stmt,$count);
                                            mysqli_stmt_fetch($stmt);
                                        }
                                    }

                                    $end_page = ceil($count/$items_per_page);
                                    $start_page = 1;
                                    $next_page = $current_page+1;
                                    $previous_page = $current_page-1;
                                    
                                    if(isset($_POST)){
                                        if(!empty($_POST['search_query'])){
                                            $query = "SELECT id_compra, preco_total, data_compra, ref_Utilizador,utilizador FROM compras INNER JOIN utilizador ON ref_Utilizador = id_utilizador WHERE utilizador LIKE \"%" . htmlspecialchars($_POST['search_query']) . "%\"" . " LIMIT $start, $items_per_page";
                                        }else{
                                            $query = "SELECT id_compra, preco_total, data_compra, ref_Utilizador,utilizador FROM compras INNER JOIN utilizador ON ref_Utilizador = id_utilizador LIMIT $start, $items_per_page";
                                        }
                                    }else{
                                        $query = "SELECT id_compra, preco_total, data_compra, ref_Utilizador,utilizador FROM compras INNER JOIN utilizador ON ref_Utilizador = id_utilizador LIMIT $start, $items_per_page";
                                    }
                                    
                                    

                                    if(mysqli_stmt_prepare($stmt,$query)){
                                        if(mysqli_stmt_execute($stmt)){
                                            mysqli_stmt_bind_result($stmt,$id_compra,$preco_total,$data_compra,$ref_U,$utilizador);

                                            while(mysqli_stmt_fetch($stmt)){
                                                echo '<tr role="row" class="odd">';
                                                echo '<td class="sorting_1">'.$id_compra.'</td>';
                                                echo '<td>'.$preco_total.'€</td>';
                                                echo '<td>'.$utilizador.'</td>';
                                                echo '<td>';
                                                $new_query = "SELECT ref_compra, ref_produto, quantidade,custo_produto,nome_produto
                                                FROM compras_has_produto INNER JOIN produto WHERE id_produto = ref_produto AND ref_compra = ?";
                                                if(mysqli_stmt_prepare($stmt2,$new_query)){
                                                    mysqli_stmt_bind_param($stmt2,'i',$id_compra);
                                                    if(mysqli_stmt_execute($stmt2)){
                                                    mysqli_stmt_bind_result($stmt2,$ref_compra,$ref_produto,$quantidade
                                                    ,$custo_produto,$nome_produto);
                                                    while(mysqli_stmt_fetch($stmt2)){
                                                        echo $nome_produto . ' - ' . $quantidade . 'x - ' . $custo_produto . '€;<br>'; 
                                                    }
                                                }
                                                }
                                                echo '</td>';
                                                if(empty($data_compra)){
                                                    echo '<td>Compra ainda não concluida.</td>';
                                                }else{
                                                    echo '<td>Concluida : '.$data_compra.'</td>';
                                                }
                                            }
                                            //mysqli_stmt_close($stmt);
                                            //mysqli_close($link);
                                            //mysqli_stmt_close($stmt2);
                                            //mysqli_close($link2);
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
                                </tbody>
                            </table></div></div>
                            <?php include_once "components/bottom_entries.php" ?>
                                       </div>
                    </div>
                </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Beeogarden 2019</span>
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