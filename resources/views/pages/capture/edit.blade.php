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
            <form action="{{ route('captures.update', $capture->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $capture->city }}"
                           placeholder="Ville">
                    <span class="help-block" style="color: red;">{{ $errors->first('city') }}</span>
                </div>

                <div class="form-group">
                    <select class="form-control" name="user_id" id="user_id">
                        @foreach($benevoles as $benevole)
                            <option value="{{ $benevole->id }}" {{ $capture->referer->id === $benevole->id ? 'selected' : '' }}>
                                {{ $benevole->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="address">Adresse</label>
                    <textarea rows="3" class="form-control" id="address" name="address"
                              placeholder="Adresse">{{ $capture->address }}</textarea>
                    <span class="help-block" style="color: red;">{{ $errors->first('address') }}</span>
                </div>

                <div class="form-group">
                    <select class="form-control" name="state" id="state">
                        @foreach([
                                \App\Capture::STATE_TO_STUDY,
                                \App\Capture::STATE_IN_PROCESS,
                                \App\Capture::STATE_DONE
                            ] as $state
                        )
                            <option value="{{ $state }}" {{ $capture->state === $state ? 'selected' : '' }}>
                                {{ $state }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date"
                           value="{{ $capture->date->format('Y-m-d') }}" placeholder="Date">
                    <span class="help-block" style="color: red;">{{ $errors->first('date') }}</span>
                </div>

                <div class="form-group">
                    <label for="information">Informations</label>
                    <textarea rows="3" class="form-control" id="information" name="information"
                              placeholder="Informations">{{ $capture->information }}</textarea>
                    <span class="help-block" style="color: red;">{{ $errors->first('information') }}</span>
                </div>

                <button type="submit" class="btn btn-primary center-block">Valider</button>
            </form>
        </div>
    </div>

    <hr style="margin-top: 50px;">

    <div class="row" style="margin-top: 15px">
        @if(count($capture->users) > 1)
            <h3 class="text-center"> {{ count($capture->users) }} Participants</h3>
        @else
            <h3 class="text-center">{{ count($capture->users) }} Participant</h3>
        @endif

        @if ($capture->current_user_already_participate)
            <form action="{{ route('captures.detach') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="capture_id" value="{{ $capture->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <button type="submit" class="btn center-block" style="margin-bottom: 15px;">
                    Je ne participe plus
                </button>
            </form>
        @else
            <form action="{{ route('captures.attach') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="capture_id" value="{{ $capture->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <button type="submit" class="btn center-block" style="margin-bottom: 15px;">
                    Je participe
                </button>
            </form>
        @endif

        @foreach($capture->users as $user)
            <a style="text-decoration: none; color: grey" href="{{ route('benevoles.edit', $user->id) }}">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <h3>{{ $user->name }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection