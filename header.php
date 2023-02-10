<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <!-- Google Tag Manager -->
    <script>
        function initGtag() {
            if(window.localStorage.getItem('googleAnalytics') === 'true') {
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-PR9NH4L');
            }
        }

        initGtag()
    </script>
    <!-- End Google Tag Manager -->
    
	<!-- meta -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	
	<!-- styles -->
	<?php wp_head(); ?>
	
	<!-- favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php theme_url(); ?>favicon.ico">
	<script>
	    var captchaValues = ['<?php _e('jeden', 'vicepremier'); ?>',
	                         '<?php _e('dva', 'vicepremier'); ?>',
	                         '<?php _e('tri', 'vicepremier'); ?>',
	                         '<?php _e('štyri', 'vicepremier'); ?>',
	                         '<?php _e('päť', 'vicepremier'); ?>',
	                         '<?php _e('šesť', 'vicepremier'); ?>',
	                         '<?php _e('sedem', 'vicepremier'); ?>',
	                         '<?php _e('osem', 'vicepremier'); ?>',
	                         '<?php _e('deväť', 'vicepremier'); ?>',
	                         '<?php _e('desať', 'vicepremier'); ?>',
	                         '<?php _e('jedenásť', 'vicepremier'); ?>',
	                         '<?php _e('dvanásť', 'vicepremier'); ?>',
	                         '<?php _e('trinásť', 'vicepremier'); ?>',
	                         '<?php _e('štrnásť', 'vicepremier'); ?>',
	                         '<?php _e('pätnásť', 'vicepremier'); ?>',
	                         '<?php _e('šestnásť', 'vicepremier'); ?>',
	                         '<?php _e('sedemnásť', 'vicepremier'); ?>',
	                         '<?php _e('osemnásť', 'vicepremier'); ?>',
	                         '<?php _e('devätnásť', 'vicepremier'); ?>',
	                         '<?php _e('dvadsať', 'vicepremier'); ?>'];
        var requiredText = "<?php _e('Toto pole je potrebné zadať!', 'vicepremier'); ?>";
    </script>

    <?php
        $experts = false;

        if (have_rows('obsah')) {
            while(have_rows('obsah')) {
                the_row();
                if (get_row_layout() == 'tabulka_expertov') {
                    $experts = true;
                }
            }
        }

        if($experts):
            ?>
            <link rel="stylesheet" href="<?php theme_url(); ?>/assets/css/vendor/leaflet.css"/>
            <link rel="stylesheet" href="<?php theme_url(); ?>/assets/css/vendor/MarkerCluster.css"/>
            <script src="<?php theme_url(); ?>/assets/js/vendor/leaflet.js"></script>
            <script src="<?php theme_url(); ?>/assets/js/vendor/leaflet.markercluster.js"></script>
            <?php
        endif;
    ?>
