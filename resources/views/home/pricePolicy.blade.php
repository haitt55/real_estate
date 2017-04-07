@extends('layouts.master')

@section('content')
<p style="text-align: center;"><strong>{{$pricePolicy->title}}</strong></p>
{!!html_entity_decode($pricePolicy->content)!!}

@endsection