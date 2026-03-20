<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand">
                <img src="{{ asset('/assets/images/logo/democracy-asia-logo.webp') }}" alt="Full Logo"
                    class="logo logo-lg" style="max-height: 50px;">
                <img src="{{ asset('/assets/images/logo/democracy-asia-logo.webp') }}" alt="Small Logo"
                    class="logo logo-sm">
            </a>
        </div>

        <div class="navbar-content">
            <ul class="nxl-navbar">

                <li class="nxl-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-home"></i></span>
                        <span class="nxl-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-grid"></i></span>
                        <span class="nxl-mtext">Category</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item">
                            <a href="{{ route('category.create') }}" class="nxl-link">Add Category</a>
                        </li>
                        <li class="nxl-item">
                            <a href="{{ route('category.index') }}" class="nxl-link">Category List</a>
                        </li>
                    </ul>
                </li>

                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('tags.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-tag"></i></span>
                        <span class="nxl-mtext">Tags</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item">
                            <a href="{{ route('tags.create') }}" class="nxl-link">Add Tag</a>
                        </li>
                        <li class="nxl-item">
                            <a href="{{ route('tags.index') }}" class="nxl-link">Tag List</a>
                        </li>
                    </ul>
                </li>

                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('articles.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-file-text"></i></span>
                        <span class="nxl-mtext">Articles</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item">
                            <a href="{{ route('articles.create') }}" class="nxl-link">Add Article</a>
                        </li>
                        <li class="nxl-item">
                            <a href="{{ route('articles.index') }}" class="nxl-link">Article List</a>
                        </li>
                        <li class="nxl-item">
                            <a href="{{ route('articles.trashed') }}" class="nxl-link">Trashed Articles</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>