@extends('layouts.app')

@section('content')
    <benevoles :benevoles="{{ $benevoles }}"></benevoles>
@endsection