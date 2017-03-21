<?php

/**
 * Authentication
 */

Route::get('private/login', 'Auth\AuthController@getLogin');
Route::post('private/login', 'Auth\AuthController@postLogin');

Route::get('logout', [
    'as' => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

// Allow registration routes only if registration is enabled.
if (settings('reg_enabled')) {
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('register/confirmation/{token}', [
        'as' => 'register.confirm-email',
        'uses' => 'Auth\AuthController@confirmEmail'
    ]);
    Route::get('register/confirm/{token}', [
        'as' => 'register.confirm-data',
        'uses' => 'Auth\AuthController@confirmData'
    ]);

    Route::post('completeData/{token}', [
        'as' => 'completeData',
        'uses' => 'Auth\AuthController@confirmRegister'
    ]);
}

// Register password reset routes only if it is enabled inside website settings.
if (settings('forgot_password')) {
    Route::get('password/remind', 'Auth\PasswordController@forgotPassword');
    Route::post('password/remind', 'Auth\PasswordController@sendPasswordReminder');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
}

/**
 * Two-Factor Authentication
 */
if (settings('2fa.enabled')) {
    Route::get('auth/two-factor-authentication', [
        'as' => 'auth.token',
        'uses' => 'Auth\AuthController@getToken'
    ]);

    Route::post('auth/two-factor-authentication', [
        'as' => 'auth.token.validate',
        'uses' => 'Auth\AuthController@postToken'
    ]);
}

/**
 * Social Login
 */
Route::get('auth/{provider}/login', [
    'as' => 'social.login',
    'uses' => 'Auth\SocialAuthController@redirectToProvider',
    'middleware' => 'social.login'
]);

Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('auth/twitter/email', 'Auth\SocialAuthController@getTwitterEmail');
Route::post('auth/twitter/email', 'Auth\SocialAuthController@postTwitterEmail');

/**
 * Other
 */

Route::get('admin', [
    'as' => 'dashboard',
    'uses' => 'DashboardController@index'
]);

Route::get('panel', [
    'as' => 'panel',
    'uses' => 'DashboardController@index'
]);

/**
 * User Details
 */

Route::get('user_details', [
    'as' => 'user_details',
    'uses' => 'UserDetailsController@index'
]);

Route::get('user_details/activity', [
    'as' => 'user_details.activity',
    'uses' => 'UserDetailsController@activity'
]);

Route::put('user_details/details/update', [
    'as' => 'user_details.update.details',
    'uses' => 'UserDetailsController@updateDetails'
]);

Route::post('user_details/avatar/update', [
    'as' => 'user_details.update.avatar',
    'uses' => 'UserDetailsController@updateAvatar'
]);

Route::post('user_details/avatar/update/external', [
    'as' => 'user_details.update.avatar-external',
    'uses' => 'UserDetailsController@updateAvatarExternal'
]);

Route::put('user_details/login-details/update', [
    'as' => 'user_details.update.login-details',
    'uses' => 'UserDetailsController@updateLoginDetails'
]);

Route::put('user_details/social-networks/update', [
    'as' => 'user_details.update.social-networks',
    'uses' => 'UserDetailsController@updateSocialNetworks'
]);

Route::post('user_details/two-factor/enable', [
    'as' => 'user_details.two-factor.enable',
    'uses' => 'UserDetailsController@enableTwoFactorAuth'
]);

Route::post('user_details/two-factor/disable', [
    'as' => 'user_details.two-factor.disable',
    'uses' => 'UserDetailsController@disableTwoFactorAuth'
]);

Route::get('user_details/sessions', [
    'as' => 'user_details.sessions',
    'uses' => 'UserDetailsController@sessions'
]);

Route::delete('user_details/sessions/{session}/invalidate', [
    'as' => 'user_details.sessions.invalidate',
    'uses' => 'UserDetailsController@invalidateSession'
]);

/**
 * User Management
 */
Route::get('user', [
    'as' => 'user.index',
    'uses' => 'UsersController@index'
]);

Route::get('user/create', [
    'as' => 'user.create',
    'uses' => 'UsersController@create'
]);

Route::post('user/create', [
    'as' => 'user.store',
    'uses' => 'UsersController@store'
]);

Route::get('user/{user}/show', [
    'as' => 'user.show',
    'uses' => 'UsersController@view'
]);

Route::get('user/{user}/edit', [
    'as' => 'user.edit',
    'uses' => 'UsersController@edit'
]);

Route::put('user/{user}/update/details', [
    'as' => 'user.update.details',
    'uses' => 'UsersController@updateDetails'
]);

Route::put('user/{user}/update/login-details', [
    'as' => 'user.update.login-details',
    'uses' => 'UsersController@updateLoginDetails'
]);

Route::delete('user/{user}/delete', [
    'as' => 'user.delete',
    'uses' => 'UsersController@delete'
]);

Route::post('user/{user}/update/avatar', [
    'as' => 'user.update.avatar',
    'uses' => 'UsersController@updateAvatar'
]);

Route::post('user/{user}/update/avatar/external', [
    'as' => 'user.update.avatar.external',
    'uses' => 'UsersController@updateAvatarExternal'
]);

Route::post('user/{user}/update/social-networks', [
    'as' => 'user.update.socials',
    'uses' => 'UsersController@updateSocialNetworks'
]);

Route::get('user/{user}/sessions', [
    'as' => 'user.sessions',
    'uses' => 'UsersController@sessions'
]);

Route::delete('user/{user}/sessions/{session}/invalidate', [
    'as' => 'user.sessions.invalidate',
    'uses' => 'UsersController@invalidateSession'
]);

Route::post('user/{user}/two-factor/enable', [
    'as' => 'user.two-factor.enable',
    'uses' => 'UsersController@enableTwoFactorAuth'
]);

Route::post('user/{user}/two-factor/disable', [
    'as' => 'user.two-factor.disable',
    'uses' => 'UsersController@disableTwoFactorAuth'
]);

/**
 * Roles & Permissions
 */

Route::get('role', [
    'as' => 'role.index',
    'uses' => 'RolesController@index'
]);

Route::get('role/create', [
    'as' => 'role.create',
    'uses' => 'RolesController@create'
]);

Route::post('role/store', [
    'as' => 'role.store',
    'uses' => 'RolesController@store'
]);

Route::get('role/{role}/edit', [
    'as' => 'role.edit',
    'uses' => 'RolesController@edit'
]);

Route::put('role/{role}/update', [
    'as' => 'role.update',
    'uses' => 'RolesController@update'
]);

Route::delete('role/{role}/delete', [
    'as' => 'role.delete',
    'uses' => 'RolesController@delete'
]);


Route::post('permission/save', [
    'as' => 'permission.save',
    'uses' => 'PermissionsController@saveRolePermissions'
]);

Route::resource('permission', 'PermissionsController');

/**
 * Settings
 */

Route::get('settings', [
    'as' => 'settings.general',
    'uses' => 'SettingsController@general',
    'middleware' => 'permission:settings.general'
]);

Route::post('settings/general', [
    'as' => 'settings.general.update',
    'uses' => 'SettingsController@update',
    'middleware' => 'permission:settings.general'
]);

Route::get('settings/auth', [
    'as' => 'settings.auth',
    'uses' => 'SettingsController@auth',
    'middleware' => 'permission:settings.auth'
]);

Route::post('settings/auth', [
    'as' => 'settings.auth.update',
    'uses' => 'SettingsController@update',
    'middleware' => 'permission:settings.auth'
]);

// Only allow managing 2FA if AUTHY_KEY is defined inside .env file
if (env('AUTHY_KEY')) {
    Route::post('settings/auth/2fa/enable', [
        'as' => 'settings.auth.2fa.enable',
        'uses' => 'SettingsController@enableTwoFactor',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth/2fa/disable', [
        'as' => 'settings.auth.2fa.disable',
        'uses' => 'SettingsController@disableTwoFactor',
        'middleware' => 'permission:settings.auth'
    ]);
}

Route::post('settings/auth/registration/captcha/enable', [
    'as' => 'settings.registration.captcha.enable',
    'uses' => 'SettingsController@enableCaptcha',
    'middleware' => 'permission:settings.auth'
]);

Route::post('settings/auth/registration/captcha/disable', [
    'as' => 'settings.registration.captcha.disable',
    'uses' => 'SettingsController@disableCaptcha',
    'middleware' => 'permission:settings.auth'
]);

Route::get('settings/notifications', [
    'as' => 'settings.notifications',
    'uses' => 'SettingsController@notifications',
    'middleware' => 'permission:settings.notifications'
]);

Route::post('settings/notifications', [
    'as' => 'settings.notifications.update',
    'uses' => 'SettingsController@update',
    'middleware' => 'permission:settings.notifications'
]);

/**
 * Activity Log
 */

Route::get('activity', [
    'as' => 'activity.index',
    'uses' => 'ActivityController@index'
]);

Route::get('activity/user/{user}/log', [
    'as' => 'activity.user',
    'uses' => 'ActivityController@userActivity'
]);

/**
 * Installation
 */

$router->get('install', [
    'as' => 'install.start',
    'uses' => 'InstallController@index'
]);

$router->get('install/requirements', [
    'as' => 'install.requirements',
    'uses' => 'InstallController@requirements'
]);

$router->get('install/permissions', [
    'as' => 'install.permissions',
    'uses' => 'InstallController@permissions'
]);

$router->get('install/database', [
    'as' => 'install.database',
    'uses' => 'InstallController@databaseInfo'
]);

$router->get('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/install-app', [
    'as' => 'install.install',
    'uses' => 'InstallController@install'
]);

$router->get('install/complete', [
    'as' => 'install.complete',
    'uses' => 'InstallController@complete'
]);

$router->get('install/error', [
    'as' => 'install.error',
    'uses' => 'InstallController@error'
]);

//===============================================


Route::get('idiomas', function () {
        return view('web_languages');
    });

Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es'
    ]);

