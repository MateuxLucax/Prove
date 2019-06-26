<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Cadastre-se - Prove</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.png" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- CSS -->
  <link href="assets/css/login/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
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
            <li><a href="./">Home</a></li>
            <li><a href="sobre.html">Sobre</a></li>
            <li><a href="entrar.html">Entrar</a></li>
          </ul>
        </div>
      </nav>
    </div>
    
    <ul class="sidenav" id="sidenav-mobile">
      <li><a href="./"><i class="material-icons">home</i>Home</a></li>
      <li><a href="sobre.html"><i class="material-icons">info</i>Sobre</a></li>
      <li><a href="entrar.html"><i class="material-icons">account_circle</i>Entrar</a></li>
    </ul>
  
  </header>
  
  <main>

    <center>
    
      <div class="valign-wrapper login container">
        <div class="row">

          <div class="col s12">
            <img src="assets/img/form-avatar.svg" alt="User" class="login--img" />
          </div>
          <div class="col s12" style="margin-top: -2rem"> 
            <h1 class="login--title">Cadastre-se</h1>
          </div>
        
          <div class="col s12 container">
            <form action="">
              <div class="row">
                <div class="input-field col s12 m6">
                  <input id="nome" name="nome" type="text" class="validate" />
                  <label for="nome">Nome</label>
                </div>
                  <div class="input-field col s12 m6">
                    <input id="senha" name="senha" type="password" class="validate" />
                  <label for="senha">Senha</label>
                </div>
              </div>
              <div class="row" style="margin-top: -2rem">
                <div class="input-field col s12 m6">
                  <input id="matricula" name="matricula" type="text" class="validate" />
                  <label for="matricula">Matrícula</label>
                </div>
                  <div class="input-field col s12 m6">
                  <input id="email" name="email" type="email" class="validate" />
                  <label for="email">E-Mail</label>
                </div>
              </div>
              <div class="row" style="margin-top: -2rem">
                <div class="input-field col s12 m6 offset-m3">
                  <input id="dataNascimento" name="dataNascimento" type="text" class="validate" data-mask="00/00/0000" />
                  <label for="dataNascimento">Data de Nascimento</label>
                </div>
              </div>
              <div class="row" style="margin-top: -2rem">
                <div class="col s12">
                  <p>Já é cadastrado? <a href="">Entre aqui</a></p>
                </div>
              </div>
              <div class="row">
                <div class="col s12 center">
                  <button type="submit" class="waves-effect waves-light btn">Cadastrar</a>
                </div>
              </div>
            </form>
          </div>
              
        </div>
      </div>
          
    </center>
  </main>

  <footer>

  </footer>

  <!--  Scripts-->
  <script src="assets/js/jquery.mask.min.js"></script>
  <script src="assets/js/jquery-2.1.1.min.js"></script>
  <script src="assets/js/materialize.min.js"></script>
  <script src="assets/js/init.js"></script>

  </body>

</html>
