<?php 
    session_start();

    if (!isset($_SESSION["username"])) {
        header("Location: ../user/index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($page_title) ? $page_title : 'Estoque'; ?></title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/public/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="/public/css/fullcalendar.css"/>
    <link rel="stylesheet" href="/public/css/matrix-style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="/public/css/style.css"/>
    <link rel="stylesheet" href="/public/css/matrix-media.css"/>
    <link href="/public/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/public/css/jquery.gritter.css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body>

<div id="header">
    <h2 style="color: white;position: absolute">
        <a href="/view/admin/demo.php" style="color:white; margin-left: 30px; margin-top: 40px">Estoque</a>
    </h2>
</div>

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages">
            <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i
                    class="icon icon-user"></i> <span class="text">Welcome <?php echo $_SESSION["role"]; ?></span><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                <li class="divider"></li>
                <li><a href="/view/user/demo.php"><i class="icon-key"></i> User account</a></li>
                <li class="divider"></li>
                <li><a href="/logout.php"><i class="icon-signout"></i> Log Out</a></li>
            </ul>
        </li>
    </ul>
</div>

<!--sidebar-menu-->
<div id="sidebar">
    <ul>
        <?php if ($_SESSION["role"] == 'admin') : ?>
            <li><a href="/view/admin/demo.php"><i class="icon icon-dashboard"></i><span>Dashboard</span></a></li>
            <li><a href="/view/admin/add_new_user.php"><i class="icon icon-user"></i><span>Add New User</span></a></li>
            <li><a href="/view/admin/add_new_supplier.php"><i class="icon icon-user"></i><span>Add New Supplier</span></a></li>
            <li><a href="/view/admin/add_new_product.php"><i class="icon icon-food"></i><span>Add New Product</span></a></li>
        <?php else : ?>
            <li><a href="/view/user/demo.php"><i class="icon icon-dashboard"></i><span>Dashboard</span></a></li>
            <li><a href="/view/user/add_new_product.php"><i class="icon icon-food"></i><span>Add New Product</span></a></li>
            <li><a href="/view/user/make_purchase.php"><i class="icon icon-food"></i><span>Make Purchase</span></a></li>
        <?php endif; ?>
    </ul>
</div>
<!--sidebar-menu-->

<div id="search">
    <a href="/logout.php" style="color:white"><i class="icon icon-share-alt"></i><span>LogOut</span></a>
</div>
