<?php
session_start();
include "core.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="landing/styles.css" />
    <title>WristLux.Co</title>
  </head>
  <body>
    <header class="section__container header__container">
      <nav>
        <div class="nav__bar">
          <div class="nav__logo">
            <a href="#"><img src="landing/assets/logo.png" alt="logo" /></a>
          </div>
          <form action="/">
            <input type="text" placeholder="Search" />
            <button type="submit"><i class="ri-search-line"></i></button>
          </form>
        </div>
        <div class="nav__btn">
        <?php
          if(isset($_SESSION['email']) && ($_SESSION['role_id'] === 2 || $_SESSION['role_id'] === 3)){
              echo '<a href="store.php"><span><i class="ri-admin-line"></i></span></a>';
          }
          ?>
          <a href="landing/login_page.php"><span><i class="ri-login-box-line"></i></span></a>
        </div>
      </nav>
      <div class="header__content">
        <h1>Expl<span>o</span>re New Things</h1>
        <p class="section__description">
        Welcome to WristLux.Co, your premier destination for luxury timepieces. 
        Explore an exquisite collection of watches crafted to elevate your elegance and sophistication. 
        Dive into a world of horological excellence, where each timepiece embodies precision engineering and timeless style. 
        Discover the latest trends and enduring classics, curated to meet the desires of every watch enthusiast. 
        Elevate your wristwear collection with WristLux.Co and immerse yourself in the epitome of luxury and style.
        </p>
        <button class="btn">
          <a href="products.php"><span><i class="ri-add-line"></i></span></a> Go To Store
        </button>
      </div>
      <div class="header__image">
        <div class="header__socials">
        <?php
              // Check if user is logged in
              if(isset($_SESSION['email'])){
                  // If logged in, display link to settings page
                  echo '<a href="settings.php"><span><i class="ri-settings-3-line"></i></span></a>';
              } else {
                  // If not logged in, redirect to login page
                  echo '<a href="landing/login_page.php"><span><i class="ri-settings-3-line"></i></span></a>';
              }
            ?>
        <a href="logout.php"><span><i class="ri-logout-box-line"></i></span></a>
          <!-- <a href="#"><i class="ri-instagram-line"></i></a>
          <a href="#"><i class="ri-pinterest-line"></i></a>
          <a href="#"><i class="ri-facebook-fill"></i></a> -->
        </div>
      </div>
    </header>

    <section class="trending__container">
      <div class="section__container trending__header">
        <div class="section__nav">
          <span><i class="ri-arrow-left-s-line"></i></span>
          <span><i class="ri-arrow-right-s-line"></i></span>
        </div>
        <h2 class="section__header">Trending <span>Collection</span></h2>
      </div>
      <!-- Slider main container -->
      <div class="swiper trending__swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <?php
// Establish a database connection
include "connection.php";


// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Query to fetch items added by user with ID number 1
$user_id = 2; // Change this to the desired user ID
$sql = "SELECT * FROM items WHERE user_id = $user_id";
$result = $con->query($sql);

// Display items in the desired format
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<div class="swiper-slide trending__swiper-slide">';
    echo '  <div class="trending__card">';
    echo '    <img src="' . $row["image"] . '" alt="trending" />';
    echo '    <div class="trending__card__content">';
    echo '      <div class="trending__btns">';
    echo '        <button><i class="ri-heart-3-fill"></i></button>';
    echo '        <button><i class="ri-shopping-bag-fill"></i></button>';
    echo '      </div>';
    echo '      <div class="trending__card__details">';
    echo '        <h4>' . $row["name"] . '</h4>';
    // echo '        <p>Style: ' . $row["style"] . '</p>'; // Assuming there is a 'style' column in the items table
    echo '        <h3>' .'$'. $row["price"] . '</h3>';
    echo '      </div>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
  }
} else {
  echo "0 results";
}

// Close the database connection
$con->close();
?>

          
        </div>
      </div>
    </section>

    <section class="trending__container">
    
    <h2 class="section__header" style="margin-left:10%;">From Partner <span>Stores</span></h2>
      <!-- Slider main container -->
      <div class="swiper trending__swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <?php
// Establish a database connection
include "connection.php";

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Query to fetch 10 random items added by users with role_id = 2 and user_id != 2
$sql = "SELECT * FROM items WHERE user_id IN (SELECT id FROM users WHERE role_id = 2 AND id != 2) ORDER BY RAND() LIMIT 10";
$result = $con->query($sql);

