<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header flex items-center py-4 px-6 h-header-height">
        <div class="flex mb-1 items-center">
            <div class="shrink-0">
                <span class="icon-bg">
                    <img src="{{ optional(Auth::user()->profilsuer)->image
                                ? asset('storage/' . Auth::user()->profilsuer->image)
                                : asset('assets/images/application/avatar-2.jpg') }}"
                       class=" rounded-full" width="55" height="55">
                </span>
            </div>
            <div class="grow ms-3">
              <h6 class="mb-1 text-white">{{ Auth::user()->name }} 🖖</h6>
              <span class="text-white">{{  Str::limit(Auth::user()->email, 18)}}</span>
            </div>
        </div>
    </div>
    <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5" >
      <ul class="pc-navbar">
        <li class="pc-item">
          <a href="{{ route('home') }}" class="pc-link" style="font-size: 20px">
            <i class="bi bi-house-door text-success"></i>
            <span class="pc-mtext">
                    {{ __('traduction.tb') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

            </span>
          </a>
        </li>
    @role('Super-Administrateur')
        <li class="pc-item pc-caption">
          <label>⚙️ {{ __('traduction.para') }}</label>
          <i data-feather="feather"></i>
        </li>
        <li class="pc-item pc-hasmenu">
            <a class="pc-link" href="{{ route('users.index') }}">
                <span class="pc-micon"> </span>
                <span class="pc-mtext">
                    {{ __('traduction.utili') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                </span>
            </a>
        </li>
        <li class="pc-item pc-hasmenu">
            <a class="pc-link" href="{{ route('roles.index') }}">
                <span class="pc-micon"> </span>
                <span class="pc-mtext">
                    {{ __('traduction.rol') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                </span>
            </a>
        </li>
        <li class="pc-item pc-hasmenu">
            <a class="pc-link" href="{{ route('permissions.index') }}">
                <span class="pc-micon"> </span>
                <span class="pc-mtext">
                    {{ __('traduction.permission') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                </span>
            </a>
        </li>
        @endrole
      </ul>
    </div>
  </div>
</nav>
