@extends('layouts.master')

@section('content')
<header class="entry-header">
	<h1 class="entry-title">{{$utility->title}}</h1>
</header>
{!!html_entity_decode($utility->content)!!}
<script type="text/javascript">
	jQuery(document).ready(function () {
	$(".sidebar").hide();
	});
</script>
@endsection