<?php
global $current_section;
$current_section='configuration';

require_once '../../init.php';

// Required files
require_once MAD_PATH . '/www/cp/auth.php';

require_once MAD_PATH . '/functions/adminredirect.php';

require_once MAD_PATH . '/www/cp/restricted.php';

require_once MAD_PATH . '/www/cp/admin_functions.php';


if (!check_permission('configuration', $user_detail['user_id'])){
exit;
}

global $current_action;
$current_action='edit';

if (isset($_POST['update'])){
if (do_edit('channel', $_POST, $_GET['id'])){
global $edited;
$edited=1;
MAD_Admin_Redirect::redirect('edit_channel.php?edited=1&id='.$_GET['id'].'');	
}
else
{
global $edited;
$edited=2;
}
}

if ($edited!=2){
$editdata=get_channel_detail($_GET['id']);
}


require_once MAD_PATH . '/www/cp/templates/header.tpl.php';



?>

<div id="content">		
		
		<div id="contentHeader">
			<h1>Edit Channel</h1>
		</div> <!-- #contentHeader -->	
		
		<div class="container">
			
				
			<div class="grid-24">
			
           <?php if ($edited==1){?>	
            <div class="box plain"><div class="notify notify-success"><h3>Successfully Updated</h3><p>Your Channel has successfully been updated. <a href="channel_management.php">Back to Channel List</a></p></div> <!-- .notify --></div>
            <?php } else if ($edited==2){ ?>
            <div class="box plain"><div class="notify notify-error"><h3>Error</h3><p><?php echo $errormessage; ?></p></div> <!-- .notify --></div>
            <?php } ?>
            
                    
				<form method="post" id="crudchannel" name="crudchannel" class="form uniformForm">
                <input type="hidden" name="update" value="1" />				
					
				<?php require_once MAD_PATH . '/www/cp/templates/forms/crud.channel.tpl.php';
				
				?>	
                    
                    
                     <div class="actions">						
									<button type="submit" class="btn btn-quaternary btn-large">Edit Channel</button>
								</div> <!-- .actions -->
										
					
					
					
					</form>
					
				</div> <!-- .grid -->
			
			
		</div> <!-- .container -->
		
	</div> <!-- #content -->
<?php
require_once MAD_PATH . '/www/cp/templates/footer.tpl.php';
?>