<div class="wrap">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php
                
                global $wpdb;
               
                
                extract($_POST);
                extract($_GET);
              
                switch($do){   
                
                
                       case 'delete':
                              
                                $id = (int) $_GET['id'];
                                
                                 
                                if($id){
                                        $sql = "DELETE FROM `{$wpdb->prefix}mailer_aliases` WHERE `id` = $id";
                                        
                                        if($wpdb->query($sql))
                                                $success = 'Record id #'.$id.' removed successfully.';
                                        else    $error = 'Some error occurred. Please try again in some time.';
                                }else   $error = 'Invalid ID, please provide a correct numeric value in id.';
                        break;
                        
                        case 'Save Aliase':
                               
                                 $created = date('Y-m-d H:i:s', time());
                               //  $list_id = (int) $_GET['lid'];
                                 $title = $wpdb->_real_escape($title);
                                 $sender_name = $wpdb->_real_escape($sender_name);
                                 $sender_email = $wpdb->_real_escape($sender_email);
                                 $receiver_name = $wpdb->_real_escape($receiver_name);                                 
                                 $receiver_email = $wpdb->_real_escape($receiver_email);
                                 $smtp_host = $wpdb->_real_escape($smtp_host);
                                 $encryption = $wpdb->_real_escape($optradio);
                                 $smtp_user = $wpdb->_real_escape($smtp_user);  
                                 $smtp_password = $wpdb->_real_escape($smtp_password);  
                                 $smtp_auth = $wpdb->_real_escape($optradio);
                                 $smtp_port = $wpdb->_real_escape($smtp_port);
                                  
                                 $id = (int) $id;
                                
                                 $sql = "INSERT INTO `{$wpdb->prefix}mailer_aliases`(`title`,`sender_name`,`sender_email`,
                                 `receiver_name`,`receiver_email`,`smtp_host`,`encryption`,`smtp_user`,`smtp_password`,`smtp_auth`,`smtp_port`,`created`)
                                   VALUES ('$title','$sender_name','$sender_email','$receiver_name','$receiver_email','$smtp_host',
                                   '$encryption','$smtp_user','$smtp_password','$smtp_auth','$smtp_port','$created')";
                                
                                
                                if($wpdb->query($sql)){
                                        
   
                                        $success = '1 Record saved successfully.';
                                        }
                                        
                                else  {  $error = 'Some error occurred. Please try again in some time.';
                                }
                        break;


                        case 'Update Aliase':
                                  
                                 $updated = date('Y-m-d H:i:s', time());        
                                 $title = $wpdb->_real_escape($title);
                                 $sender_name = $wpdb->_real_escape($sender_name);
                                 $sender_email = $wpdb->_real_escape($sender_email);
                                 $receiver_name = $wpdb->_real_escape($receiver_name);                                 
                                 $receiver_email = $wpdb->_real_escape($receiver_email);
                                 $smtp_host = $wpdb->_real_escape($smtp_host);
                                 $encryption = $wpdb->_real_escape($optradio);
                                 $smtp_user = $wpdb->_real_escape($smtp_user);  
                                 $smtp_password = $wpdb->_real_escape($smtp_password);  
                                 $smtp_auth = $wpdb->_real_escape($optradio);
                                 $smtp_port = $wpdb->_real_escape($smtp_port);
                                 $id = (int) $id;
                                
                             
                                   $sql = "UPDATE `{$wpdb->prefix}mailer_aliases`
                                        SET `title` = '$title',
                                                  `sender_name` = '$sender_name',
                                                  `sender_email` = '$sender_email',
                                                  `receiver_name` = '$receiver_name',
                                                  `receiver_email` = '$receiver_email',
                                                  `smtp_host` = '$smtp_host',
                                                  `encryption` = '$encryption',
                                                  `smtp_user` = '$smtp_user',
                                                  `smtp_password` = '$smtp_password',
                                                  `smtp_auth` = '$smtp_auth',
                                                  `smtp_port` = '$smtp_port',
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
        
         <a class="pull-right cursor-pointer button formlabel1" onclick="newTemp();">Create New Aliases</a> 
         
         <h1 class="wp-heading-inline" >Manage Aliase</h1> 
                
               
        <!-- Create-template and view template-->     
        <form id="add-q-form" style="display:none;" class="opened" action="" method="POST" >
                <a href="?page=bulk-emails"> <i style="cursor:pointer;" class="fa fa-arrow-left"><strong> back </strong></a></i>  
                
                <br><br>
                <table class="form-table" style="border: 4px solid rgb(163, 183, 69);" id="add-template" > 
                <tr style="background-color:#FFF">
                         <td colspan="2 "><h3 style="margin:0;" id="formlabel" >Add New Aliases</h3></td>
                         <td  colspan="2"><button id="close-btn" class="pull-right"  style="background-color:#ffff;border:none;" onclick="$('#add-q-form').hide();">x</button></td>
        
                </tr>
                 <tr style="background-color:#fefefe" >
                         <td colspan="4"> 
                                <input type="text" placeholder="title" name="title" class="assess-text" />
         
                         </td>
                </tr>
                
                <tr style="background-color:#fefefe" >
                 <td colspan="4">
                                   
                                        <label> From :</label>
                                </td>
                        
                </tr>
               
                 <tr style="background-color:#fefefe" >
                                <td colspan="3">
                                        <input type="text" placeholder="Enter Name" name="sender_name" id="sender_name"  class="assess-text" />
                                </td>
                               <td colspan="1">
                                        <input type="email" placeholder="Enter email" name="sender_email" id="sender_email" class="assess-text" />
                                </td>
                                
                        </tr>
                  <tr style="background-color:#fefefe" >
                 <td colspan="4">
                                   
                                        <label> Reply To :</label>
                                </td>
                        
                </tr>
               
                <tr style="background-color:#fefefe" >
                                <td colspan="2">
                                        <input type="text" placeholder="Enter Name" name="receiver_name" id="receiver_name" class="assess-text" />
                                        
                                </td>
                               <td colspan="2">
                                        <input type="email" placeholder="Enter Email" name="receiver_email" id="receiver_email" class="assess-text" />
                                       
                                </td>
                                
                        </tr>
                 <tr style="background-color:#fefefe" >
                                <td colspan="4">
                                       
                                        <label><input type="checkbox" id="same" name="same" onchange= "addressFunction();">In case, Same as From</label>
                                </td>
                              
                                
                        </tr>
                 <tr style="background-color:#fefefe" >
                                <td colspan="2">
                                        <input type="text" placeholder="SMTP Host" name="smtp_host" class="assess-text" />
                                </td>
                                   <td colspan="2">
                                        <input type="number" placeholder="SMTP Port" name="smtp_port" class="assess-text" />
                                </td>
                              
                        </tr>   
                  
               
                <tr style="background-color:#fefefe" >
                                <td colspan="2">
                                        <input type="text" placeholder="SMTP User" name="smtp_user" class="assess-text" />
                                </td>
                               <td colspan="2">
                                        <input type="password" placeholder="SMTP Password" name="smtp_password" class="assess-text" />
                                </td>
                                
                        </tr>
                <tr style="background-color:#fefefe" >
                                <td colspan="2">
                                        <label>SMTP Auth:</label>            
                                        <label><input type="radio" value="1"name="optradio">Yes</label>
                                         <label><input type="radio" value="2"name="optradio">NO</label>
                                       
                                </td>
                            
                                <td colspan="2">
                                        <label>Type of Encryption:</label>            
                                        <label><input type="radio" value="1"name="optradio">None</label>
                                         <label><input type="radio" value="2" name="optradio">SSL/TLS</label>
                                         <label><input type="radio" value="3"  name="optradio">STARTTLS</label>
                                </td>
                                
                        </tr>
                
              
                <tr style="background-color:#FFF">
                                <td colspan="4" ><input type="submit" value="Save Aliase" name="do" class="button button-primary" /><input type="hidden" name="id" class="skippable"  /></td>
                </tr>
                        
                </table>
        </form>
      <!--  <form id="add-q-template" style="display:none;"  class="opened" action=""  method="POST"  enctype="multipart/form-data" >
                <table class="form-table" style="border: 4px solid rgb(163, 183, 69);" id="import-template" >
                      <tr style="background-color:#fefefe" >
                                <td colspan="2"><h3 style="margin:0;" id="formlabel" >Import New Template</h3></td>
                                   <td  colspan="2"><button id="close-btn" class="pull-right"  style="background-color:#ffff;border:none;" onclick="impTemp();">x</button></td>
                                </tr>
                        <tr style="background-color:#fefefe" >
                                 <td colspan="4">
                                       <input name="upload" id="upload" type="file"></td>
                             
                                </tr>
                                
                        <tr style="background-color:#FFF">
                                <td colspan="4" ><input type="submit" value="Import Template" name="do" class="button button-primary" /><input type="hidden" name="id" class="skippable"  /></td>
                        </tr>
                        
                </table>
        </form>  
      
        <div id="view-template" class="container opened form-table" style="width:97%;display:none;background-color:#ffffff;border: 4px solid rgb(163, 183, 69);padding:10px;">
        
        
       
         </div> -->
        <br>
               
      <!-- import-template -->
       
               
        <table class="table table-top-left" id="manage-lists-1">
        <thead>
           <tr class="table-headings" >
                 <th>#ID</th>
                 <th>Title</th>             
                 <th>Sender Name</th>
                 <th>Sender Email</th>
                 <th>Receiver Name</th>             
                 <th>Receiver Email</th>
                  <th>SMTP HOST</th>
                  <th>Encryption</th>
                  <th>SMTP User</th>
                  <th>SMTP Password</th>
                  <th>SMTP Auth</th>
                  <th>SMTP Port</th>
                  <th>Last Updated</th>             
                   <th>Edit</th>
                           
          </tr> 
        </thead>     
        <tbody>
        <?php            $start = $_GET['offset']? (int) $_GET['offset']: 0;
                      //  $sql = "SELECT * FROM `{$wpdb->prefix}mailer_lists` LIMIT $start, 10 ";
                        
                        $sqli = "SELECT * FROM `{$wpdb->prefix}mailer_aliases` LIMIT $start, 10"; 
                        $results = $wpdb->get_results($sqli);
              
                        $i = 0;
                        $q = [];
                        foreach($results as $r){
                                echo '<tr class="'.($i%2? 'even': 'odd').'">';
                                echo '<td class="text-center" ><b>'.$r->id.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->title.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->sender_name.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->sender_email.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->receiver_name.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->receiver_email.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->smtp_host.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->encryption.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->smtp_user.'</b></td>';   
                                echo '<td class="text-center"><b>'.$r->smtp_password.'</b></td>';
                                echo '<td class="text-center"><b>'.$r->smtp_auth.'</b></td>';
                                echo '<td class="text-center"><b>'.$r->smtp_port.'</b></td>';
                         
                                
                                if(!empty($r->updated)){
                                echo '<td>'.($r->updated? date('d M Y (h:i A)', strtotime($r->updated)):'-').'</td>'; }
                                else{
                                 echo '<td>'.date('d M Y (h:i A)', strtotime($r->created)).'</td>';
                                } 
                                
                                                      
                                echo '<td class="one">
                         
                                        <a href="javascript:void(0);" onclick="return edit('.$r->id.',this);" ><i class="fa fa-edit" ></i></a>
                                        
                                        <a href="?page=bulk-alias&do=delete&id='.$r->id.'" onclick="return confirm(\'Are you sure to delete aliase id #'.$r->id.'? This action cant be undone.\');" ><i class="fa fa-trash" aria-hidden="true"></i</a>
                                </td>';
                                
                                echo '</tr>';
                                
                                echo '</tr>';
                                $i++;
                                $q[$r->id] = $r;
                              
                        }
                        
                        
        ?>      
        
                </tbody>
        </table>
                
        <div class="pagination">
                <?php   
                        $sql = "SELECT COUNT(`id`) as `total_records` FROM `{$wpdb->prefix}mailer_aliases`";
                        $results = $wpdb->get_results($sql);
                        $total_records = $results[0]->total_records;
                       
                        
                        $total_pages = ceil($total_records/10);
                        if($total_pages > 1){
                                echo '<ul>';
                                for($i = 1; $i <= $total_pages; $i++){
                                        $cls = $start/10 == ($i -1)? 'active': 'inactive';
                                        echo '<li class="'.$cls.'" ><a href="?page=bulk-aliases&offset='.(10 * ($i - 1)).'" >'.$i.'</a></li>';
                                }
                                echo '</ul>';
                        }
                        
                ?>
        </div>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script> var data = $.parseJSON('<?php echo addslashes(json_encode($q)) ?>'); </script>
    
        <script>
                function edit(id,anchor){
                         if ($('.opened').is(':visible')) 
                                $('.opened').slideUp();
                                
                        $('#add-q-form').slideDown();
                        $('#add-q-form').slideDown();
                        $('#formlabel').text('Edit Template ID #'+id);
                        $('[name=do]').val('Update Aliase');
                        $('[name=id]').val(id);       
                    //    tinymce.editors[0].setContent($(anchor).parent().prev().prev().html());
                        $.each(data[id], function(key, value) {
                                        
                                        var ctrl = $('[name='+key+']');
                                        
                                        switch(ctrl.prop("type")) {
                                            case "radio": case "checkbox":
                                                ctrl.each(function() {
                                                    if($(this).attr('value') == value) $(this).attr("checked",value);
                                                });   
                                                break;  
                                            default:
                                                ctrl.val(value);
                                        }
                                });
                                return false;
                }
        
        
        </script>
         <script>
                function newTemp(){
                
                        $('#formlabel').text('Add New Aliases');
                        $('[name=name]').val('');
                        $('[name=id]').val(''); 
                        $('[name=do]').val('Save Aliase'); 
                             
                     //   tinymce.editors[0].setContent('');
                        if ($('.opened').is(':visible')) 
                                $('.opened').slideUp();
                                
                        $('#add-q-form').slideDown();
                        
                        }
                
               //function impTemp(){
                 //       $('[name=do]').val('Import Template');
                  //      if ($('.opened').is(':visible')) 
                   //             $('.opened').slideUp();
                                
                    //    $('#add-q-template').slideDown();
                        
                    //    }
        
        
        </script>
        <script>
                function addressFunction() 
                                { 
                         if (document.getElementById('same').checked) 
                                { 
                                document.getElementById('receiver_name').value=document. 
                                getElementById('sender_name').value; 
                                document.getElementById('receiver_email').value=document. 
                                getElementById('sender_email').value 
                                } 
      
                        else
                                { 
                                document.getElementById('receiver_name').value=""; 
                                document.getElementById('receiver_email').value=""; 
                                 } 
                                } 
        
        
        </script>
       
       <script> 
                            
                $(document).ready(function(){
                
                        $('.table-headings').find('th').css('background-color', $('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
         $('.one').find('a').css('color', $('#adminmenu .update-plugins').css('background-color'))
         $('.form-table').find('h3').css('color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
         $('.form-table').css('border-color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
        
        $('.table-top-left tr.odd').css('background-color', $('#adminmenu').css('background-color'))
       
             
                
                })
        </script>
        
             
        
</div>

