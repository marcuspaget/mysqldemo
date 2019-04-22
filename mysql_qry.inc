<?php

// included by genericQuery.php

error_reporting(E_ERROR | E_PARSE);

/*
	Call mysqlQuery with 2 parameters.

	First is sql query to run.  Second is the multi-dimensional array hash to store result in.
*/

function mysqlQuery($sql,$resultPtr) {

	require_once("mysql_qry_defaults.inc");

	mysql_pconnect($mysql_host,$mysql_user,$mysql_password) || die("cannot connect to localhost mysql database!\n");

	//____________ Do SQL Query __________//
	if ($result=mysql_query($sql)) {


		//_________ Get Field Names ______//
		$fields=array();

		$totFields=mysql_num_fields($result);

		for( $i=0; $i < $totFields; $i++) {

			$fields[$i]=mysql_field_name($result,$i);

		}

		$totRows=mysql_num_rows($result);

		$cnt=0;

		while($row=mysql_fetch_array($result)) {


			for( $field=0; $field<count($fields); $field++) {

				$GLOBALS[$resultPtr][$cnt][($fields[$field])]=$row[$fields[$field]];
			}
			$cnt++;
		}

	} else {

		print("<br>\n<br>\nError querying entries with command: $sql<br>\n");
		print("Mysql query failed, result is $result!<br>\n");
		print(mysql_error()."<br>\n");

	}
}

function mysqlDumpQrySmall($rtnResult,$title,$idx) {

?>

<html><head><title><?=$title?></title></head>
<body>
<style type="text/css">
<!--

td { font-family:Arial;font-size:11; }

-->
</style>
<br>
<center><h3><?=$title?></h3>
<table border=1 cellspacing=0 cellpadding=3 bgcolor=white>
<tr>

<?php


	$totRows=count($rtnResult);

	if($idx) { print("<th>row</th>\n"); }

	for( reset($rtnResult[0]);$k=key($rtnResult[0]); next($rtnResult[0]) ) {
		print("<th nowrap>$k</th>\n");
	}

	print("</tr>\n");

	for($i=0;$i<$totRows;++$i) {

		if(($i%2)==0) {
			print("<tr>");
		} else {
			print("<tr class=alt>");
		}

		if($idx) { print("<td>". ($i+1) ."</td>\n"); }

		for( reset($rtnResult[$i]);$k=key($rtnResult[$i]); next($rtnResult[$i]) ) {
			print("<td nowrap><pre>".$rtnResult[$i][$k]."</pre></td>");
		}

		print("</tr>\n");

	}

?>

</table></center></body></html>

<?php

}

?>
