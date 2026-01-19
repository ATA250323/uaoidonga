 <style>
            @keyframes clignoter {
                0%   { color: red; opacity: 1; }
                50%  { color: red; opacity: 0.5; }
                100% { color: red; opacity: 1; }
            }

            .clignote {
                animation: clignoter 1s infinite;
                font-weight: bold;
            }
</style>

@if(session('success'))
    <script>
        Swal.fire({
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: '{{ __('traduction.fermer') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: '{{ __('traduction.fermer') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}',
            confirmButtonColor: '#d33'
        });
    </script>
@endif

@if(session('alertMessage'))
    <script>
        Swal.fire({
            text: '{{ session('alertMessage') }}',
            icon: 'warning',
            confirmButtonText: '{{ __('traduction.fermer') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}',
            confirmButtonColor: '#f0ad4e'
        });
    </script>
@endif


{{-- @if (session()->has('success'))
    <script>
    alert('Succès !⚠️ {{ session('success') }} ');
    </script>
@endif
@if (session()->has('alertMessage'))
    <script>
    alert('Attention !⚠️ {{ session('alertMessage') }} ');
    </script>
@endif
@if (session()->has('error'))
    <script>
    alert('Erreur !⚠️ {{ session('error') }} ');
    </script>
@endif --}}
