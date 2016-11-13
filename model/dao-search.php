<?php
//Imports
include("dao-conection.php");

//Function for search Gene by ID
function SearchbyGeneID($conexao, $id)
{
    $id = mysqli_real_escape_string($conexao, $id);
    $result = mysqli_query($conexao, "select g.*, p.* from genes as g left join proteins as p" .
        " on (g.proteinid = p.proteinid) where  g.id = {$id} ");
    $genes = array();

    while ($gene = mysqli_fetch_assoc($result)) {
        array_push($genes, $gene);
    }

    return $genes;
}


//Function for databases by proteinid
function SearchDatabasesbyProteinID($conexao, $proteinid)
{
    $proteinid = mysqli_real_escape_string($conexao, $proteinid);
    $result = mysqli_query($conexao, "select c.*,d.* from crossreference as c
		left join `databases` as d on c.databaseid = d.id where  c.proteinid = '{$proteinid}'");
    $databases = array();

    while ($database = mysqli_fetch_assoc($result)) {
        array_push($databases, $database);
    }

    return $databases;
}


//Function for publications by proteinid
function SearchPublicationsbyProteinID($conexao, $proteinid)
{
    $proteinid = mysqli_real_escape_string($conexao, $proteinid);
    $result = mysqli_query($conexao, "select p.* from publications as p where  p.proteinid = '{$proteinid}'");
    $publications = array();

    while ($publication = mysqli_fetch_assoc($result)) {
        array_push($publications, $publication);
    }

    return $publications;
}



//Function for search RNA by ID
function SearchbyncRNAID($conexao, $id)
{
    $id = mysqli_real_escape_string($conexao, $id);
    $result = mysqli_query($conexao, "select * from ncrna as rna where rna.id = {$id}");
    $ncrnas = array();

    while ($ncrna = mysqli_fetch_assoc($result)) {
        array_push($ncrnas, $ncrna);
    }

    return $ncrnas;
}

//Function for search RNA by type
function SearchbyncRNAtype($conexao, $type)
{
    $type = mysqli_real_escape_string($conexao, $type);
    $result = mysqli_query($conexao, "select * from ncrna as rna where UPPER(rna.type) LIKE UPPER('%" . $type ."%')");
    $ncrnas = array();

    while ($ncrna = mysqli_fetch_assoc($result)) {
        array_push($ncrnas, $ncrna);
    }

    return $ncrnas;
}

//Function for search RNA by type
function SearchbyAllncRNA($conexao, $query)
{
    $query = mysqli_real_escape_string($conexao, $query);
    $result = mysqli_query($conexao, "select * from ncrna as rna where UPPER(rna.type) LIKE UPPER('%" . $query ."%') or " .
        " UPPER(rna.family) LIKE UPPER('%" . $query ."%') or UPPER(rna.description) LIKE UPPER('%" . $query ."%')" .
        " or rna.id = " . $query );
    $ncrnas = array();

    while ($ncrna = mysqli_fetch_assoc($result)) {
        array_push($ncrnas, $ncrna);
    }

    return $ncrnas;
}

//Function for search Gene by Chromossome
function SearchbyChromossome($conexao, $genomeid)
{
    $genomeid = mysqli_real_escape_string($conexao, $genomeid);
    $result = mysqli_query($conexao, "select g.*, p.* from genes as g left join proteins as p
        on (g.proteinid = p.proteinid) where g.genomeid = {$genomeid} and g.proteinid <> ''" );
    $genes = array();

    while ($gene = mysqli_fetch_assoc($result)) {
        array_push($genes, $gene);
    }

    return $genes;
}

//Function for search Gene by Chromossome
function SearchbyChromossomencRNA($conexao, $genomeid)
{
    $genomeid = mysqli_real_escape_string($conexao, $genomeid);
    $result = mysqli_query($conexao, "select rna.* from ncrna as rna where rna.genomeid = {$genomeid}");
    $ncrnas = array();
    while ($ncrna = mysqli_fetch_assoc($result)) {
        array_push($ncrnas, $ncrna);
    }

    return $ncrnas;
}

function Searchbygenescoordinates($conexao, $genomeid, $start, $end)
{
    $genomeid = mysqli_real_escape_string($conexao, $genomeid);
    $result = mysqli_query($conexao, "select g.*, p.* from genes as g left join proteins as p
        on (g.proteinid = p.proteinid) where g.genomeid = {$genomeid} AND (g.startgenomelocal >= {$start} 
        AND g.endgenomelocal <= {$end}) and g.proteinid <> ''");
    $ncrnas = array();
    while ($ncrna = mysqli_fetch_assoc($result)) {
        array_push($ncrnas, $ncrna);
    }

    return $ncrnas;
}

function Searchbyncrnacoordinates($conexao, $genomeid, $start, $end)
{
    $genomeid = mysqli_real_escape_string($conexao, $genomeid);
    $start = mysqli_real_escape_string($conexao, $start);
    $end = mysqli_real_escape_string($conexao, $end);

    $result = mysqli_query($conexao, "select rna.* from ncrna as rna where rna.genomeid = {$genomeid} AND 
    (rna.start_location >= {$start} AND rna.end_location <= {$end})");
    $ncrnas = array();

    while ($ncrna = mysqli_fetch_assoc($result)) {
        array_push($ncrnas, $ncrna);
    }

    return $ncrnas;
}

//Function for search All Options
function SearchbyAllOptions($conexao, $term)
{
    $term = mysqli_real_escape_string($conexao, $term);
    $query = "select g.*, p.proteinname from genes as g left join proteins as p" .
        " on (g.proteinid = p.proteinid) where UPPER(p.proteinname) LIKE UPPER('%" . $term . "%') or " .
        " UPPER(g.proteinid) LIKE UPPER('%" . $term . "%') or g.id LIKE '" . $term . "' ".
        " or UPPER(p.genename) LIKE UPPER('" . $term . "') and g.proteinid <> ''";

    $result = mysqli_query($conexao,$query);
    $genes = array();
    if (mysqli_num_rows($result)>0) {
        while ($gene = mysqli_fetch_assoc($result)) {
            array_push($genes, $gene);
        }
    }

    return $genes;
}

//Function for search GO TERMS
function SearchAllGOTerms($conexao, $proteinid)
{
    $proteinid = mysqli_real_escape_string($conexao, $proteinid);
    $query = "select * from proteinsgo as pgo where pgo.proteinid LIKE '%" . $proteinid . "%'";

    $result = mysqli_query($conexao,$query);
    $goterms = array();
    if (mysqli_num_rows($result)>0) {
        while ($goterm = mysqli_fetch_assoc($result)) {
            array_push($goterms, $goterm);
        }
    }

    return $goterms;
}

function SearchProteinNameJSON($conexao)
{
    $sql = "select DISTINCT proteinname from proteins as p";
    $result = mysqli_query($conexao,$sql);
    $proteins = array();
    if (mysqli_num_rows($result)>0) {
        while ($proteinname = mysqli_fetch_assoc($result)) {
            array_push($proteins, $proteinname);
        }
    }
    return $proteins;
}

//Function for search GO TERMS by type
function SearchAllGOTermsbytype($conexao, $proteinid, $type)
{
    $proteinid = mysqli_real_escape_string($conexao, $proteinid);
    $type = mysqli_real_escape_string($conexao, $type);
    $query = "select pgo.*, go.* from proteinsgo as pgo, geneontology as go 
	where TRIM(go.goid) = TRIM(pgo.goid) and pgo.proteinid LIKE '%" . $proteinid . "%' and go.type LIKE '%" . $type . "%'";

    $result = mysqli_query($conexao,$query);
    $goterms = array();
	
    if (mysqli_num_rows($result)>0) {
        while ($goterm = mysqli_fetch_assoc($result)) {
            array_push($goterms, $goterm);
        }
    }

    return $goterms;
}


//Function for search Gene by SWISS-PROT ID
function getSequenceGene($conexao, $genomeid, $end, $start)
{
    $genomeid = mysqli_real_escape_string($conexao, $genomeid);
    $start = mysqli_real_escape_string($conexao, $start);
    $end = mysqli_real_escape_string($conexao, $end);

    if($end < $start){
        $var_tmp = $end;
        $end = $start;
        $start = $var_tmp;
    }

    $result = mysqli_query($conexao, "SELECT SUBSTRING(chromossomes.sequence FROM {$start} FOR ({$end}-{$start})) as sequence
     FROM chromossomes WHERE chromossomes.idchromosome = {$genomeid}");

    return mysqli_fetch_assoc($result);
}

