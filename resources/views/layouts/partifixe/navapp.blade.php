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
                    {{ __('traduction.tb') }}

            </span>
          </a>
        </li>
    @role('Super-Administrateur')
        {{-- <li class="pc-item pc-caption">
          <label>⚙️ {{ __('traduction.para') }}</label>
          <i data-feather="feather"></i>
        </li> --}}
        <li class="pc-item pc-hasmenu">
            <a class="pc-link" href="{{ route('users.index') }}">
                <span class="pc-micon"> </span>
                <span class="pc-mtext">
                    {{ __('traduction.utili') }}
                </span>
            </a>
        </li>
        <li class="pc-item pc-hasmenu">
            <a class="pc-link taille" href="{{ route('roles.index') }}">
                <span class="pc-micon"> </span>
                <span class="pc-mtext">
                    {{ __('traduction.rol') }}
                </span>
            </a>
        </li>
        <li class="pc-item pc-hasmenu">
            <a class="pc-link" href="{{ route('permissions.index') }}">
                <span class="pc-micon"> </span>
                <span class="pc-mtext">
                    {{ __('traduction.permission') }}
                </span>
            </a>
        </li>
        @endrole
        @role('Super-Administrateur|Administrateur')
            {{-- <li class="pc-item pc-caption  " style="font-size: 20px">
                <label>⚙️ {{ __('traduction.para') }}</label>
                <i data-feather="feather"></i>
            </li> --}}
            <li class="pc-item pc-hasmenu ">
                <a class="pc-link taille" href="{{ route('anneescolaires.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.ansclair') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu ">
                <a class="pc-link taille" href="{{ route('carousels.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.photobienve') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('apropos.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.apropos') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('dirigents.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.no_dirigents') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('etabusers.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.utili') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('information.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.histoire') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('organisations.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.organisation') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('evennements.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.evennement') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('infolignes.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.suggestion') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('temoins.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.temoi') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('centres.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.centre') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('etablissements.index') }}">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.etablis') }}
                    </span>
                </a>
            </li>
        @endrole
      </ul>
    </div>
  </div>
</nav>
