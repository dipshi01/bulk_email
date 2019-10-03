<?php
/**
 * Template Name: Edit-Profile
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Canyon Themes
 * @subpackage Canyon
 */
if ( ! defined('ABSPATH')) exit;
get_header();
?>
<div class="container">
<div class="row">
<div class="col-md-5">


	<div class="section-title"><?php echo __('Basic Info', 'user-profile'); ?></div>

	<div class="section-field">
      	<label for="first_name"><?php echo __('First Name', 'user-profile'); ?></label>
        <input placeholder=" Enter First Name" class="" type="text" id="first_name" name="first_name" value="<?php echo $thisuser->first_name; ?>" />

	</div>

    <div class="section-field">
        <label for="last_name" ><?php echo __('Last Name', 'user-profile'); ?></label>
        <input placeholder=" Enter Last Name" class="form-control-lg" type="text" id="last_name" name="last_name" value="<?php echo $thisuser->last_name; ?>" />
    </div>

	<div class="section-field">
            <label for="up_date_of_birth"><?php echo __('Birth Date', 'user-profile'); ?></label>
            <input class="user_profile_date"  class="form-control-lg" placeholder="2017-02-09" type="text" id="up_date_of_birth" name="up_date_of_birth" value="<?php echo $thisuser->date_of_birth; ?>" />
	</div>

	<div class="section-field">
            <label for="up_relationship"><?php echo __('Relationsship', 'user-profile'); ?></label>
            <select id="up_relationship" name="up_relationship">
		<?php foreach( $userprofile->user_relationship() as $index => $relation ) : ?>
			<?php $selected = $thisuser->relationship == $index ? 'selected' : ''; ?>
			<option <?php echo $selected; ?>  value="<?php echo $index; ?>" ><?php echo $relation['title']; ?></option>
		<?php endforeach; ?>
            </select>
	</div>

	<div class="section-field">
            <label for="up_gender"><?php echo __('Gender', 'user-profile'); ?></label>
            <select id="up_gender" name="up_gender">                
		<?php foreach( $userprofile->user_gender() as $index => $gend ) : ?>
			<?php $selected = $thisuser->gender == $index ? 'selected' : ''; ?>
			<option <?php echo $selected; ?>  value="<?php echo $index; ?>" ><?php echo $gend['title']; ?></option>
		<?php endforeach; ?>
            </select>
	</div>

	<!--<div class="section-field">
            <label for="up_religious"><?php echo __('Religious', 'user-profile'); ?></label>
            <input placeholder="Religious"  class="form-control-lg" type="text" id="up_religious" name="up_religious" value="<?php echo $thisuser->religious; ?>" />
	</div>-->
            
	<div class="section-field">
            <label for="description"><?php echo __('Biographical Info', 'user-profile'); ?></label>
            <textarea id="description"  class="form-control-lg" name="description" row="3"><?php echo $thisuser->description; ?></textarea>
	</div>
		
	<div class="section-field">
            <label for="user_url"><?php echo __('Website', 'user-profile'); ?></label>
            <input placeholder="http://www.mysite.com" class="form-control-lg" type="text" id="user_url" name="user_url" value="<?php echo $thisuser->user_url; ?>" />
	</div>
	<button class="button" type="submit">Save changes</button>
	 </div>
	 </div>
	 </div>

<?php
get_footer();
