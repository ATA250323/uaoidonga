@php
    use Carbon\Carbon;

    $grouped = [
        'Aujourd\'hui' => [],
        'Hier' => [],
        'Semaine passée' => [],
        'Mois' => [],
        'Année' => [],
    ];
@endphp

<!doctype html>
<html lang="{{ app()->getLocale() }}" data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-pc-theme="light">
<head>
  <title>UAOIDONGA</title>
   <!-- [Meta] -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description"
    content=" {{ __('traduction.uaoidonga')  }}" />
  <meta name="keywords"
    content="{{ __('traduction.uaoidonga2')  }}" />
  <meta name="author" content="CodedThemes" />

  <!-- [Favicon] icon -->
  <link rel="icon" href="{{ asset('assetsapp/images/logos.png" type="image/x-icon') }}" />

  <!-- [Page specific CSS] start -->
  <link href="{{ asset('assetsapp/css/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- [Page specific CSS] end -->
  <!-- [Font] Family -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <!-- [phosphor Icons] https://phosphoricons.com/ -->
  <link rel="stylesheet" href="{{ asset('assetsapp/fonts/phosphor/duotone/style.css') }}" />
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="{{ asset('assetsapp/fonts/tabler-icons.min.css') }}" />
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="{{ asset('assetsapp/fonts/feather.css') }}" />
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="{{ asset('assetsapp/fonts/fontawesome.css') }}" />
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="{{ asset('assetsapp/fonts/material.css') }}" />
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="{{ asset('assetsapp/css/style.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


   <!-- SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>

    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
</head>

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg fixed inset-0 dark:bg-themedark-cardbg z-[1034]">
    <div class="loader-track h-[5px] w-full inline-block absolute overflow-hidden top-0">
      <div
        class="loader-fill w-[300px] h-[5px] bg-primary-500 absolute top-0 left-0 animate-[hitZak_0.6s_ease-in-out_infinite_alternate]">
      </div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
<!-- [ Sidebar Menu ] start -->
@include('layouts.partifixe.navapp')
<!-- [ Sidebar Menu ] end -->

  <!-- [ Header ] start -->
<header id="home" class="pc-header">
<div class="header-wrapper flex max-sm:px-[15px] px-[25px] grow"><!-- [Mobile Media Block] start -->
<div class="me-auto pc-mob-drp">
  <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
    <!-- ======= Menu collapse Icon ===== -->
    <li class="pc-h-item pc-sidebar-collapse max-lg:hidden lg:inline-flex">
      <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="sidebar-hide">
        <i data-feather="menu"></i>
      </a>
    </li>
    <li class="pc-h-item pc-sidebar-popup lg:hidden">
      <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="mobile-collapse">
        <i data-feather="menu"></i>
      </a>
    </li>
  </ul>
</div>

