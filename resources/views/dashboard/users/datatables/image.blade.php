@if($user->image)
   <img src="{{ asset('uploads/users/' . $user->image) }}"
         width="50"
         height="50"
         class="rounded-circle">

    @else
      <img src="{{ asset('asset/dashboard/images/users/user.jfif') }}"
         width="50"
         height="50"
         class="rounded-circle">

    @endif
