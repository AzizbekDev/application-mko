<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.home'));
});

// Dashboard > Search Application
Breadcrumbs::for('search', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Search Application', route('admin.application.search'));
});

// Dashboard > Reports
Breadcrumbs::for('reports', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Reports', route('admin.application.reports'));
});

// Dashboard > Restore Card
Breadcrumbs::for('card_restore', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Restore Card', route('admin.card-restore.index'));
});
// Dashboard > Restore Card > View
Breadcrumbs::for('card_restore_show', function (BreadcrumbTrail $trail, $card_restore) {
    $trail->parent('card_restore');
    $trail->push($card_restore->id, route('admin.card-restore.show', $card_restore));
});
// Dashboard > Restore Card > Edit
Breadcrumbs::for('card_restore_edit', function (BreadcrumbTrail $trail, $card_restore) {
    $trail->parent('card_restore');
    $trail->push($card_restore->id, route('admin.card-restore.edit', $card_restore));
});


////////////////////////////////// Permission //////////////////////////////////
// Dashboard > Permission
Breadcrumbs::for('permissions', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Permissions', route('admin.permissions.index'));
});

// Dashboard > Permission > Create
Breadcrumbs::for('permission_create', function (BreadcrumbTrail $trail) {
    $trail->parent('permissions');
    $trail->push('Create New Permission', route('admin.permissions.create'));
});

// Dashboard > Permission > View (permission name)
Breadcrumbs::for('permission_show', function (BreadcrumbTrail $trail, $permission) {
    $trail->parent('permissions');
    $trail->push(snake_to_camel_case($permission->title, true), route('admin.permissions.show', $permission));
});

// Dashboard > Permission > Edit (permission name)
Breadcrumbs::for('permission_edit', function (BreadcrumbTrail $trail, $permission) {
    $trail->parent('permissions');
    $trail->push(snake_to_camel_case($permission->title, true), route('admin.permissions.edit', $permission));
});

////////////////////////////////// Roles //////////////////////////////////
// Dashboard > Roles
Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Roles', route('admin.roles.index'));
});

// Dashboard > Roles > Create
Breadcrumbs::for('role_create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push('Create New Role', route('admin.roles.create'));
});

// Dashboard > Roles > View (role name)
Breadcrumbs::for('role_show', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles');
    $trail->push($role->title, route('admin.roles.show', $role));
});

// Dashboard > Roles > Edit (setting name)
Breadcrumbs::for('role_edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles');
    $trail->push($role->title, route('admin.roles.edit', $role));
});

////////////////////////////////// Users //////////////////////////////////
// Dashboard > Users
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Users', route('admin.users.index'));
});

// Dashboard > Users > Create
Breadcrumbs::for('user_create', function (BreadcrumbTrail $trail) {
    $trail->parent('users');
    $trail->push('Add New User', route('admin.users.create'));
});

// Dashboard > User > View (User Name)
Breadcrumbs::for('user_show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users');
    $trail->push($user->name, route('admin.users.show', $user));
});

// Dashboard > Users > Edit (User Name)
Breadcrumbs::for('user_edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users');
    $trail->push($user->name, route('admin.users.edit', $user));
});

////////////////////////////////// Applications //////////////////////////////////
// Dashboard > Applications
Breadcrumbs::for('applications', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Applications', route('admin.applications.index'));
});

// Dashboard > Applications > New
Breadcrumbs::for('application_new', function (BreadcrumbTrail $trail) {
    $trail->parent('applications');
    $trail->push('New', route('admin.applications','new'));
});

// Dashboard > Applications > Viewed
Breadcrumbs::for('application_viewed', function (BreadcrumbTrail $trail) {
    $trail->parent('applications');
    $trail->push('Viewed', route('admin.applications', 'viewed'));
});

// Dashboard > Applications > Approved
Breadcrumbs::for('application_approved', function (BreadcrumbTrail $trail) {
    $trail->parent('applications');
    $trail->push('Approved', route('admin.applications', 'approved'));
});

// Dashboard > Applications > Rejected
Breadcrumbs::for('application_rejected', function (BreadcrumbTrail $trail) {
    $trail->parent('applications');
    $trail->push('Rejected', route('admin.applications', 'rejected'));
});

// Dashboard > Applications > Blocked
Breadcrumbs::for('application_blocked', function (BreadcrumbTrail $trail) {
    $trail->parent('applications');
    $trail->push('Blocked', route('admin.applications', 'blocked'));
});

////////////////////////////////// Merchants //////////////////////////////////
// Dashboard > Merchants
Breadcrumbs::for('merchants', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Merchants', route('admin.partners.index'));
});

// Dashboard > Merchants > View (Merchant Name)
Breadcrumbs::for('merchants_show', function (BreadcrumbTrail $trail, $merchant) {
    $trail->parent('merchants');
    $trail->push($merchant->name, route('admin.merchants.show', $merchant));
});

////////////////////////////////// Merchant Periods //////////////////////////////////
// Dashboard > Merchants
Breadcrumbs::for('merchant-periods', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Merchant Periods', route('admin.merchant-periods.index'));
});

// Dashboard > Merchant Periods > View (Merchant Periods Name)
Breadcrumbs::for('merchant_periods_show', function (BreadcrumbTrail $trail, $merchantPeriod) {
    $trail->parent('merchant_periods');
    $trail->push($merchantPeriod->merchant_id, route('admin.merchant-periods.show', $merchantPeriod));
});

////////////////////////////////// Brands //////////////////////////////////
// Dashboard > Brands
Breadcrumbs::for('brands', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Brands', route('admin.brands.index'));
});

// Dashboard > Brands > View (brand name)
Breadcrumbs::for('brand_view', function (BreadcrumbTrail $trail, $brand) {
    $trail->parent('brands');
    $trail->push($brand->name, route('admin.brands.show', $brand));
});

////////////////////////////////// Settings //////////////////////////////////
// Dashboard > Settings
Breadcrumbs::for('settings', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Settings', route('admin.settings.index'));
});

// Dashboard > Settings > Create
Breadcrumbs::for('setting_create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Add New Setting', route('admin.settings.create'));
});

// Dashboard > Settings > View (setting name)
Breadcrumbs::for('setting_show', function (BreadcrumbTrail $trail, $setting) {
    $trail->parent('settings');
    $trail->push($setting->name, route('admin.settings.show', $setting));
});

// Dashboard > Settings > Edit (setting name)
Breadcrumbs::for('setting_edit', function (BreadcrumbTrail $trail, $setting) {
    $trail->parent('settings');
    $trail->push($setting->name, route('admin.settings.edit', $setting));
});