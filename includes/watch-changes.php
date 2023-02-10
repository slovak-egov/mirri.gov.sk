<?php
function save_post_callback($postId) {
    global $wpdb;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $table_name = $wpdb->prefix . "update_static";

    if(DO_UPDATE_DB) {
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id int(10) unsigned NOT NULL AUTO_INCREMENT,
        post_id int(10) NOT NULL,
        post_type varchar(100) NOT NULL,
        post_state varchar(100) NOT NULL,
        post_url varchar(700) NOT NULL,
        in_progress boolean not null default 0,
        PRIMARY KEY  (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        dbDelta( $sql );
    }

    //Get all data which are there with same post_id
    $prep = $wpdb->prepare ( "SELECT * FROM %s WHERE post_id = %d and in_progress = 0", array($table_name, $postId) );
    $result = $wpdb->query($prep);

    $was = sizeof($result)?true:false;

    $state = get_post_status($postId);

    if($state == 'publish' || $state == 'trash') {
        if(!$was) {
            $wpdb->insert($table_name, array(
                'post_id' => $postId,
                'post_url' => get_permalink($postId),
                'post_type' => get_post_type($postId),
                'post_state' => get_post_status($postId),
                'in_progress' => 0
            ));
        } else {
            $wpdb->update($table_name, array(
                'post_url' => get_permalink($postId),
                'post_type' => get_post_type($postId),
                'post_state' => get_post_status($postId),
                'in_progress' => 0
            ), array(
                'post_id' => $postId
            ));
        }
    }
}

add_action('post_updated', 'save_post_callback', 10, 3);
?>