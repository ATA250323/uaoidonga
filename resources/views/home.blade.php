@extends('layouts.appespace')
@php
    $lien = route('recherche.resultats');
    $textePartage = urlencode("Découvrez cet établissement : $lien");
@endphp
@section('content')
 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
