
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            {{-- Categories --}}
            @can('categories')
            <li class="nav-item">
                <a href="#">
                    <i class="la la-tags"></i>
                    <span class="menu-title">Categories</span>
                    <span class="badge badge-info badge-pill float-right mr-2">{{ $categories_count }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.categories.index') }}">
                            All Categories
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.categories.create') }}">
                            Add Category
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            {{-- Brands --}}
            @can('brands')
            <li class="nav-item">
                <a href="#">
                    <i class="la la-industry"></i>
                    <span class="menu-title">Brands</span>
                    <span class="badge badge-info badge-pill float-right mr-2">{{ $brands_count }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.brands.index') }}">
                            All Brands
                        </a>
                    </li>
                 
                </ul>
            </li>
            @endcan

            {{-- Coupons --}}
            @can('coupons')
            <li class="nav-item">
                <a href="#">
                    <i class="la la-ticket"></i>
                    <span class="menu-title">Coupons</span>
                    <span class="badge badge-info badge-pill float-right mr-2">{{ $coupons_count }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.coupons.index') }}">
                            All Coupons
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('attributes')
            <li class="nav-item">
                <a href="#">
                    <i class="la la-ticket"></i>
                    <span class="menu-title">Attributes</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.attributes.index') }}">
                           Attributes
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            {{-- FAQs --}}
            @can('faqs')
            <li class="nav-item">
                <a href="#">
                    <i class="la la-question-circle"></i>
                    <span class="menu-title">FAQs</span>
                    <span class="badge badge-info badge-pill float-right mr-2">{{ $Faqs_count }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.faqs.index') }}">
                            All FAQs
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            {{-- Settings --}}
            @can('settings')
            <li class="nav-item">
                <a href="#">
                    <i class="la la-cog"></i>
                    <span class="menu-title">Settings</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.settings.index') }}">
                            Website Settings
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            <li class="navigation-header">
                <span>Administration</span>
            </li>

            {{-- Roles --}}
            @can('roles')
            <li class="nav-item">
                <a href="#">
                    <i class="la la-shield"></i>
                    <span class="menu-title">Roles</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.roles.index') }}">
                            All Roles
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.roles.create') }}">
                            Add Role
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            {{-- Admins --}}
            @can('admins')
            <li class="nav-item">
                <a href="#">
                    <i class="la la-user-secret"></i>
                    <span class="menu-title">Admins</span>
                    <span class="badge badge-info badge-pill float-right mr-2">{{ $admins_count }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.admins.index') }}">
                            All Admins
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.admins.create') }}">
                            Add Admin
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            {{-- World --}}
            @can('World')
            <li class="nav-item">
                <a href="#">
                    <i class="la la-globe"></i>
                    <span class="menu-title">World</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.world.countries.index') }}">
                            Countries
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

        </ul>
    </div>
</div>