// Display items in the desired format
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<div class="swiper-slide trending__swiper-slide">';
    echo '  <div class="trending__card">';
    echo '    <img src="' . $row["image"] . '" alt="trending" />';
    echo '    <div class="trending__card__content">';
    echo '      <div class="trending__btns">';
    echo '        <button><i class="ri-heart-3-fill"></i></button>';
    echo '        <button><i class="ri-shopping-bag-fill"></i></button>';
    echo '      </div>';
    echo '      <div class="trending__card__details">';
    echo '        <h4>' . $row["name"] . '</h4>';
    // echo '        <p>Style: ' . $row["style"] . '</p>'; // Assuming there is a 'style' column in the items table
    echo '        <h3>' .'$'. $row["price"] . '</h3>';
    echo '      </div>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
  }
} else {
  echo "No new Arrivals Yet";
}

// Close the database connection
$con->close();
?>

        </div>
      </div>
    </section>



    <section class="trending__container">
    <h2 class="section__header" style="margin-left:10%;">Luxury <span>Collections</span></h2>
  <!-- Slider main container -->
  <div class="swiper trending__swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      <?php
      // Establish a database connection
      include "connection.php";

      // Check connection
      if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
      }

      // Query to fetch 10 random items added by users with IDs 7, 8, 9, and 10
      $sql = "SELECT * FROM items WHERE user_id IN (7, 8, 9, 10) ORDER BY RAND() LIMIT 10";
      $result = $con->query($sql);

      // Display items in the desired format
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<div class="swiper-slide trending__swiper-slide">';
          echo '  <div class="trending__card">';
          echo '    <img src="' . $row["image"] . '" alt="trending" />';
          echo '    <div class="trending__card__content">';
          echo '      <div class="trending__btns">';
          echo '        <button><i class="ri-heart-3-fill"></i></button>';
          echo '        <button><i class="ri-shopping-bag-fill"></i></button>';
          echo '      </div>';
          echo '      <div class="trending__card__details">';
          echo '        <h4>' . $row["name"] . '</h4>';
          // echo '        <p>Style: ' . $row["style"] . '</p>'; // Assuming there is a 'style' column in the items table
          echo '        <h3>' .'$'. $row["price"] . '</h3>';
          echo '      </div>';
          echo '    </div>';
          echo '  </div>';
          echo '</div>';
        }
      } else {
        echo "No new Arrivals Yet";
      }

      // Close the database connection
      $con->close();
      ?>
    </div>
  </div>
