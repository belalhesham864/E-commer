@extends('layout.dashboard.app')
@section('title')
    Setting
@endsection

@section('body')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Basic Forms</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('words.Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.roles.index') }}">{{ __('words.Roles') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.roles.create') }}">
                                        {{ __('words.Create Roles') }}
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                @include('dashboard.includes.buttonheader')
            </div>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="card-title mb-0">
                        <i class="ft-settings mr-1"></i>
                        Website Settings
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.settings.update', $setting->id) }}" method="POST"
                        enctype="multipart/form-data" class="settingForm">

                        @csrf
                        @method('PUT')

                        <div class="card mb-2 border">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="ft-home text-info"></i>
                                    General Information
                                </h5>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Site Name</label>
                                            <input readonly type="text" name="site_name" class="form-control"
                                                value="{{ old('site_name', $setting->site_name) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input readonly type="text" name="phone" class="form-control"
                                                value="{{ old('phone', $setting->phone) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Site Description</label>

                                            <textarea readonly name="site_desc" rows="4" class="form-control">{{ old('site_desc', $setting->site_desc) }}</textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <div class="card mb-2 border">

                            <div class="card-header bg-light">

                                <h5 class="mb-0">
                                    <i class="ft-mail text-success"></i>
                                    Contact Information
                                </h5>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input readonly type="email" name="email" class="form-control"
                                            value="{{ old('email', $setting->email) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Support Email</label>
                                        <input readonly type="email" name="email_support" class="form-control"
                                            value="{{ old('email_support', $setting->email_support) }}">
                                    </div>

                                    <div class="col-md-12 mt-1">
                                        <label>Address</label>

                                        <textarea readonly class="form-control" rows="3" name="address">{{ old('address', $setting->address) }}</textarea>
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="card mb-2 border">

                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="ft-share-2 text-info"></i>
                                    Social Media
                                </h5>
                            </div>

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input readonly class="form-control" name="facebook_url"
                                        value="{{ old('facebook_url', $setting->facebook_url) }}">
                                </div>

                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input readonly class="form-control" name="twitter_url"
                                        value="{{ old('twitter_url', $setting->twitter_url) }}">
                                </div>

                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input readonly class="form-control" name="youtube_url"
                                        value="{{ old('youtube_url', $setting->youtube_url) }}">
                                </div>

                                <div class="form-group">
                                    <label>Promotion Video URL</label>
                                    <input readonly class="form-control" name="promotion_video_url"
                                        value="{{ old('promotion_video_url', $setting->promotion_video_url) }}">
                                </div>

                            </div>

                        </div>


                        <div class="card border">

                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="ft-image text-warning"></i>
                                    Appearance
                                </h5>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <label>Logo</label>

                                        <input disabled type="file" class="form-control" name="logo" id="logoimage">



                                    </div>

                                    <div class="col-md-6">

                                        <label>Favicon</label>

                                        <input disabled type="file" class="form-control" name="favicon" id="faviconimage">



                                    </div>

                                    <div class="col-md-12 mt-2">

                                        <label>Meta Description</label>

                                        <textarea readonly rows="4" class="form-control" name="meta_desc">{{ old('meta_desc', $setting->meta_desc) }}</textarea>

                                    </div>

                                    <div class="col-md-12 mt-2">

                                        <label>Copyright</label>

                                        <input readonly class="form-control" name="site_copyright"
                                            value="{{ old('site_copyright', $setting->site_copyright) }}">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="text-right mt-3">

                            <button class="btn btn-warning " hidden id="cancel_btn">

                                <i class="la la-close"></i>

                                Cancel

                            </button>
                            <button class="btn btn-primary"  id="edit_btn">

                                <i class="la la-edit"></i>

                               Edit

                            </button>
                            <button class="btn btn-info" hidden id="save_btn">

                                <i class="ft-save"></i>

                                Save

                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#faviconimage').fileinput({
                theme: 'fa5',
                showCancel: true,

                maxFileCount: 1,
                showUpload: false,
                showRemove: true,
                enableResumableUpload: false,
                browseLabel: 'select image',
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ asset('uploads/settings/' . $setting->favicon) }}"
                ],
            });
        });
        $(function() {
            $('#logoimage').fileinput({
                theme: 'fa5',
                showCancel: true,

                maxFileCount: 1,
                showUpload: false,
                showRemove: true,
                enableResumableUpload: false,
                browseLabel: 'select image',
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ asset('uploads/settings/' . $setting->logo) }}"
                ],
            });
        });
    </script>
    <script>
     $(document).on('click','#edit_btn',function(e){
        e.preventDefault();
        $('#edit_btn').attr('hidden',true);
        $('#cancel_btn').removeAttr('hidden',true);
        $('#save_btn').removeAttr('hidden');
        $('.settingForm input').removeAttr('readonly');
        $('.settingForm textarea').removeAttr('readonly');
      $('.settingForm input[type="file"]').prop('disabled', false);
     });
     $(document).on('click','#cancel_btn',function(e){
        e.preventDefault();
        $('#edit_btn').removeAttr('hidden');
        $('#cancel_btn').attr('hidden',true);
        $('#save_btn').attr('hidden',true);
        $('.settingForm input').attr('readonly',true);
        $('.settingForm textarea').attr('readonly',true);
$('.settingForm input[type="file"]').prop('disabled', true);
     });
    </script>

@endpush
