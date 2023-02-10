<?php get_header(); ?>
<!-- INTRO + .box_search -->
<div class="box_search govuk-width-container pdt-40">
    <div data-module="idsk-intro-block">
        <div class="idsk-intro-block ">
            <div class="grid mid-space">

                <!-- LEFT SIDE -->
                <div class="col34 col1_lgm">
                    <h2 class="title2">
                        <?php the_title(); ?>
                    </h2>

                    <form data-module="idsk-search-component" class="idsk-search-component"  method="get" action="<?php echo get_field('stranka_vyhladavania', 'options')['url']; ?>">
                        <label class="" for="intro-block-search">
                            <?php _e('Zadajte hľadaný výraz', 'vicepremier'); ?>
                        </label>
                        <input class="govuk-input govuk-input--width-30 idsk-search-component__input "
                            id="intro-block-search" name="search" type="search">
                        <button type="submit" class="idsk-button idsk-search-component__button ">
                            <svg width="28" height="28" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.0115 13.103C21.0115 17.2495 17.5484 20.6238 13.2928 20.6238C9.03714 20.6238 5.57404 17.2495 5.57404 13.103C5.57404
                8.95643 9.03714 5.58212 13.2928 5.58212C17.5484 5.58212 21.0115 8.95643 21.0115 13.103ZM29.833 27.0702C29.833 26.4994
                29.5918 25.9455 29.1955 25.5593L23.2858 19.8012C24.6814 17.8371 25.4223 15.4868 25.4223 13.103C25.4223 6.57259 19.995
                1.28451 13.2928 1.28451C6.59058 1.28451 1.16333 6.57259 1.16333 13.103C1.16333 19.6333 6.59058 24.9214 13.2928
                24.9214C15.7394 24.9214 18.1515 24.1995 20.1673 22.8398L26.077 28.5811C26.4732 28.984 27.0418 29.219 27.6276
                29.219C28.8337 29.219 29.833 28.2453 29.833 27.0702Z" fill="white"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.75708 13.103C0.75708 6.35398 6.36621 0.888672 13.2928 0.888672C20.2194 0.888672 25.8285 6.35398 25.8285
                13.103C25.8285 15.4559 25.1301 17.7778 23.8094 19.7516L29.4827 25.2794C29.9551 25.7396 30.2392 26.3943 30.2392
                27.0702C30.2392 28.464 29.058 29.6149 27.6276 29.6149C26.9347 29.6149 26.2611 29.3385 25.787 28.8584L20.1168
                23.3497C18.0909 24.6367 15.7078 25.3172 13.2928 25.3172C6.36621 25.3172 0.75708 19.8519 0.75708 13.103ZM13.2928
                1.68034C6.81494 1.68034 1.56958 6.7912 1.56958 13.103C1.56958 19.4147 6.81494 24.5256 13.2928 24.5256C15.6581 24.5256
                17.9892 23.8275 19.9361 22.5143L20.2144 22.3265L26.3704 28.3071C26.6886 28.6308 27.1506 28.8232 27.6276 28.8232C28.6093
                28.8232 29.4267 28.0267 29.4267 27.0702C29.4267 26.6046 29.2285 26.1513 28.9082 25.8392L22.7588 19.8475L22.9518
                19.5759C24.2996 17.679 25.016 15.4076 25.016 13.103C25.016 6.7912 19.7706 1.68034 13.2928 1.68034ZM13.2928
                5.97796C9.26151 5.97796 5.98029 9.17504 5.98029 13.103C5.98029 17.0309 9.26151 20.228 13.2928 20.228C17.3241 20.228
                20.6053 17.0309 20.6053 13.103C20.6053 9.17504 17.3241 5.97796 13.2928 5.97796ZM5.16779 13.103C5.16779 8.73781 8.81278
                5.18629 13.2928 5.18629C17.7728 5.18629 21.4178 8.73781 21.4178 13.103C21.4178 17.4681 17.7728 21.0196 13.2928
                21.0196C8.81278 21.0196 5.16779 17.4681 5.16779 13.103Z" fill="white"></path>
                            </svg>
                            <span class="govuk-visually-hidden"><?php _e('Vyhľadávanie', 'vicepremier'); ?>
                            </span>
                        </button>
                    </form>

                    <?php if(get_field('casto_hladane_zobrazit')): ?>
                        <div>
                            <ul class="idsk-intro-block__list__ul">
                                <li class="idsk-intro-block__bottom-menu__li govuk-caption-m">
                                    <span><?php _e('Hľadáte toto?', 'vicepremier'); ?></span>
                                </li>
                                <?php 
                                if(have_rows('casto_hladane')):
                                    while(have_rows('casto_hladane')):
                                        the_row();
                                        ?>
                                        <li class="idsk-intro-block__list__li">
                                            <a href="<?php echo get_field('stranka_vyhladavania', 'options')['url']; ?>?search=<?php echo urlencode(get_sub_field('vyhladavane_slovo')); ?>" title="<?php the_sub_field('vyhladavane_slovo'); ?>" class=" govuk-link idsk-intro-block__list__a"><?php the_sub_field('vyhladavane_slovo'); ?></a>
                                        </li>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- RIGHT SIDE -->
                <div class="col4 col1_lgm mgt-5 mgt-40lg">
                    <ul class="idsk-intro-block__side-menu__ul">
                        <?php 
                        if(have_rows('odkazy_vpravo')):
                            while(have_rows('odkazy_vpravo')):
                                the_row();
                                ?>
                                <li class="idsk-intro-block__side-menu__li">
                                    <a class="govuk-link idsk-intro-block__side-menu__a" href="<?php echo get_sub_field('odkaz')['url']; ?>" title="<?php echo get_sub_field('odkaz')['title']; ?>"><strong><?php echo get_sub_field('odkaz')['title']; ?></strong></a>
                                </li>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        
        </div>
    </div>
