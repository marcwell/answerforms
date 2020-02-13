<title>Answerforms Admin Area</title>
<?php
if(isset($_REQUEST["err"]) && $_REQUEST["err"]!="")
{
echo "<center style='font:12px verdana;color:red'>";
if($_REQUEST["err"]==1)
echo "Username and Password sould not be Blank";
elseif($_REQUEST["err"]==2)
echo "Username should not be Blank";
elseif($_REQUEST["err"]==3)
echo "Password should not be Blank";
elseif($_REQUEST["err"]==4)
echo "Username or Password is invalid";

echo "</center>";
}
?>
<form name="login" action="login.php" method="post">
<table border="1" bordercolor="#331867" style="font:12px Verdana, Arial, Helvetica, sans-serif;" cellpadding="5" cellspacing="0" align="center" width="300px">
<tr><th colspan="2" bgcolor="331867" style="color:#FFFFFF">Administrator Login</th>
</tr>
<tr><td colspan="2">
<table width="100%" style="font:12px Verdana, Arial, Helvetica, sans-serif">
<tr><td>Username</td><td><input name="uname" type="text" size="30"></td></tr>
<tr><td>Password</td><td><input name="pass" type="password" size="30"></td></tr>
</table></td></tr>
<tr><td colspan="2" align="right"><input type="submit" value="Login" style="background-color:#331867; color:#FFFFFF; font:12px Verdana, Arial, Helvetica, sans-serif; font-weight:bold"></td></tr>
</table>
</form>