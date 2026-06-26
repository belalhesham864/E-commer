@extends('layout.dashboard.app')
@section('title')
Show Admin
@endsection
@section('body')
<div class="app-content content">
        <div class="content-wrapper">
<div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
       <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">{{__('words.Home')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index')  }}">Admins</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.admins.create')  }}"> Create Admin
                                        </a>
                                </li>
                            </ol>
            </div>
          </div>
        </div>
         @include('dashboard.includes.buttonheader')

      </div>
        <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="basic-layout-colored-form-control">Show Admin</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                   
             <div class="form-body">
    <h4 class="form-section">
        <i class="fas fa-eye"></i> Show Admin
    </h4>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Name</label>
                <input type="text"
                       class="form-control border-primary"
                       value="{{ $admin->name }}"
                       readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Email</label>
                <input type="text"
                       class="form-control border-primary"
                       value="{{ $admin->email }}"
                       readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control border-primary" disabled>
                    <option @selected($admin->status == 1)>
                        Active
                    </option>
                    <option @selected($admin->status == 0)>
                        DisActive
                    </option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Role</label>
                <input type="text"
                       class="form-control border-primary"
                       value="{{ $admin->role->role }}"
                       readonly>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('dashboard.admins.index') }}"
           class="btn btn-warning">
            <i class="ft-arrow-left"></i> Back
        </a>
    </div>
</div>
                </div>
              </div>
            </div>
   </div>
   </div>
   </div>
@endsection