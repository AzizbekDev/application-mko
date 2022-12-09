@if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
    @can('profile_password_edit')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                <i class="fa-fw fas fa-key nav-icon">
                </i>
                <p>
                    {{ trans('global.change_password') }}
                </p>
            </a>
        </li>
    @endcan
@endif