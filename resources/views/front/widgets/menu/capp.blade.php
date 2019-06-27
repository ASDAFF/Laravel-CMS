<!-- ***** Header Area Start ***** -->
<header class="header_area animated header_area_custome">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Menu Area Start -->
            <div class="col-12 col-lg-10">
                <div class="menu_area">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <!-- Logo -->
                        <a class="navbar-brand" href="{{ route('front.page.index', '/') }}">
                            <img style="max-height: 50px;" src="{{ asset(config('0-general.logo')) }}" alt="logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ca-navbar" aria-controls="ca-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <!-- Menu Area -->
                        <div class="collapse navbar-collapse" id="ca-navbar">
                            <ul class="navbar-nav ml-auto" id="nav">
                                @foreach(\App\Models\Menu::get()->toTree() as $menu_item)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('front.page.index', $menu_item->url) }}">
                                        {{ $menu_item->title }}
                                    </a>
                                    @if($menu_item->children->count() > 0)
                                    <div class="submenu-items-container"> 
                                        @foreach($menu_item->children as $sub_menu)
                                        <a href="{{ route('front.page.index', $sub_menu->url) }}"> 
                                            {{ $sub_menu->title }}
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            <div class="sing-up-button d-lg-none">
                                <a href="{{ route('front.page.index') }}">Home Page</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Signup btn -->
            <div class="col-12 col-lg-2">
                <div class="sing-up-button d-none d-lg-block">
                    <a href="{{ route('front.page.index') }}">Home Page</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->