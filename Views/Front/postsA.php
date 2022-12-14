<?php
include '../../Controller/postC.php';
require_once '../../model/post.php';

$blogC = new postC();
$listeblog = $blogC->afficherpost();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Events </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Day - v4.7.0
  * Template URL: https://bootstrapmade.com/day-multipurpose-html-template-for-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php
include 'head.php';
?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index_2.php">home</a></li>
          <li> posts </li>
        </ol>
        <h2>posts</h2>


      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
          <div class="container">

            <div >

              <h1>posts</h1>
              <p>Browse our posts</p>
              <a class="nav-link scrollto" href="../Back/addblog.php">addblog</a>
              <label for="search">search</label>
                      <input type="text" class="form-control" id="search" name="search" placeholder="search" >
            </div>

            <div class="row">
              <?php foreach ($listeblog as $key) { ?>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                  <div class="icon-box">
                    <div class="icon"><i class="bi bi-card-text"></i></div>
                    <h4><a href=""><?php echo $key['title']; ?> </a></h4>
                    <img src="<?php echo $key['img']; ?>" width="250" height="250" alt="image" />
                    <p><?php echo $key['author']; ?> </p>
                    <h3>  category  <br> </h3>
                    <h4> <a href=""><?php echo $key['category']; ?> </a></h4>
                     <form method="POST" action="createFILE.php">
            <input type="submit" class="btn btn-danger btn-fw" name="open" value="open">
            <input type="hidden" value=<?PHP echo $key['post_id']; ?> name="id">
            <input type="hidden" value=<?PHP echo $key['contents']; ?> name="content">
            <input type="hidden" value=<?PHP echo $key['title']; ?> name="titre">
            <input type="hidden" value=<?PHP echo $key['author']; ?> name="auteur">
            </form>
                  </div>
                  <td>
                         
                          </td>
                </div>
              <?php
              }
              ?>

            </div>

          </div>
        </section>

      </div>
      <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
      <div class="container">

       
        <div class="row" data-aos="fade-up">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>PARC TECHNOLOGIQUE
                2088 ARIANA</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>ashblog@esprit.tn</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>+1 5589 55488 55</p>
            </div>
          </div>

        </div>

        
      </div>
    </section><!-- End Contact Section -->
    </section>

  </main><!-- End #main -->



  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>ASHBLOG</h3>
              <p>
                Ariana Soghra , Tunisia <br>
                <strong>Phone:</strong> +216 00000000 <br>
                <strong>Email:</strong> ashblog@esprit.tn<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="container">
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/day-multipurpose-html-template-for-free/ -->
        Designed by achref</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>