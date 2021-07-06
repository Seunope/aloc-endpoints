
@extends('landing.layouts.base')

@section('content')


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
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
                    <p data-aos="fade-up" data-aos-delay="300"><a href="#" class="btn btn-primary py-3 px-5 btn-pill">Start Now</a></p>

                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <form action="{{route('login')}}" method="post" class="form-box"  >
                      @include('flash::message')
                      @csrf
                    <h3 class="h4 text-black mb-4">Login

                    <div class="form-group">
                      <input type="text" class="form-control" name="email"  value="{!! old('email') !!}" placeholder="Email Address" required>
                    </div>
                    @foreach($errors->get('email') as $message)
                        <span class="btn-danger small">{{$message}}</span>
                    @endforeach

                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    @foreach($errors->get('password') as $message)
                        <span class="btn-danger">{{$message}}</span>
                    @endforeach
{{--                    <div class="form-group mb-4">--}}
{{--                      <input type="password" class="form-control" placeholder="Re-type Password">--}}
{{--                    </div>--}}
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-pill" value="Submit">
                    </div>
                  </form>

                </div>
              </div>
            </div>

          </div>
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
            <h2 class="text-black mb-4">How it started</h2>
            <p class="mb-4">We have this database of past questions which took lot of effort and resources to put together. We felt those questions are sitting too idle so we decided to open its APIs end points.</p>

              <p class="mb-4">Software developers, educators and stakeholders can use these questions to develop interesting apps for students.</p>


          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="{{url('landing/images/undraw_teaching.svg')}}" alt="Image" class="img-fluid">
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
            <img src="{{url('landing/images/undraw_teacher.svg')}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">Years Supported</h2>
            <p class="mb-4">This depends on the subject, but please note, the years vary from 2001 to 2020</p>

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
                <p class="position">50,000 free API calls</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro eius suscipit delectus enim iusto tempora, adipisci at provident.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="teacher text-center">
{{--              <img src="{{url('landing/images/person_2.jpg')}}" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">--}}
              <div class="py-2">
                <h3 class="text-black">Basic Plan</h3>
                <p class="position">100,0000 free API calls</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro eius suscipit delectus enim iusto tempora, adipisci at provident.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
            <div class="teacher text-center">
{{--              <img src="{{url('landing/images/person_3.jpg')}}" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">--}}
              <div class="py-2">
                <h3 class="text-black">Huge Plan</h3>
                <p class="position">Unlimited API calls</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro eius suscipit delectus enim iusto tempora, adipisci at provident.</p>
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
                    <div><h3 class="m-0">Physics</h3></div>
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
            <p class="mb-5">Over 5,483,149 API questions request has been made to this library. Do you have questions you want to add to this database? We are excited to receive your mail at aloc.mass@gmail.com</p>


          </div>
        </div>
      </div>
    </div>


  @include('landing.layouts.partials._footer_note')



@stop
