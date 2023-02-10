<?php 
/*
Template Name: Search Page
*/

get_header(); ?>
<script>
var objectNames = {
    'page': '<?php _e('stránky', 'vicepremier'); ?>',
    'page-single': '<?php _e('stránka', 'vicepremier'); ?>',
    'page-more': '<?php _e('stránok', 'vicepremier'); ?>',
    'sekcie': '<?php _e('stránky zo sekcií', 'vicepremier'); ?>',
    'sekcie-single': '<?php _e('stránka zo sekcií', 'vicepremier'); ?>',
    'sekcie-more': '<?php _e('stránok zo sekcií', 'vicepremier'); ?>',
    'clanky': '<?php _e('články', 'vicepremier'); ?>',
    'clanky-single': '<?php _e('článok', 'vicepremier'); ?>',
    'clanky-more': '<?php _e('článkov', 'vicepremier'); ?>',
    'podpredseda-vlady': '<?php _e('stránky zo sekcie podpredseda vlády', 'vicepremier'); ?>',
    'podpredseda-vlady-single': '<?php _e('stránka zo sekcie podpredseda vlády', 'vicepremier'); ?>',
    'podpredseda-vlady-more': '<?php _e('stránok zo sekcie podpredseda vlády', 'vicepremier'); ?>',
    'urad': '<?php _e('stránky zo sekcie úrad', 'vicepremier'); ?>',
    'urad-single': '<?php _e('stránka zo sekcie úrad', 'vicepremier'); ?>',
    'urad-more': '<?php _e('stránok zo sekcie úrad', 'vicepremier'); ?>',
    'projekty': '<?php _e('projekty', 'vicepremier'); ?>',
    'projekty-single': '<?php _e('projekt', 'vicepremier'); ?>',
    'projekty-more': '<?php _e('projektov', 'vicepremier'); ?>',
    'kariera': '<?php _e('kariéra', 'vicepremier'); ?>',
    'kariera-single': '<?php _e('kariéra', 'vicepremier'); ?>',
    'kariera-more': '<?php _e('kariéra', 'vicepremier'); ?>',
    'kariera_en': '<?php _e('Careers', 'vicepremier'); ?>',
    'kariera_en-single': '<?php _e('careers', 'vicepremier'); ?>',
    'kariera_en-more': '<?php _e('career', 'vicepremier'); ?>',
    'mpsr': '<?php _e('MP SR', 'vicepremier'); ?>',
    'mpsr-single': '<?php _e('MP SR', 'vicepremier'); ?>',
    'mpsr-more': '<?php _e('MP SR', 'vicepremier'); ?>'
}
</script>
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
        <div class="idsk-search-results " data-module="idsk-search-results">
            <div class="govuk-grid-column-full idsk-search-results__title">
                <h1 class="govuk-heading-xl"><?php _e('Výsledky vyhľadávania', 'vicepremier'); ?> <?php echo $_GET['search']?'- "' . $_GET['search'] . '"':''; ?>
                </h1>
            </div>
            <div class="idsk-search-results__filter-header-panel govuk-grid-column-full idsk-search-results--invisible">
                <div class="govuk-heading-xl idsk-search-results--half-width">
                    <span><?php _e('Filtre', 'vicepremier'); ?>
                    </span>
                </div>
                <div class="idsk-search-results--half-width">
                    <button class="idsk-search-results__button--back-to-results" type="button"><?php _e('Späť na výsledky', 'vicepremier'); ?>
                    </button>
                </div>
            </div>
            <div id="search-extend" class="idsk-search-results__filter govuk-grid-column-one-quarter">
                <div class="idsk-search-results__link-panel idsk-search-results__content-type-filter" tabindex="-1">
                    <button class="idsk-search-results__link-panel-button " tabindex="0">
                        <span class="idsk-search-results__link-panel__title">
                            <?php _e('Kategória', 'vicepremier'); ?>
                        </span>
                        <span class="idsk-search-results__link-panel--span" data-lines="<?php _e('vybraté', 'vicepremier'); ?>"></span>
                    </button>
                    <div class="idsk-search-results__list idsk-search-results--hidden">
                        <div class="idsk-option-select-filter ">

                            <div class="govuk-form-group">
                                <div class="govuk-checkboxes govuk-checkboxes--small">
                                    <?php
                                        $terms = get_terms( array(
                                            'taxonomy' => 'kategorie-sekcie',
                                            'hide_empty' => true,
                                        ) );
                                        
                                        foreach($terms as $term):
                                            
                                            ?>
                                                <div class="govuk-checkboxes__item">
                                                    <input class="govuk-checkboxes__input" name="kategorie-<?php echo $term->term_id; ?>" type="checkbox" id="kategorie-<?php echo $term->term_id; ?>">
                                                    <label class="govuk-label govuk-checkboxes__label" for="kategorie-<?php echo $term->term_id; ?>" tabindex="0">
                                                        <?php echo $term->name; ?>
                                                    </label>
                                                </div>
                                            <?php
                                            
                                        endforeach;
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="idsk-search-results__link-panel idsk-search-results__content-type-filter" tabindex="-1">
                    <button class="idsk-search-results__link-panel-button " tabindex="0">
                        <span class="idsk-search-results__link-panel__title">
                            <?php _e('Čas', 'vicepremier'); ?>
                        </span>
                        <span class="idsk-search-results__link-panel--span" data-lines="<?php _e('vybraté', 'vicepremier'); ?>"></span>
                    </button>
                    <div class="idsk-search-results__list idsk-search-results--hidden">
                        <div class="idsk-option-select-filter ">

                            <div class="govuk-form-group">
                                <div class="govuk-checkboxes govuk-checkboxes--small">
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input" name="today" type="checkbox" id="today">
                                        <label class="govuk-label govuk-checkboxes__label" for="today" tabindex="0"><?php _e('Dnes','vicepremier'); ?></label>
                                    </div>
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input" name="yesterday" type="checkbox" id="yesterday">
                                        <label class="govuk-label govuk-checkboxes__label" for="yesterday" tabindex="0"><?php _e('Včera','vicepremier'); ?></label>
                                    </div>
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input" name="last-month" type="checkbox" id="last-month">
                                        <label class="govuk-label govuk-checkboxes__label" for="last-month" tabindex="0"><?php _e('Tento mesiac','vicepremier'); ?></label>
                                    </div>
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input" name="last-year" type="checkbox" id="last-year">
                                        <label class="govuk-label govuk-checkboxes__label" for="last-year" tabindex="0"><?php _e('Tento rok','vicepremier'); ?></label>
                                    </div>
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input" name="past-year" type="checkbox" id="past-year">
                                        <label class="govuk-label govuk-checkboxes__label" for="past-year" tabindex="0"><?php _e('Predošlé roky','vicepremier'); ?></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="idsk-search-results__link-panel idsk-search-results__content-type-filter" tabindex="-1">
                    <button class="idsk-search-results__link-panel-button " tabindex="0">
                        <span class="idsk-search-results__link-panel__title">
                            <?php _e('Typ', 'vicepremier'); ?>
                        </span>
                        <span class="idsk-search-results__link-panel--span" data-lines="<?php _e('vybraté', 'vicepremier'); ?>"></span>
                    </button>
                    <div class="idsk-search-results__list idsk-search-results--hidden">
                        <div class="idsk-option-select-filter ">

                            <div class="govuk-form-group">
                                <div class="govuk-checkboxes govuk-checkboxes--small">
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input" name="type-clanky" type="checkbox" id="type-clanky">
                                        <label class="govuk-label govuk-checkboxes__label" for="type-clanky" tabindex="0"><?php _e('Aktuality', 'vicepremier'); ?></label>
                                    </div>
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input"  name="type-udalosti" type="checkbox" id="type-udalosti">
                                        <label class="govuk-label govuk-checkboxes__label" for="type-udalosti" tabindex="0"><?php _e('Udalosti', 'vicepremier'); ?></label>
                                    </div>
                                    <div class="govuk-checkboxes__item">
                                        <input class="govuk-checkboxes__input"  name="type-page" type="checkbox" id="type-page">
                                        <label class="govuk-label govuk-checkboxes__label" for="type-page" tabindex="0"><?php _e('Stránky', 'vicepremier'); ?></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="idsk-search-results__link-panel idsk-search-results__content-type-filter" tabindex="-1">
                    <button class="idsk-search-results__link-panel-button " tabindex="0">
                        <span class="idsk-search-results__link-panel__title">
                            <?php _e('Tag', 'vicepremier'); ?>
                        </span>
                        <span class="idsk-search-results__link-panel--span" data-lines="<?php _e('vybraté', 'vicepremier'); ?>"></span>
                    </button>
                    <div class="idsk-search-results__list idsk-search-results--hidden">
                        <div class="idsk-option-select-filter ">

                            <div class="govuk-form-group">
                                <div class="govuk-checkboxes govuk-checkboxes--small">
                                    <?php
                                        $terms = get_terms( array(
                                            'taxonomy' => 'post_tag',
                                            'hide_empty' => true,
                                        ) );
                                        
                                        usort($terms, function($a, $b) {
                                            return $b->count - $a->count;
                                        });
                                        
                                        if ($terms) {
                                        $i = 0;
                                        foreach($terms as $tag):
                                            $i++;
                                            
                                            if($i == 6) {
                                                break;
                                            }
                                            ?>
                                                <div class="govuk-checkboxes__item">
                                                    <input class="govuk-checkboxes__input" name="tag-<?php echo $tag->term_id; ?>" type="checkbox" id="tag-<?php echo $tag->term_id; ?>">
                                                    <label class="govuk-label govuk-checkboxes__label" for="tag-<?php echo $tag->term_id; ?>" tabindex="0">#<?php echo $tag->name; ?></label>
                                                </div>
                                            <?php
                                        endforeach;
                                        }
                                        
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="idsk-search-results__content govuk-grid-column-three-quarters hide-forced">
                <div class="govuk-grid-column-one-quarter">
                    <span class="idsk-search-results__content__number-of-results"></span>
                </div>
                <div class="govuk-grid-column-two-quarters idsk-search-results__filter-panel--mobile">
                    <button class="idsk-search-results__filters__button" title="<?php _e('Filtre', 'vicepremier'); ?>" disabled><?php _e('Filtre', 'vicepremier'); ?>(0)</button>
                </div>
                <div class="idsk-search-results--order">
                    <div class="govuk-form-group">
                        <select class="govuk-select" id="sort" name="sort" disabled>
                            <option value="category"><?php _e('Kategórie', 'vicepremier'); ?></option>
                        </select>
                    </div>

                </div>
                <div class="idsk-search-results__page-number--mobile govuk-grid-column-full">
                    <button type="button" class="idsk-search-results__button--back__mobile idsk-search-results--hidden" disabled>
                        <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.44417 14.6753C7.84229 14.2311 7.84229 13.5134 7.44417 13.0691L3.49368 8.63774H18.9792C19.5406 8.63774 20 8.12512 20 7.49858C20 6.87203 19.5406 6.35941 18.9792 6.35941H3.49368L7.45438 1.93943C7.85249 1.49516 7.85249 0.777482 7.45438 0.333207C7.05627 -0.111069 6.41317 -0.111069 6.01506 0.333207L0.298584 6.70116C-0.0995279 7.14543 -0.0995279 7.86311 0.298584 8.30739L6.00485 14.6753C6.40296 15.1082 7.05627 15.1082 7.44417 14.6753Z"
                                fill="#0065B3"></path>
                        </svg>
                    </button>
                    <span class="idsk-search-results__page-number__mobile"></span>
                    <button type="button" class="idsk-search-results__button--forward__mobile disabled">
                        <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5558 0.324663C12.1577 0.768939 12.1577 1.48662 12.5558 1.93089L16.5063 6.36226L1.0208 6.36226C0.45936 6.36226 1.90735e-06 6.87488 1.90735e-06 7.50142C1.90735e-06 8.12797 0.45936 8.64059 1.0208 8.64059L16.5063 8.64059L12.5456 13.0606C12.1475 13.5048 12.1475 14.2225 12.5456 14.6668C12.9437 15.1111 13.5868 15.1111 13.9849 14.6668L19.7014 8.29884C20.0995 7.85457 20.0995 7.13689 19.7014 6.69261L13.9952 0.324663C13.597 -0.108221 12.9437 -0.108221 12.5558 0.324663Z"
                                fill="#0065B3"></path>
                        </svg>
                    </button>
                </div>
                <div class="idsk-search-results__content__picked-filters govuk-grid-column-full hide-forced">
                    <div class="idsk-search-results__content__picked-filters__content-type idsk-search-results--invisible">
                        <span class="idsk-search-results__text"><?php _e('Vybraté filtre', 'vicepremier'); ?></span>
                    </div>
                    <button
                        class="idsk-search-results__button--turn-filters-off govuk-grid-column-full idsk-search-results--invisible disabled"
                        type="button"><?php _e('Vypnúť všetky filtre', 'vicepremier'); ?>
                    </button>
                </div>
                <div class="govuk-grid-column-full idsk-search-results__show-results__button idsk-search-results--invisible">
                    <button class="govuk-button idsk-search-results__button-show-results" type="button" disabled>
                    </button>
                </div>
                <div class="idsk-search-results__content__all">
                </div>
                <div class="idsk-search-results__content__page-changer govuk-grid-column-full">
                    <button type="button" class="idsk-search-results__button--back idsk-search-results--hidden" disabled>
                        <svg class="idsk-search-results__button__svg--previous" width="20" height="15"
                            viewBox="0 -2 25 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.2925 13.8005C7.6825 13.4105 7.6825 12.7805 7.2925 12.3905L3.4225 8.50047H18.5925C19.1425 8.50047 19.5925 8.05047 19.5925 7.50047C19.5925 6.95047 19.1425 6.50047 18.5925 6.50047H3.4225L7.3025 2.62047C7.6925 2.23047 7.6925 1.60047 7.3025 1.21047C6.9125 0.820469 6.2825 0.820469 5.8925 1.21047L0.2925 6.80047C-0.0975 7.19047 -0.0975 7.82047 0.2925 8.21047L5.8825 13.8005C6.2725 14.1805 6.9125 14.1805 7.2925 13.8005Z"
                                fill="#0065B3"></path>
                        </svg>
                    </button>
                    <button type="button" class="idsk-search-results__button--forward" disabled>
                        <svg class="idsk-search-results__button__svg--next" width="20" height="13"
                            viewBox="-5 0 25 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5558 0.281376C12.1577 0.666414 12.1577 1.2884 12.5558 1.67344L16.5063 5.51395L1.0208 5.51395C0.45936 5.51395 1.90735e-06 5.95823 1.90735e-06 6.50123C1.90735e-06 7.04424 0.45936 7.48851 1.0208 7.48851L16.5063 7.48851L12.5456 11.3192C12.1475 11.7042 12.1475 12.3262 12.5456 12.7112C12.9437 13.0963 13.5868 13.0963 13.9849 12.7112L19.7014 7.19233C20.0995 6.80729 20.0995 6.1853 19.7014 5.80027L13.9952 0.281376C13.597 -0.0937901 12.9437 -0.0937901 12.5558 0.281376Z"
                                fill="#0065B3"></path>
                        </svg>
                    </button>
                    <div class="idsk-search-results__page-number govuk-grid-column-full">
                        <span data-lines=""></span>
                    </div>
                </div>
            </div>
            <div class="idsk-search-results__content govuk-grid-column-three-quarters">
                <div class="idsk-search-results__content__all">
                    <div id="search-page" class="col-lg-18 col-lg-pull-6">
                        <div class="search-first">
                            <h2><?php _e('Vyhľadávam...', 'vicepremier'); ?></h2>
                        </div>
                        <!-- #search -->
                        <div id="search" class="offsetmobile">
                            <div id="search-results-count">
                                <div class="-terms">
                                    <?php _e('Celkovo', 'vicepremier'); ?> <span id="countSearch">0</span> <span
                                        id="count1"><?php _e('výsledok', 'vicepremier'); ?></span> <span
                                        id="count2"><?php _e('výsledky', 'vicepremier'); ?></span> <span
                                        id="count3"><?php _e('výsledkov', 'vicepremier'); ?></span>

                                    <div id="search-title" class="hidden">
                                        <?php _e('z toho', 'vicepremier'); ?>

                                    </div>
                                </div>
                            </div>

                            <div id="tempResult" class="results">
                                <div class="card-wrapper" id="{{id-result}}">
                                    <h2>{{heading}}</h2>
                                    <div class="result-list">
                                        <div class="result idsk-card idsk-card-basic-variant">
                                            <div class="idsk-card-content idsk-card-content-basic-variant">
                                                <div class="idsk-heading idsk-heading-basic-variant govuk-link">
                                                    {{article-link}}
                                                </div>
                                                <div class="idsk-card-meta-container">
                                                    <span class="idsk-card-meta idsk-card-meta-date">
                                                        {{date}}
                                                    </span>
                                                    <span class="idsk-card-meta idsk-card-meta-tag">
                                                        {{category-link}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="search-wrapper" class="card-search-wrapper">

                                </div>
                            </div>

                        </div>
                        <!-- /#search -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page -->
<?php get_footer(); ?>