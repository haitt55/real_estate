@extends('layouts.master')

@section('content')
<p style="text-align: center;"><strong>{{$position->title}}</strong></p>
{!!html_entity_decode($position->content)!!}

@endsection