Route::get('error403', function () {
    return view('errors.403');
})->name('error403');


/**
 * Emails
 */

Route::get('messages', [
    'as' => 'messages.index',
    'uses' => 'MessageController@index',
]);


Route::post('messages/store', [
    'as' => 'messages.store',
    'uses' => 'MessageController@store',
]);

Route::get('messages/{details}/details',[
       'as'     => 'messages.details', 
       'uses'   => 'MessageController@details',
    ]);
/**
 * Companies
 */

Route::get('companies', [
    'as' => 'companies.index',
    'uses' => 'CompanyController@index',
    'middleware' => 'permission:companies.manage'
]);

Route::get('companies/create', [
    'as' => 'companies.create',
    'uses' => 'CompanyController@create',
    'middleware' => 'permission:companies.manage'
]);

Route::post('companies/store', [
    'as' => 'companies.store',
    'uses' => 'CompanyController@store',
    'middleware' => 'permission:companies.manage'
]);

Route::get('companies/{company}/show', [
    'as' => 'companies.show',
    'uses' => 'CompanyController@view',
    'middleware' => 'permission:companies.manage'
]);

Route::delete('companies/{company}/delete', [
    'as' => 'companies.delete',
    'uses' => 'CompanyController@delete',
    'middleware' => 'permission:companies.manage'
]);

