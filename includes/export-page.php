<?php

add_action( 'post_submitbox_misc_actions', 'custom_button' );

function custom_button(){
    global $post;
    $id = $post->ID;

    $html = '';

    if(get_post_status($id) === 'publish') {
        $link = get_permalink($id);

        $shortenedUrl = preg_replace ('/^(http)?s?:?\/\/[^\/]*(\/?.*)$/i', '$2', '' . $link);

        if(strlen($shortenedUrl) >= 190): ?>
        <div class="update-nag notice notice-error inline">
            <h2>
                <b>URL (trvalý odkaz) je príliš dlhá, je potrebné ju skrátiť. Táto stránka sa nemusí vygenerovať na statickú (produkčnú) verziu stránky.</b>
            </h2>
        </div>
        <?php endif; ?>
        <div style="padding: 10px; text-align: right;">
            <input id="generate-static" data-id="<?php echo $id; ?>" data-href="<?php echo get_template_directory_uri(); ?>/export-to-static.php" type="submit" accesskey="p" tabindex="5" value="Vygenerovať na produkciu" class="button-primary" id="custom" name="publish">
        </div>
        <?php
    }
    echo $html;
}

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Statická verzia', 'Statická verzia', 'edit_users', 'generate-static', 'my_admin_page_contents', 'dashicons-tickets', 1 );
}

function my_admin_page_contents() {
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
         $url = "https://";   
    } else {
         $url = "http://";   
    }

    $url.= $_SERVER['HTTP_HOST'];   

    ?>
    <h1>
        <?php esc_html_e( 'Export URL na produkciu (statickú verziu)', 'vicepremier' ); ?>
    </h1>
    <form id="export-static-form" action="" class="export-static" style="padding: 15px">
        <p>Zadajte URL ktorú chcete vygenerovať*</p>
        <input type="hidden" name="href" value="<?php echo get_template_directory_uri(); ?>/export-to-static.php">
        <input type="text" name="url" placeholder="<?php echo $url; ?>" value="" required style="display: block; width: 100%; margin-bottom: 20px;" />
        <button type="submit" class="button">Vygenerovať</button>
    </form>
    <?php
}

add_action( 'edit_form_after_title', function( $post ) 
{
    ?>  
    <?php
});
