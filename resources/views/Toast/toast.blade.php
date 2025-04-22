<link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" />

<?php if (session()->has('login-success')): ?>
<div class="col-md-4 col-12">
    <button id="title" class="btn btn-outline-primary btn-lg btn-block">
        {{ session('login-success') }}
    </button>
</div>
<?php endif; ?>

<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('assets/static/js/pages/sweetalert2.js') }}"></script>
