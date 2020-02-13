<?php
$title="Civil Answer Forms";
		  include("header.php");
?>

    

      

    <div class="site-section bg-light">
      <div class="container">
	  
	  <form action="shoppingCart.php" method="post" name="cart">
				<input type="hidden" name="action_val" value="remove_from_cart">
					<?=$_SESSION["cart"]->showCart();?><br>
				<br>

				<table border="0" cellpadding="0" cellspacing="0" width="80%" align="center">
					<tr>
						<td align="left"><input type='submit' value="Remove"></td>
						<td align="center"><input type='button' onClick="location='index.php';" value="Continue Shopping"></td>
						<td align='right'><input type="button" onClick="location='payment.php';" value="Checkout"></a></td>
					</tr>
				</table>

                
                
                </form>
	  
      </div>
    </div>


<?php
		  include("footer.php");
?>