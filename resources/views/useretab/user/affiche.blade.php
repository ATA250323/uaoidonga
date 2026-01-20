@extends('layouts.appespace2')
@section('content')
 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
            <div class="col-md-12">
                {{-- @if (@session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif --}}

                <br><br>
                {{-- @if($etabusersexiste) --}}
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-0 pb-0">
                            <h3 class=" ">
                                {{ __('traduction.lesmembr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                                <a href="{{ route('etabusers.create') }}" class="btn btn-info float-end">
                                    <i class="fa fa-fw fa-plus"></i>
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                           <table class="table table-striped mt-4">
                                <thead>
                                    <tr>
                                        <th>{{ __('traduction.nom') }}</th>
                                        <th>{{ __('traduction.email') }}</th>
                                        <th>{{ __('traduction.rol') }}</th>
                                        <th>{{ __('traduction.etabli') }}</th>
                                        <th>{{ __('traduction.statut') }}</th>
                                        <th>{{ __('traduction.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    @php
                                        $associe = in_array($user->id, $etablissementAssocies);
                                    @endphp
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                <span style="color: rgb(251, 218, 5)">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @forelse ($user->etablissements as $etablissement)
                                                <span class="badge bg-success">
                                                   {{ app()->getLocale() == 'ar' ? $etablissement->nomarabe : $etablissement->nomfrancais }}
                                                </span>
                                            @empty
                                                <span class="text-danger">{{ __('traduction.aucunetabli') }}</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            <form action="{{ route('etablissements.association') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                {{-- <input type="hidden" name="etablissement_id" value="{{ $etablissement->id }}"> --}}
                                                {{-- @if($associe) --}}
                                                    @forelse ($user->etablissements as $etablissement)
                                                        <input type="hidden" name="etablissement_id" value="{{ $etablissement->id }}">
                                                    @empty
                                                        <span><select style="width: 85px;" name="etablissement_id" class="form-select form-select-sm @error('etablissement_id') is-invalid @enderror">
                                                            <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                                                            @foreach ($etablissements as $etablissement)
                                                                <option value="{{ $etablissement->id }}">
                                                                    {{ app()->getLocale() == 'ar' ? $etablissement->nomarabe : $etablissement->nomfrancais }}
                                                                </option>
                                                            @endforeach
                                                        </select></span>
                                                    @endforelse
                                                {{-- @else
                                                    <span class="text-danger">Non associé</span>
                                                @endif --}}
                                                @if($associe)
                                                    @if($user->id == Auth::user()->id)
                                                        <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                            {{ __('traduction.vousmem') }}
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            {{ __('traduction.deassocier') }}
                                                        </button>
                                                    @endif
                                                @else
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        {{ __('traduction.associer') }}
                                                    </button>
                                                @endif
                                            </form>

                                        </td>
                                        <td>
                                            <form action="{{ route('etabusers.destroy', $user->public_id) }}" method="POST">
                                            <a href="{{ route('etabusers.edit', $user->public_id) }}"
                                                class="btn btn-primary btn-sm  ms-1 "><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Êtes-vous sûr de vouloir supprimer cette personne?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">{{ __('traduction.Aucunuser') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                </div>
                </div>
                {{-- @else
                    <div class="">
                    <a href="{{ route('etabusers.create') }}" class="btn btn-primary btn-sm">
                                {{ __('traduction.ajoumembre') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                    </a>
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
 <!-- [ Main Content ] end -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    $('.toggle-assoc').click(function(){
        const btn = $(this);
        const user_id = btn.data('user');
        const etablissement_id = btn.data('etab');

        // Optionnel : désactiver le bouton pendant la requête
        btn.prop('disabled', true);

        $.ajax({
            url: '{{ route("etablissements.association") }}', // ton nom de route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id,
                etablissement_id
            },
            success: function(response){
                // Si l'action est autorisée
                alert(response.message);

                // Rechargement après un petit délai
                setTimeout(() => location.reload(), 800);
            },
            error: function(xhr){
                // Si Laravel renvoie une erreur 403 (interdiction)
                if (xhr.status === 403 && xhr.responseJSON?.message) {
                    alert(xhr.responseJSON.message);
                } else {
                    alert('Une erreur est survenue.');
                }
            },
            complete: function(){
                btn.prop('disabled', false);
            }
        });
    });
});
</script>

@endsection
