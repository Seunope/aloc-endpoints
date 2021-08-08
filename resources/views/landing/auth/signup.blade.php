
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

      @include('landing.layouts.partials._header_note2')


    <div class="intro-section" id="home-section">

      <div class="slide-1" style="background-image: url('images/hero_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                  <h1  data-aos="fade-up" data-aos-delay="100">7,000 free Past Questions API calls</h1>
                  <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Make API calls to get major Nigeria exams past questions.</p>
                    <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">UTME | WASSCE | POST-UTME | ALOC GAMES</p>
                    <p data-aos="fade-up" data-aos-delay="300"><a href="#" class="btn btn-primary py-3 px-5 btn-pill">Start Now</a></p>

                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <form action="{{route('signup')}}" method="post" class="form-box"  >
                      @include('flash::message')
                      @csrf
                    <h3 class="h4 text-black mb-4">Sign Up
                        <h6></h6>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name"  value="{!! old('name') !!}" placeholder="Full Name" required>
                    </div>
                    @foreach($errors->get('name') as $message)
                        <span class="btn-danger  small">{{$message}}</span>
                    @endforeach

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
                      <input type="submit" class="btn btn-primary btn-pill" value="Sign up">
                    </div>
                  </form>

                </div>

              </div>
            </div>

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
