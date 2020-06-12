<?php 


if(!defined('ABSPATH')){
    exit; // Exit if accessed directly.
}

class Profile{
    public function __construct(){
        add_action('show_user_profile',array($this,'custom_fields_settings'));
    }

    public function custom_fields_settings($user){
        $message = __("Donation Plugin Settings","elementor-widget");
        printf('<h3 class="heading">%1$s</h3>',$message);
    
    ?>

<table class="form-table">
    <tr>
        <th><label for="contact">Phone Number</label></th>
        <td><input type="text" value="<?php print_r(get_user_meta(get_current_user_id(),'phone')); ?>"></td>
        </td>
 
    </tr>
</table>

<?php
    }
}

new Profile();