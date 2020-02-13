<?php

class Cart {

	var $contents;

	var $address;

	var $email="";

	var $order_no;

	var $address_id;

	var $coupon;

	var $discount_amount;

	

	function Cart() {

		  $this->reset();

	}



	function add($forms_id,$states_id) {

		$exists=false;

		for($i=0,$n=$this->no_items_in_cart();$i<$n;$i++) {

			if($forms_id==$this->contents[$i]["forms_id"]) {

				$exists=true;

			}

		}

	

		if($exists==false) {

			$forms_info_results=mysql_query("select f.forms_name,f.forms_price from forms f where f.forms_id='".$forms_id."'");

			$forms_info=mysql_fetch_array($forms_info_results);

			$index=$this->no_items_in_cart();

			$this->contents[$index]=array('forms_id'=>$forms_id,

									'forms_name'=>$forms_info["forms_name"],

									'forms_state'=>$states_id,

									'forms_price'=>$forms_info["forms_price"]);

		}

	

	}



	

function isexist($forms_id)
{
		$exists=false;

		for($i=0,$n=$this->no_items_in_cart();$i<$n;$i++) {

			if($forms_id==$this->contents[$i]["forms_id"]) {

				$exists=true;

			}

		}
		return $exists;
}





function remove($product_id) {

		for($i=0,$n=$this->no_items_in_cart();$i<$n;$i++) {

			if($product_id==$this->contents[$i]["forms_id"]) {

				array_splice($this->contents,$i,1);

				

			}

		}

	}



	function reset() {

		$this->contents=array();

		$this->coupon='';

		$this->discount_amount=0;

	}



