<!DOCTYPE html>
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $title ?? '...' }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{asset('favicon-16x16.png')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href=" {{asset('assets/administracao/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/administracao/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/administracao/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/administracao/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/administracao/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/administracao/vendor/libs/apex-charts/apex-charts.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/administracao/vendor/libs/summernote/summernote-lite.min.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('assets/administracao/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/administracao/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include('administracao.includes.aside')

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

         @include('administracao.includes.nav')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')

                @if ($qtd_solicitacao_pendente >0)
                    <div class="m-4 toast-placement-ex bs-toast toast fade show bg-warning bottom-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                        <i class="bx bx-bell me-2"></i>
                        <div class="me-auto fw-semibold">Alerta !</div>
                        <small></small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                           <a href="{{route('servico.solicitacoes')}}"> Voce têm ({{$qtd_solicitacao_pendente}}) solicitações de serviço não atendida.</a>
                        </div>
                    </div>

                @endif
            </div>
            <!-- / Content -->

            <!-- Footer -->
            @include('administracao.includes.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>




          </div>

          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('assets/administracao/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/administracao/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/administracao/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/administracao/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('assets/administracao/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/administracao/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/administracao/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/administracao/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


    <script src="{{asset('assets/administracao/vendor/libs/summernote/summernote-lite.min.js')}}"></script>

    <script src="{{asset('assets/administracao/js/ui-toasts.js')}}"></script>



    <script>
        const toastPlacementExample = document.querySelector('.toast-placement-ex'),
         toastPlacement = new bootstrap.Toast(toastPlacementExample);
         toastPlacement.show();
    </script>

    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['help']],
            ],
        });
    </script>
  </body>
</html>
