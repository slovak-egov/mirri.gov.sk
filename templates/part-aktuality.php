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

<?php
    global $wp;
            
    $currentUrl = home_url( $wp->request );
    
    $queriedObject = get_queried_object();
?>
<div class="govuk-width-container pdt-25 pdb-25">
    <div class="govuk-grid-row" id="idsk-article-pattern">

        <!-- SIDE -->
        <div class="govuk-grid-column-one-quarter-from-desktop custom-col-full-tablet">
            <div class="sidemenu">
                <button type="button" class="sidemenu_button govuk-link"><?php _e('Novinky', 'vicepremier'); ?></button>
                <ul class="sidemenu_list">
                    <li class="">
                        <a href="<?php echo str_replace(home_url('/'), '/', get_permalink( get_option( 'page_for_posts' ) )); ?>" title="<?php _e('Všetky aktuality', 'vicepremier'); ?>" class="govuk-link"><?php _e('Všetky aktuality', 'vicepremier'); ?></a>
                    </li>
                    <?php 
                        $terms = get_terms( array(
                            'taxonomy' => 'kategorie-sekcie',
                            'hide_empty' => true,
                        ) );
                                    
                        foreach($terms as $term) :
                            $args = array(
                                'post_type' => 'clanky',
                                'post_status' => 'publish',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'kategorie-sekcie',
                                        'field' => 'term_id',          
                                        'terms' => $term->term_id,                  
                                    )
                                )
                            );
                            
                            $the_query = new WP_Query( $args );

                            // The Loop
                            if ( $the_query->have_posts() ) {
                                $selected = "";
                                    if(($queriedObject instanceof WP_Term) && (get_term_link( $queriedObject) == get_term_link($term->term_id))) {
                                        $selected = 'active';
                                    }
                                ?>
                                    <li class="<?php echo $selected; ?>">
                                        <a href="<?php echo str_replace(home_url('/'), '/', get_term_link($term->term_id)); ?>" title="<?php echo $term->name; ?>" class="govuk-link"><?php echo $term->name; ?></a>
                                    </li>
                                <?php
                                wp_reset_postdata();
                            }
                        
                        endforeach;
                    ?>
                </ul>
            </div>                    
        </div>

        <!-- CONTENT -->
        <div class="govuk-grid-column-three-quarters-from-desktop custom-col-full-tablet mgt-25idsk_tablet">
        <?php

            $pageNum = 1;


            $explodedUrl = array_filter(explode('/',$currentUrl));

            if(in_array('page', $explodedUrl)) {
                $pageNum = $explodedUrl[sizeof($explodedUrl)];  
            }

            $argsPage = array();
            $argsTotal = array();
            $title = null;
            $vybrataKategoria = null;

            if ($queriedObject instanceof WP_Post_Type) {                    
                $argsPage = array(
                    'post_type' => 'clanky',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post_status' => 'publish'
                );
                $argsTotal = $argsPage;
                
                $argsPage['posts_per_page'] = 6;
                $argsPage['paged'] = $pageNum;
                
                $title = $queriedObject->label;
                
            } else if ($queriedObject instanceof WP_Term) {
                $vybrataKategoria = new  stdClass();
                $vybrataKategoria->url = get_term_link( $queriedObject);
                $vybrataKategoria->name = $queriedObject->name;
                $vybrataKategoria->id = $queriedObject->term_id;
                
                
                $argsPage = array(
                    'post_type' => 'clanky',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'kategorie-sekcie',
                            'field' => 'term_id',          
                            'terms' => $queriedObject->term_id,                  
                        )
                    )
                );
                
                $argsTotal = $argsPage;
                $argsPage['posts_per_page'] = 6;
                
                $argsPage['paged'] = $pageNum;
                
                $title = $queriedObject->name;
            }

            $totalPosts = new WP_Query( $argsTotal );
            $totalPosts = $totalPosts->found_posts;

        ?>
            <h1><?php  echo $title; ?></h1>
            <div class="grid mid-space">
                <?php 
                    $aktuality = new WP_Query($argsPage);
                    if(isset($aktuality) && $aktuality->have_posts()): 
                        while($aktuality->have_posts()): 
                            $aktuality->the_post(); 
                            ?>     
                                <div class="col2 col1_idsk_md mgb-30">
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

            <div class="govuk-width-container pdt-20 pdb-50">
                <nav class="pagination" role="navigation" aria-label="pagination">
                    <ul>
                        <?php
                            $arraySplitted = array_filter(explode('/', $currentUrl));
                            if(in_array('page', $arraySplitted)) {
                                $currentUrl = $arraySplitted;
                                $currentUrl[0] .= '/';
                                array_splice($currentUrl, -2);
                                $currentUrl = join('/', $currentUrl);
                            }

                            $currentUrl = rtrim($currentUrl, '/');
                            // echo '<!--' . print_r($currentUrl, 1) . '-->';

                            if($totalPosts > 6) {
                                $totalPages = ceil($totalPosts / 6);
                                
                                $previousPageUrl = (($pageNum > 1)?$currentUrl . '/page/' . ($pageNum-1) : null) ;
                                $nextPageUrl = (($totalPages>$pageNum)?$currentUrl . '/page/' . ($pageNum+1) : null);
                                $availablePages = [
                                    $pageNum-2,
                                    $pageNum-1,
                                    $pageNum,
                                    $pageNum+1,
                                    $pageNum+2
                                ];

                                $pages = [];

                                foreach($availablePages as $p) {
                                    if($p > 0 && $p <= $totalPages) {
                                        $pages[] = $p;
                                    }
                                }

                                ?>
                                    <?php if(!is_null($previousPageUrl)): ?>
                                        <li class="prev_parent"><a href="<?php echo $previousPageUrl; ?>" aria-label="<?php _e('Prejsť na predošlú stránku', 'vicepremier'); ?>" class="pagination_prev idsk-button idsk-button--secondary"><span class="visuallyhidden"><?php _e('Predošlá stránka', 'vicepremier'); ?></span></a></li>
                                    <?php endif; ?>
                                    <?php
                                    foreach($pages as $p):
                                        if($p > 0 && $p <= $totalPages):
                                            ?>
                                            <li class="<?php echo $p === $pageNum?'current_parent':''; ?>">
                                                <a href="<?php echo $currentUrl . '/page/' . $p; ?>" aria-label="<?php _e('Prejsť na stránku', 'vicepremier'); ?> <?php echo $p; ?>" <?php echo $p === $pageNum?'aria-current="true"':''; ?> class="pagination_button idsk-button idsk-button--secondary">
                                                    <?php echo $p; ?>
                                                </a>
                                            </li>
                                            <?php
                                        endif;
                                    endforeach;
                                    ?>
                                    <?php if(!is_null($nextPageUrl)): ?>
                                        <li class="next_parent"><a href="<?php echo $nextPageUrl; ?>" aria-label="<?php _e('Prejsť na ďalšiu stránku', 'vicepremier'); ?>"  class="pagination_next idsk-button idsk-button--secondary"><span class="visuallyhidden"><?php _e('Nasledujúca stránka', 'vicepremier'); ?></span></a></li>
                                    <?php endif; ?>
                                <?php
                            } else {
                                ?>
                                    <!-- <li class="prev_parent"><a href="<?php echo $currentUrl; ?>" aria-label="<?php _e('Prejsť na prvú stránku', 'vicepremier'); ?>" disabled aria-disabled="true" class="pagination_prev idsk-button idsk-button--secondary"><span class="visuallyhidden"><?php _e('Predošlá stránka', 'vicepremier'); ?></span></a></li> -->
                                    <li><a href="<?php echo $currentUrl; ?>" aria-label="<?php _e('Prejsť na stránku', 'vicepremier'); ?> 1" class="pagination_button idsk-button idsk-button--secondary">1</a></li>
                                    <!-- <li class="next_parent"><a href="<?php echo $currentUrl; ?>" aria-label="<?php _e('Prejsť na poslednú stránku', 'vicepremier'); ?>" disabled aria-disabled="true" class="pagination_next idsk-button idsk-button--secondary"><span class="visuallyhidden"><?php _e('Nasledujúca stránka', 'vicepremier'); ?></span></a></li> -->
                                <?php
                            }
                        ?>
                    </ul>
                </nav>
            </div>

        </div>

    </div>
</div>