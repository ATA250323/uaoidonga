@extends('layouts.appespace')

@section('content')
 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   Tableau de bord
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
