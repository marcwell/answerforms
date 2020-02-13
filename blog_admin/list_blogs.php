<?php

include("connection.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Blog Management</title>

<style type="text/css">

td

{

padding:5px;

}

</style>

<script>
function mail_b(n)

{

a=confirm("Click Ok to Follows Mail");

if(a)

location='follow-mail.php?act=mail&val='+n;

}
function delete_b(n)

{

a=confirm("Click Ok to Delete this Blog");

if(a)

location='modify.php?act=del&val='+n;

}

function archive_b(n)

{

a=confirm("Click Ok to Archive this Blog");

if(a)

location='modify.php?act=arch&val='+n;

}

</script>

</head>

<body>
<center><strong style="font:18px Georgia, 'Times New Roman', Times, serif; color:#990000; font-weight:bold">Blogs List</strong></center><br>

<table style="font:12px Verdana, 'Times New Roman', Times, serif; font-weight:bold" border="1" bordercolor="#0000FF" width="900px" align="center" cellspacing="4">
<tr><td colspan="7" align="right"><a href='blog_add.php' style='font:14px Arial, Helvetica, sans-serif; font-weight:bold; color:#000099'>Add New Blog</a></td></tr>
<tr><th>Sl. No.</th><th width="130">Date</th><th>Blog Title</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr>

<?php

$sql=mysql_query("select * from blogs order by date_time desc");

$i=0;

while($row=mysql_fetch_array($sql))

{

$i++;

echo "<tr>

<td>".$i.".

<td>".date("d M, Y",$row["date_time"])."

<td width=550>".$row["ctitle"];

//$crow=mysql_fetch_array(mysql_query("select * from categories where categories_id=".$row["categories"]));

echo "<th><img src='images/edit.gif' title='Edit' width=20 style='cursor:pointer' onclick='location=\"blog_add.php?blog_id=".$row["sl_no"]."\";'>

<!--th><img src='images/archive.jpg' title='Move to Archive' width=20 style='cursor:pointer' onclick='delete_b(".$row["sl_no"].");'-->

<th><img src='images/trash.gif' title='Delete' width=20 style='cursor:pointer' onclick='delete_b(".$row["sl_no"].");'>

<th><img src='images/mail.gif' title='Follows-Mail' width=20 style='cursor:pointer' onclick='mail_b(".$row["sl_no"].");'>

</tr>";

}

?>

</table><br />

</body>

</html>