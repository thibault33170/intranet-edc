@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h1>{{ $cat->name }}</h1>
                    <h5>{{ $cat->dob->diffForHumans() }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4><strong>Couleur : </strong>{{ $cat->color }}</h4>
                    <h4><strong>Date de naissance : </strong>{{ $cat->dob->format('d-m-Y') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <a class="btn btn-primary text-center col-md-2 col-md-offset-5"
           href="{{ route('cats.edit', $cat->id) }}">
            Modifier le chat
        </a>
    </div>
@endsection