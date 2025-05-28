<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{!empty($meta_title) ? $meta_title : '' }} - GPA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
     <link rel="stylesheet" href="{{asset('styles/forms.css')}}">
    @stack('styles')
     @yield('styles')
</head>

<body>
    <!-- Header fixe -->
    @include('backend.layouts._header')

    <!-- Sidebar -->
   @include('backend.layouts._sidebar')
    

 

    <!-- Contenu principal -->
    <main class="main-content">

         @yield('content')
         
    </main>
    
     <!-- footer -->
    @include('backend.layouts._footer')

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
      <!-- Intégration du bundle Bootstrap JS (inclut Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('scripts/app.js')}}"></script>

    {{-- pour telecharger le chartjs en pdf --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    @stack('scripts')
    @yield('scripts')
</body>

</html>