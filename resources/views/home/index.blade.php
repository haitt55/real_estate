@extends('layouts.master')

@section('content')
<p style="text-align: center;"><strong>{{$project->page_title}}</strong></p>
{!!html_entity_decode($project->description)!!}
<input type = "hidden" id = "image_ads_val_01"value = "{{$project->project_image_ads}}"/>
<input type = "hidden" id = "image_ads_val_02"value = "{{$project->project_image_ads1}}"/>
<script type="text/javascript">
$(document).ready(function () {
	  //your code here
	$("#image_ads_01").attr("src", $("#image_ads_val_01").val());
	$("#image_ads_02").attr("src", $("#image_ads_val_02").val());
	});
    	
    
</script>
@endsection
