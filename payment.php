<?php
$title="Civil Answer Forms";
		  include("header.php");
?>

    

      

    <div class="site-section bg-light">
      <div class="container">
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
function change_image()
{
var url='echo_image.php';
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	 {
 	 alert ("Your browser does not support AJAX!");
 	 return;
 	} 
	 
  xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
	document.getElementById("img_div").innerHTML=xmlHttp.responseText;
      }
    }
	xmlHttp.open("GET",url+'?rand='+Math.random(),true);
	xmlHttp.send(null);
} 

function shipOn(obj)
{
	
	//alert("inside shipOn:"+obj);
	if(obj=="Yes")
	{
		//alert("enabling the fields....");
		document.getElementById("first").style.color="black";
		document.getElementById("last").style.color="black";
		document.getElementById("address").style.color="black";
		document.getElementById("city").style.color="black";
		document.getElementById("state").style.color="black";
		document.getElementById("zip").style.color="black";
		document.order.x_ship_to_first_name.disabled=false;
		document.order.x_ship_to_last_name.disabled=false;
		document.order.x_ship_to_address.disabled=false;
		document.order.x_ship_to_city.disabled=false;
		document.order.x_ship_to_state.disabled=false;
		document.order.x_ship_to_zip.disabled=false;
	}
	if(obj=="No")
	{
		//alert("disabling the fields....");
		document.getElementById("first").style.color="#999999";
		document.getElementById("last").style.color="#999999";
		document.getElementById("address").style.color="#999999";
		document.getElementById("city").style.color="#999999";
		document.getElementById("state").style.color="#999999";
		document.getElementById("zip").style.color="#999999";
		document.order.x_ship_to_first_name.disabled=true;
		document.order.x_ship_to_last_name.disabled=true;
		document.order.x_ship_to_address.disabled=true;
		document.order.x_ship_to_city.disabled=true;
		document.order.x_ship_to_state.disabled=true;
		document.order.x_ship_to_zip.disabled=true;
	}
}

function submitForm(){
var form=document.order;

if(form.x_first_name.value=="")
		{
		alert("Please fill First Name");
		form.x_first_name.focus();
		return false;
		}
	if(form.x_last_name.value=="")
		{
		alert("Please fill Last Name");
		form.x_last_name.focus();
		return false;
		}
	if(form.x_address.value=="")
		{
		alert("Please fill your Adress");
		form.x_address.focus();
		return false;
		}
	if(form.x_city.value=="")
		{
		alert("Please fill your City");
		form.x_city.focus();
		return false;
		}
	if(form.x_state.value=="")
		{
		alert("Please fill your State");
		form.x_state.focus();
		return false;
		}	
	if(form.x_zip.value=="")
		{
		alert("Please fill your Zipcode");
		form.x_zip.focus();
		return false;
		}
	if(form.x_phone.value=="")
		{
		alert("Please fill your Phone Number");
		form.x_phone.focus();
		return false;
		}
validRegExp = /^[^@]+@[^@]+.[a-z]{2,}$/i;
var strEmail=form.x_email.value;   	
	if(strEmail.search(validRegExp) == -1) 
   		{
   		alert('A valid e-mail address is required.');
		form.x_email.value="";
		form.x_email.focus();
   		return false;
   		} 


		var v = grecaptcha.getResponse();
    if(v.length == 0)
	{
		alert("Please complete \"I'm not a Robot\"");
		return false;
	}



	if(form.x_state.value=="New York"){
		price=parseFloat(form.x_amount.value);
		taxAmount=price*0.08875;
		tax=taxAmount.toFixed(2);
		form.tax_add.value=tax;
		price=parseFloat(tax)+parseFloat(price);
		price=price.toFixed(2);
		if(confirm('Tax (8.875%): $'+tax+' Will be added to your order. \n Grand Total: $'+price)){
			form.x_amount.value=price;
		}
		else
		return false;
		
		}
		
		return true;
}
</script>
<?php
					if(isset($_REQUEST["msg"]) && $_REQUEST["msg"]!='')
					echo "<center style='font-family:arial;color:red;font-size:12px;'>".$_REQUEST["msg"]."</center>";
					?>
