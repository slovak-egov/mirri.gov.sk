<?php
/* 
Template Name: Kontakt - text
*/

 get_header(); ?>

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
    
    <div class="govuk-width-container pdt-25 pdb-25">
        <div class="govuk-grid-row" id="idsk-article-pattern">
            <!-- SIDE -->
            <div class="govuk-grid-column-one-quarter-from-desktop custom-col-full-tablet">
                <div class="sidemenu">
                    <h2><?php _e('Kontakt', 'vicepremier'); ?></h2>
                    <button type="button" class="sidemenu_button govuk-link"><?php the_title(); ?></button>
                    <div class="sidemenu_list">
                        <div class="small-nav -alt"  role="navigation" aria-label="<?php _e('Vedľajšia navigácia', 'vicepremier'); ?>">
                            <ul>
                                <?php
                                    wp_nav_menu( array(
                                        'menu' => get_field('zobrazene_menu', 'options'),
                                        'items_wrap' => '%3$s',
                                        'container' => ""
                                    ) );
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>                    
            </div>
                    
            <!-- CONTENT -->
            <div class="govuk-grid-column-three-quarters-from-desktop custom-col-full-tablet mgt-25idsk_tablet" id="uvod">
                
                <div class="article_head box_border_bottom pdb-15">
                    <h1 class="title2"><?php the_title(); ?></h1>
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
                    <?php if(get_field('perex')): ?>
                        <div class="perex">
                            <?php the_field('perex');?>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    if( have_rows('obsah') ):

                        while ( have_rows('obsah') ) : the_row();
                            ?>
                            <?php
                            if( get_row_layout() == 'text' ):
                                ?>
                                    <div class="textPart">
                                        <?php the_sub_field('text-blok'); ?>
                                    </div>
                                <?php
                            elseif ( get_row_layout() == 'sede_ramovanie' ):
                                ?>
                                    <div class="idsk-warning-text idsk-warning-text--info">
                                        <div class="govuk-width-container">
                                            <div class="idsk-warning-text__text">
                                                <?php the_sub_field('text_sede'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            elseif ( get_row_layout() == 'odkaz' ):
                                ?>
                                    <a href="<?php echo get_sub_field('odkaz')['url']; ?>" target="<?php echo get_sub_field('odkaz')['target']; ?>" class="linkBox -big"><span><?php echo get_sub_field('odkaz')['title']; ?> </span> <div class="_bg"></div></a>
                                <?php
                            endif;
                        endwhile;
                    endif;
                    ?>
                </div>

            </div>
        </div>
    </div>


<?php get_footer(); ?>