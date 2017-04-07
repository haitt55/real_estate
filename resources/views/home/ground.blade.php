@extends('layouts.master')

@section('content')
<p style="text-align: center;"><strong>{{$ground->title}}</strong></p>
{!!html_entity_decode($ground->content)!!}

@endsection