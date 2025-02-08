<!-- Start Navbar -->
<nav id="topnav" class="defaultscroll is-sticky">
    <div class="container relative">
        <!-- Logo container-->
        <a class="logo" href=" ">
            <span class="inline-block dark:hidden">
                <img src="{{ asset('assets/images/logo-dark.png') }}" class="l-dark" height="24"
                    alt="{{ __('site.logo_alt') }}">
                <img src="{{ asset('assets/images/logo-light.png') }}" class="l-light" height="24"
                    alt="{{ __('site.logo_alt') }}">
            </span>
            <img src="{{ asset('assets/images/logo-light.png') }}" height="24" class="hidden dark:inline-block"
                alt="{{ __('site.logo_alt') }}">
        </a>

        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <!--Login button Start-->
        <ul class="buy-button list-none mb-0">
            <li class="inline mb-0">
                <a href="{{ route('login') }}">
                    <span class="login-btn-primary"><span
                            class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600/5 hover:bg-indigo-600 border border-indigo-600/10 hover:border-indigo-600 text-indigo-600 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M11 7L9.6 8.4l2.6 2.6H2v2h10.2l-2.6 2.6L11 17l5-5zm9 12h-8v2h8c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-8v2h8z" />
                            </svg>
                        </span></span>
                    <span class="login-btn-light"><span
                            class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-gray-50 hover:bg-gray-200 dark:bg-slate-900 dark:hover:bg-gray-700 border hover:border-gray-100 dark:border-gray-800 dark:hover:border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M11 7L9.6 8.4l2.6 2.6H2v2h10.2l-2.6 2.6L11 17l5-5zm9 12h-8v2h8c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-8v2h8z" />
                            </svg>
                        </span></span>
                </a>
            </li>

            <li class="inline ps-1 mb-0">
                <a href="{{ route('register') }}">
                    <div class="login-btn-primary"><span
                            class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border border-indigo-600 hover:border-indigo-700 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m-9-2V7H4v3H1v2h3v3h2v-3h3v-2zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4" />
                            </svg>
                        </span></div>
                    <div class="login-btn-light"><span
                            class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-gray-50 hover:bg-gray-200 dark:bg-slate-900 dark:hover:bg-gray-700 border hover:border-gray-100 dark:border-gray-800 dark:hover:border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m-9-2V7H4v3H1v2h3v3h2v-3h3v-2zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4" />
                            </svg>
                        </span></div>
                </a>
            </li>
        </ul>
        <!--Login button End-->

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu nav-light justify-start">
                <li><a href=" " class="sub-menu-item">{{ __('site.home') }}</a></li>

                <!-- Services Section -->
                <li class="has-submenu parent-parent-menu-item">
                    <a href="javascript:void(0)">{{ __('site.services') }}</a><span class="menu-arrow"></span>
                    <ul class="submenu megamenu">
                        <li>
                            <ul>
                                <li class="megamenu-head">{{ __('site.digital_services') }}</li>
                                <li><a href="#" class="sub-menu-item">{{ __('site.web_design') }}</a></li>
                                <li><a href="#" class="sub-menu-item">{{ __('site.digital_marketing') }}</a></li>
                                <li><a href="#" class="sub-menu-item">{{ __('site.seo') }}</a></li>
                                <li><a href="#" class="sub-menu-item">{{ __('site.video_editing') }}</a></li>
                            </ul>
                        </li>

                        <li>
                            <ul>
                                <li class="megamenu-head">{{ __('site.business_services') }}</li>
                                <li><a href="#" class="sub-menu-item">{{ __('site.legal_services') }}</a></li>
                                <li><a href="#" class="sub-menu-item">{{ __('site.accounting') }}</a></li>
                                <li><a href="#" class="sub-menu-item">{{ __('site.consulting') }}</a></li>
                                <li><a href="#" class="sub-menu-item">{{ __('site.translation') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Freelancers Section -->
                <li class="has-submenu parent-parent-menu-item">
                    <a href="javascript:void(0)">{{ __('site.freelancers') }}</a><span class="menu-arrow"></span>
                    <ul class="submenu megamenu">
                        <li>
                            <ul>
                                <li class="megamenu-head">{{ __('site.by_skill') }}</li>
                                <li><a href=" " class="sub-menu-item">PHP Developers</a></li>
                                <li><a href=" " class="sub-menu-item">JavaScript Developers</a></li>
                                <li><a href=" " class="sub-menu-item">UI/UX Designers</a></li>
                                <li><a href=" " class="sub-menu-item">Content Writers</a></li>
                            </ul>
                        </li>

                        <li>
                            <ul>
                                <li class="megamenu-head">{{ __('site.by_location') }}</li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.asia') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.algeria') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.egypt') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.iraq') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.india') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.jordan') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.syria') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.morocco') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>


                <!-- Services Section -->
                <li class="has-submenu parent-parent-menu-item">
                    <a href="javascript:void(0)">{{ __('site.services') }}</a><span class="menu-arrow"></span>
                    <ul class="submenu megamenu">
                        <li>
                            <ul>
                                <li class="megamenu-head">{{ __('site.digital_services') }}</li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.web_design') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.digital_marketing') }}</a>
                                </li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.seo') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.video_editing') }}</a></li>
                            </ul>
                        </li>

                        <li>
                            <ul>
                                <li class="megamenu-head">{{ __('site.business_services') }}</li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.legal_services') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.accounting') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.consulting') }}</a></li>
                                <li><a href=" " class="sub-menu-item">{{ __('site.translation') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Language Switcher -->
                <li class="has-submenu parent-menu-item">
                    <a href="javascript:void(0)">{{ __('site.language') }}</a><span class="menu-arrow"></span>
                    <ul class="submenu">
                        <li><a href="?lang=en" class="sub-menu-item">{{ __('site.english') }}</a></li>
                        <li><a href="?lang=ar" class="sub-menu-item">{{ __('site.arabic') }}</a></li>
                    </ul>
                </li>

            </ul><!--end navigation menu-->
        </div><!--end navigation-->
    </div><!--end container-->
</nav><!--end header-->
<!-- End Navbar -->
