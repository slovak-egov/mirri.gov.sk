<?php
/* 
Template Name: Cookies
*/

 get_header(); ?>

<!-- #simplePage -->
<div class="govuk-width-container pdt-25 pdb-25 strategie">
    <div class="govuk-grid-row">
        <div class="govuk-grid-column-full text-center">

            <main class="govuk-main-wrapper govuk-main-wrapper--auto-spacing" id="main-content">
                <div class="govuk-width-container">

                    <h1 class="govuk-heading-xl"><?php _e('Nastavenia cookies', 'vicepremier'); ?></h1>

                    <div class="govuk-grid-row">
                        <div class="govuk-grid-column-full govuk-body" style="text-align: left;">


                            <div class="govuk-form-group">
                                <div class="govuk-checkboxes">
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input" id="necessary-cookies" name=""
                                            type="checkbox" value="" checked disabled>
                                        <label class="govuk-label govuk-checkboxes__label" for="necessary-cookies">
                                            <?php _e('Nevyhnutne nutné súbory cookie', 'vicepremier'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="govuk-inset-text">
                                <?php _e('Sú to základné súbory cookie, ktoré umožňujú pohybovať sa po webovej stránke a používať
                                jej funkcie. Tieto súbory cookie neukladajú žiadne informácie o vás, ktoré by sa dali
                                použiť na marketing alebo na zapamätaniesi, čo ste si na internete pozerali.', 'vicepremier') ;?>
                            </div>




                            <div class="govuk-form-group">
                                <div class="govuk-checkboxes">
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input" id="ga-cookies" name="" type="checkbox"
                                            value="" checked>
                                        <label class="govuk-label govuk-checkboxes__label" for="ga-cookies">
                                            <?php _e('Analytické súbory cookie', 'vicepremier') ;?>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="govuk-inset-text">
                                <?php _e('Tieto súbory zbierajú informácie o tom, ako sa používala webová stránka, napríklad ktoré
                                stránky najčastejšie navštevujete a či sa vám zobrazili chybové hlásenia. Nezbierajú
                                informácie, na základe ktorých by bolo možné zistiť vašu totožnosť. Všetky informácie sú
                                anonymné. Používajú sa na zlepšenie funkčnosti webových stránok.', 'vicepremier') ;?>
                            </div>



                            <div class="govuk-form-group">
                                <div class="govuk-checkboxes">
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input" id="preferences-cookies" name=""
                                            type="checkbox" value="">
                                        <label class="govuk-label govuk-checkboxes__label" for="preferences-cookies">
                                            <?php _e('Preferenčné súbory cookie', 'vicepremier') ;?>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="govuk-inset-text">
                                <?php _e('V týchto súboroch sa ukladajú vaše voľby (napr. jazykové preferencie) a osobné
                                charakteristiky. Môžu sa v nich uložiť zmeny, ktoré ste na webovej stránke urobili. Dá
                                sa zabezpečiť, aby sa informácie zbierali anonymne. Na ich základe nie je možné zistiť,
                                ktoré iné webové stránky ste navštívili.', 'vicepremier') ;?>
                            </div>


                            <button type="submit" class="idsk-button save-cookie-settings" data-module="idsk-button">
                                <?php _e('Uložiť nastavenia', 'vicepremier') ;?>
                            </button>

                        </div>
                    </div>

                </div>
            </main>

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_self"
                class="linkBox _centered"><span><?php _e('Skúste sa vrátit na našu domovsku stránku', 'vicepremier'); ?></span>
                <div class="_bg"></div>
            </a>
        </div>
    </div>
</div>

<?php get_footer(); ?>