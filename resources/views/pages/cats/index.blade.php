@extends('layouts.app')

@section('content')
    <cats :cats="{{ $cats }}"></cats>
@endsection