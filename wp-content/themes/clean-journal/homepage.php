<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Catch Themes
 * @subpackage Clean Journal
 * @since Clean Journal 0.1 
 */

/*
Template Name: Homepage Template
*/

get_header(); ?>

<?php
    $servername     = "localhost";
    $username       = "qhqnpwmy_info_autodocg";
    $password       = "4DZF%{6hvDQD";
    $dbname         = "qhqnpwmy_info_autodocg";
                
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
        $current_page   = $urlArray[3];
        if($urlArray[3]=="")
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
            /*echo '<script>window.location.href="'+$_SERVER['HTTP_HOST'].$string+'"</script>';*/
            //wp_redirect($_SERVER['HTTP_HOST'].$string);
        }
        $limit         = ($current_page - 1)*$item_per_page;
        $sql_limit     = "SELECT * FROM wp_form LIMIT $limit,$item_per_page"; //$limit,$item_per_page";
        $result_limit  = $conn->query($sql_limit); 


        $get_document_number = "SELECT id,document_number FROM wp_form GROUP BY document_number"; //$limit,$item_per_page";
        $result_document    = $conn->query($get_document_number); 

        $get_relevant_number = "SELECT id,relevant_number FROM wp_form GROUP BY relevant_number"; //$limit,$item_per_page";
        $result_relnumber    = $conn->query($get_relevant_number); 

        $get_authority_name  = "SELECT id,authority_name FROM wp_form GROUP BY authority_name"; //$limit,$item_per_page";
        $result_authority    = $conn->query($get_authority_name);
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    .widget-more-link{
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-size: 12px;
    }
    .advanced-search-section table, .advanced-search-section td, .advanced-search-section th {
        border: 1px solid #ddd;
    }
    .advanced-search-section table {
        border-collapse: collapse;
        width:100%;
    }
    .refined-search-table{
        width:300px !important;
        min-width:100%;
        max-width:100%;
    }
    .refined-search-table tbody{
        width:100% !important;
        min-width:100%;
        max-width:100%;   
    }
    .refined-search-table tr{
        width:100%;
    }
    .refined-search-table tr td{
        min-width:50px;
    }
    .refined-search-table tr td input[type="text"]{
        width:160px;
    }
    .refined-search-table tr td input#from_document_date{
        width:100px;
    }
    .refined-search-table tr td input#to_document_date{
        width:100px;
    }
    .refined-search-table tr th{
        text-align:center;
        vertical-align: middle;
    }
    .refined-search-table .submit-btn-home{
        vertical-align: middle;
    }
    .advanced-search-section h3{
        text-align: left;
        font-size: 20px;
    }
    #submit_home_search {
        font-size: 16px;
    }
