<?php
$data = [];
$druhy_institucii = [];
$institucie = [];
$mesta = [];
$oblasti_exp = [];
$odbory_exp = [];

while(have_rows('experti')){
    the_row();

    $newExpert = new stdClass();

    $newExpert->meno = get_sub_field('meno');
    $newExpert->druhy_institucie = get_sub_field('druh_institucie');
    $druhy_institucii = array_merge($druhy_institucii, $newExpert->druhy_institucie);
    
    $newExpert->institucie = [];

    while(have_rows('institucia')) {
        the_row();

        $newExpert->institucie[] = get_sub_field('nazov');
    }
    $institucie = array_merge($institucie, $newExpert->institucie);

    $newExpert->mesta = get_sub_field('mesto');
    $mesta = array_merge($mesta, $newExpert->mesta);
    $newExpert->oblasti_exp = get_sub_field('oblast_exp');
    $oblasti_exp = array_merge($oblasti_exp, $newExpert->oblasti_exp);
    $newExpert->odbory_exp = get_sub_field('odbory_exp');
    $odbory_exp = array_merge($odbory_exp, $newExpert->odbory_exp);
    $newExpert->popis = get_sub_field('strucny_popis_aktivit');
    $newExpert->aktualne = get_sub_field('aktualne')?_x('Áno', 'vicepremier'):_x('Nie', 'vicepremier');
    $newExpert->kurikulum = get_sub_field('kurikulum');
    $newExpert->pos = [
        'lat' => get_sub_field('lokalita')['lat'],
        'lng' => get_sub_field('lokalita')['lng']
    ];

    $data[] = $newExpert;
}

$druhy_institucii = array_filter(array_unique($druhy_institucii));
$institucie = array_filter(array_unique($institucie));
$mesta = array_filter(array_unique($mesta));
$odbory_exp = array_filter(array_unique($odbory_exp));
$oblasti_exp = array_filter(array_unique($oblasti_exp));

usort($data, function($a, $b)
{
    return strcmp($a->meno, $b->meno);
});

$id = uniqid();

