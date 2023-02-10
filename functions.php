<?php
include('includes/remove-comments.php');
include('includes/remove-posts.php');
include('includes/watch-changes.php');
include('includes/export-page.php');

/*
┌───────────────────────────────────────────────────┐
│                                                   │
│               DEFAULT THEME SETUP                 │
│                                                   │
└───────────────────────────────────────────────────┘
*/

function theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');

    // menu settings

    register_nav_menus(array(
        'menu' => __('Hlavné menu', 'vicepremier')
    ));
    
    // settings Page for theme
    if (function_exists('acf_add_options_page')) {
        $settingsPage = acf_add_options_page(array(
            'page_title' => __('Ďalšie nastavenia', 'vicepremier'),
            'menu_title' => __('Ďalšie nastavenia', 'vicepremier'),
            'menu_slug' => 'vicepremier-general-settings',
            'capability' => 'edit_posts',
            'autoload' => true,
            'post_id' => 'options',
            'redirect' => false
        ));
    }

    //settings page for kariera
    if ( function_exists( 'acf_add_options_sub_page' ) ){
    	acf_add_options_sub_page(array(
    		'title'      => __('Nastavenia kariéry', 'vicepremier'),
    		'parent'     => 'edit.php?post_type=kariera',
            'capability' => 'edit_posts',
            'autoload' => true,
            'post_id' => 'options_kariera',
            'redirect' => false
    	));
    }

    if ( function_exists( 'acf_add_options_sub_page' ) ){
    	acf_add_options_sub_page(array(
    		'title'      => __('Nastavenia kariéry (EN)', 'vicepremier'),
    		'parent'     => 'edit.php?post_type=kariera_en',
            'capability' => 'edit_posts',
            'autoload' => true,
            'post_id' => 'options_kariera_en',
            'redirect' => false
    	));
    }

    //settings page for plan obnovy
    if ( function_exists( 'acf_add_options_sub_page' ) ){
    	acf_add_options_sub_page(array(
    		'title'      => __('Nastavenia plánu obnovy', 'vicepremier'),
    		'parent'     => 'edit.php?post_type=plan_obnovy',
            'capability' => 'edit_posts',
            'autoload' => true,
            'post_id' => 'options_plan_obnovy',
            'redirect' => false
    	));
    }
}

add_action('after_setup_theme', 'theme_setup');

/*
┌───────────────────────────────────────────────────┐
│                                                   │
│               LOADING ALL SCRIPTS                 │
│                                                   │
└───────────────────────────────────────────────────┘
*/

function theme_scripts()
{
    global $template;
    global $wp;

    // styles
    wp_enqueue_style('css-idsk', get_theme_file_uri('/fe/source/assets/idsk/idsk-frontend-2.9.0.min.css'), false, null);
    wp_enqueue_style('css-vendor', get_theme_file_uri('/fe/source/assets/css/vendor.min.css'), false, null);
    wp_enqueue_style('css-main', get_theme_file_uri('/fe/source/assets/css/main.min.css?v=24'), false, null);
    wp_enqueue_style('css-photoswiper', get_theme_file_uri('/fe/source/assets/js/photoswipe/photoswipe.css'), false, null);
    wp_enqueue_style('css-photoswiper-theme', get_theme_file_uri('/fe/source/assets/js/photoswipe/default-skin/default-skin.css'), false, null);

    //footer scripts
    wp_enqueue_script('js-idsk', get_theme_file_uri('/fe/source/assets/idsk/idsk-frontend-2.9.0.min.js'), null, null, true);
    wp_enqueue_script('js-plugins', get_theme_file_uri('/fe/source/assets/js/vendor.js'), null, null, true);
    wp_enqueue_script('js-main', get_theme_file_uri('/fe/source/assets/js/main.js?v=24'),null, null, true);
    wp_enqueue_script('js-added', get_theme_file_uri('/fe/source/assets/js/added.js?v=24'),null, null, true);
    wp_enqueue_script('js-cookies', get_theme_file_uri('/fe/source/assets/js/cookies.js?v=24'),null, null, true);
    
    if(home_url( $wp->request ) . '/' == get_field('stranka_vyhladavania', 'options')['url']) {
        wp_enqueue_script('js-search', get_theme_file_uri('/assets/js/search.js?v=24'), null, null, true);
    }
    
    if ( is_page_template( 'templates/strategie.php' ) ) {
        wp_enqueue_style('css-strategie', get_theme_file_uri('/assets/css/strategie.css'), false, null);
        wp_enqueue_script('js-strategie', get_theme_file_uri('/assets/js/strategie.min.js'), null, null, false);
    }
}

