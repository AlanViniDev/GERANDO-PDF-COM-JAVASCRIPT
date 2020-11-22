<?php
require_once("conexao.php");
if(!empty($_REQUEST['param'])){
    $param = $_POST['param'];
    $Conection = new Conection(); 
    $Conection->Conecta();
    
    $sql = $Conection->conexao->query("SELECT idprod,nome,cor,preco FROM produtos");
    $dados = Array($sql->fetchAll(\PDO::FETCH_ASSOC));
    
    $dadosProdutos = Array();
    
    foreach($dados as $key => $dadosProdutos){
       echo json_encode($dadosProdutos = $dados[$key]);
    }
   
}
