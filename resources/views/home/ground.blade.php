@extends('layouts.master')

@section('content')
<header class="entry-header">
							<h1 class="entry-title">{{$ground->title}}</h1>
						</header>
{!!html_entity_decode($ground->content)!!}

@endsection