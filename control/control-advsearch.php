<?php

include("../model/dao-search.php");
include("../functions-aux.php");

error_reporting(0);

$advoption = $_POST["advoption"];

if($advoption==1){
    $genomeid =$_POST["genomeid"];
    session_start();
    $_SESSION["genes"] = SearchbyChromossome($conexao, $genomeid);
    $_SESSION["ncrna"] = SearchbyChromossomencRNA($conexao, $genomeid);
}
if($advoption==2){
    $ncrnatype =$_POST["ncrnatype"];
    session_start();
    $_SESSION["genes"] = array();
    $_SESSION["ncrna"] = SearchbyncRNAtype($conexao, $ncrnatype);
}
if($advoption==3){

    //echo"<script>document.location.href='http://regadb.bahia.fiocruz.br:4567'</script>";
    echo "<script>window.alert('This mode is offline now. Try again more later...')</script>";
    redireciona();
}

redireciona("search.php");
