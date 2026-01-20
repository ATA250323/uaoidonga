<!-- Navbar & Hero Start -->
<div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom border-2 border-white justify-content-between">
                <a href="{{ route('acceuils') }}" class="navbar-brand">
                    <h1>{{ __('traduction.uaoidonga')}}</h1>
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{ route('acceuils') }}" class="nav-item nav-link @if (Request::is('*acceuil')) active  @endif">{{ __('traduction.acc')}}</a>
                        <a href="{{ route('a_propos') }}" class="nav-item nav-link @if (Request::is('*a_propos')) active  @endif">{{ __('traduction.a_pro')}}</a>
                        <a href="{{ route('contacts') }}" class="nav-item nav-link @if (Request::is('*contact')) active  @endif">{{ __('traduction.cont')}}</a>
                        {{-- <a href="#" class="nav-item nav-link">{{ __('traduction.carriere')}}</a> --}}
                        {{-- <div class="nav-item dropdown">
                            <a href="#!" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('traduction.no')}} {{ __('traduction.organisation')}}</a>
                            <div class="dropdown-menu bg-light mt-2">
                                <a href="#" class="dropdown-item">1</a>
                                <a href="#" class="dropdown-item">2</a>
                                <a href="#" class="dropdown-item">3</a>
                                <a href="#" class="dropdown-item">4</a>
                            </div>
                        </div> --}}
                        @include('layouts.partifixe.navapp')
                        <div class="nav-item dropdown">
                            <a href="#!" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('traduction.lang')}}</a>
                            <div class="dropdown-menu bg-light mt-2">
                                <a href="{{ route('langue.choisir', 'ar') }}" class="dropdown-item">{{ __('traduction.ar')}}</a>
                                <a href="{{ route('langue.choisir', 'fr') }}" class="dropdown-item">{{ __('traduction.fr')}}</a>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="nav-item nav-link">{{ __('traduction.login')}}</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
<!-- Navbar & Hero End -->
