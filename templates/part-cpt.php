<div class="listing_head govuk-width-container pdt-25">
    <div class="govuk-breadcrumbs">
        <nav class="breadcrumb" aria-label="<?php _e('Nachádzate sa tu', 'vicepremier'); ?>:">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>

        </nav>
    </div>
</div>
<script>
    var experts = []
</script>
<?php
    $taxonomy = get_category_for_article(get_the_ID())[0]; 
    $id = get_the_ID();
    $showSidebar = false;
    $sidebarTitle = null;
    $sidebarLink = null;
    $sidebarMenu = null;

    $strankaKariery = get_field('stranka_kariery', 'options_kariera');
    $strankaKarieryEn = get_field('stranka_kariery', 'options_kariera_en');
    $strankaPlanuObnovy = get_field('stranka_plan_obnovy', 'options_plan_obnovy');

    if(empty($taxonomy)) {            
        $terms = get_terms('kategorie-sekcie');
        
        foreach($terms as $term) {
            $strankaId = get_field('stranka_kategorie', $term);

            if($strankaId == $id || $id == $strankaKariery || $id == $strankaPlanuObnovy || $id == $strankaKarieryEn ) {

                $taxonomy = new  stdClass();
                $taxonomy->url = get_term_link($term->term_id);
                $taxonomy->name = get_the_category_by_ID($term->term_id);
                $taxonomy->id = $term->term_id;
            }
        }
    }

    if(
        empty($taxonomy) || 
        $id === $strankaKariery || 
        $id === $strankaKarieryEn ||
        is_singular('kariera') || 
        is_singular('kariera_en') || 
        $id === $strankaPlanuObnovy || 
        is_singular('plan_obnovy')
    ) {   
        if(ICL_LANGUAGE_CODE === 'en') {
            $strankaKariery = apply_filters( 'wpml_object_id', $strankaKariery, 'post', false, 'en' );
        }

        if($id === $strankaKariery || is_singular('kariera')) {
            $showSidebar = true;
            $sidebarTitle = get_the_title($strankaKariery);
            $sidebarLink = get_permalink($strankaKariery);
            $sidebarMenu = get_field('menu_kariery', 'options_kariera');
        }

        if($id === $strankaKarieryEn || is_singular('kariera_en')) {
            $showSidebar = true;
            $sidebarTitle = get_the_title($strankaKarieryEn);
            $sidebarLink = get_permalink($strankaKarieryEn);
            $sidebarMenu = get_field('menu_kariery', 'options_kariera_en');
        }

        if($id === $strankaPlanuObnovy || is_singular('plan_obnovy')) {

            $showSidebar = true;
            $sidebarTitle = get_the_title($strankaPlanuObnovy);
            $sidebarLink = get_permalink($strankaPlanuObnovy);
            $sidebarMenu = get_field('menu_plan_obnovy', 'options_plan_obnovy');

            $termTaxonomy = get_field('hlavna_kategoria_clankov', 'options_plan_obnovy');

            $taxonomy = new stdClass();
            $taxonomy->url = get_term_link($termTaxonomy->term_id);
            $taxonomy->name = get_the_category_by_ID($termTaxonomy->term_id);
            $taxonomy->id = $termTaxonomy->term_id;
        }
    } else {
        $showSidebar = true;
        $sidebarTitle = $taxonomy->name;
        $sidebarLink = get_permalink(get_field('stranka_kategorie',get_term($taxonomy->id)));
        $sidebarMenu = get_field('menu', get_term($taxonomy->id));
    }

?>

