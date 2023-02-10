<?php
    require_once("../../../wp-load.php");
	
	ini_set('memory_limit', '256M');
	
    $allItems = new stdClass();
    
    $postTypes = ['page', 'sekcie', 'clanky', 'podpredseda-vlady', 'urad', 'projekty', 'kariera', 'kariera_en', 'mpsr'];
    

	try {
		foreach($postTypes as $type) {
			$args = array(
				'post_type' => $type,
				'posts_per_page'=>-1
			);
			
			$the_query = new WP_Query( $args );
			
			$items = [];
			
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					
					$object = new stdClass();
					
					$object->type = $type;
					
					$object->title = get_the_title();
					
					$content = get_the_content();
					$content = preg_replace("/<img[^>]+\>/i", " ", $content);          
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]>', $content);
		
					$object->content = $content;
					$object->meta = get_post_meta( get_the_ID() );
					$object->fields = []; //get_field_objects(get_the_ID());
					$object->terms = get_category_for_article(get_the_ID());
					$object->id = get_the_ID();
					$object->url = get_the_permalink();
					$object->date = get_the_date('j. F Y');
					$object->dateDefault = get_the_date('Y.n.j');
					if (strtotime(get_the_date('d-m-Y')) < strtotime('1 July 2020')) {
						$object->tmpImage = get_field('nahladovy_obrazok', 'options')['url'];
					} else {
						$object->tmpImage = get_field('nahladovy_obrazok_mirri', 'options')['url'];
					}
					
					if($type == 'clanky') {
						$terms = get_the_terms( get_the_ID(), 'post_tag');
						$termsIds = [];
						
						foreach($terms as $t) {
							array_push($termsIds, $t->term_id);    
						}
						
						$object->tags = $termsIds;
					}
					
					$items[] = $object;
				}
				
				wp_reset_postdata();
			}
			
			$allItems->{$type} = $items; 
		}

		$searchFile = fopen("search.json", "w") or die("Unable to open file!");
		$jsonEncoded = json_encode($allItems);
		
		if ($jsonEncoded) {
			$jsonEncoded = str_replace(str_replace('"', '', json_encode(home_url('/'))), '\/', $jsonEncoded);
		} else {
			echo json_last_error_msg();
			$jsonEncoded = '';
		}

		fwrite($searchFile, $jsonEncoded);
		
		fclose($searchFile);
		
		echo "1";
	} catch (Exception $e) {
		echo $e->getMessage(); die();
	}
?>
