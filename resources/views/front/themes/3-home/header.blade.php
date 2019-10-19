@php 
    $sliders = \App\Models\Slider::orderBy('id', 'asc')->get();
    if( isset($sliders[0]) ){
        $first_slider = \App\Models\Slider::orderBy('id', 'asc')->get()[0];
        $second_slider = \App\Models\Slider::orderBy('id', 'asc')->get()[1];
    }else{
        $first_slider = new \App\Models\Slider();
        $second_slider = new \App\Models\Slider();
    }
@endphp

<section class="hero-wrap js-fullheight" style="background-image: url({{ asset($first_slider->image) }});" data-section="home" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
      <div class="col-md-5 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
        <h1 class="mb-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
          {{ $second_slider->title }}
        </h1>
        <p class="mb-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
          {{ $second_slider->description }}
        </p>
        <form action="#" class="search-location">
        		<div class="row">
        			<div class="col-lg align-items-end">
        				<div class="form-group">
          				<div class="form-field">
		                <input type="text" class="form-control" placeholder="Search location">
		                <button><span class="ion-ios-search"></span></button>
		              </div>
	              </div>
        			</div>
        		</div>
        	</form>
      </div>
    </div>
  </div>
</section>