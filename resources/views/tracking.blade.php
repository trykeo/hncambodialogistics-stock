<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>HN Cambodia Logistics Co., ltd</title>
  <meta content="Welcome To" name="description">
  <meta content="HN Cambodia Logistics" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/long-logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
      rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">
      <a href="index.html" class="logo me-auto "><img src="assets/img/hn_logo.png" alt="HN Logo" class="img-fluid" ></a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="{{route('tracking')}}">Tracking</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Price</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li class="dropdown"><a href="#" title="English"><span class="img label-before"><img src="assets/img/lang-image/lang-en.png" alt="lang-en"> English</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#"><span class="img label-before"><img src="assets/img/lang-image/lang-khmer1.png" alt="lang-en"> ខ្មែរ​(Khmer)</span></a></li>
              <li><a href="#"><span class="img label-before"><img src="assets/img/lang-image/lang-thai1.png" alt="lang-en"> Thai</span></a></li>
            </ul>
          </li>
          {{-- <li class="menu-item lang-menu menu-item-has-children parent">
            <a title="English" href="#"><span class="img label-before"><img src="assets/images/lang-en.png" alt="lang-en"></span>													English<i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="submenu lang" >
              <li class="menu-item" ><a title="hungary" href="#"><span class="img label-before"><img src="assets/images/lang-hun.png" 																			alt="lang-hun"></span>Hungary</a></li>
              <li class="menu-item" ><a title="german" href="#"><span class="img label-before"><img src="assets/images/lang-ger.png" 																				alt="lang-ger" ></span>German</a></li>
              <li class="menu-item" ><a title="french" href="#"><span class="img label-before"><img src="assets/images/lang-fra.png" 																				alt="lang-fre"></span>French</a></li>
              <li class="menu-item" ><a title="canada" href="#"><span class="img label-before"><img src="assets/images/lang-can.png" 																				alt="lang-can"></span>Canada</a></li>
            </ul>
          </li> --}}
          {{-- <li><a class="getstarted scrollto" href="#about">Get Started</a></li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Welcome To HN Cambodia Logistics Co., Ltd</h1>
          {{-- <h2>We are team of talented designers making websites with Bootstrap</h2> --}}
          
            {{-- <form action="#" class="form-search d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
            
                <input type="text" class="form-control" id="search-input" name="order_id" placeholder="Enter Your Tracking ID...">
                <button type="submit" class="btn btn-primary" id="search-btn" onclick="search()">Track</button>
            </form> --}}
            <div id="my_input" class="d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                 <input type="text" class="form-control" id="search-input" name="order_id" placeholder="Enter Your Tracking ID...">
                <button type="submit" class="btn btn-primary" id="search-btn" onclick="search()">Track</button>
            </div>
           
            {{-- test --}}
          {{-- <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div> --}}
        </div>
        
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="assets/img/cover-page.png" class="img-fluid animated" alt="hn-cover-img">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <div class="container-fluid d-flex h-100 flex-column" id="css_container">
      <div class="row flex-fill jumbotron jumbotron-fluid" id="second-jumbotron">
          <div class="container text-center">
              <div class="card mt-4 text-center" id="result-not-found"
                  style="border-color: rgb(196, 202, 218); display: none;">
                  <div class="card-header">
                      <b>Tracking Information</b>
                  </div>
                  <div class="card-body">
                      <p>Sorry your tracking not found</p>
                  </div>
              </div>
              {{-- adjust --}}
              <div class="card mt-4 text-center order-stock-in" id="result-order" style="display: none;">
                  <div class="card-header" id="result-title">
                      <b>Tracking Information</b>
                  </div>
                  <div class="card-body">
                      <div class="container info-container" id="product-info">
                          <div class="row d-flex justify-content-evenly">
                              <div class="mr-auto">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                      class="bi bi-hash" viewBox="0 0 16 16">
                                      <path
                                          d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z" />
                                  </svg>
                                  <b>Tracking ID</b>
                              </div>
                              <div id="product_id"></div>
                          </div>
                          <hr>

                          <div class="row d-flex justify-content-between">
                              <div class="mr-auto"><b>Status</b></div>
                              <div id="product_status"></div>
                          </div>
                          <hr>
                      </div>

                      {{-- GROUP INFO --}}
                      <div class="container info-container" id="group-info">
                          <div class="row d-flex justify-content-between">
                              <div class="mr-auto">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                      class="bi bi-hash" viewBox="0 0 16 16">
                                      <path
                                          d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z" />
                                  </svg>
                                  <b>Group ID</b>
                              </div>
                              <div id="group_id"></div>
                          </div>
                          <hr>

                          <div class="row d-flex">
                              <div class="mr-auto"><b>Group status</b></div>
                              <div id="group_status"></div>
                          </div>
                          <hr>
                      </div>

                      <div class="container info-container">
                          <div class="row d-flex">
                              <div class="mr-auto"><b>Remark</b></div>
                              <div id="product_remark"></div>
                          </div>
                          <hr>

                          <div class="row d-flex">
                              <div class="mr-auto"> 
                                    {{-- style="max-width: 50%"  --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                      class="bi bi-geo-alt" viewBox="0 0 16 16">
                                      <path
                                          d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                      <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                  </svg>
                                  <b>Location</b>
                                  <div></div>
                              </div>
                              <div id="product_location"></div>
                          </div>
                          <hr>
                      </div>
                      <div class="container info-container" id="in-location-block">
                          <div class="row d-flex">
                              <div class="mr-auto" >
                                {{-- style="max-width: 50%" --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                      class="bi bi-box-seam" viewBox="0 0 16 16">
                                      <path
                                          d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                  </svg>
                                  <b>Arrived <span id="in-location">Bangkok</span> at</b>
                              </div>
                              <div id="product_in_date"></div>
                          </div>
                      </div>
                      <div class="container info-container" id="out-location-block">
                          <hr>
                          <div class="row d-flex">
                              <div class="mr-auto">
                                {{-- style="max-width: 50%" --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                      class="bi bi-truck" viewBox="0 0 16 16">
                                      <path
                                          d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                  </svg>
                                  <b>Sent out <span id="out-location">Phnom Penh</span> at</b>
                              </div>
                              <div id="product_out_date"></div>
                          </div>
                      </div>
                      <div class="container info-container" id="order-complete-block">
                          <hr>
                          <div class="row d-flex">
                              <div class="mr-auto">
                                {{-- style="max-width: 50%" --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                      class="bi bi-check-circle" viewBox="0 0 16 16">
                                      <path
                                          d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                      <path
                                          d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                  </svg>
                                  <b>Order Completed at</b>
                              </div>
                              <div id="order_complete_date"></div>
                          </div>
                      </div>
                  </div>
              </div>
              {{-- Record History --}}
              <div class="card mt-4 text-center" id="order-record" style="display: none;">
                  <div class="card-header" id="result-title">
                      <b>Record History</b>
                  </div>
                  <div class="card-body text-center">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th scope="col" class="text-center">
                                      Date
                                      {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                          fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd"
                                              d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                      </svg> --}}
                                  </th>
                                  <th scope="col" class="text-center">Location</th>
                                  <th scope="col" class="text-center">Address</th>
                                  <th scope="col" class="text-center">Status</th>
                              </tr>
                          </thead>
                          <tbody id="order-record-body">
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    <!-- ======= Clients Section ======= -->
    {{-- <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section><!-- End Cliens Section --> --}}

    <!-- ======= About Us Section ======= -->
    {{-- <section id="skills" class="skills">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Skills</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
              <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section --> --}}

    <!-- ======= Why Us Section ======= -->
    {{-- <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">
        <div class="section-title">
          <h2>Tracking Information</h2>
        </div>
        <div class="row">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3>Eum ipsam laborum deleniti <strong>velit pariatur architecto aut nihil</strong></h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
              </p>
            </div>

            <div class="accordion-list">
              <ul>
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                    <p>
                      Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                      Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                      Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                    </p>
                  </div>
                </li>

              </ul>
            </div>

          </div>

          <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/img/why-us.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
        </div>

      </div>
    </section><!-- End Why Us Section --> --}}

    <!-- ======= Skills Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>About Us</h2>
        </div>
        <div class="row">
          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
            <img src="assets/img/about-us-hn.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
            <h3>HN Cambodia Logistics Co., Ltd</h3>
            <p class="fst-italic">
              Welcome to HN Cambodian Logistics Co., Ltd. We are a company that specializes 
              in delivering parcels from Bangkok to all provinces across Cambodia. 
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i>We are providing fast, reliable, and efficient service to our customers.</li>
              <li><i class="ri-check-double-line"></i>Our daily departure from Bangkok at 3PM</li>
              <li><i class="ri-check-double-line"></i>Within Just One Day with Our overnight express service, customers can receive their parcels in Phnom Penh</li>
            </ul>
            <p class="fst-italic">
              Thank you for considering HN Cambodian Logistics Co., Ltd. for your parcel delivery needs. We are confident that we can exceed your expectations 
              with our fast, reliable, and efficient service.
            </p>
            <a href="#contact" class="btn-learn-more">Contact Us</a>
            {{-- <div class="skills-content">

              <div class="progress">
                <span class="skill">HTML <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">CSS <i class="val">90%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">JavaScript <i class="val">75%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">Photoshop <i class="val">55%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

            </div> --}}

          </div>
        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>At HN Cambodian Logistics Co., Ltd., we offer a range of services 
            to meet our customers' needs. We are committed to providing fast, reliable, and efficient
             services at all times.</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxs-truck"></i></div>
              <h4><a href="">Parcel Delivery Service </a></h4>
              <p>Our parcel delivery service is designed to ensure that your packages arrive safely and quickly to their intended destination. 
                We offer a one-day delivery service from Bangkok to all provinces across Cambodia</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-money"></i></div>
              <h4><a href="">Money Exchange Service</a></h4>
              <p>If you need to exchange your USD to Baht, we offer competitive exchange rates to help you get the most value for your money. Our money exchange service is quick and reliable, 
                ensuring that you receive your money in a timely manner.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Money Transfer Service</a></h4>
              <p>we offer a money transfer service to help our customers pay for their purchases. We will help you transfer the money to the Thai shop for the price of the 
                goods, ensuring that your purchase goes smoothly.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-run"></i></div>
              <h4><a href="">Product Purchase Service</a></h4>
              <p>We will help you buy the products you need from Thailand, and we will 
                ensure that they are delivered safely and quickly to your location.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    {{-- <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
            <h3>Call To Action</h3>
            <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Call To Action</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section --> --}}

    <!-- ======= Portfolio Section ======= -->
    {{-- <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-app">App</li>
          <li data-filter=".filter-card">Card</li>
          <li data-filter=".filter-web">Web</li>
        </ul>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>App 1</h4>
              <p>App</p>
              <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>App 2</h4>
              <p>App</p>
              <a href="assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 2</h4>
              <p>Card</p>
              <a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Web 2</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>App 3</h4>
              <p>App</p>
              <a href="assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 1</h4>
              <p>Card</p>
              <a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 3</h4>
              <p>Card</p>
              <a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section --> --}}

    <!-- ======= Team Section ======= -->
    {{-- <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Team</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/team-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/team-3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="400">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/team-4.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section --> --}}

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        {{-- <div class="section-title">
          <h2>Pricing</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div> --}}

        <div class="row content">

          {{-- <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
              <h3>Free Plan</h3>
              <h4><sup>$</sup>0<span>per month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li class="na"><i class="bx bx-x"></i> <span>Pharetra massa massa ultricies</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              </ul>
              <a href="#" class="buy-btn">Get Started</a>
            </div>
          </div> --}}
          <div class="section-title col-lg-8">
            <h2>Pricing</h2>
            <p>At HN Cambodian Logistics Co., Ltd., we offer transparent and competitive pricing for all of our services. Our prices are based on the size and weight of your parcels, ensuring 
              that you only pay for what you need. We also offer discounts for bulk transportation, so you can save even more.
             <hr>
              
              To help you evaluate the price of your parcel, we have provided a pricing table.
              
               Please note that these prices are subject to change and are provided as a general guide only. 
               <br> For an accurate quote, please contact us directly.</p>
               <a href="#contact" class="btn-learn-more">Contact Us</a>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/price-table.jpg" class="img-fluid" alt="">
          </div>

          {{-- <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box featured">
              <h3>Business Plan</h3>
              <h4><sup>$</sup>29<span>per month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
              </ul>
              <a href="#" class="buy-btn">Get Started</a>
            </div>
          </div> --}}

          {{-- <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <h3>Developer Plan</h3>
              <h4><sup>$</sup>49<span>per month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
              </ul>
              <a href="#" class="buy-btn">Get Started</a>
            </div>
          </div> --}}

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    {{-- <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section --> --}}

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>We welcome your inquiries and are happy to provide any assistance you may need. 
            Please feel free to contact us via any of the following channels:</p>
        </div>

        <div class="row">

          <div class="col-lg-6 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>48/3 Soi Phetchaburi 17
                  Thanon Phaya Thai, Ratchathewi
                  Bangkok 10400</p>
              </div>
              <div class="email">
                <i class="bi bi-telegram"></i>
                <h4>Telegram:</h4>
                <p><a href="https://t.me/HNCambodia">HN Cambodia Logistics</a></p>
              </div>
              <div class="email">
                <i class="bi bi-line"></i>
                <h4>Line ID:</h4>
                <p><a href="@hncambodia">@hncambodia</a></p>
              </div>
              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+66 (0) 97 252 1010 / +66 (0) 63 3050 765</p>
              </div>
              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>hncambodialogistics@gmail.com</p>
              </div>
            </div>

          </div>

          <div class="col-lg-6 mt-5 mt-lg-0 d-flex align-items-stretch">
            <div class="location-hn"></div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.417180049965!2d100.53604256542918!3d13.75369741895645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f6b718b0cf9%3A0x676b842ba728209!2zSE4gQ2FtYm9kaWEgTG9naXN0aWNzIENvLiwgTHRkLiDguYDguK3guIrguYDguK3guYfguJnguYHguITguKHguYLguJrguYDguJTguLXguKLguYLguKXguIjguLTguKrguJXguLTguIHguKrguYwo4Liq4LmI4LiH4Liq4Li04LiZ4LiE4LmJ4Liy4LmE4Lib4LiB4Lix4Lih4Lie4Li54LiK4LiyKQ!5e0!3m2!1sen!2skh!4v1684132225266!5m2!1sen!2skh"
             frameborder="0" style=" width: 100%; height: 500px;" allowfullscreen></iframe>
            
         
          </div>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    {{-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div> --}}

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>HN Cambodia Logistics co., Ltd</h3>
            <p>
              48/3 Soi Phetchaburi 17 <br>
              Thanon Phaya Thai, Ratchathewi<br>
              Bangkok 10400 <br><br>
              <strong>Phone:</strong> +66 (0) 97-252-1010<br>
              <strong>Phone:</strong> +66 (0) 63-3050-765<br>
              <hr>
              <strong>Email:</strong> hncambodialogistics@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Parcel Delivery Service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Money Exchange Service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Money Tranfer Service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Purchase Service</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Please Contact Us Now</p>
            <div class="social-links mt-3">
              <a href="https://t.me/HNCambodia" class="twitter"><i class="bx bxl-telegram"></i></a>
              <a href="https://www.facebook.com/profile.php?id=100065207941384" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              {{-- <a href="#" class="google-plus"><i class="bx bxl-pencil"></i></a> --}}
              {{-- <a href="#" class="linkedin"><i class="bx bxl-telephone"></i></a> --}}
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>HN Cambodia Logistics Co., Ltd</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://www.facebook.com/keo.kimtry">Keo Try</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
<script>
  document.getElementById("search-input")
      .addEventListener("keyup", function(event) {
      event.preventDefault();
      if (event.keyCode === 13) {
          document.getElementById("search-btn").click();
      }
  });

  let result_order = document.getElementById('result-order');
  let result_not_found = document.getElementById('result-not-found');

  let group_id_el = document.getElementById("group_id");
  let group_info_el = document.getElementById("group-info");
  let group_status_el = document.getElementById("group_status");

  let product_id_el = document.getElementById("product_id");
  let product_status_el = document.getElementById("product_status");
  let product_info_el = document.getElementById("product-info");
  let product_remark_el = document.getElementById("product_remark");
  let product_location = document.getElementById("product_location");
  let product_in_date = document.getElementById("product_in_date");
  let product_out_date = document.getElementById("product_out_date");

  let in_location_el = document.getElementById("in-location");
  let out_location_el = document.getElementById("out-location");
  let order_complete_el = document.getElementById("order_complete_date");
  let in_location_block_el = document.getElementById("in-location-block");
  let out_location_block_el = document.getElementById("out-location-block");
  let order_complete_block_el = document.getElementById("order-complete-block");

  let order_record_el = document.getElementById("order-record");
  let order_record_body_el = document.getElementById("order-record-body");
  

  function return_not_found() {
      result_order.style.display = "none";
      order_record_el.style.display = "none";
      result_not_found.style.display = "block";
  }

  function display_group(group) {
      let lmove = group.latest_movement;

      group_info_el.style.display = "block";
      group_id_el.innerHTML = group.bar_code;
      
      if (lmove != null) {
          if (lmove.record_out_at != null) {
              status = "Sent out to " + lmove.out_location.name;
          }
          else {
              status = "Arrived at " + lmove.in_location.name;
          }
      }

      group_status_el.innerHTML = status;
  }

  function display_order(order) {
      let lmove = order.latest_movement;
      let location = "";
      let status = "";
      let new_class = "";
      let old_class = "";

      if (order.deliver_at != null) {
          status = "Order Completed";
          new_class = "order-stock-out";
          old_class = "order-stock-in";

          order_complete_el.innerHTML = order.deliver_at;
          order_complete_block_el.style.display = "block";
      }
      else {
          order_complete_el.innerHTML = '';
          order_complete_block_el.style.display = "none";
      }

      in_location_block_el.style.display = "none";
      out_location_block_el.style.display = "none";

      if (lmove != null) {
          if (lmove.record_out_at != null) {
              status = status != "" ? status : "Sent out to " + lmove.out_location.name;
              new_class = "order-stock-out";
              old_class = "order-stock-in";

              if (lmove.finish_at != null) {
                  location = lmove.out_location.address;
              }
              else {
                  location = lmove.in_location.address; 
              }

              product_out_date.innerHTML = lmove.record_out_at;
              out_location_block_el.style.display = "block";
              out_location_el.innerHTML = lmove.out_location.name;
          }
          else {
              status = status != "" ? status : "Arrived " + lmove.in_location.name;
              new_class = "order-stock-in";
              old_class = "order-stock-out";
              location = lmove.in_location.address;
          }

          product_in_date.innerHTML = lmove.record_in_at;
          in_location_block_el.style.display ="block";
          in_location_el.innerHTML = lmove.in_location.name;
      }
      
      product_info_el.style.display ="block";
      group_info_el.style.display = "none";
      
      product_id_el.innerHTML = order.bar_code;
      product_status_el.innerHTML = status;
      product_remark_el.innerHTML = order.remark;
      product_location.innerHTML = location;
      

      result_order.style.display = "block";
      result_not_found.style.display = "none";
      
      result_order.classList.remove(old_class);
      result_order.classList.add(new_class);
  }

  function add_record_row(date, location, address, status) {
      var row = order_record_body_el.insertRow();
      row.style.maxWidth = "30%";
      var date_cell = row.insertCell();
      var location_cell = row.insertCell();
      var address_cell = row.insertCell();
      var status_cell = row.insertCell();

      date_cell.appendChild(document.createTextNode(date));
      location_cell.appendChild(document.createTextNode(location));
      address_cell.appendChild(document.createTextNode(address));
      status_cell.appendChild(document.createTextNode(status));
  }

  function display_record(records) {
      order_record_el.style.display = "block";
      $("#order-record-body").empty();

      records.forEach(record => {
          if (record.record_in_at != null)
          {
              add_record_row(record.record_in_at, record.in_location.name, record.in_location.address, `Arrived at ${record.in_location.name}`);
          }

          if (record.record_out_at != null)
          {
              add_record_row(record.record_out_at, record.in_location.name, record.in_location.address, `Sent out to ${record.out_location.name}`);
          }

          if (record.finish_at != null && record.record_out_at == null)
          {
              msg = "Order Completed";
              switch (record.finish_status) {
                case "delivered":
                  msg = "Delivered to customer";
                  break;

                case "picked_up":
                  msg = "Picked up by customer";
                  break;
              }
            
              add_record_row(record.finish_at, record.in_location.name, record.in_location.address, msg);
          }
      });
  }

  function search() {
      let search_text = document.getElementById('search-input');
      let order_id = search_text.value;
      
      if (order_id == "") {
          return false;
      }

      $.ajax({
          url: `/tracking/${order_id}`,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
              let group = data.group;
              let product = data.product;
              let record = data.record;
              
              if (product != null) {
                  display_order(product);
                  
                  if (group != null) {
                      display_group(group);
                  }

                  if (record != null && record.length > 0) {
                      display_record(record);
                  }
              }
              else
              {
                  return_not_found(); 
              }
          }
      });
  }
</script>
</html>