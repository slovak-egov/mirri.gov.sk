<?php

$aktId = $args['id'];
$mgt = $args['addedClass'];
$vybrataKategoria = $args['cat'];

?>
<div class="idsk-card idsk-card-secondary">

    <a href="<?php echo get_permalink($aktId); ?>" title="<?php echo get_the_title($aktId); ?>">
        <img class="idsk-card-img idsk-card-img-secondary" width="100%" src="<?php echo get_field('nahladovy_obrazok_perex',$aktId); ?>" alt="<?php echo get_the_title($aktId); ?>" aria-hidden="true" />
    </a>
    
    <div class="idsk-card-content idsk-card-content-secondary <?php echo $mgt; ?>">
        <div class="idsk-card-meta-container">
            <span class="idsk-card-meta idsk-card-meta-date">
                <a href="<?php echo get_permalink($aktId); ?>" class="govuk-link" title="<?php _e('Pridané dňa', 'vicepremier'); ?>: <?php echo get_the_date('j.n.Y', $aktId); ?>"><?php echo get_the_date('j.n.Y', $aktId); ?></a>
            </span> 
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


        <div class="idsk-heading idsk-heading-secondary">
            <a href="<?php echo get_permalink($aktId); ?>" class="idsk-card-title govuk-link" title="<?php echo get_the_title($aktId); ?>"><?php echo get_the_title($aktId); ?></a>
        </div>
    </div>
</div>