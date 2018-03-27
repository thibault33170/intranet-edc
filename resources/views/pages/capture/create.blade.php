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
            <form action="{{ route('captures.store') }}" method="POST">
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Ville" value="{{ old('city') }}">
                    <span class="help-block" style="color: red;">{{ $errors->first('city') }}</span>
                </div>

                <div class="form-group">
                    <label for="address">Adresse</label>
                    <textarea rows="3" class="form-control" id="address" name="address" placeholder="Adresse">
                        {{ old('address') }}
                    </textarea>
                    <span class="help-block" style="color: red;">{{ $errors->first('address') }}</span>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="{{ old('date') }}">
                    <span class="help-block" style="color: red;">{{ $errors->first('date') }}</span>
                </div>

                <button type="submit" class="btn btn-primary center-block">Valider</button>
            </form>
        </div>
    </div>
@endsection