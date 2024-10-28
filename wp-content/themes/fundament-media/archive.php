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
        <h1>Presale
        <br>‘Maximaal inspelen van de markt’</h1>
        <div class="cta-buttons">
            <a href="#" class="button">Contact</a>
            <a href="#" class="button-outline">Meer weten</a>
        </div>
    </div>
</div>

   

    
    

    <!-- Blog Posts List -->
    <div class="blog-container">
         <!-- Archive title and description -->
    <div class="category-header">
        <h1 class="category-title"><?php the_archive_title(); ?></h1>
        <div class="category-description"><?php the_archive_description(); ?></div>
    </div>
        <!-- Search Form -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Nieuwbouw">
        <button id="searchButton"><i class="fas fa-search"></i></button>
    </div>

    <h3><?php echo $wp_query->found_posts; ?> Resultaten gevonden</h3>
    <div class="post-list">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="post-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="post-content">
                            <span class="post-category"><?php echo get_the_category_list(', '); ?></span>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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



    <div class="post-list">
        <?php if ($blog_query->have_posts()) : ?>
            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <div class="post-item">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>                   
                        <div class="post-content">
                        <span class="post-category"><?php echo get_the_category_list(', '); ?></span>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more">Lees meer</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>



    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php echo paginate_links(); ?>
    </div>

</main><!-- #main -->

<?php
get_footer();
?>
