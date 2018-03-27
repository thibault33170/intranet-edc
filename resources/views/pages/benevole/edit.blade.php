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
            <form action="{{ route('benevoles.update', $benevole->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $benevole->name }}"
                           placeholder="Nom">
                    <span class="help-block" style="color: red;">{{ $errors->first('name') }}</span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $benevole->email }}"
                           placeholder="Email">
                    <span class="help-block" style="color: red;">{{ $errors->first('email') }}</span>
                </div>

                <div class="form-group">
                    <label for="address">Adresse</label>
                    <textarea rows="3" class="form-control" id="address" name="address"
                              placeholder="Adresse">{{ $benevole->address }}</textarea>
                    <span class="help-block" style="color: red;">{{ $errors->first('address') }}</span>
                </div>

                <div class="form-group">
                    <label for="date">Date de naissance</label>
                    <input type="date" class="form-control" id="dob" name="dob"
                           value="{{ $benevole->dob->format('Y-m-d') }}" placeholder="Date">
                    <span class="help-block" style="color: red;">{{ $errors->first('dob') }}</span>
                </div>

                <div class="form-group">
                    <label for="fa">Famille d'accueil</label>
                    <select class="form-control" name="fa" id="fa">
                        <option value="1" {{ $benevole->fa ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ $benevole->fa ? '' : 'selected' }}>Non</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="capture">Capture</label>
                    <select class="form-control" name="capture" id="capture">
                        <option value="1" {{ $benevole->capture? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ $benevole->capture ? '' : 'selected' }}>Non</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="feeding">Nourrissage</label>
                    <select class="form-control" name="feeding" id="feeding">
                        <option value="1" {{ $benevole->feeding ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ $benevole->feeding ? '' : 'selected' }}>Non</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="member">Membre</label>
                    <select class="form-control" name="member" id="member">
                        <option value="1" {{ $benevole->member ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ $benevole->member ? '' : 'selected' }}>Non</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary center-block">Valider</button>
            </form>
        </div>
    </div>
@endsection