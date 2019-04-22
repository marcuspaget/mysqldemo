<?php

require("genericQuery_defaults.inc");

$allowed_fields=array("database", "table", "fields","criteria","like","order","limit");

foreach ($allowed_fields as $value) {
    $$value=htmlentities($_GET[$value]);
}

$database=$database ? $database : $default_db;
$table=$table ? $table : $default_table ;

?>
<center>
<hr size=1>
<h1>MySQL Query Tool</h1>
<hr size=1>
<table border=1>
<tr><th>key</th><th>value</th><th>notes</th></tr>
<tr><td>
<form action="/mysqldemo/genericQuery.php" method=get>
    database</td><td> <input type=text name="database" value="<?=$database?>"></input></td><td><i>database</i> to query, e.g. <b>demo</b></td></tr>
    <tr><td>table</td><td> <input type=text name="table" value="<?=$table?>"></input></td><td><i>table</i> - for joins use , and then db.table, e.g. <b>demo_table</b></tr>
    <tr><td>fields</td><td> <input type=text name="fields" value="<?=$fields?>"></input></td><td><i>fields</i> -  comma sep - no spaces, e.g. <b>day</b></tr>
    <tr><td>criteria</td><td> <input type=text name="criteria" value="<?=$criteria?>"></input></td><td><i>field=val</i> - comma sep - no spaces, e.g. <b>day=monday</b></tr>
    <tr><td>like</td><td> <input type=text name="like" value="<?=$like?>"></input></td><td><i>field=v</i> - comma sep - no spaces, e.g. <b>day=t</b></tr>
    <tr><td>order</td><td> <input type=text name="order" value="<?=$order?>"></input></td><td><i>fieldname</i> - order by, e.g. <b>val</b> or <b>val desc</b><td></tr>
    <tr><td>limit</td><td> <input type=text name="limit" value="<?=$limit?>"></input></td><td><i>limit</i> - comma sep - no spaces,<b>0,2</b><td></tr>
    <tr><td>&nbsp;</td><td><input type=reset></td><td><input type=submit></td><td>&nbsp;
</form>
</td></tr></table>
<br>
<hr size=1>
</center>
