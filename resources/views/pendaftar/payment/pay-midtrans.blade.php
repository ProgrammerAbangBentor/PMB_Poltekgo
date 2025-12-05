<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran</title>

    {{-- Load Snap --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: rgba(0, 0, 0, 0.6);
            height: 100vh;
        }
    </style>
</head>
<body>

<script>
    snap.pay("{{ $snapToken }}", {
        onSuccess: function() {
            window.location.href = "/pendaftar/payment";
        },
        onPending: function() {
            window.location.href = "/pendaftar/payment";
        },
        onError: function() {
            alert("Pembayaran gagal, silakan coba lagi.");
            window.location.href = "/pendaftar/payment";
        }
    });
</script>

</body>
</html>
