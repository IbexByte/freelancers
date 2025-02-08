<!-- Footer Start -->
<footer class="footer bg-dark-footer text-gray-200">
    <div class="container relative">
        <div class="grid grid-cols-12">
            <div class="col-span-12">
                <div class="py-10">
                    <div class="grid md:grid-cols-4 grid-cols-1 gap-10">
                        <!-- About Us -->
                        <div>
                            <a href="#" class="text-[22px] focus:outline-none">
                                <img src="assets/images/logo-light.png" alt="Logo">
                            </a>
                            <p class="mt-6 text-gray-300">
                                {{ __('site.footer_subscribe') }}
                            </p>
                        </div>

                        <!-- Useful Links -->
                        <div>
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">{{ __('site.footer_about_us') }}</h5>
                            <ul class="list-none footer-list mt-6 space-y-3">
                                <li><a href="#" class="text-gray-300 hover:text-gray-400 duration-500"><i class="uil uil-angle-right-b"></i> {{ __('site.footer_services') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-gray-400 duration-500"><i class="uil uil-angle-right-b"></i> {{ __('site.footer_team') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-gray-400 duration-500"><i class="uil uil-angle-right-b"></i> {{ __('site.footer_pricing') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-gray-400 duration-500"><i class="uil uil-angle-right-b"></i> {{ __('site.footer_projects') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-gray-400 duration-500"><i class="uil uil-angle-right-b"></i> {{ __('site.footer_blog') }}</a></li>
                            </ul>
                        </div>

                        <!-- Policies -->
                        <div>
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">{{ __('site.footer_terms') }}</h5>
                            <ul class="list-none footer-list mt-6 space-y-3">
                                <li><a href="#" class="text-gray-300 hover:text-gray-400 duration-500"><i class="uil uil-angle-right-b"></i> {{ __('site.footer_terms') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-gray-400 duration-500"><i class="uil uil-angle-right-b"></i> {{ __('site.footer_privacy') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-gray-400 duration-500"><i class="uil uil-angle-right-b"></i> {{ __('site.footer_contact') }}</a></li>
                            </ul>
                        </div>

                        <!-- Newsletter -->
                        <div>
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">{{ __('site.footer_subscribe') }}</h5>
                            <form class="mt-4">
                                <div class="relative">
                                    <input type="email" class="form-input w-full px-4 py-2 rounded bg-gray-800 border border-gray-700 text-gray-100 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="{{ __('site.footer_email_placeholder') }}">
                                    <button type="submit" class="absolute top-0 right-0 h-full px-4 bg-indigo-600 text-white rounded-r hover:bg-indigo-700">{{ __('site.footer_subscribe_button') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->

    <div class="py-6 border-t border-gray-700">
        <div class="container text-center">
            <p class="text-gray-400">© <script>document.write(new Date().getFullYear())</script> YourCompany. {{ __('site.footer_follow_us') }}</p>
            <ul class="flex justify-center mt-4 space-x-4">
                <li><a href="#" class="text-gray-400 hover:text-white duration-500"><i class="uil uil-facebook-f"></i></a></li>
                <li><a href="#" class="text-gray-400 hover:text-white duration-500"><i class="uil uil-twitter"></i></a></li>
                <li><a href="#" class="text-gray-400 hover:text-white duration-500"><i class="uil uil-linkedin"></i></a></li>
                <li><a href="#" class="text-gray-400 hover:text-white duration-500"><i class="uil uil-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</footer>
<!-- Footer End -->
