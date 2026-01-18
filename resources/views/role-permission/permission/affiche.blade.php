@extends('layouts.appespace')
@section('content')
    <div class="pc-container">
      <div class="pc-content">
            <div class="col-md-12">
                <br><br>
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-0 pb-0">
                            <h3 class="text-white">
                                    {{ __('traduction.perùisssion') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                <a href="{{ route('permissions.create') }}" class="btn btn-info float-end">
                                    {{ __('traduction.ajout') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center font-weight-bolder">
                                        {{ __('traduction.permission') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                    </th>
                                    <th colspan="2" class="text-center font-weight-bolder">
                                        {{ __('traduction.action') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td class="text-center">{{ $permission->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('permissions.edit', $permission->public_id) }}"
                                                class="btn btn-primary btn-sm  ms-1 ">Modifier
                                            </a>
                                            <a href="{{ url('permissions/' . $permission->id . '/destroy') }}"
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
@endsection
