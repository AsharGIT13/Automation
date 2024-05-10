@include('default.header')

  
  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.php" class="logo">
               <img src="assets/images/logo.png" style="width: 222px;">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** 
            <ul class="nav">
              <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#about">How it works</a></li>
              <li class="scroll-to-section"><a href="#services">Services</a></li>
              <li class="scroll-to-section"><a href="#portfolio">Portfolio</a></li>
            
              <li class="scroll-to-section"><a href="#contact">Message Us</a></li> 
              <li class="scroll-to-section"><div class="main-red-button"><a href="register.html">Login / Signup</a></div></li> 
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
          <div class="container">		  
          <div class="row">		  
		   <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="mobform">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form" action="{{route('supplier_registration')}}">
                        @csrf
                        <h2 class="form-title text-center" style="margin-bottom:30px;">Create account</h2>
                        
                        <div class="form-group">
                            <input type="text" class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" placeholder="Your Name" value="{{old('name')}}"/>
                        
                        @if($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('name')}}</strong>
                        </span>
                        @endif

                        </div>

                        <div class="form-group">
                            <input type="text" class="form-input {{ $errors->has('company_name') ? 'is-invalid' : '' }}" name="company_name" id="company_name" placeholder="Company Name" value="{{old('company_name')}}"/>
                        
                        @if($errors->has('company_name'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('company_name')}}</strong>
                        </span>
                        @endif
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-input {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" name="mobile_number" id="mobile_number" placeholder="Mobile number" value="{{old('mobile_number')}}"/>
                        
                        @if($errors->has('mobile_number'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('mobile_number')}}</strong>
                        </span>
                        @endif
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" placeholder="Company Email" value="{{old('email')}}"/>
                        
                            @if($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('email')}}</strong>
                        </span>
                        @endif
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-input {{ $errors->has('vat_no') ? 'is-invalid' : '' }}" name="vat_no" id="vat_no" placeholder="VAT No." value="{{old('vat_no')}}"/>
                        
                            @if($errors->has('vat_no'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('vat_no')}}</strong>
                        </span>
                        @endif
                        </div>

						<div class="form-group">
    <input type="password" class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password" placeholder="Password" />
    <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
    @if($errors->has('password'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <input type="password" class="form-input {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" />
    @if($errors->has('password_confirmation'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif
</div>


                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="#" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>
              </div>
            </div>
		  
            <div class="col-lg-6 align-self-center d-none d-md-block d-lg-block">
              <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                
				<h6>Welcome to AU2OMATION</h6>
                
			<h2>Reach millions of B2B clients   <em style="color:#fff !important">worldwide</em>   with our premium offerings?<div></div></h2>
         
		      <fieldset style="margin-top:30px;">
                  <button type="submit" id="form-submit" class="main-button">Join Now</button>
                </fieldset>
		 
                <!-- <form id="search" action="#" method="GET">
                  <fieldset>
                    <input type="address" name="address" class="email" placeholder="Your website URL..." autocomplete="on" required>
                  </fieldset>
                  <fieldset>
                    <button type="submit" class="main-button">Analyze Site</button>
                  </fieldset>
                </form> -->
              </div>
            </div>
           
          </div>
  </div>
  </div>
  
    <div id="services" class="our-services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="left-image">
            <img src="assets/images/services-left-image.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="section-heading">
            <h2>Start Your Supplier Journey with 
 <em>Au2omation</em></h2>
            <p>Au2omation is a leading B2B marketplace. From manufacturer to seller, everyone gets benefit from Au2omation. 
Selling on Au2omation is an easy process that can get you exponential business growth with minor investments.
We are looking forward to establish as ‘trusted seller’ hub giving our sellers a secure platform to grow their businesses on a wider prospect.</p>
          </div>
    
        </div>
      </div>
    </div>
  </div>

  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 d-none d-md-block d-lg-block">
          <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <img src="assets/images/about-left-image.png" alt="person graphic">
          </div>
        </div>
        <div class="col-lg-8 align-self-center">
          <div class="services">
            <div class="row">
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                  <div class="icon">
                    <img src="assets/images/service-icon-01.png" alt="reporting">
                  </div>
                  <div class="right-text">
                    <h4>List Products</h4>
                    <p>In your supplier panel, list the goods you intend to sell. </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                  <div class="icon">
                    <img src="assets/images/service-icon-02.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Get Orders</h4>
                    <p style="text-align: left !important;">You are now ready to start getting orders from massive shoppers actively purchasing from our platform. </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                  <div class="icon">
                    <img src="assets/images/service-icon-03.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Free- Freight Service</h4>
                    <p>Free pick-up and shipping from your warehouse</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="1.1s">
                  <div class="icon">
                    <img src="assets/images/service-icon-04.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Accept Payments</h4>
                    <p style="text-align: left !important;">Payments are deposited directly to your bank account following a 7-day payment cycle from order delivery. </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div id="portfolio wow fadeInLeft" class="our-portfolio">
    <div class="container">
    <div class="container">
      <div class="row" style="margin-bottom:35px;">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h2>Categories</h2>
          </div>
        </div>
      </div>
	  
	  <div class="row" style="margin-bottom:30px;">
     
       <div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/Digital Content and Devices.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Digital Content and Devices</p>
          </div>
      </div>
<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/electricals.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Electricals</p>          
   </div>
   </div>
<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/General Electricals.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>General Electricals</p>
          </div>
      </div>

     <div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/General items.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>General Items</p>
          </div>
      </div>

<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/Hardwares.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Hardwares</p>
          </div>
      </div>

<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/home appliances.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Home Appliances</p>
          </div>
      </div>
      </div>
  <div class="row" style="margin-bottom:30px;">
<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/hydraulics.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Hydraulics</p>
          </div>
      </div>

<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/industrial-automation.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Industrial Automation</p>
          </div>
      </div>

<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/instrumentation.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Instrumentations</p>
          </div>
      </div>

<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/material handling.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Material Handling</p>
          </div>
      </div>

<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/Office automation.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Office Automation</p>
          </div>
      </div>

<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/pneumatics.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Pneumatics</p>
          </div>
      </div>
      </div>
 <div class="row" style="margin-bottom:30px;">
<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/pumps.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Pumps</p>
          </div>
      </div>

<div class="col-lg-2 col-md-2 col-sm-6 col-6">
        <div class="icon-container text-center">
          <img src="assets/images/category/stationery products.jpg" style="width: 75px;">
         
        </div>
		 <div class="icon-content">
            <p>Stationery Products</p>
          </div>
      </div>
      </div>


     
    </div>
  </div>
  </div>

 

<!--   <div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Feel Free To Send Us a Message About Your Website Needs</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doer ket eismod tempor incididunt ut labore et dolores</p>
            <div class="phone-info">
              <h4>For any enquiry, Call Us: <span><i class="fa fa-phone"></i> <a href="#">010-020-0340</a></span></h4>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <form id="contact" action="" method="post">
            <div class="row">
              <div class="col-lg-6">
                <fieldset>
                  <input type="name" name="name" id="name" placeholder="Name" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="surname" name="surname" id="surname" placeholder="Surname" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email" required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required=""></textarea>  
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="main-button ">Send Message</button>
                </fieldset>
              </div>
            </div>
            <div class="contact-dec">
              <img src="assets/images/contact-decoration.png" alt="">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
 -->
 
     <div id="" class="section" style="margin-top:5%;">
    <div class="container">
      <div class="row">
       
        <div class="col-md-4  wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="section-heading">
            <h2>Why do sellers love selling on ️ 
            <em>Au2omation?</em></h2>
		    <div class="cbox">
		    <h6><img src="assets/images/cooperation.png" style="width:50px;">&nbsp;&nbsp;&nbsp;&nbsp; Ease of Doing Business</h6>
		    <p class="ccont">Create your Au2omation seller account in under 10 minutes with just 1 product and a valid GSTIN number.</p>
		   </div>
		   
		    <div class="cbox">
			
			<h6><img src="assets/images/customer-service.png" style="width:50px;">&nbsp;&nbsp;&nbsp;&nbsp; Additional support</h6>
			
		    <p class="ccont">Account management services, 24*7 customer service, business insights and more</p>
		   </div>
		   
          </div>
    
        </div>
		
		<div class="col-md-6 align-self-center  wow fadeInLeft section-heading text-center" data-wow-duration="1s" data-wow-delay="0.2s">
		 <h2>We are happy to  ️ 
            <em>Help you</em></h2>
         <form id="contact" action="" method="post">
            <div class="row">
              
			  <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="name" id="name" placeholder="Full name" autocomplete="on" required>
                </fieldset>
              </div>
			  
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile number" autocomplete="on" required>
                </fieldset>
              </div>
			  
			  <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="subject" id="subject" placeholder="Enter Subject" autocomplete="on" required>
                </fieldset>
              </div>
             
              <div class="col-lg-12">
                <fieldset>
                  <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required=""></textarea>  
                </fieldset>
              </div>
			  
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="main-button ">Send Message</button>
                </fieldset>
              </div>
            </div>
           
          </form>
        </div>
		
		<div class="col-md-2 align-self-center  wow fadeInLeft section-heading text-center d-none d-md-block d-lg-block" data-wow-duration="1s" data-wow-delay="0.2s">
		 <div class="contact-dec">
              <img src="assets/images/contact-decoration.png" alt="">
            </div>
		</div>
		
      </div>
    </div>
  </div>
  @include('default.footer')