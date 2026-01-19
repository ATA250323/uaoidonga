@extends('layouts.appespace2')

@section('content')

 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <div class="card-body">
            <div class="card sm:my-12  w-full shadow-none">
              <div class="card-body !p-10">
                <a href="{{ route('etabusers.index', $public_id) }}" class="btn btn-info float-end">
                                {{ __('traduction.listmembr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                    </a>
                <h4 class="text-center font-medium mb-4">
                    {{ __('traduction.inscription') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                    </h4>
                <form method="POST" action="{{ route('etabusers.store', $public_id) }}">
                    @csrf
                {{-- <input id="id_usersuperetab" type="hidden" name="id_usersuperetab"
                                            value="{{ $iduser }}" > --}}
                    <div class="row">
                        <div class="grid grid-cols-12 gap-3 mb-3">
                            <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                <label for="nom" class="form-label">
                                    {{ __('traduction.nomutilise') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                *</label>
                                            <div class="input-group input-group-outline my-0">
                                                <input id="nom" type="text"
                                                    class="form-control @error('nom') is-invalid @enderror" name="nom"
                                                    value="{{ old('nom') }}"  autocomplete="nom" autofocus>
                                            </div>
                                                {!! $errors->first('nom', '<div class="invalid-feedback text-danger" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                <label for="typecompte" class="form-label">
                                    {{ __('traduction.rol') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                *</label>
                                    <div class="input-group input-group-outline my-0">
                                    <select name="typecompte" class="form-select @error('typecompte') is-invalid @enderror" autocomplete="typecompte">
                                            <option value="">{{ __('traduction.selectrole') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('typecompte', '<div class="invalid-feedback text-danger" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                <label for="email" class="form-label">
                                {{ __('traduction.email') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                *</label>
                                                <div class="input-group input-group-outline my-0">
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                                        value="{{ old('email') }}"  autocomplete="email">
                                                    </div>
                                                    {!! $errors->first('email', '<div class="invalid-feedback text-danger" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                        </div>
                    </div>
                {{-- <div class="mb-3">
                <label for="password" class="form-label">
                    {{ __('traduction.mdp') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                   *</label>
                                    <div class="input-group input-group-outline my-0">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                             autocomplete="new-password">
                                        </div>
                                        {!! $errors->first('password', '<div class="invalid-feedback text-danger" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="mb-3">
                 <label for="password-confirm" class="form-label ">
                    {{ __('traduction.mdp2') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                   *</label>
                                    <div class="input-group input-group-outline my-0">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation"  autocomplete="new-password">
                                        {!! $errors->first('password_confirmation', '<div class="invalid-feedback text-danger" role="alert"><strong>:message</strong></div>') !!}
                </div>
                </div> --}}
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
    </div>
 <!-- [ Main Content ] end -->
@endsection
