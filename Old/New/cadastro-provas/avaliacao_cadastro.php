<!DOCTYPE html>

<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Cadastrar Prova - Prove</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../assets/img/favicon.png" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- CSS -->
  <link href="../assets/css/general.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>
  <header>

	<!-- Cabeçalho -->
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper container">
			<a href="./" class="brand-logo"><img src="../assets/img/logo.svg" alt="Prove"></a>
			<a href="" data-target="mobile-navbar" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a href="../">Home</a></li>
				<li><a href="../sobre">Sobre</a></li>
  			<li><a data-target="login" class="modal-trigger">Entrar</a></li>
			</ul>
			</div>
		</nav>
	</div>
      
	<ul class="sidenav" id="mobile-navbar">
		<li><a href="../">Home</a></li>
		<li><a href="../sobre">Sobre</a></li>
		<li><a data-target="login" class="modal-trigger">Entrar</a></li>
	</ul>

  <div id="login" class="modal modal-login">
		<form action="../entrar.php">
			<div class="modal-login-box">
				<center>
					<img src="../assets/img/avatar-white.svg" class="modal-login-avatar">
				</center>
				<h4 class="title prove-text text-branco center">Entrar</h4>
				<div class="row">
					<div class="col s12">
						<div class="input-field">
							<input id="matricula" type="text" class="validate">
							<label for="matricula">Matrícula</label>
						</div>
					</div>
					<div class="col s12">
						<div class="input-field">
							<input id="senha" type="password" class="validate">
							<label for="senha">Senha</label>
						</div>
					</div>
					<div class="col s12">
						<p class="prove-text text-branco">Ainda não é cadastrado? <a class="modal-login-link" href="cadastro">Cadastre-se aqui</a></p>
					</div>
				</div>
				<div class="row">
					<div class="col s12 center">
						<button type="sumbmit" class="modal-close btn modal-login-btn">Entrar</button>
					</div>
				</div>
			</div>
		</form>
  	</div>

  </header>

  <main>

    <center>
      <div class="container">
        <div class="row">
          <div class="col s12"> 
            <h3 class="title prove-text">Cadastrar Prova</h3>
          </div>
          <div class="col s12 container">
            <form action="" method="POST" class="card-panel">
              <div class="row">
                <div class="input-field col s12 l6">
                  <input id="conteudo" name="conteudo" type="text" class="validate"/>
                  <label for="conteudo">Conteudo</label>
                </div>
                <div class="input-field col s12 m6 l2">
                    Embaralhar questões
                    <div class="switch">
                        <label>
                            Desligado
                            <input type="checkbox">
                            <span class="lever"></span>
                            Ligado
                        </label>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m6">
                  <input id="dataInicio" name="dataInicio" type="text" class="datepicker" />
                  <label for="dataInicio">Data de início</label>
                </div>
                <div class="input-field col s12 m6">
                  <input id="horarioInicio" name="horarioInicio" type="text" class="timepicker" />
                  <label for="horarioInicio">Horário de início</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m6">
                  <input id="dataFinal" name="dataFinal" type="text" class="datepicker" />
                  <label for="dataFinal">Data final</label>
                </div>
                <div class="input-field col s12 m6">
                  <input id="horarioFinal" name="horarioFinal" type="text" class="timepicker" />
                  <label for="horarioFinal">Horário final</label>
                </div>
              </div>
            </form>
          </div>  
        </div>
				<div class="row">
					<div class="col s12">
						<h4 class="title left prove-text text-verde">Questões</h4>
					</div>
				</div>
        <div class="row">
          <div class="col s12">
            <div class="card-panel">
              <div class="row">
                <h6 class="title prove-text">Adicionar questão</h6>
                <ul class="tabs tabs-fixed-width">
                  <li class="tab col s3"><a href="#tab-discursiva">Discursiva</a></li>
                  <li class="tab col s3"><a href="#tab-unica">Única Escolha</a></li>
                  <li class="tab col s3"><a href="#tab-multipla">Múltipla Escolha</a></li>
                </ul>
                <div id="tab-discursiva" class="col s12">
                  <form action="" method="POST">
                    <div class="row">
                      <div class="input-field col s12 margin-top-thin">
                        <input id="enunciado-discursiva" type="text" class="validate">
                        <label for="enunciado-discursiva">Enunciado</label>
                      </div>
                      <div class="input-field col s12">
                        <input id="texto-discursiva" type="text" class="validate">
                        <label for="texto-discursiva">Texto de apoio (opcional)</label>
                      </div>
                      <div class="col s12 center">
                        <button type="submit" value="adicionar" class="waves-effect waves-light btn">Adicionar</a>
                      </div>
                    </div>
                  </form>
                </div>
                <div id="tab-unica" class="col s12">
                  <form action="" method="POST">
                    <div class="row">
                      <div class="input-field col s12 margin-top-thin">
                        <input id="enunciado-unica" type="text" class="validate">
                        <label for="enunciado-unica">Enunciado</label>
                      </div>
                      <div class="input-field col s12">
                        <input id="texto-unica" type="text" class="validate">
                        <label for="texto-unica">Texto de apoio (opcional)</label>
                      </div>
                      <div class="col s12">
                        <div class="row" id="unicaContainer">  
                        </div>
                      </div>
                      <input type="hidden" id="qtdUnica" name="qtdUnica" value="0" />
                      <div class="col s12 m6">
                        <button type="button" onclick="alternativaUnicaAdicionar()" class="left waves-effect prove verde waves-light btn">Adicionar alternativa</a>
                      </div>
                      <div class="col s12 m6">
                        <button type="button" onclick="alternativaUnicaRemover()" class="right waves-effect prove vermelho waves-light btn">Remover alternativa</a>
                      </div>
                      <div class="col s12 center">
                        <button type="submit" value="adicionar" class="margin-top-thin waves-effect waves-light btn">Adicionar</a>
                      </div>
                    </div>
                  </form>
                </div>
                <div id="tab-multipla" class="col s12">
                  <form action="" method="POST">
                    <div class="row">
                      <div class="input-field col s12 margin-top-thin">
                        <input id="enunciado-multipla" type="text" class="validate">
                        <label for="enunciado-multipla">Enunciado</label>
                      </div>
                      <div class="input-field col s12">
                        <input id="texto-multipla" type="text" class="validate">
                        <label for="texto-multipla">Texto de apoio (opcional)</label>
                      </div>
                      <div class="col s12">
                        <div class="row" id="multiplaContainer">  
                        </div>
                      </div>
                      <input type="hidden" id="qtdMultipla" name="qtdMultipla" value="0" />
                      <div class="col s12 m6">
                        <button type="button" onclick="alternativaMultiplaAdicionar()" class="left waves-effect prove verde waves-light btn">Adicionar alternativa</a>
                      </div>
                      <div class="col s12 m6">
                        <button type="button" onclick="alternativaMultiplaRemover()" class="right waves-effect prove vermelho waves-light btn">Remover alternativa</a>
                      </div>
                      <div class="col s12 center">
                        <button type="submit" value="adicionar" class="margin-top-thin waves-effect waves-light btn">Adicionar</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Discursiva -->
        <div class="row">
          <div class="col s12">
            <div class="card-panel">
              <div class="row">
                <div class="col s12">
                  <p class="justificar"><b>1)</b> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga ullam odit voluptatum nemo necessitatibus illo nostrum aspernatur natus autem dicta culpa accusamus, totam repellendus esse sunt sequi earum optio enim. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur quis error perferendis laudantium ducimus. Sequi, incidunt, maiores earum cupiditate culpa, provident hic laudantium atque quidem repellat unde dolore nihil nesciunt.</p>
                  <p class="justificar">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas repellendus adipisci ullam dolores voluptates illum amet, mollitia officiis debitis nulla modi, non similique quidem asperiores aspernatur unde. Ab, praesentium quod. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam, a laboriosam eum culpa sunt quae dolorum magnam placeat eaque accusamus aperiam explicabo nihil praesentium voluptatibus cum officia, iusto reprehenderit enim. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla reprehenderit maxime id, mollitia repellendus omnis, laudantium labore, vero in aut dolore quibusdam perspiciatis natus iusto quis ducimus eveniet totam asperiores. Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, perferendis fugit molestias sint vel unde eligendi! Doloremque a hic dolorem, repellat in ex labore, eos placeat numquam libero commodi vel?</p>
                </div>
                <div class="input-field col s12">
                  <textarea id="resposta" disabled class="materialize-textarea"></textarea>
                  <label for="resposta">Resposta</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Única Escolha -->
        <div class="row">
          <div class="col s12">
            <div class="card-panel">
              <div class="row">
                <div class="col s12">
                  <p class="justificar"><b>2)</b> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga ullam odit voluptatum nemo necessitatibus illo nostrum aspernatur natus autem dicta culpa accusamus, totam repellendus esse sunt sequi earum optio enim. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur quis error perferendis laudantium ducimus. Sequi, incidunt, maiores earum cupiditate culpa, provident hic laudantium atque quidem repellat unde dolore nihil nesciunt.</p>
                  <p class="justificar">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas repellendus adipisci ullam dolores voluptates illum amet, mollitia officiis debitis nulla modi, non similique quidem asperiores aspernatur unde. Ab, praesentium quod. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam, a laboriosam eum culpa sunt quae dolorum magnam placeat eaque accusamus aperiam explicabo nihil praesentium voluptatibus cum officia, iusto reprehenderit enim. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla reprehenderit maxime id, mollitia repellendus omnis, laudantium labore, vero in aut dolore quibusdam perspiciatis natus iusto quis ducimus eveniet totam asperiores. Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, perferendis fugit molestias sint vel unde eligendi! Doloremque a hic dolorem, repellat in ex labore, eos placeat numquam libero commodi vel?</p>
                  <p class="justificar">Respostas:</p>
                  <p class="justificar">
                    <label>
                      <input class="with-gap" name="unicaEscolha" type="radio" disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio vel enim cum delectus eius non assumenda sit excepturi, iure veniam eligendi sequi, quasi modi. </span>
                    </label>
                  </p>
                  <p class="justificar">
                    <label>
                      <input class="with-gap" name="unicaEscolha" type="radio"  disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio vel enim cum delectus eius non assumenda sit excepturi, iure veniam eligendi sequi, quasi modi. </span>
                    </label>
                  </p>
                  <p class="justificar">
                    <label>
                      <input class="with-gap" name="unicaEscolha" type="radio"  disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio vel enim cum delectus eius non assumenda sit excepturi, iure veniam eligendi sequi, quasi modi. </span>
                    </label>
                  </p>
                  <p class="justificar">
                    <label>
                      <input class="with-gap" name="unicaEscolha" type="radio"  disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio vel enim cum delectus eius non assumenda sit excepturi, iure veniam eligendi sequi, quasi modi. </span>
                    </label>
                  </p>
                  <p class="justificar">
                    <label>
                      <input class="with-gap" name="unicaEscolha" type="radio"  disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio vel enim cum delectus eius non assumenda sit excepturi, iure veniam eligendi sequi, quasi modi. </span>
                    </label>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Múltipla Escolha -->
        <div class="row">
          <div class="col s12">
            <div class="card-panel">
              <div class="row">
                <div class="col s12">
                  <p class="justificar"><b>3)</b> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga ullam odit voluptatum nemo necessitatibus illo nostrum aspernatur natus autem dicta culpa accusamus, totam repellendus esse sunt sequi earum optio enim. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur quis error perferendis laudantium ducimus. Sequi, incidunt, maiores earum cupiditate culpa, provident hic laudantium atque quidem repellat unde dolore nihil nesciunt.</p>
                  <p class="justificar">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas repellendus adipisci ullam dolores voluptates illum amet, mollitia officiis debitis nulla modi, non similique quidem asperiores aspernatur unde. Ab, praesentium quod. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam, a laboriosam eum culpa sunt quae dolorum magnam placeat eaque accusamus aperiam explicabo nihil praesentium voluptatibus cum officia, iusto reprehenderit enim. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla reprehenderit maxime id, mollitia repellendus omnis, laudantium labore, vero in aut dolore quibusdam perspiciatis natus iusto quis ducimus eveniet totam asperiores. Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, perferendis fugit molestias sint vel unde eligendi! Doloremque a hic dolorem, repellat in ex labore, eos placeat numquam libero commodi vel?</p>
                  <p class="justificar">Resposta:</p>
                  <p class="justificar">
                    <label>
                      <input type="checkbox" disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas et quidem recusandae nihil, dolorem dolore vitae expedita voluptate quo soluta sit reprehenderit repudiandae?</span>
                    </label>
                  </p>
                  <p class="justificar">
                    <label>
                      <input type="checkbox" disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas et quidem recusandae nihil, dolorem dolore vitae expedita voluptate quo soluta sit reprehenderit repudiandae?</span>
                    </label>
                  </p>
                  <p class="justificar">
                    <label>
                      <input type="checkbox" disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas et quidem recusandae nihil, dolorem dolore vitae expedita voluptate quo soluta sit reprehenderit repudiandae?</span>
                    </label>
                  </p>
                  <p class="justificar">
                    <label>
                      <input type="checkbox" disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas et quidem recusandae nihil, dolorem dolore vitae expedita voluptate quo soluta sit reprehenderit repudiandae?</span>
                    </label>
                  </p>
                  <p class="justificar">
                    <label>
                      <input type="checkbox" disabled />
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas et quidem recusandae nihil, dolorem dolore vitae expedita voluptate quo soluta sit reprehenderit repudiandae?</span>
                    </label>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12 center">
          <button type="submit" value="cadastrar" class="waves-effect waves-light btn">Cadastrar</a>
        </div>
      </div>
  </main>

  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span class="left" id="copyright-js"></span> &nbsp; <a target="_blank" href="https://github.com/MateuxLucax/Prove">Prove</a>
        <span class="right"><a target="_blank" href="https://opensource.org/licenses/MIT">MIT License</a></span>
      </div>
    </div>
  </footer>

  <!--  Scripts-->
	<script src="../assets/js/materialize.min.js"></script>
	<script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.timepicker');
      var options = {
          i18n: {
              cancel: 'Cancelar',
              clear: 'Limpar',
              done: 'Ok'
          },
          twelveHour: false
      }
      var instances = M.Timepicker.init(elems , options);
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems);
      var tabs = document.querySelectorAll('.tabs');
      for (var i = 0; i < tabs.length; i++){
          M.Tabs.init(tabs[i]);
      }
      var elems = document.querySelectorAll('.datepicker');
      var data = new Date();
      var options = {
          format: 'dd/mm/yyyy', 
          yearRange: [data.getFullYear(), data.getFullYear() + 1],
          minDate: data,
          i18n: {
          cancel: 'Cancelar',
          clear: 'Limpar',
          months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
          monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
          weekdays: ['Domingo', 'Segunda Feira', 'Terça Feira', 'Quarta Feira', 'Quinta Feira', 'Sexta Feira', 'Sábado'],
          weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
          weekdaysAbbrev: ['D','S','T','Q','Q','S','S'] 
          }
      };
      var instances = M.Datepicker.init(elems, options);
    });
  </script>
  <script src="ajax.js"></script>
  <script src="../assets/js/init.js"></script>

  </body>

</html>