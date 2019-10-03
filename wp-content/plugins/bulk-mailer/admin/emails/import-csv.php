<?php
        
        global $wpdb;
        
        //require_once PLUGIN_PATH_BM.'/vendor/box/spout/src/Spout/Autoloader/autoload.php';
        require PLUGIN_PATH_BM.'/vendor/autoload.php';
        
        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
        use PhpOffice\PhpSpreadsheet\Writer\Xls;
        use PhpOffice\PhpSpreadsheet\IOFactory;
        
        
        //libxml_disable_entity_loader(false);
        
        if($_FILES['upload']['name']){
                if(!$_FILES['upload']['error']) {
                        
                        $file_id = media_handle_upload('upload',0 );
                        $filepath = get_attached_file($file_id);
                        
                        
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filepath);
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();
                        
                        $errors = [];
                        foreach($_POST as $key => $value){
			      switch($key){
                                		case 'name':
                                                        $value = (int) $value;   
                                                        if (!((int) $value == $value && (int)$value > 0))
                                                        $errors= "Please fill the validate integer in name";           
						break;
						
						case 'email':
                                                         $value = (int) $value;   
                                                        if (!((int) $value == $value && (int)$value > 0))
                                                         $errors= "Please fill the validate integer in email";   
						break;
				
						case 'phone':
						     $value = (int) $value;   
                                                        if (!((int) $value == $value && (int)$value > 0))
                                                        $errors= "Please fill the validate integer in phone";           
						       
						break;
				
						case 'country':
						     $value = (int) $value;   
                                                        if (!((int) $value == $value && (int)$value > 0))
                                                        $errors= "Please fill the validate integer in country";           
						        
						break;
				
						case 'zip_code':
						   $value = (int)$value; 
                                                        if (!((int) $value == $value && (int)$value > 0))
                                                        $errors= "Please fill the validate integer in zipcode";           
						       
						break;
				
						case 'city':
						    $value = (int)$value;  
                                                        if (!((int) $value == $value && (int)$value > 0))
                                                        $errors= "Please fill the validate integer in city";           
						break;
				
						case 'address':
						    $value = (int)$value; 
                                                        if (!((int) $value == $value && (int)$value > 0))
                                                      $errors= "Please fill the validate integer in address";           
						   
						break;
						
                                  }       
                                }
                       
                if($errors){
                        ?>
                        <div class="alert alert-danger" ><?php echo $errors ?></div>
                <?php
                          }    
                 else{          
                                $count=0;
	                        foreach($sheetData as $row) {
                                extract($_POST);
                
                                $count++;
                         
                                if($count!=1){  
                                                   
                                  $name = $row[$name-1] ? $row[$name-1] : "";            
                                  $email = $row[$email-1] ? $row[$email-1] : "";
                                  $phone_number = $row[$phone-1] ? $row[$phone-1] : "";             
                                  $country = $row[$country-1] ? $row[$country-1] : "";
                                  $city = $row[$city-1] ? $row[$city-1] : "";
                                  $zip_code = $row[$zip_code-1] ? $row[$zip_code-1] : "";
                                  $address = $row[$address-1] ? $row[$address-1] : "";
                                  $created = date('Y-m-d H:i:s', time());
                                  $list_id = (int) $_GET['lid'];
                                                   
                           
                     $sql = "INSERT INTO `{$wpdb->prefix}mailer_emails`(`list_id`,`name`,`email`,`phone_number`,`country`,`city`,`address`,`zip_code`,`created`)
                                   VALUES ('$list_id','$name','$email','$phone_number','$country','$city','$address','$zip_code','$created')"; 
                                   $wpdb->query($sql);
                                                                     
                            }        
                          }            
                        }                 
                        }
        }
?>

        <!-- Import Csv -->
       <form id="add-q-csv" action="" style="display:none;"  class="opened"  method="POST"  enctype="multipart/form-data" >
          <table class="form-table" style="border: 4px solid rgb(163, 183, 69);" id="add-csv" >
                        <tr style="background-color:#fefefe" >
                                <td colspan="4"><h3 style="margin:0;" id="formlabel" >Import New CSV</h3></td>
                                   <td  colspan="4"><button id="close-btn" class="pull-right"  style="background-color:#ffff;border:none;" onclick="impTemp();">x</button></td>
                                </tr>
                        <tr style="background-color:#fefefe" >
                                 <td colspan="8">
                                       <input name="upload" id="upload" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                                </td>
                                </tr>
                              <tr style="background-color:#fefefe" >
                                <td colspan="2">
                                 <input type="number" placeholder="Enter Name" name="name" class="assess-text" />       
                                </td> 
                                <td colspan="2">
                                 <input type="number" placeholder="Enter Email" name="email" class="assess-text" />                         
                                </td>
                                 <td colspan="2">
                                    <input type="number" placeholder="Enter Phone Number" name="phone" class="assess-text" />   
                                </td> 
                                <td colspan="2">
                                    <input type="number" placeholder="Enter Country" name="country" class="assess-text" />                                 
                                </td> 
                        </tr>
                      
                        <tr style="background-color:#fefefe" >
                                
                               
                                <td colspan="2">
                                   <input type="number" placeholder="Enter ZipCode" name="zip_code" class="assess-text" />   
                                </td> 
                                <td colspan="2">
                                   <input type="number" placeholder="Enter City" name="city" class="assess-text" />      
                                </td> 
                                <td colspan="2">
                                     <input type="number" placeholder="Enter Address" name="address" class="assess-text" />      
                                </td>
                                <td colspan="2">
                                         
                                </td>                      
                                        
                        </tr>
                        
                        <tr style="background-color:#FFF">
                                <td colspan="8" ><input type="submit" value="Import Csv" name="do" class="button button-primary" /><input type="hidden" name="id" class="skippable"  /></td>
                        </tr>
                        
                </table>
                </form>
