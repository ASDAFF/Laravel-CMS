@extends('layout.front')

@section('content')
	@include('front.widgets.extra.ca-loader')
    @include('front.widgets.menu.ca')
    @include('front.widgets.header.ca')
    @include('front.widgets.features.ca2')
    @include('front.widgets.content.ca')
    @include('front.widgets.features.ca')
    @include('front.widgets.video.ca')
    @include('front.widgets.counting.ca')
    @include('front.widgets.products.ca')
    @include('front.widgets.pricing.ca')
    @include('front.widgets.feedback.ca')
    @include('front.widgets.subscribe.ca')
    @include('front.widgets.team.ca')
    @include('front.widgets.contact.ca')
    @include('front.widgets.footer.ca')
@endsection