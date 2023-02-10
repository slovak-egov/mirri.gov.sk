<?php
/* 
Template Name: Kontakt - ďalšie
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
                    <h1 class="title2 hide-mobile"><?php the_title(); ?></h1>
                </div>

                <div class="article-body pdt-15">
                                
                    <!-- .contaxt-links -->
                    <div class="contact-links">
                        
                        <?php 
                        if(have_rows('bloky_kontaktov')):
                            while(have_rows('bloky_kontaktov')):
                                the_row();
                                ?>
                                    <?php if(get_sub_field('nadpis_bloku')): ?>
                                        <h2 ><?php the_sub_field('nadpis_bloku'); ?></h2>
                                    <?php endif; ?>
                                    <!-- .c-block -->
                                    <div class="c-block">
                                        <?php
                                            if( have_rows('riadky') ):

                                                while ( have_rows('riadky') ) : the_row();
                                                    ?>
                                                    <div class="wrap">
                                                    <?php
                                                    if( get_row_layout() == 'dva_stlpce' ):
                                            
                                                        ?>
                                                            <div class="part part-two">
                                                                <?php
                                                                    while(have_rows('stlpec_1')):
                                                                        the_row();
                                                                ?>
                                                                        <?php if(get_sub_field('nadpis')): ?>
                                                                            <h2><?php the_sub_field('nadpis'); ?></h2>
                                                                        <?php endif; ?>
                                                                        <div class="person">
                                                                            <?php if(get_sub_field('meno')): ?>
                                                                            <div class="_title">
                                                                                <span class="name">
                                                                                    <?php the_sub_field('meno'); ?>
                                                                                </span>
                                                                                <?php if(get_sub_field('zivotopis')): ?>
                                                                                    <small><a href="<?php echo get_sub_field('zivotopis')['url']; ?>" target="<?php echo get_sub_field('zivotopis')['target']; ?>"><?php echo get_sub_field('zivotopis')['title']; ?></a></small>
                                                                                <?php endif; ?>
                                                                                <?php if(get_sub_field('pozicia')): ?>
                                                                                    <small><?php the_sub_field('pozicia'); ?></small>
                                                                                <?php endif; ?>

                                                                            </div>
                                                                            <?php endif; ?>
                                                                            <div class="contact-wrapper">
                                                                                <?php
                                                                                if(have_rows('kontakty')):
                                                                                    while(have_rows('kontakty')):
                                                                                        the_row();

                                                                                        printContactData(
                                                                                            get_sub_field('kontakt'),
                                                                                            get_sub_field('typ_kontakt'),
                                                                                            get_sub_field('odkaz')
                                                                                        );
                                                                                        
                                                                                    endwhile;
                                                                                endif;
                                                                                ?>
                                                                            </div>
                                                                            <?php if(get_sub_field('text_kontakty_dva_stlpce_1')): ?>
                                                                                <address class="text_contact"><?php the_sub_field('text_kontakty_dva_stlpce_1'); ?></address>
                                                                            <?php endif; ?>
                                                                            
                                                                        </div>
                                                                        
                                                                <?php
                                                                    endwhile;
                                                                ?>
                                                                
                                                            </div>
                                                            <div class="part part-two">
                                                                
                                                                <?php
                                                                    while(have_rows('stlpec_2')):
                                                                        the_row();
                                                                ?>
                                                                        <?php if(get_sub_field('nadpis')): ?>
                                                                            <h2><?php the_sub_field('nadpis'); ?></h2>
                                                                        <?php endif; ?>
                                                                        <div class="person">
                                                                                
                                                                            <?php if(get_sub_field('meno')): ?>
                                                                            <div class="_title">
                                                                                <span class="name">
                                                                                    <?php the_sub_field('meno'); ?>
                                                                                </span>
                                                                                <?php if(get_sub_field('zivotopis')): ?>
                                                                                    <small><a href="<?php echo get_sub_field('zivotopis')['url']; ?>" target="<?php echo get_sub_field('zivotopis')['target']; ?>"><?php echo get_sub_field('zivotopis')['title']; ?></a></small>
                                                                                <?php endif; ?>
                                                                                <?php if(get_sub_field('pozicia')): ?>
                                                                                    <small><?php the_sub_field('pozicia'); ?></small>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <?php endif; ?>
                                                                            <div class="contact-wrapper">
                                                                            <?php
                                                                            if(have_rows('kontakty')):
                                                                                while(have_rows('kontakty')):
                                                                                    the_row();
                                                                                    
                                                                                    printContactData(
                                                                                        get_sub_field('kontakt'),
                                                                                        get_sub_field('typ_kontakt'),
                                                                                        get_sub_field('odkaz')
                                                                                    );
                                                                                    
                                                                                endwhile;
                                                                            endif;
                                                                            ?>
                                                                            </div>
                                                                            <?php if(get_sub_field('text_kontakty_dva_stlpce_2')): ?>
                                                                                <address class="text_contact"><?php the_sub_field('text_kontakty_dva_stlpce_2'); ?></address>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        
                                                                <?php
                                                                    endwhile;
                                                                ?>
                                                                
                                                            </div>
                                                        <?php
                                            
                                                    elseif( get_row_layout() == 'jeden_odstavec' ): 
                                            
                                                        ?>
                                                            <div class="part">
                                                            <?php
                                                                while(have_rows('stlpec')):
                                                                    the_row();
                                                            ?>
                                                                    <?php if(get_sub_field('nadpis')): ?>
                                                                        <h2><?php the_sub_field('nadpis'); ?></h2>
                                                                    <?php endif; ?>
                                                                    <div class="person">
                                                                            
                                                                        <?php if(get_sub_field('meno')): ?>
                                                                        <div class="_title">
                                                                            <span class="name">
                                                                                <?php the_sub_field('meno'); ?>
                                                                            </span>
                                                                            <?php if(get_sub_field('zivotopis')): ?>
                                                                                <small><a href="<?php echo get_sub_field('zivotopis')['url']; ?>" target="<?php echo get_sub_field('zivotopis')['target']; ?>"><?php echo get_sub_field('zivotopis')['title']; ?></a></small>
                                                                            <?php endif; ?>
                                                                            <?php if(get_sub_field('pozicia')): ?>
                                                                                <small><?php the_sub_field('pozicia'); ?></small>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                        <div class="contact-wrapper">
                                                                        <?php
                                                                        if(have_rows('kontakty')):
                                                                            while(have_rows('kontakty')):
                                                                                the_row();
                                                                                
                                                                                printContactData(
                                                                                    get_sub_field('kontakt'),
                                                                                    get_sub_field('typ_kontakt'),
                                                                                    get_sub_field('odkaz')
                                                                                );
                                                                                
                                                                            endwhile;
                                                                        endif;
                                                                        ?>
                                                                        </div>
                                                                        <?php if(get_sub_field('text_kontakty_jeden_stlpec')): ?>
                                                                            <address class="text_contact"><?php the_sub_field('text_kontakty_jeden_stlpec'); ?></address>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    
                                                            <?php
                                                                endwhile;
                                                            ?>
                                                            </div>
                                                        <?php
                                            
                                                    endif;
                                                    ?>
                                                    </div>
                                                    <?php
                                                endwhile;
                                            endif;
                                        ?>
                                    </div>
                                    <!-- /.c-block -->
                                <?php
                            endwhile;
                        endif;
                        ?>
                        
                    </div>
                    <!-- /.contaxt-links -->
                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>