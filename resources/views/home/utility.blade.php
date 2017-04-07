@extends('layouts.master')

@section('content')
<p style="text-align: center;"><strong>{{$utility->title}}</strong></p>
{!!html_entity_decode($utility->content)!!}

@endsection