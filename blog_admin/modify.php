<?php
include("connection.php");
if($_REQUEST["act"])
{
if($_REQUEST["act"]=="del")
{
mysql_query("delete from blogs where sl_no=".$_REQUEST["val"]);
}
}
echo "<script>location='list_blogs.php';</script>";
?>