Route::get('companies/{company}/edit', [
    'as' => 'companies.edit',
    'uses' => 'CompanyController@edit',
    'middleware' => 'permission:companies.manage'
]);

Route::put('companies/{company}/update', [
    'as' => 'companies.update',
    'uses' => 'CompanyController@update',
    'middleware' => 'permission:companies.manage'
]);

Route::get('company', [
    'as' => 'company',
    'uses' => 'CompanyController@yourCompany',
    'middleware' => 'permission:companies.manage'
]);

Route::put('companies/profile', [
    'as' => 'companies.profile.update',
    'uses' => 'CompanyController@updateProfile',
    'middleware' => 'permission:companies.manage'
]);

Route::put('companies/experience', [
    'as' => 'companies.experience.update',
    'uses' => 'CompanyController@updateExperience',
    'middleware' => 'permission:companies.manage'
]);

/**
 * Candidates
 */

Route::get('candidates', [
    'as' => 'candidates.index',
    'uses' => 'CandidateController@index',
    'middleware' => 'permission:candidates.manage'
]);

Route::get('candidates/create', [
    'as' => 'candidates.create',
    'uses' => 'CandidateController@create',
    'middleware' => 'permission:candidates.manage'
]);

Route::post('candidates/store', [
    'as' => 'candidates.store',
    'uses' => 'CandidateController@store',
    'middleware' => 'permission:candidates.manage'
]);

