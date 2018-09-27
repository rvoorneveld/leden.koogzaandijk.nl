@extends('layouts.app')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Ledenportaal KZ/THERMO4U</h1>
            <p class="lead text-muted">Welkom op het KZ/THERMO4U ledenportaal. Hier kunt u zich aanmelden als nieuw lid bij de vereniging.</p>
            <p>
                <a href="/members/create" class="btn btn-primary my-2">Aanmelden als nieuw lid</a>
            </p>
        </div>
    </section>
@endsection
