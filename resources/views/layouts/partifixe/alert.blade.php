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
            confirmButtonText: '{{ __('traduction.fermer') }}',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: '{{ __('traduction.fermer') }}',
            confirmButtonColor: '#d33'
        });
    </script>
@endif

@if(session('status'))
    <script>
        Swal.fire({
            text: '{{ session('status') }}',
            icon: 'success',
            confirmButtonText: '{{ __('traduction.fermer') }}',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif

@if(session('alertMessage'))
    <script>
        Swal.fire({
            text: '{{ session('alertMessage') }}',
            icon: 'warning',
            confirmButtonText: '{{ __('traduction.fermer') }}',
            confirmButtonColor: '#f0ad4e'
        });
    </script>
@endif

@if(session('confirm_update'))
<script>
Swal.fire({
    title: '{{ __('traduction.donneeexiste') }}',
    html: `<pre>{{ session('existing_message') }}</pre>`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '✅{{ __('traduction.oui') }}',
    cancelButtonText: '❌{{ __('traduction.non') }}',
}).then((result) => {

    if (result.isConfirmed) {

        const form = document.getElementById('importForm');

        // 🔹 Force update
        form.insertAdjacentHTML('beforeend',
            `<input type="hidden" name="force_update" value="1">`
        );

        // 🔹 Données stockées en session
        @php $data = session('import_data'); @endphp

        form.insertAdjacentHTML('beforeend', `
            <input type="hidden" name="annee" value="{{ $data['annee'] }}">
            <input type="hidden" name="examen" value="{{ $data['examen'] }}">
            <input type="hidden" name="centre" value="{{ $data['centre'] }}">
            <input type="hidden" name="sexe" value="{{ $data['sexe'] }}">
        `);

        form.submit();
    }
});
</script>
@endif

@if(session('confirm_candidat_update'))
<script>
Swal.fire({
    title: '{{ __('traduction.donneeexiste') }}',
    html: `<pre>{{ session('existing_message') }}</pre>`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '✅{{ __('traduction.oui') }}',
    cancelButtonText: '❌{{ __('traduction.non') }}',
}).then((result) => {

    if (result.isConfirmed) {

        const form = document.getElementById('importForm');

        // 🔹 Force update
        form.insertAdjacentHTML('beforeend',
            `<input type="hidden" name="force_update" value="1">`
        );

        // 🔹 Données stockées en session
        @php $data = session('import_data'); @endphp

        form.insertAdjacentHTML('beforeend', `
            <input type="hidden" name="anneescolaire_id" value="{{ $data['anneescolaire_id'] }}">
            <input type="hidden" name="categorie_examen_id" value="{{ $data['categorie_examen_id'] }}">
            <input type="hidden" name="etablissement_id" value="{{ $data['etablissement_id'] }}">
            <input type="hidden" name="sexe" value="{{ $data['sexe'] }}">
        `);

        form.submit();
    }
});
</script>
@endif

@if(session('import_errors'))
    <script>
        Swal.fire({
            title: '❌ {{ __("traduction.erordetect") }}',
            html: `
                <ul style="text-align:left;">
                    @foreach(session('import_errors') as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <p style="margin-top:10px;">
                    {{ __("traduction.corriger") }}
                </p>
            `,
            icon: 'error',
            confirmButtonText: '{{ __("traduction.fermer") }}',
            confirmButtonColor: '#d33'
        });
    </script>
@endif

@if(session('import_candidat_errors'))
    <script>
        Swal.fire({
            title: '❌ {{ __("traduction.erordetect") }}',
            html: `
                <ul style="text-align:left;">
                    @foreach(session('import_candidat_errors') as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <p style="margin-top:10px;">
                    {{ __("traduction.corriger") }}
                </p>
            `,
            icon: 'error',
            confirmButtonText: '{{ __("traduction.fermer") }}',
            confirmButtonColor: '#d33'
        });
    </script>
@endif

