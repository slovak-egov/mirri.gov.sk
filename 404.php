<?php get_header(); ?>
    
    <div class="govuk-width-container pdt-25 pdb-25">
        <div class="govuk-grid-row" id="idsk-article-pattern">
            <!-- SIDE -->
            <div class="page_404 govuk-grid-column-full text-center">
                
                <h1><?php _e('404', 'vicepremier'); ?></h1>
                <p><?php _e('Ľutujeme stránka<br/> sa nenašla','vicepremier'); ?></p>
                
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_self" class="linkBox _centered"><?php _e('Skúste sa vrátit na našu domovsku stránku', 'vicepremier'); ?> <div class="_bg"></div></a>
                
            </div>
            <!-- /.e404 -->
            
        </div>
    </div>
    <!-- /#simplePage -->

<?php get_footer(); ?>