<?php 

require_once __DIR__ . '/functions.php';
class Shortcodes{

    
    public function __construct(){
        add_shortcode('verify-donor',array($this,'verify_donor_short'));
    }

    public function verify_donor_short(){
        ob_start();
        $new = new Form_Function();
        $param = $_GET['verify_user_account'];
        // Changing verified email status 
        $id = get_current_user_id();
        $user_data = $new->verify_email($id);
        return ob_get_clean();
    }
}

new Shortcodes();