<header class="site-header">
  <div class="container">
    <button id="toggle-navbar" class="navbar__toggler" aria-expanded="false">
      <i class="fa fa-bars"></i>
    </button>

    <a class="brand" href="index.php">Inicio</a>

    <nav id="navbar" class="navbar">
      <header class="navbar__mobile-header navbar__link">
        <button class="navbar__mobile-close" id="navbar-close">
          <i class="fa fa-times"></i>
        </button>
      </header>

      <a class="navbar__link" href="cursos.php">Cursos</a>
      <a class="navbar__link" href="programas.php">Programas</a>
      <!-- <a class="navbar__link" href="membresias.php">Membresía</a> -->
      <a class="navbar__link" href="certificados.php">Certificados</a>
    </nav><!-- .navbar -->

    <div class="site-header__actions">
      <!--
          <a class="shopping-cart" href="carrito.php">
          <span class="shopping-cart__badge">
            2
          </span>
          <i class="fa fa-shopping-cart"></i>
        </a>
        -->
      <!--
        <a class="login-icon" href="#"  data-modal="#modal">
          <i class="far fa-user"></i>
        </a>
        -->
      <!-- <a href="#" class="btn btn--outline btn--outline-white" data-modal="#modal">Ingresar</a> -->
      <a href="#?text=Hola, deseo información sobre los cursos. Mi nombre es: " data-action="share/whatsapp/share" target="_blank" class="btn btn--white">Informes</a>

    </div>
  </div><!-- .container -->
</header><!-- .site-header -->