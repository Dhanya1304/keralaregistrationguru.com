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
<style>
	.site-main{
		width:100% !important;
		max-width:1200px;
	}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<div class="wrap">
		<?php /* while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php 
				/** 
				 * clean_journal_comment_section hook
				 *
				 * @hooked clean_journal_get_comment_section - 10
				 */
			/*	do_action( 'clean_journal_comment_section' ); */

			?>

		<?php //endwhile; // end of the loop. ?>

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
			$document_id   = $_GET['id'];
			$sql_record    = "SELECT * FROM wp_form WHERE id = $document_id";
			$result_data   = $conn->query($sql_record); 
			$row_data	   = $result_data->fetch_assoc();
			$base_url      = $_SERVER['HTTP_HOST'];
			$pdf_url       = $base_url.'/'.'wp-content/pdf/';
			?>
			<?php
				$conn->close();
			?>  
			<script src="../jquery.min.js"></script>
                        <script src="../jquery-ui.js"></script>
			<div class="record-form">
				<h3>Edit Form</h3>
				<form action="../document_update.php?id=<?php echo $row_data['id'];?>&&file=<?php if($row_data['upload_form']!=""){ echo $row_data['upload_form']; }?>" id="document_form" method="POST" enctype= "multipart/form-data"
				>
				<div id="show_message" style="display:none;"></div>
				  <div>
				    <label class="desc" id="title1" for="Field1">
				      Document Number
				    </label>
				    <div>
				      <input id="document_number" name="document-number" type="text" spellcheck="false" tabindex="3" placeholder="Document Number" value="<?php echo $row_data['document_number'];?>"> 
				   </div>
				  </div>
                                
                                  <div>
				    <label class="desc" id="title4" for="Field4">	
						Any other Relevant Number
				    </label>
				  
				    <div>
				      <input id="rel_num" name="rel-num" type="text" spellcheck="false" tabindex="3" placeholder="Relevant Number" value="<?php echo $row_data['relevant_number'];?>">
				    </div>
				  </div>
				    
				  <div>
				    <label class="desc" id="title3" for="Field3">
				      Date of Document
				    </label>
				    <div>
				      <input id="document_date" name="document-date" type="text" spellcheck="false" tabindex="3" placeholder="Document Date" value="<?php echo $row_data['document_date'];?>"> 
				   </div>
				  </div>
				    
				  <div>
				    <label class="desc" id="title4" for="Field4">
				      Authority Name
				    </label>
				  
				    <div>
				      <input id="auth_name" name="auth-name" type="text" spellcheck="false" tabindex="3" placeholder="Authority Name" value="<?php echo $row_data['authority_name'];?>">
				    </div>
				  </div> 


				  <div>
				    <label class="desc" id="title4" for="Field4">
				      Document Name
				    </label>
				  
				    <div>
				      <input id="doc_name" name="doc-name" type="text" spellcheck="false" tabindex="3" placeholder="Document Name" value="<?php echo $row_data['document_name'];?>">
				    </div>
				  </div>
                                
                                  <div>
				    <label class="desc" id="title4" for="Field4">	
						Category
				    </label>
				  
				    <div>
				      <input id="category_name" name="category-name" type="text" spellcheck="false" tabindex="3" placeholder="Category" value="<?php echo $row_data['category_name'];?>">
				    </div>
				  </div>

				  <div>
				    <label class="desc" id="title4" for="Field4">	
						Act & Section/Rule & Number
				    </label>
				  
				    <div>
				      <input id="rel_sec" name="rel-sec" type="text" spellcheck="false" tabindex="3" placeholder="Relevant Section" value="<?php echo $row_data['relevant_section'];?>">
				    </div>
				  </div>
                                
                                  <div>
				    <label class="desc" id="title4" for="Field4">	
						Sub Section/Sub Rule
				    </label>
				  
				    <div>
				      <input id="rel_sub_sec" name="rel-sub-sec" type="text" spellcheck="false" tabindex="3" placeholder="Sub Section" value="<?php echo $row_data['sub_section'];?>">
				    </div>
				  </div>
                                
				  <div>
				    <label class="desc" id="title4" for="Field4">	
						Synopsis in English
				    </label>
				  
				    <div>
                                        <textarea id="synp_english" name="synp-english" placeholder="Synopsis in english" value=""><?php echo $row_data['synopsis_english'];?></textarea>
				    </div>
				  </div> 


				  <div>
				    <label class="desc" id="title5" for="Field4">
				      Subject in English
				    </label>
				  
				    <div>
				     <textarea id="sub_english" name="sub-english"><?php echo $row_data['subject_english'];?></textarea>
				    </div>
				  </div>

				  <div>
				    <label class="desc" id="title4" for="Field4">	
						Typed text in English or Malayalam, as the case may be.
				    </label>
				  
				    <div>
				      <textarea id="typed_text_english" name="typed-text-english"><?php echo $row_data['typed_text'];?></textarea>
				    </div>
				  </div> 

				  <div>
				    <label class="desc" id="title4" for="Field4">	
						Original document is available with
				    </label>
				  
				    <div>
                                        <textarea id="org_material" name="org-material" placeholder="Original material" value=""><?php echo $row_data['orginal_material'];?></textarea>
				    </div>
				  </div> 

				  <div>
				    <label class="desc" id="title5" for="Field4">
				      Uploaded Document 
				    </label>
				    <div class="file-info"> 
				      <?php if($row_data['upload_form']!=""){ echo $row_data['upload_form']; } else { echo 'No document yet! upload a new one!'; };?>
				    </div>
				  </div>

				  <div>
				    <label class="desc" id="title5" for="Field4">
				      New Document 
				    </label>
				    <div>
				     <input id="doc_pdf" name="pdf_doc" type="file">
				    </div>
				  </div>


				  <div>
				    <div>
				  	<input id="saveForm" name="saveForm" class="save-form" type="button" value="Submit" onclick="submitDocForm()">
				    </div>
				  </div>
				  
				</form>
			</div>
			<div class="doc-preview">
				<?php if($row_data['upload_form']!=""){?>
					<iframe id="frame_document" src="http://docs.google.com/gview?url=<?php echo $pdf_url.$row_data['upload_form'];?>&embedded=true" frameborder="0" height="100%"></iframe>
				<?php } else { ?>
					<?php echo "<h4>No Document found</h4>"; ?>
				<?php } ?>
			</div>
	</div><!-- #div -->
	<style>
	   #main{float:none!important;margin:0 auto!important;text-align: center!important;}
	   .textwidget{text-align: center!important;}
	   .record-form{width:50%;float:left;border:1px solid #e2e2e2;padding: 20px 25px;border-radius:5px;}
	   .doc-preview{width:50%;float:left;border:none;padding: 20px 25px;}
	   input#doc_pdf {
    font-size: 13px;
    float: left;
    padding-top: 10px;
	color:#696969;
}
	   
		* {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		}
		#saveForm {
			background-color:#090;
			border: none;
			color: white;
			padding: 10px 26px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 14px;
			float:right;
		}
		form header {
			margin: 0 0 20px 0; 
		}
		form header div {
			font-size: 90%;
			color: #999;
		}
		form header h2 {
			margin: 0 0 5px 0;
		}
		form > div {
			clear: both;
			overflow: hidden;
			padding: 1px;
			margin: 0 0 10px 0;
		}
		form > div > fieldset > div > div {
			margin: 0 0 5px 0;
		}
		form > div > label,
		legend {
			width: 25%;
			float: left;
			padding-right: 10px;
			font-size:13px;
			padding-top:10px;
		}
		form > div > div,
		form > div > fieldset > div {
			width: 75%;
			float: right;
		}
		form > div > fieldset label {
			font-size: 90%;
		}
		fieldset {
			border: 0;
			padding: 0;
		}

		input[type=text],
		input[type=email],
		input[type=url],
		input[type=password],
		textarea {
			width: 100%;
			border-top: 1px solid #ccc;
			border-left: 1px solid #ccc;
			border-right: 1px solid #eee;
			border-bottom: 1px solid #eee;
			color:#696969;
			font-size:13px;
		}
		
		.file-info {
			text-align: left;
			font-size: 13px;
			padding-top: 10px;
			color:#696969;
		}
		
		input[type=text],
		input[type=email],
		input[type=url],
		input[type=password] {
			width: 50%;
			font-size: 13px;
			float:left;
		}
		input[type=text]:focus,
		input[type=email]:focus,
		input[type=url]:focus,
		input[type=password]:focus,
		textarea:focus {
			outline: 0;
			border-color: #4697e4;
			font-size:13px;
			color:#696969;
		}
		
		h3{
			text-align:left;
		}

		@media (max-width: 600px) {
		form > div {
			margin: 0 0 15px 0; 
		}
		form > div > label,
		legend {
			width: 100%;
			float: none;
			margin: 0 0 5px 0;
		}
		form > div > div,
		form > div > fieldset > div {
			width: 100%;
			float: none;
		}
		input[type=text],
		input[type=email],
		input[type=url],
		input[type=password],
		textarea,
		select {
			width: 100%; 
			font-size: 13px;
		}
		}
		#show_message{
			background-color: #f2dede;
			border-color: #ebccd1;
			color: #a94442;
			padding-left:10px;
			font-size: 13px;
			width: 100%;
			text-align:center;
			padding: 5px;
			margin-bottom: 10px;
			border: 1px solid transparent;
			border-radius: 3px;
		}
		@media (min-width: 1200px) {
		form > div > label,
		legend {
			text-align: right;
			font-size:13px;
			padding-top:10px;
		}
		}
		
	</style>
	<script>
		function submitDocForm(){
			var document_number        = $('#document_number').val();
		    var document_date          = $('#document_date').val();
		    var auth_name              = $('#auth_name').val();
		    var sub_english            = $('#sub_english').val();
		    var doc_name               = $('#doc_name').val();
		    var rel_sec                = $('#rel_sec').val();
		    var synp_english           = $('#synp_english').val();
		    var typed_text_english     = $('#typed_text_english').val();
		    var org_material           = $('#org_material').val();
			var errorCount           = 0;
			var errorMessage         = '';
			$("#show_message").html('');
			if(document_number == '')
		    {
		        errorCount++;
		        errorMessage += 'Please enter document number <br />';
		    }
		    if(document_date == '')
		    {
		        errorCount++;
		        errorMessage += 'Please enter document date <br />';
		    }
		    if(auth_name == '')
		    {
		        errorCount++;
		        errorMessage += 'Please enter authority name <br />';
		    } 
		    if(doc_name == '')
		    {
		        errorCount++;
		        errorMessage += 'Please enter document name <br />';
		    }
		    if(rel_sec == '')
		    {
		        errorCount++;
		        errorMessage += 'Please enter relevant section <br />';
		    }
		    if(synp_english == '')
		    {
		        errorCount++;
		        errorMessage += 'Please enter synopsis english <br />';
		    }
		    if(typed_text_english == '')
		    {
		        errorCount++;
		        errorMessage += 'Please enter typed text <br />';
		    }
		    if(sub_english == '')
		    {
		        errorCount++;
		        errorMessage += 'Please enter subject english <br />';
		    }
		    if(org_material == '')
		    {
		        errorCount++;
		        errorMessage += 'Please enter orginal material <br />';
		    }
			var file = $('#doc_pdf').prop("files");
			if (typeof file !== 'undefined' && file.length > 0) {
			   var str  = file[0]['name'];
			   var rest = str.substring(0, str.lastIndexOf(".") + 1);
			   var last = str.substring(str.lastIndexOf(".") + 1, str.length);
			   var allowed_extensions = ["docx", "doc", "pdf"];
			   if(allowed_extensions.indexOf(last)<0)
			   {
			     errorCount++;
			     errorMessage += 'only pdf,doc,docx allowed! <br />';
			   }
			}
			if(errorCount == 0 )
			{
			  $("#show_message").css('display','none');
			  $("#document_form").submit();
			}
			else
			{
			  $("#show_message").css('display','block');
			  $("#show_message").css('background-color','#f2dede');
			  $("#show_message").css('border-color','#ebccd1');
			  $("#show_message").css('color','#a94442');
			  $('#show_message').prepend(errorMessage);
			}
		}
		$("document").ready(function(){
		$("#doc_pdf").change(function(e) {
		    var file = $('#doc_pdf').prop("files");
		    var str  = file[0]['name'];
		    var rest = str.substring(0, str.lastIndexOf(".") + 1);
		    var last = str.substring(str.lastIndexOf(".") + 1, str.length);
		    var allowed_extensions = ["docx", "doc", "pdf"];
		    if(allowed_extensions.indexOf(last)<0)
		    {
		       $("#show_message").css('display','block');
		       $("#show_message").css('background-color','#f2dede');
		       $("#show_message").css('border-color','#ebccd1');
		       $("#show_message").css('color','#a94442');
		       $('#show_message').prepend('only pdf,doc,docx allowed! <br />');
		    }
		    else
		    {
		       $("#show_message").css('display','none');
		       $('#show_message').html('');
		    }
		});
		var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		    sURLVariables = sPageURL.split('&'),
		    sParameterName,
		    i;
		  for (i = 0; i < sURLVariables.length; i++) {
		    sParameterName = sURLVariables[i].split('=');

		    if (sParameterName[0] === sParam) {
		        return sParameterName[1] === undefined ? true : sParameterName[1];
		    }
		  }
		};
		var url = getUrlParameter('mes');
		if(url=="succ")
		{
		  $("#show_message").css('display','block');
		  $("#show_message").css('background-color','#dff0d8');
		  $("#show_message").css('border-color','#d6e9c6');
		  $("#show_message").css('color','#3c763d');
		  $('#show_message').html('saved successfully');
		  setTimeout(function(){ $("#show_message").css('display','none');$('#show_message').html(''); }, 3000);
		}
		if(url=="err")
		{
		  $("#show_message").css('display','block');
		  $('#show_message').html('some error occured. try again');
		  setTimeout(function(){ $("#show_message").css('display','none');$('#show_message').html('');}, 3000);
		}
		});
		
		$(document).ready(function(){
                    $(".doc-preview").css('height',$(".record-form").css('height')); 
		});
                jQuery(document).ready(function($) {
                    $("#document_date").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        yearRange: '1800:'+(new Date).getFullYear()
                    });
                          
                });
	</script>

<?php include( ABSPATH . 'wp-admin/admin-footer.php' ); ?>

	