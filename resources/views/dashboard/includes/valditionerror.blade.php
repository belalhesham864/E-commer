@if($errors->any())
    <div >
   <ul>
        @foreach ($errors->all() as $error)
      <li class="aletr alert-danger">{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif