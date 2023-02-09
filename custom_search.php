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
/*
Template Name: custom search template
*/
require( "wp-load.php" ); 

get_header(); ?>
	<style>
	.site-main{
			width:100% !important;
			max-width:1200px;
	}
	th {
	    text-align: left !important;
	    font-size: 14px;
	    color: #333;
	}

	td{
		text-align:left !important;
		font-size:13px;
	}

	tr td:first-child{
		padding-left:30px !important;
	}

	.tablediv{display:table;}
	.tablediv .innerdiv{display:table-cell;}

	</style>

	<main id="main" class="site-main" role="main">
		<h2>Search Results</h2>
		<?php
			$keyword    = $_GET['search'];
			$servername = "localhost";
			$username   = "qhqnpwmy_info_autodocg";
			$password   = "4DZF%{6hvDQD";
			$dbname     = "qhqnpwmy_info_autodocg";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			 die("Connection failed: " . $conn->connect_error);
			} 
			//echo $_GET['keyword'];
			$sql           = "SELECT * FROM wp_form  WHERE document_name like '%".$keyword."%' OR relevant_section like '%".$keyword."%' OR synopsis_english like '%".$keyword."%' OR orginal_material like '%".$keyword."%' OR document_number like '%".$keyword."%' OR document_date like '%".$keyword."%' OR authority_name like '%".$keyword."%' OR subject_english like '%".$keyword."%' OR upload_form like '%".$keyword."%'";
			$result        = $conn->query($sql); 
			$record_array  = array();
			while($row = $result->fetch_assoc()) {
				array_push($record_array,$row);
			}
			//echo json_encode($record_array);
			?>
			<div style="overflow-x:auto;">
			  <table id="show_record">
			  	<tbody>
				  	<tr id="heading_record">
<!--				      <th>Sl no:</th>-->
                                      <th>Document Number</th>
				      <th>Relevant Number</th>
                                      <th>Document Date</th>
                                      <th>Authority Name</th>
                                      <th>Document Name</th>
<!--				      <th>Relevant Section</th>-->
				      <th>Synopsis in English</th>
				      <th>Subject English</th>
<!--				      <th>Typed Text</th>
				      <th>Orginal material</th>-->
	                  <th>Actions</th>
				    </tr>
				    <?php 
				    	if(!empty($record_array)){ $i = 0;
				    	foreach ($record_array as $key => $value) { $i++; ?>

							<tr class="records">
<!--					         	<td class="data-records" id="record_<?php //echo $value['id'];?>"><?php //echo $i; ?></td>-->
					         	<td class="data-records" id="record_<?php echo $value['id'];?>"><?php echo $value['document_number'];?></td>
                                                        <td class="data-records" id="record_<?php echo $value['id'];?>"><?php echo $value['relevant_number']?></td>
		                        <td class="data-records" id="record_<?php echo $value['id'];?>"><?php echo $value['document_date']; ?></td>
		                        <td class="data-records" id="record_<?php echo $value['id'];?>"><?php echo $value['authority_name']; ?></td>

		                        <td class="data-records" id="record_<?php echo $value['id'];?>"><?php echo $value['document_name']; ?></td>
<!--		                        <td class="data-records" id="record_<?php //echo $value['id'];?>"><?php //echo $value['relevant_section']; ?></td>-->
		                        <td class="data-records" id="record_<?php echo $value['id'];?>"><?php echo $value['synopsis_english']; ?></td>
                                        <?php if(strlen($value['subject_english']) > 100){
                                            $subject_english = substr($value['subject_english'],0,100).'...';
                                        }else{
                                            $subject_english = $value['subject_english'];
                                        } ?>
		                        <td style="text-align: justify;" class="data-records" id="record_<?php echo $value['id'];?>"><?php echo $subject_english; ?></td>
<!--		                        <td class="data-records" id="record_<?php //echo $value['id'];?>"><?php //echo $value['typed_text']; ?></td>
		                        <td class="data-records" id="record_<?php //echo $value['id'];?>"><?php //echo $value['orginal_material']; ?></td>-->
		                        <td><?php if($value['upload_form']!="") { ?>
		                        	<a href="/download_file.php?file_name=<?php echo $value['upload_form']; ?>">
				                        <div class="tablediv">
				                            <span class="innerdiv">Download</span>
				                        </div>
			                        </a>
			                        <?php } else { ?>
			                        	 <div class="tablediv">
				                            <span class="innerdiv">No Document</span>
				                        </div>
			                        <?php } ?>
		                        </td>
					        </tr>
					<?php } } else { echo "<tr class='records'><td colspan='11' class='no-data'>No Records found for this search</td></tr>"; } ?>
			   	</tbody>
			  </table>
			</div>

	</main><!-- #main -->
	<script src="/jquery.min.js"></script>
	<style>
	  .hentry{margin-bottom:0px!important;padding:0px!important;}
	  table {
	    border-collapse: collapse;
	    border-spacing: 0;
	    width: 100%;
	    border: 1px solid #ddd;
	  }
	  td {
	    border: none;
	    text-align: center;
	    padding: 8px;
	   }
	   th {text-align: center;border: none;padding: 8px;}
	   tr:nth-child(even){background-color: #f2f2f2}
	   .pages a:hover{text-decoration: none!important;}
	   #main{float:none!important;margin:0 auto!important;text-align: center!important;}
	   .textwidget{text-align: center!important;}
	   .custom-search{border-radius: none!important;}
	   .records{cursor: pointer;}
	   .no-data{text-align: center!important;}
	</style>

<?php get_footer(); ?>


	<script>
		/*Function for table record row on click*/
		$(document).on('click','.data-records',function(){
			var record_row_id    = this.id;
			var id_array         = record_row_id.split('_');
			var record_id        = id_array['1'];
			window.location.href =window.location.origin+'/edit_record.php?id='+record_id;
		});
	</script>