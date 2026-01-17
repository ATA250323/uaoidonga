@extends('layouts.appsite')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <p>Histoire sur nous</p>
    </section>
    <!-- /Hero Section -->

    <div id="calendar">
        <div id="month"></div>
        <div id="weekdays">
            <div>Dim</div>
            <div>Lun</div>
            <div>Mar</div>
            <div>Mer</div>
            <div>Jeu</div>
            <div>Ven</div>
            <div>Sam</div>
        </div>
        <div id="days"></div>
    </div>
    {{-- <script src="script.js"></script> --}}
@endsection
