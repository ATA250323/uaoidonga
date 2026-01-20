@extends('layouts.appespace2')
@section('content')

 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
            <div class="col-md-12">
                <br><br>
                <div class="card my-4">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">

                                {{ __('traduction.utili') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                            </span>

                             <div class="float-right">
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">

                                {{ __('traduction.ajout') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('traduction.nom') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                    </th>
                                    <th>
                                        {{ __('traduction.email') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                    </th>
                                    <th>
                                        {{ __('traduction.rol') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                    </th>
                                    <th>
                                        {{ __('traduction.action') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                     </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-success">
                                            @if (!@empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                    <label class="badge bg-info">{{ $rolename }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit',  $user->id) }}"
                                                class="btn btn-primary btn-sm  ms-1 "><i class="fa fa-fw fa-edit"></i>
                                            </a>
                                            <a href="{{ url('users/' . $user->id . '/destroy') }}"
                                                class="btn btn-danger btn-sm  ms-1 "
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette personne ?')"><i class="fa fa-fw fa-trash"></i>
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
