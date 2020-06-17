<?php 

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/profile.php';
class Shortcodes{

    
    public function __construct(){
        add_action('init',array($this,'handle_logout'));
        add_shortcode('verify-donor',array($this,'verify_donor_short'));
        add_shortcode('donor-profile',array($this,'donor_profile'));
    }

    
    public function handle_logout(){
        // custom logout 
        if(isset($_POST['logout'])){
          wp_logout();
        }
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

    public function donor_profile(){
        ob_start();
        $new = new Profile_Layout();
        $new->dynamic_layout();

        return ob_get_clean();
    }

}

new Shortcodes();