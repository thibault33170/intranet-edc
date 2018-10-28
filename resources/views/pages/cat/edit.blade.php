@extends('layouts.app')

@section('content')
    @if(session('status'))
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                <span style="color: forestgreen; font-size: 17px;"><b>{{ session('status') }}</b></span>
            </div>
        </div>
    @endif

    <div class="row" style="margin-top: 10px;">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
            <form action="{{ route('cats.update', $cat->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="color">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $cat->name}}"
                           placeholder="Nom">
                    <span class="help-block" style="color: red;">{{ $errors->first('name') }}</span>
                </div>

                <div class="form-group">
                    <label for="color">Couleur</label>
                    <input type="text" class="form-control" id="color" name="color" value="{{ $cat->color}}"
                           placeholder="Couleur">
                    <span class="help-block" style="color: red;">{{ $errors->first('color') }}</span>
                </div>

                <div class="form-group">
                    <select class="form-control" name="state" id="state">
                        @foreach([
                                \App\Cat::STATE_TO_RESERVE,
                                \App\Cat::STATE_TO_ADOPT,
                                \App\Cat::STATE_RESERVED,
                                \App\Cat::STATE_ADOPTED,
                            ] as $state
                        )
                            <option value="{{ $state }}" {{ $cat->state === $state ? 'selected' : '' }}>
                                {{ $state }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="dob">Date</label>
                    <input type="date" class="form-control" id="dob" name="dob"
                           value="{{ $cat->dob->format('Y-m-d') }}" placeholder="Date de naissance">
                    <span class="help-block" style="color: red;">{{ $errors->first('dob') }}</span>
                </div>

                <button type="submit" class="btn btn-primary center-block">Valider</button>
            </form>
        </div>
    </div>
@endsection