add_action('wp_enqueue_scripts', 'theme_scripts');


function my_enqueue($hook) {
    
    wp_enqueue_script('jquery-generate', get_theme_file_uri('/assets/js/admin.js'));
}

add_action('admin_enqueue_scripts', 'my_enqueue');
/*
┌───────────────────────────────────────────────────┐
│                                                   │
│               CPT REGISTER                        │
│                                                   │
└───────────────────────────────────────────────────┘
*/

function cpt_register()
{   
    $labelsTaxonomy = array(
        'name' => __('Kategória', 'vicepremier'),
        'singular_name' => __('Kategória', 'vicepremier'),
        'search_items' =>  __('Vyhľadať kategóriu', 'vicepremier'),
        'all_items' => __('Všetky kategórie', 'vicepremier'),
        'parent_item' => __('Nadradená kategória', 'vicepremier'),
        'parent_item_colon' => __('Nadradená kategória:', 'vicepremier'),
        'edit_item' => __('Upraviť kategóriu', 'vicepremier'),
        'update_item' => __('Aktualizovať kategóriu', 'vicepremier'),
        'add_new_item' => __('Pridať kategóriu', 'vicepremier'),
        'new_item_name' => __('Názov novej kategórie', 'vicepremier'),
        'menu_name' => __('Kategórie', 'vicepremier')
    );
    
    //Register sekcie
    $labels = array(
        'name' => __('Sekcie', 'vicepremier'),
        'singular_name' => __('Sekcia', 'vicepremier'),
        'add_new' => __('Pridaj novú stránku sekcie', 'vicepremier'),
        'add_new_item' => __('Pridaj novú stránku sekcie', 'vicepremier'),
        'edit_item' => __('Uprav stránku sekcie', 'vicepremier'),
        'new_item' => __('Nová stránka sekcie', 'vicepremier'),
        'view_item' => __('Zobraz stránku sekcie', 'vicepremier'),
        'search_items' => __('Vyhľadaj stránku sekcie', 'vicepremier'),
        'not_found' => __('Nič sa nenašlo', 'vicepremier'),
        'not_found_in_trash' => __('Nič nie je v koši', 'vicepremier'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes', 
            'revisions'
        ),
        'menu_icon'           => 'dashicons-list-view',
        'rewrite' => [
            'slug' => __('sekcie', 'vicepremier'),
            'with_front' => false
        ]
    );
    
    register_post_type('sekcie', $args);
    
    register_taxonomy('kategorie-sekcie',array('sekcie'), array(
        'hierarchical' => true,
        'labels' => $labelsTaxonomy,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => [
            'slug' => __('aktuality', 'vicepremier'),
            'with_front' => false
        ]
    ));
    
    //Register podpredseda vlády
    $labels = array(
        'name' => __('Ministerka', 'vicepremier'),
        'singular_name' => __('Stránka - ministerka', 'vicepremier'),
        'add_new' => __('Pridaj novú stránku', 'vicepremier'),
        'add_new_item' => __('Pridaj novú stránku', 'vicepremier'),
        'edit_item' => __('Uprav stránku', 'vicepremier'),
        'new_item' => __('Nová stránka', 'vicepremier'),
        'view_item' => __('Zobraz stránku', 'vicepremier'),
        'search_items' => __('Vyhľadaj stránku', 'vicepremier'),
        'not_found' => __('Nič sa nenašlo', 'vicepremier'),
        'not_found_in_trash' => __('Nič nie je v koši', 'vicepremier'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes', 
            'revisions'
        ),
        'menu_icon'           => 'dashicons-admin-users',
        'rewrite' => [
            'slug' => __('ministerka', 'vicepremier'),
            'with_front' => false
        ],
        'taxonomies'          => array( 'kategorie-sekcie')
    );
    
    register_post_type('podpredseda_vlady', $args);
    
    //Register úrad'
    $labels = array(
        'name' => __('Ministerstvo', 'vicepremier'),
        'singular_name' => __('Stránka - ministerstvo', 'vicepremier'),
        'add_new' => __('Pridaj novú stránku', 'vicepremier'),
        'add_new_item' => __('Pridaj novú stránku', 'vicepremier'),
        'edit_item' => __('Uprav stránku', 'vicepremier'),
        'new_item' => __('Nová stránka', 'vicepremier'),
        'view_item' => __('Zobraz stránku', 'vicepremier'),
        'search_items' => __('Vyhľadaj stránku', 'vicepremier'),
        'not_found' => __('Nič sa nenašlo', 'vicepremier'),
        'not_found_in_trash' => __('Nič nie je v koši', 'vicepremier'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes', 
            'revisions'
        ),
        'menu_icon'           => 'dashicons-building',
        'rewrite' => [
            'slug' => __('ministerstvo', 'vicepremier'),
            'with_front' => false
        ],
        'taxonomies'          => array( 'kategorie-sekcie'),
		'capability_type'     => array('urad_cpt', 'urads_cpt'),
        'map_meta_cap' => true
    );
    
    register_post_type('urad', $args);

    //Register kariera
    $labels = array(
        'name' => __('Kariéra', 'vicepremier'),
        'singular_name' => __('Stránka - kariéra', 'vicepremier'),
        'add_new' => __('Pridaj novú stránku kariéry', 'vicepremier'),
        'add_new_item' => __('Pridaj novú stránku kariéry', 'vicepremier'),
        'edit_item' => __('Uprav stránku kariéry', 'vicepremier'),
        'new_item' => __('Nová stránka kariéry', 'vicepremier'),
        'view_item' => __('Zobraz stránku kariéry', 'vicepremier'),
        'search_items' => __('Vyhľadaj stránku kariéry', 'vicepremier'),
        'not_found' => __('Nič sa nenašlo', 'vicepremier'),
        'not_found_in_trash' => __('Nič nie je v koši', 'vicepremier'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes', 
            'revisions'
        ),
        'menu_icon'           => 'dashicons-admin-users',
        'rewrite' => [
            'slug' => __('kariera', 'vicepremier'),
            'with_front' => false
        ],
        'map_meta_cap' => true
    );
    
    register_post_type('kariera', $args);


    //Register kariera
    $labels = array(
        'name' => __('Kariéra (EN)', 'vicepremier'),
        'singular_name' => __('Stránka - kariéra (EN)', 'vicepremier'),
        'add_new' => __('Pridaj novú stránku kariéry (EN)', 'vicepremier'),
        'add_new_item' => __('Pridaj novú stránku kariéry (EN)', 'vicepremier'),
        'edit_item' => __('Uprav stránku kariéry (EN)', 'vicepremier'),
        'new_item' => __('Nová stránka kariéry (EN)', 'vicepremier'),
        'view_item' => __('Zobraz stránku kariéry (EN)', 'vicepremier'),
        'search_items' => __('Vyhľadaj stránku kariéry (EN)', 'vicepremier'),
        'not_found' => __('Nič sa nenašlo', 'vicepremier'),
        'not_found_in_trash' => __('Nič nie je v koši', 'vicepremier'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes', 
            'revisions'
        ),
        'menu_icon'           => 'dashicons-admin-users',
        'rewrite' => [
            'slug' => __('career', 'vicepremier'),
            'with_front' => false
        ],
        'map_meta_cap' => true
    );
    
    register_post_type('kariera_en', $args);

    //Register plan obnovy
    $labels = array(
        'name' => __('Plán obnovy a odolnosti', 'vicepremier'),
        'singular_name' => __('Stránka - plán obnovy', 'vicepremier'),
        'add_new' => __('Pridaj novú stránku plánu obnovy', 'vicepremier'),
        'add_new_item' => __('Pridaj novú stránku plánu obnovy', 'vicepremier'),
        'edit_item' => __('Uprav stránku plánu obnovy', 'vicepremier'),
        'new_item' => __('Nová stránka plánu obnovy', 'vicepremier'),
        'view_item' => __('Zobraz stránku plánu obnovy', 'vicepremier'),
        'search_items' => __('Vyhľadaj stránku plánu obnovy', 'vicepremier'),
        'not_found' => __('Nič sa nenašlo', 'vicepremier'),
        'not_found_in_trash' => __('Nič nie je v koši', 'vicepremier'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes', 
            'revisions'
        ),
        'menu_icon'           => 'dashicons-tickets-alt',
        'rewrite' => [
            'slug' => __('plan-obnovy', 'vicepremier'),
            'with_front' => false
        ],
        'map_meta_cap' => true
    );
    
    register_post_type('plan_obnovy', $args);
    
    //Register mpsr'

    $labels = array(
        'name' => __('MP SR', 'vicepremier'),
        'singular_name' => __('Stránka - MP SR', 'vicepremier'),
        'add_new' => __('Pridaj novú stránku', 'vicepremier'),
        'add_new_item' => __('Pridaj novú stránku', 'vicepremier'),
        'edit_item' => __('Uprav stránku', 'vicepremier'),
        'new_item' => __('Nová stránka', 'vicepremier'),
        'view_item' => __('Zobraz stránku', 'vicepremier'),
        'search_items' => __('Vyhľadaj stránku', 'vicepremier'),
        'not_found' => __('Nič sa nenašlo', 'vicepremier'),
        'not_found_in_trash' => __('Nič nie je v koši', 'vicepremier'),
        'parent_item_colon' => ''
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes',
            'revisions',
            'thumbnail',
        ),
        'menu_icon' => 'dashicons-database',
        'rewrite' => [
            'slug' => __('mpsr', 'vicepremier'),
            'with_front' => false
        ],
        'taxonomies' => array( 'kategorie-sekcie'),
        'capability_type' => array('mpsr_cpt', 'mpsrs_cpt'),
        'map_meta_cap' => true
    );

    register_post_type('mpsr', $args);
    //Register projekty
    $labels = array(
        'name' => __('Projekty', 'vicepremier'),
        'singular_name' => __('Stránka - projekty', 'vicepremier'),
        'add_new' => __('Pridaj novú stránku', 'vicepremier'),
        'add_new_item' => __('Pridaj novú stránku', 'vicepremier'),
        'edit_item' => __('Uprav stránku', 'vicepremier'),
        'new_item' => __('Nová stránka', 'vicepremier'),
        'view_item' => __('Zobraz stránku', 'vicepremier'),
        'search_items' => __('Vyhľadaj stránku', 'vicepremier'),
        'not_found' => __('Nič sa nenašlo', 'vicepremier'),
        'not_found_in_trash' => __('Nič nie je v koši', 'vicepremier'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes', 
            'revisions'
        ),
        'menu_icon'           => 'dashicons-tickets-alt',
        'rewrite' => [
            'slug' => __('projekty', 'vicepremier'),
            'with_front' => false
        ],
        'taxonomies'          => array( 'kategorie-sekcie'),
		'capability_type'     => array('projekt', 'projekts'),
        'map_meta_cap' => true
    );
    
    register_post_type('projekty', $args);
    
    //Register články
    $labels = array(
        'name' => __('Aktuality', 'vicepremier'),
        'singular_name' => __('Aktuality', 'vicepremier'),
        'add_new' => __('Pridaj novú', 'vicepremier'),
        'add_new_item' => __('Pridaj novú aktualitu', 'vicepremier'),
        'edit_item' => __('Uprav aktualitu', 'vicepremier'),
        'new_item' => __('Nová aktualita', 'vicepremier'),
        'view_item' => __('Zobraz aktualitu', 'vicepremier'),
        'search_items' => __('Vyhľadaj aktualitu', 'vicepremier'),
        'not_found' => __('Nič sa nenašlo', 'vicepremier'),
        'not_found_in_trash' => __('Nič nie je v koši', 'vicepremier'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'has_archive' => __('aktuality', 'vicepremier'),
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes', 
            'revisions'
        ),
        'menu_icon'           => 'dashicons-admin-post',
        'rewrite' => [
            'slug' => __('aktuality', 'vicepremier') . '/%category%',
            'with_front' => true
        ],
        'taxonomies'          => array( 'kategorie-sekcie',  'post_tag' ),
    );
    
    register_post_type('clanky', $args);
}

