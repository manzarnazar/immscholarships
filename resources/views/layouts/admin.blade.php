<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">

    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com ">

    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 

    <link rel="canonical" href="https://demo-basic.adminkit.io/ " />

    <title>Dashboard - IMS</title>

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300 ;400;600&display=swap" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css " integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css " rel="stylesheet" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css ">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css ">

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css ">

    <!---Summernote--->
    <!-- Include Summernote CSS -->
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css " rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js "></script>






    @vite(['resources/sass/app.scss'])

    <style>
        .error {
            color: red;
        }
    </style>



</head>

<body>
    <div class="wrapper">

        @include('components.sidebar')

        <div class="main">

            @include('components.navbar')

            @yield('content')

            @include('sweetalert::alert')



            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-12 text-center">
                            <p class="mb-0">
                                <a class="text-muted" href="#" target="_blank"
                                    style="text-decoration: none"><strong>
                                        <span id="currentYear"></span> &copy; IMS Scholarship Application System
                                    </strong></a>
                            </p>

                        </div>

                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        const currentYear = new Date().getFullYear();
        document.getElementById('currentYear').textContent = currentYear;
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js "></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js "
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js "
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js "
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js "></script>

    <!-- DataTables Buttons JavaScript -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js "></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js "></script>

    <!-- Include Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js "></script>

    <script>
        // Initialize Summernote
        $(document).ready(function() {
            $('#description').summernote({
                toolbar: [
                    // You can customize the toolbar here
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],

                buttons: {
                    image: false,
                    link: false,
                    video: false
                }
            });

            $('#requirements').summernote({
                toolbar: [
                    // You can customize the toolbar here
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],

                buttons: {
                    image: false,
                    link: false,
                    video: false
                }
            });

            $('#timeline').summernote({
                toolbar: [
                    // You can customize the toolbar here
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],

                buttons: {
                    image: false,
                    link: false,
                    video: false
                }
            });

            $('#application_fee').summernote({
                toolbar: [
                    // You can customize the toolbar here
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],

                buttons: {
                    image: false,
                    link: false,
                    video: false
                }
            });

            $('#ims_fee').summernote({
                toolbar: [
                    // You can customize the toolbar here
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],

                buttons: {
                    image: false,
                    link: false,
                    video: false
                }
            });

            $('#scholarship').summernote({
                toolbar: [
                    // You can customize the toolbar here
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],

                buttons: {
                    image: false,
                    link: false,
                    video: false
                }
            });


        });
    </script>

    <script src="{{ asset('assets/js/app.js') }}"></script>



    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    @yield('scripts')

</body>

</html>