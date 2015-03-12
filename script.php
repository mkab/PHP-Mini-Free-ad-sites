<?php

$reg_id = $_GET['reg_id'];
$man = new RegionDeptManager($bdd);

$depts = $man->getDepartements($reg_id);
echo '<select id="dept" name="dept">';
echo '<option value="-1" selected="selected">------Choissisez le departement------</option>';
foreach ($depts as $value) {
    
}
echo'</select>';
?> 

<?

$cat_id = $_GET['cat_id'];
require "config.php";
$q = mysql_query("select * from subcategory where cat_id='$cat_id'");
echo mysql_error();
$myarray = array();
$str = "";
while ($nt = mysql_fetch_array($q)) {
    $str = $str . "\"$nt[subcategory]\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>