<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?= parameter('applicationTittle') ?></title>
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <link href="/css/sb-admin.css" rel="stylesheet">
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1" href="index.html"><?= parameter('applicationName') ?></a>
            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <ul class="navbar-nav ml-auto ml-md-0">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">Settings</a>
                            <div class="dropdown-divider"></div>
<!--                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>-->
                            <a class="dropdown-item" href="/Home/Logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </form>
        </nav>
        <div id="wrapper">
            <ul class="sidebar navbar-nav">
                <?php
                    foreach (menu() as $item) {
                        $type = count($item['children']) > 0 ? 'dropdown' : '';
                        $typeLink = count($item['children']) > 0 ? 'dropdown-toggle' : '';
                        $link = count($item['children']) > 0 ? '#' : $item['link'];
                        $configChild =  count($item['children']) > 0 ? 'id="pagesDropdown'.$item['label'].'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"'
                            : '';
                ?>
                    <li class="nav-item <?= $type ?>">
                        <a class="nav-link <?= $typeLink ?>" href="<?= $link  ?>" <?= $configChild ?>>
                            <i class="<?= $item['icon'] ?>"></i>
                            <span><?= $item['label'] ?></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="pagesDropdown<?= $item['label'] ?>" >
                           <?php foreach ($item['children'] as $child ) { ?>
                                <a class="dropdown-item" href="<?= $child['link'] ?> ">
                                    <?= $child['label'] ?>
                                </a>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>

            <div id="content-wrapper">
                <div class="container-fluid">
                    <?php echo $content; ?>
                </div>
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright © Your Website 2019</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
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
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="/vendor/chart.js/Chart.min.js"></script>
        <script src="/vendor/datatables/jquery.dataTables.js"></script>
        <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>
        <script src="/js/sb-admin.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>
        <script src="/js/demo/chart-area-demo.js"></script>
    </body>
</html>