</section>



    


    

    <section class="section__container why__container">
      <div class="why__image">
        <img src="landing/assets/blog-2.jpeg" alt="why image"/>
      </div>
      <div class="why__content">
        <h2 class="section__header">Why Choose<br /><span>WristLux.Co</span></h2>
        <p class="section__description">
          Welcome to the ultimate destination for luxury watch enthusiasts! 
          Our luxury watch website is your premier source for the finest timepieces from renowned brands around the world. 
          Discover an exquisite collection of luxury watches, including elegant dress watches, 
          precision-engineered chronographs, sophisticated dive watches, and timeless classics for men and women alike.
      </p>
      
      <p class="section__description">
        From timeless classics like Rolex and Omega to cutting-edge innovations like TAG Heuer and Breitling, 
        we offer a diverse selection to suit every watch enthusiast. 
        Explore our curated collection of luxury timepieces, including elegant dress watches, 
        rugged sports watches, sophisticated chronographs, and avant-garde designs. 
        Whether you're attending a formal event, exploring the great outdoors, or making a bold fashion statement, 
        we've got you covered with the latest trends and enduring classics. 
        Step into a world of horological excellence and shop with confidence for your next luxury watch.
    </p>
    
        <button class="btn">
          <span><i class="ri-add-line"></i></span> Explore More
        </button>
      </div>
    </section>

    <section class="section__container testimonial__container">
      <h2 class="section__header"><span>WristLux.Co</span></h2>
      <p class="section__description">The legacy evolves</p>
      <!-- Slider main container -->
      <div class="swiper testimonial__swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide testimonial__swiper-slide">
            <div class="testimonial__card">
              <p>
                I'm a luxury watch enthusiast, and this website has become my go-to destination for all things timepieces. 
                The selection is extraordinary, and the detailed product descriptions helped me find the perfect luxury watch. 
                Plus, the fast shipping is a game-changer!
              </p>
            
              <h4>Sarah M. - Los Angeles, CA</h4>
            </div>
          </div>
          <div class="swiper-slide testimonial__swiper-slide">
            <div class="testimonial__card">
              <p>
                As a watch aficionado, I'm always on the lookout for the newest luxury timepieces. 
                This website makes it effortless to stay informed about new releases and even offers early access for members. 
                It's like a dream come true for any luxury watch enthusiast.
            </p>
            
              <h4>Alex T. - New York, NY</h4>
            </div>
          </div>
          <div class="swiper-slide testimonial__swiper-slide">
            <div class="testimonial__card">
              <p>
                I've been collecting luxury watches for years, but this website elevates the shopping experience to a whole new level. 
                The customer reviews were incredibly informative in guiding my decision, 
                and the sizing guides ensured I found the perfect fit every time.
            </p>
            
              <h4>David P. - Chicago, IL</h4>
            </div>
          </div>
        </div>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev">
          <span><i class="ri-arrow-left-s-line"></i></span>
        </div>
        <div class="swiper-button-next">
          <span><i class="ri-arrow-right-s-line"></i></span>
        </div>
      </div>
    </section>

    <section class="section__container story__container">
      <div class="story__content">
        <h2 class="section__header">WristLux.Co<br/><span>Stories</span></h2>
        <p class="section__description">
            Discover how he found elegance and sophistication in every moment with WristLux.Co luxury watches.
        </p>
        <div class="section__nav">
            <span><i class="ri-arrow-left-s-line"></i></span>
            <span><i class="ri-arrow-right-s-line"></i></span>
        </div>
    </div>
    <div class="story__card">
        <img src="landing/assets/blog-1.jpeg" alt="story" />
        <div class="story__card__content">
            <p class="section__description">
                Dive into the world of luxury timepieces with insightful perspectives and captivating designs.
            </p>
            <button class="btn">
                <span><i class="ri-add-line"></i></span> Explore More
            </button>
        </div>
    </div>
    <div class="story__card">
        <img src="landing/assets/blog-4.jpeg" alt="story" />
        <div class="story__card__content">
            <p class="section__description">
                Unveil the essence of refinement and craftsmanship through the eyes of watch enthusiasts.
            </p>
            <button class="btn">
                <span><i class="ri-add-line"></i></span> Explore More
            </button>
        </div>
    </div>
    <div class="story__card">
        <img src="landing/assets/blog-3.jpg" alt="story" />
        <div class="story__card__content">
            <p class="section__description">
                Experience the epitome of luxury and style, whether it's an adventurous journey or an elegant soirée.
            </p>
            <button class="btn">
                <span><i class="ri-add-line"></i></span> Explore More
            </button>
        </div>
    </div>
    
    </section>

    <section class="section__container">
      <div class="banner__container">
        <div class="banner__image">
          <img src="landing/assets/New_1.png" alt="banner" />
        </div>
        <div class="banner__content">
          <h2 class="section__header">
            Get Your Watches Now on <span>15%</span> Discount
          </h2>
          <p class="section__description">
            Explore a plethora of styles, sizes, and categories tailored to meet the desires of every watch aficionado. 
            Elevate your wristwear collection and immerse yourself in the world of luxury timepieces with WristLux.Co!
        </p>
        
          <button class="btn">
            <span><i class="ri-add-line"></i></span> Buy Now
          </button>
          <img src="landing/assets/New_11.png" alt="banner bg" class="banner__bg" />
        </div>
      </div>
    </section>

    <footer class="section__container footer__container">
      <div class="footer__col">
        <div class="footer__logo">
          <a href="#"><img src="landing/assets/logo.png" alt="logo" /></a>
        </div>
        <div class="footer__socials">
          <a href="#"><i class="ri-instagram-line"></i></a>
          <a href="#"><i class="ri-pinterest-line"></i></a>
          <a href="#"><i class="ri-facebook-fill"></i></a>
        </div>
      </div>
      <div class="footer__col">
        <h4>Customer Support</h4>
        <p>
          Got questions or need assistance? Our dedicated customer support team
          is here to help! Contact us via phone or email for any inquiries,
          order tracking, or product assistance.
        </p>
      </div>
      <div class="footer__col">
        <h4>Company Information</h4>
        <p>
          Learn more about our mission, values, and commitment to quality.
          Explore our company history and find out how we're making a positive
          impact in the world of chronology and lifestyle wristware.
        </p>
      </div>
    </footer>
    <div class="footer__bar">
      Copyright © 2024 Henry Baiden. All rights reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="landing/main.js"></script>
  </body>
</html>
