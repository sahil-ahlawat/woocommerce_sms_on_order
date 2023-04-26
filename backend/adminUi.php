<?php

/**
 * sawo_Ui : Setting up wp admin UI
 *
 * @return void
 */
function sawo_Ui(){
if(isset($_REQUEST['wooordersmstemplate']) && !empty($_REQUEST['wooordersmstemplate'])){
  update_option( "sawo_woocomerce_order_sms_template", $_REQUEST['wooordersmstemplate'], false );
}
$template = get_option("sawo_woocomerce_order_sms_template");
?>
  <h1>Update template</h1>
  <h2>Use #ordernumber to show order number. #name to show name.</h2>
  <!-- Form to handle the upload - The enctype value here is very important -->
  <form  method="post" >
    <textarea placeholder="Add template here." name="wooordersmstemplate" rows="4" cols="50"><?php echo $template; ?></textarea>
    <?php
	submit_button('Save') ?>
  </form>
  <?php

}