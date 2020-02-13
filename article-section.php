<?php
require_once('connection.php');

?>
      <div class="site-section py-5" id="blog-section">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
              <div class="block-heading-1" data-aos="fade-right" data-aos-delay="">
                <h2>Articles</h2>
              </div>
            </div>
          </div>
          <div class="row">
		  <?php
		  $sql=mysql_query("select * from blogs order by date_time desc limit 2");
while($row=mysql_fetch_array($sql))
{

		  ?>
            <div class="col-lg-6">
              <div class="mb-5 d-flex blog-entry" data-aos="fade-right" data-aos-delay="">
                <a href="#" class="blog-thumbnail"><img src="images/cargo_sea_small.jpg" alt="Image" class="img-fluid"></a>
                <div class="blog-excerpt">
                  <span class="d-block text-muted"><?=date('M d, Y',$row["date_time"])?></span>
                  <h2 class="h4  mb-3"><a href="<?=$row["filename"].".php"?>"><?=strtoupper($row["ctitle"])?></a></h2>

                  <p><?=$row["brief_content"]?></p>
                  <p><a href="<?=$row["filename"].".php"?>" class="text-primary">Read More</a></p>
                </div>
              </div>
            </div>
<?php
}
?>

          </div>
        </div>
      </div>
	  