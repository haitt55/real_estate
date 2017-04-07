@extends('layouts.master')

@section('content')
<header class="entry-header">
	<h1 class="entry-title">{{$position->title}}</h1>
</header>
{!!html_entity_decode($position->content)!!}

@endsection