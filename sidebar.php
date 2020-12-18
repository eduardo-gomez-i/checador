<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="far fa-clock"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CHK-U <sup>v2</sup></div>
    </a>
    <p class="d-flex justify-content-center" style="color: #ffffff;">Checador Universal</p>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de Control</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interfaz
    </div>

    <!-- Nav Item - Checador -->
    <li class="nav-item active">
        <a class="nav-link" href="checador.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Checador</span></a>
    </li>

    <!-- Nav Item - Trabajadores -->
    <li class="nav-item">
        <a class="nav-link" href="trabajadores.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Trabajadores</span></a>
    </li>

    <!-- Nav Item - Vehiculos -->
    <li class="nav-item">
        <a class="nav-link" href="unidades.php">
            <i class="fas fa-fw fa-truck"></i>
            <span>Vehiculos</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Administrar</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Trabajadores:</h6>
                <a class="collapse-item" href="incidencias.php"><i class="far fa-angry"></i> Incidencias</a>
                <a class="collapse-item" href="permisos.php"><i class="far fa-grin-beam-sweat"></i> Permisos</a>
                <a class="collapse-item" href="incentivos.php"><i class="fas fa-award"></i> Incentivos</a>
                <a class="collapse-item" href="motivacion.php"><i class="far fa-grin-alt"></i> Motivacion</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Nomina:</h6>
                <a class="collapse-item" href="nomina.php"><i class="fas fa-hand-holding-usd"></i> Nomina</a>
                <div class="collapse-divider"></div>

                <h6 class="collapse-header">Calendario:</h6>
                <a class="collapse-item" href="calendario.php"><i class="fas fa-calendar"></i> Calendario</a>
                <div class="collapse-divider"></div>

                <h6 class="collapse-header">Otros:</h6>
                
                <a class="collapse-item" href="departamentos.php"><i class="fas fa-briefcase"></i> Departamentos</a>
                <a class="collapse-item" href="expedientes.php"><i class="far fa-address-book"></i> Expedientes</a>
                <a class="collapse-item" href="remotos.php"><i class="fas fa-globe-americas"></i> Trabajadores Remotos</a>
                <a class="collapse-item" href="#"><i class="fas fa-users"></i> Agregar usuarios</a>
            </div>
        </div>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Herramientas
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilerias</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Utilerias:</h6>
                <a class="collapse-item" href="nueva-tarjeta.php"><i class="fas fa-sim-card"></i> Nueva Tarjeta</a>
                <a class="collapse-item" href="codigos_qr.php"><i class="fas fa-qrcode"></i> Codigos QR</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Avanzado</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Control de Acceso:</h6>
                <a class="collapse-item" href="dispositivos.php"><i class="fas fa-microchip"></i> Dispositivos</a>
                <a class="collapse-item" href="rastreo.php"><i class="fas fa-search-location"></i> Ubicar</a>
            </div>
        </div>
    </li>

    <!-- Divider 
      <hr class="sidebar-divider">-->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">