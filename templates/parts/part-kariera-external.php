<?php

$category = get_sub_field('pp_kategoriy');

$request = wp_remote_get("https://ats.nalgoo.com/api/rest/job-offer?api_key=" . NALGOO_API_KEY);

if(is_wp_error($request)) {
	echo '';
} else {
	$body = wp_remote_retrieve_body( $request );
	$data = json_decode( $body );

	function printRegions($list, $regions) {
		$regionsList = [];

		foreach($list as $l) {
			foreach($regions as $r) {
				if($r->id === $l) {
					$regionsList[] = $r->name;
				}
			}
		}
		return implode(', ', $regionsList);
	}

	$jobs = [];
	$regions = [];

	$request = wp_remote_get("https://ats.nalgoo.com/api/rest/code-list/region?api_key=" . NALGOO_API_KEY);

	if(is_wp_error($request)) {
		echo '';
	} else {
		$resRegions = wp_remote_retrieve_body( $request );
		$regions = json_decode( $resRegions );
	}

	foreach($data as $job) {
		$request = wp_remote_get("https://ats.nalgoo.com/api/rest/job-offer/" . $job->id . "?api_key=" . NALGOO_API_KEY);

		if(is_wp_error($request)) {
		} else {
			$jobBody = wp_remote_retrieve_body( $request );
			$jobData = json_decode( $jobBody );

			if(slugify($jobData->company) === $category) {
				$jobs[] = $jobData;
			}
		}
	}
	// show
	?>
		<div data-module="idsk-crossroad" class="idsk-job-external" class="">
			<div class="idsk-crossroad idsk-crossroad-1">
				<?php
					foreach ($jobs as $job):
						?>
							<div class="idsk-crossroad__item">
								<a href="<?=$job->apply_url ?>" class="govuk-link idsk-crossroad-title" title="<?=$job->name ?>"
									aria-hidden="false" target="_blank"><?=$job->name ?></a>
								<div class="govuk-grid-row">
									<div class="govuk-grid-column-three-quarters">
										<p class="idsk-crossroad-subtitle" aria-hidden="false">
											<b><?php _e('Lokalita', 'vicepremier'); ?>:</b> <?php echo printRegions($job->regions, $regions); ?>
											<b><?php _e('Plat', 'vicepremier'); ?>:</b> <?php echo $job->salary_text; ?>
										</p>
									</div>
									<div class="govuk-grid-column-one-quarter">
										<a href="<?=$job->apply_url ?>" role="button" draggable="false"
											class="idsk-button idsk-button--start" data-module="idsk-button">
											<?php _e('Zobraziť', 'vicepremier'); ?>
											<svg class="idsk-button__start-icon" xmlns="http://www.w3.org/2000/svg" width="17.5" height="19"
												viewBox="0 0 33 40" role="presentation" focusable="false">
												<path fill="currentColor" d="M0 0h13l20 20-20 20H0l20-20z" />
											</svg>
										</a>

									</div>
								</div>
								<hr class="idsk-crossroad-line" aria-hidden="true" />
							</div>
						<?php 
					endforeach;
				?>
			</div>
		</div>
	<?php
}