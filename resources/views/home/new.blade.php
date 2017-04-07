@extends('layouts.master')

@section('content')
<p style="text-align: center;"><strong>{{$news->title}}</strong></p>
{!!html_entity_decode($news->content)!!}

@endsection