add_action('init', 'cpt_register');

/*
┌───────────────────────────────────────────────────┐
│                                                   │
│               HELPER FUNCTIONS                    │
│                                                   │
└───────────────────────────────────────────────────┘
*/

add_filter('xmlrpc_enabled', '__return_false');

if (!function_exists('theme_url')) {
    function theme_url()
    {
        echo esc_url(get_template_directory_uri()) . '/';
    }
}

if (!function_exists('get_category_for_article')) {
    function get_category_for_article($id) {
        $taxonomies = get_post_taxonomies($id);
             
        $returnValues = [];
        
        foreach($taxonomies as $tax) {
            
            if($tax != 'post_tag') {
                $selected = get_the_terms($id, $tax);
            
                if(!empty($selected)) {
                    foreach($selected as $cat) {
                        $retVal = new  stdClass();
                        $retVal->url = get_term_link($cat->term_id);
                        $retVal->name = get_the_category_by_ID($cat->term_id);
                        $retVal->id = $cat->term_id;
                        
                        if( get_post_meta($id, '_yoast_wpseo_primary_category',true) == $cat->term_id ) {
                            array_unshift($returnValues, $retVal);
                        } else {
                            $returnValues[] = $retVal;
                        }
                        
                    }
                }
            }
        }
        
        return $returnValues;
    }
}

