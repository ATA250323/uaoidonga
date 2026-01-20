@extends('layouts.appespace2')

@section('content')

 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <div class="card-body">
            <div class="card sm:my-12  w-full shadow-none">
              <div class="card-body !p-10">
                <a href="{{ route('etabusers.index') }}" class="btn btn-info float-end">
                    {{ __('traduction.listmembr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                </a>
                <h4 class="text-center font-medium mb-4">
                    {{ __('traduction.modifie') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
               </h4>
        {{-- <form method="POST" action="{{ route('etabusers.store') }}">
                    @csrf --}}

            <form action="{{ route('etabusers.update', $user->id) }}" method="post">
                @csrf
                @method('put')
                    <div class="row">
                        <div class="grid grid-cols-12 gap-3 mb-3">
                            <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                <label for="name" class="form-label">
                                    {{ __('traduction.nomutilise') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                *</label>
                                    <div class="input-group input-group-outline my-0">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ $user->name ?? '' }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                </div>
                <div class="col-span-12 xl:col-span-4 md:col-span-4">
                        <label for="typecompte" class="form-label">
                                            {{ __('traduction.rol') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                            *</label>
                    <div class="input-group input-group-outline my-0">
                    <select name="typecompte" class="form-select @error('typecompte') is-invalid @enderror" typecompte="nomcomplet">
                        @foreach ($userRoles as $userRole)
                            <option value="{{ $userRole }}">
                                {{ $userRole }}
                            </option>
                        @endforeach
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    @error('typecompte')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>

                    <div class="col-span-12 xl:col-span-4 md:col-span-4">
                        <label for="email" class="form-label">
                            {{ __('traduction.email') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}*
                        </label>
                                    <div class="input-group input-group-outline my-0">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $user->email ?? '' }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                    </div>
            </div>
        </div>
                <div class="mt-4 text-center">
                  <button type="submit" class="btn btn-primary mx-auto shadow-2xl">
                                {{ __('traduction.enregistre') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                  </button>
                </div>
                {{-- </form> --}}
              </div>
            </div>
        </form>
        </div>
    </div>
    </div>
@endsection