Route::get('candidates/{candidate}/show', [
    'as' => 'candidates.show',
    'uses' => 'CandidateController@view',
    'middleware' => 'permission:candidates.manage'
]);

Route::get('candidates/{candidate}/edit', [
    'as' => 'candidates.edit',
    'uses' => 'CandidateController@edit',
    'middleware' => 'permission:candidates.manage'
]);

Route::put('candidates/{candidate}/update', [
    'as' => 'candidates.update',
    'uses' => 'CandidateController@update',
    'middleware' => 'permission:candidates.manage'
]);

Route::delete('candidates/{candidate}/delete', [
    'as' => 'candidates.delete',
    'uses' => 'CandidateController@delete',
    'middleware' => 'permission:candidates.manage'
]);

/**
 * Categories
 */

Route::get('categories', [
    'as' => 'categories.index',
    'uses' => 'CategoryController@index',
    'middleware' => 'permission:categories.manage'
]);

Route::get('categories/create', [
    'as' => 'categories.create',
    'uses' => 'CategoryController@create',
    'middleware' => 'permission:categories.manage'
]);

Route::post('categories/store', [
    'as' => 'categories.store',
    'uses' => 'CategoryController@store',
    'middleware' => 'permission:categories.manage'
]);

Route::get('categories/{category}/show', [
    'as' => 'categories.show',
    'uses' => 'CategoryController@view',
    'middleware' => 'permission:categories.manage'
]);

Route::get('categories/{category}/edit', [
    'as' => 'categories.edit',
    'uses' => 'CategoryController@edit',
    'middleware' => 'permission:categories.manage'
]);

Route::put('categories/{category}/update', [
    'as' => 'categories.update',
    'uses' => 'CategoryController@update',
    'middleware' => 'permission:categories.manage'
]);

Route::delete('categories/{category}/delete', [
    'as' => 'categories.delete',
    'uses' => 'CategoryController@delete',
    'middleware' => 'permission:categories.manage'
]);

Route::post('categories/avatar/{category}/update', [
    'as' => 'categories.update.avatar',
    'uses' => 'CategoryController@updateAvatar'
]);

Route::post('categories/avatar/{category}/update/external', [
    'as' => 'categories.update.avatar-external',
    'uses' => 'CategoryController@updateAvatarExternal',
    'middleware' => 'permission:categories.manage'
]);

/**
 * Vacancies
 */

Route::get('vacancies', [
    'as' => 'vacancies.index',
    'uses' => 'VacancyController@index',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/list', [
    'as' => 'vacancies.list',
    'uses' => 'VacancyController@listVacancies',
    'middleware' => 'permission:vacancies.view'
]);
/*
Route::get('vacancies/create', [
    'as' => 'vacancies.create',
    'uses' => 'VacancyController@create',
    'middleware' => 'permission:vacancies.create'
]);*/
/*
Route::post('vacancies/store', [
    'as' => 'vacancies.store',
    'uses' => 'VacancyController@store',
    'middleware' => 'permission:vacancies.create'
]);*/