if (!function_exists('get_category_for_event')) {
    function get_category_for_event($id) {
        $taxonomies = get_post_taxonomies($id);
             
        $returnValues = [];
        
        foreach($taxonomies as $tax) {
            
            if($tax != 'kategorie-udalosti') {
                $selected = get_the_terms($id, $tax);
            
                if(!empty($selected)) {
                    foreach($selected as $cat) {
                        $retVal = new  stdClass();
                        $retVal->url = get_term_link($cat->term_id);
                        $retVal->name = get_the_category_by_ID($cat->term_id);
                        $retVal->id = $cat->term_id;
                        
                        if( get_post_meta($id, '_yoast_wpseo_primary_category',true) == $cat->term_id ) {
                            array_unshift($returnValues, $retVal);
                        } else {
                            $returnValues[] = $retVal;
                        }
                        
                    }
                }
            }
        }
        
        return $returnValues;
    }
}

if (!function_exists('custom_button')) {
    function custom_button($wp_admin_bar){
        $args = array(
            'id' => 'generate-search',
            'title' => _x('Generovať súbor pre vyhľadávanie', 'vicepremier'),
            'href' => get_template_directory_uri() . '/export-search.php',
            'meta' => array(
                            'class' => 'generate-search'
                        )
        );
        
        $wp_admin_bar->add_node($args);
    }
        
    add_action('admin_bar_menu', 'custom_button', 50);
}

