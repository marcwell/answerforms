<?php
ini_set('session.cookie_domain', str_replace('www.','',$_SERVER['SERVER_NAME']));
require_once("cart.php");
require_once('connection.php');
session_start();
$state=$_POST["input-state"];
$ft=$_POST["inputAnswer"];
$state_row=mysql_fetch_array(mysql_query("select * from states where states_abbrev='".$state."'"));
$st=$state_row[0];


$ct_row=mysql_fetch_array(mysql_query("select * from categories where category_short='".$ft."'"));

$forms_sql    = mysql_query("select * from forms where category_short='" . $ft . "' and states_short='" . $state . "' order by forms_id");
if (mysql_num_rows($forms_sql)) {
	$myObj->title=$ct_row[1]." - ".strtoupper($state_row["states_name"]);
$myObj->content="
                    <ul>";
					
					while($forms_row=mysql_fetch_array($forms_sql)){
						
                     $myObj->content.=" <li>
                      <h3>".$forms_row["forms_name"]."</h3>
                      <p>This form is valid only in ".$state_row["states_name"]."</p>
                      <strong>$".$forms_row["forms_price"]."</strong> ";
					  if($_SESSION["cart"]->isexist($forms_row["forms_id"]))
					  $myObj->content.="<button type=\"button\" class=\"btn btn-secondary\" onClick=\"remove_from_cart(".$forms_row["forms_id"].",this,".$st.")\">Remove from Cart</button>";
					  else
                      $myObj->content.="<button type=\"button\" class=\"btn btn-secondary\" onClick=\"add_to_cart(".$forms_row["forms_id"].",".$st.",this)\">Add to Cart</button>";
					  
					  $myObj->content.="</li>";
					}
                    $myObj->content.="</ul>";
}
else{
	$myObj->title="Error";
	$myObj->content="<ul><li><h3>No Forms Available</h3><p>Please Choose State and Category Properly</p></li></ul>";
}

$myJSON = json_encode($myObj);

echo $myJSON;
			?>