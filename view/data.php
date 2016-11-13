<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/html"> <!--<![endif]-->
<head>
	<?php
		include("header.php");
		include("../model/dao-search.php");
		include("../functions-aux.php");
        error_reporting(1);
    ?>
    <script>
		$(document).ready(function(){
		    $('#dataTable').dataTable();
		});
	</script>
</head>

<body data-spy="scroll">

<!-- ******HEADER****** -->
<header id="header" class="header">
    <div class="container">
        <h1 class="logo pull-left">
            <a class="scrollto" href="../index.php?p=leishdb.php">
                <span class="logo-title">leishDB</span>
            </a>
        </h1><!--//logo-->
        <nav id="main-nav" class="main-nav navbar-right" role="navigation">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><!--//nav-toggle-->
            </div><!--//navbar-header-->
            <div class="navbar-collapse collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="javascript:history.back()" target="_self">Back page</a></li>
                    <!--<li class="nav-item"><a class="scrollto" href="#license">Works</a></li>-->
                </ul><!--//nav-->
            </div><!--//navabr-collapse-->
        </nav><!--//main-nav-->
    </div>
</header><!--//header-->

<?php
$geneid = $_GET["geneid"];
$type = $_GET["type"];
$start_loc = 0;
$end_loc = 0;

if($type == "nc"){
    $data = SearchbyncRNAID($conexao, $geneid);
	if ($data[0]["end_location"] <= $data[0]["start_location"]){
		$tmp = $data[0]["end_location"];
		$data[0]["end_location"] = $data[0]["start_location"];
		$data[0]["start_location"] = $tmp;
	}else{
		$start_loc = $data[0]["start_location"];
		$end_loc = $data[0]["end_location"];
	}
}else{
    $data = SearchbyGeneID($conexao, $geneid);
	$goterms = SearchAllGOTerms($conexao, $data[0]["proteinid"]);
	$start_loc = $data[0]["startgenomelocal"];
	$end_loc = $data[0]["endgenomelocal"];
};

?>

