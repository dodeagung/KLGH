<!-- NAVIGATION -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
      <div class="row">
        <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand page-scroll" href="http://www.inovatik.com/villa-bed-and-breakfast-landing-page/04-sliding-header/header"><img src="<?php echo $this->common->theme_link(); ?>images/logo.svg" alt="logo"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-collapse collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a class="page-scroll" href="#subheader">BOOK US</a></li>
            <li><a class="page-scroll" href="#discover">DISCOVER</a></li>
            <li><a class="page-scroll" href="#facilities">FACILITIES</a></li>
            <li><a class="page-scroll" href="#rooms">ROOMS</a></li>
            <li><a class="page-scroll" href="#tourism">TOURISM</a></li>
            <li><a class="page-scroll" href="#contact">CONTACT</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">EN <i class="fa fa-caret-down"></i></a>
              <ul class="dropdown-menu">
                <li><a href="index.html">FR</a></li>
                <li><a href="index.html">IT</a></li>
                <li><a href="index.html">SP</a></li>
              </ul>
            </li>
            <li><a class="scrolling phone-number hidden-xs hidden-sm" href="tel:18003249832"><i class="fa fa-phone" aria-hidden="true"></i> 1-800-324-9832</a></li>
          </ul>
        </div>
        
      </div>
        </div>
    </div> <!-- end of navigation -->
  
  
  <!-- HEADER -->
  <div id="header" class="swiper-container-header">
    <div class="swiper-wrapper">
      <div class="swiper-slide first">
        <div class="flex-container-wrapper"> <!-- IE fix for vertical alignment in flex box -->
          <div class="header-content text-center">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h1>Amazing Experience</h1>
                  <p>Villa is one of the most beautiful and relaxing places at the Mediterranean sea</p>
                  <a class="page-scroll" href="#discover"><i class="fa fa-angle-down fa-3x"></i></a>
                </div>
              </div>
            </div>
          </div> <!-- end of header content -->
        </div> <!-- end of flex container wrapper -->
      </div> <!-- end of first -->
      <div class="swiper-slide second">
        <div class="flex-container-wrapper"> <!-- IE fix for vertical alignment in flex box -->
          <div class="header-content text-center">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h1>Wonderful Staff</h1>
                  <p>Find here the friendliest people which will go out of their way to make you joyful</p>
                  <a class="page-scroll" href="#discover"><i class="fa fa-angle-down fa-3x"></i></a>
                </div>
              </div>
            </div>
          </div> <!-- end of header content -->
        </div> <!-- end of flex container wrapper -->
      </div> <!-- end of second -->
      <div class="swiper-slide third">
        <div class="flex-container-wrapper"> <!-- IE fix for vertical alignment in flex box -->
          <div class="header-content text-center">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h1>Great Facilities</h1>
                  <p>Find everything you need for a wonderful vacation in one of our high end facilities</p>
                  <a class="page-scroll" href="#discover"><i class="fa fa-angle-down fa-3x"></i></a>
                </div>
              </div>
            </div>
          </div> <!-- end of header content -->
        </div> <!-- end of flex container wrapper -->
      </div> <!-- end of first -->
    </div> <!-- end of swiper wrapper -->
    
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
  </div> <!-- end of header -->
    
  <!-- Subheader -->
  <div id="subheader">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-offset-1 col-lg-10">
          <!-- Registration Form -->
          <form id="BookingForm" data-toggle="validator">
            <div class="form-group">
              <input type="text" class="form-control" id="completename" placeholder="Complete name" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="nrofrooms" placeholder="Number of rooms" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="nrofpeople" placeholder="Number of people" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="phonenr" placeholder="Phone number" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" id="email" placeholder="Email address" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="start" placeholder="Check-in" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="end" placeholder="Check-out" required>
            </div>
            <div class="form-group">
              <button type="submit">BOOK NOW</button>
            </div>
            <div class="form-message">
              <div id="msgSubmit" class="h3 text-center hidden"></div>
            </div>
          </form>
        </div>  
      </div> <!-- end of row -->
    </div> <!-- end of container -->
  </div> <!-- end of subheader -->
  <!-- end of subheader and header -->
  
  
  <!-- DISCOVER -->
  <div id="discover">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="above-header">DISCOVER</p>
          <h2>Get To Know Villa</h2>
          <p>Villa is an unique Bed & Breakfast tourism facility situated on the magnificent Mediterranean sea shores, prepared to welcome tranquility seeking tourists all year long. Click the images below to see more</p>
        </div>
        <div class="col-md-12"> 
          
          <!-- Swiper -->
          <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-1.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-1.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-2.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-2.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-3.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-3.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-4.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-4.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-5.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-5.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-1.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-1.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-2.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-2.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-3.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-3.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-4.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-4.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="<?php echo $this->common->theme_link(); ?>images/discover-image-5.jpg" class="popup-link" data-effect="fadeIn">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-5.jpg" alt="event gallery">
                  </div>
                </a>
              </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div> 
          
        </div>
      </div> <!-- end of row -->
    </div> <!-- end of container -->
  </div> <!-- end of discover -->
  
  
  <!-- FACILITIES -->
  <div id="facilities">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p class="above-header">FACILITIES</p>
          <h2>Everything You Need</h2>
          
          <div class="nav-tabs-container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" role="tablist">
              <li role="presentation" class="active"><a href="#restaurant" aria-controls="restaurant" role="tab" data-toggle="tab"><i class="fa fa-cutlery"></i><span class="hidden-xs">Restaurant</span></a></li>
              <li role="presentation"><a href="#terrace" aria-controls="terrace" role="tab" data-toggle="tab"><i class="fa fa-glass"></i><span class="hidden-xs">Terrace</span></a></li>
              <li role="presentation"><a href="#beach" aria-controls="beach" role="tab" data-toggle="tab"><i class="fa fa-sun-o"></i><span class="hidden-xs">Beach</span></a></li>
              <li role="presentation"><a href="#playground" aria-controls="playground" role="tab" data-toggle="tab"><i class="fa fa-futbol-o"></i><span class="hidden-xs">Playground</span></a></li>
              <li role="presentation"><a href="#parking" aria-controls="parking" role="tab" data-toggle="tab"><i class="fa fa-car"></i><span class="hidden-xs">Parking</span></a></li>
            </ul>
          </div> <!-- end of nav-tabs-container -->
          
          <div class="tab-panes-container">
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="restaurant">
                <div class="row">
                  <div class="col-md-7">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/facilities-restaurant.jpg" alt="facilities image">
                  </div>
                  <div class="col-md-5 text-side">
                    <h3>Delicious Local Food And International Dishes</h3>
                    <p>We serve delicious food from the local cuisine made with natural ingredients from local farms and markets. Villa is also vegetarian friendly so come on, <a href="#your-link">book one of our rooms</a></p>
                    <p class="highlight">SERVING SCHEDULE: 08:00 - 23:00</p>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="terrace">
                <div class="row">
                  <div class="col-md-7">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/facilities-terrace.jpg" alt="facilities image">
                  </div>
                  <div class="col-md-5 text-side">
                    <h3>Great Place For Relaxing Summer Mornings And Evenings</h3>
                    <p>Start your vacation day with an invigorating coffee and choose to sit down and relax or plan your trips to the surrounding historical sites and <a href="#your-link">tourists attractions</a></p>
                    <p class="highlight">OPEN FROM: 08:00 - 23:00</p>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="beach">
                <div class="row">
                  <div class="col-md-7">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/facilities-beach.jpg" alt="facilities image">
                  </div>
                  <div class="col-md-5 text-side">
                    <h3>Crystal Clear Turquoise Waters And Warm Beaches</h3>
                    <p>There are 2 beautiful sunny beaches near Villa's location conveniently equipped with beach chairs, umbrellas, beach bar, showers and trained life guards for <a href="#your-link">your safety</a></p>
                    <p class="highlight">SWIMMING SCHEDULE: 08:00 - 23:00</p>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="playground">
                <div class="row">
                  <div class="col-md-7">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/facilities-playground.jpg" alt="facilities image">
                  </div>
                  <div class="col-md-5 text-side">
                    <h3>Kids Never Felt Better While Having So Much Fun</h3>
                    <p>Children have their own space to have fun and play games under adult supervision so you can enjoy a few moments of relaxation in your room or some extreme sports <a href="#your-link">on the beach</a></p>
                    <p class="highlight">PLAY SCHEDULE: 08:00 - 23:00</p>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="parking">
                <div class="row">
                  <div class="col-md-7">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/facilities-parking.jpg" alt="facilities image">
                  </div>
                  <div class="col-md-5 text-side">
                    <h3>Last Thing You Need To Worry About Is Your Car</h3>
                    <p>Villa offers free parking for all its customers in a safe and easy to reach area. The designated place is guarded and supervised with surveillance cameras for your <a href="#your-link">peace of mind</a></p>
                    <p class="highlight">PARKING SCHEDULE: NON-STOP</p>
                  </div>
                </div>
              </div>
            </div> <!-- end of tab-content -->
          </div> <!-- end of tab-panes-container -->
          
        </div> <!-- end of col-md-12 -->
      </div> <!-- end of row -->
    </div> <!-- end of container -->
  </div> <!-- end of facilities -->
  
  
  <!-- ROOMS -->
  <div id="rooms">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <p class="above-header">ROOMS</p>
          <h2>Comfort & Relaxation</h2>
          <p class="above-list">All our rooms are equipped by default with the following amenities:</p>
          <ul class="list-unstyled list-inline">
            <li><i class="fa fa-wifi"></i>Free Wi-Fi,</li>
            <li><i class="fa fa-bath"></i>Private bathrooms,</li>
            <li><i class="fa fa-tablet"></i>Cabinet fridge,</li>
            <li><i class="fa fa-tv"></i>Widescreen LCD,</li>
            <li><i class="fa fa-snowflake-o"></i>Air conditioning,</li>
          </ul>
        </div>
        
        <div class="col-md-12">
          <div class="row">
            <div class="col-sm-4">
              <div class="rooms-container first">
                <a class="popup-with-move-anim" href="#room-1">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/room-1-image.jpg" alt="rooms image">
                  </div>
                </a>
                <h4>Balcony Room - $59/day</h4>
                <p>Our entry level room gives you access to all amenities at a really affordable price</p>
                <a class="button outline popup-with-move-anim" href="#room-1">DETAILS</a> <a class="button solid page-scroll" href="#subheader">BOOK NOW</a>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="rooms-container middle">
                <a class="popup-with-move-anim" href="#room-2">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/room-2-image.jpg" alt="rooms image">
                  </div>
                </a>
                <h4>Panoramic Room - $89/day</h4>
                <p>Get the best view to the beautiful sea and splendid surroundings at a moderate price</p>
                <a class="button outline popup-with-move-anim" href="#room-2">DETAILS</a> <a class="button solid page-scroll" href="#subheader">BOOK NOW</a>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="rooms-container">
                <a class="popup-with-move-anim" href="#room-3">
                  <div class="image-container">
                    <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/room-3-image.jpg" alt="rooms image">
                  </div>
                </a>
                <h4>Presidential Room - $129/day</h4>
                <p>High class luxury for the most demanding tourists. Features balcony and panorama</p>
                <a class="button outline popup-with-move-anim" href="#room-3">DETAILS</a> <a class="button solid page-scroll" href="#subheader">BOOK NOW</a>
              </div>
            </div>
          </div>
        </div>
        
      </div> <!-- end of row -->
    </div> <!-- end of container -->
  </div> <!-- end of rooms -->
  
  <!-- Magnific Popup Rooms Details Content -->
  <!-- mfp-hide class is required to keep the content hidden until the visitor clicks the button -->
  <div id="room-1" class="room-details-container zoom-anim-dialog mfp-hide">
    <div class="row">
      <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
      <div class="col-md-8">
        <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/room-1-image-details.jpg" alt="speakers image">
      </div>
      <div class="col-md-4">
        <h3>Balcony Room</h3>
        <hr>
        <h4>$59/day</h4>
        <p>Each of Villa's rooms was designed to offer the best possible experience for many types of travelers from the adventure seekers to those who value comfort.</p>
        <ul class="list-unstyled">
          <li><i class="fa fa-wifi"></i>Free Wi-Fi,</li>
          <li><i class="fa fa-bath"></i>Private bathrooms,</li>
          <li><i class="fa fa-tablet"></i>Cabinet fridge,</li>
          <li><i class="fa fa-tv"></i>Widescreen LCD,</li>
          <li><i class="fa fa-snowflake-o"></i>Air conditioning,</li>
        </ul>
        <a class="button outline mfp-close as-button" href="#rooms">BACK</a>&nbsp; <a class="button solid mfp-close as-button page-scroll" href="#header">BOOK NOW</a>
      </div>
    </div>
  </div> 
  <div id="room-2" class="room-details-container zoom-anim-dialog mfp-hide">
    <div class="row">
      <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
      <div class="col-md-8">
        <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/room-2-image-details.jpg" alt="speakers image">
      </div>
      <div class="col-md-4">
        <h3>Panormaic Room</h3>
        <hr>
        <h4>$89/day</h4>
        <p>Each of Villa's rooms was designed to offer the best possible experience for many types of travelers from the adventure seekers to those who value comfort.</p>
        <ul class="list-unstyled">
          <li><i class="fa fa-wifi"></i>Free Wi-Fi,</li>
          <li><i class="fa fa-bath"></i>Private bathrooms,</li>
          <li><i class="fa fa-tablet"></i>Cabinet fridge,</li>
          <li><i class="fa fa-tv"></i>Widescreen LCD,</li>
          <li><i class="fa fa-snowflake-o"></i>Air conditioning,</li>
        </ul>
        <a class="button outline mfp-close as-button" href="#rooms">BACK</a>&nbsp; <a class="button solid mfp-close as-button page-scroll" href="#header">BOOK NOW</a>
      </div>
    </div>
  </div>
  <div id="room-3" class="room-details-container zoom-anim-dialog mfp-hide">
    <div class="row">
      <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
      <div class="col-md-8">
        <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/room-3-image-details.jpg" alt="speakers image">
      </div>
      <div class="col-md-4">
        <h3>Presidential Room</h3>
        <hr>
        <h4>$129/day</h4>
        <p>Each of Villa's rooms was designed to offer the best possible experience for many types of travelers from the adventure seekers to those who value comfort.</p>
        <ul class="list-unstyled">
          <li><i class="fa fa-wifi"></i>Free Wi-Fi,</li>
          <li><i class="fa fa-bath"></i>Private bathrooms,</li>
          <li><i class="fa fa-tablet"></i>Cabinet fridge,</li>
          <li><i class="fa fa-tv"></i>Widescreen LCD,</li>
          <li><i class="fa fa-snowflake-o"></i>Air conditioning,</li>
        </ul>
        <a class="button outline mfp-close as-button" href="#rooms">BACK</a>&nbsp; <a class="button solid mfp-close as-button page-scroll" href="#header">BOOK NOW</a>
      </div>
    </div>
  </div> <!-- end of magnific popup rooms details content -->
  
  
  <!-- TOURISM -->
  <div id="tourism">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p class="above-header">TOURISM</p>
          <h2>Popular Attractions</h2>
        </div>
      </div> <!-- end of row -->
      
      <div class="row">
        <div class="col-md-6 left-attraction">
          <div class="image-container">
            <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-1.jpg" alt="tourism attractions">
            <div class="hover-overlay">
              <div class="hover-text">
                <a href="#your-link"><h4>Afitos Old Town</h4></a>
              </div>
            </div>
          </div>
          <p><span class="highlight">AFITOS OLD TOWN:</span> Full of historical importance for this part of the world, <a href="#your-link">Afitos Old Towm</a> will impress you with its charming caffes and familiar taverns</p>
        </div>
        <div class="col-md-6 right-attraction">
          <div class="image-container">
            <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-2.jpg" alt="tourism attractions">
            <div class="hover-overlay">
              <div class="hover-text">
                <a href="#your-link"><h4>Navagio Beach</h4></a>
              </div>
            </div>
          </div>
          <p><span class="highlight">NAVAGIO BEACH:</span> Is the most famous beach at the Mediterranean sea with white sands and cool beach bars. In the weekends take the <a href="#your-link">train</a> and avoid going by car</p>
        </div>
      
        <div class="col-md-6 left-attraction">
          <div class="image-container">
            <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-3.jpg" alt="tourism attractions">
            <div class="hover-overlay">
              <div class="hover-text">
                <a href="#your-link"><h4>Aegean Belvedere</h4></a>
              </div>
            </div>
          </div>
          <p><span class="highlight">AEGEAN BELVEDERE:</span> The best place to watch the sunset in a romantic atmosphere and maybe even drink a glass of wine at one of the <a href="#your-link">many bistros</a></p>
        </div>
        <div class="col-md-6 right-attraction">
          <div class="image-container">
            <img class="img-responsive" src="<?php echo $this->common->theme_link(); ?>images/discover-image-4.jpg" alt="tourism attractions">
            <div class="hover-overlay">
              <div class="hover-text">
                <a href="#your-link"><h4>James Clark's White House</h4></a>
              </div>
            </div>
          </div>
          <p><span class="highlight">JAMES CLARK'S WHITE HOUSE:</span> Don't miss this great tourist attraction. The <a href="#your-link">famous writer's house</a> will fascinate literature enthusiasts and history aficionados</p>
        </div>
      </div> <!-- end of row -->
      
    </div> <!-- end of container -->
  </div> <!-- end of tourism -->
  
  
  <!-- TESTIMONIALS -->
  <div id="testimonials">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div id="quote" class="carousel slide" data-ride="carousel" data-interval="4000">
            <ol class="carousel-indicators">
              <li data-target="#quote" data-slide-to="0" class="active"></li>
              <li data-target="#quote" data-slide-to="1"></li>
              <li data-target="#quote" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <div class="col-md-4">
                  <p class="mb-0">"Our stay at Villa was amazing. I didn't think this part of the world can be so beautiful. Looking forward to return with my partner"</p>
                  <p><strong>Mary Fitzgerald</strong> - <span class="rating-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</span></p>
                </div>
                <div class="col-md-4">
                  <p class="mb-0">"Amazing experience! Loved the villa and its surroundings but I was especially impressed by the beautiful beaches you can find nearby"</p>
                  <p><strong>John Frown</strong> - <span class="rating-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</span></p>
                </div>
                <div class="col-md-4">
                  <p class="mb-0">"WOW! I just can't find the words to describe our experience. The staff was great, rooms were very clean and the food... delicious"</p>
                  <p><strong>Mike Town</strong> - <span class="rating-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</span></p>
                </div>
              </div>
              <div class="item">
                <div class="col-md-4">
                  <p class="mb-0">"So many ways to have fun. You never get bored. You can relax at the beach or have fun in the old town. Everything for everyone"</p>
                  <p><strong>Judy Smithfield</strong> - <span class="rating-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</span></p>
                </div>
                <div class="col-md-4">
                  <p class="mb-0">"I came together with my parents and was able to offer them the best vacation they ever had. I will return with my husband next year"</p>
                  <p><strong>Ruben May</strong> - <span class="rating-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</span></p>
                </div>
                <div class="col-md-4">
                  <p class="mb-0">"Definitely worth the price. The services are of the highest quality, staff is very friendly and I only regret I couldn't stay longer"</p>
                  <p><strong>Sully McLane</strong> - <span class="rating-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</span></p>
                </div>
              </div>
              <div class="item">
                <div class="col-md-4">
                  <p class="mb-0">"If you love good food, nice music and gorgeous beaches then Villa will be the perfect vacation spot for you. I loved it"</p>
                  <p><strong>Ron Blake</strong> - <span class="rating-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</span></p>
                </div>
                <div class="col-md-4">
                  <p class="mb-0">"My kids absolutely loved Villa because of the well designed and safe playground. But grownups had a great time too"</p>
                  <p><strong>Paula Jerry</strong> - <span class="rating-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</span></p>
                </div>
                <div class="col-md-4">
                  <p class="mb-0">"Villa is great! It has everything you could ask for at affordable prices. Except the Presidential Room which is, well... presidential :)"</p>
                  <p><strong>Simone Finley</strong> - <span class="rating-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</span></p>
                </div>
              </div>
            </div>
          </div> <!-- end of quote -->
        </div> <!-- end of col-md-12 -->
      </div> <!-- end of row -->
    </div> <!-- end of container -->
  </div> <!-- end of testimonials -->
  
  
  <!-- CONTACT -->
  <div id="contact">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
          <p class="above-header">CONTACT</p>
          <h2>Location Information</h2>
          <p class="above-list">Don't hesitate to use the form our contact details to get in touch.:</p>
          <ul class="list-unstyled list-inline">
            <li><i class="fa fa-map-marker" aria-hidden="true"></i>Afitos 63077, Greece</li>
            <li><i class="fa fa-phone" aria-hidden="true"></i><a class="phone-number" href="tel:18003249832">+30 2463 082500</a></li>
            <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:contact@villa.com">contact@villa.com</a></li>
            <li><i class="fa fa-chrome" aria-hidden="true"></i><a href="#your-link">www.villa.com</a></li>
          </ul>
        </div>
        <div class="col-md-6">
          <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3052.102620883462!2d23.437024315180963!3d40.09542488304202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a62a7bde3a7915%3A0xe08ece688ab0e3fb!2sAegean+Blue+Studios!5e0!3m2!1sen!2sro!4v1494660917249" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-md-6">
          
          <!-- Contact Form -->
          <form id="ContactForm" data-toggle="validator">
            <div class="form-group">
              <input type="text" class="form-control" id="cfirstname" placeholder="Complete Name" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="clastname" placeholder="Phone" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" id="cemail" placeholder="Email" required>
            </div>
            <div class="form-group">
              <textarea class="form-control" id="cmessage" placeholder="Write your message here" rows="4" required></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="button-small-solid">SUBMIT</button>
            </div>
            <div class="form-message">
              <div id="cmsgSubmit" class="h3 text-center hidden"></div>
            </div>
          </form>
          
        </div>
      </div> <!-- end of row -->
    </div> <!-- end of container -->
  </div> <!-- end of contact -->