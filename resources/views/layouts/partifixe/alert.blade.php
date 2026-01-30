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

@if(session('confirm_updates'))
    <script>
    Swal.fire({
        title: '⚠️ Données déjà existantes',
        text: 'Ces résultats existent déjà. Voulez-vous les modifier ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '✅ Oui, modifier',
        cancelButtonText: '❌ Non, annuler',
    }).then((result) => {

        if (result.isConfirmed) {

            const form = document.getElementById('importForm');

            // 🔹 force_update
            let force = document.createElement('input');
            force.type = 'hidden';
            force.name = 'force_update';
            force.value = '1';
            form.appendChild(force);

            // 🔹 examens
            let examens = document.querySelector('input[name="examens"]:checked');
            if (examens) {
                let ex = document.createElement('input');
                ex.type = 'hidden';
                ex.name = 'examens';
                ex.value = examens.value;
                form.appendChild(ex);
            }

            // 🔹 sexe
            let sexe = document.querySelector('input[name="sexe"]:checked');
            if (sexe) {
                let sx = document.createElement('input');
                sx.type = 'hidden';
                sx.name = 'sexe';
                sx.value = sexe.value;
                form.appendChild(sx);
            }

            form.submit();
        }
    });
    </script>
@endif

@if(session('confirm_update'))
<script>
Swal.fire({
    title: '⚠️ Données déjà existantes',
    html: `<pre>{{ session('existing_message') }}</pre>`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '✅ Oui, modifier',
    cancelButtonText: '❌ Non, annuler',
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
            <input type="hidden" name="examens" value="{{ $data['examens'] }}">
            <input type="hidden" name="centres" value="{{ $data['centres'] }}">
            <input type="hidden" name="sexe" value="{{ $data['sexe'] }}">
        `);

        form.submit();
    }
});
</script>
@endif


@if(session('confirm_updatess'))
<script>
Swal.fire({
    title: '⚠️ Données déjà existantes',
    html: `<pre>{{ session('existing_message') }}</pre>`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '✅ Oui, modifier',
    cancelButtonText: '❌ Non, annuler'
}).then((result) => {
    if(result.isConfirmed){
        let form = document.getElementById('importForm');

        // Ajouter force_update
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'force_update';
        input.value = '1';
        form.appendChild(input);

        // Ajouter tous les champs requis
        ['annee','centres','examens','sexe'].forEach(name => {
            let field = document.querySelector(`[name="${name}"]:checked`) || document.querySelector(`[name="${name}"]`);
            if(field) {
                let hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = name;
                hidden.value = field.value;
                form.appendChild(hidden);
            }
        });

        form.submit();
    }
});
</script>
@endif

@if(session('confirm_updated'))
<script>
Swal.fire({
    title: '{{ __('traduction.donneeexiste') }}',
    html: `<pre>{{ session('existing_message') }}</pre>`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '✅ {{ __('traduction.oui') }}',
    cancelButtonText: '❌ {{ __('traduction.no') }}'
}).then((result) => {
    if (result.isConfirmed) {
        let form = document.querySelector('form');

        // Ajouter force_update
        let force = document.createElement('input');
        force.type = 'hidden';
        force.name = 'force_update';
        force.value = '1';
        form.appendChild(force);

        // Ajouter tous les champs requis
        ['annee','centres','examens','sexe'].forEach(name => {
            let field = document.querySelector(`[name="${name}"]:checked`) || document.querySelector(`[name="${name}"]`);
            if(field) {
                let hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = name;
                hidden.value = field.value;
                form.appendChild(hidden);
            }
        });

        form.submit();
    }
});
</script>
@endif



@if(session('import_errors'))
    <script>
        Swal.fire({
            title: '❌ Erreurs détectées',
            html: `
                <ul style="text-align:left;">
                    @foreach(session('import_errors') as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <p style="margin-top:10px;">
                    👉 Veuillez corriger le fichier Excel puis réessayer.
                </p>
            `,
            icon: 'error',
            confirmButtonText: '{{ __("traduction.fermer") }}',
            confirmButtonColor: '#d33'
        });
    </script>
@endif

