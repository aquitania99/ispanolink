<?php
/**
 * Single view Company information box
 *
 * Hooked into single_job_listing_start priority 30
 *
 * @since  1.14.0
 */

global $post;
// get our custom meta
$facebook_url = get_post_meta( get_the_ID(), '_company_facebook', true);
$location = get_post_meta( get_the_ID(), '_job_location', true);
$phone = get_post_meta( get_the_ID(), '_company_phone', true);
$email = get_post_meta( get_the_ID(), '_company_email', true);
//$abn = get_post_meta( get_the_ID(), '_company_abn', true);
//$twitter = get_post_meta( get_the_ID(), '_company_twitter', true);
?>
<div class="single-meta">
	<?php
	display_average_listing_rating();

	if ( ! empty( $phone ) ) :
		if ( strlen( $phone ) > 30 ) : ?>
			<a class="listing-contact  listing--phone" href="tel:<?php echo $phone; ?>" itemprop="telephone"><?php esc_html_e( 'Phone', 'listable' ); ?></a>
		<?php else : ?>
			<a class="listing-contact  listing--phone" href="tel:<?php echo $phone; ?>" itemprop="telephone"><?php echo $phone; ?></a>
		<?php endif; ?>
	<?php endif;

	if ( ! empty( $email ) ) { ?>
		<a class="listing-contact  listing--email" href="mailto:<?php echo $email; ?>" itemprop="email">
			<?php _e( 'Email', 'listable'); ?>
		</a>
	<?php }


	do_action( 'listable_single_job_listing_before_social_icons' );

	/**
	if ( ! empty( $twitter ) ) {
		$twitter = preg_replace("[@]", "", $twitter);
		if ( strlen( $twitter ) > 30 ) : ?>
			<a class="listing-contact  listing--twitter" href="https://twitter.com/<?php echo $twitter; ?>" itemprop="url"> <?php esc_html_e( 'Twitter', 'listable' ); ?></a>
		<?php else : ?>
			<a class="listing-contact  listing--twitter" href="https://twitter.com/<?php echo $twitter; ?>" itemprop="url">@<?php echo $twitter; ?></a>
		<?php endif; ?>
	<?php }
	 */
	if ( ! empty( $facebook_url ) ) {
		$fb_name = preg_replace('#^https?://facebook.com/#', '', rtrim(esc_url($facebook_url),'/'));
	?>
		<a class="listing-contact " href="<?php echo $facebook_url; ?>" target="_blank">
			<img src="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/wp-content/uploads/2016/05/0399-facebook3.svg" style="width: 1em; position: relative; top: 0.2em;" alt="facebook"/>
			<span><?php _e( 'Facebook', 'listable'); ?></span>
		</a>
	<?php }

	do_action( 'listable_single_job_listing_after_social_icons' );

	if ( $website = get_the_company_website() ) {
		$website_pure = preg_replace('#^https?://#', '', rtrim(esc_url($website),'/'));
		if ( strlen( $website_pure ) ) : ?>
			<a class="listing-contact  listing--website" href="<?php echo esc_url( $website ); ?>" itemprop="url" target="_blank" rel="nofollow"><?php esc_html_e( 'Website', 'listable' ); ?></a>
<!--		--><?php //else : ?>
<!--			<a class="listing-contact  listing--website" href="--><?php //echo esc_url( $website ); ?><!--" itemprop="url" target="_blank" rel="nofollow">--><?php //echo $website_pure; ?><!--</a>-->
		<?php endif; ?>
	<?php }

	if ( ! empty( $abn ) ) { ?>
		<a class="listing-contact " href="#">
<!--			<img src="--><?php //echo "http://".$_SERVER['SERVER_NAME'];?><!--/wp-content/uploads/2016/05/email.svg" style="width: 1em" alt="facebook"/>-->
			<?php _e( 'ABN: '.$abn, 'listable'); ?>
		</a>
	<?php } ?>
</div>

