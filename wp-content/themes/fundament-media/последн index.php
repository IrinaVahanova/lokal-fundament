<?php
// Include the header template
get_header();
?>

<div class="homepage">

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <img src="https://fundament-all-media.orangeblueai.com/wp-content/uploads/2024/10/banner-home.png" alt="Hero Image" class="hero-image">
      <div class="hero-text">
        <h1>Presale</h1>
        <p>Maximaal inspelen van de markt</p>
        <a href="#" class="button">Contact</a>
        <a href="#" class="button-outline">Meer weten</a>
      </div>
    </div>
  </section>

  <!-- Blog Section -->
  <section class="blog">
    <div class="container">
      <h2>Blog</h2>

      <!-- Search Block -->
      <div class="search-block">
        <input type="text" id="searchInput" placeholder="Zoek...">
        <button onclick="searchPosts()">Search</button>
      </div>

      <!-- Blog Posts -->
      <div id="postList" class="post-list">
        <?php
        // Query to get the latest 6 posts
        $args = array(
          'posts_per_page' => 6,
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1
        );
        $the_query = new WP_Query($args);

        // Check if there are any posts
        if ($the_query->have_posts()) :
          while ($the_query->have_posts()) : $the_query->the_post();
        ?>
          <!-- Blog Post Item -->
          <div class="post-item">
            <a href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
              <?php endif; ?>
              <div class="post-content">
                <span class="post-date"><?php echo get_the_date(); ?></span>
                <h3><?php the_title(); ?></h3>
                <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                <a href="<?php the_permalink(); ?>" class="read-more">Lees meer</a>
              </div>
            </a>
          </div>
        <?php
          endwhile;
        else :
          echo '<p>No posts found.</p>';
        endif;
        wp_reset_postdata();
        ?>
      </div>

      <!-- Pagination -->
      <div id="pagination" class="pagination">
        <?php
        // Pagination links
        $total_pages = $the_query->max_num_pages;

        if ($total_pages > 1) {
          $current_page = max(1, get_query_var('paged'));

          echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => __('« Prev'),
            'next_text' => __('Next »'),
            'end_size' => 1,
            'mid_size' => 2
          ));
        }
        ?>
      </div>
    </div>
  </section>

</div>

<script>
// JavaScript for Pagination (no jQuery)
document.addEventListener("DOMContentLoaded", function() {
  const postsPerPage = 6; // Number of posts per page
  const postList = document.getElementById('postList');
  const pagination = document.getElementById('pagination');
  
  // Function to handle search
  function searchPosts() {
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const posts = postList.getElementsByClassName('post-item');

    for (let i = 0; i < posts.length; i++) {
      let postTitle = posts[i].querySelector('h3').innerText.toLowerCase();
      if (postTitle.includes(searchQuery)) {
        posts[i].style.display = 'block';
      } else {
        posts[i].style.display = 'none';
      }
    }
  }

  // Pagination logic
  function paginatePosts() {
    const totalPosts = postList.getElementsByClassName('post-item').length;
    let totalPages = Math.ceil(totalPosts / postsPerPage);
    let currentPage = 1;

    function showPage(page) {
      let start = (page - 1) * postsPerPage;
      let end = start + postsPerPage;
      let posts = postList.getElementsByClassName('post-item');

      for (let i = 0; i < posts.length; i++) {
        posts[i].style.display = (i >= start && i < end) ? 'block' : 'none';
      }
    }

    function createPagination() {
      pagination.innerHTML = '';
      for (let i = 1; i <= totalPages; i++) {
        let pageLink = document.createElement('button');
        pageLink.innerText = i;
        pageLink.addEventListener('click', function() {
          currentPage = i;
          showPage(currentPage);
        });
        pagination.appendChild(pageLink);
      }
    }

    showPage(currentPage);
    createPagination();
  }

  paginatePosts();
});
</script>

<?php
// Include the footer template
get_footer();
?>
