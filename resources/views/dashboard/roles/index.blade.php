@extends('layout.dashboard.app')

@section('title')
    {{ __('words.Roles') }}
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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">{{__('words.Home')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index')  }}">{{ __('words.Roles') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.roles.create')  }}"> {{ __('words.Create Roles') }}
                                        </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="dropdown float-md-right">
                        <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
                            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a class="dropdown-item"
                                href="#"><i class="la la-calendar-check-o"></i> Calender</a>
                            <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
                            <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="la la-cog"></i>
                                Settings</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">

                <div class="card-header" style="display: flex ; justify-content: space-between;" >
                    <h4 class="card-title"> {{ __('words.Roles') }}</h4>
                    <a class="btn btn-danger  round btn-glow px-2" href="{{ route('dashboard.roles.create') }}">{{ __('words.Create Roles') }}</a>
                </div>

                <div class="card-content collapse show">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('words.Role') }}</th>
                                    <th>{{ __('words.permission') }}</th>
                                    <th>{{ __('words.created_at') }}</th>
                                    <th>{{ __('words.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <td>{{ $role->role }}</td>
                                                    <td>
                                                        @if (app()->getLocale() == 'ar')
                                                            @foreach ($role->permession as $permession)
                                                                @foreach (Config::get('Permissions_ar') as $key => $value)
                                                                    {{ $key == $permession ? $value . ' | ' : '' }}

                                                                @endforeach
                                                            @endforeach
                                                        @else
                                                            @foreach ($role->permession as $permession)
                                                                {{ $permession }}|
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>{{ $role->created_at->diffForHumans() }}</td>
                                                    <td>

                                                 <div class="dropdown float-md-right">
    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
        type="button"
        id="dropdownActions{{$role->id}}"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        {{ __('words.action') }}
    </button>

    <div class="dropdown-menu dropdown-menu-right"
        aria-labelledby="dropdownActions{{$role->id}}">

        <a class="dropdown-item"
           href="{{ route('dashboard.roles.edit', $role->id) }}">
            <i class="ft-edit-3 mr-1"></i> {{ __('words.edit') }}
        </a>

        <a class="dropdown-item text-danger modal-effect"
           data-effect="effect-scale"
           data-toggle="modal"
           href="#delete{{$role->id}}">
            <i class="ft-trash mr-1"></i> {{ __('words.delete') }}
        </a>

    </div>
</div>
                                    </div>

                                    </td>
                                    </tr>

                                @endforeach


                    </tbody>
                    </table>
                    {{ $roles->links() }}
                </div>

                @foreach ($roles as $role)
                    <div class="modal" id="delete{{$role->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete Role </h6><button aria-label="Close" class="close"
                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <p>Do You want Delete the Role </p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                            </div>
                            </form>

                        </div>
                    </div>

                @endforeach
            </div>

        </div>

    </div>
    </div>
@endsection