            </div>

        </main>
        <!-- /#main -->
        

        <!-- FOOTER -->
        <div data-module="idsk-footer-extended">
            <footer class="idsk-footer-extended  idsk-footer-extended--up-button-enabled " role="contentinfo">
                <div class="idsk-footer-extended-up-button-div" id="footer-extended-up-button">
                    <div class="govuk-width-container">
                        <div class="govuk-grid-column-full">
                            <a href="#" role="button" draggable="false"
                                class="idsk-button idsk-button--start idsk-footer-extended-up-button-a"
                                data-module="idsk-button">
                                <svg class="idsk-footer-extended__up-button-svg" width="20" height="15" viewbox="0 0 20 15"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 5.5984L0 15L0 9.40174L10 0L10 5.5984Z"
                                        fill="white" />
                                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M20 9.4016L10 0V5.59826L20 15V9.4016Z" fill="white" />
                                </svg>
                                <?php _e('Hore', 'vicepremier'); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="idsk-footer-extended-main-content">
                    <div class="govuk-width-container">
                        
                        <div class="footer_thirds">
                            <?php for($i = 1; $i <= 3; $i++): ?>
                                <div class="govuk-grid-column-one-third">
                                    <?php
                                        if(get_field('stlpec_' . $i, 'options')['zobrazit'] == 'text'):
                                    ?>
                                        <?php echo get_field('stlpec_' . $i, 'options')['text']; ?>
                                    <?php 
                                        else: 
                                    ?>
                                        <h3 class="govuk-heading-m">
                                            <?php echo get_field('stlpec_' . $i, 'options')['nadpis_menu']; ?>
                                        </h3>
                                        <div class="govuk-grid-column-three-thirds idsk-footer-extended-subtitle">
                                            <ul>
                                                <?php
                                                $nav = wp_get_nav_menu_items(get_field('stlpec_' . $i, 'options')['menu']);
                                                
                                                foreach($nav as $item): 
                                                    ?>
                                                    <li class="idsk-footer-extended-list-item">
                                                        <a 
                                                            class="govuk-link" 
                                                            href="<?php echo $item->url; ?>"  
                                                            title="<?php echo $item->title; ?>"
                                                        >
                                                            <?php echo $item->title; ?>
                                                        </a>
                                                    </li>
                                                    <?php 
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    <?php 
                                        endif; 
                                    ?>
                                </div>
                            <?php endfor; ?>  
                            <div class="govuk-grid-column-full">
                                <div class="idsk-footer-extended-description-panel idsk-footer-extended-subtitle mgt-30">
                                    <div class="footer_thirds">
                                    
                                        <div class="govuk-grid-column-two-thirds govuk-grid-column-two-thirds-lgm idsk-footer-extended-info-links">   
                                            
                                            <div class="pdt-30 pdb-30 idsk-footer-text footer-text-sub">
                                                <?php the_field('paticka_dole_text', 'options'); ?>
        
                                                <ul class="idsk-footer-extended-inline-list ">       
                                                    <?php
                                                    $nav = wp_get_nav_menu_items(get_field('paticka_dole', 'options'));
                                                    
                                                    foreach($nav as $item): 
                                                        ?>
                                                        <li class="idsk-footer-extended-inline-list-item">
                                                            <a 
                                                                class="govuk-link"
                                                                href="<?php echo $item->url; ?>"  
                                                                title="<?php echo $item->title; ?>"
                                                            >
                                                                <?php echo $item->title; ?>
                                                            </a>
                                                        </li>
                                                        <?php 
                                                    endforeach;
                                                    ?>                               
                                                </ul>
                                            </div>
                                            
                                        </div>
                                        <div class="govuk-grid-column-one-third govuk-grid-column-one-third-lgm idsk-footer-extended-logo-box footer_logos">

                                            <div class="pdt-30  pdt-0lg pdb-30">
                                                <?php 

                                                if(have_rows('paticka_vpravo', 'options')):
                                                    while(have_rows('paticka_vpravo', 'options')):
                                                        the_row();
                                                        ?>
                                                        <a href="<?php echo get_sub_field('odkaz')['url']; ?>" title="<?php echo get_sub_field('odkaz')['title']; ?>">
                                                            <img class="footer_logo2" src="<?php echo get_sub_field('logo')['url']; ?>" alt="<?php echo get_sub_field('logo')['alt']; ?>">
                                                        </a>
                                                        <?php
                                                    endwhile;
                                                endif;

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- END FOOTER -->

        <!-- Root element of PhotoSwipe. Must have class pswp. -->
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

            <!-- Background of PhotoSwipe. 
                It's a separate element as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>

            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">

                <!-- Container that holds slides. 
                    PhotoSwipe keeps only 3 of them in the DOM to save memory.
                    Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>

                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">

                    <div class="pswp__top-bar">

                        <!--  Controls are self-explanatory. Order can be changed. -->

                        <div class="pswp__counter"></div>

                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                        <button class="pswp__button pswp__button--share" title="Share"></button>

                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                        <!-- element will get class pswp__preloader--active when preloader is running -->
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div> 
                    </div>

                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                    </button>

                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                    </button>

                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>

                </div>

            </div>

        </div>
        
        <?php wp_footer(); ?>

        <script>window.GOVUKFrontend.initAll()</script>

</body>
</html>