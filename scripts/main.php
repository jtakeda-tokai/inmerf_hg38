<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130959089-5"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-130959089-5');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>InMeRF</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed-->
    <script src="js/bootstrap.min.js"></script>

    <!-- header -->
    <div id="header" class="container">
      <nav class="navbar navbar-default">
      <div class="navbar-header">
        <a class="navbar-brand">Result</a>
      </div>
      </nav>

<?php
  $ver = htmlspecialchars($_POST['ver']);
  $radio = htmlspecialchars($_POST['radio']);

  $chr=NULL;
  $pos=NULL;
  $id=NULL;
  $name=NULL;
  if($radio=="radio1"){
    $chr = htmlspecialchars($_POST['chr']);
    $pos = htmlspecialchars($_POST['pos']);

    $result = shell_exec( "bash ./extract_target_pos.sh $chr $pos divided_files_'$ver'_path");
    $lines = preg_split( '/\n/', $result );
    $nLine = count( $lines );

    if($nLine==1){
      echo "<font size=+1><b><u>SNV at chr".$chr.":".$pos." can't be predicted by InMeRF or yield no amino acid substitution.</u></b></font><br><br>";
    }
  }elseif($radio=="radio2"){
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $row = htmlspecialchars($_POST['row']);

    if($id=="hgnc"){
      $result = shell_exec( "bash ./extract_target_ids.sh $name divided_files_'$ver'_gene");
    }elseif($id=="ensg"){
      $result = shell_exec( "bash ./extract_target_ids.sh $name divided_files_'$ver'_ensg");
    }elseif($id=="enst"){
      $result = shell_exec( "bash ./extract_target_ids.sh $name divided_files_'$ver'_enst");
    }elseif($id=="ensp"){
      $result = shell_exec( "bash ./extract_target_ids.sh $name divided_files_'$ver'_ensp");
    }

    $lines = preg_split( '/\n/', $result );
    $nLine = count( $lines );

    if($nLine==1){
      if($id=="hgnc"){
        echo "<font size=+1><b><u>Gene Symbol (HGNC): ".$name." doesn't exist in InMeRF.</u></b></font><br><br>";
      }elseif($id=="ensg"){
        echo "<font size=+1><b><u>Ensembl Gene ID: ".$name." doesn't exist in InMeRF.</u></b></font><br><br>";
      }elseif($id=="enst"){
        echo "<font size=+1><b><u>Ensembl Transcript ID: ".$name." doesn't exist in InMeRF.</u></b></font><br><br>";
      }elseif($id=="ensp"){
        echo "<font size=+1><b><u>Ensembl Protein ID: ".$name." doesn't exist in InMeRF.</u></b></font><br><br>";
      }
    }
  }
?>

    <!-- main -->
    <div class="container">
      <div class="row">

        <!-- Mainbar -->
        <div class="col-sm-11">
        Predicted pathogenicity in shown in “Prediction” along with “Pathogenic Probability”. Pathogenic Probability >= 0.5 is predicted to be “Pathogenic”. “Not predicted” in the column of “Prediction” indicates that a gain or loss of a stop codon (X), or no information of amino acid. “NaN” indicates Not a Number. Each element by isoform is delimited by semicolon (;).
        <br />

        <!-- Result Table -->
        <div class="container" style="padding:20px 0">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th rowspan="2">Prediction</th>
              <th rowspan="2">Pathogenic Probability</th>
              <th rowspan="2">Genomic Mutation</th>
              <th rowspan="2">Amino Acid Substituion</th>
              <th rowspan="2">Gene Symbol</th>
              <th rowspan="2">Strand</th>
              <th colspan="3">Ensembl 94</th>
              <th colspan="34">Rank Score of dbNSFP v4.0a</th>
            </tr>
            <tr>
              <th>Gene ID</th>
              <th>Transcript ID</th>
              <th>Protein ID</th>
              <th>SIFT</th>
              <th>SIFT4G</th>
              <th>Polyphen2_HDIV</th>
              <th>Polyphen2_HVAR</th>
              <th>LRT</th>
              <th>MutationTaster</th>
              <th>MutationAssessor</th>
              <th>FATHMM</th>
              <th>PROVEAN</th>
              <th>VEST4</th>
              <th>MetaSVM</th>
              <th>MetaLR</th>
              <th>REVEL</th>
              <th>MVP</th>
              <th>MPC</th>
              <th>PrimateAI</th>
              <th>DEOGEN2</th>
              <th>CADD</th>
              <th>DANN</th>
              <th>fathmm-MKL</th>
              <th>fathmm-XF</th>
              <th>Eigen</th>
              <th>Eigen-PC</th>
              <th>GenoCanyon</th>
              <th>integrated_fitCons</th>
              <th>GERP++</th>
              <th>phyloP100way_vertebrate</th>
              <th>phyloP30way_mammalian</th>
              <th>phyloP17way_primate</th>
              <th>phastCons100way_vertebrate</th>
              <th>phastCons30way_mammalian</th>
              <th>phastCons17way_primate</th>
              <th>SiPhy</th>
              <th>bStatistic</th>
            </tr>
            </thead>

            <tbody>

