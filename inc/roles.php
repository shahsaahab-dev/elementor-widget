<?php 

if(!defined('ABSPATH')){
    exit; // Exit if accessed directly.
}
class Roles{

    public function __construct(){
        add_action('init',array($this,'add_user_roles'));
    }
    // Add Custom User Roles
    public function add_user_roles(){
        add_role('open_star','Open Star',array('edit_posts' => false,'delete_posts' => false,'read' => true));
        add_role('close_star','Close Star',array('edit_posts' => false,'delete_posts' => false,'read' => true));
    }
    

}

new Roles();