</head>
<body <?php body_class('govuk-template__body'); ?>>
    <script>document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');</script>
    <a href="#main-content" class="govuk-skip-link"><?php _e('Preskočiť na hlavný obsah', 'vicepremier'); ?></a>

    <?php get_template_part('templates/parts/cookie'); ?>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PR9NH4L"
    height="0" width="0" style="display:none;visibility:hidden" title="GTM" data-cookie="googleAnalytics"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <!-- HEADER -->
    <header class="idsk-header-web header_custom" data-module="idsk-header-web">
        <div class="idsk-header-web__tricolor"></div>

        <div class="idsk-header-web__brand ">
            <div class="govuk-width-container">
                <div class="govuk-grid-row">
                    <div class="govuk-grid-column-full">
                        <div class="idsk-header-web__brand-gestor">
                            <span class="govuk-body-s idsk-header-web__brand-gestor-text">
                                <?php echo get_field('povinna_sekcia', 'options')['text_vlavo']; ?>
                                <button class="idsk-header-web__brand-gestor-button"
                                    aria-label="<?php _e('Zobraziť informácie o stránke', 'vicepremier'); ?>" aria-expanded="false"
                                    data-text-for-hide="<?php _e('Skryť informácie o stránke', 'vicepremier'); ?>"
                                    data-text-for-show="<?php _e('Zobraziť informácie o stránke', 'vicepremier'); ?>">
                                    <?php echo get_field('povinna_sekcia', 'options')['text_vpravo']; ?>
                                    <span class="idsk-header-web__link-arrow"></span>
                                </button>
                            </span>
                            <span class="govuk-body-s idsk-header-web__brand-gestor-text--mobile">
                                SK
                                <button class="idsk-header-web__brand-gestor-button"
                                    aria-label="<?php _e('Zobraziť informácie o stránke', 'vicepremier'); ?>" aria-expanded="false"
                                    data-text-for-hide="<?php _e('Skryť informácie o stránke', 'vicepremier'); ?>"
                                    data-text-for-show="<?php _e('Zobraziť informácie o stránke', 'vicepremier'); ?>">
                                    <?php echo get_field('povinna_sekcia', 'options')['text_mobil']; ?>
                                    <span class="idsk-header-web__link-arrow"></span>
                                </button>
                            </span>

                            <div class="idsk-header-web__brand-dropdown">
                                <div class="govuk-width-container">
                                    <div class="govuk-grid-row">
                                        <div class="govuk-grid-column-one-half">
                                            <h3 class="govuk-body-s">
                                                <?php echo get_field('povinna_sekcia', 'options')['text_kratky']['nadpis']; ?>
                                            </h3>
                                            <div class="govuk-body-s">
                                                <?php echo get_field('povinna_sekcia', 'options')['text_kratky']['popis']; ?>
                                            </div>
                                        </div>
                                        <div class="govuk-grid-column-one-half">
                                            <h3 class="govuk-body-s">
                                                <?php echo get_field('povinna_sekcia', 'options')['text_kratky_p']['nadpis']; ?>
                                            </h3>
                                            <div class="govuk-body-s">
                                                <?php echo get_field('povinna_sekcia', 'options')['text_kratky_p']['popis']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="idsk-header-web__brand-spacer"></div>
                        <div class="idsk-header-web__brand-language">
                            <?php 
                                $languages = getLanguages();
                                $showLanguage;

                                foreach($languages as $lng => $val) {
                                    if($val['active']) {
                                        $showLanguage = $val;
                                        break;
                                    }
                                }
                            ?>
                            <button class="idsk-header-web__brand-language-button"
                                aria-label="<?php _e('Rozbaliť jazykové menu', 'vicepremier'); ?>" aria-expanded="false"
                                data-text-for-hide="<?php _e('Skryť jazykové menu', 'vicepremier'); ?>"
                                data-text-for-show="<?php _e('Rozbaliť jazykové menu', 'vicepremier'); ?>">
                                    <?php echo strtolower($showLanguage['native_name']); ?>
                                <div class="idsk-header-web__link-arrow"></div>
                            </button>
                            <ul class="idsk-header-web__brand-language-list">
                                <?php
                                    foreach($languages as $lng => $val):
                                        ?>
                                        <li class="idsk-header-web__brand-language-list-item">
                                            <a 
                                                class="govuk-link idsk-header-web__brand-language-list-item-link <?php echo ($val['active'])?'idsk-header-web__brand-language-list-item-link--selected':''; ?>" 
                                                title="<?php echo strtolower($val['native_name']); ?>" 
                                                href="<?php echo $val['url']; ?>"
                                            >
                                                <?php echo strtolower($val['native_name']); ?>
                                            </a>
                                        </li>
                                        <?php
                                    endforeach;
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="idsk-header-web__main">
            <div class="govuk-width-container">
                <div class="govuk-grid-row">
                    <div class="govuk-grid-column-full govuk-grid-column-one-third-from-desktop">
                        <div class="idsk-header-web__main-headline header_custom_logo">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e('Odkaz na úvodnú stránku', 'vicepremier'); ?>">
                                <img src="<?php echo get_field('logo', 'options')['url']; ?>"
                                    alt="<?php echo get_field('logo', 'options')['alt']; ?>"
                                    class="idsk-header-web__main-headline-logo">
                            </a>

                            <button class="idsk-button idsk-header-web__main-headline-menu-button"
                                aria-label="<?php _e('Rozbaliť menu', 'vicepremier'); ?>" aria-expanded="false"
                                data-text-for-show="<?php _e('Rozbaliť menu', 'vicepremier'); ?>" data-text-for-hide="<?php _e('Skryť menu', 'vicepremier'); ?>">
                                <?php _e('Menu', 'vicepremier'); ?>
                                <div class="idsk-header-web__menu-open"></div>
                                <div class="idsk-header-web__menu-close"></div>
                            </button>
                        </div>
                    </div>

                    <div class="govuk-grid-column-two-thirds">
                        <div class="idsk-header-web__main-action">
                            <form class="idsk-header-web__main-action-search" method="get" action="<?php echo get_field('stranka_vyhladavania', 'options')['url']; ?>">
                                <input 
                                    class="govuk-input govuk-!-display-inline-block"
                                    name="search"
                                    placeholder="<?php _e('Zadajte hľadaný výraz', 'vicepremier'); ?>" 
                                    title="<?php _e('Zadajte hľadaný výraz', 'vicepremier'); ?>"
                                    type="search" 
                                    aria-describedby="input-width-30-hint"
                                    aria-label="<?php _e('Zadajte hľadaný výraz', 'vicepremier'); ?>" />
                                <button type="submit" class="govuk-button" data-module="govuk-button">
                                    <span class="govuk-visually-hidden"><?php _e('Vyhľadať', 'vicepremier'); ?></span>
                                    <i aria-hidden="true" class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="idsk-header-web__nav--divider"></div>
        <div class="idsk-header-web__nav idsk-header-web__nav--mobile ">
            <div class="govuk-width-container">
                <div class="govuk-grid-row">
                    <div class="govuk-grid-column-full">
                        <form class="idsk-header-web__main-action-search" method="get" action="<?php echo get_field('stranka_vyhladavania', 'options')['url']; ?>">
                            <input 
                                class="govuk-input govuk-!-display-inline-block"
                                name="search"
                                placeholder="<?php _e('Zadajte hľadaný výraz', 'vicepremier'); ?>" 
                                title="<?php _e('Zadajte hľadaný výraz', 'vicepremier'); ?>"
                                type="search"
                                aria-describedby="input-width-30-hint" 
                                aria-label="<?php _e('Zadajte hľadaný výraz', 'vicepremier'); ?>" />
                            <button type="submit" class="govuk-button" data-module="govuk-button">
                                <span class="govuk-visually-hidden"><?php _e('Vyhľadať', 'vicepremier'); ?></span>
                                <i aria-hidden="true" class="fas fa-search"></i>
                            </button>
                        </form>

                    </div>
                    <div class="govuk-grid-column-full">
                        <nav class="idsk-header-web__nav-bar--buttons">
                            <ul class="idsk-header-web__nav-list " role="navigation"
                                aria-label="<?php _e('Hlavná navigácia', 'vicepremier'); ?>">

                                <?php
                                    $menuLocations = get_nav_menu_locations(); 
                                    $menuID = $menuLocations['menu'];
                                    $primaryNav = wp_get_nav_menu_items($menuID);
                                    
                                    foreach($primaryNav as $item): 
                                        $sub = get_field('zobrazit_podmenu', $item);
                                        
                                        $currentClass = '';
                                        
                                        if(strpos(get_permalink(), $item->url) !== false) {
                                            $currentClass = ' current-menu-item ';
                                        }
                                        
                                        ?>
                                        <li class="idsk-header-web__nav-list-item <?php echo $currentClass; ?>">
                                            <a 
                                                class="govuk-link idsk-header-web__nav-list-item-link" 
                                                href="<?php echo ($sub) ? '#' : $item->url; ?>"  
                                                title="<?php echo $item->title; ?>"
                                                <?php if($sub): ?>
                                                    aria-label="<?php _e('Rozbaliť', 'vicepremier'); ?> <?php echo $item->title; ?> <?php _e('menu', 'vicepremier'); ?>"
                                                    aria-expanded="false" 
                                                    data-text-for-hide="<?php _e('Skryť', 'vicepremier'); ?> <?php echo $item->title; ?> <?php _e('menu', 'vicepremier'); ?>"
                                                    data-text-for-show="<?php _e('Zobraziť', 'vicepremier'); ?> <?php echo $item->title; ?>"
                                                <?php endif; ?>
                                            >
                                                <?php echo $item->title; ?>
                                                <?php if($sub): ?>
                                                    <div class="idsk-header-web__link-arrow"></div>
                                                    <div class="idsk-header-web__link-arrow-mobile"></div>
                                                <?php endif; ?>
                                            </a>
                                            <?php 
                                                if($sub): 
                                                    ?>
                                                    <div class="idsk-header-web__nav-submenu">
                                                        <div class="govuk-width-container">
                                                            <div class="govuk-grid-row">
                                                                <?php
                                                                    if(have_rows('podmenu', $item)):
                                                                        ?>
                                                                            <ul class="idsk-header-web__nav-submenu-list" aria-label="<?php _e('Vnútorná navigácia', 'vicepremier'); ?>">
                                                                            <?php
                                                                                while(have_rows('podmenu', $item)):
                                                                                    the_row();
                                                                                    
                                                                                    $submenu = get_sub_field('menu');
                                                                                    $terms = get_terms('kategorie-sekcie');
                                                                                    $link = '';

                                                                                    foreach($terms as $term) {
                                                                                        $menuId = get_field('menu', $term);

                                                                                        if($menuId == $submenu->ID) {
                                                                                            $link = get_permalink(get_field('stranka_kategorie',$term));
                                                                                        }
                                                                                    }


                                                                                    $subMenuNav = wp_get_nav_menu_items($submenu->ID);

                                                                                    foreach($subMenuNav as $subNavItem): 
                                                                                        $currentClassSubNav = '';

                                                                                        if(strpos(get_permalink(), $subNavItem->url) !== false) {
                                                                                            $currentClassSubNav = ' current-menu-item ';
                                                                                        }
                                                                                        
                                                                                        ?>
                                                                                        <li class="idsk-header-web__nav-submenu-list-item <?php echo $currentClassSubNav; ?>">
                                                                                            <a class="govuk-link idsk-header-web__nav-submenu-list-item-link"
                                                                                                href="<?php echo $subNavItem->url; ?>" title="<?php echo $subNavItem->title; ?>">
                                                                                                <span><?php echo $subNavItem->title; ?></span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <?php
                                                                                    endforeach;
                                                                                endwhile;
                                                                            ?>
                                                                            </ul>
                                                                        <?php
                                                                    endif;
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                endif;
                                            ?>
                                        </li>
                                        <?php
                                    endforeach;
                                ?>
                        
                            </ul>
                        </nav>
                    </div>
                </div>
            
            </div>
        </div>

    </header>
    <!-- END HEADER -->
        
    <main class="govuk-main-wrapper govuk-main-wrapper--auto-spacing" id="main-content" role="main">