<?php
function outputTable($lines, $nLine, $radio, $ver, $chr, $pos, $name){
  for($iLine=1; $iLine<=$nLine-1; $iLine++){
    echo "<tr>";
    $element = preg_split('/\t/', $lines[$iLine-1]);
    $nElement = count( $element );

    $aapos = preg_split('/\;/', $element[11] );
    $aapos_cnt = count( $aapos );

    if(strcmp($element[46], "NaN") == 0){
      echo "<td>Not predicted</td>";
    }else if($element[46] >= 0.5){
      echo "<td><font color=red>Pathogenic</font></td>";
    }else{
      echo "<td>Normal</td>";
    }

    if(strcmp($element[46], "NaN") == 0){
      echo "<td>".$element[46]."</td>";
    }else{
      echo "<td>".round($element[46] ,3)."</td>";
    }

    echo "<td>g.".$element[1]."".$element[2].">".$element[3]."</td>";

    echo "<td>";
    if(strcmp($element[11], "-1") == 0){
      echo "NaN";
    }else{
      for($i=0;$i<=$aapos_cnt-1;$i++){
        echo "p.".$element[4]."".$aapos[$i]."".$element[5]."";
        if($i<$aapos_cnt-1){
          echo ";";
        }
      }
    }
    echo "</td>";

    echo "<td>".$element[6]."</td>";
    echo "<td>".$element[7]."</td>";
    echo "<td>".$element[8]."</td>";
    echo "<td>".$element[9]."</td>";
    echo "<td>".$element[10]."</td>";
    for($iScore=12; $iScore<=45; $iScore++){
      if(strcmp($element[$iScore], "NaN") == 0){
        echo "<td>".$element[$iScore]."</td>";
      }else{
        echo "<td>".round($element[$iScore] ,3)."</td>";
      }
    }
    echo "</tr>";
  }
  echo "</table>";
  if($radio=="radio1"){
    echo "<b><i>Input queries: $ver, chr$chr:$pos</b></i><br>";
  }elseif($radio=="radio2"){
    echo "<b><i>Input queries: $ver, $name</b></i><br>";
  }
  $total_rows=count($lines)-1;
  echo "<b><i>Total rows: $total_rows</b></i><br>";
}
?>

<?php
  if($radio=="radio1"){
    outputTable($lines, $nLine, $radio, $ver, $chr, $pos, $name);
  }elseif($radio=="radio2"){
    if($row=="part_row"){
      $part_rows=100+1;
      if($nLine>$part_rows){
        $nLine=$part_rows;
      }
      outputTable($lines, $nLine, $radio, $ver, $chr, $pos, $name);
    }elseif($row=="all_row"){
      outputTable($lines, $nLine, $radio, $ver, $chr, $pos, $name);
    }
  }
?>

            </tbody>
          </table>
        </div>
        <!-- END OF Table -->

      </div>
    </div>

    <input type="button"  value="Return" class="btn btn-info" onclick="history.back()">
    <br><br>
  </div>
  </body>
</html>

