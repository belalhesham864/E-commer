@if($category->icon)
<img src="{{asset($category->icon)}}" width="50px" height="50px">

@else
<img src="{{asset('asset/dashboard/images/logo/logo-dark-lg.png')}}" width="50px" height="50px">

@endif
