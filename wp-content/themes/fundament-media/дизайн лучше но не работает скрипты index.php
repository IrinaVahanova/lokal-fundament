<?php
get_header(); // Include the header.php template

// Start the loop to display blog posts
?>

<main class="homepage">
    <!-- Hero Section -->
    <section class="hero">
        <img src="https://fundament-all-media.orangeblueai.com/wp-content/uploads/2024/10/banner-home.png" alt="Hero Image">
        <div class="hero-text">
            <h1>Presale</h1>
            <p>Maximaal inspelen van de markt</p>
            <a href="#" class="button">Contact</a>
            <a href="#" class="button-outline">Meer weten</a>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="container">
            <h2>Blog</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Zoek">
                <button id="searchBtn">Search</button>
            </div>

            <div class="post-list" id="postList">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6, // Display 6 posts per page
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
                );
                $blog_query = new WP_Query($args);

                if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post();
                        ?>
                        <div class="post-item">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                                <div class="post-content">
                                    <span class="post-date"><?php the_time('j F Y'); ?></span>
                                    <h3 class="post-title"><?php the_title(); ?></h3>
                                    <p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="button">Lees meer</a>
                                </div>
                            </a>
                        </div>
                    <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>

            <!-- Pagination -->
            <div class="pagination" id="pagination">
                <?php
                $total_pages = $blog_query->max_num_pages;
                if ($total_pages > 1) :
                    $current_page = max(1, get_query_var('paged'));
                    ?>
                    <span class="page-number" data-page="1">1</span>
                    <?php for ($i = 2; $i <= $total_pages; $i++) : ?>
                        <span class="page-number" data-page="<?php echo $i; ?>"><?php echo $i; ?></span>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); // Include the footer.php template ?>
