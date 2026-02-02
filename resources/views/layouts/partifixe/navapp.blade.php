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
          <a href="{{ route('home') }}" class="pc-link" style="font-size: 18px">
            <i class="fa fa-fw fa-home text-success"></i>
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
            <a class="pc-link" href="{{ route('users.index') }}" style="font-size: 18px">
                <span class="pc-micon"> </span>
                <span class="pc-mtext">
                    {{ __('traduction.utili') }}
                </span>
            </a>
        </li>
        <li class="pc-item pc-hasmenu">
            <a class="pc-link" href="{{ route('roles.index') }}" style="font-size: 18px">
                <span class="pc-micon"> </span>
                <span class="pc-mtext">
                    {{ __('traduction.rol') }}
                </span>
            </a>
        </li>
        <li class="pc-item pc-hasmenu">
            <a class="pc-link" href="{{ route('permissions.index') }}" style="font-size: 18px">
                <span class="pc-micon"> </span>
                <span class="pc-mtext">
                    {{ __('traduction.permission') }}
                </span>
            </a>
        </li>
        @endrole
        @role('Super-Administrateur|Administrateur')
            {{-- <li class="pc-item pc-caption  " style="font-size: 18px">
                <label>⚙️ {{ __('traduction.para') }}</label>
                <i data-feather="feather"></i>
            </li> --}}
            <li class="pc-item pc-hasmenu ">
                <a class="pc-link" href="{{ route('anneescolaires.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.ansclair') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu ">
                <a class="pc-link" href="{{ route('carousels.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.photobienve') }}
                    </span>
                </a>
            </li>
            {{-- <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('apropos.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.apropos') }}
                    </span>
                </a>
            </li> --}}
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('dirigents.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.no_dirigents') }}
                    </span>
                </a>
            </li>
            {{-- <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('etabusers.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.utili') }}
                    </span>
                </a>
            </li> --}}
            {{-- <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('information.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.histoire') }}
                    </span>
                </a>
            </li> --}}
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('organisations.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.organisation') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('evennements.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.evennement') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('infolignes.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.suggestion') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('temoins.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.temoi') }}
                    </span>
                </a>
            </li>
        @endrole
        @role('Super-Administrateur|Secondaire')
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('centres.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.centre') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('etablissements.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.etablis') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('categories-examens.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.exam') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('centre-etablissement-examens.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.centrecompo') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('candidats.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.candidats') }}
                    </span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('resultats.index') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.resultats') }}
                    </span>
                </a>
            </li>

            <li class="pc-item pc-hasmenu">
                <a class="pc-link" href="{{ route('recherche.resultats') }}" style="font-size: 18px">
                    <span class="pc-micon"> </span>
                    <span class="pc-mtext">
                        {{ __('traduction.recherresulta') }}
                    </span>
                </a>
            </li>
        @endrole
      </ul>
    </div>
  </div>
</nav>
