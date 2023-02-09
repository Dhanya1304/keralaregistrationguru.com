<?php
/**
 * General settings administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

/** WordPress Translation Install API */
require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );

include( ABSPATH . 'wp-admin/admin-header.php' );
?>
<link rel="stylesheet"  src="/bootstrap.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="/jquery.min.js"></script>
<script src="/jquery-ui.js"></script>
<script src="/bootstrap.min.js"></script>


<style>
	/*.site-main{
		width:100% !important;
		max-width:1200px;
	}*/
body{	
	min-height:100%;
	height:auto;
	overflow-x:hidden;
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

/*tr td:first-child{
	padding-left:30px !important;
}*/

.tablediv{display:table;}
.tablediv .innerdiv{display:table-cell;}
table{
	border: 0px;
}
.table-view table{
	width:100%;

}
.table-view table tr{
width:100%;

}
.table-view table tr td{
	max-width:60px;
	white-space:wrap;
}
.table-responsive{
	border: 1px solid #dddddd;
}
/*.synopsis-width{
	display:table;
	width:200px;
}*/


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
        width:135px;
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
		width : 67px;
    }
    .advanced-search-section h3{
        text-align: left;
        font-size: 20px;
    }
    #submit_home_search {
        font-size: 16px;
    }
	.search-title{
		width:50px;
	}


</style>
	<div class="wrap table-view">
		<h1>Data Listing</h1>
		<?php
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
				$sql           = "SELECT * FROM wp_form";
				$result        = $conn->query($sql); 
				$item_per_page = "10";
				$total_pages   = ceil($result->num_rows/$item_per_page);
				//die('----'.$result->num_rows);
				$uri            = $_SERVER["REQUEST_URI"];
				$urlArray 		= explode('/', $uri);
				$current_page   = $urlArray[4];
				if($urlArray[4]=="")
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
				$sql_limit     = "SELECT * FROM wp_form LIMIT $limit,$item_per_page";
				$result_limit  = $conn->query($sql_limit); 
			?>
			<div class="table-responsive">
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
								<th class="search-title">Refined Search</th>
								<td><input type="text" name="document_number" id="document_number" placeholder="Document No." /></td>
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
				<div style="display:none" id="msg_box"></div>
			  <table id="show_record" style="width:100%">
			  	<?php // if ($result_limit->num_rows > 0) { ?>
			  		<!--<tr><?php /* ?><th style="text-align:center" colspan="3">Records 5 of <?php echo $result->num_rows; ?></th><?php */ ?><th style="text-align:right" colspan="8"><input type="text" class="search-field custom-search" placeholder="Search Records" id="search_record"></th></tr>-->
			    <?php //} ?>

			    <tr id="heading_record">
<!--			      <th>Sl no:</th>-->
			      <th>Document Number</th>
                              <!--<th>Any other Relevant Number</th>
			      <th>Date of Document</th>-->
			      <th>Authority Name</th>
			      <th>Document Name</th>
                              <!--<th>Category</th>
			      <th>Act & Section/Rule & Number</th>
                              <th>Sub Section/Sub Rule</th>-->
			      <th class="synopsis-width">Synopsis in English</th>
			      <th>Subject in English</th>
