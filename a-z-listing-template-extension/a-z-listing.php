<?php
/**
 * Default multicolumn template for the A-Z Listing plugin
 *
 * This template will be given the variable `$a_z_query` which is an instance
 * of `A_Z_Listing`.
 *
 * You can override this template by copying this file into your theme
 * directory.
 *
 * @package a-z-listing
 */

/**
 * This value indicates the number of posts to require before a second column
 * is created. However, due to the design of web browsers, the posts will flow
 * evenly between the available columns. E.g. if you have 11 items, a value of
 * 10 here will create two columns with 6 items in the first column and 5 items
 * in the second column.
 */
$a_z_listing_minpercol = 10;
?>
<div id="<?php $a_z_query->the_instance_id(); ?>" class="az-listing">
	<div class="az-letters-wrap">
		<div class="az-letters">
			<?php $a_z_query->the_letters(); ?>
		</div>
	</div>
	<?php if ( $a_z_query->have_letters() ) : ?>
	<div class="items-outer">
		<div class="items-inner">
			<?php
			while ( $a_z_query->have_letters() ) :
				$a_z_query->the_letter();
				?>
				<?php if ( $a_z_query->have_items() ) : ?>
					<?php
					$a_z_listing_item_count  = $a_z_query->get_the_letter_items_count();
					$a_z_listing_num_columns = max(
						1,
						min(
							16,
							ceil( $a_z_listing_item_count / $a_z_listing_minpercol )
						)
					);
					?>
					<div class="letter-section" id="<?php $a_z_query->the_letter_id(); ?>">
						<h2 class="letter-title">
							<span>
								<?php $a_z_query->the_letter_title(); ?>
							</span>
						</h2>
						<?php $a_z_listing_column_class = "max-$a_z_listing_num_columns-columns"; ?>
						<ul class="az-columns <?php /* echo esc_attr( $a_z_listing_column_class ); */ ?>">
							<?php
							//var_dump(get_class_methods($p));
							while ( $a_z_query->have_items() ) :
								$a_z_query->the_item();
								$a_z_query->get_the_item_object( 'I understand the issues!' );
								$item_id = $a_z_query->get_the_item_id();
								?>
								<li>
									<a href="<?php $a_z_query->the_permalink(); ?>"><?php echo get_the_title($item_id); ?></a>
									<?php 
										$storyLength = get_field('story-length', $item_id);
										if (!empty($storyLength)) {
											echo '&ndash;&nbsp;(' . $storyLength . 'kB)';
										}
									?>
									by
									<?php
										$authors = explode(',', get_post_meta($item_id, 'ppma_authors_name')[0]);
										$authors_count = 0;
										foreach($authors as $key => $author) {
											$authors_count++;
											if ($authors_count > 1)
												echo ' and ';
											echo $author;
										}
										$summary = get_field('story-summary', $item_id);
										if (!empty($summary))
											echo '<br/>' . htmlentities($summary);
									?>
								</li>
							<?php endwhile; ?>
						</ul>

						<div class="back-to-top">
							<a href="#<?php $a_z_query->the_instance_id(); ?>">
								<?php esc_html_e( 'Back to top', 'a-z-listing' ); ?>
							</a>
						</div>
					</div>
					<?php
				endif;
			endwhile;
			?>
		</div>
	</div>
	<?php else : ?>
		<p><?php esc_html_e( 'There are no posts included in this index.', 'a-z-listing' ); ?></p>
	<?php endif; ?>
</div>
