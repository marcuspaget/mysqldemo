<?php

if(isset($_GET['excel'])) { header("Content-Type: application/vnd.ms-excel"); }

require_once("genericQuery_defaults.inc");

require_once("mysql_qry.inc");

if($_SERVER['QUERY_STRING']) {
	$qstr="&".$_SERVER['QUERY_STRING'];

	$allowed_fields=array("database", "table", "fields","criteria","like","order","limit");

	foreach ($allowed_fields as $value) {
		$$value=htmlentities($_GET[$value]);
	}

} else {
	$qstr="";
}

while(list($k,$v) = each($HTTP_POST_VARS)) {	$qstr.="&$k=$v";$$k=$v;	}

$qstr=htmlentities($qstr);

if(eregi("insert|update|delete|,|;",$database)) { die("Naughty, Naughty, you'll get caughty!!\ndb\n"); }

if(!$database) { $database=$default_db; } # default database

if(!$table) { $table=$default_table; } # default table

if(!$fields) { $fields='*'; }

if(eregi("insert|update|delete|,|;",$table)) { die("Naughty, Naughty, you'll get caughty!!\ntable\n"); }

if(eregi("insert|update|delete|;",$fields)) { die("Naughty, Naughty, you'll get caughty!!\nfields\n"); }

$sql="select $fields from $database.$table";

if(eregi("insert|update|delete|;",$criteria)) { die("Naughty, Naughty, you'll get caughty!!\ncriteria\n"); }

$cnt=0;

if($criteria) { 

	$crit=split(',',$criteria);
	$tot=count($crit);
	$criter=array();

	for($i=0;$i<$tot;$i++) {

		$thisCrit=split('=',$crit[$i]);
		$criter[$thisCrit[0]]="$thisCrit[1]";

	}

	while(list($k,$v)=each($criter)) {

		if($cnt == 0) { $sql.=" where "; } else { $sql.=" and "; }

		if($k) { $sql.="$k='$v'"; }

		$cnt++;

	}

}

if(eregi("insert|update|delete|;",$like)) { die("Naughty, Naughty, you'll get caughty!!\n"); }

if($like) { 

	$lik=split(',',$like);
	$tot=count($lik);
	$liker=array();

	for($i=0;$i<$tot;$i++) {

		$thisLik=split('=',$lik[$i]);
		$liker[$thisLik[0]]="$thisLik[1]";

	}

	while(list($k,$v)=each($liker)) {

		if($cnt == 0) { $sql.=" where "; } else { $sql.=" and "; }

		if($k) { $sql.="$k like '${v}%'"; }

		$cnt++;

	}

}

if(eregi("insert|update|delete|;",$order)) { die("Naughty, Naughty, you'll get caughty!!\n"); }

if($order) {
	$sql.=" order by $order";
} 


if(eregi("insert|update|delete|;",$limit)) { die("limit: Naughty, Naughty, you'll get caughty!!\n"); }

if($limit) { $sql.=" limit $limit"; } 


$qstr=ereg_replace("<","&lt;",$qstr);
$qstr=ereg_replace(">","&gt;",$qstr);

if(!isset($_GET['excel'])) {
	print "To view this with Excel click <a href=\"".$_SERVER['PHP_SELF']."?excel=yes${qstr}\">here</a>";
}

mysqlQuery($sql,"rtnResult");
mysqlDumpQrySmall($rtnResult,"","");
$rtnResult="";

?>