function get_youtube_ID($url) {
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);

    return $matches[1];
}

function getSizeWithValues( $bytes )
{
    $label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
    for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
    return( round( $bytes, 2 ) . " " . $label[$i] );
}

function getFileInfoInString($filePath) {
    $extension = pathinfo($filePath)['extension'];
    $fileName = pathinfo($filePath)['filename'];

    $retString = '';
    $tmpInfo = '';


    if(isset($extension) && !empty($extension))  {
        $tmpInfo .= strtoupper($extension) . ', ';

        ///-----------GET FILE SIZE---------------//
    
        try {
            $ch = curl_init($filePath);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        
            $data = curl_exec($ch);
            $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        
            curl_close($ch);

            if($size > 0) {
                $tmpInfo .= getSizeWithValues($size) . ', ';
            }
        } catch ( Exception $e ) {

        }
    ///-----------/GET FILE SIZE---------------//
    }
    
    if(isset($tmpInfo) && !empty($tmpInfo))  {
        return '(' . rtrim($tmpInfo, ', ') . ') ';
    }

    return '';
}

//Function add Aria stuffs
function wcag_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

    $item_has_children = in_array( 'menu-item-has-children', $item->classes );
    if ( $item_has_children ) {
        $atts['aria-haspopup'] = "true";
        $atts['aria-expanded'] = "false";
    }

    if( in_array('current-menu-parent', $item->classes) || in_array('current-menu-ancestor', $item->classes)) {
        $atts['aria-expanded'] = 'true';
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'wcag_nav_menu_link_attributes', 10, 4 );
/*
┌───────────────────────────────────────────────────┐
│                                                   │
│                   LANGUAGES                       │
│                                                   │
└───────────────────────────────────────────────────┘
*/

function getLanguages() {
    $languages = icl_get_languages('skip_missing=0');
 
    return $languages;
}

function getSelectedLanguage() {
    $languages = icl_get_languages('skip_missing=0');
 
    if( !empty( $languages ) ) {
        foreach( $languages as $language ){
            if( $language['active'] ) return $language;
        }
    }
}


