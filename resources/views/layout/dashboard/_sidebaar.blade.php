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
                <a href="{{ route('dashboard.brands.index') }}">
                    <i class="la la-building"></i>
                    <span class="menu-title">Brands</span>
                    <span class="badge badge-info badge-pill float-right mr-2">{{ $brands_count }}</span>
                </a>
            </li>
            @endcan


            {{-- Products --}}
            <li class="nav-item">
                <a href="#">
                    <i class="la la-shopping-bag"></i>
                    <span class="menu-title">Products</span>
                </a>

                <ul class="menu-content">

                    @can('products')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.products.create') }}">
                            <i class="la la-plus"></i>
                            Products
                        </a>
                    </li>
                    @endcan

                    @can('attributes')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.attributes.index') }}">
                            <i class="la la-list"></i>
                            Attributes
                        </a>
                    </li>
                    @endcan

                </ul>
            </li>


            {{-- Coupons --}}
            @can('coupons')
            <li class="nav-item">
                <a href="{{ route('dashboard.coupons.index') }}">
                    <i class="la la-ticket"></i>
                    <span class="menu-title">Coupons</span>
                    <span class="badge badge-info badge-pill float-right mr-2">{{ $coupons_count }}</span>
                </a>
            </li>
            @endcan


            {{-- Contacts --}}
            @can('contact')
            <li class="nav-item">
                <a href="{{ route('dashboard.contacts.index') }}">
                    <i class="la la-envelope"></i>
                    <span class="menu-title">Contacts</span>
                    <span class="badge badge-info badge-pill float-right mr-2">{{ $contacts_count }}</span>
                </a>
            </li>
            @endcan


            {{-- FAQs --}}

               <li class="nav-item">
                <a href="#">
                    <i class="la la-question-circle"></i>
                    <span class="menu-title">FAQS</span>
                </a>

                <ul class="menu-content">

                    @can('faqs')
                    <li>
                        <a class="menu-item" href="{{  route('dashboard.faqs.index') }}">
                            <i class="la la-question-circle"></i>
                            FAQS
                        </a>
                    </li>



                    <li>
                        <a class="menu-item" href="{{ route('dashboard.faqs.question') }}">
                            <i class="la la-list"></i>
                            FAQS Question
                        </a>
                    </li>
                    @endcan

                </ul>
            </li>


            {{-- Settings --}}



        <li class="nav-item">
                <a href="#">
                    <i class="la la-cog"></i>
                    <span class="menu-title">settings</span>
                </a>

                <ul class="menu-content">

                    @can('settings')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.settings.index') }}">
                            <i class="la la-cog"></i>
                            Settings
                        </a>
                    </li>

                    @endcan
                    @can('sliders')

                    <li>
                        <a class="menu-item" href="{{ route('dashboard.sliders.index') }}">
                            <i class="la la-list"></i>
                            Sliders
                        </a>
                    </li>
                    @endcan

                </ul>
            </li>


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
                <a href="{{ route('dashboard.world.countries.index') }}">
                    <i class="la la-globe"></i>
                    <span class="menu-title">Countries</span>
                </a>
            </li>
            @endcan

        </ul>
    </div>
</div>

