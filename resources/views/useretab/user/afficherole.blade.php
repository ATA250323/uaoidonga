@extends('layouts.appespace2')
@section('content')
 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
            <div class="col-md-12">
                <br><br>
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-0 pb-0">
                            <h3 class=" ">
                                {{ __('traduction.rol') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                            </h3>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <td>{{ __('traduction.action') }}</td>
                                    <td>{{ __('traduction.rol') }}</td>
                                    <td>{{ __('traduction.menus') }}</td>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            <a class="btn btn-sm btn-success"
                                            href="{{ route('menu-role-etablissements.edit', [$public_id, $role->public_id]) }}">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                        </td>
                                        <td class="fw-bold">{{ $role->name }}</td>

                                        <td style="max-width: 100%;">
                                            @foreach($menues as $menu)
                                                @php
                                                    $attribue = $menuRoleEtablissements->contains(function ($item) use ($menu, $role) {
                                                        return $item->menu_id == $menu->id && $item->role_id == $role->id;
                                                    });
                                                @endphp
                                                <span class="form-check">
                                                    @if($attribue)
                                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                        <span class="fw-bold text-success small">{{ $menu->nom_traduit }}</span>
                                                    @else
                                                        <i class="bi bi-circle text-secondary me-2"></i>
                                                        <span class="text-muted small">{{ $menu->nom_traduit }}</span>
                                                    @endif
                                                </span>
                                            @endforeach
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
    </div>
@endsection
