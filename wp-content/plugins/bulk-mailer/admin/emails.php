<?php
        $section =  $_GET['section'];
        if ($section){
?>
<!-- email-view section -->
<div class="wrap">
<link rel="stylesheet" href="https://Cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php
                global $wpdb;

                extract($_POST);
                extract($_GET);

		        switch($do){ 
		        
                        // Delete Contact
                        case 'delete':

                                $id = (int) $_GET['id'];
                                
                        if($id){
                                $sql = "DELETE FROM `{$wpdb->prefix}mailer_emails` WHERE `id` = $id";
                                if($wpdb->query($sql))
                                $success = 'Record id #'.$id.' removed successfully.';
                                else    
                                $error = 'Some error occurred. Please try again in some time.';
                                }
                        else   
                                $error = 'Invalid ID, please provide a correct numeric value in id.';
                        break;
                         
                       // Save Contact      
                        case 'Save Contact':

                                $created = date('Y-m-d H:i:s', time());
                                $list_id = (int) $_GET['lid'];
                                $name = $wpdb->_real_escape($name);
                                $email = $wpdb->_real_escape($email);
                                $phone_number = (int) $phone_number;   
                                $country = $wpdb->_real_escape($country);
                                $city = $wpdb->_real_escape($city);  
                                $address = $wpdb->_real_escape($address);                                 
                                $zip_code = (int) $zip_code;
                        	$id = (int) $id;

                        $sql = "INSERT INTO `{$wpdb->prefix}mailer_emails`
					(`list_id`,`name`,`email`,
					        `address`,`zip_code`,`created`)
						        VALUES
                                                                ('$list_id','$name','$email',
						                        '$phone_number','$country','$city',
						                                '$address','$zip_code','$created')";
			if($wpdb->query($sql))
				$success = '1 Record saved successfully.';
																
			else    $error = 'Some error occurred. Please try again in some time.';
																
			break;
			
                        // Update Contact
			case 'Update Contact':
                                $updated = date('Y-m-d H:i:s', time());        
				$name = $wpdb->_real_escape($name);
				$email = $wpdb->_real_escape($email);
				$phone_number = (int) $phone_number;
			        $country = $wpdb->_real_escape($country);
				$city = $wpdb->_real_escape($city);  
				$address = $wpdb->_real_escape($address);                                 
				$zip_code = (int) $zip_code;
				$id = (int) $id;
				
                       $sql = "UPDATE `{$wpdb->prefix}mailer_emails`
						SET `name` = '$name',
						        `email` = '$email',
						        `phone_number` = '$phone_number',
						        `country` = '$country',
						        `city` = '$city',
						        `address` = '$address',
						        `zip_code` = '$zip_code',
						        `updated` = '$updated'
				                                WHERE `id` = '$id'";
		        if($wpdb->query($sql))
				$success = 'Record id #'.$id.' updated successfully.';
			else    $error = 'Some error occurred. Please try again in some time.';
			break;
			} 
        ?>
        <?php
					
                        if($success){
        ?>
  		        <div class="alert alert-success" ><?php echo $success ?></div>
  	<?php
			}
	?>
  	<?php
			if($error){
	?>
  		        <div class="alert alert-danger" ><?php echo $error ?></div>
  	<?php
		        }
	?>
  
                <!-- Buttons -->

        <a class="pull-right cursor-pointer button form2" onclick="one();"> Import CSV </a>
        <a class="pull-right cursor-pointer button formlabel1" onclick="relabel();"> Create New Contact </a> 

                 <!-- Heading -->        
  	<h1 class="wp-heading-inline" >Manage Contact -> 
        <?php 	
                        $getId = $_GET['lid'];
                        $sql = "SELECT `list` FROM `{$wpdb->prefix}mailer_lists` WHERE `id` = '$getId'";
                        $res = $wpdb->get_results($sql); foreach($res as $r) echo $r->list; 
	?>
  	
	</h1>

                <!-- Form Create New Contact -->

<form id="add-q-form" action="" style="display:none;"  class="opened"  method="POST" onsubmit="return check();" >
        <a href="?page=bulk-emails"><i style="cursor:pointer;" class="fa fa-arrow-left"><strong> back </strong></i></a>  
                <br>
    		<br>
        <table class="form-table" style="border: 4px solid rgb(163, 183, 69);" id="add-email" >
	        <tr style="background-color:#FFF">
        	        <td colspan="2">
          		        <h3 style="margin:0;" id="formlabel" >Add New Contact </h3>
        		</td>
        		<td  colspan="2">
          			<button id="close-btn" class="pull-right"  style="background-color:#ffff;border:none;" onclick="$('#add-q-form').hide();">x</button>
        		</td>
     		</tr>

      		<tr style="background-color:#fefefe" >
        	        <td colspan="2">
          			<input type="text" placeholder="Enter Name" name="name" class="assess-text" />
        	        </td>
                <td colspan="2">
          			<input type="email" placeholder="email" name="email" class="assess-text" />
        	        </td>
      		</tr>

      		<tr style="background-color:#fefefe">
        		<td colspan="2">
          			<input type="number" placeholder="Enter Phone Number" name="phone_number" class="assess-text" />
        		</td>
        		<td colspan="2">
          		        <select name="country" class="assess-text" >
            			<option value="" >country
            			</option>
            			<option value="US" >US
            			</option>
            			<option value="SA" >SA
            			</option>
          			</select>                                
        		</td> 
      		</tr>

      		<tr style="background-color:#fefefe" >
        		<td colspan="2">
          			<input type="text" placeholder="city" name="city" class="assess-text" />
        	        </td>
        		<td colspan="2"> 
          			<input type="number" placeholder="zipcode" name="zip_code" class="assess-text" />
        	        </td>
                </tr>
                
      	        <tr style="background-color:#FFF">
        		<td colspan="4">
          			<textarea class="assess-text" rows="2" cols="20" name="address" placeholder="Address">
          			</textarea> 
        		</td>
      	        </tr>
   
    		<tr style="background-color:#FFF">
     			<td colspan="4" >
        			<input type="submit" value="Save Contact" name="do" class="button button-primary" />
        		        <input type="hidden" name="id" class="skippable"  />
      			</td>
    		</tr>
    	</table>
</form>

		<!-- include import-csv file -->

        <?php require_once(PLUGIN_PATH_BM.'/admin/emails/import-csv.php') ?>   
           
   <!-- Table to show fetched results -->   
          
        <table class="table table-top-left" id="manage-lists-1">
 	        <tbody>
    		<?php

                        $getId = (isset($_GET['lid'])) ? $_GET['lid'] : 0;
                        if($getId > 0){
                                $start = $_GET['offset']? (int) $_GET['offset']: 0;
				$sql = "SELECT * FROM `{$wpdb->prefix}mailer_emails` WHERE list_id = $getId LIMIT $start, 5"; 
				$results = $wpdb->get_results($sql);
			}
			if($results){
		?> 
    		        <thead>
                                <tr class="table-headings" >
        			        <th>#ID</th>
        			        <th>name</th>             
        			        <th>Email Address</th>
        			        <th>Phone Number</th>
        			        <th>Country</th>             
        			        <th>City</th>
        			        <th>Zip_Code</th>
        			        <th>Address</th>
        			        <th>Last Updated</th>             
        			        <th>Edit</th>
     				</tr>
    			</thead>            
    				
		<?php   $i = 0;
			$q = [];
			foreach($results as $r){
			        echo '<tr class="'.($i%2? 'even': 'odd').'" >';
			        echo '<td class="text-center" ><b>#'.$r->id.'</b></td>';
			        echo '<td> '.$r->name.'</td>';
			        echo '<td> '.$r->email.'</td>';
			        echo '<td> '.$r->phone_number.'</td>';
			        echo '<td> '.$r->country.'</td>';
			        echo '<td> '.$r->city.'</td>';
			        echo '<td> '.$r->zip_code.'</td>';
			        echo '<td> '.$r->address.'</td>';                        
			if(!empty($r->updated)){
			        echo '<td>'.($r->updated? date('d M Y (h:i A)', strtotime($r->updated)):'-').'</td>'; }
			else{
			        echo '<td>'.date('d M Y (h:i A)', strtotime($r->created)).'</td>';
			}
		?>
			        <td class="one">
		                <a href="javascript:void(0);" onclick="return populate('<?php echo $r->id ?>','<?php echo $r->name ?>');" ><i class="fa fa-edit" ></i></a> 
      		<?php 
		                echo  '<a href="?page=bulk-emails&section=emailview&do=delete&lid='.$getId.'&id='.$r->id.'" onclick="return confirm(\'Are you sure to delete contact id #'.$r->id.'? This action cant be undone.\');s" ><i class="fa fa-trash" aria-hidden="true"></i</a>
			        </td>';
			        echo '</tr>';
			        $i++;
			        $q[$r->id] = $r;        
			}
	        ?>      
		</tbody>
	</table>
			        <!-- pagination -->     
		<div class="pagination">
  		<?php   
                        $sql = "SELECT COUNT(`id`) as `total_records` FROM `{$wpdb->prefix}mailer_emails`";
			$results = $wpdb->get_results($sql);
			$total_records = $results[0]->total_records;
			$total_pages = ceil($total_records/5);
			if($total_pages > 1){
				echo '<ul>';
			for($i = 1; $i <= $total_pages; $i++){
			        $cls = $start/5 == ($i -1)? 'active': 'inactive';
			        echo '<li class="'.$cls.'" ><a href="?page=bulk-emails&section=emailview&lid='.$getId.'&offset='.(5 * ($i - 1)).'" >'.$i.'</a></li>';
			        }
				echo '</ul>';   
			}
		?>
		</div>
		<?php    } 
			else {
		                $error = 'No record exits !';
		?>
                <div class="update-nag" style="width:97%;" >
      	        <?php echo $error ?>
                </div> 
                <?php
	         } 
	        ?>
		
	<!-- Javascript Functions -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
	</script>
        <script>
     // Check on Submit
                function check(){
   		        $('#add-q-form [name]').removeClass('has-errors');
    			var has_errors = false;
    			$('#add-q-form [name]').each(function(i, e){
      			        if(!$(e).hasClass('skippable')){
        			        if(! $(e).val().trim() && !has_errors){         
         		                        $(e).addClass('has-errors').focus();
          			        has_errors = true;
                                        }
                                      }
                                    }
                                  );
    			return !has_errors;
  		}
    // Call on Create New Form 
  		function relabel(){
    		        $('#formlabel').text('Add New Contact');
    			$('[name=do]').val('Save Contact');
    			$('[name=name]').val('');
    			$('[name=email]').val('');
    			$('[name=phone_number]').val('');
    			$('[name=country]').val('');
   			$('[name=zip_code]').val('');
			$('[name=city]').val('');
			$('[name=address]').val('');
			if ($('.opened').is(':visible')) 
                                $('.opened').slideUp();
			$('#add-q-form').slideDown();
  		}
  // Call on Import CSV
		function one(){
 			$('[name=do]').val('Import Csv');
    			if ($('.opened').is(':visible')) 
			        $('.opened').slideUp();
			$('#add-q-csv').slideDown();
  			}
  
        </script>
        <script>var questions = $.parseJSON('<?php echo json_encode($q) ?>');
        </script>
        <script>
// On Edit Contacts
                function populate(id,name){
    			if ($('.opened').is(':visible')) 
      			$('.opened').slideUp();
    			$('#add-q-form').slideDown();
    			$('#formlabel').text('Edit Contact ID #'+id);
    			$('[name=do]').val('Update Contact');
    			$('[name=id]').val(id);
    			$.each(questions[id], function(key, value) {
      				var ctrl = $('[name='+key+']');
      				switch(ctrl.prop("type")) {
        			case "radio": case "checkbox":
         			ctrl.each(function() {
            			        if($(this).attr('value') == value) $(this).attr("checked",value);
          					}
                                              );
          			break;
       				default:
          			ctrl.val(value);
      					}
    				     }
         			 );
    			return false;
  			}
        </script>
        <script> 
                $(document).ready(function(){   
                        $("#flip").click(function(){
                                 $("#panel").slideToggle("slow");
                                }
                        );
                $('.table-headings').find('th').css('background-color', $('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
                $('.one').find('a').css('color', $('#adminmenu .update-plugins').css('background-color'))
                $('.form-table').find('h3').css('color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
                $('.form-table').css('border-color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
                $('.table-top-left tr.odd').css('background-color', $('#adminmenu').css('background-color'))
  
                }
                );
        </script>
</div>
        <?php
        }
        else{
        ?>
        <!-- list-view section -->
<div class="wrap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
  <?php
                global $wpdb;
                extract($_POST);
                extract($_GET);
                
                        switch($do){
                                case 'delete':
                                        if($id){
		                                if($wpdb->query($sql))
							$success = 'Record id #'.$id.' removed successfully.';
						else  	$error = 'Some error occurred. Please try again in some time.';
					}else   $error = 'Invalid ID, please provide a correct numeric value in id.';
					break;

				case 'Save List':
					$created = date('Y-m-d H:i:s', time());
					$list = $wpdb->_real_escape($list);
					$id = (int) $id;
					$sql = "INSERT INTO `{$wpdb->prefix}mailer_lists`(`list`,`created`)
								VALUES ('$list','$created')";
					if($wpdb->query($sql)){
						$success = '1 Record saved successfully.';
					}
					else  {  $error = 'Some error occurred. Please try again in some time.';
					}
					break;

				case 'Update List':
				        $updated = date('Y-m-d H:i:s', time());
					$list = $wpdb->_real_escape($list);
					$id = (int) $id;
					$sql = "UPDATE `{$wpdb->prefix}mailer_lists`
					SET `list` = '$list',
					        `updated` = '$updated'                                       
					WHERE `id` = '$id'";
					if($wpdb->query($sql))
						$success = 'Record id #'.$id.' updated successfully.';
					else    $error = 'Some error occurred. Please try again in some time.';
					break;
				} 
	?>
        <?php
	if($success){
	?>
        <div class="alert alert-success" >
   	<?php echo $success ?>
        </div>
        <?php
	}
	?>
        <?php
	if($error){
	?>
        <div class="alert alert-danger" >
         <?php echo $error ?>
        </div>
         <?php
        }
        ?>
        <a class="pull-right cursor-pointer button formlabel1" onclick="$('#add-list').slideToggle(); relabelForm(); "> Create New List
        </a>
        <h1 class="wp-heading-inline" >Manage Lists 
        </h1>
  <!-- list form -->
<form id="add-q-list" action="?page=bulk-emails" class="opened"  method="POST" onsubmit="return checkIfEmpty();" >
    <br>
    <br>
        <table class="form-table" style="display:none;border: 4px solid rgb(163, 183, 69);" id="add-list" >
	        <tr style="background-color:#FFF;">
        	        <td colspan="2" >
          		        <h3 style="margin:0; color:rgb(163, 183, 69);" id="formlabel" >Add New list
          			</h3>
        		</td>
        		<td  colspan="2">
          		<button id="close-btn" class="pull-right"  style="background-color:#ffff;border:none;" onclick="$('#add-q-form').hide();">x
          		</button>
        		</td>
      		</tr>
     		<tr style="background-color:#fefefe;" >
			<td colspan="4">
          			<input type="text" placeholder="list title" name="list" class="assess-text" />
       			</td>
      		</tr>
      		<tr style="background-color:#FFF">
        		<td colspan="4" >
          			<input type="submit" value="Save List" name="do" class="button button-primary" />
          			<input type="hidden" name="id" class="skippable"  />
        		</td>
      		</tr>
        </table>
</form>
  <br>
  <table class="table table-top-left" id="manage-lists-1" >
       
    <tbody>
      <?php  
                        $start = $_GET['offset']? (int) $_GET['offset']: 0;
                        $sql = "SELECT * FROM `{$wpdb->prefix}mailer_lists` LIMIT $start, 10 ";
                        $results = $wpdb->get_results($sql);
                        if($results){
		?> 
    		       <thead>
      	                        <tr class="table-headings" >
        				<th>#ID</th>
        				<th>List</th>             
        				<th>Last Update</th>
        				<th>-</th>
     			 </tr>
    		        </thead>     
    			<?php 	
                        $i = 0;
                        $q = [];
                        foreach($results as $r){
                                echo '<tr class="'.($i%2? 'even': 'odd').'" >';
                                echo '<td class="text-center" ><b>'.$r->id.'</b></td>';
		                echo '<td class="one"><a href="?page=bulk-emails&section=emailview&lid='.$r->id.'">'.$r->list.'</a></td>';
		        if(!empty($r->updated)){
	                       echo '<td>'.($r->updated? date('d M Y (h:i A)', strtotime($r->updated)):'-').'</td>'; }
		        else{
			       echo '<td>'.date('d M Y (h:i A)', strtotime($r->created)).'</td>';
		        }
			                echo '<td class="one">
		                        <a href="javascript:void(0);" onclick="return populateEdit('.$r->id.');" ><i class="fa fa-edit" ></i></a>
		                        <a href="?page=bulk-emails&do=delete&id='.$r->id.'" onclick="return confirm(\'Are you sure to delete list id #'.$r->id.'? This action cant be undone.\');" ><i class="fa fa-trash" aria-hidden="true"></i</a>
		                        </td>';
		                        echo '</tr>';
		                        $i++;
					$q[$r->id] = $r;
		        }
					if(! $results){
					echo '<tr class="odd" ><td colspan="10" >No records found!</td></tr>';
									}
				?>      
    </tbody>
  </table>
  <!-- pagination for list view -->
  <div class="pagination">
    <?php
					$sql = "SELECT COUNT(`id`) as `total_records` FROM `{$wpdb->prefix}mailer_lists`";
					$results = $wpdb->get_results($sql);
					$total_records = $results[0]->total_records;
					$total_pages = ceil($total_records/10);
					if($total_pages > 1){
					        echo '<ul>';
					       for($i = 1; $i <= $total_pages; $i++){
					                $cls = $start/10 == ($i -1)? 'active': 'inactive';
							echo '<li class="'.$cls.'" ><a href="?page=bulk-emails&offset='.(10 * ($i - 1)).'" >'.$i.'</a></li>';
						}
					echo '</ul>';
																}
		?>
  </div>
  <?php    } 
			else {
		                $error = 'No record exits !';
		?>
                <div class="update-nag" style="width:97%;" >
      	        <?php echo $error ?>
                </div> 
                <?php
	         } 
	        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
	</script>
	<script>
    // call on sumbit
                function checkIfEmpty(){
      		       $('#add-q-form [name]').removeClass('has-errors');
    			var has_errors = false;
    			$('#add-q-form [name]').each(function(i, e){
      			        if(!$(e).hasClass('skippable')){
        			        if(! $(e).val().trim() && !has_errors){         
         		                        $(e).addClass('has-errors').focus();
          			        has_errors = true;
                                        }
                                      }
                                    }
                                  );
    			return !has_errors;
    		}

   	        function relabelForm(){
      //  $('.formlabel1').text('Cancel') ;
      			$('#formlabel').text('Add New List');
      			$('[name=do]').val('Save List');
      			$('[name=list]').val('');
      			$('#add-q-list').slideDown();
    		}
	</script>
	<script> var questions = $.parseJSON('<?php echo json_encode($q) ?>');
	</script>
	<script>
                function populateEdit(id){
      			$('#add-list').slideDown();
      			$('#formlabel').text('Edit List ID #'+id);
      			$('[name=do]').val('Update List');
      			$('[name=id]').val(id);
      			$.each(questions[id], function(key, value) {
      				var ctrl = $('[name='+key+']');
      				switch(ctrl.prop("type")) {
        			case "radio": case "checkbox":
         			ctrl.esach(function() {
            			        if($(this).attr('value') == value) $(this).attr("checked",value);
          					}
                                              );
          			break;
       				default:
          			ctrl.val(value);
      					}
    				     }
         			 );
    			return false;
                }
        </script>
        <script> 
                $(document).ready(function(){   
                        $("#flip").click(function(){
                                 $("#panel").slideToggle("slow");
                                }
                        );
                $('.table-headings').find('th').css('background-color', $('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
                $('.one').find('a').css('color', $('#adminmenu .update-plugins').css('background-color'))
                $('.form-table').find('h3').css('color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
                $('.form-table').css('border-color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
                $('.table-top-left tr.odd').css('background-color', $('#adminmenu').css('background-color'))
  
                }
                );
        </script>
</div>
<?php
}
?>
