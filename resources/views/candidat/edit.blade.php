@extends('layouts.appespace2')

@section('template_title')
    {{ __('Update') }} Candidat
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <h1 class="mb-2 fw-bold text-primary">
                             {{ __('traduction.modifiecandida') }} <i class="bi bi-person-dash fs-3 me-2"></i>
                         </h1>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('candidats.update', $candidat->public_id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('candidat.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