<section id="about" class="about section">
    <div class="container">
		<h3><?=($type >= "nc") ? "ncRNA " . $data[0]["id"]: "Gene " . $data[0]["id"] . " - " . $data[0]["proteinname"]?></h3>
		<a href="fasta.php?geneid=<?=$data[0]["id"]?>&type=c" class="btn btn-primary btn-lg active" role="button">Download of sequence</a>
		<h4>Genomic information</h4>
		<table id="data" class="table table-bordered"  cellspacing="0">
			<tbody>
				<?php if ($type == "nc"){?>
				<tr>
					<td style="text-align: right; font-weight: bold; width: 20%">LeishDB NCID:</td>
					<td><?=$data[0]["id"]?></td>
				</tr>
				<?php } ?>
				<?php if ($type == "c"){?>
				<tr>
					<td style="text-align: right; font-weight: bold; width: 20%">LeishDB ID:</td>
					<td><?=$data[0]["id"]?></td>
				</tr>				
				<tr>
					<td style="text-align: right; font-weight: bold; width: 20%">Gene name:</td>
					<td><?=$data[0]["genename"]?></td>
				</tr>		
				<?php } ?>
				<tr>
					<td style="text-align: right; font-weight: bold; width: 20%">Genomic location:</td>
					<td>chr<?=$data[0]["genomeid"]?>:<?=$start_loc?> - <?=$end_loc?>
					</td>
				</tr>
				<tr>
					<td style="text-align: right; font-weight: bold; width: 20%;">Size:</td>
					<td>
					<?=$end_loc - $start_loc?>bp
					</td>
				</tr>	
				<?php if ($type == "nc"){?>
				<tr>
					<td style="text-align: right; font-weight: bold; width: 20%">RNA Family:</td>
					<td><?=$data[0]["family"]?></td>
				</tr>
				<tr>
					<td style="text-align: right; font-weight: bold; width: 20%">RNA Type:</td>
					<td><?=$data[0]["type"]?></td>
				</tr>			
				<?php } ?>
				<?php if ($type != "nc"){?>
				<tr>
					<td style="text-align: right; font-weight: bold; width: 20%">Protein Name:</td>
					<td><?=$data[0]["proteinname"]?></td>
				</tr>			
				<?php } ?>
			</tbody>
		</table>
		<?php if ($type != "nc"){?>
		<h4>GO Terms</h4>
			<table id="data" class="table table-bordered"  cellspacing="0">
				<tbody>
					<tr>
						<td style="text-align: right; font-weight: bold; width:  20%">GO ID:</td>
						<td>
							<?php foreach ($goterms as $goterm): ?>
								<a target="_blank" href="http://amigo.geneontology.org/amigo/term/<?=$goterm["goid"]?>"><?=$goterm["goid"]?></a> ; 
							<?php endforeach; ?>
						</td>
					</tr>
					<tr>
						<td style="text-align: right; font-weight: bold; width: 20%">GO Biological Process:</td>
						<td>
						<?php 
							  $gotermsb = SearchAllGOTermsbytype($conexao, $data[0]["proteinid"], "biological");
							  foreach ($gotermsb as $gotermb): ?>
								<a  target="_blank" href="http://amigo.geneontology.org/amigo/term/<?=$gotermb["goid"]?>"><?="[" . $gotermb["goid"] . "]" . $gotermb["description"] ?></a> <br> 
						<?php endforeach; ?>
						</td>
					</tr>
					<tr>
						<td style="text-align: right; font-weight: bold; width: 20%">GO Molecular Function:</td>
						<td>
						<?php 
							  $gotermsm = SearchAllGOTermsbytype($conexao, $data[0]["proteinid"], "molecular");
							  foreach ($gotermsm as $gotermm): ?>
								<a  target="_blank" href="http://amigo.geneontology.org/amigo/term/<?=$gotermm["goid"]?>"><?="[" . $gotermm["goid"] . "]" . $gotermm["description"] ?></a> <br>
						<?php endforeach; ?>
						</td>
					</tr>
					<tr>
						<td style="text-align: right; font-weight: bold; width: 20%">GO Cellular Component:</td>
						<td>
						<?php 
							  $gotermsc = SearchAllGOTermsbytype($conexao, $data[0]["proteinid"], "cellular");
							  foreach ($gotermsc as $gotermc): ?>
								<a  target="_blank" href="http://amigo.geneontology.org/amigo/term/<?=$gotermc["goid"]?>"><?="[" . $gotermc["goid"] . "]" . $gotermc["description"] ?></a> <br> 
						<?php endforeach; ?>
						</td>
					</tr>
				</tbody>
			</table>
		
		<h4>Databases cross-reference</h4>
		
			<table id="data" class="table table-bordered"  cellspacing="0">
				<tbody>
					<?php if ($type != "nc"){?>
					<tr>
						<td style="text-align: right; font-weight: bold; width:  20%">UNIPROT ID</td>
						<td><a href="http://www.uniprot.org/uniprot/<?=$data[0]["proteinid"]?>" target="_blank"><?=$data[0]["proteinid"]?></a></td>
					</tr>			
					<?php } ?>
					<?php
						$databases = SearchDatabasesbyProteinID($conexao, $data[0]["proteinid"]);
					
					 foreach ($databases as $database): 
					?>
					<tr>
						<td style="text-align: right; font-weight: bold; width: 20%"><?=strtoupper($database["description"])?></td>
						<td><a  target="_blank" href="<?=$database["urlbyintegration"] . $database["referenceid"]?>"><?=$database["referenceid"]?></a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			
		<h4>Publications</h4>
			<table id="data" class="table table-bordered"  cellspacing="0">
				<tbody>
					<?php
						$publications = SearchPublicationsbyProteinID($conexao, $data[0]["proteinid"]);
					?>
					<tr>
						<?php 
						foreach ($publications as $publication):  ?>
						<td>
							<?=webservicePubMED($publication["pubmedid"])?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		
		<h4>Genome browser</h4>
			
			<iframe style="border: 1px solid #505050;width:100%" src="http://regadb.bahia.fiocruz.br/jbrowse/
			index.html?&loc=chr<?=$data[0]["genomeid"]?>%3A<?=$start_loc?>..<?=$end_loc?>&tracks=DNA%2CAnnotations%2CLeishDB&highlight=chr<?=$data[0]["genomeid"]?>%3A<?=$start_loc?>..<?=$end_loc?>"
			height="450">
			</iframe>
		
		<?php } ?>
		
		<h4>DNA Sequence</h4>
		<div class="well well-lg">
		<?php
			
						if ($type == "nc"){
				$data = SearchbyncRNAID($conexao, $geneid); ?>
				<head>
				<title>ncRNA <?=$geneid?></title>
				</head>
				<div style='font-family: Courier New,Courier; text-align: justify; text-justify: inter-word;'>
				   
				<?php foreach ($data as $ncrna):
					$sequence = getSequenceGene($conexao,$ncrna["genomeid"],$ncrna["end_location"],  $ncrna["start_location"]);
					echo ("> Gene {$ncrna["id"]} | {$ncrna["family"]} <br>");

					$i = 0;
					$tamanho = strlen($sequence["sequence"]);

					while($i <= $tamanho){
						echo substr($sequence["sequence"],$i,1);
						$i += 1;        
						if($i % 80 == 0){
							echo "<br>";
						}    
					}
					echo "</div>";
			endforeach;
			}else{
				$data = SearchbyGeneID($conexao, $geneid);  ?>
				<head>
				<title>Gene <?=$geneid?></title>
				</head>
				<div style='font-family: Courier New,Courier; text-align: justify; text-justify: inter-word;'>
				 
				<?php foreach ($data as $gene):
					$sequence = getSequenceGene($conexao,$gene["genomeid"],$gene["endgenomelocal"],  $gene["startgenomelocal"]);
					echo ("> Gene {$gene["id"]} | {$gene["proteinname"]} <br>");
					$i = 0;
					$tamanho = strlen($sequence["sequence"]);

					while($i <= $tamanho){
						echo substr($sequence["sequence"],$i,1);
						$i += 1;        
						if($i % 80 == 0){
							echo "<br>";
						}    
					}
					echo "</div>";
				endforeach;
			}

		?>
		</div>
    </div>
</section><!--//about-->

<?php
include($_SESSION["dir"] . "/view/footer.php");
?>

</body>
</html> 
