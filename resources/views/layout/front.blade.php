<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('common.front.header')
<body>
	@yield('content')
	@include('common.front.scripts')
	@stack('scripts')
</body>
</html>
