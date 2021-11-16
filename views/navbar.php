<?php require_once('../models/session.php'); ?>

<link rel="stylesheet" href="../css/navbar.css">
<script type="module" src="../js/navbar.js" defer></script>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"></a>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <?php if (Session::isOpen()) { ?>
        <a class="nav-item nav-link" href="#" target="_blank"><i id="btn-login" class="material-icons">exit_to_app</i> <span class="descripcion"> Cerrar sesión </span></a>
      <?php } else { ?>
        <a class="nav-item nav-link" href="#" target="_blank"><i id="btn-login" class="material-icons">account_circle</i> <span class="descripcion"> Login </span></a>
      <?php } ?>

      <a class="nav-item nav-link" href="#" target="_blank"><i id="btn-ticket" class="material-icons">add_to_queue</i><span class="descripcion">Tickets
      </span></a>

      <?php if (Session::isOpen()) { ?>
        <a class="nav-item nav-link" href="#" target="_blank"><i id="btn-admin" class="material-icons">settings</i><span class="descripcion">Administración</span></a>
      <?php } ?>
    </div>
  </div>
</nav>

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>