</style>

	<main id="main" class="site-main" role="main">
            
            <div class="advanced-search-section">
                <!--<h3>Refined Search</h3>-->
                <table class="refined-search-table">
                    <tbody>
                        <!--<tr>
                            
                            <th rowspan="2">Document Number</th>
                            <th rowspan="2">Document Name</th>
                            <th rowspan="2">Any other Number</th>
                            <th rowspan="2">Authority Name</th>
                            <th rowspan="2">Subject</th>
                            <th colspan="2">Date</th>
                            
                        </tr>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            
                        </tr>-->
                        <tr>
                            <th>Refined Search</th>
                            <td><input type="text" name="document_number" id="document_number" placeholder="Document Number" /></td>
                            <td><input type="text" name="document_name" id="document_name" placeholder="Document Name" /></td>
                            <!--<td><input type="text" name="relevant_number" id="relevant_number" placeholder="Any other Number" /></td>-->
                            <td><input type="text" name="authority_name" id="authority_name" placeholder="Authority Name"/></td>
                            <td><span id="subject_keyword"><input type="text" id="subject_english" name="subject_english" placeholder="Subject" /></span></td>
                            <td><input type="text" id="from_document_date" name="from_document_date" placeholder="From date" /></td>
                            <td><input type="text" id="to_document_date" name="to_document_date" placeholder="To date" /></td>
                            <td rowspan="3" class="submit-btn-home"><button id="submit_home_search">Submit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="featured-content">
                <div class="one-third start">
                	<h3>Articles</h3>
                        <?php dynamic_sidebar('homepage-articles'); ?> 
                        <a class="widget-more-link" href="/article">View More...</a>
                </div>
                <div class="one-third mid">
                	<h3>Forum</h3>
                        <?php dynamic_sidebar('homepage-forum'); ?> 
                        <a class="widget-more-link" href="/community">View More...</a>
                </div>
                <div class="one-third end">
                	<h3>News</h3>
                        <?php dynamic_sidebar('homepage-news'); ?> 
                        <a class="widget-more-link" href="/recent-news">View More...</a>
                </div>               
            </div>
            
            
		<?php #get_template_part( 'content', 'page' ); ?>
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

		
			<div style="overflow-x:auto;" id="record_holder_home">


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
                            echo "<a href='".site_url()."?page=1'>".'First'."</a> "; // Goto 1st page  

                            for ($i=$startPage; $i<=$endPage; $i++) { 
                                if($current_page == $i){
                                    echo "<span class='current_page'>".$i."</span>"; 
                                }else{
                                    echo "<a href='".site_url()."?page=".$i."'>".$i."</a> "; 
                                }
                            }; 
                            echo "<a href='".site_url()."?page=".$total_pages."'>".'Last'."</a> "; // Goto last page

                            //if ($result_limit->num_rows > 0) { ?>
                                            <?php /* ?><tr><th style="text-align:center" colspan="5"><?php if($current_page!="1"){ ?><a href="<?php echo $prev_page; ?>">Prev</a><?php } ?>&nbsp;&nbsp;<?php if($current_page!=$total_pages){?><a href="<?php echo $next_page;?>">Next</a><?php } ?></th></tr><?php */?>
                            <?php //} ?>
                        </div>
		
			</div>
			<?php
			$conn->close();
		?>  
	</main><!-- #main -->
	<script src="/jquery.min.js"></script>
    <script src="/jquery-ui.js"></script>
	<?php get_footer(); ?>
	
	<script>

    var __document_number  = '';
    var __document_name    = '';
    // var __relevant_number  = '';
    var __authority_name   = '';
    var __subject_english  = '';
    var __from_doc_date    = '';
    var __to_doc_date      = '';

        $(document).ready(function($) {
            $("#from_document_date").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1800:'+(new Date).getFullYear()
            });
            $("#to_document_date").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1800:'+(new Date).getFullYear()
            });
        
        });

        $(document).on('click','#submit_home_search',function(){
            
            __document_number = $.trim($('#document_number').val());
            __document_name   = $.trim($('#document_name').val());
            // __relevant_number = $.trim($('#relevant_number').val());
            __authority_name  = $.trim($('#authority_name').val());
            __subject_english = $.trim($('#subject_english').val());
            __from_doc_date   = $.trim($('#from_document_date').val());
            __to_doc_date     = $.trim($('#to_document_date').val());
            
            //alert(__document_number+'--'+__relevant_number+'--'+__authority_name);
            $.ajax({
			    url:"/home_search.php", 
			    method:'POST',
			    data : {document_number : __document_number,document_name : __document_name,authority_name : __authority_name,subject_english : __subject_english,from_date : __from_doc_date,to_date : __to_doc_date,is_ajax:true},
			    success:function(data) {
                    var data = JSON.parse(data,replacer);
			        var html = '';
                    if(data.length>0){
			      	    for(var k=0;k<=data.length;k++){
			      		    if(data.hasOwnProperty(k)){
                                  
                                  html += '<div class="table-holder">';
                                  html += ' <table>';
                                  html += '     <tr>';
                                  html += '         <td width="420" id="record_'+data[k]['id']+'"><b>'+data[k]['document_number']+'</b></td>';
                                  html += '         <td id="record_'+data[k]['id']+'"><b>'+data[k]['document_name']+'</b></td>';
                                  html += '         <td class="align-right" id="record_'+data[k]['id']+'">Authority : '+data[k]['authority_name']+'</td>';
                                  html += '     </tr>';
                                  html += '     <tr class="content-size">';
                                  html += '         <td style="text-align: justify;" colspan="3"  id="record_'+data[k]['id']+'">';
                                  html += '         '+data[k]['subject_english']+'<br>'+data[k]['synopsis_english']+'';
                                  html += '         </td>';
                                  html += '     </tr>';
                                  html += '     <tr>';
                                  html += '         <td >'+data[k]['relevant_number']+'</td>';
                                  html += '         <td class="align-center"></td>';
                                  html += '         <td class="align-right" >';
                                  if(data[k]['upload_form']!=null){
                                  html += '         <a href="/download_file.php?file_name='+data[k]['upload_form']+'">';
                                  html += '             <button class="innerdiv">Download</button>';
                                  html += '         </a>';    
                                  }
                                  html += '         <a href="/edit_record.php?id='+data[k]['id']+'">';
                                  html += '             <button class="innerdiv">View</button>';
                                  html += '         </a>';
                                  html += '         </td>';
                                  html += '     </tr>';
                                  html += ' </table>';
                                  html += '</div>';

                            }
                        }
                    }else{
                        html += '<tr class="records">';
			            html += '<td colspan="5" style="text-align:center;">No Records Found</td></tr>';
                    }
                    $('#record_holder_home').html(html);
                }
            });
        });

        function replacer(key,value)
        {
            if (value === null) return ''
            return value
        }

		/*Function for table record row on click*/
		$(document).on('click','.detail-record',function(){
			var record_row_id    = this.id;
			var id_array         = record_row_id.split('_');
			var record_id        = id_array['1'];
			window.location.href =window.location.origin+'/edit_record.php?id='+record_id;
		});
	</script>