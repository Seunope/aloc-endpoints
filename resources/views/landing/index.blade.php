
@extends('landing.layouts.base')

@section('content')

@php
    $now = \Carbon\Carbon::now();
    $isSignupDisabled = $now->gte(\Carbon\Carbon::parse('2027-05-01 00:00:00'));
    $isEolReached = $now->gte(\Carbon\Carbon::parse('2027-08-01 00:00:00'));
@endphp


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <!-- End-of-Life Announcement & Countdown Banner -->
    <div class="eol-banner py-3 px-3" style="background: linear-gradient(135deg, #1e293b, #0f172a); border-bottom: 2px solid #f59e0b; color: #f8fafc; font-family: 'Muli', sans-serif; position: relative; z-index: 2000;">
      <div class="container">
        <div class="row align-items-center text-center text-md-left">
          <div class="col-lg-7 mb-2 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
              <span class="badge badge-warning text-uppercase mr-2 px-2 py-1 eol-badge" style="background: #f59e0b; color: #78350f; font-weight: 700; font-size: 11px; letter-spacing: 0.5px; border-radius: 4px;">⚠️ LEGACY NOTICE</span>
              <span style="font-size: 14px; font-weight: 600;" class="text-white">ALOC Endpoints End-of-Life Shutdown in:</span>
            </div>
            <p class="mb-0 mt-1 small" style="color: #94a3b8; font-size: 13px;">
              This legacy version is reaching end-of-life in 12 months (from August 1st, 2026). Switch to <a href="https://aloc.com.ng" target="_blank" style="color: #fbbf24; text-decoration: underline; font-weight: 600;">ALOC Station (aloc.com.ng)</a> for the new API infrastructure.
            </p>
          </div>
          <div class="col-lg-5 text-center text-lg-right">
            <div class="d-inline-flex align-items-center justify-content-center p-2 px-3 rounded shadow-sm" style="border: 1px solid rgba(245, 158, 11, 0.3); background: #020617 !important;">
              <div class="text-center px-2">
                <span id="eol-days" style="font-size: 20px; font-weight: 800; color: #fbbf24; font-family: monospace; display: block; line-height: 1;">355</span>
                <span style="font-size: 9px; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.5px;">Days</span>
              </div>
              <span style="font-size: 18px; color: #f59e0b; font-weight: 700; margin-top: -8px;">:</span>
              <div class="text-center px-2">
                <span id="eol-hours" style="font-size: 20px; font-weight: 800; color: #fbbf24; font-family: monospace; display: block; line-height: 1;">00</span>
                <span style="font-size: 9px; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.5px;">Hours</span>
              </div>
              <span style="font-size: 18px; color: #f59e0b; font-weight: 700; margin-top: -8px;">:</span>
              <div class="text-center px-2">
                <span id="eol-minutes" style="font-size: 20px; font-weight: 800; color: #fbbf24; font-family: monospace; display: block; line-height: 1;">00</span>
                <span style="font-size: 9px; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.5px;">Mins</span>
              </div>
              <span style="font-size: 18px; color: #f59e0b; font-weight: 700; margin-top: -8px;">:</span>
              <div class="text-center px-2">
                <span id="eol-seconds" style="font-size: 20px; font-weight: 800; color: #ef4444; font-family: monospace; display: block; line-height: 1;">00</span>
                <span style="font-size: 9px; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.5px;">Secs</span>
              </div>
            </div>
            <a href="https://aloc.com.ng" target="_blank" class="btn btn-sm btn-warning ml-2 font-weight-bold" style="background: #f59e0b; border: none; color: #1e1b4b; padding: 6px 14px; font-size: 12px; border-radius: 4px;">Migrate Now →</a>
          </div>
        </div>
      </div>
    </div>

    @include('landing.layouts.partials._header_note')

    <div class="intro-section" id="home-section">

      <div class="slide-1" style="background-image: url('images/hero_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                  <h1  data-aos="fade-up" data-aos-delay="100">Access 20,000 Past Questions</h1>
                  <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Make API calls to get major Nigeria exams past questions.</p>
                    <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">UTME | WASSCE | POST-UTME | ALOC GAMES</p>
                    @if($isSignupDisabled || $isEolReached)
                      <p data-aos="fade-up" data-aos-delay="300"><button class="btn btn-secondary py-3 px-5 btn-pill btn-signup" disabled style="opacity: 0.6; cursor: not-allowed;">Sign Up Closed</button></p>
                    @else
                      <p data-aos="fade-up" data-aos-delay="300"><a href="{{url('secure/signup')}}" class="btn btn-primary py-3 px-5 btn-pill btn-signup">Start Now</a></p>
                    @endif

                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <form action="{{route('login')}}" method="post" class="form-box"  >
                      @include('flash::message')
                      @csrf
                    <h3 class="h4 text-black mb-4">Login</h3>

                    <div class="form-group">
                      <input type="text" class="form-control" name="email"  value="{!! old('email') !!}" placeholder="Email Address" required @if($isEolReached) disabled @endif>
                    </div>
                    @foreach($errors->get('email') as $message)
                        <span class="btn-danger small">{{$message}}</span>
                    @endforeach

                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Password" required @if($isEolReached) disabled @endif>
                    </div>
                    @foreach($errors->get('password') as $message)
                        <span class="btn-danger">{{$message}}</span>
                    @endforeach

                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-pill btn-login-submit" value="{{ $isEolReached ? 'Service Closed' : 'Submit' }}" @if($isEolReached) disabled style="opacity: 0.6; cursor: not-allowed;" @endif>
                    </div>
                    @if(!$isEolReached)
                        <p style="color:lightslategrey"><a href="{{url('secure/forget-password')}}">Forgot Password</a></p>
                    @else
                        <p style="color: #ef4444; font-size: 13px; font-weight: 600;">Legacy service sunset. Login disabled.</p>
                    @endif
                  </form>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- What's New in ALOC Station Section -->
    <div class="site-section py-5" id="aloc2-section" style="background: #090d16; color: #f8fafc; border-top: 1px solid #1e293b; border-bottom: 1px solid #1e293b;">
      <div class="container">
        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-9" data-aos="fade-up">
            <span class="badge px-3 py-2 mb-3" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 20px; font-size: 12px; font-weight: 600; letter-spacing: 0.5px;">✨ INTRODUCING ALOC STATION</span>
            <h2 class="text-white font-weight-bold display-4 mb-3" style="font-size: 34px; letter-spacing: -0.5px;">The Next-Gen Assessment Data Infrastructure</h2>
            <p style="color: #94a3b8; font-size: 16px; max-width: 680px;" class="mx-auto">
              We've upgraded from simple past question endpoints to a complete assessment content platform for EdTech across Africa. Discover structured topic taxonomies, step-by-step explanations, and real-time developer APIs at <a href="https://aloc.com.ng" target="_blank" style="color: #fbbf24; text-decoration: underline;">aloc.com.ng</a>.
            </p>
          </div>
        </div>

        <div class="row">
          <!-- Card 1 -->
          <div class="col-md-6 col-lg-3 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="p-4 rounded-lg w-100 d-flex flex-column justify-content-between" style="background: #111827; border: 1px solid #1f2937; border-radius: 12px;">
              <div>
                <div class="mb-3 d-inline-block px-2 py-1 rounded" style="background: rgba(245, 158, 11, 0.2); color: #fbbf24; font-family: monospace; font-weight: 700; font-size: 12px;">L1 - L4 LAYERS</div>
                <h4 class="text-white font-weight-bold h5 mb-2">4 Progressive Access Layers</h4>
                <p style="color: #94a3b8; font-size: 13.5px; line-height: 1.6;">
                  From raw question batching (L1) to topic metadata (L2), detailed step-by-step explanations (L3), and educational intelligence (L4).
                </p>
              </div>
              <div class="mt-3 pt-3 border-top" style="border-color: #1f2937 !important;">
                <span style="color: #fbbf24; font-size: 12px; font-weight: 600;">Pay per call, not per tier →</span>
              </div>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="col-md-6 col-lg-3 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="p-4 rounded-lg w-100 d-flex flex-column justify-content-between" style="background: #111827; border: 1px solid #1f2937; border-radius: 12px;">
              <div>
                <div class="mb-3 d-inline-block px-2 py-1 rounded" style="background: rgba(16, 185, 129, 0.2); color: #34d399; font-family: monospace; font-weight: 700; font-size: 12px;">1988 - 2025</div>
                <h4 class="text-white font-weight-bold h5 mb-2">Expanded Exam Coverage</h4>
                <p style="color: #94a3b8; font-size: 13.5px; line-height: 1.6;">
                  Comprehensive syllabus-aligned data across UTME / JAMB, WAEC, NECO, and POST-UTME institution screening papers.
                </p>
              </div>
              <div class="mt-3 pt-3 border-top" style="border-color: #1f2937 !important;">
                <span style="color: #34d399; font-size: 12px; font-weight: 600;">Continuously verified datasets →</span>
              </div>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="col-md-6 col-lg-3 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="p-4 rounded-lg w-100 d-flex flex-column justify-content-between" style="background: #111827; border: 1px solid #1f2937; border-radius: 12px;">
              <div>
                <div class="mb-3 d-inline-block px-2 py-1 rounded" style="background: rgba(99, 102, 241, 0.2); color: #818cf8; font-family: monospace; font-weight: 700; font-size: 12px;">FREE PLAYGROUND</div>
                <h4 class="text-white font-weight-bold h5 mb-2">1,000 Free Credits / Mo</h4>
                <p style="color: #94a3b8; font-size: 13.5px; line-height: 1.6;">
                  Test queries in &lt;10 mins using our interactive API Playground, instant key generation, and transparent credit pricing.
                </p>
              </div>
              <div class="mt-3 pt-3 border-top" style="border-color: #1f2937 !important;">
                <span style="color: #818cf8; font-size: 12px; font-weight: 600;">No credit card required →</span>
              </div>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="col-md-6 col-lg-3 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="p-4 rounded-lg w-100 d-flex flex-column justify-content-between" style="background: #111827; border: 1px solid #1f2937; border-radius: 12px;">
              <div>
                <div class="mb-3 d-inline-block px-2 py-1 rounded" style="background: rgba(236, 72, 153, 0.2); color: #f472b6; font-family: monospace; font-weight: 700; font-size: 12px;">EXPLANATIONS & AI</div>
                <h4 class="text-white font-weight-bold h5 mb-2">Explanations & Common Mistakes</h4>
                <p style="color: #94a3b8; font-size: 13.5px; line-height: 1.6;">
                  Enrich your apps with step-by-step breakdowns, common student pitfalls, and related curriculum topics.
                </p>
              </div>
              <div class="mt-3 pt-3 border-top" style="border-color: #1f2937 !important;">
                <span style="color: #f472b6; font-size: 12px; font-weight: 600;">Power AI tutors & apps →</span>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-4">
          <a href="https://aloc.com.ng" target="_blank" class="btn btn-pill py-3 px-5 font-weight-bold text-dark mr-3 mb-2" style="background: #f59e0b; border: none; font-size: 15px; box-shadow: 0 4px 14px rgba(245, 158, 11, 0.4);">Visit ALOC Station at aloc.com.ng 🚀</a>
          <a href="https://aloc.com.ng/register" target="_blank" class="btn btn-pill py-3 px-4 text-white mb-2" style="border: 1px solid #374151; background: transparent; font-size: 15px;">Get Free API Key →</a>
        </div>
      </div>
    </div>

    <div class="site-section" id="programs-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center"  data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Leverage on our APIs</h2>
            <p>Focus on building great apps for students with unlimited access to trivial questions of major exams in Nigeria!</p>
          </div>
        </div>
        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="{{url('landing/images/api_question_sample.png')}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">How to get started</h2>
            <p class="mb-4">Create a free account today and an Access Token will be generated for you to communicate with our REST APIs.</p>

              <p class="mb-4">Add the access token as header when calling our APIs. <a href="https://github.com/Seunope/aloc-endpoints" target="_blank">API endpoints documentation is here.</a></p>

          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="{{url('landing/images/test.jpg')}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">Exam supported</h2>
            <p class="mb-4">We have questions for three major exams in Nigeria</p>

            <div class="d-flex align-items-center custom-icon-wrap mb-3">
              <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span>
              <div><h3 class="m-0">UTME</h3></div>
            </div>

            <div class="d-flex align-items-center custom-icon-wrap">
              <span class="custom-icon-inner mr-3"><span class="icon icon-university"></span></span>
              <div><h3 class="m-0"> WASSCE (limited)</h3></div>
            </div>

              <div class="d-flex align-items-center custom-icon-wrap mb-3">
                  <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span>
                  <div><h3 class="m-0">Post-UTME (very limited)</h3></div>
              </div>

          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="{{url('landing/images/brainstorm.jpg')}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">Years Supported</h2>
            <p class="mb-4">This depends on the subject, but please note, the years varies from 2001 to 2020</p>

          </div>
        </div>

      </div>
    </div>

    <div class="site-section" id="pricing-section">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 mb-5 text-center"  data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Our Pricing</h2>
            <p class="mb-5">Create a free account and get authorization token to talk to our past questions endpoints remotely</p>
          </div>
        </div>

        <div class="row">

          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="teacher text-center">
{{--              <img src="{{url('landing/images/person_1.jpg')}}" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">--}}
              <div class="py-2">
                <h3 class="text-black">Access Plan</h3>
                <p class="position">7,000 free API calls</p>
                <p>Default units: 5,000 </p>
                  <p>Bonus units: 2,000 </p>
                  <p>Price: FREE </p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="teacher text-center">
{{--              <img src="{{url('landing/images/person_2.jpg')}}" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">--}}
              <div class="py-2">
                <h3 class="text-black">Basic Plan</h3>
                <p class="position">10,0000 free API calls</p>
                  <p>Default units: 10,000 </p>
                  <p>Bonus units: 10,000 </p>
                  <p>Price: ₦2,000 </p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
            <div class="teacher text-center">
{{--              <img src="{{url('landing/images/person_3.jpg')}}" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">--}}
              <div class="py-2">
                <h3 class="text-black">Huge Plan</h3>
                <p class="position">Unlimited API calls</p>
                  <p>Default units: 70,000 </p>
                  <p>Bonus units: 50,000 </p>
                  <p>Price: ₦5,000 </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-image overlay" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-8 text-center testimony">
            <img src="{{url('assets/aloc-shield.png')}}" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
            <h3 class="mb-4">Supported By ALOC</h3>
            <blockquote>
              <p>&ldquo; ALOC is an adventure based CBT practice platform with an engaging game story that unravels as students’ progresses in game levels. We use gaming concepts to increase student practice time and grade &rdquo;</p>
            </blockquote>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section pb-0" id="subjects-section">

      <div class="future-blobs">
        <div class="blob_2">
          <img src="{{url('landing/images/blob_2.svg')}}" alt="Image">
        </div>
        <div class="blob_1">
          <img src="{{url('landing/images/blob_1.svg')}}" alt="Image">
        </div>
      </div>
      <div class="container" >
        <div class="row mb-5 justify-content-center" data-aos="fade-up" data-aos-delay="">
          <div class="col-lg-7 text-center">
            <h2 class="section-title">Supported Subjects</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto align-self-start"  data-aos="fade-up" data-aos-delay="100">

            <P>We currently support 17 subjects</P>

            <div class="p-4 rounded bg-white why-choose-us-box">

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-graduation-cap"></span></span></div>
                <div><h3 class="m-0"> English language</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                <div><h3 class="m-0">Mathematics</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-graduation-cap"></span></span></div>
                <div><h3 class="m-0">Commerce</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                <div><h3 class="m-0">Accounting</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-graduation-cap"></span></span></div>
                <div><h3 class="m-0">Biology</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                <div><h3 class="m-0">Physics</h3></div>
              </div>

                <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                    <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                    <div><h3 class="m-0">Chemistry</h3></div>
                </div>

                <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                    <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-graduation-cap"></span></span></div>
                    <div><h3 class="m-0"> English literature</h3></div>
                </div>

                <div class="d-flex align-items-center custom-icon-wrap custom-icon-light">
                    <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                    <div><h3 class="m-0">more ...</h3></div>
                </div>

            </div>


          </div>
          <div class="col-lg-7 align-self-end"  data-aos="fade-left" data-aos-delay="200">
            <img src="{{url('landing/images/person_transparent.png')}}" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>





    <div class="site-section bg-light" id="contact-section">
      <div class="container">

        <div class="row justify-content-center">
          <div class="col-md-7">



            <h2 class="section-title mb-3">Contact Us</h2>
            <p class="mb-5">Over 6,854,170 API questions request has been made to this library. Do you have questions you want to add to this database? We are excited to receive your mail at aloc.mass@gmail.com</p>


          </div>
        </div>
      </div>
    </div>


  <script>
    (function() {
      // EOL date: 12 months from August 1st 2026 -> August 1st 2027 00:00:00 UTC
      var eolDate = new Date('2027-08-01T00:00:00Z').getTime();
      // 3 months before EOL date -> May 1st 2027 00:00:00 UTC
      var signupDisableDate = new Date('2027-05-01T00:00:00Z').getTime();

      function updateCountdown() {
        var now = new Date().getTime();
        var distance = eolDate - now;

        if (distance < 0) {
          distance = 0;
        }

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var dEl = document.getElementById('eol-days');
        var hEl = document.getElementById('eol-hours');
        var mEl = document.getElementById('eol-minutes');
        var sEl = document.getElementById('eol-seconds');

        if (dEl) dEl.innerText = days < 10 ? '0' + days : days;
        if (hEl) hEl.innerText = hours < 10 ? '0' + hours : hours;
        if (mEl) mEl.innerText = minutes < 10 ? '0' + minutes : minutes;
        if (sEl) sEl.innerText = seconds < 10 ? '0' + seconds : seconds;

        // Rule 1: 3 months before EOL (May 1, 2027 onwards) -> Disable SIGN UP
        if (now >= signupDisableDate || now >= eolDate) {
          var signupButtons = document.querySelectorAll('.btn-signup');
          signupButtons.forEach(function(btn) {
            btn.classList.add('disabled');
            btn.style.pointerEvents = 'none';
            btn.style.opacity = '0.6';
            btn.style.cursor = 'not-allowed';
            btn.innerText = 'Sign Up Closed';
            if (btn.tagName === 'A') {
              btn.removeAttribute('href');
            }
          });
        }

        // Rule 2: 12 months / EOL reached (August 1, 2027 onwards) -> Disable LOGIN & SIGN UP
        if (now >= eolDate) {
          var loginSubmit = document.querySelector('.btn-login-submit');
          var loginInputs = document.querySelectorAll('.form-box input');
          if (loginSubmit) {
            loginSubmit.disabled = true;
            loginSubmit.value = 'Service Closed';
            loginSubmit.style.opacity = '0.6';
            loginSubmit.style.cursor = 'not-allowed';
          }
          loginInputs.forEach(function(input) {
            input.disabled = true;
          });

          var badgeEl = document.querySelector('.eol-badge');
          if (badgeEl) {
            badgeEl.innerText = '🚨 LEGACY SERVICE SUNSET';
            badgeEl.style.background = '#ef4444';
            badgeEl.style.color = '#ffffff';
          }
        }
      }

      updateCountdown();
      setInterval(updateCountdown, 1000);
    })();
  </script>

  @include('landing.layouts.partials._footer_note')



@stop
