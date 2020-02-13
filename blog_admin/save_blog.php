<?php

include("connection.php");
if($_REQUEST["act"])
{
if($_REQUEST["act"]=="add")
{
$cdte=$_REQUEST["cdte"];

$dte=strtotime(substr($cdte,-4)."/".substr($cdte,0,2)."/".substr($cdte,3,2));

mysql_query("insert into blogs (sl_no,date_time) values (null,'".$dte."')");

$id=mysql_insert_id();
}
else
$id=$_REQUEST["blog_id"];

$cat_id=$_POST["categories"];
/*
if($_POST["categories"]=="-New-")

{

mysql_query("insert into categories (categories_name) values ('".$_POST['txt_cat']."')");

$cat_id=mysql_insert_id();

}

*/

if($_POST["filename"]=='')
$filename="article-".time();
else
$filename=$_POST["filename"];

$fimg=$_FILES['img_file']['name'];
$fimg=str_replace("\'","",$fimg);
$fimg=str_replace("\"","",$fimg);
$filen=substr($fimg, 0, strripos($fimg, '.'))."_".time();
if($fimg!='')
{
	$destination_file1="images/".str_replace(" ","-",$filen).".".substr(strrchr($fimg, '.'), 1);
		move_uploaded_file($_FILES['img_file']["tmp_name"], $destination_file1);
		$fimg=str_replace(" ","-",$filen).".".substr(strrchr($fimg, '.'), 1);
		mysql_query("update blogs set i_file_name='".$fimg."' where sl_no=".$id);
}
$post_content=$_POST["test2"];
$post_content=str_replace("\\","",$post_content);
include("unauthorizedchar.php");

$post_content=addslashes($post_content);
$cdte=$_REQUEST["cdte"];
$dte=strtotime(substr($cdte,-4)."/".substr($cdte,0,2)."/".substr($cdte,3,2));

mysql_query("update blogs set title='".$_POST["title"]."',
keywords='".$_POST["keywords"]."',
description='".$_POST["description"]."',
ctitle='".ucwords(strtolower($_POST["ctitle"]))."',
categories='".$cat_id."',
content='".$post_content."',
date_time='".$dte."',
filename='".str_replace(" ","-",$filename)."',
i_alt_tag='".$_POST["alt"]."',
i_title_tag='".$_POST["i_title"]."' 
where sl_no=".$id);
if(mysql_error())
{
echo mysql_error();
exit();
}

$filename=str_replace(" ","-",$filename).".php";
$fp=fopen("../".$filename,'w');
fwrite($fp,file_get_contents("new-file.php"));
fclose($fp);

/*
mysql_query("delete from labels_link where blg_id=".$id);

if(isset($_REQUEST["lbls"]) && $_REQUEST["lbls"]!='')
{
	$lbls=$_REQUEST["lbls"];
	
	$lbl_array=array_unique(explode(",",$lbls));

	foreach($lbl_array as $lbl_val){
	$lbl_val=trim($lbl_val);
	if($lbl_val!=''){
		if($lbl_row=mysql_fetch_array(mysql_query("select lbl_id from labels where lbl_value='".$lbl_val."'")))
		{
			mysql_query("insert into labels_link (lbl_id,blg_id) values(".$lbl_row[0].",".$id.")");
		}
		else
		{
			mysql_query("insert into labels (lbl_value) values ('".$lbl_val."')");
			$lbl_id=mysql_insert_id();
			mysql_query("insert into labels_link (lbl_id,blg_id) values(".$lbl_id.",".$id.")");
		}
		}
	}
}
*/
echo "<script>location='list_blogs.php';</script>";


}


?>