	function showCart($checkout=false) {

		$display="<table border='1' style='border-color: #8B919F' bordercolor='#8B919F' bgcolor='#8B919F' cellpadding='5' cellspacing='2' align='center' width='100%'><thead><tr><th colspan='3' bgcolor='#331867' class='selectionHeader' style='color:#FFFFFF; font-family:verdana; font-size:14px'>Your Shopping Cart</th></tr></thead>";

		$total_cost=0;

		$n=$this->no_items_in_cart();

		if($n==0) {

			$display.="<tr><td style='font-family:verdana; font-size:12px'>Your Cart Is Empty</td></tr>";

		}else{

			for($i=0;$i<$n;$i++) {

				$total_cost+=$this->contents[$i]["forms_price"];

				if($checkout) {

					$check="&nbsp;";

				}else{

					$check="<input type='checkbox' name='pID[]' value='".$this->contents[$i]["forms_id"]."'>";

				}

				$display.="<tr bgcolor='#F0F0F0' class='cartItem' align='center' bordercolor='#FFFFFF'><td align='left' width='20px'>".$check."</td><td style='font-family:verdana; font-size:12px; text-align:left'>".$this->contents[$i]["forms_name"]."</td></td><td width='60px' style='font-family:verdana; font-size:12px; '>$".$this->contents[$i]["forms_price"]."</td><tr>";

							

			

			}

			$display.="<tr bgcolor='#331867' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size: 12px;color:#FFFFFF'><td colspan='2' align='right'><b>Sub-Total: <b></td><td align='center'><b>$".number_format($total_cost,2)."</b></td></tr>";

			

			if(isset($this->address)) $address_count=sizeof($this->address);

			if($address_count>0) {

				if($this->address["state"]==32){

					$tax=round($total_cost*0.08375,2);

		







		$total_cost+=$tax;

					$display.="<tr bgcolor='#FFFFFF' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size: 12px;color:#FF0000'><td colspan='2' align='right'><b>NY Sales Tax <span style='font-size:10px'>(8.375%)</span> <b></td><td align='center'><b>$".$tax."</b></td></tr>";

				}

			}

			

			if(is_array($this->coupon) && $this->discount_amount!=0){

					$total_cost-=$this->discount_amount;

					$display.="<tr bgcolor='#FFFFFF' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size: 12px;color:#FF0000'><td colspan='2' align='right'><b>".$this->coupon['coupon_description']."<b></td><td align='center'><b>-$".$this->discount_amount."</b></td></tr>";

			}

			

			$display.="<tr bgcolor='#331867' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size: 12px;color:#FFFFFF'><td colspan='2' align='right'><b>Total: <b></td><td align='center'><b>$".number_format($total_cost,2)."</b></td></tr>";

			

		}

		return $display."</table>";

	}

	

	

	

function emailCart(){

		$display="";

		$total_cost=0;

		$n=$this->no_items_in_cart();

			for($i=0;$i<$n;$i++) {

				$total_cost+=$this->contents[$i]["forms_price"];

				$display.="\n".$this->contents[$i]["forms_name"]." - ". tep_get_state_name($this->contents[$i]["forms_state"])." $".$this->contents[$i]["forms_price"];

							

			

			}

			if(isset($this->address)) $address_count=sizeof($this->address);

			if($address_count>0) {

				if($this->address[$address_count-1]["state"]==32){

					$tax=round($total_cost*0.08375,2);

					$total_cost+=$tax;

					$display.="\n NY Sales Tax (8.375%) $".$tax;

				}

			}

			

			$display.="\n Total: $".$total_cost."\n\n";

			$display.="NOTE:  If you experience any problems in downloading or opening your purchased Legal Form, please e-mail us at info@asaplegalforms.com and we will resolve the issue quickly.";

		return $display;

}	



function get_total_cost(){

	$total_cost=0;

	$n=$this->no_items_in_cart();

	for($i=0;$i<$n;$i++) {

		$total_cost+=$this->contents[$i]["forms_price"];





	}

	return $total_cost;

}



function no_items_in_cart() {

	return sizeof($this->contents);

}	



	

function addAddress($firstname,$lastname,$street,$city,$state,$zipcode,$phone,$email="") {



	if(!is_array($this->address)){

		$this->address=array();

	}

	

	if($email!="") {

		$this->email=$email;

	}

	

	$this->address = array(	"firstName"=>$firstname,

							"lastName"=>$lastname,

							"street"=> $street,

							"city"=>$city,

							"state"=>$state,

							"zipcode"=>$zipcode,

							"phone"=>$phone);

}	





function showAddress($receipt=false) {

	$state_query=tep_db_query("select states_abbrev from States where states_id='".$this->address["state"]."'");

	$state=tep_db_fetch_array($state_query);



	echo("<table border='1' bordercolor='#629D81' bgcolor='#629D81' cellpadding='5' cellspacing='2' align='center' width='100%'>

			<thead bgcolor='#1A4B56' class='selectionHeader'>");

	

	if($receipt) {

		echo("<th valign='bottom'>Billing Address</th>");

	}else{

		echo("<th valign='bottom'>Billing Address &nbsp;<a href='https://www.asaplegalforms.com/payment.php'><img src='images/buttons/edit.gif' border='0'></a></th>");

	}

			

		echo("	</thead>

			<tr align='left' bgcolor='#5B9798' class='cartItem' bordercolor='#FFFFFF'>

				<td>".$this->address["firstName"]." ".$this->address["lastName"]."<br>".

				$this->address["street"]."<br>");

				echo($this->address["city"].", ".

				$state["states_abbrev"]." ".

				$this->address["zipcode"]."<br>".

				$this->email."</td>

			</tr><tr bgcolor='#000000'><td>&nbsp;</td></tr>

		</table>");

}	



function addNewCustomer() {



	$search_query=tep_db_query("select customer_id from Customers where customer_email='".$this->email."'");

		

	if(tep_db_num_rows($search_query)<=0 ){

		$sql_data_array=array(	"customer_email"=>$this->email,

								"customer_firstname"=>$this->address["firstName"],

								"customer_lastname"=>$this->address["lastName"],

								"date_added"=>"now()");

								

		 tep_db_perform("Customers", $sql_data_array);		

		 $customer_id = tep_db_insert_id();

	 }else{

	 	$search=tep_db_fetch_array($search_query);

		$customer_id=$search["customer_id"];

	 }

	 

	 $this->addAddressBook($customer_id);

}



function addAddressBook($customer_id) {

			$search_query=tep_db_query("select address_book_id from address_book where customer_id='".$customer_id."' and address_street='".$this->address["street"]."' and address_city='".$this->address["city"]."' and states_id='".$this->address["state"]."' and address_postcode='".$this->address["zipcode"]."'");

			if(tep_db_num_rows($search_query)<=0 ){

				$sql_data_array=array(	"customer_id"=>$customer_id,

										"address_firstname"=>$this->address["firstName"],

										"address_lastname"=>$this->address["lastName"],

										"address_street"=>$this->address["street"],

										"address_city"=>$this->address["city"],

										"states_id"=>$this->address["state"],

										"address_postcode"=>$this->address["zipcode"],

										"address_phone"=>$this->address["phone"]);

				tep_db_perform("address_book", $sql_data_array);	

				$this->address_id=tep_db_insert_id();

			 }	

}





	function addNewOrder() {

	







if($this->address["state"]==32){

					$tax=round($total_cost*0.08375,2);

		



}



//echo $this->tax_added;



$sql_data_array=array(	"order_date"=>"now()",

								"customer_id"=>$this->get_customer_id(),

								"address_book_id"=>$this->address_id,

								"final_price"=>$this->get_total_cost()-$_SESSION["cart"]->discount_amount,





"tax_added"=>$this->tax_added,							"coupon_id"=>(is_array($this->coupon))? $this->coupon["coupon_id"]:0,

								"coupon_amount"=>(is_array($this->coupon))? $this->discount_amount:0);

		

		tep_db_perform("Orders",$sql_data_array);

		$this->order_no=tep_db_insert_id();

		

		if(is_array($this->coupon) && $this->coupon["coupon_id"]!="0"){

			tep_db_query("update coupons set coupon_count=coupon_count+1 where coupon_id='".$this->coupon["coupon_id"]."'");

		}

		

		for($i=0,$n=sizeof($this->contents);$i<$n;$i++){

			$sql_data_array=array(	"order_no"=>$this->order_no,

									"forms_id "=>$this->contents[$i]["forms_id"],

									'states_id'=>$this->contents[$i]["forms_state"]);

			

			tep_db_perform('orders_forms',$sql_data_array);

			

		}

									

	}

	

	

	function get_customer_id(){

		$customer_id_query=tep_db_query("select customer_id from Customers where customer_email LIKE '%".$this->email."%'");

		$customer_id=tep_db_fetch_array($customer_id_query);

		

		return $customer_id["customer_id"];

	}

	





	function validateCoupon($code){

		$coupon_query=tep_db_query("select coupon_id,coupon_description,coupon_code,coupon_min_amount,coupon_amount,coupon_type,coupon_end_date from coupons where coupon_code='$code' and coupon_start_date<now()");

		

		if(tep_db_num_rows($coupon_query)>0){

			$coupon=tep_db_fetch_array($coupon_query);

			$endDate=split("-",$coupon["coupon_end_date"]);

			$current_date=mktime(0,0,0,date("m"),date("d"),date("Y"));

			$end_date=mktime(0,0,0,$endDate[1],$endDate[2],$endDate[0]);

			

			if($end_date<$current_date){

				return "Sorry, the code you entered is now expired. Please enter a new code.";

			}else if($coupon["coupon_min_amount"]>$this->get_total_cost()){

				$difference=number_format($coupon["coupon_min_amount"]-$this->get_total_cost(),2);

				return "Sorry, the minimum order for this code is <span style='color:#000000'>$".$coupon["coupon_min_amount"]."</span>, you need an additional <span style='color:#000000'>$".$difference."</span>.";

			}else{

				$this->coupon=$coupon;

				$this->set_coupon_discount();

				return "";		

			}

		}else{

			return "Sorry, the code you entered is not valid at the present time.";

		}

	

	}



	function set_coupon_discount(){

		if($this->coupon["coupon_type"]=="0"){

			$this->discount_amount=$this->coupon["coupon_amount"];

		}else{

			$subtotal=$this->get_total_cost();

			$this->discount_amount=number_format($subtotal*($this->coupon["coupon_amount"]/100),2);

			

		}

	}



} //end of class

?>