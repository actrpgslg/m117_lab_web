<!doctype html>
<html lang="en" class="nav-open">
 @include('partial.head')
<body>

<div class="wrapper">

 @include('partial.sidebar') 

    <div class="main-panel">
    	@include('partial.topbar') 
    <!--     @include('partial.navbar') -->
        @yield('content')
  <!--      @include('partial.foot') -->
    </div>
</div>
 @include('partial.script') 

</body>
</html>
