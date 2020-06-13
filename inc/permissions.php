<?php

if(!defined('ABSPATH')){
    exit;
}
 
class Permissions{
    
public function __construct(){
    add_action('pre_get_posts',array($this,'change_media_permissions'));
}

public function change_media_permissions($wp_query_obj ){
    
    global $current_user, $pagenow;

    $is_attachment_request = ($wp_query_obj->get('post_type')=='attachment');

    if( !$is_attachment_request )
        return;

    if( !is_a( $current_user, 'WP_User') )
        return;

    if( !in_array( $pagenow, array( 'upload.php', 'admin-ajax.php' ) ) )
        return;

    if( !current_user_can('delete_pages') )
        $wp_query_obj->set('author', $current_user->ID );

    return;
}

}

new Permissions();