/*Route::get('vacancies/{vacancy}/show', [
    'as' => 'vacancies.show',
    'uses' => 'VacancyController@view',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/{vacancy}/edit', [
    'as' => 'vacancies.edit',
    'uses' => 'VacancyController@edit',
    'middleware' => 'permission:vacancies.edit'
]);

Route::put('vacancies/{vacancy}/update', [
    'as' => 'vacancies.update',
    'uses' => 'VacancyController@update',
    'middleware' => 'permission:vacancies.edit'
]);

Route::delete('vacancies/{vacancy}/delete', [
    'as' => 'vacancies.delete',
    'uses' => 'VacancyController@delete',
    'middleware' => 'permission:vacancies.delete'
]);


Route::get('vacancies/getProvince', [
    'as' => 'vacancies.getProvince',
    'uses' => 'VacancyController@getProvinceByCountry',
    'middleware' => 'permission:vacancies.create'
]);

Route::get('vacancies/{vacancy}/apply', [
    'as' => 'vacancies.apply',
    'uses' => 'VacancyController@apply',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/{id}/approbate', [
    'as' => 'vacancies.approbate.supplier',
    'uses' => 'VacancyController@approbateSupplier',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/reject/supplier', [
    'as' => 'vacancies.reject.supplier',
    'uses' => 'VacancyController@rejectSupplier',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/approbate/candidate', [
    'as' => 'vacancies.approbate.candidate',
    'uses' => 'VacancyController@approbateCandidate',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/reject/candidate', [
    'as' => 'vacancies.reject.candidate',
    'uses' => 'VacancyController@rejectCandidate',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/postulate/candidate', [
    'as' => 'vacancies.postulate.candidate',
    'uses' => 'VacancyController@postulateCandidate',
    'middleware' => 'permission:vacancies.view'
]);



/**
 * News
 */

Route::get('news', [
    'as' => 'news.index',
    'uses' => 'NewsController@index',
    'middleware' => 'permission:news.manage'
]);

Route::get('news/create', [
    'as' => 'news.create',
    'uses' => 'NewsController@create',
    'middleware' => 'permission:news.manage'
]);

Route::post('news/store', [
    'as' => 'news.store',
    'uses' => 'NewsController@store',
    'middleware' => 'permission:news.manage'
]);

Route::get('news/{new}/show', [
    'as' => 'news.show',
    'uses' => 'NewsController@view',
    'middleware' => 'permission:news.manage'
]);

Route::get('news/{new}/edit', [
    'as' => 'news.edit',
    'uses' => 'NewsController@edit',
    'middleware' => 'permission:news.manage'
]);

Route::put('news/{new}/update', [
    'as' => 'news.update',
    'uses' => 'NewsController@update',
    'middleware' => 'permission:news.manage'
]);

Route::delete('news/{new}/delete', [
    'as' => 'news.delete',
    'uses' => 'NewsController@delete',
    'middleware' => 'permission:news.manage'
]);


/**
 * Front-End
 */

Route::get('loginuser', 'Auth\AuthController@getLoginFrontend');
Route::post('loginuser', 'Auth\AuthController@postLoginFrontend');

Route::get('/', function()
{
    if (Auth::check()){
        return redirect()->route('dashboard');
    }
    $countries = \Vanguard\Country::orderBy('full_name','asc')->get();
 return View::make('frontend.homepage', ['countries' => $countries]);
});

Route::get('about', function()
{
 return View::make('frontend.about');
});

Route::get('loginuser', function()
{
    if (Auth::check()){
        return redirect()->route('dashboard');
    } 
 return View::make('frontend.login');
});

Route::get('404', function()
{
 return View::make('frontend.404');
});

Route::get('confirm', function()
{
 return View::make('frontend.confirm');
});

//=========================================================================
//     Rutas Frontend- Back end - Nuevo panel de usuario (Poster-Supplier)
//=========================================================================


// ======Calificaciones============
Route::get('califications', function()
{
 return View::make('dashboard_user.calification.index');
});


