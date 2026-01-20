@extends('layouts.appespace2')

@section('content')
<!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <div class="card card-default">
            <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">

                                {{ __('traduction.modif') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                            </span>

                             <div class="float-right">
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">

                                {{ __('traduction.retr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                                </a>
                              </div>
                        </div>
            </div>
            <div class="card-body bg-white">
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="grid grid-cols-12 gap-3 mb-3">
                            <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                <label class="form-label">   {{ __('traduction.nom') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                                <div class="input-group input-group-outline col-md-2 mb-3">
                                    <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                <label class="form-label">   {{ __('traduction.email') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                                <div class="input-group input-group-outline col-md-2 mb-3">
                                    <input type="text" class="form-control" readonly name="email" value="{{ $user->email ?? '' }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                <label class="form-label">   {{ __('traduction.rol') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                                <div class="input-group input-group-outline col-md-2 mb-3">
                                    <select name="role" class="form-select">
                                        <option value="">Selectioner</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ in_array($role->name, $userRoles) ? 'selected' : '' }}>
                                                {{ $role->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary mx-auto shadow-2xl">
                                    {{ __('traduction.enregistre') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                </button>
                            </div>
                </form>
            </div>
        </div>
        </div>
    </div>
     <!-- [ Main Content ] end -->
@endsection