<div class="govuk-width-container pdt-25 pdb-25">
    <div class="govuk-grid-row" id="idsk-article-pattern">

        <!-- SIDE -->
        <div class="govuk-grid-column-one-quarter-from-desktop custom-col-full-tablet">
            <div class="sidemenu">
                <h2><?php echo $sidebarTitle; ?></h2>
                <button type="button" class="sidemenu_button govuk-link"><?php the_title(); ?></button>
                <div class="sidemenu_list">
                    <div class="small-nav -alt"  role="navigation" aria-label="<?php _e('Vedľajšia navigácia', 'vicepremier'); ?>">
                        <ul>
                            <?php
                                wp_nav_menu( array(
                                    'menu' => $sidebarMenu,
                                    'items_wrap' => '%3$s',
                                    'container' => ""
                                ) );
                            ?>
                        </ul>
                        <?php
                            if(get_field('zobrazit_odkaz_pod_menu', get_term($taxonomy->id))):
                                while(have_rows('odkazy', get_term($taxonomy->id))):
                                    the_row();
                                    ?>
                                        <!-- .blueBox -->
                                        <div class="blueBox">
                                            <a href="<?php echo get_sub_field('odkaz')['url']; ?>" target="<?php echo get_sub_field('odkaz')['target']; ?>"><span><?php the_sub_field('nadpis'); ?></span></a>
                                        </div>
                                        <!-- /.blueBox -->
                                    <?php
                                endwhile;
                            endif;
                        ?>
                    </div>
                </div>
            </div>                    
        </div>

        <!-- CONTENT -->
        <div class="govuk-grid-column-three-quarters-from-desktop custom-col-full-tablet mgt-25idsk_tablet" id="uvod">
            
            <div class="article_head box_border_bottom pdb-15">
                <h1 class="title2 hide-mobile"><?php the_title(); ?></h1>
                <?php
                    if(get_field('zobrazit_aktualizaciu')):
                ?>
                    <div class="idsk-card-meta-container">
                        <span class="idsk-card-meta idsk-card-meta-date">
                            <?php the_field('text_aktualizacie'); echo " "; ?>
                            <?php the_modified_time('j. F Y, G:i'); ?>
                        </span>              
                    </div>
                <?php 
                    endif; 
                ?>      
            </div>

            <div class="article-body pdt-15">
                <?php
                    if(get_field('perex')):
                ?>
                        <div class="govuk-body-l">
                            <?php the_field('perex'); ?>
                        </div>
                <?php 
                    endif; 
                ?>    
                <?php
                    if( have_rows('obsah') ):
                    
                        while ( have_rows('obsah') ) : the_row();
                    
                            if( get_row_layout() == 'text' ):
                            ?>
                                <div class="textPart">
                                    <?php the_sub_field('text2'); ?>
                                </div>
                            <?php
                            elseif( get_row_layout() == 'odkaz' ): 
                            ?>
                                <a href="<?php echo get_sub_field('odkaz2')['url']; ?>" target="<?php echo get_sub_field('odkaz2')['target']; ?>" class="linkBox -big">
                                    <span><?php echo get_sub_field('odkaz2')['title']; ?>
                                    <?php echo getFileInfoInString(get_sub_field('odkaz2')['url']); ?></span>
                                    <div class="_bg"></div>
                                </a>
                            <?php
                            elseif( get_row_layout() == 'zoznam' ):
                            ?>
                                <div class="linksBox">
                                    <ul>
                                        <?php
                                            while(have_rows('zoznam2')): 
                                                the_row();
                                                ?>
                                                <li><?php the_sub_field('text'); ?></li>
                                                <?php
                                            endwhile;
                                        ?>
                                    </ul>
                                    <div class="_bg"></div>
                                </div>
                            <?php
                            elseif( get_row_layout() == 'youtube_link' ):
                            ?>
                                <div class="youtube-block">
                                    <div class="youtube" data-href="http://www.youtube.com/embed/<?php echo get_youtube_ID(get_sub_field('youtube_link_link')); ?>"></div>
                                </div>
                            <?php
                            elseif( get_row_layout() == 'tabulka_expertov'):
                                get_template_part('templates/parts/tabulka-expertov');
                            elseif( get_row_layout() == 'pracovne_pozicie'):
                                get_template_part('templates/parts/part-kariera-external');
                            endif;
                    
                        endwhile;
                    
                    endif;
                
                ?> 
            </div>

        </div>

    </div>
    
</div>
<div class="govuk-width-container">
    <div class="grid">
        <?php
            $aktualityTyp = get_field('vyber_aktualit');
            $aktuality = null;
            $vybrataKategoria = null;
            
            switch($aktualityTyp) {
                case 'najnovsie':
                    $args = array(
                        'post_type' => 'clanky',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => 4,
                        'post_status' => 'publish'
                    );
                    $aktuality = new WP_Query( $args );
                    break;
                case 'najnovsie-kategoria':
                    $kategorie = $taxonomy;
                    
                    $args = array(
                        'post_type' => 'clanky',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => 4,
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'kategorie-sekcie',
                                'field' => 'term_id',          
                                'terms' => $kategorie->id,                  
                            )
                        )
                    );
                    
                    $aktuality = new WP_Query( $args );
                    
                    $vybrataKategoria = $kategorie;
                    
                    break;
                case 'vybrane':
                    if(have_rows('manualne_aktuality')):
                        ?>
                            <div class="govuk-grid-column-full">
                                <h2><?php _e('Aktuality', 'vicepremier'); ?></h2>
                            </div>
                            <?php
                                while(have_rows('manualne_aktuality')):
                                    the_row();
                                    ?>
                                    <div class="govuk-grid-column-one-quarter">
                                        <?php
                                        get_template_part('templates/parts/aktualita-bigger', null, array(
                                            'id' => get_sub_field('clanok'),
                                            'addedClass' => 'mgt-10',
                                            'cat' => $vybrataKategoria
                                        ));
                                        ?>
                                    </div>
                                    <?php
                                endwhile;
                            ?>
                        <?php
                    endif;
                    break;
            }
            
        ?>

        <?php 
            if(isset($aktuality) && $aktuality->have_posts()): 
        ?>
            <div class="govuk-grid-column-full">
                <h2><?php _e('Aktuality', 'vicepremier'); ?></h2>
            </div>
            <?php 
            
                $currentId = get_the_ID();
                
                while($aktuality->have_posts()): 
                    $aktuality->the_post(); 
                    if($currentId == get_the_ID()) {
                        continue;
                    }
                    ?>
                    <div class="col4 col1_idsk_md mgb-30">
                        <?php
                        get_template_part('templates/parts/aktualita-bigger', null, array(
                            'id' => get_the_ID(),
                            'addedClass' => 'mgt-10',
                            'cat' => $vybrataKategoria
                        ));
                        ?>
                    </div>
                    <?php
                endwhile;
            endif;
            wp_reset_query();
        ?>
    </div>
</div>