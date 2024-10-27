<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fundament-media
 */

get_header();
?>

<main id="primary" class="site-main blog-category">

<div class="hero">
    <div class="hero-text">
        <h1>Presale</h1>
        <p>‘Maximaal inspelen van de markt’</p>
        <div class="cta-buttons">
            <a href="#" class="button">Contact</a>
            <a href="#" class="button-outline">Meer weten</a>
        </div>
    </div>
</div>

    <!-- Archive title and description -->
    <div class="category-header">
        <h1 class="category-title"><?php the_archive_title(); ?></h1>
        <div class="category-description"><?php the_archive_description(); ?></div>
    </div>

    <!-- Search Form -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Zoek...">
        <button id="searchButton"><i class="fas fa-search"></i></button>
    </div>

    <!-- Blog Posts List -->
    <div class="post-list">
        <?php if ( have_posts() ) : ?>
            <p><?php echo $wp_query->found_posts; ?> Resultaten gevonden</p>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="post-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="post-content">
                            <span class="post-category">Blog</span>
                            <h3><?php the_title(); ?></h3>
                            <p class="post-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Lees meer</a>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Geen berichten gevonden.</p>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php echo paginate_links(); ?>
    </div>

</main><!-- #main -->

<?php
get_footer();
?>
