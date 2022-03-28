    <div class="container">
        <footer class="py-5">
            <div class="row">
                <div class="col-3">
                    <h5>Dôležité linky</h5>
                    <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('home') }}" class="nav-link p-0 text-muted">Domov</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('general.terms.and.conditions') }}" class="nav-link p-0 text-muted">Všeobecné obchodné podmienky</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('privacy') }}" class="nav-link p-0 text-muted">Ochrana osobných údajov</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('cookies') }}" class="nav-link p-0 text-muted">Cookies</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <p>
                        Ivana Nagyova<br>
                        Super desiata<br>
                        Sitnianska 671/1<br>
                        94901 Nitra<br>
                        IČO:52400042<br>
                        Č.účtu:<br> SK05 1100 0000 0029 4212 1091
                    </p>
                </div>

                <div class="col-md-3">
                    <p>
                        Obchodný register<br>
                        Okresný úrad Nitra<br>
                        Číslo živnostenského registra:<br> 430-55597
                    </p>
                </div>

                <div class="col-md-3">

                </div>

                {{-- <div class="col-4 offset-1">
                    <form>
                    <h5>Subscribe to our newsletter</h5>
                    <p>Monthly digest of whats new and exciting from us.</p>
                    <div class="d-flex w-100 gap-2">
                        <label for="newsletter1" class="visually-hidden">Email address</label>
                        <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                    </form>
                </div> --}}
            </div>

            <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>&copy; {{ date('Y') }} {{ env('APP_NAME')}}. Všetky práva vyhradené.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#"><i class="bi bi-facebook"></i></a></li>
                </ul>
            </div>
        </footer>
    </div>

    <div class="alert text-center cookiealert" role="alert">
        🍪 Pokračovaním v používaní stránky súhlasíte s používaním súborov cookie.
        <button type="button" class="btn btn-primary btn-sm acceptcookies">
            Súhlasim
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/cookie.js') }}"></script>
    @yield('scripts')

</body>
</html>