// ======Creditos============

Route::get('credits', function()
{
 return View::make('dashboard_user.credit.index');
});


// ======Facturas============

Route::get('invoices', function()
{
 return View::make('dashboard_user.invoice.index');
});


// ======Post============
Route::get('post', function()
{
 return View::make('dashboard_user.post.index');
});

/*Route::get('new_post', function()
{
 return View::make('dashboard_user.post.add_post');
});*/

Route::get('vacancies/create', [
    'as' => 'vacancies.create',
    'uses' => 'VacancyController@create',
    'middleware' => 'permission:vacancies.create'
]);

Route::post('vacancies/store', [
    'as' => 'vacancies.store',
    'uses' => 'VacancyController@store',
    'middleware' => 'permission:vacancies.create'
]);

Route::get('vacancies/step/1', [
    'as' => 'vacancies.step1',
    'uses' => 'VacancyController@getVacancyStepOne',
    'middleware' => 'permission:vacancies.create'
]);

Route::post('vacancies/step/1', [
    'as' => 'vacancies.step1',
    'uses' => 'VacancyController@postVacancyStepOne',
    'middleware' => 'permission:vacancies.create'
]);

Route::get('vacancies/{vacancy}/show', [
    'as' => 'vacancies.show',
    'uses' => 'VacancyController@view',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/{vacancy}/edit', [
    'as' => 'vacancies.edit',
    'uses' => 'VacancyController@edit',
    'middleware' => 'permission:vacancies.edit'
]);

Route::put('vacancies/{vacancy}/update', [
    'as' => 'vacancies.update',
    'uses' => 'VacancyController@update',
    'middleware' => 'permission:vacancies.edit'
]);

Route::delete('vacancies/{vacancy}/delete', [
    'as' => 'vacancies.delete',
    'uses' => 'VacancyController@delete',
    'middleware' => 'permission:vacancies.delete'
]);

Route::get('vacancies/{vacancy}/status', [
    'as' => 'vacancies.vacancy_status',
    'uses' => 'VacancyController@update_status',
    'middleware' => 'permission:vacancies.edit'
]);

//Post-User (Oportunities Available)
Route::get('vacancies/{vacancy}/show_post_user', [
    'as' => 'vacancies.post_user',
    'uses' => 'VacancyController@show_post_user',
    'middleware' => 'permission:vacancies.view'
]);

//Post-Supplier (Solicitud Supplier)
Route::get('vacancies/{vacancy}/post_supplier', [
    'as' => 'vacancies.post_supplier',
    'uses' => 'VacancyController@post_supplier',
    'middleware' => 'permission:vacancies.view'
]);


Route::get('post_user', function()
{
 return View::make('dashboard_user.post.post_user');
});

Route::get('post_detail', function()
{
 return View::make('dashboard_user.post.post_detail');
});





Route::get('post_supplier', function()
{
 return View::make('dashboard_user.post.post_supplier');
});

Route::get('post_credits', function()
{
 return View::make('dashboard_user.post.post_credits');
});

// ======Mensajes============
Route::get('message_list', function()
{
 return View::make('dashboard_user.message.index');
});


// ======Equipo============
Route::get('team', function()
{
 return View::make('dashboard_user.team.index');
});


// ======Supplier============
Route::get('supplier', function()
{
 return View::make('dashboard_user.supplier.index');
});

Route::get('calification_supplier', function()
{
 return View::make('dashboard_user.supplier.calification_supplier');
});

// ======Candidatos============
/*Route::get('candidate', function()
{
 return View::make('dashboard_user.candidate.index');
});

Route::resource('gtalents/candidates', 'CandidateController');*/

// ======Para las alertas============
Route::get('alerts', function()
{
 return View::make('dashboard_user.alerts-messages');
});


// ======Estados/Provincia por país============
Route::get('country/getProvince', [
    'as' => 'country.getProvince',
    'uses' => 'CountryController@getProvinceByCountry'
]);