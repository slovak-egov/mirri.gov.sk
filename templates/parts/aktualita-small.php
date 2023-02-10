<?php

$aktId = $args['id'];
$vybrataKategoria = $args['cat'];
$isMpsr = $args['isMpsr'];

?>
<div class="idsk-card idsk-card-basic-variant">
    <div class="idsk-card-content idsk-card-content-basic-variant">
        <div class="idsk-heading idsk-heading-basic-variant">
            <a href="<?php echo get_permalink($aktId); ?>" class="idsk-card-title govuk-link" title="<?php echo get_the_title($aktId); ?>">
                <?php echo get_the_title($aktId); ?>
            </a>
        </div>
        <div class="idsk-card-meta-container">
            <?php if($isMpsr || is_null($isMpsr)): ?>
                <span class="idsk-card-meta idsk-card-meta-date">
                    <a href="<?php echo get_permalink($aktId); ?>" class="govuk-link" title="Pridané dňa: <?php echo get_the_date('j.n.Y', $aktId); ?>">
                        <?php echo get_the_date('j.n.Y', $aktId); ?>
                    </a>
                </span>             
            <?php endif; ?>
            <?php 
                if(empty($vybrataKategoria)) {
                    $taxonomies = get_category_for_article($aktId)[0];
                } else {
                    $taxonomies = $vybrataKategoria;
                }
            ?>  
            <span class="idsk-card-meta idsk-card-meta-tag">
                <a href="<?php echo $taxonomies->url; ?>" class="govuk-link" target="_self" title="<?php echo mb_strtoupper($taxonomies->name); ?>">
                    <?php echo mb_strtoupper($taxonomies->name); ?>
                </a>
            </span>
        </div>
    </div>
</div>