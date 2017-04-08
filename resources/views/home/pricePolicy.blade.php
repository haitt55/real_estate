@extends('layouts.master')

@section('content')
<header class="entry-header">
	<h1 class="entry-title">{{$pricePolicy->title}}</h1>
</header>
{!!html_entity_decode($pricePolicy->content)!!}
	<script type="text/javascript">
	jQuery(document).ready(function () {
	$(".sidebar").hide();
	});
</script>
@endsection