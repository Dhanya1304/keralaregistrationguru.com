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
require( "wp-load.php" ); 


get_header(); ?>
<style>
	.site-main{
		width:100% !important;
		max-width:820px;
	}
</style>
	<main id="main" class="site-main" role="main">
		<?php get_template_part( 'content', 'page' ); ?>
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
			//die($pdf_url.$row_data['upload_form']);
			?>
			<?php
				$conn->close();
			?>  
			<script src="../jquery.min.js"></script>
			<div id="divBlockEntirePage" style="display:none;">
				<iframe id="frame_document" src="http://docs.google.com/gview?url=<?php echo $pdf_url.$row_data['upload_form']; ?>&embedded=true" frameborder="0" height="100%"></iframe>
			</div>
			<div class="record-form">
				<h3 class="doc-title-head"><?php echo $row_data['document_name'];?></h3>


		<div class="divMyAddress">
            <b>Document Number:</b> <?php echo $row_data['document_number'];?><br/>
            <b>Authority Name:</b> <?php echo $row_data['authority_name'];?><br/>
            <b>Relevant Section:</b> <?php echo $row_data['relevant_section'];?><br/>
           
        </div>




		<div class="divReturnAddress">
            Document Date: <?php echo $row_data['document_date'];?><br/>
            <?php if($row_data['upload_form']!=""){ echo "<a href='#' id='show_preview'>".$row_data['upload_form']."</a>"; } else { echo 'No document!'; };?>
        </div>

        <div class="divSubject">
        	<p><?php echo $row_data['subject_english'];?></p>

        </div>

        <div class="divContents">
            <p><?php echo $row_data['synopsis_english'];?></p>
            <p><?php echo $row_data['typed_text'];?></p>
        </div>

        <div class="divAdios">
            Original document is available with<br/>
            <?php echo $row_data['orginal_material'];?> <br/>
        </div>

			</div>
			<?php /* ?><div class="doc-preview">
				<?php if($row_data['upload_form']!=""){?>
					<iframe id="frame_document" src="http://docs.google.com/gview?url=<?php echo $pdf_url.$row_data['upload_form'];?>&embedded=true" frameborder="0" height="100%"></iframe>
				<?php } else { ?>
					<?php echo "<h4>No Document found</h4>"; ?>
				<?php } ?>
			</div> <?php */ ?>
	</main><!-- #main -->
	<?php get_footer(); ?>
	<style>
	   #main{float:none!important;margin:0 auto!important;text-align: center!important;}
	   .textwidget{text-align: center!important;}
	   .record-form{width:100%;padding: 20px 25px;border-radius:5px;}
	   .doc-preview{width:50%;float:left;border:none;padding: 20px 25px;}
	   input#doc_pdf {font-size: 13px;float: left;padding-top: 10px;color:#696969;}
	   .doc-title-head{text-align: center;}
		#saveForm {background-color:#090;border: none;color: white;padding: 10px 26px;text-align: center;text-decoration: none;display: inline-block;font-size: 14px;float:right;}	
		td{width: 50%;padding: 10px 10px 10px 20px;font-size: 14px;}
		#divBlockEntirePage{position: fixed;width: 100%;height: 100%;background-color: rgba(255,255,255,0.75);top: 0;left: 0;z-index: 9999;}
	
                .divHeader {
                text-align: right;
                border: 1px solid;
            }
            .divReturnAddress {
                text-align: left;
                float: right;
				font-size:15px;
            }
			
	            .divMyAddress {
                text-align: left;
                float: left;
				font-size:15px;
            }
					
            .divSubject {
                clear: both;
                padding-top: 80px;
				text-align:left;
				font-size:14px;
            }
			
			.divContents{
				text-align:left;
				font-size:14px;
			}
            .divAdios {
                float: right;
                padding-top: 50px;
				text-align:right;
            }
    
    
    </style>
	<script>
		$(document).ready(function(){
		    //$('#divBlockEntirePage').show();
		    $("#show_preview").click(function(){
		    	$('#divBlockEntirePage').show();
		    });

		    $("#divBlockEntirePage").click(function(){
		    	$('#divBlockEntirePage').hide();
		    });
		});
		function submitDocForm(){
			var document_number        = $('#document_number').val();
			var document_date          = $('#document_date').val();
			var auth_name              = $('#auth_name').val();
			var sub_english            = $('#sub_english').val();
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
			if(sub_english == '')
			{
			    errorCount++;
			    errorMessage += 'Please enter subject english <br />';
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
	</script>
	