<?php
include("connection.php");
?><html>
<head>
<?php
$filename=substr(basename($_SERVER['SCRIPT_FILENAME']),0,strrpos(basename($_SERVER['SCRIPT_FILENAME']),'.'));
$blg_value=mysql_fetch_array(mysql_query("select * from blogs where filename='".$filename."'"));
?>


<?php include("blog_head.php");
?>

<table border="0px" width="940" cellspacing="0" cellpadding="0" align="center">

  <tr>

<?php include("head.php");
?></tr>

  <tr>

    <td colspan="2"><table border="0" bgcolor="#fffccc" cellspacing="0" cellpadding="0" >

        <tr>

          <td width="302" align="right" style="padding-top:8px" valign="top">
<?php include("left.php");
?></td>

          <td valign="top" style="font-family:Verdana; font-size:13px; padding-left:30px;padding-top:8px; background-color:#ffffff" width="630">

<?php include("blog_content.php");
?>
</td>
</tr>
<?php

include ("bottom.php");

?>

 </table></td>

  </tr>

</table>

</body>

</html>