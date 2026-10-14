<div>
@if($screen=='change-password')
    <div class="tab-pane fade active show" >
<div class="row align-items-center">
<div class="col-lg-6">
<div class="form-section">
<form action="#">
<div class="currentpass form-item">
<label for="currentpass" class="form-label">Current Password*</label>
<input type="password" wire:model="oldPassword" class="form-control" id="currentpass" placeholder="******">
@error('oldPassword')
<div class="text-danger">{{ $message }}</div>
@enderror
</div>
<div class="password form-item">
<label for="pass" class="form-label">Password*</label>
<input type="password" wire:model="password" class="form-control" id="pass" placeholder="******">
@error('password')
<div class="text-danger">{{ $message }}</div>
@enderror
</div>
<div class="re-password form-item">
<label for="repass" class="form-label">Re-enter Password*</label>
<input type="password" wire:model="password_confirmation" class="form-control" id="repass" placeholder="******">
</div>
</form>
<div class="form-btn">
<a href="javascript:void(0)" wire:click="updatePassword" class="shop-btn">Upldate Password</a>
<a href="javascript:void(0)" wire:click="resetform">Cancel</a>
</div>
</div>
</div>
<div class="col-lg-6">
<div class="reset-img text-end">
<img src="{{ asset('asset/website/assets/images/homepage-one/reset.webp') }}" alt="reset">
</div>
</div>
</div>
</div>
@endif
</div>
