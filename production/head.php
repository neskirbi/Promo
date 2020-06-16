<?php 
    session_start();
        include "../controler/conn.php";
        if (!isset($_SESSION['user_log'])&& $_SESSION['user_log']==null) {
       header("location: ../action/logout.php");
   }
 
    $id=$_SESSION['user_log'];
    $query=sqlsrv_query($conn,"SELECT * from usuaripsPromo WHERE correo='$id'");
    while ($row=sqlsrv_fetch_array($query)) {
        $idPromo = $row['idPromo'];
        $us_nombre_real_id_head = $row['nombre']." ".$row['apellido1'];
        $us_tt_promo_nombre = $row['nombre'];
        $us_tt_promo_apellido1 = $row['apellido1'];
        $us_tt_promo_apellido2 = $row['apellido2'];

}
?>    
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Head count</title>
<link rel="icon" href="images/icojti.ico" type="image/ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
  </head>
  

  <body class="nav-sm footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed"><!---  --->
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0; height: 90px;">
              <a href="dashboard.php" class="site_title; style=height:80px; margin: 20px 20px 0 5px;"><img src="images/logo.png" width="60" height="60"> <span style=" font-size: 25px; color: #fff; ">PROMO</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">

              <div class="profile_info">
                <span>Bienvenido, <?php echo $us_tt_promo_nombre ;?> <?php echo $us_tt_promo_apellido1 ;?> <?php echo $us_tt_promo_apellido2 ;?>.
                </span>
                
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->
            <br />

<!--a id="menu_toggle"><i class="fa fa-bars"></i></a--->