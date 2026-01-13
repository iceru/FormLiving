@section('flashdata')



@if ($message = Session::get('success'))
    <script>
        $(document).ready(function() {
        Toastify({
            text:   '{{ $message }}', // Add single quotes around the variable to make it a valid JavaScript string
            duration: 3000,
            gravity: "top",
            positionLeft: false,
            close: true,
            backgroundColor: "linear-gradient(to right, #8ACCA1, #458f60)",
            stopOnFocus: true
        }).showToast();
    });
    </script>
@endif
@if ($message = Session::get('error'))
    <script>
        $(document).ready(function() {
            Toastify({
                text:   '{{ $message }}', // Add single quotes around the variable to make it a valid JavaScript string
                duration: 3000,
                gravity: "top",
                positionLeft: false,
                close: true,
                backgroundColor: "linear-gradient(to right, #e04343, #ff6b6b)",
                stopOnFocus: true
            }).showToast();
        });
    </script>
@endif


@endsection
