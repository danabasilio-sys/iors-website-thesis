<?php
include('dbcon/connect.php');
if(!isset($_SESSION['is_login']))
{
    header('location:login.php');
}
$cur=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
$cur = explode('.',$cur);
$cur = $cur[0];
?>
<!DOCTYPE html>
<html lang="en">
<header>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="dist/css/custom.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</header>
<body class="hold-transition sidebar-mini layout-fixed body">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="https://inourredstilettos.com/" class="dropdown-item" target ="_blank">
                        <i class="fas fa-columns" ></i> &nbsp;&nbsp;View Website
                    </a>
                    <a href="profile.php" class="dropdown-item">
                        <i class="fas fa-user-circle" ></i> &nbsp;&nbsp;Edit Profile
                    </a>
                    <a href="logout.php" class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i> &nbsp;&nbsp;Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-info elevation-4">
        <a href="index" class="brand-link">
            <span class="brand-text font-weight-light">IORS Admin Panel</span>
        </a>
        <div class="sidebar mt-3">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <h4 style="color: #c2c7d0;">Hello,
                        <a href="#" class="d-block"><?php echo ucwords($_SESSION['name']); ?></a>
                        </h4>
                    </div>
                </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="admins" class="nav-link <?php if($cur == 'admins'){echo 'active';} ?>">
                            <i class="fas fa-users-cog"></i>
                            &nbsp;
                            <p>
                                Admins
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="questions" class="nav-link <?php if($cur == 'questions'){echo 'active';} ?>">
                            <i class="fas fa-question-circle"></i>
                            &nbsp;
                            <p>
                                Questions
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="answers" class="nav-link <?php if($cur == 'answers'){echo 'active';} ?>">
                            <i class=" fas fa-th"></i>
                            &nbsp;
                            <p>
                                Answers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="archive" class="nav-link <?php if($cur == 'archive'){echo 'active';} ?>">
                            <i class="fas fa-archive"></i>
                            &nbsp;
                            <p>
                                Archive
                            </p>
                        </a>
                    </li>
                    <?php if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){ ?>
                    <li class="nav-item">
                        <a href="audit" class="nav-link <?php if($cur == 'audit'){echo 'active';} ?>">
                            <i class="fas fa-book"></i>
                            &nbsp;
                            <p>
                                Audit
                            </p>
                        </a>
                    </li>
                    <?php } ?>
                     <li class="nav-item">
                        <a href="users" class="nav-link <?php if($cur == 'users'){echo 'active';} ?>">
                            <i class="fas fa-users"></i>
                            &nbsp;
                            <p>
                                Users
                            </p>
                        </a>
                    </li> 
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