</div>

<hr class="govuk-width-container idsk-hr-separator mgt-40">

<!-- Novinky a oznámenia + .box_news -->
<div class="govuk-width-container mgt-40 box_news">
    <div class="govuk-grid-row">
        <div class="govuk-grid-column-full govuk-!-margin-bottom-5">
            <div class="grid mgb-15">
                <div class="col_fill">
                    <h2 class="title2"><?php the_field('aktuality_nadpis'); ?></h2>
                </div>
                <div class="col_default self-center">
                    <a href="<?php echo get_field('archiv_aktualit')['url']; ?>" class="govuk-link" title="<?php echo get_field('archiv_aktualit')['title']; ?>"><?php echo get_field('archiv_aktualit')['title']; ?>
                    </a>     
                </div>
            </div>
        </div>
        
        <div class="govuk-grid-column-full">
            <div class="grid mid-space">
                <?php
                    while(have_rows('hlavne_aktuality')):
                        the_row();
                        
                        $aktualityTyp = get_sub_field('zobrazene_aktuality_slider');
                
                        $aktualityList = [];
                        
                        switch($aktualityTyp) {
                            case 'najnovsie':
                                $args = array(
                                    'post_type' => 'clanky',
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'posts_per_page' => 5,
                                    'post_status' => 'publish'
                                );
                                $aktuality = new WP_Query( $args );
                                
                                while($aktuality->have_posts()): 
                                    $aktuality->the_post(); 
                                    $newAktuality = new stdClass();
                                    $newAktuality->id = get_the_ID();
                                    $newAktuality->title = get_the_title();
                                    $newAktuality->categories = get_category_for_article(get_the_ID());
                                    $newAktuality->url = get_permalink();
                                    $newAktuality->dateCreated = get_the_date('j.n.Y', get_the_ID());
                                    $newAktuality->image = get_field('nahladovy_obrazok_perex');
                                    
                                    $aktualityList[] = $newAktuality;
                                endwhile;
                                wp_reset_query();
                                break;
                            case 'manualne':
                                
                                while(have_rows('manualne_aktuality')):
                                    the_row();
                                    
                                    $newAktuality = new stdClass();
                                    $newAktuality->id = get_sub_field('aktualita');
                                    $newAktuality->title = get_the_title(get_sub_field('aktualita'));
                                    $newAktuality->categories = get_category_for_article(get_sub_field('aktualita'));
                                    $newAktuality->url = get_permalink(get_sub_field('aktualita'));
                                    $newAktuality->dateCreated = get_the_date('j.n.Y', get_sub_field('aktualita'));
                                    $newAktuality->image = get_field('nahladovy_obrazok_perex',get_sub_field('aktualita'));
                                    
                                    $aktualityList[] = $newAktuality;
                                    
                                endwhile;
                                
                                break;
                                
                        }

                        if(sizeof($aktualityList) > 0):
                            ?>
                                <div class="col2 col1_idsk_md">
                                    <div class="idsk-card idsk-card-secondary idsk-highlighted">

                                        <a href="<?php echo $aktualityList[0]->url; ?>" title="<?php echo $aktualityList[0]->title; ?>">
                                            <img class="idsk-card-img idsk-card-img-secondary" width="100%" src="<?php echo $aktualityList[0]->image; ?>" alt="<?php echo $aktualityList[0]->title; ?>" aria-hidden="true" />
                                        </a>
                                        
                                        <div class="idsk-card-content idsk-card-content-secondary">
                                            <div class="idsk-card-meta-container">
                                                <span class="idsk-card-meta idsk-card-meta-date">
                                                    <a href="<?php echo $aktualityList[0]->url; ?>" class="govuk-link" title="<?php _e('Pridané dňa', 'vicepremier'); ?>: <?php echo $aktualityList[0]->dateCreated; ?>"><?php echo $aktualityList[0]->dateCreated; ?></a>
                                                </span> 
                                                <?php
                                                $categories = $aktualityList[0]->categories;
                                                foreach($categories as $cat):
                                                    ?>
                                                    <span class="idsk-card-meta idsk-card-meta-tag">
                                                        <a href="<?php echo get_term_link($cat->id); ?>" class="govuk-link" target="_self" title="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></a>
                                                    </span>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </div>
                                    
                                    
                                            <div class="idsk-heading idsk-heading-secondary">
                                                <a href="<?php echo $aktualityList[0]->url; ?>" class="idsk-card-title govuk-link" title="<?php echo $aktualityList[0]->title; ?>"><?php echo $aktualityList[0]->title; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        endif;

                        array_shift($aktualityList);

                        if(sizeof($aktualityList) > 0):
                            ?>
                            <div class="col2 col1_idsk_md box_news_list">
                                <?php
                                    foreach ($aktualityList as $akt):
                                        ?>
                                        <div class="idsk-card idsk-card-basic-variant">
                                            <div class="idsk-card-content idsk-card-content-basic-variant">
                                                <div class="idsk-heading idsk-heading-basic-variant">
                                                    <a href="<?php echo $akt->url; ?>" class="idsk-card-title govuk-link" title="<?php echo $akt->title; ?>">
                                                        <?php echo $akt->title; ?>
                                                    </a>
                                                </div>
                                                <div class="idsk-card-meta-container">
                                                    <span class="idsk-card-meta idsk-card-meta-date">
                                                        <a href="<?php echo $akt->url; ?>" class="govuk-link" title="<?php _e('Pridané dňa', 'vicepremier'); ?>: <?php echo $akt->dateCreated; ?>"><?php echo $akt->dateCreated; ?></a>
                                                    </span> 
                                                    <?php
                                                    $categories = $akt->categories;
                                                    foreach($categories as $cat):
                                                        ?>
                                                        <span class="idsk-card-meta idsk-card-meta-tag">
                                                            <a href="<?php echo get_term_link($cat->id); ?>" class="govuk-link" target="_self" title="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></a>
                                                        </span>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                ?>
                            </div>
                            <?php
                        endif;
                    endwhile;
                ?>
            </div>
        </div>

    </div>
