@extends('layouts.appespace')

@section('content')
 <div class="pc-container">
      <div class="pc-content">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               
                                {{ __('traduction.modif') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                   
                            </span>

                             <div class="float-right">
                                <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  
                                {{ __('traduction.retr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                   
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                         <form action="{{ route('roles.update', $role->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            @include('role-permission.roles.formulaire')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
