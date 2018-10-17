@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h1>{{ $benevole->name }}</h1>
                    <h5> {{ $benevole->email }} </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4><strong>Nom : </strong>{{ $benevole->name }}</h4>
                    <h4><strong>Email : </strong>{{ $benevole->email }}</h4>
                    <h4><strong>Adresse : </strong>{{ $benevole->address }}</h4>
                    <h4><strong>Date de naissance : </strong>{{ $benevole->dob->format('d-m-Y') }}</h4>
                    <h4><strong>Famille d'accueil : </strong>{{ $benevole->fa ? "Oui" : 'Non' }}</h4>
                    <h4><strong>Capture : </strong>{{ $benevole->capture ? "Oui" : 'Non' }}</h4>
                    <h4><strong>Nourrissage : </strong>{{ $benevole->feeding ? "Oui" : 'Non' }}</h4>
                    <h4><strong>Membre : </strong>{{ $benevole->member ? "Oui" : 'Non' }}</h4>

                </div>
            </div>
        </div>
    </div>

    @if ($benevole->can('edit benevole'))
        <div class="row">
            <a class="btn btn-primary text-center col-md-2 col-md-offset-5"
               href="{{ route('benevoles.edit', $benevole->id) }}">
                Modifier le Bénévole
            </a>
        </div>
    @endif

@endsection