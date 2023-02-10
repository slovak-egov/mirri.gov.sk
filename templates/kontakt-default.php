<?php
/* 
Template Name: Kontakt
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

                </div>

                <div class="article-body pdt-15">
                    <div class="idsk-card-meta-container contact-links">
                        <?php
                        if(have_rows('kontakty')):
                            while(have_rows('kontakty')):
                                the_row();
                                ?>
                                <div data-module="idsk-address" class="idsk-address idsk-address--full-width">
                                    <hr class="idsk-address__separator-top">
                                    <div class="idsk-address__content">
                                        <div class="idsk-address__description person">
                                            <?php if(get_sub_field('vlavo')['typ'] === 'kontakt'): ?>
                                                <h2 class="govuk-heading-m"><?php echo get_sub_field('vlavo')['nadpis']; ?></h2>
                                                <div class="desc govuk-body">
                                                    <?php echo get_sub_field('vlavo')['popis']; ?>
                                                </div>
                                                <div class="desc govuk-body-s">
                                                    <?php echo get_sub_field('vlavo')['text']; ?>
                                                </div>
                                                <div class="contact-wrapper">
                                                    <?php 
                                                        if(have_rows('vlavo')):
                                                            while(have_rows('vlavo')):
                                                                the_row();
                                                                if(have_rows('kontakty')):
                                                                    while(have_rows('kontakty')):
                                                                        the_row();
                                                                        
                                                                        printContactData(
                                                                            get_sub_field('kontakt'),
                                                                            get_sub_field('typ_kontaktu'),
                                                                            get_sub_field('odkaz')
                                                                        );
                                                                        
                                                                    endwhile;
                                                                endif;
                                                            endwhile;
                                                        endif;
                                                    ?>
                                                </div>
                                            <?php else: ?>
                                            <p class="govuk-body">
                                                <?php echo get_sub_field('vlavo')['text']; ?>
                                            </p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="idsk-address__map">
                                            <a href="<?php echo get_sub_field('obsah_vpravo')['odkaz'];?>" target="_blank" class="map">
                                                <img src="<?php echo get_sub_field('obsah_vpravo')['mapa'];?>" alt="<?php _e('Adresa', 'vicepremier'); ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="idsk-address__separator-bottom"/>
                                </div>
                                <?php
                            endwhile;
                        endif;
                        ?>
                        
                        <?php if(have_rows('kontaktne_informacie_dalsie')): ?>
                            <!-- .contact-box -->
                            <div class="contact-box offsetmobile contact-links contact-links-default">
                                <div class="row">
                                    <?php 
                                        while(have_rows('kontaktne_informacie_dalsie')): 
                                            the_row();
                                    ?>
                                                <div class="col-lg-12 person">
                                                    <?php if(get_sub_field('nadpis')): ?>
                                                            <h2><?php the_sub_field('nadpis'); ?></h2>
                                                    <?php endif; ?>
                                                    <div class="contact-wrapper">
                                                        <?php
                                                        if(have_rows('kontakty')):
                                                            while(have_rows('kontakty')):
                                                                the_row();

                                                                printContactData(
                                                                    get_sub_field('kontakt'),
                                                                    get_sub_field('typ_kontaktu'),
                                                                    get_sub_field('odkaz')
                                                                );
                                                                
                                                            endwhile;
                                                        endif;
                                                        ?>
                                                    </div>
                                                    <?php if(get_sub_field('infotext')): ?>
                                                            <div class="infobox">
                                                                <p>
                                                                    <i><?php the_sub_field('infotext'); ?></i>
                                                                </p>
                                                            </div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                    <?php   
                                        endwhile;
                                    ?>
                                </div>
                            </div>
                            <!-- /.contact-box -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page -->

<?php get_footer(); ?>