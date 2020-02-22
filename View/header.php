<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Celulares Liberia</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/css/StylesFCS.css" rel="stylesheet">
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <link href="assets/css/formularioResponsive.css" rel="stylesheet">
</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?c=principal">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-mobile fa-3x "></i>
        </div>
        <div class="sidebar-brand-text mx-3"> <h2>Celulares Liberia</h2><sup></sup></div>
     </a>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
               <!-- <img src="./assets/img/brand/blue.png"> -->
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->

        <hr class="my-3">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=principal">
              <i class="fas fa-home"></i> Inicio
            </a>
          </li>
           <hr class="my-3">
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Factura">

              <i class="fas fa-copy text-blue"> </i> Factura
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Producto">
              <i class="fas fa-box-open text-orange"></i> Productos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Bodega">
              <i class="fas fa-boxes text-red"></i>Bodegas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Pedido">
              <i class="fas fa-truck-loading text-yellow"></i>Pedidos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Cliente">
              <i class="fas fa-users text-red"></i>Clientes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Proveedor">
              <i class="fas fa-address-card text-info"></i>Proveedores
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="index.php?c=Empleado">
              <i class="fas fa-users text-pink"></i>Empleado
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Seguridad">

            <i class="fas fa-lock"> </i> Seguridad
            </a>
          </li>
          <li class="nav-item">
             <a class="nav-link"  href="?c=Login&a=cerrar" onclick="javascript:return confirm('¿Seguro de salir del sistema ?');">
              <i class="fas fa-sign-out-alt"></i>Cerrar Sesion  </a>
          </li>
         </ul>
        <!-- Divider -->
        <hr class="my-3">
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