<div class="ms-auto">
  <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
    <div> @include('layouts.partifixe.lang') </div>
    <div> @include('layouts.partifixe.theme') </div>
    @role('Administrateur')
        <li class="dropdown pc-h-item">
        <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <i data-feather="bell"></i>
            <span class="badge bg-success-500 text-white rounded-full z-10 absolute right-0 top-0">{{ $totalMessages }}</span>
        </a>

            @foreach($infolignes as $item)
                @php
                    $created = Carbon::parse($item->created_at);
                    $now = Carbon::now();

                    $diffInDays = $created->diffInDays($now);
                    $diffForHumans = $created->diffForHumans();

                    // Groupe selon ancienneté
                    if ($created->isToday()) {
                        $grouped['Aujourd\'hui'][] = [$item, $diffForHumans];
                    } elseif ($created->isYesterday()) {
                        $grouped['Hier'][] = [$item, $diffForHumans];
                    } elseif ($diffInDays <= 7) {
                        $grouped['Semaine passée'][] = [$item, $diffForHumans];
                    } elseif ($diffInDays <= 31) {
                        $grouped['Mois'][] = [$item, $diffForHumans];
                    } else {
                        $grouped['Année'][] = [$item, $diffForHumans];
                    }
                @endphp
            @endforeach
        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown p-2">
            <div class="dropdown-header flex items-center justify-between py-4 px-5">
            <h5 class="m-0">
                    {{ __('traduction.notife') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
            </h5>
            <a href="#!" class="btn btn-link btn-sm">
                <a class="btn btn-primary btn-sm" href="{{ route('infolignes.index') }}">
                {{ __('traduction.affiche') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
            </a>
            </div>
            {{-- Affichage --}}
        @foreach ($grouped as $label => $items)
            @if (count($items) > 0)
            <div class="dropdown-body header-notification-scroll relative py-4 px-5"
            style="max-height: calc(100vh - 215px)">
            <p class="text-span mb-3">{{ $label }}</p>
            <ul>
            @foreach ($items as [$item, $diffForHumans])
                <li style="margin-bottom: 10px;">
            <div class="card mb-1">
                <div class="card-body">
                    <div class="flex gap-1">
                        <div class="grow">
                        <span class="float-end text-sm text-muted"><em>{{ $diffForHumans }}</em></span>
                        <h5 class="text-body mb-1">{{ $item->subjet }}</h5>
                        <p class="mb-0">{{ $item->message }}</p>
                        <span class="float-end text-sm text-muted">
                        <form action="{{ route('lire.messages_etabli',$item->id) }}" method="POST">
                        @csrf
                        @method('put')
                                <input id="lire" type="hidden" name="lire" value="1" >
                            <button type="submit" class="btn btn-success btn-sm">
                                {{ __('traduction.lire') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</button>
                        </form>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            </li>
            @endforeach
            </ul>
            <div class="text-center py-2">
            <a href="#!" class="text-danger-500 hover:text-danger-600 focus:text-danger-600 active:text-danger-600">
                Clear all Notifications
            </a>
            </div>
            </div>
            @endif
        @endforeach
        </div>
        </li>
    @endrole

    <li class="dropdown pc-h-item header-user-profile">
      <a class="pc-head-link dropdown-toggle arrow-none me-0" data-pc-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" data-pc-auto-close="outside" aria-expanded="false">
        <i data-feather="user"></i>
      </a>
      <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-2 overflow-hidden">
        <div class="dropdown-header flex items-center justify-between py-4 px-5 bg-primary-500">
          <div class="flex mb-1 items-center">
            <div class="shrink-0">
                <span class="icon-bg">
                    <img src="{{ optional(Auth::user()->profilsuer)->image
                                ? asset('storage/' . Auth::user()->profilsuer->image)
                                : asset('assetsapp/images/application/avatar-2.jpg') }}"
                       class=" rounded-full" width="55" height="55">
                </span>
            </div>
            <div class="grow ms-3">
              <h6 class="mb-1 text-white">{{ Auth::user()->name }} 🖖</h6>
              <span class="text-white">{{ Auth::user()->email}}</span>
            </div>
          </div>
        </div>
        <div class="dropdown-body py-4 px-5">
          <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
            <a href="{{ route('profils.index') }}" class="dropdown-item">
            <span>
              <i class="ti ti-user"></i>
                <span>{{ __('traduction.profile') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</span>
            </span>
            </a>
            <div class="grid my-3">
              <a class="btn btn-primary flex items-center justify-center" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <svg class="pc-icon me-2 w-[22px] h-[22px]">
                  <use xlink:href="#custom-logout-1-outline"></use>
                </svg>
                {{ __('traduction.logout') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
              </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
</div>
</div>
</header>
    @include('layouts.partifixe.alert')
    @yield('content')
  <!-- [ Header ] End -->


  <!-- [ Main Content ] end -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <!-- Required Js -->
  <script src="{{ asset('assetsapp/js/plugins/simplebar.min.js') }}"></script>
  <script src="{{ asset('assetsapp/js/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('assetsapp/js/icon/custom-icon.js') }}"></script>
  <script src="{{ asset('assetsapp/js/plugins/feather.min.js') }}"></script>
  <script src="{{ asset('assetsapp/js/component.js') }}"></script>
  <script src="{{ asset('assetsapp/js/theme.js') }}"></script>
  <script src="{{ asset('assetsapp/js/script.js') }}"></script>

   {{-- pour flatpicker --}}
  <script src="{{ asset('assetsapp/js/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assetsapp/js/ar.js') }}"></script>
  <script src="{{ asset('assetsapp/js/fr.js') }}"></script>
  <script src="{{ asset('assetsapp/plugins/hijri.js') }}"></script>
      <!-- Initialisation -->
    <script>
        // flatpickr(".datepicker", {
        //     dateFormat: "Y-m-d",
        //     locale: "fr" // ou "ar"
        // });

// Conversion chiffres latins → chiffres arabes
        function toArabicDigits(str) {
            return str.replace(/\d/g, d => "٠١٢٣٤٥٦٧٨٩"[d]);
        }

        flatpickr("#hijri-date", {
            locale: "ar",
            plugins: [new hijriPlugin()],
            dateFormat: "d/m/Y",
            onChange: function(selectedDates, dateStr, instance) {
                // Convertir et afficher en chiffres arabes
                instance.input.value = toArabicDigits(dateStr);
            }
        });
    </script>

  <!-- [Page Specific JS] start -->
  <script src="{{ asset('assetsapp/js/plugins/wow.min.js') }}"></script>
  <script>
    // Start [ Menu hide/show on scroll ]
    let ost = 0;
    document.addEventListener('scroll', function () {
      let cOst = document.documentElement.scrollTop;
      if (cOst == 0) {
        document.querySelector('.navbar').classList.add('!bg-transparent');
      } else if (cOst > ost) {
        document.querySelector('.navbar').classList.add('top-nav-collapse');
        document.querySelector('.navbar').classList.remove('default');
        document.querySelector('.navbar').classList.remove('!bg-transparent');
      } else {
        document.querySelector('.navbar').classList.add('default');
        document.querySelector('.navbar').classList.remove('top-nav-collapse');
        document.querySelector('.navbar').classList.remove('!bg-transparent');
      }
      ost = cOst;
    });
    // End [ Menu hide/show on scroll ]
    var wow = new WOW({
      animateClass: 'animate__animated'
    });
    wow.init();
  </script>
  <!-- [Page Specific JS] end -->
</body>

</html>
