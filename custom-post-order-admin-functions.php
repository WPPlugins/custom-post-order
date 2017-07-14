<?php
// this document displays and manages the administrative options for the CustomPostOrder plugin.

global $userdata;
get_currentuserinfo();


if ( !current_user_can ( "edit_pages" ) ) die ( __( 'Sorry You can\'t see this' ) ); // only admins can edit this page

$CustomPostOrder_Options = array(
    'page_id'   => '',
);

/**
 * Returns an array of plugin settings.
 */
function CustomPostOrder_settings() {
    $settings_arr = array(
        'orderElement' => 'post_date',
        'orderType'    => 'DESC',
        'applyTo'      => 'all',
        'applyArray'   => ''
    );
    return $settings_arr;
}

/**
 * Initializes settings and adds options to database if options are not set.
 * Updates database options if any post variables were submitted.
 * Returns the current CustomPostOrder options from the database.
 */
function CustomPostOrder_updateOptions(){
    $settings      = CustomPostOrder_settings();
    $settings_keys = array_keys ( $settings );
    if ( !get_option ( 'CustomPostOrder-settings' ) ) {
        //add the settings to options
        add_option ( 'CustomPostOrder-settings', $settings );
    }
    else
        $settings = get_option ( 'CustomPostOrder-settings' );
     
    $input = $settings;
    
    
    foreach ( $_POST as $key => $value ) {
        $input[$key] = $settings[$key];
    }
    if ( $_POST['orderElement'] || $_POST['orderType'] || $_POST['applyTo'] || $_POST['applyArray']) {
            $input['orderElement'] = $_POST['orderElement'];
            $input['orderType']    = $_POST['orderType'];
            $input['applyTo']      = $_POST['applyTo'];
            $input['applyArray']   = $_POST['applyArray'];
            update_option ( 'CustomPostOrder-settings', $input );
        }
    return $input;
}

/**
 * Displays the Custom Post Order plugin options
 */

function CustomPostOrder_Form_init()
{
    global $wpdb, $user_ID,$blog_id;

    $option = CustomPostOrder_updateOptions();
    /*
     * If the options already exist in the database then use them,
     * else initialize the database by storing the defaults.
     */
    //delete_option('CustomPostOrder-settings');
    
    //$selected_cats used
    $selected_cats;
    echo $selected_cats;
    //display the options in a form
    ?>
    <h3 style="margin-left:16px;">CustomPostOrder Plugin Options</h3>
    <div class="bigger" style=" margin-left:16px;">
    Please select the desired sorting type to be used, when displaying a series of posts:<br /><br />
    <table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td width="20%" align="left" valign="top">
    <form action="" method="post">
    <b>Order by:</b><br />
        <label><input type="radio" name="orderElement" value="post_date"
    <?php
        if ( $option['orderElement'] == "post_date" ) {
            echo 'checked="checked"';
        }
    ?>  /> Post Date</label> <br />
    
    <label><input type="radio" name="orderElement" value="post_title"
    <?php
        if ( $option['orderElement'] == "post_title" ) {
            echo 'checked="checked"';
        }
    ?>  /> Post Title</label> <br />
    
    <label><input type="radio" name="orderElement" value="post_author"
    <?php
        if ( $option['orderElement'] == "post_author" ) {
            echo 'checked="checked"';
        }
    ?>  /> Post Author</label> <br />
    <label><input type="radio" name="orderElement" value="post_modified"
    <?php
        if ( $option['orderElement'] == "post_modified" ) {
            echo 'checked="checked"';
        }
    ?>  /> Last modified</label> <br />
    <label><input type="radio" name="orderElement" value="post_name"
    <?php
        if ( $option['orderElement'] == "post_name" ) {
            echo 'checked="checked"';
        }
    ?>  /> Post Name (the post slug)</label> <br />
    
    <br />
    <b>Order Style:</b><br />
    <label><input type="radio" name="orderType" value="DESC"
    <?php
        if ( $option['orderType'] == "DESC" ) {
            echo 'checked="checked"';
        }
    ?>  /> Descending</label> <br />
    <label><input type="radio" name="orderType" value="ASC"
    <?php
        if ( $option['orderType'] == "ASC" ) {
            echo 'checked="checked"';
        }
    ?>  /> Ascending</label> <br /><Br />
    </td><td align="left" valign="top">
    <table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td valign="top" align="left" width="30%">
        <b>Apply To:</b><br />
        <label><input type="radio" name="applyTo" value="all"
        <?php
            if ( $option['applyTo'] == 'all' ) {
                echo 'checked="checked"';
            }
        ?>  /> Apply to all categories </label> <br /> 
        <label><input type="radio" name="applyTo" value="selected"
        <?php
            if ( $option['applyTo'] == 'selected' ) {
                echo 'checked="checked"';
            }
        ?>  /> Apply to selected categories </label>
        <br />
    </td><td valign="top" align="left">
        <?php
            $cats = get_categories();
        ?>
        <label for="applyArray"><?php _e('You can select multiple categories by using the CTRL key:','news'); ?></label><br />
        <select id="applyArray" name="applyArray[]" style="height:200px;" multiple="multiple">
            <?php foreach ( $cats as $cat ) : ?>

		<option value="<?php echo $cat->term_id; ?>" <?php if(is_array($option['applyArray']) && in_array($cat->term_id, $option['applyArray'])) echo ' selected="selected"'; ?> >
		
                <?php echo $cat->name; ?>
		
                </option>
                
            <?php endforeach; ?>
	</select> 
        
    </td></tr></table>
    </td></tr></table>
    <input type="submit" target=_self class="button" value="Save CustomPostOrder Options" name="CustomPostOrderOptionButton"/>
    </form>
    </div>
    <?php
}

// let's show the form since we are already here
CustomPostOrder_Form_init();

?>