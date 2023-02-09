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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
#show_message{
  background-color: #f2dede;
  border-color: #ebccd1;
  color: #a94442;
  padding-left:10px;
  font-size: 16px;
  width: 500px;
  padding: 15px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 3px;
}

table tr{
  height:unset;
}
</style>
<script src="../jquery.min.js"></script>
<script src="../jquery-ui.js"></script>
<script>
    jQuery(document).ready(function($) {
        $("#document_date").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1800:'+(new Date).getFullYear()
        });
        
    });
  function submitDocForm(){
    var document_number        = $('#document_number').val();
    var document_date          = $('#document_date').val();
    var auth_name              = $('#auth_name').val();
    var sub_english            = $('#sub_english').val();
    var doc_name               = $('#doc_name').val();
    var rel_sec                = $('#rel_sec').val();
    var rel_sub_sec            = $('#rel_sub_sec').val();
    var category_name          = $('#category_name').val();
    var rel_num                = $('#rel_num').val();
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
    if(rel_sub_sec == '')
    {
        errorCount++;
        errorMessage += 'Please enter sub section <br />';
    }
    if(category_name == '')
    {
        errorCount++;
        errorMessage += 'Please enter category <br />';
    }
    if(rel_num == '')
    {
        errorCount++;
        errorMessage += 'Please enter relevant number <br />';
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
</script>
<div class="wrap">
<h1>Data Entry Form</h1>
  <form action="../document_upload.php" id="document_form" method="POST" enctype= "multipart/form-data"
  >
  <div id="show_message" style="display:none;"></div>
    <table class="form-table">
        <tbody>

          <tr>
            <th scope="row"><label for="document_number">Document Number</label></th>
            <td><input id="document_number" name="document-number" type="text" class="regular-text"></td>
          </tr>
          
          <tr>
            <th scope="row"><label for="rel_sec">Any other Relevant Number</label></th>
            <td><input id="rel_num" name="rel-num" type="text" class="regular-text"></td>
          </tr>

          <tr>
            <th scope="row"><label for="document_date">Date of Document</label></th>
            <td>
              <input id="document_date" name="document-date" type="text" class="regular-text">
            </td>
          </tr>

          <tr>
            <th scope="row"><label for="auth_name">Authority Name</label></th>
            <td><input id="auth_name" name="auth-name" type="text" class="regular-text"></td>
          </tr>

          <tr>
            <th scope="row"><label for="doc_name">Document Name</label></th>
            <td><input id="doc_name" name="doc-name" type="text" class="regular-text"></td>
          </tr>
          
          <tr>
            <th scope="row"><label for="rel_sec">Category</label></th>
            <td><input id="category_name" name="category-name" type="text" class="regular-text"></td>
          </tr>

          <tr>
            <th scope="row"><label for="rel_sec">Act & Section/Rule & Number</label></th>
            <td><input id="rel_sec" name="rel-sec" type="text" class="regular-text"></td>
          </tr>
          
          <tr>
            <th scope="row"><label for="rel_sec">Sub Section/Sub Rule</label></th>
            <td><input id="rel_sub_sec" name="rel-sub-sec" type="text" class="regular-text"></td>
          </tr>

          <tr>
            <th scope="row"><label for="synp_english">Synopsis in English</label></th>
            <td><textarea id="synp_english" name="synp-english" class="regular-text"></textarea></td>
          </tr>

          <tr>
            <th scope="row"><label for="sub_english">Subject in English</label></th>
            <td><textarea id="sub_english" name="sub-english" class="regular-text"></textarea></td>
          </tr>

          <tr>
            <th scope="row"><label for="typed_text_english">Typed text in English or Malayalam, as the case may be.</label></th>
            <td><textarea id="typed_text_english" name="typed-text-english" class="regular-text"></textarea></td>
          </tr>

          <tr>
            <th scope="row"><label for="org_material">Original document is available with</label></th>
            <td><textarea id="org_material" name="org-material" class="regular-text"></textarea></td>
          </tr>

          <tr>
            <th scope="row"><label for="doc_pdf">Document</label></th>
            <td><input id="doc_pdf" name="pdf_doc" type="file"></td>
          </tr>

  
        </tbody>
    </table>

    <p class="submit">
      <input type="button" name="saveForm" id="saveForm" class="button button-primary" value="Save Changes" onclick="submitDocForm()">
    </p>
    
  </form>
</div>
<?php include( ABSPATH . 'wp-admin/admin-footer.php' ); ?>