<?php
$declined=$error=false;
if(isset($_GET["code"]) && isset($_GET["response"])) 
{
	$sfCode=$_GET["code"];
	$response=$_GET["response"];$declined=false;
	$error=false;
	if($sfCode==2)
	{
		$declined=true;
	}
	elseif($sfCode==3)
	{
		$error=true;
	}
echo "<center><div style='text-aling:justify;width:65%;border:3px double red;'>";
if($declined)
{
	echo("<p style='color:#FF0000;' align='center'><b>Card Declined</b></p>");
	echo("<div style='color:#FF0000;  padding: 5px' align='justify'>Unfortunately the card you used has been declined.  An error in the authorization process could be to blame.  If you wish to continue with this purchase either re-enter your credit card information or try a different card. We apologize for the inconvenience.
	</div>");
}
elseif($error)
{
	echo("<p style='color:#FF0000' align='center'><b>Processing Error</b></p>");
	if($response==6)
	{
		echo("<div style='color:#FF0000; padding: 5px' align='justify'>The Card Number You Provided Is Invalid.<br><br>Please carefully re-enter your information and click Continue.<br><br>We apologize for the inconvenience</div>");
	}
	else
	{
		echo("<div style='color:#FF0000; padding: 5px' align'justify'>There has been an error in processing your request.  Please wait 5 minutes and attempt again. <br><br>We apologize for the inconvenience. </div>");
	}
}
echo "</div></center>";
}
?>
  <div id="page_content">
<div class="table" style="width:100%"><div class="table_row">
<div class="col"><div style="line-height:150%; text-align:center; width:100%;">
<div><table border="0" cellpadding="0" cellspacing="0" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px"><tr><td><img src="images/Icons2.gif" /></td><td><b>Upon Approval of Your Credit Card, You Will Be Able to Immediately Download Your Form in MSWord Format.</b></td></tr></table></div><br />
<div style="border:1px solid #124662; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; padding:5px; max-width:500px; text-align:center; margin:auto">
ON YOUR CREDIT CARD STATEMENT, THIS PURCHASE WILL APPEAR AS "EMPIRE STATE LEGAL FORMS, INC."</div>
<form action="creditProcess.php" method="POST" name="order" onSubmit="return submitForm();">
<br />
<div class="table" style="border:1px solid #2A0E72; width:80%; margin:auto; border-top-left-radius:20px; border-top-right-radius:20px;">
<div class="table_row"><div class="col" style="border-top-left-radius:15px; border-top-right-radius:15px; padding:10px; background-color:#2A0E72; color:#FFF; font-size:1.667em; text-align:center; vertical-align:center; font-weight:bold">ORDER INFORMATION</div></div></div>

<div class="table" style="border-right:1px solid #2A0E72; border-left:1px solid #2A0E72; width:80%; margin:auto; margin-top:-10px; "><div class="table_row"><div class="col" style="font-size:1.667em; text-align:center; vertical-align:center;"> 
              <table style="width:100%" align="center">
                              <td style="width:10px" align="center">&nbsp;</td>
                  <td valign="top" style="line-height:150%" align="left"><br>
				  
                  
				  <?=$_SESSION["cart"]->showCart(true);?>
				  
                 							<?php
								$formName="";
								for($i=0;$i<sizeof($_SESSION["cart"]->contents);$i++) {
		$formName.=$_SESSION["cart"]->contents[$i]["forms_state"].": ".$_SESSION["cart"]->contents[$i]["forms_name"]."<br><br>";
	}
								
							echo"
			<input type=\"hidden\" name=\"x_amount\" value=\"".$_SESSION["cart"]->get_total_cost()."\">
			<input type=\"hidden\" name=\"f_price\" value=\"".$_SESSION["cart"]->get_total_cost()."\">
			<input type=\"hidden\" name=\"tax_add\" value=\"0\">
			<input type=\"hidden\" name=\"x_method\" value=\"CC\">
			<input type=\"hidden\" name=\"x_formName\" value=\"".$formName."\">
			<input type=\"hidden\" name=\"x_merchant_email\" value='MarcREsq@aol.com'>";
			?>
                    <br>
                  </td>
                  <td style="width:10px" align="center">&nbsp;</td>
                </tr>
                        </table></div></div></div>
                        <div class="table" style="border-right:1px solid #2A0E72; border-bottom:1px solid #2A0E72; border-left:1px solid #2A0E72; width:80%; margin:auto; border-bottom-left-radius:20px; border-bottom-right-radius:20px;">
<div class="table_row"><div class="col" style="border-bottom-left-radius:15px; border-bottom-right-radius:15px; font-size:1.667em; text-align:center; vertical-align:center; font-weight:bold"> </div></div></div>

                        
              <br>
              <br>
              <table align="center" width="80%" style="border:1px solid #331867" cellspacing="0" cellpadding="5">
                <tr>
                  <th colspan="2" align="center" bgcolor="#331867" style="color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px">Credit Card Information</th>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">Choose Your Card:</td>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px"><select name="cardtype">
                      <option value="AMEX">AMEX</option>
                      <option value="Discover">Discover</option>
                      <option value="Mastercard">Mastercard</option>
                      <option value="Visa">Visa</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">Credit Card Number:</td>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px"><input type="text" name="x_card_num" size="22" maxlength="22"></td>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">Expiration Date: (MMYYYY)</td>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px"><select name="expire_month">
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>
                    /
                    <select name="expire_year">
                      <script language="JavaScript">
	var now=new Date();
	for(var i=0;i<11;i++) {
		document.write("<option value='"+(now.getFullYear()+i)+"'>"+(now.getFullYear()+i)+"</option>");
	}
</script>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th colspan="2">&nbsp;</th>
                </tr>
                <tr>
                  <th colspan="2" align="center" bgcolor="#331867" style="color:#FFFFFF;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px">Billing Address</th>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">First Name:</td>
                  <td><input type="text" name="x_first_name"></td>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">Last Name:</td>
                  <td><input type="text" name="x_last_name"></td>
                </tr>
                <tr>
                  <td style="ont-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">Address:</td>
                  <td><input type="text" name="x_address"></td>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">City:</td>
                  <td><input type="text" name="x_city"></td>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">State:</td>
                  <td><select name='x_state'>
                      <option></option>
                      <?php
		  include("states_full_select.php");
?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">Zip Code:</td>
                  <td><input type="text" name='x_zip' size='5' maxlength='5'></td>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">Home Phone:</td>
                  <td><input type="text" name='x_phone' size='20' maxlength='20'>
                  </td>
                </tr>
                <tr>
                  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">E-Mail</td>
                  <td><input type="text" name='x_email' size='30' maxlength='255'></td>
                </tr>
<tr><td colspan=2 align=right><div class="g-recaptcha" data-sitekey="6LeKkEgUAAAAAE5_aylsY-ro24gQ5MLO8hy55-FK"></div></td></tr>
                 <tr>
                  <td colspan="2" align="right"><input type="image" src="images/continue.gif"></td>
                </tr>
              </table>
            </form>
            <br>
            <br>
          </td>
        </tr>
      </table>
                  
                  </div>
</div>
</div>
  
      </div>
    </div>

      </div>
    </div>
	
<?php

		  include("footer.php");
?>