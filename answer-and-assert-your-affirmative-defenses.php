<?php
include("connection.php");

$filename=substr(basename($_SERVER['SCRIPT_FILENAME']),0,strrpos(basename($_SERVER['SCRIPT_FILENAME']),'.'));
$blg_value=mysql_fetch_array(mysql_query("select * from blogs where filename='".$filename."'"));

if($blg_value["title"]!='')
$title=$blg_value["title"];
else if($blg_value["ctitle"]!='')
$title=$blg_value["ctitle"];
else
$title="Answer Forms - Blogs";
		  include("header.php");



?>
   <div class="site-section-cover overlay inner-page bg-light" style="background-image: url('https://www.answerforms.com/images/115862679.jpg')" data-aos="fade">
      
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-lg-10">

            <div class="box-shadow-content">
              <div class="block-heading-1">
                <span class="d-block mb-3 text-white" data-aos="fade-up"><?php if($blg_value["date_time"]!='')

echo date('F d, Y',$blg_value["date_time"]);
?>
<span class="mx-2 text-primary">&bullet;</span> by Marc Rapaport</span>
                <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">
                <?php

if(isset($blg_value["ctitle"]))

echo strtoupper($blg_value["ctitle"]);

?>
</h1>
              </div>
              
              
            </div>
          </div>
        </div>
      </div>
      
    </div>

    
    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 blog-content">
            <p class="lead"><?php



if(isset($blg_value["content"]))

echo str_replace("src=\"uploads/","src=\"admin/uploads/",$blg_value["content"]);

?>
</p>                


    
     


            <div class="pt-5">
                         
              <!-- END comment-list -->
              
            </div>

          </div>
        
        
         <?php
		  include("blog_right.php");
?>

        </div>
      </div>
    </div>


 <?php
		  include("footer.php");
?>