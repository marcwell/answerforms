<?php
if(isset($_POST["uname"]) && isset($_POST["pass"]))
{
if($_POST["uname"]=="" && $_POST["pass"]=="")
echo "<script>location='index.php?err=1';</script>";
elseif($_POST["uname"]=="")
echo "<script>location='index.php?err=2';</script>";
elseif($_POST["pass"]=="")
echo "<script>location='index.php?err=3';</script>";
else
{
if($_POST["uname"]=="marcwell" && $_POST["pass"]=="cram5775")
{
session_start();
$_SESSION["user"]="marcwell";
$_SESSION["logged_in"]="yes";
echo "<script>location='list_blogs.php';</script>";
}
else
echo "<script>location='index.php?err=4';</script>";
}

}
else
{
echo "<script>location='index.php?err=1';</script>";
}
?>