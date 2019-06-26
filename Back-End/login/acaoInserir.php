<?php
  include 'conf/conf.inc.php';
  include 'connect/connect.php';


  $acao = '';
  if (isset($_GET["acao"]))
    $acao = $_GET["acao"];

  if (isset($_GET["tabela"]))
    $tabela = $_GET["tabela"];

  $tb_tabela = isset($_GET['tabela'])?$_GET['tabela']:0;
  $pagina = isset($_GET['pagina'])?$_GET['pagina']:0;
  $numero = isset($_GET['numero'])?$_GET['numero']:0;
  $parentesa = "(";
  $parentesf = ")";

  if (isset($_GET["nome"]))
    $nome = $_GET["nome"];


  

 /* if ($acao == "excluir"){
    $codigo = 0;
    if (isset($_GET["acao"])){
      $codigo = $_GET["codigo"];
      //$sql = "DELETE FROM $tb_tabela WHERE codigoCompra = $codigo";
      $sql = 'DELETE FROM '.$tb_tabela. ' WHERE codigo = '. $codigo;
      
      $sql = 'DELETE FROM '.$tb_tabela. ' WHERE codigoCompra = '. $codigo;
      
      $result = mysqli_query($conexao, $sql);
      echo $nome;
      header ("location:".$nome);
    }
  }*/
   if ($acao == 'salvar') {
      $tb_tabela = isset($_GET['tabela'])?$_GET['tabela']:0;
      $pagina = isset($_GET['pagina'])?$_GET['pagina']:0;
      $numero = isset($_GET['numero'])?$_GET['numero']:0;
      if (isset($_GET['n1'])) {
          for ($i= 1; $i <= $numero ; $i++) {
              if ($i == 2) {
                $lugares[$i] = sha1(isset($_GET['n'.$i])?$_GET['n'.$i]:0);
              }else{
                $lugares[$i] = isset($_GET['n'.$i])?$_GET['n'.$i]:0;
              }
          }
          $sql = "INSERT INTO $tb_tabela VALUES ".$parentesa."'null'";
          $i=1;
          while ($i <= $numero) {
              $data = DateTime::createfromFormat('d/m/Y', $lugares[$i]);
              if ($data && $data->format('d/m/Y')) {
                  $lugares[$i] = str_replace("/", "-", $lugares[$i]);
                  $sql.= ",'".date("Y-m-d", strtotime($lugares[$i]))."'";
              } else {
                  $sql.= ",'".$lugares[$i]."'";
              }
              $i++;
          }
          $sql.= $parentesf;
          echo "$sql";
          $resultado = mysqli_query($conexao, $sql);
          echo "<br/>";
          print_r($lugares);
          echo "<br/><br/><br/>";

            echo $sql = "SELECT * FROM login WHERE usuario = '$lugares[1]' and senha = '$lugares[2]' and nome = '$lugares[3]' and dataInial = '$lugares[4]'";
            $result = mysqli_query($conexao, $sql);
            
            
            if($result != $resultado){
                header("location:cadUser.php");
            }
            else
            {
                header("location:login.php");
            }

          //header("location:login.php");
      }
  }

  ?>