<?php

$geneid = $_GET["geneid"];

include("../model/dao-search.php");

$ncrnas = SearchbyncRNAID($conexao, $geneid);

error_reporting(0);

foreach ($ncrnas as $ncrna):
    if ($ncrna["end_location"]< $ncrna["start_location"]){
        $start = $ncrna["end_location"];
        $end = $ncrna["start_location"];
    }else{
        $start = $ncrna["start_location"];
        $end = $ncrna["end_location"];
    }

    $sequence = getSequenceGene($conexao,$ncrna["genomeid"],$end,  $start);
    echo ("> ncRNA {$ncrna["id"]} |  {$ncrna["type"]} {$ncrna["family"]} <br>");

    echo "<div>";
    $i = 0;
    $tamanho = strlen($sequence["sequence"]);

    while($i <= $tamanho){
        echo substr($sequence["sequence"],$i,50);
        echo "<br>";
        $i += 50;
    }

endforeach;
?>

