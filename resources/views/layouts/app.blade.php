<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Datatables') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://datatables.yajrabox.com/js/bootstrap.min.js"></script>
    <script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
    <script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.25.6/sweetalert2.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.25.6/sweetalert2.css">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel Datatables') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: flex !important;;">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<!-- Scripts -->
<script>
jQuery(function($) {
    $('#students-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'students_data/get_data',
        columns: [{
                data: 'studname'
            },
            {
                data: 'dob'
            },
            {
                data: 'class'
            },
            {
                data: 'gender'
            },
            {
                data: 'status'
            },
            {
                data: 'district'
            },
            {
                data: 'state'
            },
            {
                data: 'donor'
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    function refresh() {
        var table = $('#students-table').DataTable();
        table.ajax.reload(null, false);
        console.log('refresh success');
    }

    function cleaner() {
        $('.id').val('');
        $('.studname').val('');
        $('.dob').val('');
        $('.class').val('');
        $('.gender').val('');
        $('.status').val('');
        $('.district').val('');
        $('.state').val('');
        $('.donor').val('');
        console.log('cleaner success');
    }

    function token() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

//Import
$(document).on('click', '.import', function (e) {
    e.preventDefault();

    $('#modalImport').modal('show');
    $('.modal-title').text('Import Data');
});

    //create
    $(document).on('click', '.create', function (e) {
        e.preventDefault();

        cleaner();
        $('#modalAdd').modal('show');
        $('.modal-title').text('Create Student');
    });

    //edit
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).attr('student_id');

        token();

        $.ajax({
            url: 'students/' + id + '/edit',
            method: 'GET',
            success: function (result) {

                if (result.success) {
                    let json = jQuery.parseJSON(result.data);

                    $('.id').val(json.id);
                    $('.studname').val(json.studname);
                    $('.dob').val(json.dob);
                    $('.class').val(json.class);
                    $('.gender').val(json.gender);
                    $('.status').val(json.status);
                    $('.district').val(json.district);
                    $('.state').val(json.state);
                    $('.donor').val(json.donor);

                    $('#modalEdit').modal('show');
                    $('.modal-title').text('Update Student');
                }

            }
        });


    });

    //store
    $(document).on('submit', '#modalAdd', function (e) {
        e.preventDefault();

        var formData = $("form#store").serializeArray();

        token();

        var data = {
            studname: formData[0].value,
            dob: formData[1].value,
            class: formData[2].value,
            gender: formData[3].value,
            status: formData[4].value,
            district: formData[5].value,
            state: formData[6].value,
            donor: formData[7].value
        };

        $.ajax({
            url: "students",
            method: 'POST',
            data: data,
            success: function (result) {
                if (result.success) {
                    refresh();
                    $('#modalAdd').modal('hide');
                    swal(
                        'Good job!',
                        'Successfull Saved!',
                        'success'
                    );
                }
            }
        });
    });

    //update
    $(document).on('submit', '#modalEdit', function (e) {
        e.preventDefault();

        var formData = $("form#update").serializeArray();

        token();

        var id = formData[0].value
        var data = {
            studname: formData[1].value,
            dob: formData[2].value,
            class: formData[3].value,
            gender: formData[4].value,
            status: formData[5].value,
            district: formData[6].value,
            state: formData[7].value,
            donor: formData[8].value
        };
        $.ajax({
            url: 'students/' + id,
            method: 'PUT',
            data: data,
            success: function (result) {
                if (result.success) {
                    refresh();
                    cleaner();
                    console.log('ajax call made');
                    $('#modalEdit').modal('hide');
                    swal(
                        'Updated!',
                        'Successfull Update!',
                        'success'
                    );
                    console.log('success update');
                }
                else{
                  console.log('failed');
                }
            }
        });
    });

    //delete data
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).attr('student_id');

        swal({
            title: 'Are you sure?',
            text: "you want to remove this record?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                token();

                $.ajax({
                    url: 'students/' + id,
                    method: 'DELETE',
                    success: function (result) {
                        if (result.success) {
                            refresh();
                            cleaner();
                            swal(
                                'Deleted!',
                                'Successfull Deleted!',
                                'success'
                            );
                        }
                    }
                });
            }
        });

    });
});
</script>
</html>
