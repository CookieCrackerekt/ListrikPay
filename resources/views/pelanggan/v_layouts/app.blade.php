<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listrik Pay - Bayar Listrik ya disini</title>
    <link rel="stylesheet" href="{{ asset('frontend/novelria/css/styles.css') }}">
</head>
<body>
    @yield('content')
    <script src="{{ asset('frontend/novelria/javascript/script.js') }}"></script>
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
    @if (session('success'))
        <script> Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}"
            }); 
        </script>
    @endif
</body>

</html>