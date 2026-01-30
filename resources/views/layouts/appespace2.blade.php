<!doctype html>
<html lang="{{ app()->getLocale() }}" data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-pc-theme="light">
<head>
  <title>UAOIDJOUGOU</title>
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

 <!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<!-- Tabler Icons -->
<link rel="stylesheet" href="{{ asset('assetsapp/fonts/tabler-icons.min.css') }}">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="{{ asset('assetsapp/css/style.css') }}" />
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="{{ asset('assetsapp/fonts/fontawesome.css') }}" />

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle (Popper + JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


   <!-- SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

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

  <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

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
