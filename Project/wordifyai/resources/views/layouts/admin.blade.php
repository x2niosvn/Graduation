<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin</title>

        <!-- FAVICON FOR WEBSITE -->
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />


        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- SweetAlert -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        {{-- Chartjs --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


        
        <!-- Bootstrap and DataTables -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>


        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    </head>


    <body>
        @include('layouts.navigationadmin')
        <div class="flex-grow-1">
        <div class="container mt-5 mb-5">
            {{ $slot }}
        </div>
        </div>


        <footer class="" style="position: absolute; width: 100%; ">
            <div class="bg-light container text-dark text-center p-3" >
                <p class="mb-0">&copy; 2024 <a href="" class="text-dark fw-bold">WordifyAI</a> - All rights reserved</p> 
            </div>
        </footer>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>
