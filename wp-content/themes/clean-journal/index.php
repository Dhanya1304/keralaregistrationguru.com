<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Catch Themes
 * @subpackage Clean Journal
 * @since Clean Journal 0.1 
 */

get_header(); ?>

<style>
    .hentry {
        margin-bottom:0px!important;
        padding:0px!important;
    }
    .table-holder {
        border-collapse: collapse;
        border-spacing: 0;
        padding: 10px;
        width: 100%;
        margin-bottom: 10px;
        border: 1px solid #eee;
    }
    table{
        margin: 0px;
        border: none;
    }
    td{
        border: none;
    }
    .pages a:hover {
        text-decoration: none!important;
    } 
    #main {
        float:none!important;
        margin:0 auto!important;
        text-align: center!important;
    }
    .textwidget {
        text-align: center!important;
    }
    .custom-search {
        border-radius: none!important;
    }
    .records{cursor: pointer;}
    .pagination a {
        margin: 4px;
    }
    span.current_page {
        margin: 3px;
        border-bottom: 1px solid #c5c5c5;
    }
    .site-main{
        width:100% !important;
        max-width:1200px;
    }
    .tablediv{display:table;}
    .tablediv .innerdiv{display:table-cell;}
    .align-right{
        text-align: right;
    }
    .align-center{
        text-align: center;
    }
    .content-size{
        font-size: 14px;
    }
</style>

<?php if (is_front_page()) {
    $class = 'homepage-image';
} ?>
	<main id="main" class="site-main <?php echo $class; ?>" role="main">




		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php clean_journal_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>
            
            <?php //get_template_part( 'content', 'page' ); ?>
		<?php /* while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php 
				/** 
				 * clean_journal_comment_section hook
				 *
				 * @hooked clean_journal_get_comment_section - 10
				 */
			/*	do_action( 'clean_journal_comment_section' ); */
			//die(get_page_link(40));
			?>

		<?php //endwhile; // end of the loop. ?>

		<?php
			$servername = "localhost";
			$username   = "qhqnpwmy_info_autodocg";
			$password   = "4DZF%{6hvDQD";
			$dbname     = "qhqnpwmy_info_autodocg";
                        
                        $base_url      = $_SERVER['HTTP_HOST'];
			$pdf_url       = $base_url.'/'.'wp-content/pdf/';

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			     die("Connection failed: " . $conn->connect_error);
			} 
				$sql           = "SELECT * FROM wp_form";
				$result        = $conn->query($sql); 
				$item_per_page = "10"; 
				$total_pages   = ceil($result->num_rows/$item_per_page);
				//die('----'.$result->num_rows);
				$uri            = $_SERVER["REQUEST_URI"];
				$urlArray 		= explode('/', $uri);
                                //print_r($_SERVER['REQUEST_URI']);die;
				$current_page   = $urlArray[2];
				if($urlArray[2]=="")
				{
					$current_page  = 1;
				}
				$current_page = (int)$current_page;
				$next_page    = $current_page + 1;
				$prev_page    = $current_page - 1;
				
				if($current_page>$total_pages){
					//unset($urlArray[4]);
					//$string = implode('/',$urlArray);
					exit();
					//wp_redirect("/");
					//echo '<script>window.location.href="'+$_SERVER['HTTP_HOST'].$string+'"</script>';
					//wp_redirect($_SERVER['HTTP_HOST'].$string);
				}
				$limit         = ($current_page - 1)*$item_per_page;
				$sql_limit     = "SELECT * FROM wp_form LIMIT $limit,$item_per_page"; //$limit,$item_per_page";
				$result_limit  = $conn->query($sql_limit); 
			?>
			<div style="overflow-x:auto;">


			<?php if ($result_limit->num_rows > 0) { $i = 0; ?>
			    <?php while($row = $result_limit->fetch_assoc()) { $i++; ?>
                             <div class="table-holder">
                              <table>
                                  <tr >
                                    <td width="420" id="record_<?php echo $row['id'];?>"><?php echo '<b>'.$row['document_number'].'</b>'?></td>
                                    <td id="record_<?php echo $row['id'];?>"><b><?php echo $row['document_name']?></b></td>
                                    <td class="align-right" id="record_<?php echo $row['id'];?>"><?php echo 'Authority : '.$row['authority_name']?></td>
                                </tr>
                                <tr class="content-size">
                                    <td style="text-align: justify;" colspan="3"  id="record_<?php echo $row['id'];?>">
                                        <?php echo $row['subject_english']; ?><br>
                                        <?php echo $row['synopsis_english']?>
                                    </td>
                                    
                                </tr>
                                <tr >
                        
                                    <td ><?php echo $row['relevant_number']?></td>
                                    <td class="align-center"></td>
                                    <td class="align-right" >
                                        <?php if($row['upload_form']!=""){?>
                                        <a href="/download_file.php?file_name=<?php echo $row['upload_form'];?>">
                                            
                                                <button class="innerdiv">Download</button>
                                          
                                        </a><?php }?>
                                        <a href="<?php echo '/edit_record.php?id='.$row['id'];?>"> 
                                            <button class="innerdiv">View</button>
                                        </a>
                                    </td>
			        </tr>
                              </table>
                             </div>
			   <?php  } ?>
			<?php } else { ?>
			     <tr class="records">
			     <td colspan="5" style="text-align:center;"><?php echo "No Records Found"?></td></tr>
			<?php }
			?>
                        <div class="pagination">
                            <?php 
                            $count = 9;
                            $startPage = max(1, $current_page - $count);
                            $endPage = min( $total_pages, $current_page + $count);
                            echo "<a href='?page=1'>".'First'."</a> "; // Goto 1st page  

                            for ($i=$startPage; $i<=$endPage; $i++) { 
                                if($current_page == $i){
                                    echo "<span class='current_page'>".$i."</span>"; 
                                }else{
                                    echo "<a href='?page=".$i."'>".$i."</a> "; 
                                }
                            }; 
                            echo "<a href='?page=".$total_pages."'>".'Last'."</a> "; // Goto last page

                            //if ($result_limit->num_rows > 0) { ?>
                                            <?php /* ?><tr><th style="text-align:center" colspan="5"><?php if($current_page!="1"){ ?><a href="<?php echo $prev_page; ?>">Prev</a><?php } ?>&nbsp;&nbsp;<?php if($current_page!=$total_pages){?><a href="<?php echo $next_page;?>">Next</a><?php } ?></th></tr><?php */?>
                            <?php //} ?>
                        </div>
		
			</div>
			<?php
			$conn->close();
		?>  
            
            
            
	</main><!-- #main -->

