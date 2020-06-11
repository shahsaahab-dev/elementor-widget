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
        <th><label for="contact">Contact</label></th>

        <td><input type="text" class="input-text form-control" name="contact" id="contact" />
        </td>
 
    </tr>
</table>

<?php
    }
}

new Profile();