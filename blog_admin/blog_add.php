<?php
include("connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blog Management</title>
		<link rel="stylesheet" href="docs/style.css" type="text/css">
        
		<script type="text/javascript" src="scripts/wysiwyg.js"></script>
		<script type="text/javascript" src="scripts/wysiwyg-settings.js"></script>
		<script type="text/javascript">
			WYSIWYG.attach('textarea2', full);
		</script>
<style type="text/css">
<!--
@import url("style_admin.css");
-->
</style>

		<script type="text/javascript" src="scripts/CalendarPopup.js"></script>
<STYLE>
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation
			{
			background-color:#6677DD;
			text-align:center;
			vertical-align:center;
			text-decoration:none;
			color:#FFFFFF;
			font-weight:bold;
			}
	.TESTcpDayColumnHeader,
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation,
	.TESTcpCurrentMonthDate,
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDate,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDate,
	.TESTcpCurrentDateDisabled,
	.TESTcpTodayText,
	.TESTcpTodayTextDisabled,
	.TESTcpText
			{
			font-family:arial;
			font-size:8pt;
			}
	TD.TESTcpDayColumnHeader
			{
			text-align:right;
			border:solid thin #6677DD;
			border-width:0 0 1 0;
			}
	.TESTcpCurrentMonthDate,
	.TESTcpOtherMonthDate,
	.TESTcpCurrentDate
			{
			text-align:right;
			text-decoration:none;
			}
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDateDisabled
			{
			color:#D0D0D0;
			text-align:right;
			text-decoration:line-through;
			}
	.TESTcpCurrentMonthDate
			{
			color:#6677DD;
			font-weight:bold;
			}
	.TESTcpCurrentDate
			{
			color: #FFFFFF;
			font-weight:bold;
			}
	.TESTcpOtherMonthDate
			{
			color:#808080;
			}
	TD.TESTcpCurrentDate
			{
			color:#FFFFFF;
			background-color: #6677DD;
			border-width:1;
			border:solid thin #000000;
			}
	TD.TESTcpCurrentDateDisabled
			{
			border-width:1;
			border:solid thin #FFAAAA;
			}
	TD.TESTcpTodayText,
	TD.TESTcpTodayTextDisabled
			{
			border:solid thin #6677DD;
			border-width:1 0 0 0;
			}
	A.TESTcpTodayText,
	SPAN.TESTcpTodayTextDisabled
			{
			height:20px;
			}
	A.TESTcpTodayText
			{
			color:#6677DD;
			font-weight:bold;
			}
	SPAN.TESTcpTodayTextDisabled
			{
			color:#D0D0D0;
			}
	.TESTcpBorder
			{
			border:solid thin #6677DD;
			}
</STYLE>

<script>
function preview()
{
document.form1.submit();
}
function delete_b(n)
{
location='del_label.php?act=del&val='+n;
}
</script>

 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
 <link rel="stylesheet" href="jquery/demos.css" />
	<script src="jquery/jquery-1.9.0.js"></script>
	<script src="jquery/ui/jquery.ui.core.js"></script>
	<script src="jquery/ui/jquery.ui.widget.js"></script>
	<script src="jquery/ui/jquery.ui.position.js"></script>
	<script src="jquery/ui/jquery.ui.menu.js"></script>
	<script src="jquery/ui/jquery.ui.autocomplete.js"></script>
	<script>
	var jq=jQuery.noConflict();
	jq(function() {
		var availableTags = [
<?php
/*
$lbls_query=mysql_query("select * from labels");
$lbl_incr=0;
while($lbls_row=mysql_fetch_array($lbls_query))
{
if($lbl_incr>0)
echo ",";
echo "\"".$lbls_row["lbl_value"]."\"";
$lbl_incr++;
}
*/
?>
		];
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		jq( "#lbls" ).bind( "keydown", function( event ) {
				if ( event.keyCode === jq.ui.keyCode.TAB &&
						jq( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				minLength: 2,
				source: function( request, response ) {
					// delegate back to autocomplete, but extract the last term
					response( jq.ui.autocomplete.filter(
						availableTags, extractLast( request.term ) ) );
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
	});
	</script>

</head>
<body style="background:#FFFFFF">
<table width="80%" align="center"><tr><td class="preview" valign="top">
<div>
<?php

$act="?act=add";
if($_REQUEST["blog_id"])
{
$act="?act=update&blog_id=".$_REQUEST["blog_id"];
$blg_value=mysql_fetch_array(mysql_query("select * from blogs where sl_no=".$_REQUEST["blog_id"]));

}

?>

  <table width="100%" class="table">
  <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="save_blog.php<?php echo $act?>">
<tr><td align="right"><a href='list_blogs.php' style='font:14px Arial, Helvetica, sans-serif; font-weight:bold; color:#000099'>List Blogs</a></td></tr>
    <tr>
      <td><strong>File Name</strong><label><br />
        <input type="text" name="filename" id="filename"  value="<?php if($blg_value["filename"]) echo $blg_value["filename"]?>"/>
      </label></td>
    </tr>
    <tr>
      <td><strong>Meta Title</strong><label>
        <br />
        <input type="text" name="title" id="title"  value="<?php if($blg_value["title"]) echo $blg_value["title"]?>"/>
      </label></td>
    </tr>
    <tr>
      <td><strong>Meta Keywords</strong><label>
        <br />
        <input type="text" name="keywords" id="keywords"  value="<?php if($blg_value["keywords"]) echo $blg_value["keywords"]?>"/>
      </label></td>
    </tr>
    <tr>
      <td><strong>Meta Description</strong><label>
        <br />
        <input type="text" name="description" id="description"  value="<?php if($blg_value["description"]) echo $blg_value["description"]?>"/>
      </label></td>
    </tr>
    <tr>
      <td><strong>Blog Title</strong><label>
        <br />
        <input type="text" name="ctitle" id="ctitle" value="<?php if($blg_value["ctitle"]) echo $blg_value["ctitle"]?>" />
      </label></td>
    </tr>

    <tr>
      <td><strong>Date</strong><label>
<?php

if($blg_value['date_time'])
$dte=$blg_value['date_time'];
else
$dte=time();

?>
        <input type="text" name="cdte" id="cdte" value="<?=date('m/d/Y',$dte)?>" readonly="readonly" style="width:80px" />
      </label>
      <a href='#' onClick="cal190.select(document.forms[0].cdte,'anchor190','MM/dd/yyyy'); return false;" name='anchor190' id='anchor190'><img src='images/calend.gif' border=0></a>
      
<div id="testdiv20" style="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
<SCRIPT LANGUAGE="JavaScript" ID="js190">
var cal190 = new CalendarPopup("testdiv20");
cal190.setCssPrefix("TEST");
cal190.isShowYearNavigation=true;
</SCRIPT>
</td>
    </tr>
<tr valign="top">
    <td>
<b>Images</b>
<br />
Image File: <input type="file" name="img_file">
<br />
<br />
Alt Tag: <input type="text" name="alt" value="<?php if(isset($blg_value["i_alt_tag"]))
echo $blg_value["i_alt_tag"];?>" />
<br />
<br />
Title Tag: <input type="text" name="i_title" value="<?php if(isset($blg_value["i_title_tag"]))
echo $blg_value["i_title_tag"];?>" />
</td></tr>
	    
    <tr valign="top">
      <td><strong>Content</strong><textarea id="textarea2" name="test2" style="width:100%;height:300px;"><?php if(isset($blg_value["content"]))
echo $blg_value["content"];
?></textarea></td>
    </tr>
    <tr valign="top"><td>
    <?php
	/*
$lbl_incr=0;$lbl_txt="";
if($_REQUEST["blog_id"]!="")
{
$lbls_query=mysql_query("select * from labels where lbl_id in (select lbl_id from labels_link where blg_id=".$_REQUEST["blog_id"].")");
while($lbls_row=mysql_fetch_array($lbls_query))
{
if($lbl_incr>0)
$lbl_txt.=", ";
$lbl_txt.=$lbls_row["lbl_value"];
$lbl_incr++;
}
}
*/
?>
</td></tr>    
    
    <tr valign="top">
      <td align="right"><input type="submit" value="Save" class="button" style='padding-bottom:5px'/></td>
    </tr>
  </table><br>
<br>
<br>

</form>
</div>
</td><!--td class="preview" width="800px">
<div style="width:800px">
<?php
//include("content_panel.php");
?>
</div>
</td--></tr></table>
<br />
</body>
</html>