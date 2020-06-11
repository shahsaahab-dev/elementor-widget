<?php 

class Required_Pages{
    public function __construct(){
        add_action('init',array($this,'run_on_activation'));
    }

    public function run_on_activation(){
        $page_slug = "verification";
        $page = get_page_by_path( $page_slug , OBJECT );
        $args_page = array(
            'post_title'    => wp_strip_all_tags( 'Verification' ),
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page',

        );
        wp_insert_post($args_page);
    }
}

new Required_Pages();