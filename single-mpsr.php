<?php

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

<?php
$taxonomy = get_category_for_article(get_the_ID())[0];

if(empty($taxonomy)) {
    $id = get_the_ID();

    $terms = get_terms('kategorie-sekcie');

    foreach($terms as $term) {
        if(get_field('stranka_kategorie', $term) == $id) {
            $taxonomy = new  stdClass();
            $taxonomy->url = get_term_link($term->term_id);
            $taxonomy->name = get_the_category_by_ID($term->term_id);
            $taxonomy->id = $term->term_id;
        }
    }
}
?>
<div class="govuk-width-container pdt-25 pdb-25 mpsr">
    <div class="govuk-grid-row" id="idsk-article-pattern">

        <!-- SIDE -->
        <div class="govuk-grid-column-one-quarter-from-desktop custom-col-full-tablet">
            <div class="sidemenu">
                <h2><?php echo (empty($taxonomy)) ? the_title() : $taxonomy->name; ?></h2>
                <button type="button" class="sidemenu_button govuk-link"><?php the_title(); ?></button>
                <div class="sidemenu_list">
                    <div class="small-nav -alt"  role="navigation" aria-label="<?php _e('Vedľajšia navigácia', 'vicepremier'); ?>">
                        <ul>
                            <?php
                            wp_nav_menu( array(
                                'menu' => get_field('menu', get_term($taxonomy->id)),
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
                    <div class="perex">
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
                        elseif( get_row_layout() == 'formular' ):
                            ?>
                            <div class="regForm">

                                <h2><?php the_sub_field('nadpis_formulara'); ?></h2>
                                <div class="success-info hidden">
                                    <?php the_field('formular_success', 'options'); ?>
                                </div>

                                <form id="work-form" action="/parse-form.php" method="POST">
                                    <?php global $wp; ?>
                                    <input type="hidden" name="back-url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                    <input type="hidden" name="type" value="pripravovane-pozicie">

                                    <div class="input-row">
                                        <div class="input">
                                            <label for="meno"><?php _e('Meno*', 'vicepremier'); ?></label>
                                            <input id="meno" type="text" name="meno" placeholder="<?php _e('Meno', 'vicepremier'); ?>">
                                        </div>
                                        <div class="input">
                                            <label for="mail"><?php _e('E-mail*', 'vicepremier'); ?></label>
                                            <input id="mail" type="email" name="mail" placeholder="<?php _e('E-mail', 'vicepremier'); ?> *">
                                        </div>
                                    </div>

                                    <br>

                                    <p><?php the_sub_field('text_nad_nadpisom'); ?></p>

                                    <br>
                                    <div class="input-row">
                                        <?php
                                        while(have_rows('pozicie')):
                                            the_row();
                                            $b64 =  base64_encode(get_sub_field('test'));
                                            ?>
                                            <div class="checkbox position">
                                                <input id="position_<?php echo $b64; ?>" name="position_<?php echo $b64; ?>" type="checkbox">
                                                <label for="position_<?php echo $b64; ?>">
                                                    <?php the_sub_field('test'); ?>
                                                    <?php if(get_sub_field('info')): ?>
                                                        <div class="info">
                                                                        <span class="icon-info">
                                                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                                                    viewBox="0 0 437.6 437.6" style="enable-background:new 0 0 437.6 437.6;" xml:space="preserve">
                                                                            <g> <g>  <g> <path d="M194,142.8c0.8,1.6,1.6,3.2,2.4,4.4c0.8,1.2,2,2.4,2.8,3.6c1.2,1.2,2.4,2.4,4,3.6c1.2,0.8,2.8,2,4.8,2.4
                                                                                            c1.6,0.8,3.2,1.2,5.2,1.6c2,0.4,3.6,0.4,5.2,0.4c1.6,0,3.6,0,5.2-0.4c1.6-0.4,3.2-0.8,4.4-1.6h0.4c1.6-0.8,3.2-1.6,4.8-2.8
                                                                                            c1.2-0.8,2.4-2,3.6-3.2l0.4-0.4c1.2-1.2,2-2.4,2.8-3.6s1.6-2.4,2-4c0-0.4,0-0.4,0.4-0.8c0.8-1.6,1.2-3.6,1.6-5.2
                                                                                            c0.4-1.6,0.4-3.6,0.4-5.2s0-3.6-0.4-5.2c-0.4-1.6-0.8-3.2-1.6-5.2c-1.2-2.8-2.8-5.2-4.8-7.2c-0.4-0.4-0.4-0.4-0.8-0.8
                                                                                            c-1.2-1.2-2.4-2-4-3.2c-1.6-0.8-2.8-1.6-4.4-2.4c-1.6-0.8-3.2-1.2-4.8-1.6c-2-0.4-3.6-0.4-5.2-0.4c-1.6,0-3.6,0-5.2,0.4
                                                                                            c-1.6,0.4-3.2,0.8-4.8,1.6H208c-1.6,0.8-3.2,1.6-4.4,2.4c-1.6,1.2-2.8,2-4,3.2c-1.2,1.2-2.4,2.4-3.2,3.6
                                                                                            c-0.8,1.2-1.6,2.8-2.4,4.4c-0.8,1.6-1.2,3.2-1.6,4.8c-0.4,2-0.4,3.6-0.4,5.2c0,1.6,0,3.6,0.4,5.2
                                                                                            C192.8,139.6,193.6,141.2,194,142.8z"/>
                                                                                        <path d="M249.6,289.2h-9.2v-98c0-5.6-4.4-10.4-10.4-10.4h-42c-5.6,0-10.4,4.4-10.4,10.4v21.6c0,5.6,4.4,10.4,10.4,10.4h8.4v66.4
                                                                                            H188c-5.6,0-10.4,4.4-10.4,10.4v21.6c0,5.6,4.4,10.4,10.4,10.4h61.6c5.6,0,10.4-4.4,10.4-10.4V300
                                                                                            C260,294,255.2,289.2,249.6,289.2z"/>
                                                                                        <path d="M218.8,0C98,0,0,98,0,218.8s98,218.8,218.8,218.8s218.8-98,218.8-218.8S339.6,0,218.8,0z M218.8,408.8
                                                                                            c-104.8,0-190-85.2-190-190s85.2-190,190-190s190,85.2,190,190S323.6,408.8,218.8,408.8z"/>
                                                                                    </g>  </g>  </g>   <g>   </g>  <g> </g>  <g>  </g>  <g>   </g>  <g>   </g>  <g>  </g>   <g>    </g>   <g>    </g>   <g>  </g>  <g>  </g>  <g>   </g>   <g>   </g>   <g>  </g>  <g>   </g>  <g>  </g>
                                                                            </svg>

                                                                        </span>
                                                            <div class="content">
                                                                <?php the_sub_field('info'); ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </label>

                                            </div>
                                        <?php
                                        endwhile;
                                        ?>
                                    </div>
                                    <style>input[type="checkbox"].error ~ label:before{ background: #ffd7da !important;}</style>
                                    <br>
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
                                    <br>
                                    <div class="input-row">
                                        <div class="checkbox">
                                            <input id="gdpr1" name="gdpr1" type="checkbox" required>
                                            <label for="gdpr1"><?php _e('Mám záujem o zasielanie informácií o aktuálne vyhlásených výberových konaniach', 'vicepremier'); ?>. *</label>
                                        </div>
                                    </div>
                                    <div class="input-row">
                                        <div class="checkbox">
                                            <input id="gdpr2" name="gdpr2" type="checkbox" required>
                                            <label for="gdpr2"><?php _e('Súhlasím s', 'vicepremier'); ?>&nbsp;
                                                <a href="<?php the_sub_field('osobne_udaje'); ?>"><?php _e('podmienkami ochrany osobných údajov', 'vicepremier'); ?></a>. *
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-row">
                                        <p><?php _e('* Povinné pole', 'vicepremier'); ?></p>
                                    </div>
                                    <div id="warning" class="warning">
                                        <?php _e('Prosím skontrolujte správnosť zadaných údajov.', 'vicepremier'); ?>
                                    </div>
                                    <div id="warning-work" class="warning">
                                        <?php  _e('Prosím vyberte aspoň jednu pozíciu.', 'vicepremier'); ?>
                                    </div>
                                    <input name="submit" type="submit" value="<?php _e('Odoslať', 'vicepremier'); ?>">

                                </form>

                            </div>
                        <?php
                        endif;

                    endwhile;

                endif;

                ?>
            </div>
            <div class="pdt-30">
                <?php
                    $aktualityTyp = get_field('vyber_aktualit');
                    $aktuality = null;
                    $vybrataKategoria = null;

                    $currentUrl = home_url( $wp->request );
                    $explodedUrl = array_filter(explode('/',$currentUrl));
                    $pageNum = in_array('page', $explodedUrl) ? $explodedUrl[sizeof($explodedUrl)] : 1;

                    $kategorie = $taxonomy;
                    $haveAnyChildren = haveAnyChildren(get_the_ID());

                    $posts_per_page = !$haveAnyChildren ? 9 : -1;

                    $args = array(
                        'post_type' => 'mpsr',
                        'order' => !$haveAnyChildren ? "DESC" : 'ASC',
                        'posts_per_page' => $posts_per_page,
                        'post_status' => 'publish',
                        'post_parent' => get_the_ID(),
                        'orderby' => !$haveAnyChildren ? "date" : 'ID',
                        'paged' => $pageNum,
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

                    ?>

                    <?php
                    if(isset($aktuality) && $aktuality->have_posts()):
                        $currentId = get_the_ID();

                        while($aktuality->have_posts()):
                            $aktuality->the_post();
                            if($currentId == get_the_ID()) {
                                continue;
                            }
                            $hasDate = (!get_children(get_the_ID()) && get_post_time() && !$haveAnyChildren)?true:false;

                            ?>
                            <div class="col4 col1_idsk_md <?php echo $hasDate?'':'idsk-card-empty'; ?>">
                                <?php
                                get_template_part('templates/parts/aktualita-small', null, array(
                                    'id' => get_the_ID(),
                                    'addedClass' => 'mgt-10',
                                    'cat' => $vybrataKategoria,
                                    'isMpsr' => $hasDate
                                ));
                                ?>
                            </div>
                        <?php
                        endwhile;
                        ?>
                        <!-- /.posts-list -->
                        <div class="mpsr-pagination">
                            <ul>
                                <?php
                                $totalPosts = $aktuality->found_posts;



                                $arraySplitted = array_filter(explode('/', $currentUrl));
                                if(in_array('page', $arraySplitted)) {
                                    $currentUrl = $arraySplitted;
                                    $currentUrl[0] .= '/';
                                    array_splice($currentUrl, -2);
                                    $currentUrl = join('/', $currentUrl);
                                }

                                $currentUrl = rtrim($currentUrl, '/');
                                // echo '<!--' . print_r($currentUrl, 1) . '-->';
                                if($totalPosts > $posts_per_page) {
                                    $totalPages = ceil($totalPosts / $posts_per_page);
                                    if($totalPages <= $posts_per_page) {
                                        for($i = 1; $i <= $totalPages; $i++) {
                                            if($i == $pageNum) {
                                                ?>
                                                <li><a class="active" href="#" target="_self"><?php echo $i; ?></a></li>
                                                <?php
                                            } else {
                                                ?>
                                                <li><a href="<?php echo $currentUrl . '/page/' . $i; ?>" target="_self"><?php echo $i; ?></a></li>
                                                <?php
                                            }
                                        }
                                    } else {
                                        if($pageNum <= 3) {
                                            for($i = 1; $i <= 5; $i++) {
                                                if($i == $pageNum) {
                                                    ?>
                                                    <li><a class="active" href="#" target="_self"><?php echo $i; ?></a></li>
                                                    <?php
                                                } else {
                                                    if($i != 1) {
                                                        ?>
                                                        <li><a href="<?php echo $currentUrl . '/page/' . $i; ?>" target="_self"><?php echo $i; ?></a></li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li><a href="<?php echo $currentUrl; ?>" target="_self"><?php echo $i; ?></a></li>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <li>…</li>
                                            <li><a href="<?php echo $currentUrl . '/page/' . $totalPages; ?>" target="_self"><?php echo $totalPages; ?></a></li>
                                            <?php
                                        } else if($pageNum > ($totalPages - 2)) {
                                            ?>
                                            <li><a href="<?php echo $currentUrl; ?>" target="_self">1</a></li>
                                            <li>…</li>
                                            <?php
                                            for($i = $totalPages - 4; $i <= $totalPages; $i++) {
                                                if($i == $pageNum) {
                                                    ?>
                                                    <li><a class="active" href="#" target="_self"><?php echo $i; ?></a></li>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <li><a href="<?php echo $currentUrl . '/page/' . $i; ?>" target="_self"><?php echo $i; ?></a></li>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <li><a href="<?php echo $currentUrl; ?>" target="_self">1</a></li>
                                            <li>…</li>
                                            <li><a href="<?php echo $currentUrl . '/page/' . ($pageNum - 1); ?>" target="_self"><?php echo ($pageNum-1); ?></a></li>
                                            <li><a class="active" href="<?php echo $currentUrl . '/page/' . $pageNum; ?>" target="_self"><?php echo $pageNum; ?></a></li>
                                            <li><a href="<?php echo $currentUrl . '/page/' . ($pageNum + 1); ?>" target="_self"><?php echo ($pageNum+1); ?></a></li>
                                            <li>…</li>
                                            <li><a href="<?php echo $currentUrl . '/page/' . $totalPages; ?>" target="_self"><?php echo $totalPages; ?></a></li>

                                            <?php
                                        }
                                    }

                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    endif;
                    wp_reset_query();
                    ?>
            </div>
        </div>

    </div>
    
</div>

<?php get_footer(); ?>