<!--			      <th>Typed Text</th>
			      <th>Orginal material</th>-->
                  <th>Actions</th>
			    </tr>
			<?php if ($result->num_rows > 0) { $i = 0; ?>
			    <?php while($row = $result->fetch_assoc()) { $i++; ?>
			         <tr class="records" id="current_record_<?php echo $row['id'];?>">
<!--			         	<td class="data-records" id="record_<?php //echo $row['id'];?>"><?php //echo $i;?></td>-->
			         	<td class="data-records" id="record_<?php echo $row['id'];?>"><?php echo $row['document_number']?></td>
                                        <!--<td class="data-records" id="record_<?php //echo $row['id'];?>"><?php //echo $row['relevant_number']?></td>
                                        <td class="data-records" id="record_<?php //echo $row['id'];?>"><?php //echo $row['document_date']?></td>-->
                                        <td class="data-records" id="record_<?php echo $row['id'];?>"><?php echo $row['authority_name']?></td>
                                        <td class="data-records" id="record_<?php echo $row['id'];?>"><?php echo $row['document_name']?></td>
                                        <!--<td class="data-records" id="record_<?php //echo $row['id'];?>"><?php //echo $row['category_name']?></td>
                                        <td class="data-records" id="record_<?php //echo $row['id'];?>"><?php //echo $row['relevant_section']?></td>
                                        <td class="data-records" id="record_<?php //echo $row['id'];?>"><?php //echo $row['sub_section']?></td>-->

										<td class="data-records synopsis-width" id="record_<?php echo $row['id'];?>"><?php echo $row['synopsis_english']?></td>
                                        <td style="text-align: justify;" class="data-records subject-width" id="record_<?php echo $row['id'];?>"><?php echo $row['subject_english']?></td>
<!--                        <td class="data-records" id="record_<?php //echo $row['id'];?>"><?php //echo $row['typed_text']?></td>
                        <td class="data-records" id="record_<?php //echo $row['id'];?>"><?php //echo $row['orginal_material']?></td>-->
                        <td><?php if($row['upload_form']!=""){?><a href="/download_file.php?file_name=<?php echo $row['upload_form'];?>">
                        <div class="tablediv">
                            <?php /* ?><span class="innerdiv"><img src="<?php echo get_template_directory_uri(); ?>/images/adobe-pdf-icon.svg" width="23" height="25" /></span><?php */ ?>
                            <span class="innerdiv">Download</span></a><?php } else { echo 'No Document';}?>
							<a href="javascript:void(0);"><span id="remove_data" data-id ="<?php echo $row['id'] ?>">Delete</span></a>
							</td>
                        </span>
			         </tr>

					
					



			   <?php  } ?>
			<?php } else { ?>
			     <tr class="records">
			     <td colspan="5" style="text-align:center;"><?php echo "No Records Found"?></td></tr>
			<?php }
			?>

			<!--<div id="deleteData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
								<h4 class="modal-title" id="myModalLabel">Modal title</h4>
							</div>
							<div class="modal-body">
								Are you sure to Delete the record?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" id="confirm_delete" class="btn btn-primary">Delete</button>
							</div>
							</div>
						</div>
					</div>-->
                        
			<?php if ($result->num_rows > 0) { ?>
			  		<?php /* ?><tr><th style="text-align:center" colspan="5"><?php if($current_page!="1"){ ?><a href="<?php echo $prev_page; ?>">Prev</a><?php } ?>&nbsp;&nbsp;<?php if($current_page!=$total_pages){?><a href="<?php echo $next_page;?>">Next</a><?php } ?></th></tr><?php */?>
			<?php } ?>
			</table>
			</div>
			<?php
			$conn->close();
		?>  
	</div><!-- #main -->
	
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
	</style>
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
					$(".records").remove();
                    var data = JSON.parse(data,replacer);
			      	var html = '';
                    if(data.length>0){
			      	    for(var k=0;k<=data.length;k++){
			      		    if(data.hasOwnProperty(k)){
								html += "<tr class='records' id='current_record_"+data[k]['id']+"'>";   
								//html += "<td class='data-records' id='"+data[k]['id']+"'>"+number+"</td>";
								html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['document_number']+"</td>";
								// html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['relevant_number']+"</td>";
								// html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['document_date']+"</td>";
								html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['authority_name']+"</td>";
								//html += "<td style='text-align: justify;' class='data-records' id='"+data[k]['id']+"'>"+data[k]['subject_english']+"</td>";
								html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['document_name']+"</td>";
								// html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['relevant_section']+"</td>";
								// html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['sub_section']+"</td>";
								// html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['category_name']+"</td>";
								html += "<td class='data-records content-width' id='record_"+data[k]['id']+"'>"+data[k]['synopsis_english']+"</td>";
								html += "<td class='data-records content-width' id='record_"+data[k]['id']+"'>"+data[k]['subject_english']+"</td>";
								//html += "<td class='data-records' id='"+data[k]['id']+"'>"+data[k]['typed_text']+"</td>";
								//html += "<td class='data-records' id='"+data[k]['id']+"'>"+data[k]['orginal_material']+"</td>";
								
								if(data[k]['upload_form'] == null){
									html += "<td>No Document</td>";

								}
								else{
									html += "<td><a href='/download_file.php?file_name="+data[k]['upload_form']+"'><div class='tablediv'><span class='innerdiv'>Download</span></div></a>";
								}
								html += '<a href="javascript:void(0);"><span id="remove_data" data-id ="'+data[k]['id']+'">Delete</span></a></td>';
								html += '</tr>';

                            }
                        }
                    }else{
                        html += "<tr class='records'><td colspan='5' style='text-align:center;'>No Records found for this search</td></tr>";
                    }
                    $('#heading_record').after(html);
                }
            });
        });


		function replacer(key,value)
        {
            if (value === null) return ''
            return value
        }














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
			      			html += "<tr class='records' id='current_record_"+data[k]['id']+"'>";   
			      			//html += "<td class='data-records' id='"+data[k]['id']+"'>"+number+"</td>";
                                                html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['document_number']+"</td>";
                                                // html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['relevant_number']+"</td>";
                                                // html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['document_date']+"</td>";
                                                html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['authority_name']+"</td>";
                                                //html += "<td style='text-align: justify;' class='data-records' id='"+data[k]['id']+"'>"+data[k]['subject_english']+"</td>";
                                                html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['document_name']+"</td>";
                                                // html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['relevant_section']+"</td>";
                                                // html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['sub_section']+"</td>";
                                                // html += "<td class='data-records' id='record_"+data[k]['id']+"'>"+data[k]['category_name']+"</td>";
                                                html += "<td class='data-records content-width' id='record_"+data[k]['id']+"'>"+data[k]['synopsis_english']+"</td>";
                                                html += "<td class='data-records content-width' id='record_"+data[k]['id']+"'>"+data[k]['subject_english']+"</td>";
                                                //html += "<td class='data-records' id='"+data[k]['id']+"'>"+data[k]['typed_text']+"</td>";
                                                //html += "<td class='data-records' id='"+data[k]['id']+"'>"+data[k]['orginal_material']+"</td>";
                                                
                                                if(data[k]['upload_form'] == null){
													html += "<td>No Document</td>";

												}
												else{
													html += "<td><a href='/download_file.php?file_name="+data[k]['upload_form']+"'><div class='tablediv'><span class='innerdiv'>Download</span></div></a>";
												}
												html += '<a href="javascript:void(0);"><span id="remove_data" data-id ="'+data[k]['id']+'">Delete</span></a></td>';
												html += '</tr>';
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

		// function deleteRecord(record_id){
		// 	alert('test-'+record_id);
		// 	$('#confirm_delete').click({"record_id": record_id}, deleteRecordConfirmed);   
		// }

		// function deleteRecordConfirmed(params){
		// 	$.ajax({
		// 	    url:"/delete_data.php", 
		// 	    method:'POST',
		// 	    data : { keyword : params.data.record_id},
		// 	    success:function(response) {
		// 			console.log(response);
		// 		}
		// 	});
		// }

		$(document).on('click','#remove_data',function(){
			var current_id = $(this).attr("data-id");
			$.ajax({
			    url:"/delete_data.php", 
			    method:'POST',
			    data : { keyword : current_id},
			    success:function(data) {
					$('#current_record_'+current_id).remove();
					$('html, body').animate({scrollTop: '0px'}, 0);
					$('#msg_box').html('Record deleted successfully').fadeIn('fast').delay(2000).fadeOut('fast');
				}
			});
		});
		/*Function for table record row on click*/
		$(document).on('click','.data-records',function(){
			var admin_url 		 = '<?php echo admin_url() ?>';
			var record_row_id    = this.id;
			var id_array         = record_row_id.split('_');
			var record_id        = id_array['1'];
			window.location.href = admin_url+'edit_form.php?id='+record_id;
		});
	</script>

<?php include( ABSPATH . 'wp-admin/admin-footer.php' ); ?>
