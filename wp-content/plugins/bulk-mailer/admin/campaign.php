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
                                        $sql = "DELETE FROM `{$wpdb->prefix}mailer_campaigns` WHERE `id` = $id";
                                        
                                        if($wpdb->query($sql)){
                                                
                                                $success = 'Record id #'.$id.' removed successfully.';
                                                remove_cron();
                                                
                                        }else    $error = 'Some error occurred. Please try again in some time.';
                                }else   $error = 'Invalid ID, please provide a correct numeric value in id.';
                        break;
                        
                        case 'Save Campaign':
                               
                                 $created = date('Y-m-d H:i:s', time());
                                 $year = $year * 365 * 24 * 60 * 60 ;
                                 $month = $month * 30 * 24 * 60 * 60;
                                 $day = $day * 24 * 60 * 60;
                                 $hour = $hour * 3600;
                                 $minute = $minute * 60;
                                 $campaign_timings = $year + $month + $day + $hour + $minute;
                               
                               //  $list_id = (int) $_GET['lid'];
                                 $title = $wpdb->_real_escape($title);
                                 $selected_list = $wpdb->_real_escape($selected_list);
                                 $selected_template = $wpdb->_real_escape($selected_template);
                                 $campaign_timings = (int) $campaign_timings;                                 
                                 $id = (int) $id;
                                
                                 $sql = "INSERT INTO `{$wpdb->prefix}mailer_campaigns`
                                                (`title`,`selected_list`,`selected_template`,`campaign_timings`,`created`)
                                                        VALUES ('$title','$selected_list','$selected_template','$campaign_timings','$created')";
                                
                                
                                if($wpdb->query($sql)){
                                       
                                        
                                        $id = $wpdb->insert_id;
                                        add_cron($id);
                                         $success = '1 Record saved successfully with '.$id.' ';
                                }
                                        
                                else  {  $error = 'Some error occurred. Please try again in some time.';
                                }
                        break;


                        case 'Update Campaign':
                                  
                                 $updated = date('Y-m-d H:i:s', time());        
                                 $title = $wpdb->_real_escape($title);
                                 $selected_list = $wpdb->_real_escape($selected_list);
                                 $selected_template = $wpdb->_real_escape($selected_template);
                                 $campaign_timings = $wpdb->_real_escape($campaign_timings);;                                
                                 $id = (int) $id;
                                 
                                $sql = "UPDATE `{$wpdb->prefix}mailer_templates`
                                                SET `title` = '$title',
                                                        `selected_list` = '$selected_list',
                                                                `selected_list` = '$selected_list',
                                                                `campaign_timings` = '$campaign_timings',
                                                                `updated` = '$updated'
                                                                
                                                                         WHERE `id` = '$id'";

                                if($wpdb->query($sql)){
                                        
                                        $success = 'Record id #'.$id.' updated successfully.';
                                        update_cron($id);
                                        
                                }else    $error = 'Some error occurred. Please try again in some time.';
                                 
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
        
         <a class="pull-right cursor-pointer button formlabel1" onclick="newTemp();">Create New Campaign</a> 
         
         <h1 class="wp-heading-inline" >Manage Campaign</h1> 
                
               
        <!-- Create-template and view template-->     
        <form id="add-q-form" style="display:none;" class="opened" action="" method="POST" >
                <a href="?page=bulk-emails"> <i style="cursor:pointer;" class="fa fa-arrow-left"><strong> back </strong></a></i>  
                
                <br><br>
                <table class="form-table" style="border: 4px solid rgb(163, 183, 69);" id="add-template" > 
                <tr style="background-color:#FFF">
                         <td colspan="5"><h3 style="margin:0;" id="formlabel" >Add New Campaign</h3></td>
                         <td  colspan="5"><button id="close-btn" class="pull-right"  style="background-color:#ffff;border:none;" onclick="$('#add-q-form').hide();">x</button></td>
        
                </tr>
                 <tr style="background-color:#fefefe" >
                         <td colspan="10"> 
                                <input type="text" placeholder="title" name="title" class="assess-text" />
         
                         </td>
                </tr>
               
                <tr style="background-color:#fefefe" >
                                <td colspan="5">
                                        <select name="selected_list" class="assess-text" >
                                                <option value="" >Select List</option>
                                                <?php $sql ="select * from `{$wpdb->prefix}mailer_lists`";
                                                 $results = $wpdb->get_results($sql);
                                                 foreach($results as $r)
                                                { ?>
                                                <option value="<?php echo $r->id; ?>"><?php echo $r->list;?></option>
                                                <?php } ?>
                                                
                                                
                                        </select>                                
                                </td> 
                                  <td colspan="5">
                                        <select name="selected_template" class="assess-text" >
                                                <option value="" >Select Template</option>
                                                <?php $sql ="select * from `{$wpdb->prefix}mailer_templates`";
                                                 $results = $wpdb->get_results($sql);
                                                 foreach($results as $r)
                                                { ?>
                                                <option value="<?php echo $r->id; ?>"><?php echo $r->name;?></option>
                                                <?php } ?>
                                                
                                        </select>                                
                                </td>                      
                        </tr>
                        <tr style="background-color:#fefefe" >
                                <td  colspan="2">
                                        <label>Year</label> 
                                        <input type="duration" placeholder="Campaign Timings" name="year" class="assess-text" />
                                        
                                </td>
                                 <td  colspan="2">
                                         <label>Month</label> 
                                        <input type="duration" placeholder="Campaign Timings" name="month" class="assess-text" />
                                        
                                </td>
                                 <td  colspan="2">
                                         <label>Days</label> 
                                        <input type="duration" placeholder="Campaign Timings" name="day" class="assess-text" />
                                        
                                </td>
                                 <td  colspan="2">
                                        <label>Hours</label> 
                                        <input type="duration" placeholder="Campaign Timings" name="hour" class="assess-text" />
                                        
                                </td>
                                 <td  colspan="2">
                                        <label>Minute</label> 
                                        <input type="duration" placeholder="Campaign Timings" name="minute" class="assess-text" />
                                        
                                </td>
                              
                        </tr>
              
                <tr style="background-color:#FFF">
                                <td colspan="10" ><input type="submit" value="Save Campaign" name="do" class="button button-primary" /><input type="hidden" name="id" class="skippable"  /></td>
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
                 <th>Selected list</th>
                 <th>Selected Template</th>
                 <th>Campaign Timings</th>
                 <th>last Updated</th>                      
                 <th>Edit</th>
                           
          </tr> 
        </thead>     
        <tbody>
        <?php            $start = $_GET['offset']? (int) $_GET['offset']: 0;
                      //  $sql = "SELECT * FROM `{$wpdb->prefix}mailer_lists` LIMIT $start, 10 ";
                        
                        $sqli = "SELECT * FROM `{$wpdb->prefix}mailer_campaigns` LIMIT $start, 10"; 
                        $results = $wpdb->get_results($sqli);
              
                        $i = 0;
                        $q = [];
                        foreach($results as $r){
                                echo '<tr class="'.($i%2? 'even': 'odd').'">';
                                echo '<td class="text-center" ><b>'.$r->id.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->title.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->selected_list.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->selected_template.'</b></td>';
                                echo '<td class="text-center" ><b>'.$r->campaign_timings.'</b></td>';
                               
                                if(!empty($r->updated)){
                                echo '<td>'.($r->updated? date('d M Y (h:i A)', strtotime($r->updated)):'-').'</td>'; }
                                else{
                                 echo '<td>'.date('d M Y (h:i A)', strtotime($r->created)).'</td>';
                                } 
                                
                                                      
                                echo '<td class="one">
                         
                                        <a href="javascript:void(0);" onclick="return edit('.$r->id.',this);" ><i class="fa fa-edit" ></i></a>
                                        
                                        <a href="?page=bulk-campaign&do=delete&id='.$r->id.'" onclick="return confirm(\'Are you sure to delete campaings id #'.$r->id.'? This action cant be undone.\');" ><i class="fa fa-trash" aria-hidden="true"></i</a>
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
                        $sql = "SELECT COUNT(`id`) as `total_records` FROM `{$wpdb->prefix}mailer_campaigns`";
                        $results = $wpdb->get_results($sql);
                        $total_records = $results[0]->total_records;
                       
                        
                        $total_pages = ceil($total_records/10);
                        if($total_pages > 1){
                                echo '<ul>';
                                for($i = 1; $i <= $total_pages; $i++){
                                        $cls = $start/10 == ($i -1)? 'active': 'inactive';
                                        echo '<li class="'.$cls.'" ><a href="?page=bulk-campaigns&offset='.(10 * ($i - 1)).'" >'.$i.'</a></li>';
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
                        $('#formlabel').text('Edit Campaign ID #'+id);
                        $('[name=do]').val('Update Campaign');
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
                
                        $('#formlabel').text('Add New Campaign');
                        $('[name=name]').val('');
                        $('[name=id]').val(''); 
                        $('[name=do]').val('Save Campaign'); 
                             
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
                            
                $(document).ready(function(){
                
                        $('.table-headings').find('th').css('background-color', $('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
         $('.one').find('a').css('color', $('#adminmenu .update-plugins').css('background-color'))
         $('.form-table').find('h3').css('color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
         $('.form-table').css('border-color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
        
        $('.table-top-left tr.odd').css('background-color', $('#adminmenu').css('background-color'))
       
             
                
                })
        </script>
        
             <?php echo add_cron($id); ?>
        
</div>

