<div class="wrap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php
                global $wpdb;
                extract($_POST);
                extract($_GET);
                if($_FILES['upload']['name']){
                        if(!$_FILES['upload']['error']) {
                                $file = file_get_contents($_FILES['upload']['tmp_name']);
                                $name = $_FILES['upload']['name'];
                                }            
                        } 
                switch($do){   
                        case 'delete':
                                $id = (int) $_GET['id'];
                                if($id){
                                        $sql = "DELETE FROM `{$wpdb->prefix}mailer_templates` WHERE `id` = $id";
                                        if($wpdb->query($sql))
                                                 $success = 'Record id #'.$id.' removed successfully.';
                                        else    $error = 'Some error occurred. Please try again in some time.';
                                }else   $error = 'Invalid ID, please provide a correct numeric value in id.';
                break;
                
                        case 'Save Template':
                                $created = date('Y-m-d H:i:s', time());
                                $name = $wpdb->_real_escape($name);
                                $content = $wpdb->_real_escape($content);
                                $id = (int) $id;
                                $sql = "INSERT INTO `{$wpdb->prefix}mailer_templates`
                                                (`name`,`content`,`created`)
                                                        VALUES ('$name','$content','$created')";
                                if($wpdb->query($sql)){
                                        $success = '1 Record saved successfully.';
                                }
                                else  {  $error = 'Some error occurred. Please try again in some time.';
                                }
                        break;
                        
                        case 'Update Template':
                                $updated = date('Y-m-d H:i:s', time());        
                                $name = $wpdb->_real_escape($name);
                                $content = $wpdb->_real_escape($content);
                                $id = (int) $id;
                                $sql = "UPDATE `{$wpdb->prefix}mailer_templates`
                                SET `name` = '$name',
                                        `content` = '$content',
                                                `updated` = '$updated'
                                                        WHERE `id` = '$id'";
                                if($wpdb->query($sql))
                                        $success = 'Record id #'.$id.' updated successfully.';
                                else    $error = 'Some error occurred. Please try again in some time.';
                                break;
                                
                        case 'Import Template':
                                $name = $wpdb->_real_escape($name);
                                $created = date('Y-m-d H:i:s', time());        
                                $content = $wpdb->_real_escape($file);
                                $id = (int) $id;
                                $sql = "INSERT INTO `{$wpdb->prefix}mailer_templates`
                                                (`name`,`content`,`created`)
                                                        VALUES ('$name','$content','$created')"; 
                                if($wpdb->query($sql)){
                                        $success = '1 template saved successfully.';
                                }
                                else  {  $error = 'Some error occurred. Please try again in some time.';
                                }
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
        <a class="pull-right cursor-pointer button form" onclick="impTemp();">Import Template
        </a> 
        <a class="pull-right cursor-pointer button formlabel1" onclick="newTemp();">Create New Template
        </a> 
        <h1 class="wp-heading-inline" >Manage Templates
        </h1> 
        <!-- Create-template and view template-->     
        <form id="add-q-form" style="display:none;" class="opened" action="" method="POST" >
                <a href="?page=bulk-emails"> 
                <i style="cursor:pointer;" class="fa fa-arrow-left">
                        <strong> back 
                </strong>
                </a>
                </i>  
         <br>
        <br>
                <table class="form-table" style="border: 4px solid rgb(163, 183, 69);" id="add-template" > 
                        <tr style="background-color:#FFF">
                                <td colspan="2">
                                        <h3 style="margin:0;" id="formlabel" >Add New Template</h3>
                                </td>
                                <td  colspan="2">
                                        <button id="close-btn" class="pull-right"  style="background-color:#ffff;border:none;" onclick="$('#add-q-form').hide();">x
                                </button>
                                </td>
                         </tr>
                         <tr style="background-color:#fefefe" >
                                <td colspan="4"> 
                                        <input type="text" placeholder="name" name="name" class="assess-text" />
                                </td>
                         </tr>
                         <tr style="background-color:#FFF">
                                 <td colspan="4">
                                        <textarea id="content" class="assess-text" rows="2" cols="20" name="content" placeholder="content">
                                        </textarea>
                                </td>
                        </tr>               
                        <tr style="background-color:#FFF">
                                <td colspan="4" >
                                        <input type="submit" value="Save Template" name="do" class="button button-primary" />
                                        <input type="hidden" name="id" class="skippable"  />
                                </td>
                        </tr>
                </table>
        </form>
        
        <form id="add-q-template" style="display:none;"  class="opened" action=""  method="POST"  enctype="multipart/form-data" >
                <table class="form-table" style="border: 4px solid rgb(163, 183, 69);" id="import-template" >
                        <tr style="background-color:#fefefe" >
                                <td colspan="2">
                                        <h3 style="margin:0;" id="formlabel" >Import New Template</h3>
                                </td>
                                <td  colspan="2">
                                        <button id="close-btn" class="pull-right"  style="background-color:#ffff;border:none;" onclick="impTemp();">x
                                        </button>
                                </td>
                        </tr>
                        <tr style="background-color:#fefefe" >
                                <td colspan="4">
                                        <input name="upload" id="upload" type="file">
                                </td>
                        </tr>
                        <tr style="background-color:#FFF">
                                <td colspan="4" >
                                        <input type="submit" value="Import Template" name="do" class="button button-primary" />
                                        <input type="hidden" name="id" class="skippable"  />
                                </td>
                        </tr>
                </table>
        </form>  
  <div id="view-template" class="container opened form-table" style="width:97%;display:none;background-color:#ffffff;border: 4px solid rgb(163, 183, 69);padding:10px;">
  </div> 
  <br>
  <!-- import-template -->
        <table class="table table-top-left" id="manage-lists-1">
                <thead>
                        <tr class="table-headings" >
                                <th>#ID</th>
                                <th>Name</th> 
                                <th style="display:none;">Content</th>             
                                <th>Last Update</th>
                                <th>-</th>
                        </tr> 
                </thead>     
        <tbody>
        <?php           $start = $_GET['offset']? (int) $_GET['offset']: 0;
//  $sql = "SELECT * FROM `{$wpdb->prefix}mailer_lists` LIMIT $start, 10 ";
                        $sqli = "SELECT * FROM `{$wpdb->prefix}mailer_templates` LIMIT $start, 10"; 
                        $results = $wpdb->get_results($sqli);
                        $i = 0;
                        $q = [];
                        foreach($results as $r){
                                echo '<tr class="'.($i%2? 'even': 'odd').'">';
                                echo '<td class="text-center" ><b>'.$r->id.'</b></td>';
                                echo '<td class="one">'.$r->name.'</td>';
                                echo '<td class="text-center" style="display:none;""><b>'.$r->content.'</b></td>';
                        if(!empty($r->updated)){
                                echo '<td>'.($r->updated? date('d M Y (h:i A)', strtotime($r->updated)):'-').'</td>'; }
                        else{
                                echo '<td>'.date('d M Y (h:i A)', strtotime($r->created)).'</td>';
                        } 
                                echo '<td class="one">
                                <a href="javascript:void(0);" onclick="return edit('.$r->id.',this);" ><i class="fa fa-edit" ></i></a>
                                <a href="javascript:void(0);" onclick="return view('.$r->id.');" ><i class="fa fa-eye" ></i></a>
                                <a href="?page=bulk-templates&do=delete&id='.$r->id.'" onclick="return confirm(\'Are you sure to delete template id #'.$r->id.'? This action cant be undone.\');" ><i class="fa fa-trash" aria-hidden="true"></i</a>
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
                        $sql = "SELECT COUNT(`id`) as `total_records` FROM `{$wpdb->prefix}mailer_templates`";
                        $results = $wpdb->get_results($sql);
                        $total_records = $results[0]->total_records;
                        $total_pages = ceil($total_records/10);
                        if($total_pages > 1){
                                echo '<ul>';
                        for($i = 1; $i <= $total_pages; $i++){
                                $cls = $start/10 == ($i -1)? 'active': 'inactive';
                                echo '<li class="'.$cls.'" ><a href="?page=bulk-templates&offset='.(10 * ($i - 1)).'" >'.$i.'</a></li>';
                        }
                                echo '</ul>';
                        }
        ?>
  </div>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin">
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <script> var data = $.parseJSON('<?php echo addslashes(json_encode($q)) ?>');
        </script>
        <script>tinymce.init({
      selector:'#content'}
                      );
        </script>
        <script>
                function edit(id,anchor){
                        if ($('.opened').is(':visible')) 
                        $('.opened').slideUp();
                        $('#add-q-form').slideDown();
                        $('#add-q-form').slideDown();
                        $('#formlabel').text('Edit Template ID #'+id);
                        $('[name=do]').val('Update Template');
                        $('[name=id]').val(id);
                        tinymce.editors[0].setContent($(anchor).parent().prev().prev().html());
                        $.each(data[id], function(key, value) {
                        $('[name='+key+']').val(value);
                        }
                        );
                return false;
                }
       </script>
       <script>
                function newTemp(){
                        $('#formlabel').text('Add New Template');
                        $('[name=name]').val('');
                        $('[name=id]').val('');
                        $('[name=do]').val('Save Template');
                        tinymce.editors[0].setContent('');
                        if ($('.opened').is(':visible')) 
                        $('.opened').slideUp();
                        $('#add-q-form').slideDown();
                      }
                function impTemp(){
                        $('[name=do]').val('Import Template');
                        if ($('.opened').is(':visible')) 
                        $('.opened').slideUp();
                        $('#add-q-template').slideDown();
                        }
        </script>
        <script>
                function view(id){           
                       
                        if ($('.opened').is(':visible')) 
                        $('.opened').slideUp();
                        $('#view-template').slideDown();
                        $('[name=id]').val(id);
                        var name = content = '';
                        $.each(data[id], function(key, value) {
                        if(key=='content'){
                        name = value;
                        }
                        if(key=='name'){
                        content = value;
                        }
                    
                        $('#view-template').html("<h3>View Template : "+content+"</h3>"+name);
                        $('#view-template').find('h3').css('color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'));
                        $('[name='+key+']').val();
                        }
                        );
                return false;
                }
        </script>
        <script> 
        $(document).ready(function(){
                        $('.table-headings').find('th').css('background-color', $('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
                        $('.one').find('a').css('color', $('#adminmenu .update-plugins').css('background-color'))
                        $('.form-table').find('h3').css('color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
                        $('.form-table').css('border-color',$('#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu').css('background-color'))
                        $('.table-top-left tr.odd').css('background-color', $('#adminmenu').css('background-color'))
         }
        )
        </script>
        </div>

