@extends('layout.front')

@section('content')
	@foreach($blocks as $block)
		@includeIf('front.widgets.' . $block->widget_type . '.' . config('0-developer.theme'))
	@endforeach
@endsection