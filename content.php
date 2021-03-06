<?php
/**
 * The default template for displaying content
 *
 * @package Catch Themes
 * @subpackage Adventurous
 * @since Adventurous 1.0
 */

//Getting data from Theme Options Panel and Meta Box
global $adventurous_options_settings;
$options = $adventurous_options_settings;

//Content Layout
$current_content_layout = $options['content_layout'];

//More Tag
$moretag = $options[ 'more_tag_text' ];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <div class="featured-sticky"><?php _e( 'Featured post', 'adventurous' ); ?></div>
    <?php endif; ?>

    <?php if ( function_exists( 'adventurous_content_image' ) ) : adventurous_content_image(); endif; ?>

    <div class="entry-container">

		<header class="entry-header">
    		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'adventurous' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->

		<?php
		//Get Excerpt
		$adventurous_excerpt = get_the_excerpt();

		if ( $current_content_layout=='excerpt' && !empty( $adventurous_excerpt ) ) : ?>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
		<?php else : ?>
            <div class="entry-content">
                <?php the_content( $moretag ); ?>
                <?php wp_link_pages( array(
					'before'		=> '<div class="page-link"><span class="pages">' . __( 'Pages:', 'adventurous' ) . '</span>',
					'after'			=> '</div>',
					'link_before' 	=> '<span>',
					'link_after'   	=> '</span>',
				) );
				?>
            </div><!-- .entry-content -->
        <?php endif; ?>

        <footer class="entry-meta">
            <?php adventurous_header_meta(); ?>
            <?php edit_post_link( __( 'Edit', 'adventurous' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'adventurous_author_bio_avatar_size', 68 ) ); ?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'adventurous' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'adventurous' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
        </footer><!-- .entry-meta -->

  	</div><!-- .entry-container -->

</article><!-- #post-<?php the_ID(); ?> -->
