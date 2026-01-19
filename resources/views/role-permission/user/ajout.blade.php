@extends('layouts.appespace2')

@section('content')
<!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
            <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">

                                {{ __('traduction.utili') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                            </span>

                             <div class="float-right">
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">

                                {{ __('traduction.retr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                                </a>
                              </div>
                        </div>
            </div>
            <div class="card-body bg-white">
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <label class="form-label"> {{ __('traduction.nom') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                <div class="input-group input-group-outline col-md-2 mb-3">
                    <input type="text" class="form-control" name="name" value="" required>
                </div>
                <label class="form-label">{{ __('traduction.email') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                <div class="input-group input-group-outline col-md-2 mb-3">
                    <input type="text" class="form-control" name="email" value="" required>
                </div>
                <label class="form-label">{{ __('traduction.mdp') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                <div class="input-group input-group-outline col-md-2 mb-3">
                    <input type="password" class="form-control" name="password" value="" required>
                </div>
                <label class="form-label">{{ __('traduction.mdp2') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                <div class="input-group input-group-outline col-md-2 mb-3">
                    <input type="password" class="form-control" name="password_confirmation" value="" required>
                </div>
                <label class="form-label">{{ __('traduction.rol') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                <div class="input-group input-group-outline col-md-2 mb-3">
                    <select name="roles[]" class="form-select" multiple>
                        <option value="">Selectioner</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
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
