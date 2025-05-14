<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{!empty($meta_title) ? $meta_title : '' }} - GPA</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('scripts/app.js')}}"></script>

    @stack('scripts')
    @yield('scripts')
</body>

</html>