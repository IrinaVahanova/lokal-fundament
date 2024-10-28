<?php
/**
 * The template for displaying all single posts
 *
 * @package fundament-media
 */

// Include the header template
get_header();
?>

<main id="primary" class="site-main">
    <style>
        .site-header {
            background-color: #FFFFFF;
        }
    </style>

    <?php
    // Start the loop to display the post content
    while (have_posts()):
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="single-post-container">
                <?php
                // Check if the post has a featured image and display it
                if (has_post_thumbnail()): ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('full'); // Display the full-size featured image ?>
                    </div>

                <?php endif; ?>

                <div class="post-content">
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); // Display the post title ?></h1>
                        <span
                            class="post-category"><?php the_category(', '); // Display the categories of the post ?></span>
                        <div class="post-meta">
                            <span
                                class="post-date"><?php echo get_the_date(); // Display the post publication date ?></span>
                            |
                            <span class="post-author"><?php esc_html_e('Geplaatst door', 'fundament-media'); ?>
                                <?php the_author(); // Display the author's name ?></span>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); // Display the post content ?>
                    </div>

                    <footer class="entry-footer">
                        <div class="social-share">
                            <span><?php esc_html_e('Deel', 'fundament-media'); // Display the "Share" label ?></span>
                            <br>
                            <!-- Social media share buttons -->
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        </div>
                    </footer>
                </div>
            </div>
        </article>

        <?php
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
// Include the footer template
get_footer();
