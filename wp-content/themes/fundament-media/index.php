<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fundament-media
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="hero-section">
        <div class="hero-content">
            <h1>Presale</h1>
            <p>‘Maximaal inspelen van de markt’</p>
            <div class="hero-buttons">
                <a href="#" class="cta-button primary">Contact</a>
                <a href="#" class="cta-button secondary">Meer weten</a>
            </div>
        </div>
    </section>

    <section class="blog-section">
        <div class="container">
            <h2 class="section-title">Blog</h2>

            <div class="search-bar">
                <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                    <label>
                        <input type="search" class="search-field" placeholder="Zoek..." value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                    <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <?php if ( have_posts() ) : ?>
                <div class="blog-posts-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </a>
                            <div class="post-content">
                                <h3 class="post-title"><?php the_title(); ?></h3>
                                <p class="post-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="cta-button secondary">Lees meer</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="pagination">
                    <?php
                    // Пагинация с использованием встроенной функции WordPress
                    the_posts_pagination( array(
                        'prev_text' => __( '&laquo;', 'textdomain' ),
                        'next_text' => __( '&raquo;', 'textdomain' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'textdomain' ) . ' </span>',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </div>
    </section>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
