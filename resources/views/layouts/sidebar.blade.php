@php
use Illuminate\Support\Str;
@endphp
<aside class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width:280px; position: relative;">
    <a href="/admin" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img class="me-2" src="/images/logo.jpg" alt="Logo" height="55"> CMS
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item" style="height:40px;">
            <a href="/admin/dashboard" class="nav-link @if(request()->path() == " /admin/dashboard" ||
                Str::contains(request()->path(),'dashboard')) active @endif" aria-current="page">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="col-10">{{ __('admin.dashboard.title') }}</div>
                </div>
            </a>
        </li>
        <li class="nav-item" style="height:40px;">
            <a href="/admin/pages" class="nav-link @if(request()->path() == " /admin/pages" ||
                Str::contains(request()->path(),'pages')) active @endif" aria-current="page">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fa-solid fa-file"></i>
                    </div>
                    <div class="col-10">{{ __('admin.pages.index.title') }}</div>
                </div>
            </a>
        </li>

        <li class="nav-item" style="height:40px;">
            <a href="/admin/menus" class="nav-link @if (request()->path() == ' /admin/menus' ||
                Str::contains(request()->path(), 'admin/menus')) active @endif" aria-current="page">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="col-10">{{ __('admin.menus.index.title') }}</div>
                </div>
            </a>
        </li>

        <li class="nav-item" style="height:40px;">
            <a href="/admin/templates" class="nav-link @if(request()->path() == " /admin/templates" ||
                Str::contains(request()->path(),'templates')) active @endif" aria-current="page">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fa-regular fa-square"></i>
                    </div>
                    <div class="col-10">{{ __('admin.templates.index.title') }}</div>
                </div>
            </a>
        </li>
        <li class="nav-item" style="height:40px;">
            <a href="/admin/logos" class="nav-link @if(request()->path() == " /admin/logos" ||
                Str::contains(request()->path(),'logos')) active @endif" aria-current="page">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fa-solid fa-image"></i>
                    </div>
                    <div class="col-10">{{ __('admin.logos.index.title') }}</div>
                </div>
            </a>
        </li>
        <li class="nav-item" style="height:40px;">
            <a href="/admin/jobs" class="nav-link @if(request()->path() == " /admin/jobs" ||
                Str::contains(request()->path(),'jobs')) active @endif" aria-current="page">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="col-10">{{ __('admin.jobs.index.title') }}</div>
                </div>
            </a>
        </li>
        <li class="nav-item" style="height:40px;">
            <a href="/admin/cases" class="nav-link @if(request()->path() == " /admin/cases" ||
                Str::contains(request()->path(),'cases')) active @endif" aria-current="page">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fa-solid fa-diagram-project"></i>
                    </div>
                    <div class="col-10">{{ __('admin.cases.index.title') }}</div>
                </div>
            </a>
        </li>
        <li class="nav-item" style="height:40px;">
            <a href="/admin/blogs" class="nav-link @if(request()->path() == " /admin/blogs" ||
                Str::contains(request()->path(),'blogs')) active @endif" aria-current="page">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="col-10">{{ __('admin.blogs.index.title') }}</div>
                </div>
            </a>
        </li>
        <li class="nav-item" style="height:40px;">
            <a href="/admin/categories" class="nav-link @if(request()->path() == " /admin/categories" ||
                Str::contains(request()->path(),'categories')) active @endif" aria-current="page">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="col-10">{{ __('admin.categories.index.title') }}</div>
                </div>
            </a>
        </li>
        <li class="nav-item" style="height:40px;">
            <a href="/admin/clear-cache" class="nav-link" aria-current="books">
                <div class="row">
                    <div class="col-2 text-center">
                        <i class="fa-solid fa-trash"></i>
                    </div>
                    <div class="col-10">Clear cache</div>
                </div>
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        @php
            $name = "Not logged in";
            if(auth()->user() !== null){
                $name = auth()->user()->name;
            }
        @endphp
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{$name}}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="/logout">{{ __('auth.logout') }}</a></li>
        </ul>
    </div>
</aside>