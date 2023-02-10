<?php get_header(); ?>
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

    <div class="govuk-width-container pdt-25 pdt-0idsk_md pdb-25">
        <div class="govuk-grid-row" id="idsk-article-pattern">

            <!-- CONTENT -->
            <div class="govuk-grid-column-two-thirds-from-desktop" id="uvod">
                <div class="article_head box_border_bottom pdb-15">
                    <h1 class="title2"><?php the_title(); ?></h1>
                    <div class="idsk-card-meta-container">
                        <span class="idsk-card-meta idsk-card-meta-date"><a href="<?php the_permalink(); ?>" class="govuk-link" title="<?php _e('Pridané dňa', 'vicepremier'); ?>: <?php echo get_the_date('j.n.Y'); ?>"><?php echo get_the_date('j.n.Y'); ?></a></span>
                        <?php
                            $taxonomies = get_category_for_article(get_the_ID());
                            
                            foreach($taxonomies as $tax) :
                                ?>
                                <span class="idsk-card-meta idsk-card-meta-tag">
                                    <a href="<?php echo $tax->url; ?>" class="govuk-link" title="<?php echo mb_strtoupper($tax->name); ?>">
                                        <?php echo mb_strtoupper($tax->name); ?>
                                    </a>
                                </span>
                                <?php
                            endforeach;
                            
                        ?>
                    </div>
                </div>

                <div class="article-body pdt-15">
                    <?php
                        if( have_rows('obsah') ):
                        
                            while ( have_rows('obsah') ) : the_row();
                        
                                if( get_row_layout() == 'text' ):
                                ?>
                                    <?php the_sub_field('text'); ?>
                                <?php
                                elseif( get_row_layout() == 'video' ): 
                                ?>
                                    <video controls>
                                        <source src="<?php echo get_sub_field('video')['url']; ?>" type="<?php echo get_sub_field('video')['mime_type']; ?>">
                                        <p><?php _e('Váš prehliadač nepodporuje HTML5 video. Video si môžete stiahnúť tu: ', 'vicepremier'); echo get_sub_field('video')['url']; ?></p>
                                    </video>
                                <?php
                                elseif( get_row_layout() == 'obrazok' ): 
                                ?>
                                    <img src="<?php echo get_sub_field('obrazok')['url']; ?>" alt="<?php echo get_sub_field('obrazok')['alt']; ?>">
                                <?php
                                elseif( get_row_layout() == 'youtube_link' ):
                                ?>
                                    <div class="youtube-block">
                                        <div class="youtube" data-href="http://www.youtube.com/embed/<?php echo get_youtube_ID(get_sub_field('youtube_link_link')); ?>"></div>
                                    </div>
                                <?php
                                endif;
                        
                            endwhile;
                        
                        endif;
                    
                    ?>

                    <?php 

                        $images = get_field('fotogaleria_na_stiahnutie');
                        
                        if( $images ): ?>
                            <div class="button-download">
                                <a id="downloadPhotos" href="<?php echo $images['url']; ?>" download="<?php echo $images['filename']; ?>"><?php _e('Stiahnúť fotografie vo vysokej kvalite', 'vicepremier'); ?></a>
                            </div>
                        <?php endif; ?>
                        
                    <?php 

                        $images = get_field('galeria');
                        $size = 'full'; // (thumbnail, medium, large, full or custom size)
                        
                        if( $images ): ?>
                            <div class="gallery">
                                <h2><?php _e('Galéria', 'vicepremier'); ?></h2>
                                <ul>
                                    <?php foreach( $images as $image ): ?>
                                        <li>
                                            <?php
                                                $title = _x('Zobraziť fotografiu', 'vicepremier');

                                                if(isset($image['alt']) && ($image['alt'] !== '')) {
                                                    $title = $image['alt'];
                                                }
                                            ?>
                                            <a data-fancybox="gallery"  class="replaced-image cover" href="<?php echo $image['sizes']['large']; ?>" target="_self" title="<?php echo $title; ?>">
                                                <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $title; ?>"/>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                </div>

            </div>

            <!-- SIDE -->
            <div class="govuk-grid-column-one-third-from-desktop" data-module="idsk-in-page-navigation">
                <?php
                    $aktualityTyp = get_field('aktuality');
                    
                    $aktuality = null;
                    $vybrataKategoria = null;
                    
                    switch($aktualityTyp) {
                        case 'najnovsie':
                            $args = array(
                                'post_type' => 'clanky',
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'posts_per_page' => 6,
                                'post_status' => 'publish'
                            );
                            $aktuality = new WP_Query( $args );
                            break;
                        case 'najnovsie-z-temy':
                            $tags = wp_get_post_tags(get_the_ID());
                            $tagIn = [];
                            
                            foreach($tags as $tag) {
                                $tagIn[] = $tag->term_id;
                            }
                            
                            $args = array(
                                'post_type' => 'clanky',
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'posts_per_page' => 6,
                                'post_status' => 'publish',
                                'tag__in' => $tagIn
                            );
                            $aktuality = new WP_Query( $args );
                            break;
                        case 'najnovsie-kategoria':
                            $kategorie = get_category_for_article(get_the_ID());
                            
                            $args = array(
                                'post_type' => 'clanky',
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'posts_per_page' => 6,
                                'post_status' => 'publish',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'kategorie-sekcie',
                                        'field' => 'term_id',          
                                        'terms' => $kategorie[0]->id,                  
                                    )
                                )
                            );
                            $aktuality = new WP_Query( $args );
                            $vybrataKategoria = $kategorie[0];
                            
                            break;
                        case 'vybrane':
                            if(have_rows('vybrate_aktuality')):
                                ?>
                                    <div class="box_news_list">
                                        <h2><?php _e('Aktuality', 'vicepremier'); ?></h2>
                                                
                                        <?php
                                        while(have_rows('vybrate_aktuality')):
                                            the_row();
                                            
                                            get_template_part('templates/parts/aktualita-small', null, array(
                                                'id' => get_sub_field('aktualita'),
                                                'cat' => $vybrataKategoria
                                            ));
                                        endwhile;
                                        ?>
                                        
                                    </div>
                                <?php
                            endif;
                            break;
                    }
                    
                ?>
                
                <?php 
                    if(isset($aktuality) && $aktuality->have_posts()): 
                ?>
                    <div class="box_news_list">
                        <h2><?php _e('Aktuality', 'vicepremier'); ?></h2>
                                
                        <?php   
                            $currentId = get_the_ID();
                            
                            while($aktuality->have_posts()): 
                                $aktuality->the_post(); 
                                if($currentId == get_the_ID()) {
                                    continue;
                                }
                                
                                get_template_part('templates/parts/aktualita-small', null, array(
                                    'id' => get_the_ID(),
                                    'cat' => $vybrataKategoria
                                ));
                            endwhile;
                        ?>
                        
                    </div>
                    <?php
                    endif;
                    wp_reset_query();
                ?>
            </div>

        </div>
        <div class="grid">
            <?php
                $aktualityTyp = get_field('vyber_clankov');
                
                $aktuality = null;
                $vybrataKategoria = null;
                
                switch($aktualityTyp) {
                    case 'najnovsie':
                        $args = array(
                            'post_type' => 'clanky',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => 6,
                            'post_status' => 'publish'
                        );
                        $aktuality = new WP_Query( $args );
                        break;
                    case 'najnovsie-z-temy':
                        $tags = wp_get_post_tags(get_the_ID());
                        $tagIn = [];
                        
                        foreach($tags as $tag) {
                            $tagIn[] = $tag->term_id;
                        }
                        
                        $args = array(
                            'post_type' => 'clanky',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'tag__in' => $tagIn
                        );
                        $aktuality = new WP_Query( $args );
                        break;
                    case 'najnovsie-kategoria':
                        $kategorie = get_category_for_article(get_the_ID());
                        
                        $args = array(
                            'post_type' => 'clanky',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'kategorie-sekcie',
                                    'field' => 'term_id',          
                                    'terms' => $kategorie[0]->id,                  
                                )
                            )
                        );
                        $aktuality = new WP_Query( $args );
                        $vybrataKategoria = $kategorie[0];
                        
                        break;
                    case 'vybrate':
                        if(have_rows('clanky')):
                            ?>
                                <div class="govuk-grid-column-full">
                                    <h2><?php _e('Odporúčané články', 'vicepremier'); ?></h2>
                                </div>
                                <?php
                                while(have_rows('clanky')):
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
                };
            ?>
                
            <?php 
                if(isset($aktuality) && $aktuality->have_posts()): 
            ?>
                <div class="govuk-grid-column-full">
                    <h2><?php _e('Odporúčané články', 'vicepremier'); ?></h2>
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

<?php get_footer(); ?>