@extends('layout.dashboard.app')
@section('title')
Craeat Admin
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
                  <h4 class="card-title" id="basic-layout-colored-form-control">Create Admin</h4>
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
                    @include('dashboard.includes.valditionerror')
                    <form class="form" action="{{ route('dashboard.admins.store') }}" method="post">
                        @csrf
                      <div class="form-body">
                        <h4 class="form-section"><i class="fas fa-pen"></i> Create Admin</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1"> Name</label>
                              <input type="text" id="userinput1" class="form-control border-primary" placeholder="Name"
                              name="name">
                              @error('name')
                              <div class="'text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                        
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1"> Email</label>
                              <input type="text" id="userinput1" class="form-control border-primary" placeholder="Name"
                              name="email">
                               @error('email')
                              <div class="'text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                       
                          </div>
                             </div>
            
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1"> Password</label>
                              <input type="password" id="userinput1" class="form-control border-primary" placeholder="Name"
                              name="password">
                               @error('Password')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                        
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1"> Password Confirmation</label>
                              <input type="password" id="userinput1" class="form-control border-primary" placeholder="Name"
                              name="Password_confirmation">
                            </div>
                       
                          </div>
                             </div>
            
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Status</label>
                             <select class="form-control border-primary" name="status" id="">
                          <option value="" selected disabled>Select Status</option>

                                <option value="1">Active</option>
                                <option value="1">DisActive</option>
                             </select>
                              @error('status')
                              <div class="'text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                        
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Role</label>
                                  <select class="form-control border-primary" name="role_id" id="">
                                    <option value="" selected disabled>Select Role</option>
                              @foreach ($roles as $role )
                            <option value="{{ $role->id }}">{{ $role->role }}</option>

                              @endforeach
                             </select>
                              @error('role_id')
                              <div class="'text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                       
                          </div>
                             </div>
            
                  
            
  
                   
              
                      </div>
                      <div class="form-actions right">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i> Save
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
   </div>
   </div>
@endsection