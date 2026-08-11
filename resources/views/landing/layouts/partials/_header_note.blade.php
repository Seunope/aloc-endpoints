<header class="site-navbar py-3 site-navbar-target" style="background: #0f172a; border-bottom: 1px solid #1e293b; position: relative; z-index: 1000;" role="banner">

    <div class="container-fluid px-lg-5">
        <div class="d-flex align-items-center justify-content-between">
            <div class="site-logo">
                <a href="{{url('/')}}" class="text-white font-weight-bold" style="font-size: 20px; text-decoration: none;">ALOC Endpoints</a>
            </div>

            <div class="d-none d-lg-block">
                <nav class="site-navigation" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav m-0 p-0 d-flex align-items-center" style="gap: 20px; list-style: none;">
                        <li><a href="#home-section" class="nav-link text-white" style="font-size: 14px;">Home</a></li>
                        <li><a href="#programs-section" class="nav-link text-white-50" style="font-size: 14px;">APIs</a></li>
                        <li><a href="#subjects-section" class="nav-link text-white-50" style="font-size: 14px;">Subjects</a></li>
                        <li><a href="#pricing-section" class="nav-link text-white-50" style="font-size: 14px;">Pricing</a></li>
                        <li><a href="https://github.com/Seunope/aloc-endpoints" target="_blank" class="nav-link text-white-50" style="font-size: 14px;">Docs</a></li>
                    </ul>
                </nav>
            </div>

@php
    $now = \Carbon\Carbon::now();
    $isSignupDisabled = $now->gte(\Carbon\Carbon::parse('2027-02-01 00:00:00'));
    $isEolReached = $now->gte(\Carbon\Carbon::parse('2027-05-01 00:00:00'));
@endphp

            <div class="d-none d-lg-flex align-items-center" style="gap: 12px;">
                <a href="https://aloc.com.ng" target="_blank" class="btn font-weight-bold px-3 py-2 text-dark" style="background: #f59e0b; border: none; border-radius: 20px; font-size: 13px; white-space: nowrap; box-shadow: 0 2px 8px rgba(245,158,11,0.3);">ALOC Station ✨</a>
                @if($isSignupDisabled || $isEolReached)
                    <button class="btn btn-secondary font-weight-bold px-3 py-2 btn-signup" disabled style="border-radius: 20px; font-size: 13px; white-space: nowrap; opacity: 0.6; cursor: not-allowed;">Sign Up Closed</button>
                @else
                    <a href="{{url('/secure/signup')}}" class="btn btn-primary font-weight-bold px-3 py-2 btn-signup" style="border-radius: 20px; font-size: 13px; white-space: nowrap;">Sign Up</a>
                @endif
            </div>

            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-white float-right"><span class="icon-menu h3"></span></a>
        </div>
    </div>

</header>
