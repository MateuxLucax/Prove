<!DOCTYPE html>
<?php
  include 'valida_secao.php';
?>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Home - Prove</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.png" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- CSS -->
  <link href="assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>
  <header>

      <!-- Cabeçalho -->
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper container">
            <a href="index.php" class="brand-logo"><img src="assets/img/logo.svg" alt="Prove"></a>
            <a href="#" data-target="sidenav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><a class="active" href="index.php">Home</a></li>
              <li><a href="carros.php">Sobre</a></li>
              <li><a href="ocorrencias.php">Entrar</a></li>
            </ul>
          </div>
        </nav>
      </div>

      <!-- Dropdown Structure -->
      <ul id='dropdown1' class='dropdown-content'>
        <li><a href="#!">one</a></li>
        <li><a href="#!">two</a></li>
      </ul>
      
      <ul class="sidenav" id="sidenav-mobile">
        <li><a class="active" href="index.php">Painel de controle</a></li>
        <li><a href="clientes.php">Clientes</a></li>
        <li><a href="carros.php">Carros</a></li>
        <li><a href="ocorrencias.php">Ocorrências</a></li>
      </ul>

  </header>

  <main>
    <p>
      <?php
        echo "Bem vindo ".$_SESSION['nome'].
         "<br>
          matrícula: ".$_SESSION['matricula'];
      ?>
    </p>
  </main>

  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span class="left" id="copyright-js"></span> &nbsp; <a target="_blank" href="https://github.com/MateuxLucax/Sicherheit">Prove</a>
        <span class="right"><a target="_blank" href="https://opensource.org/licenses/MIT">MIT License</a></span>
      </div>
    </div>
  </footer>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="assets/js/materialize.min.js"></script>
  <script src="assets/js/init.js"></script>

  </body>

</html>
