<?php 

class DB_Query{

    // Fetching a single record easily.
    public function get_a_record($table,$column,$value){
        global $wpdb;
        $query = "SELECT * FROM $table WHERE $column = '$value'";
        return $wpdb->get_results($query);
    }
}