/*
┌───────────────────────────────────────────────────┐
│                                                   │
│                   CHANGE URL                      │
│                                                   │
└───────────────────────────────────────────────────┘
*/
function wpa_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'clanky' ){
        $terms = wp_get_object_terms( $post->ID, 'kategorie-sekcie' );
        if( !empty($terms) ){
            return str_replace( '%category%' , $terms[0]->slug , $post_link );
        } else {
            return str_replace( '/%category%', '', $post_link );
        }
    }
    
    return $post_link;
}
add_filter( 'post_type_link', 'wpa_show_permalinks', 1, 2 );

add_filter( 'wpseo_breadcrumb_links', 'wpse_override_yoast_breadcrumb_trail' );

function wpse_override_yoast_breadcrumb_trail( $links ) {
    global $post;

    if ( is_post_type_archive('clanky')) {
        
        if(!empty($links[sizeof($links)-1]['ptarchive']) && $links[sizeof($links)-1]['ptarchive'] == 'clanky') {
            return $links;
        } else {
            $breadcrumb[] = array(
                'url' => get_permalink( get_option( 'page_for_posts' ) ),
                'text' => __('Aktuality', 'vicepremier'),
            );
    
            array_splice( $links, 1, -2, $breadcrumb );
        }
    }

    return $links;
}

/*
┌───────────────────────────────────────────────────┐
│                                                   │
│          OTHER FILES  SUPPORT                     │
│                                                   │
└───────────────────────────────────────────────────┘
*/
function my_mime_types($mime_types){
    $mime_types['zip-added'] = 'application/octet-stream';
    $mime_types['zip'] = 'application/zip';
    $mime_types['rar'] = 'application/x-rar-compressed';
    $mime_types['tar'] = 'application/x-tar';
    $mime_types['gz'] = 'application/x-gzip';
    $mime_types['gzip'] = 'application/x-gzip';
    $mime_types['svg'] = 'image/svg+xml';
    $mime_types['xml'] = 'application/xml';
    return $mime_types;
}

add_filter('upload_mimes', 'my_mime_types', 1, 1);

function common_svg_media_thumbnails($response, $attachment, $meta){
    if($response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists('SimpleXMLElement'))
    {
        try {
            $path = get_attached_file($attachment->ID);
            if(@file_exists($path))
            {
                $svg = new SimpleXMLElement(@file_get_contents($path));
                $src = $response['url'];
                $width = (int) $svg['width'];
                $height = (int) $svg['height'];

                $response['image'] = compact( 'src', 'width', 'height' );
                $response['thumb'] = compact( 'src', 'width', 'height' );

                $response['sizes']['full'] = array(
                    'height'        => $height,
                    'width'         => $width,
                    'url'           => $src,
                    'orientation'   => $height > $width ? 'portrait' : 'landscape',
                );
            }
        }
        catch(Exception $e){}
    }

    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'common_svg_media_thumbnails', 10, 3);


add_action('init', function() {
    add_rewrite_rule(_x('aktuality', 'vicepremier') . '/page/([0-9]{1,})/?$', 'index.php?post_type=' . _x('clanky', 'vicepremier') . '&page=$matches[1]', 'top');
    add_rewrite_rule(_x('aktuality', 'vicepremier') . '/([^/]+)/page/?([0-9]{1,})/?$', 'index.php?kategorie-sekcie=$matches[1]&page=$matches[2]', 'top');
    add_rewrite_rule(_x('mpsr', 'vicepremier') . '/(.*)/page/?([0-9]{1,})/?$', 'index.php?' . _x('mpsr', 'vicepremier') . '=$matches[1]', 'top');
  });

add_filter('ure_restrict_edit_post_type', 'exclude_posts_from_edit_restrictions');
function exclude_posts_from_edit_restrictions($post_type) {
    $restrict_it = true;
    // if (current_user_can('editor')) {
        // if ($post_type=='attachment') {
                $restrict_it = false;
        // }
    // }
    return $restrict_it;
}

function remove_json_api () {

    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );

    // Turn off oEmbed auto discovery.
//    add_filter( 'embed_oembed_discover', '__return_false' );

    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    // Remove all embeds rewrite rules.
//    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

}
add_action( 'after_setup_theme', 'remove_json_api' );


