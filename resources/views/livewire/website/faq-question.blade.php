<div class="question-section login-section ">
      <div class="review-form">
<form wire:submit.prevent="submit">
<h5 class="comment-title">Have Any Question</h5>
<div class=" account-inner-form">
<div class="review-form-name">
<label for="fname" class="form-label">Name*</label>
<input type="text" value="{{ old('name') }}" id="fname" wire:model.live="name" class="form-control" placeholder="Name">
@error('name')
<div class="text-danger">{{ $message }}</div>

@enderror
</div>
<div class="review-form-name">
<label for="email" class="form-label">Email*</label>
<input type="email" value="{{ old('email') }}" wire:model.live="email" id="email" class="form-control" placeholder="user@gmail.com">
@error('email')
<div class="text-danger">{{ $message }}</div>

@enderror
</div>
<div class="review-form-name">
<label for="subject" class="form-label">Subject*</label>
<input type="text" value="{{ old('subject') }}" wire:model.live="subject" id="subject" class="form-control" placeholder="Subject">
@error('subject')
<div class="text-danger">{{ $message }}</div>

@enderror
</div>
</div>
<div class="review-textarea">
<label for="floatingTextarea">Massage*</label>
<textarea class="form-control" placeholder="Write Massage..........." wire:model.live="message" id="floatingTextarea" rows="3">{{ old('message') }}</textarea>
@error('message')
<div class="text-danger">{{ $message }}</div>

@enderror
</div>
<div class="login-btn">
    <button type="submit" class="shop-btn">Submit</button>
</div>
</form>
</div>
</div>
