<?php
/* 
Template Name: Kontakt - formulár
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
                        
                    <h2><?php the_title(); ?></h2>
                    
                    <?php if(get_field('perex')): ?>
                        <div class="perex">
                            Ako žiadať o informácie podľa zákona č. 211/2000 Z. z. o slobodnom prístupe k informáciám:
                        </div>
                    <?php endif; ?>
                    
            </div>

            <div class="article-body pdt-15">
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
                    
                    <div class="regForm">
                                
                        <h2><?php the_field('nadpis_formularu'); ?></h2>
                        <div class="success-info hidden">
                            <?php the_field('formular_success', 'options'); ?>
                        </div>
                        <form id="kontakt-form" action="/parse-form.php" method="POST">
                            <?php global $wp; ?>
                            <input type="hidden" name="back-url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input type="hidden" name="type" value="kontakt">
                                
                            <div class="input-row">
                                <div class="input">
                                    <label for="meno"><?php _e('Meno a priezvisko*', 'vicepremier'); ?></label>
                                    <input id="meno" type="text" name="meno" placeholder="" required> 
                                </div>
                                <div class="input">
                                    <label for="obchodne_meno"><?php _e('Obchodné meno', 'vicepremier'); ?></label>
                                    <input id="obchodne_meno" type="text" name="obchodne_meno" placeholder="">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input">
                                    <label for="ulica"><?php _e('Ulica*', 'vicepremier'); ?></label>
                                    <input id="ulica" type="text" name="ulica" placeholder="">
                                </div>
                                <div class="input">
                                    <label for="cislo"><?php _e('Číslo*', 'vicepremier'); ?></label>
                                    <input id="cislo" type="text" name="cislo" placeholder="">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input">
                                    <label for="mesto"><?php _e('Mesto*', 'vicepremier'); ?></label>
                                    <input id="mesto" type="text" name="mesto" placeholder="">
                                </div>
                                <div class="input">
                                    <label for="psc"><?php _e('PSČ*', 'vicepremier'); ?></label>
                                    <input id="psc" type="text" name="psc" placeholder="">
                                </div>
                            </div>
                            <!--<div class="input-row">
                                <div class="input">
                                    <input id="telefon" type="tel" name="telefon" placeholder="<?php _e('Telefón', 'vicepremier'); ?>">
                                </div>
                                <div class="input">
                                    <input id="mail" type="email" name="mail" placeholder="<?php _e('E-mail', 'vicepremier'); ?>">
                                </div>
                            </div>-->
                            <div class="input-row">
                                <label for="sposob"><?php _e('Požadovaný spôsob poskytnutia informácií:*', 'vicepremier'); ?></label>
                                <input id="sposob" type="text" name="sposob" placeholder="">
                            </div>
                            <div class="input-row">
                                <label for="vec"><?php _e('Vec*', 'vicepremier'); ?></label>
                                <textarea id="vec" name="vec" placeholder=""></textarea>
                            </div>
                            <div class="input-row">
                                <label for="ziadost"><?php _e('Vaša žiadosť*', 'vicepremier'); ?>
                                </label>
                                <textarea id="ziadost" name="ziadost" placeholder=""></textarea>
                            </div>
                            <div class="input-row captcha-row">
                                <label for="captcha"><?php _e('Pre  overenie, že nieste  robot, vypočítajte, prosím, príklad:*', 'vicepremier'); ?></label>
                                <div class="captcha-container">
                                    <div class="captcha">
                                        <span>3</span>+<span>7</span>=
                                    </div>
                                    <div class="input">
                                        <input id="captcha" type="text" name="captcha-value">
                                    </div>
                                    <span class="questionmark">?</span>
                                </div>
                            </div>
                            <div class="input-row">
                                <p><?php _e('* Povinné pole', 'vicepremier'); ?></p>
                            </div>
                            <!--<div class="input-row">
                                <div class="checkbox">
                                    <input id="gdpr1" name="checkbox" type="checkbox">
                                    <label for="gdpr1"><?php _e('Zaškrtnutím tohto políčka potvrdzujem, že som <a href="' . get_field('subor_pre_spracovanie_osobnych_udajov', 'options') . '" target="_blank">uvedený súhlas prečítal, porozumel som mu a vyjadrujem súhlas so spracovaním mojich osobných údajov</a>', 'vicepremier'); ?> </label>
                                </div>
                            </div>-->
                            <div class="warning">
                                    <?php _e('Prosím skontrolujte správnosť zadaných údajov.', 'vicepremier'); ?>
                            </div>
                            <input name="submit" type="submit" value="<?php _e('Odoslať', 'vicepremier'); ?>">
                            
                        </form>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>