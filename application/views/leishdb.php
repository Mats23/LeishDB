<!DOCTYPE html><!--[if IE 8]><html lang="en" class="ie8"> <![endif]--><!--[if IE 9]><html lang="en" class="ie9"> <![endif]--><!--[if !IE]><!--><html lang="en" xmlns="http://www.w3.org/1999/html"> <!--<![endif]-->    <head>        <?php        $this->load->helper('url');        $this->load->view("header.php");        ?>    </head>    <body data-spy="scroll">        <!---//Facebook button code-->        <?php $this->load->view("menu.php"); ?>        <!-- ******PROMO****** -->        <section id="promo" class="promo section offset-header">            <div class="container text-center">                <h2 class="title">leish<span class="highlight">DB</span></h2>                <p class="intro">A public database of leishmania genomic annotation.</p>                <form action="<?= base_url("query/actsearch") ?>" method="post">                    <input type="text" class="form-control" name="term" id="term"                           placeholder="Proteins names, UNIPROT ID, ncRNA type, Gene name, LeishDB ID"                           required="required"                            style="border-radius: 10px; height: 60px">                    </input><br>                    <div class="btns">                        <button type="submit" class="btn btn-cta-secondary" target="_blank">Search</button>                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">                            Advanced Search                        </button>                        <!--<a href="../index.php?p=blast.php" class="btn btn-cta-secondary" >BLAST</a>-->                    </div>                </form>                <!-- Button trigger modal -->                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">                    <div class="modal-dialog" role="document">                        <div class="modal-content">                            <div class="modal-header">                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span                                        aria-hidden="true">&times;</span></button>                                <h4 class="modal-title" id="myModalLabel">Advanced Search</h4>                            </div>                            <div class="modal-body">                                <form method="post" name="adv" id="adv" action="<?= base_url("query/actadvsearch") ?>">                                    <div class="row">                                        <div class="col-md-8">                                            <h5 class="text-left">&nbsp;Select the species:</h5>                                            <select class="form-control" onchange="showExtra()" id="organism" name="organism">                                                <option selected="selected" value="">Select the species</option>                                                <?php                                                foreach ($organisms as $organism) {                                                    echo "<option value='{$organism["id"]}'>{$organism["organism"]}</option>";                                                }                                                ?>                                            </select>                                        </div>                                        <div id="extra" name="extra" hidden>                                            <div class="col-md-8">                                                <h5 class="text-left"><input type="radio" name="advoption" id="advoption"                                                                             required="required" value="1">&nbsp;Select genes/ncRNAs                                                    by genomic coordinates:</h5>                                                <select class="form-control" onchange="onclickChromossome(0)"  id="genomeid" name="genomeid">                                                    <option selected="selected" value="">Select the chromossome:</option>                                                </select>                                                <input class="form-control" type="number" name="start" id="start" placeholder="Start position">                                                <input class="form-control" type="number" name="end" id="end" placeholder="End position">                                            </div>                                            <div class="col-md-5">                                                <h5 class="text-left"><input type="radio" name="advoption" id="advoption"                                                                             required="required" value="2">                                                    &nbsp;Select ncRNA by type:</h5>                                                <select class="form-control" onchange="onclickChromossome(1)" id="ncrnatype"                                                        name="ncrnatype">                                                    <option selected="selected" value="">Select the ncRNA type</option>                                                    <option value="miRNA">miRNA</option>                                                    <option value="snoRNA">snoRNA</option>                                                    <option value="snRNA">snRNA</option>                                                    <option value="rRNA">rRNA</option>                                                    <option value="tRNA">tRNA</option>                                                    <option value="IRES">IRES</option>                                                    <option value="sRNA">sRNA</option>                                                    <option value="piRNA">piRNA</option>                                                    <option value="siRNA">siRNA</option>                                                    <option value="lncRNA">lncRNA</option>                                                </select>                                            </div>                                        </div>                                    </div>                                    <br>                                    <br>                                    <div class="modal-footer">                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                        <button type="submit" class="btn btn-primary">Search</button>                                    </div>                                </form>                            </div>                        </div>                    </div>                </div>                <ul class="meta list-inline">                    <li></li>                </ul><!--//meta-->            </div><!--//container-->            <div class="social-media">                <div class="social-media-inner container text-center">                    <ul class="list-inline">                        <div id="fb-root"></div>                        <li class="facebook-like">                            <div class="fb-like" data-href="http://www.leishdb.com/" data-layout="button_count"                                 data-action="like" data-show-faces="true" data-share="true"></div>                        </li><!--//facebook-like-->                    </ul>                </div>            </div>        </section><!--//promo-->        <!-- ******ABOUT****** -->        <section id="about" class="about section">            <div class="container">                <h2 class="title text-center">What is leishDB?</h2>                <p class="intro text-center">LeishDB is a database for leishmania genomic information. Currently, it                    stores data related to coding genes and non-coding RNAs from L. braziliensis.</p>                <div class="row">                    <div class="item col-md-4 col-sm-6 col-xs-12">                        <div class="icon-holder">                            <i class="fa fa-university"></i>                        </div>                        <div class="content">                            <h3 class="sub-title">NCBI genome</h3>                            <p></p>                        </div><!--//content-->                    </div><!--//item-->                    <div class="item col-md-4 col-sm-6 col-xs-12">                        <div class="icon-holder">                            <i class="fa fa-align-justify"></i>                        </div>                        <div class="content">                            <h3 class="sub-title">JBrowser</h3>                            <p></p>                        </div><!--//content-->                    </div><!--//item-->                    <div class="item col-md-4 col-sm-6 col-xs-12">                        <div class="icon-holder">                            <i class="fa fa-clock-o"></i>                        </div>                        <div class="content">                            <h3 class="sub-title">Coding genes prediction</h3>                            <p></p>                        </div><!--//content-->                    </div><!--//item-->                    <div class="item col-md-4 col-sm-6 col-xs-12">                        <div class="icon-holder">                            <i class="fa fa-filter"></i>                        </div>                        <div class="content">                            <h3 class="sub-title">Characterization of predicted coding genes</h3>                            <p></p>                        </div><!--//content-->                    </div><!--//item-->                    <div class="item col-md-4 col-sm-6 col-xs-12">                        <div class="icon-holder">                            <i class="fa fa-crosshairs"></i>                        </div>                        <div class="content">                            <h3 class="sub-title">Non coding RNA prediction</h3>                            <p></p>                        </div><!--//content-->                    </div><!--//item-->                    <div class="item col-md-4 col-sm-6 col-xs-12">                        <div class="icon-holder">                            <i class="fa fa-database"></i>                        </div>                        <div class="content">                            <h3 class="sub-title">Relational Model Storage</h3>                            <p></p>                        </div><!--//content-->                    </div><!--//item-->                    <div class="item col-md-4 col-sm-6 col-xs-12">                        <div class="icon-holder">                            <i class="fa fa-search"></i>                        </div>                        <div class="content">                            <h3 class="sub-title">Download and acess all data</h3>                            <p></p>                        </div><!--//content-->                    </div><!--//item-->                    <div class="clearfix visible-md"></div>                </div><!--//row-->            </div><!--//container-->        </section><!--//about-->        <!-- ******FEATURES****** -->        <section id="features" class="features section" >            <div class="container text-left">                <div class="row">                    <div class="col-md-5">                        <h2 class="title">Statistics</h2>                        <ul class="feature-list list-unstyled">                            <li><i class="fa fa-check"></i> <?= $count_organisms[0]["count"] ?> annotated organism (L. braziliensis)</li>                            <li><i class="fa fa-check"></i> <?= $count_orfs[0]["count"] ?> predicted ORFs</li>                            <li><i class="fa fa-check"></i> <?= $count_genes[0]["count"] ?> genes with defined function</li>                            <li><i class="fa fa-check"></i> <?= $count_ncrna[0]["count"] ?> predicted and classified non-coding RNAs</li>                        </ul>                    </div>                    <div class="col-md-5">                        <h3 class="title">Annotations in running</h3>                        <ul class="feature-list list-unstyled">                            <div class="row">                                <div class="col-sm-5">                                    <li>                                        L. braziliensis                                        <div class="progress" style="width: 100%;">                                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"                                                 aria-valuemax="100" style="width:100%">                                                100% - Completed.                                            </div>                                        </div>                                    </li>                                </div>                                <div class="col-sm-5">                                    <li>                                        L. major                                        <div class="progress" style="width: 100%;">                                            <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0"                                                 aria-valuemax="100" style="width:10%">                                                10% - Downloading the files...                                            </div>                                        </div>                                    </li>                                </div>                                <div class="col-sm-5">                                    <li>                                        L. peruviania                                        <div class="progress" style="width: 100%;">                                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"                                                 aria-valuemax="100" style="width:0%">                                                0% - Waiting on the queue...                                            </div>                                        </div>                                    </li>                                </div>                                <div class="col-sm-5">                                    <li>                                        L. panamensis                                        <div class="progress" style="width: 100%;">                                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"                                                 aria-valuemax="100" style="width:0%">                                                0% - Waiting on the queue...                                            </div>                                        </div>                                    </li>                                </div>                                <div class="col-sm-5">                                    <li>                                        L. amazonensis                                        <div class="progress" style="width: 100%;">                                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"                                                 aria-valuemax="100" style="width:0%">                                                0% - Waiting on the queue...                                            </div>                                        </div>                                    </li>                                </div>                            </div>                        </ul>                    </div>                </div>            </div>        </section><!--//features-->        <!-- ******FEATURES****** -->        <section id="downloads" class="docs section">            <div class="container text-center">                <h2 class="title">Downloads</h2>                <table class="table table-responsive">                    <thead>                    <th class="text-center">Organism</th>                    <th class="text-center">GFF</th>                    <th class="text-center">FASTA</th>                    <th class="text-center">BED</th>                    <th class="text-center">SQL</th>                    </thead>                    <tbody>                    <th class="text-center">L. braziliensis (MHOM/BR/75/M2904)</th>                    <th class="text-center"><a class="btn  btn-cta-secondary" href="../downloads/gff.zip">Download GFF</a></th>                    <th class="text-center"><a class="btn  btn-cta-secondary" href="http://www.leishdb.com/downloads/fasta.zip">Download                            FASTA</a></th>                    <th class="text-center"><a class="btn  btn-cta-secondary" href="../downloads/bed.zip">Download BED</a></th>                    <th class="text-center"><a class="btn  btn-cta-secondary" href="../downloads/database.zip">Download SQL</a>                    </th>                    </tbody>                </table>                </ul>            </div><!--//container-->        </section><!--//features-->        <!-- ******DOCS****** -->        <section id="docs" class="features section">            <div class="container">                <div class="docs-inner">                    <h2 class="title text-center">Citing</h2>                    <p class="text-center">The full paper is writing in the moment. Wait for news.</p>                    <p></p>                    <p></p>                </div>        </section><!--//features-->        <br><br>        <!-- ******CITING****** -->        <section id="" class="docs section">            <div class="container">                <div id="collaborators" class="docs-inner">                    <h2 class="title text-center">Team</h2>                    <div class="row -align-center">                        <div class="col-md-6">                            <p class="sub-title text-center"><img src="<?php echo base_url(); ?>assets/images/brazil.png" width="30px"> BRAZIL</p>                            <p><a class="sub-title text-left"                                  href="http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4783012A0" target="_blank">PhD.                                    Aldina Barral</a></p>                            <p><a class="sub-title text-left"                                  href="http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4702720P6" target="_blank">PhD.                                    Antônio Ricardo Khouri Cunha</a></p>                            <p><a class="sub-title text-left"                                  href="http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=H720138" target="_blank">PhD.                                    Artur Trancoso Lopo de Queiróz</a></p>                            <p><a class="sub-title text-left" href="http://lattes.cnpq.br/7076978352521394" target="_blank">Phd(s).                                    Felipe Guimarães Torres</a></p>                        </div>                        <div class="col-md-6">                            <p class="sub-title text-center"><img src="<?php echo base_url(); ?>assets/images/chile.png" width="20px"> CHILE</p>                            <p><a class="sub-title text-left"                                  href="http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4750296P7" target="_blank">PhD.                                    Vinicius Maracaja-Coutinho</a></p>                            <p><a class="sub-title text-left" href="http://integrativebioinformatics.me/team/" target="_blank">PhD(e).                                    Raúl Arias-Carrasco</a></p>                        </div>                    </div>                </div>            </div>        </section><!--//features-->        <?php        $this->load->view("footer.php");        ?>    </body></html> 