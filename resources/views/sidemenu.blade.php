@php
function is_active($route) {
    $link_name = collect(explode('.', Route::currentRouteName()))->first();
    return $link_name === $route;
}
@endphp

<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 mt-3">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
        <ul class="nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="{{ route('home') }}" @class([
                    'nav-link align-middle px-0',
                    'active' => is_active('home')
                ]) @if(is_active('home')) aria-current="page" @endif>
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('stories.index') }}" @class([
                    'nav-link align-middle px-0',
                    'active' => is_active('stories')
                ]) @if(is_active('stories')) aria-current="page" @endif>
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Stories</span>
                </a>
            </li>
            @if (auth()->user()->is_admin)
            <li class="nav-item">
                <a href="{{ route('users.index') }}" @class([
                    'nav-link align-middle px-0',
                    'active' => is_active('users')
                ]) @if(is_active('users')) aria-current="page" @endif>
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admins.index') }}" @class([
                    'nav-link align-middle px-0',
                    'active' => is_active('admins')
                ]) @if(is_active('admins')) aria-current="page" @endif>
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Admins</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('comments.index') }}" @class([
                    'nav-link align-middle px-0',
                    'active' => is_active('comments')
                ]) @if(is_active('comments')) aria-current="page" @endif>
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Comments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" @class([
                    'nav-link align-middle px-0',
                    'active' => is_active('profile')
                ]) @if(is_active('profile')) aria-current="page" @endif>
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</div>