?>
<div data-module="idsk-table" class="experts" data-id="<?php echo $id; ?>">
    <div class="idsk-table__heading">
        <div>
            <h2 class="govuk-heading-l govuk-!-margin-bottom-4"><?php the_sub_field('exp_nadpis'); ?></h2>
            <p class="govuk-body"><?php the_sub_field('exp_popis'); ?></p>
        </div>
    </div>

    <div id="map" class="map-holder"></div>

    <script>
        experts['<?php echo $id; ?>'] = <?php echo json_encode($data); ?>;
    </script>

    <div data-module="idsk-table-filter" id="example-table-2-filter" class="idsk-table-filter ">
        <div class="idsk-table-filter__panel idsk-table-filter__inputs">
            <div class="idsk-table-filter__title govuk-heading-m"><?php _e('Filtrovať obsah', 'vicepremier'); ?></div>
            <button class="govuk-body govuk-link idsk-filter-menu__toggle" tabindex="0"
                data-open-text="<?php _e('Rozbaliť obsah filtra', 'vicepremier'); ?>"
                data-close-text="<?php _e('Zbaliť obsah filtra', 'vicepremier'); ?>" data-category-name=""
                aria-label="<?php _e('Rozbaliť obsah filtra', 'vicepremier'); ?>" type="button">
                <?php _e('Rozbaliť obsah filtra', 'vicepremier'); ?>
            </button>

            <form class="idsk-table-filter__content experts-form" action="#">
                <div class="govuk-grid-row idsk-table-filter__filter-inputs">
                    <div class="govuk-grid-column-one-half-from-desktop">
                        <div class="govuk-form-group">
                            <label class="govuk-label" for="druh_institucie">
                                <?php _e('Druh inštitúcie', 'vicepremier'); ?>
                            </label>
                            <select tabindex="-1" class="govuk-select" id="druh_institucie" name="druh_institucie">
                                <option value=""><?php _e('Vybrať druh inštitúcie', 'vicepremier'); ?></option>
                                <?php foreach($druhy_institucii as $m): ?>
                                    <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="govuk-grid-column-one-half-from-desktop">
                        <div class="govuk-form-group">
                            <label class="govuk-label" for="mesto">
                                <?php _e('Mesto', 'vicepremier'); ?>
                            </label>
                            <select tabindex="-1" class="govuk-select" id="mesto" name="mesto">
                                <option value=""><?php _e('Vybrať mesto', 'vicepremier'); ?></option>
                                <?php foreach($mesta as $m): ?>
                                    <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="govuk-grid-column-one-half-from-desktop">
                        <div class="govuk-form-group">
                            <label class="govuk-label" for="oblast_expertizy">
                                <?php _e('Oblasť expertízy', 'vicepremier'); ?>
                            </label>
                            <select tabindex="-1" class="govuk-select" id="oblast_expertizy" name="oblast_expertizy">
                                <option value=""><?php _e('Vybrať oblasť expertízy', 'vicepremier'); ?></option>
                                <?php foreach($oblasti_exp as $m): ?>
                                    <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="govuk-grid-column-one-half-from-desktop">
                        <div class="govuk-form-group">
                            <label class="govuk-label" for="aktualne">
                                <?php _e('Aktivity sú aktuálne', 'vicepremier'); ?>
                            </label>
                            <select tabindex="-1" class="govuk-select" id="aktualne" name="aktualne">
                                <option value=""><?php _e('Vybrať aktuálne aktivity', 'vicepremier'); ?></option>
                                <option value="<?php _e('Áno', 'vicepremier'); ?>"><?php _e('Aktivity sú aktuálne', 'vicepremier'); ?></option>
                                <option value="<?php _e('Nie', 'vicepremier'); ?>"><?php _e('Aktivity nie sú aktuálne', 'vicepremier'); ?></option>
                            </select>
                        </div>
                    </div>

                </div>
                <button type="submit" class="idsk-button submit-table-filter" disabled="disabled">
                    <?php _e('Filtrovať', 'vicepremier'); ?> (<span class="count">0</span>)
                </button>
            </form>
        </div>
        <div class="idsk-table-filter__panel idsk-table-filter__active-filters idsk-table-filter__active-filters__hide idsk-table-filter--expanded"
            data-remove-filter="<?php _e('Zrušiť filter', 'vicepremier'); ?>" data-remove-all-filters="<?php _e('Zrušiť všetko', 'vicepremier'); ?>">
            <div class="govuk-body idsk-table-filter__title"><?php _e('Aktívny filter', 'vicepremier'); ?></div>
            <button class="govuk-body govuk-link idsk-filter-menu__toggle" tabindex="0"
                data-open-text="<?php _e('Rozbaliť aktívny filter', 'vicepremier'); ?>" data-close-text="<?php _e('Zbaliť aktívny filter', 'vicepremier'); ?>" data-category-name=""
                aria-label="<?php _e('Zbaliť aktívny filter', 'vicepremier'); ?>" type="button">
                <?php _e('Zbaliť aktívny filter', 'vicepremier'); ?>
            </button>

            <div class="govuk-clearfix idsk-table-filter__content"></div>
        </div>
    </div>

    <div class="idsk-table-wrapper">
        <table class="idsk-table">

            <thead class="idsk-table__head">
                <tr class="idsk-table__row">
                    <th scope="col" class="idsk-table__header name-cell">
                        <span class="th-span">
                            <?php _e('Meno', 'vicepremier'); ?>
                            <button 
                                class="arrowBtn asc"
                                data-none="<?php _e('Nezoradený stĺpec.', 'vicepremier'); ?>"
                                data-asc="<?php _e('Vzostupne zoradený stĺpec.', 'vicepremier'); ?>"
                                data-desc="<?php _e('Zostupne zoradený stĺpec.', 'vicepremier'); ?>"
                                data-col="meno"
                            >
                                <span class="sr-only">
                                    <?php _e('Vzostupne zoradený stĺpec.', 'vicepremier'); ?>
                                </span>
                            </button>
                        </span>
                    </th>
                    <th scope="col" class="idsk-table__header">
                        <span class="th-span">
                            <?php _e('Stručný popis aktivít', 'vicepremier'); ?>
                            <button 
                                class="arrowBtn"
                                data-none="<?php _e('Nezoradený stĺpec.', 'vicepremier'); ?>"
                                data-asc="<?php _e('Vzostupne zoradený stĺpec.', 'vicepremier'); ?>"
                                data-desc="<?php _e('Zostupne zoradený stĺpec.', 'vicepremier'); ?>"
                                data-col="popis"
                            >
                                <span class="sr-only">
                                    <?php _e('Nezoradený stĺpec.', 'vicepremier'); ?>
                                </span>
                            </button>
                        </span>
                    </th>
                    <th scope="col" class="idsk-table__header">
                        <span class="th-span">
                            <?php _e('Podrobnejšie kurikulum aktivity', 'vicepremier'); ?>
                        </span>
                    </th>
                    <th scope="col" class="idsk-table__header show-more-cell">
                        <span class="th-span">
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody class="idsk-table__body">
                <?php
                $id = uniqid('experts-');
                $i = 0;
                foreach($data as $d):
                    ?>
                    <tr class="idsk-table__row header-row" id="<?php echo $id . $i; ?>">
                        <td class="idsk-table__cell name-cell">
                            <strong><?php echo $d->meno; ?></strong><br/>
                            <?php echo join($d->institucie, ', '); ?>
                        </td>
                        <td class="idsk-table__cell"><?php echo $d->popis; ?></td>
                        <td class="idsk-table__cell link-cell"><a href="<?php echo $d->kurikulum['url']; ?>" target="_blank"><?php echo $d->kurikulum['title']?$d->kurikulum['title']:$d->kurikulum['url']; ?></a></td>
                        <td class="idsk-table__cell show-more-cell">
                            <div class="show-more">
                            </div>
                        </td>
                    </tr>
                    <tr class="idsk-table__row hidden-row additional-row" data-id="<?php echo $id . $i++; ?>">
                        <td class="idsk-table__cell" colspan="4">
                            <div class="cell-content">
                                <strong><?php _e('Druh inštitúcie', 'vicepremier'); ?></strong>: <?php echo join($d->druhy_institucie, ', '); ?><br/>
                                <strong><?php _e('Mesto', 'vicepremier'); ?></strong>: <?php echo join($d->mesta, ', '); ?><br/>
                                <strong><?php _e('Oblasť expertízy', 'vicepremier'); ?></strong>: <?php echo join($d->oblasti_exp, ', '); ?><br/>
                                <strong><?php _e('Odbory expertízy', 'vicepremier'); ?></strong>: <?php echo join($d->odbory_exp, ', '); ?><br/>
                                <strong><?php _e('Aktivity sú aktuálne', 'vicepremier'); ?></strong>: <?php echo $d->aktualne; ?><br/>
                            </div>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>