<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--><!--[if !IE]><!--><html lang="en" xmlns="http://www.w3.org/1999/html"> <!--<![endif]-->    <head>        <?php        $this->load->view("header.php");        $this->load->helper('pubmed');        $this->load->helper('url');        ?>        <script>            $(document).ready(function () {                $('#dataTable').dataTable();            });        </script>    </head>    <body data-spy="scroll">        <?php $this->load->view("menu.php"); ?>        <section id="about" class="about section">            <div class="container">                <h3>                    <?php                    if ($type >= "nc") {                        echo "ncRNA " . $data[0]["id"];                    } else {                        if ($data[0]["proteinname"] <> "") {                            echo "Gene " . $data[0]["id"] . " - " . $data[0]["proteinname"];                        } else {                            echo "Gene " . $data[0]["id"];                        }                    }                    ?>                </h3>                <a href="<?= base_url("fasta?id=" . $data[0]["id"] . "&type=" . $type) ?>" class="btn btn-primary btn-lg active" role="button">Sequence download</a>                <h4>Genomic information</h4>                <table id="data" class="table table-bordered"  cellspacing="0">                    <tbody>                        <?php if ($type == "nc") { ?>                            <tr>                                <td style="text-align: right; font-weight: bold; width: 20%">LeishDB NCID:</td>                                <td><?= $data[0]["id"] ?></td>                            </tr>                        <?php } ?>                        <?php if ($type == "c") { ?>                            <tr>                                <td style="text-align: right; font-weight: bold; width: 20%">LeishDB ID:</td>                                <td><?= $data[0]["id"] ?></td>                            </tr>                            <?php if ($data[0]["genename"] <> "") { ?>                                <tr>                                    <td style="text-align: right; font-weight: bold; width: 20%">Gene name:</td>                                    <td><?= $data[0]["genename"] ?></td>                                </tr>                            <?php } ?>                        <?php } ?>                        <tr>                            <td style="text-align: right; font-weight: bold; width: 20%">Genomic location:</td>                            <td>chr<?= $data[0]["genomeid"] ?>:<?= $start ?> - <?= $end ?>                            </td>                        </tr>                        <tr>                            <td style="text-align: right; font-weight: bold; width: 20%;">Size:</td>                            <td>                                <?= $end - $start ?>bp                            </td>                        </tr>                        <?php if ($type == "nc") { ?>                            <?php if ($data[0]["family"] <> "") { ?>                                <tr>                                    <td style="text-align: right; font-weight: bold; width: 20%">RNA Family:</td>                                    <td><?= $data[0]["family"] ?></td>                                </tr>                            <?php } ?>                            <tr>                                <td style="text-align: right; font-weight: bold; width: 20%">RNA Type:</td>                                <td><?= $data[0]["type"] ?></td>                            </tr>                            <tr>                                <td style="text-align: right; font-weight: bold; width: 20%">Identified by:</td>                                <td>                                    <?php if ($data[0]["covariance_model"] == "Yes") { ?>                                        <i class="fa fa-bar-chart fa-lg" title="Covariance model"> </i> (Covariance models)                                    <?php } ?>                                    <?php if ($data[0]["similarity"] == "Yes") { ?>                                        <i class="fa fa-bars fa-lg" title="Similarity model"> </i> (Similarity model)                                    <?php } ?>                                    <?php if ($data[0]["transcript"] == "Yes") { ?>                                        <i class="fa fa-retweet fa-lg" title="RNA transcript"></i> (RNA transcript)                                    <?php } ?>                                </td>                            </tr>                            <tr>                                <td style="text-align: right; font-weight: bold; width: 20%">Putative target genes available (by IntaRNA):</td>                                <td>                                    <?= $data[0]["have_target_genes"] ?>                                    <?php                                    if ($data[0]["have_target_genes"] == "Yes") {                                        echo " (<a href='http://www.leishdb.com/downloads/IntaRNA-target-genes-LeishDB.txt'>See in the target table</a>)";                                    }                                    ?>                                </td>                            </tr>                        <?php } ?>                        <?php if ($type != "nc") { ?>                            <?php if ($data[0]["family"] <> "") { ?>                                <tr>                                    <td style="text-align: right; font-weight: bold; width: 20%">Protein Name:</td>                                    <td><?= $data[0]["proteinname"] ?></td>                                </tr>                            <?php } ?>                        <?php } ?>                    </tbody>                </table>                <?php if ($type != "nc") { ?>                    <?php if (count($goterms) > 0) { ?>                        <h4>GO Terms</h4>                        <table id="data" class="table table-bordered"  cellspacing="0">                            <tbody>                                <tr>                                    <td style="text-align: right; font-weight: bold; width:  20%">GO ID:</td>                                    <td>                                        <?php foreach ($goterms as $goterm): ?>                                            <a target="_blank" href="http://amigo.geneontology.org/amigo/term/<?= $goterm["geneontology_id"] ?>"><?= $goterm["geneontology_id"] ?></a> ;                                        <?php endforeach; ?>                                    </td>                                </tr>                                <?php if (count($gotermsb) > 0) { ?>                                    <tr>                                        <td style="text-align: right; font-weight: bold; width: 20%">GO Biological Process:</td>                                        <td>                                            <?php foreach ($gotermsb as $gotermb): ?>                                                <a  target="_blank" href="http://amigo.geneontology.org/amigo/term/<?= $gotermb["geneontology_id"] ?>"><?= "[" . $gotermb["geneontology_id"] . "]" . $gotermb["description"] ?></a> <br>                                            <?php endforeach; ?>                                        </td>                                    </tr>                                <?php } ?>                                <?php if (count($gotermsm) > 0) { ?>                                    <tr>                                        <td style="text-align: right; font-weight: bold; width: 20%">GO Molecular Function:</td>                                        <td>                                            <?php foreach ($gotermsm as $gotermm): ?>                                                <a  target="_blank" href="http://amigo.geneontology.org/amigo/term/<?= $gotermm["geneontology_id"] ?>"><?= "[" . $gotermm["geneontology_id"] . "]" . $gotermm["description"] ?></a> <br>                                            <?php endforeach; ?>                                        </td>                                    </tr>                                <?php } ?>                                <?php if (count($gotermsc) > 0) { ?>                                    <tr>                                        <td style="text-align: right; font-weight: bold; width: 20%">GO Cellular Component:</td>                                        <td>                                            <?php foreach ($gotermsc as $gotermc): ?>                                                <a  target="_blank" href="http://amigo.geneontology.org/amigo/term/<?= $gotermc["geneontology_id"] ?>"><?= "[" . $gotermc["geneontology_id"] . "]" . $gotermc["description"] ?></a> <br>                                            <?php endforeach; ?>                                        </td>                                    </tr>                                <?php } ?>                            </tbody>                        </table>                    <?php } ?>                    <?php if ($data[0]["protein_id"] <> "") { ?>                        <h4>Databases cross-reference</h4>                        <table id="data" class="table table-bordered"  cellspacing="0">                            <tbody>                                <?php if ($type != "nc") { ?>                                    <tr>                                        <td style="text-align: right; font-weight: bold; width:  20%">UNIPROT ID</td>                                        <td><a href="http://www.uniprot.org/uniprot/<?= $data[0]["protein_id"] ?>" target="_blank"><?= $data[0]["protein_id"] ?></a></td>                                    </tr>                                <?php } ?>                                <?php                                foreach ($databases as $database):                                    ?>                                    <tr>                                        <td style="text-align: right; font-weight: bold; width: 20%"><?= strtoupper($database["description"]) ?></td>                                        <td><a  target="_blank" href="<?= $database["urlbyintegration"] . $database["referenceid"] ?>"><?= $database["referenceid"] ?></a></td>                                    </tr>                                <?php endforeach; ?>                            </tbody>                        </table>                    <?php } ?>                    <?php if (count($annotations) > 0) { ?>                        <h4>Annotations cross-reference</h4>                        <table id="data" class="table table-bordered"  cellspacing="0">                            <tbody>                                <?php                                foreach ($annotations as $annotation):                                    ?>                                    <tr>                                        <td style="text-align: right; font-weight: bold; width: 20%"><?= strtoupper($annotation["description"]) ?></td>                                        <td><a  target="_blank" href="<?= $annotation["urlbyintegration"] . $annotation["referenceid"] ?>"><?= $annotation["referenceid"] ?></a></td>                                    </tr>                                <?php endforeach; ?>                            </tbody>                        </table>                    <?php } ?>                    <?php if (count($publications) > 0) { ?>                        <h4>Publications</h4>                        <table id="data" class="table table-bordered"  cellspacing="0">                            <tbody>                                <?php                                foreach ($publications as $publication):                                    $reference = webservicePubMED($publication["pubmedid"]);                                    if ($reference <> ""):                                        ?>                                        <tr>                                            <td>                                                <?= $reference ?>                                            </td>                                        </tr>                                    <?php endif; ?>                                <?php endforeach; ?>                            </tbody>                        </table>                    <?php } ?>                    <h4>Genome browser</h4>                    <iframe style="border: 1px solid #505050;width:100%" src="http://regadb.bahia.fiocruz.br/jbrowse/index.html?&loc=chr<?= $data[0]["chromosome_id"] ?>%3A<?= $start ?>..                            <?= $end ?>&tracks=DNA%2CAnnotations%2CLeishDB&highlight=chr<?= $data[0]["chromosome_id"] ?>%3A<?= $start ?>..<?= $end ?>"                            height="450">                    </iframe>                <?php } ?>                <h4>DNA Sequence</h4>                <div class="well well-lg">                    <?php if ($type == "nc") { ?>                        <head>                            <title>ncRNA <?= $gene_id ?></title>                        </head>                        <div style='font-family: Courier New,Courier; text-align: justify; text-justify: inter-word;'>                            <?php                            foreach ($data as $ncrna):                                echo ("> ncRNA {$ncrna["id"]} | {$ncrna["type"]} <br>");                                $i = 0;                                $tamanho = strlen($sequence[0]["sequence"]);                                while ($i <= $tamanho) {                                    echo substr($sequence[0]["sequence"], $i, 1);                                    $i += 1;                                    if ($i % 80 == 0) {                                        echo "<br>";                                    }                                }                                echo "</div>";                            endforeach;                        } else {                            ?>                            <head>                                <title>Gene <?= $gene_id ?></title>                            </head>                            <div style='font-family: Courier New,Courier; text-align: justify; text-justify: inter-word;'>                                <?php                                foreach ($data as $gene):                                    echo ("> Gene {$gene["id"]} | {$gene["proteinname"]} <br>");                                    $i = 0;                                    $tamanho = strlen($sequence[0]["sequence"]);                                    while ($i <= $tamanho) {                                        echo substr($sequence[0]["sequence"], $i, 1);                                        $i += 1;                                        if ($i % 80 == 0) {                                            echo "<br>";                                        }                                    }                                    echo "</div>";                                endforeach;                            }                            ?>                        </div>                    </div>                </div>        </section><!--//about-->        <?php $this->load->view("footer.php"); ?>    </body></html>