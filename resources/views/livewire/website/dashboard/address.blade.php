<div>
    @if($screen=='address')

<div class="tab-pane fade active show" >
<div class="profile-section address-section addresses ">
<div class="row gy-md-0 g-5">
<div class="col-md-12">
<div class="seller-info">
<h5 class="heading">Address</h5>
<div class="info-list">
<div class="info-title">
<p>Name:</p>
<p>Email:</p>
<p>Phone:</p>
<p>Country:</p>
<p>Governrate:</p>
<p>City:</p>
</div>
<div class="info-details">
<p>{{ $user->name }}</p>
<p>{{ $user->email }}</p>
<p>{{ $user->phone }}</p>
<p>{{ $user->country->name }}</p>
<p>{{ $user->governrate->name }}</p>
<p>{{ $user->city->name }}</p>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
@endif
</div>
