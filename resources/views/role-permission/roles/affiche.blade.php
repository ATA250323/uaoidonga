@extends('layouts.appespace')
@section('content')
     <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
            <div class="col-md-12">
                <br><br>
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-0 pb-0">
                            <h3 class="text-white">Liste des Rôles
                                <a href="{{ route('roles.create') }}" class="btn btn-info float-end">
                                    Ajouter
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table align-items-center mb-0">
                            <thead>
                                 <tr>
                                    <th class="text-center font-weight-bolder">

                                {{ __('traduction.rol') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                                    </th>
                                    <th class="text-center font-weight-bolder">

                                {{ __('traduction.action') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="text-center">{{ $role->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('roles/' . $role->public_id . '/permisroles') }}"
                                                class="btn btn-info btn-sm  ms-1 ">Ajout Permission-Role</a>
                                            <a href="{{ route('roles.edit', $role->public_id) }}"
                                                class="btn btn-primary btn-sm  ms-1 ">Modifier
                                            </a>
                                            <a href="{{ url('roles/' . $role->id . '/destroy') }}"
                                                class="btn btn-danger btn-sm  ms-1 "
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce permission ?')">Supprimer
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
    </div>
 <!-- [ Main Content ] end -->
@endsection