function disable_json_api () {

  // Filters for WP-API version 1.x
  add_filter( 'json_enabled', '__return_false' );
  add_filter( 'json_jsonp_enabled', '__return_false' );

  // Filters for WP-API version 2.x
  add_filter( 'rest_enabled', '__return_false' );
  add_filter( 'rest_jsonp_enabled', '__return_false' );

}
add_action( 'after_setup_theme', 'disable_json_api' );

if (!function_exists('haveAnyChildren')){
    function haveAnyChildren($parentId): bool
    {
        $args = [
            'post_type' => 'mpsr',
            'posts_per_page' => -1,
            'post_parent' => $parentId,
        ];

        $posts = get_posts($args);

        foreach ($posts as $post)
        {
            $kids = get_children([
                'post_parent' => $post->ID,
                'post_type' => 'mpsr',
            ]);

            if(isset($kids) && !empty($kids) && count($kids) >= 1)
            {
                return true;
            }
        }

        return false;
    }
}

if(!function_exists('printContactData')) {
    function printContactData($contact, $typ, $odkaz) {
        $href = $contact;
        $type = $typ;
        $title = $contact;
        $icon = 'search';
        $target = "_blank";

        if($type === 'odkaz') {
            $href = $odkaz['url'];
            $title = $odkaz['title'];
            $target = ($odkaz['target'] !== '' && isset($odkaz['target']))?$odkaz['target']:'_self';
        } else {
            if($type === 'email') {
                $href = 'mailto:' . $href;
                $icon = 'email_icon';
            } else {
                $href = 'tel:' . $href;
                $icon = 'phone_icon';
            }
        }

        ?>
        <a class="link" target="<?php echo $target; ?>" href="<?php echo $href;?>"><span class="icon icon-<?php echo $icon; ?>"></span><?php echo $title;?></a>
        <?php
    }
}

if(!function_exists('buildTreeMenu')) {
    function buildTreeMenu( array &$elements, $parentId = 0 ) {
        $branch = array();
        foreach ( $elements as &$element )
        {
            if ( $element->menu_item_parent == $parentId )
            {
                $children = buildTreeMenu( $elements, $element->ID );
                if ( $children )
                    $element->wpse_children = $children;

                $branch[$element->ID] = $element;
                unset( $element );
            }
        }
        return $branch;
    }
}

if(!function_exists('menu2tree')) {
    function menu2tree( $menu_id ){
        $items = wp_get_nav_menu_items( $menu_id );
        return  $items ? buildTreeMenu( $items, 0 ) : null;
    }
}

add_filter( 'manage_pages_columns', 'add_pzp_table_columns', 10, 1 );
add_action( 'manage_pages_custom_column', 'add_pzp_table_column', 10, 2 );

function add_pzp_table_columns( $columns ) {

    $custom_columns = array(
        'template' => _x('Šablóna', 'pzp')
    );

    $columns = array_merge( $columns, $custom_columns );

    return $columns;

}

function add_pzp_table_column( $column, $post_id ) {

    if ( $column == 'template' ) {
        $available_templates = wp_get_theme()->get_page_templates();

        $template_filename = basename(get_page_template());

        echo $available_templates['templates/' . $template_filename];
    }

}

function my_acf_init() {
    acf_update_setting('google_api_key', GOOGLE_MAP_API_KEY);
}

add_action('acf/init', 'my_acf_init');

function slugify($text, string $divider = '-') {
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, $divider);
    $text = preg_replace('~-+~', $divider, $text);
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

function acf_load_obsah_field_choices( $field ) {
    $field['choices'] = array();
    
    //Get all jobs
    $request = wp_remote_get("https://ats.nalgoo.com/api/rest/job-offer?api_key=" . NALGOO_API_KEY);

    if(is_wp_error($request)) {
    } else {
        $body = wp_remote_retrieve_body( $request );
        $data = json_decode( $body );
    
        $resCategories = [];

        foreach($data as $job) {
            $request = wp_remote_get("https://ats.nalgoo.com/api/rest/job-offer/" . $job->id . "?api_key=" . NALGOO_API_KEY);

            if(is_wp_error($request)) {
            } else {
                $body = wp_remote_retrieve_body( $request );
                $data = json_decode( $body );

                $resCategories[] = $data->company;
            }
        }

        $unique = array_unique($resCategories);

        foreach($unique as $cat) {
            $field['choices'][slugify($cat)] = $cat;
        }
    }

    return $field;
    
}

add_filter('acf/load_field/name=pp_kategoriy', 'acf_load_obsah_field_choices');