</div>

<?php
    if( have_rows('bloky') ):
        while ( have_rows('bloky') ) : the_row();
            ?>
            <hr class="govuk-width-container idsk-hr-separator mgt-40"/>
            <?php
            if( get_row_layout() == 'zoznam_odkazov' ):
                ?>
                    <!-- Eurofondy -->
                    <div class="govuk-width-container mgt-40">
                        <div class="govuk-grid-row">
                            <div class="govuk-grid-column-full govuk-!-margin-bottom-5">
                                <div class="grid mgb-15">
                                    <div class="col_fill">
                                        <h2 class="title2"><?php the_sub_field('zo_nadpis'); ?></h2>
                                    </div>
                                    <?php if(get_sub_field('zo_zobrazit_odkaz')): ?>
                                        <div class="col_default self-center">
                                            <a href="<?php echo get_sub_field('zo_odkaz')['url']; ?>" class="govuk-link" title="<?php echo get_sub_field('zo_odkaz')['title']; ?>">
                                                <?php echo get_sub_field('zo_odkaz')['title']; ?>
                                            </a>     
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="govuk-grid-column-full">
                        
                                <div data-module="idsk-crossroad" class="">
                                    <?php
                                        $odkazy = [];
                                        
                                        if(have_rows('zo_odkazy')):
                                            while(have_rows('zo_odkazy')):
                                                the_row();
                                                $odkaz = new stdClass();
                                                $odkaz->title = get_sub_field('link')['title'];
                                                $odkaz->url = get_sub_field('link')['url'];
                                                $odkaz->target = get_sub_field('link')['target']==='_blank'?'_blank':'_self';
                                                $odkaz->podnadpis = get_sub_field('popis');
                                                $odkazy[] = $odkaz;
                                            endwhile;
                                        endif;

                                        $arrays = array_chunk($odkazy, ceil(sizeof($odkazy)/2));
                                        $limit = 5;

                                        $isOverLimit = false;

                                        foreach($arrays as $arr):
                                            ?>
                                            <div class="idsk-crossroad idsk-crossroad-2">
                                                <?php
                                                foreach($arr as $index=>$item):
                                                    if($index >= $limit) {
                                                        $isOverLimit = true;
                                                    }
                                                    ?>
                                                    <div class="idsk-crossroad__item <?php echo $index >= $limit?' idsk-crossroad__item--two-columns-hide-mobile idsk-crossroad__item--two-columns-hide':''; ?>">
                                                        <a href="<?php echo $item->url; ?>" target="<?php echo $item->target; ?>" class="govuk-link idsk-crossroad-title" title="<?php echo $item->title; ?>" aria-hidden="<?php echo $index >= $limit?'true':'false'; ?>">
                                                            <?php echo $item->title; ?>
                                                        </a>
                                                        <?php if($item->podnadpis): ?>
                                                            <p class="idsk-crossroad-subtitle" aria-hidden="<?php echo $index >= $limit?'true':'false'; ?>"><?php echo $item->podnadpis; ?></p>
                                                        <?php endif; ?>
                                                        <?php if($index !== (sizeof($arr)-1)): ?>
                                                            <hr class="idsk-crossroad-line" aria-hidden="true">
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </div>
                                            <?php
                                        endforeach;
                                        if($isOverLimit): 
                                            ?>
                                            <div class="govuk-grid-column-full idsk-crossroad__collapse--shadow idsk-crossroad__uncollapse-div  ">
                                                <button id="idsk-crossroad__uncollapse-button" class="idsk-crossroad__colapse--button" type="button"
                                                    data-line1="<?php _e('Zobraziť viac', 'vicepremier'); ?>" data-line2="<?php _e('Zobraziť menej', 'vicepremier'); ?>"><?php _e('Zobraziť viac', 'vicepremier'); ?></button>
                                            </div>
                                            <?php
                                        endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            elseif( get_row_layout() == 'boxiky'):
                ?>
                <!-- Investície -->
                <div class="govuk-width-container mgt-40">

                    <div class="grid mid-space">
                        <?php
                            if(have_rows('bo_odkazy')):
                                while(have_rows('bo_odkazy')):
                                    the_row();
                                    ?>
                                    <!-- ITEM -->
                                    <a href="<?php echo get_sub_field('link')['url']; ?>" title="<?php echo get_sub_field('link')['title']; ?>" target="<?php echo get_sub_field('link')['target']==='_blank'?'_blank':'_self'; ?>" class="item_link offset govuk-link col2 col1_lgm">
                                        <div class="item_link_desc">
                                            <h2 class="title4"><?php echo get_sub_field('link')['title']; ?></h2>
                                            <?php if(get_sub_field('popis')): ?>
                                                <p class="item_link_text"><?php the_sub_field('popis');?></p>
                                            <?php endif; ?>
                                        </div>   
                                        <div class="item_link_arrow">
                                            <svg class="sicofill"><use href="<?php theme_url(); ?>/fe/assets/layout/icons.svg#s_arr"></use></svg>
                                        </div>
                                    </a>
                                    <?php
                                endwhile;
                            endif;
                        ?>
                    </div>
                </div>
                <?php
            elseif( get_row_layout() == 'ministerstvo' ): 
                ?>
                    <!-- Ministerstvo -->
                    <div class="govuk-width-container mgt-40">
                        <div class="govuk-grid-row">
                            <div class="govuk-grid-column-full govuk-!-margin-bottom-5">
                                <div class="grid mgb-15">
                                    <div class="col_fill">
                                        <h2 class="title2"><?php the_sub_field('mo_nadpis'); ?></h2>
                                    </div>
                                    <?php if(get_sub_field('mo_zobrazit_odkaz')): ?>
                                        <div class="col_default self-center">
                                            <a href="<?php echo get_sub_field('mo_odkaz')['url']; ?>" class="govuk-link" title="<?php echo get_sub_field('mo_odkaz')['title']; ?>">
                                                <?php echo get_sub_field('mo_odkaz')['title']; ?>
                                            </a>     
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="govuk-grid-column-full">
                        
                                <div class="idsk-card idsk-card-profile-horizontal">
                        
                                    <a href="<?php echo get_sub_field('mo_text')['odkaz']; ?>" title="<?php echo get_sub_field('mo_text')['meno']; ?>">
                                        <img class="idsk-card-img idsk-card-img-profile-horizontal" width="100%" src="<?php echo get_sub_field('mo_foto')['url']; ?>" alt="<?php echo get_sub_field('mo_text')['meno']; ?>" aria-hidden="true">
                                    </a>
                        
                                    <div class="idsk-card-content idsk-card-content-profile-horizontal">
                        
                                        <div class="idsk-heading idsk-heading-profile-horizontal">
                                            <a href="<?php echo get_sub_field('mo_text')['odkaz']; ?>" class="idsk-card-title govuk-link" title="<?php echo get_sub_field('mo_text')['meno']; ?>"><?php echo get_sub_field('mo_text')['meno']; ?></a>
                                        </div>
                        
                                        <div class="idsk-body idsk-body-profile-horizontal">
                                            <a href="<?php echo get_sub_field('mo_text')['odkaz']; ?>" class="idsk-card-title govuk-link" title="<?php echo get_sub_field('mo_text')['podnadpis']; ?>">
                                                <?php echo get_sub_field('mo_text')['podnadpis']; ?>
                                            </a>
                                        </div>
                        
                                        <div aria-hidden="true">
                                            <svg width="24" height="19" viewBox="0 0 29 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M26.3553 0.0139084C23.5864 0.226497 19.9201 2.88 17.0759 7.02567C15.053 9.97412 12.8391 14.6653 12.8391 18.4203C12.8391 21.3658 15.151 23.7536 18.0028 23.7536C20.8546 23.7536 23.1665 21.3658 23.1665 18.4203C23.1665 15.9126 21.4908 13.8092 19.233 13.2392C19.7995 11.258 20.8141 9.10337 22.2396 7.02567C24.1378 4.25885 26.4022 2.15668 28.5216 1.00119L26.3553 0.0139084Z"
                                                    fill="#003078"></path>
                                                <path
                                                    d="M4.23679 7.02557C7.22761 2.66622 11.1274 -0.0431738 13.937 0.000520662L15.8902 0.890673C13.7117 2.01967 11.3608 4.16818 9.40047 7.02557C7.97502 9.10327 6.96037 11.2579 6.39387 13.2391C8.65175 13.8091 10.3274 15.9125 10.3274 18.4202C10.3274 21.3657 8.0155 23.7535 5.16368 23.7535C2.31186 23.7535 0 21.3657 0 18.4202C0 14.6652 2.21394 9.97402 4.23679 7.02557Z"
                                                    fill="#003078"></path>
                        
                                                <image src="<?php theme_url(); ?>/fe/assets/images/quote-left.png" xlink:href="" width="29" height="25"></image>
                                            </svg>
                                        </div>
                                        <div class="idsk-quote"><?php echo get_sub_field('mo_text')['citat']; ?></div>
                                        <div class="idsk-quote-right" aria-hidden="true">
                                            <svg width="24" height="20" viewBox="0 0 29 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.1662 24.4934C4.93513 24.2808 8.60138 21.6273 11.4456 17.4817C13.4684 14.5332 15.6824 9.84205 15.6824 6.08707C15.6824 3.14154 13.3705 0.753727 10.5187 0.753727C7.66689 0.753727 5.35503 3.14154 5.35503 6.08707C5.35503 8.59472 7.03065 10.6982 9.28852 11.2681C8.72202 13.2493 7.70737 15.404 6.28192 17.4817C4.38369 20.2485 2.1193 22.3506 -0.000114441 23.5061L2.1662 24.4934Z"
                                                    fill="#003078"></path>
                                                <path
                                                    d="M24.2847 17.4818C21.2939 21.8411 17.3941 24.5505 14.5845 24.5068L12.6313 23.6167C14.8098 22.4877 17.1606 20.3391 19.121 17.4818C20.5465 15.4041 21.5611 13.2494 22.1276 11.2682C19.8697 10.6983 18.1941 8.59482 18.1941 6.08716C18.1941 3.14164 20.506 0.753824 23.3578 0.753824C26.2096 0.753824 28.5215 3.14164 28.5215 6.08716C28.5215 9.84214 26.3075 14.5333 24.2847 17.4818Z"
                                                    fill="#003078"></path>
                        
                                                <image src="<?php theme_url(); ?>/fe/assets/images/quote-right.png" xlink:href="" width="29" height="25"></image>
                                            </svg>
                                        </div>
                        
                                    </div>
                                </div>
                        
                            </div>
                        </div>
                        
                        <hr class="idsk-crossroad-line">


                        <div class="govuk-grid-row mgt-40">
                            
                            <div class="govuk-grid-column-full">
                                
                                <div data-module="idsk-crossroad " class="">
                                    <?php
                                    $odkazyMo = [];

                                    if(have_rows('mo_odkazy')):
                                        while(have_rows('mo_odkazy')):
                                            the_row();
                                            $odkaz = new stdClass();
                                            $odkaz->title = get_sub_field('link')['title'];
                                            $odkaz->url = get_sub_field('link')['url'];
                                            $odkaz->target = get_sub_field('link')['target']==='_blank'?'_blank':'_self';
                                            $odkaz->podnadpis = get_sub_field('popis');
                                            $odkazyMo[] = $odkaz;
                                        endwhile;
                                    endif;

                                    $arrays = array_chunk($odkazyMo, ceil(sizeof($odkazyMo)/2));
                                        
                                    foreach($arrays as $arr):
                                        ?>
                                        <div class="idsk-crossroad idsk-crossroad-2">
                                            <?php
                                            foreach($arr as $index=>$item):
                                                ?>
                                                <div class="idsk-crossroad__item                 
                                                ">
                                                    <a href="<?php echo $item->url; ?>" target="<?php echo $item->target; ?>" class="govuk-link idsk-crossroad-title" title="<?php echo $item->title; ?>"
                                                        aria-hidden="false"><?php echo $item->title; ?>
                                                    </a>
                                                    <?php if($item->podnadpis): ?>
                                                        <p class="idsk-crossroad-subtitle" aria-hidden="false"><?php echo $item->podnadpis; ?></p>
                                                    <?php endif; ?>
                                                    <?php if($index !== (sizeof($arr)-1)): ?>
                                                        <hr class="idsk-crossroad-line" aria-hidden="true">
                                                    <?php endif; ?>
                                                </div>
                                                <?php
                                            endforeach;
                                            ?>
                                        </div>
                                        <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php
            elseif( get_row_layout() == 'partneri' ):
                ?>
                    <!-- LOGOS -->
                    <div class="box_logos govuk-width-container pdt-35 pdb-30">
                        <h2 class="govuk-heading-l mg-0"><?php the_sub_field('p_nadpis'); ?></h2>

                        <div class="grid big-space justify-between align-center">
                            <?php
                            if(have_rows('p_partneri')):
                                while(have_rows('p_partneri')):
                                    the_row();
                                    ?>
                                    <a href="<?php echo get_sub_field('link')['url']; ?>" title="<?php echo get_sub_field('link')['title']; ?>" target="<?php echo get_sub_field('link')['target']==='_blank'?'_blank':'_self'; ?>" class="col_default col2_mdm dblock mgt-30">
                                        <img src="<?php echo get_sub_field('logo')['url']; ?>" alt="<?php echo get_sub_field('link')['title']; ?>" />
                                    </a>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                    </div>   
                <?php
            endif;
        endwhile;
    endif;
?> 
<!-- END MAIN -->
<?php get_footer(); ?>