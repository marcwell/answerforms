  <div class="col-md-4 sidebar">        
          
			<div class="sidebar-box">
              <div class="categories">
                <h3>Recent Articles</h3>
                	<?php
$sql=mysql_query("select * from blogs order by date_time");
while($row=mysql_fetch_array($sql))
{
echo "<li><a href='".$row["filename"].".php'>".strtoupper
($row["ctitle"])."</a></li>";	
				}
				?>
                           </div>
            </div>

          </div>