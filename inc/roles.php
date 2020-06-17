<?php 

if(!defined('ABSPATH')){
    exit; // Exit if accessed directly.
}
class Roles{

    public function __construct(){
        add_action('init',array($this,'add_user_roles'));
        add_action('admin_init',array($this,'add_capabilities'));
    }
    // Add Custom User Roles
    public function add_user_roles(){
        add_role('open_star','Open Star',array('edit_posts' => false,'delete_posts' => false,'read' => true,'show_bar'=>true));
        add_role('close_star','Close Star',array('edit_posts' => false,'delete_posts' => false,'read' => true));
    }

    // Adding Separately so that can be unplugged later if a security threat comes in.
    public function add_capabilities(){
        $open_star = get_role('open_star');
        $close_star = get_role('close_star');

        $roles_to_edit = array($open_star,$close_star);
        foreach($roles_to_edit as $role){
            $role->add_cap('upload_files');
        }
    }
    

}

new Roles();