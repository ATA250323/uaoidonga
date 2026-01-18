@extends('layouts.appespace')

@section('content')
 <div class="pc-container">
      <div class="pc-content">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">

                                {{ __('traduction.rol') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                            </span>

                             <div class="float-right">
                                <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">

                                {{ __('traduction.retr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form action="{{ url('roles/' . $roles->id . '/dontpermirole') }}" method="post">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Permission</label>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                        {{ in_array($permission->id, $rloePermissions) ? 'checked' : '' }} />{{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 mt20 mt-2">
                <button type="submit" class="btn btn-primary">
                                        {{ __('traduction.enregistre') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                        </button>
                </div>
        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
