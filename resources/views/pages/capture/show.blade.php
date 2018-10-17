@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h1>{{ $capture->city }}</h1>
                    <h5>{{ $capture->date->diffForHumans() }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4><strong>Reférrant : </strong>{{ $capture->referer->name }}</h4>
                    <h4><strong>Ville : </strong>{{ $capture->city }}</h4>
                    <h4><strong>Date : </strong>{{ $capture->date->format('d-m-Y') }}</h4>
                    <h4><strong>Adresse : </strong>{{ $capture->address }}</h4>
                    <h4><strong>Etat : </strong>{{ $capture->formated_state }}</h4>
                    <h4>
                        <strong>Informations :</strong>
                        <textarea class="form-control" style="margin-top: 10px;" disabled>
                            {{ $capture->information }}
                        </textarea>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->can('edit capture'))
        <div class="row">
            <a class="btn btn-primary text-center col-md-2 col-md-offset-5"
               href="{{ route('captures.edit', $capture->id) }}">
                Modifier la capture
            </a>
        </div>
    @endif
@endsection