<?php
get_header(); // Include header.php

// Query to get the latest blog posts
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged
);
$blog_query = new WP_Query($args);
?>

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

<!-- Blog Posts List -->
<div class="blog-container">
    <h2>Blog</h2>
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Zoek...">
        <button id="searchButton">
        <i class="fas fa-search"></i> <!-- Font Awesome search icon -->
        </button>
    </div>

    <div class="post-list">
        <?php if ($blog_query->have_posts()) : ?>
            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <div class="post-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="post-content">
                            <span class="post-category"><?php echo get_the_category_list(', '); ?></span> <!-- Add the category tag-->
                            <h3><?php the_title(); ?></h3>
                            <p class="post-date"><?php the_time('j F Y'); ?></p>
                            <p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Lees meer</a>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>

    <!-- Pagination with JavaScript -->
    <div class="pagination">
        <span id="pagination"></span>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    let currentPage = <?php echo $paged; ?>;
    let maxPages = <?php echo $blog_query->max_num_pages; ?>;

    // Render pagination
    function renderPagination(current, max) {
        let paginationHTML = '';
        for (let i = 1; i <= max; i++) {
            if (i == current) {
                paginationHTML += `<span class="current-page">${i}</span>`;
            } else {
                paginationHTML += `<a href="#" class="page-number" data-page="${i}">${i}</a>`;
            }
        }
        document.getElementById('pagination').innerHTML = paginationHTML;
    }

    renderPagination(currentPage, maxPages);

    // Event listener for pagination links
    document.querySelectorAll('.page-number').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const page = this.getAttribute('data-page');
            window.location.href = `<?php echo get_pagenum_link(); ?>page/${page}`;
        });
    });

    // Search posts by keywords
    function searchPosts() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let posts = document.querySelectorAll('.post-item');

        posts.forEach(function(post) {
            let title = post.querySelector('h3').innerText.toLowerCase();
            if (title.includes(input)) {
                post.style.display = 'block';
            } else {
                post.style.display = 'none';
            }
        });
    }

    // Add event listener to the search button
    document.getElementById('searchButton').addEventListener('click', function() {
        searchPosts();
    });

    // Add event listener to the search input for real-time searching
    document.getElementById('searchInput').addEventListener('input', function() {
        searchPosts();
    });
});



    </script>
</div>

<?php
wp_reset_postdata(); // Reset the global $post variable after the custom query
get_footer(); // Include footer.php
?>