<?php get_sidebar(); ?>
        <script src="/jquery.min.js"></script>
<?php get_footer(); ?>

        <script>
	   /*Function for search textbox keyup*/
		$(document).on('keyup','#search_record',function(){
			$.ajax({
			    url:"/get_search.php", 
			    method:'POST',
			    data : { keyword : this.value},
			    success:function(data) {
			      $(".records").remove();
			      var data = JSON.parse(data);
			      var html = '';
			      if(data.length>0){
			      	var number = 1;
			      	for(var k=0;k<=data.length;k++){
			      		if(data.hasOwnProperty(k)){
			      			html += "<tr class='records'><td class='data-records' id='"+data[k]['id']+"'>"+number+"</td><td class='data-records' id='"+data[k]['id']+"'>"+data[k]['document_number']+"</td><td class='data-records' id='"+data[k]['id']+"'>"+data[k]['document_date']+"</td><td class='data-records' id='"+data[k]['id']+"'>"+data[k]['authority_name']+"</td><td style='text-align: justify;' class='data-records' id='"+data[k]['id']+"'>"+data[k]['subject_english']+"</td>";   
			      			if(data[k]['upload_form'] == null){
			      				html += "<td>No Document</td></tr>";
			      			}
			      			else{
			      				html += "<td><a href='/download_file.php?file_name="+data[k]['upload_form']+"'><div class='tablediv'><span class='innerdiv'>Download</span></div></a></td></tr>";
			      			}
			      			number++;
			      		}
			      	}
			      }
			      else{
			      	html += "<tr class='records'><td colspan='5' style='text-align:center;'>No Records found for this search</td></tr>";
			      }
			      $("#heading_record").after(html);
			    }
			});
		});
		/*Function for table record row on click*/
		$(document).on('click','.detail-record',function(){
			var record_row_id    = this.id;
			var id_array         = record_row_id.split('_');
			var record_id        = id_array['1'];
			window.location.href =window.location.origin+'/edit_record.php?id='+record_id;
		});
	</script>