@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 40px; font-size: 25px;">
        <a href="{{ route('benevoles.index') }}" style="text-decoration: none; color: grey;">
            <div class="col-md-4">
                <div class="panel panel-default" style="height: 300px">
                    <div class="panel-body">
                        <div style="text-align: center;vertical-align: middle;line-height: 300px;"><b>Bénévoles</b></div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('captures.index') }}" style="text-decoration: none; color: grey;">
            <div class="col-md-4">
                <div class="panel panel-default" style="height: 300px">
                    <div class="panel-body">
                        <div style="text-align: center;vertical-align: middle;line-height: 300px;"><b>Captures</b></div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('cats.index') }}" style="text-decoration: none; color: grey;">
            <div class="col-md-4">
                <div class="panel panel-default" style="height: 300px">
                    <div class="panel-body">
                        <div style="text-align: center;vertical-align: middle;line-height: 300px;"><b>Chats</b></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
