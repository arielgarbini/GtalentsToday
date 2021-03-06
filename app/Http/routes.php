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

Route::get('profile', [
    'as' => 'auth.profile',
    'uses' => 'UsersController@profile'
]);

Route::post('profile', [
    'as' => 'update.profile',
    'uses' => 'UsersController@profileUpdate'
]);

Route::post('profile/admin', [
   'as' => 'update.profile.admin',
    'uses' => 'UsersController@updateProfileAdmin'
]);

// Allow registration routes only if registration is enabled.
Route::get('auth/linkedin', [
    'as' => 'url.linkedin',
    'uses' => 'Auth\AuthController@getLinkedinUrl'
]);
if (settings('reg_enabled')) {
    Route::get('register', [
        'as' => 'register.inf',
        'uses' => 'Auth\AuthController@getRegister'
    ]);

    Route::get('register/email', [
        'as' => 'register.email',
        'uses' => 'UsersController@getEmail'
    ]);

    Route::post('register/email/resend', [
        'as' => 'register.email.resend',
        'uses' => 'UsersController@postResend'
    ]);

    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('register/linkedin/cancel', 'Auth\AuthController@getRegisterLinkedinCancel');

    Route::get('register/linkedin', [
        'as' => 'register.linkedin',
        'uses' => 'Auth\AuthController@getRegisterLinkedin'
    ]);

    Route::get('login/linkedin', [
        'as' => 'login.linkedin',
        'uses' => 'Auth\AuthController@getLoginLinkedin'
    ]);

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

    Route::get('register/confirm/collaborator/{token}', [
        'as' => 'register.confirm-data.collaborator',
        'uses' => 'Auth\AuthController@confirmDataCollaborator'
    ]);

    Route::post('completeData/collaborator/{token}', [
        'as' => 'completeData.collaborator',
        'uses' => 'Auth\AuthController@confirmRegisterCollaborator'
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

Route::put('user/{user}/update', [
    'as' => 'user.update.all',
    'uses' => 'UsersController@update'
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

Route::post('{id}/notifications/delete', [
    'as' => 'notifications.delete',
    'uses' => 'NotificationsController@delete'
]);

Route::post('notifications/read', [
    'as' => 'read_notifications',
    'uses' => 'NotificationsController@read'
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

Route::put('companies/{company}/update/points', [
    'as' => 'companies.update.points',
    'uses' => 'CompanyController@updatePoints',
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

Route::get('candidates/list', [
    'as' => 'candidates.index.admin',
    'uses' => 'CandidateController@indexAdmin',
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

Route::get('vacancies/list/{url?}', [
    'as' => 'vacancies.list',
    'uses' => 'VacancyController@listVacancies',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/get/poster', [
    'as' => 'vacancies.get.poster',
    'uses' => 'DashboardController@getVacanciesPoster',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/get/user', [
    'as' => 'vacancies.get.user',
    'uses' => 'DashboardController@getVacanciesUser',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/get/search/{url?}', [
    'as' => 'vacancies.get.find',
    'uses' => 'DashboardController@getVacanciesFind',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('suppliers/get/search', [
    'as' => 'suppliers.get.find',
    'uses' => 'SupplierController@getSuppliersFind',
    'middleware' => 'permission:vacancies.view'
]);
/*
Route::get('vacancies/list/{url}', [
    'as' => 'vacancies.list.poster',
    'uses' => 'VacancyController@listVacancies',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/list/{url}', [
    'as' => 'vacancies.list.supplier',
    'uses' => 'VacancyController@listVacancies',
    'middleware' => 'permission:vacancies.view'
]);*/
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


Route::get('vacancies/{vacancy}/apply', [
    'as' => 'vacancies.apply',
    'uses' => 'VacancyController@apply',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/approbate', [
    'as' => 'vacancies.approbate.supplier',
    'uses' => 'VacancyController@approbateSupplier',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/reject/supplier', [
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

Route::get('loginuser', [
    'as' => 'loginuser',
    'uses' => 'Auth\AuthController@getLoginFrontend'
]);
Route::post('loginuser', 'Auth\AuthController@postLoginFrontend');

Route::get('/', function()
{
    if (Auth::check()){
        return redirect()->route('dashboard');
    }
    $countries = \Vanguard\Country::orderBy('name','asc')->get();
    $categories = \Vanguard\Category::all();
 return View::make('frontend.homepage', ['countries' => $countries, 'categories' => $categories]);
});

Route::get('about', function()
{
 return View::make('frontend.about');
});
/*
Route::get('loginuser', function()
{
    if (Auth::check()){
        return redirect()->route('dashboard');
    } 
 return View::make('frontend.login');
});*/

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
Route::get('califications', [
    'as' => 'califications.index',
    'uses' => 'CalificationsController@index'
]);

// ======Creditos============

Route::get('credits', [
    'as' => 'credits.index',
    'uses' => 'CreditsController@index',
    'middleware' => 'auth'
]);

Route::get('credits/getpay', [
    'as' => 'credits.getpay',
    'uses' => 'CreditsController@getDetailsPayment',
    'middleware' => 'auth'
]);

Route::get('credits/getpay/paypal', [
    'as' => 'credits.getpay.paypal',
    'uses' => 'CreditsController@getDetailsPaymentPaypal',
    'middleware' => 'auth'
]);

Route::get('credits/getpay/{amount}/success', [
    'as' => 'credits.getpay.success',
    'uses' => 'CreditsController@getPaymentSuccess',
    'middleware' => 'auth'
]);

Route::get('credits/getpay/cancel', [
    'as' => 'credits.getpay.cancel',
    'uses' => 'CreditsController@getPaymentCancel',
    'middleware' => 'auth'
]);

Route::post('credits/pay', [
    'as' => 'credits.pay',
    'uses' => 'CreditsController@pay',
    'middleware' => 'auth'
]);

Route::get('credits/list', [
    'as' => 'credits.list',
    'uses' => 'CreditsController@lists',
    'middleware' => 'auth'
]);

Route::get('credits/create', [
    'as' => 'credits.create',
    'uses' => 'CreditsController@create',
    'middleware' => 'auth'
]);

Route::post('credits/store', [
    'as' => 'credits.store',
    'uses' => 'CreditsController@store',
    'middleware' => 'auth'
]);

Route::post('credits/store/price', [
    'as' => 'credits.store.price',
    'uses' => 'CreditsController@storePrice',
    'middleware' => 'auth'
]);

Route::post('credits/store/price/candidate', [
    'as' => 'credits.store.price.candidate',
    'uses' => 'CreditsController@storePriceCandidate',
    'middleware' => 'auth'
]);

Route::put('credits/{id}/update', [
    'as' => 'credits.update',
    'uses' => 'CreditsController@update',
    'middleware' => 'auth'
]);
Route::delete('credits/{id}/delete', [
    'as' => 'credits.delete',
    'uses' => 'CreditsController@delete',
    'middleware' => 'auth'
]);

// ======Facturas============

Route::get('invoices', [
    'as' => 'invoices.index',
    'uses' => 'InvoicesController@index',
    'middleware' => 'auth'
]);

Route::get('invoices/list', [
    'as' => 'invoices.list',
    'uses' => 'InvoicesController@lists',
    'middleware' => 'auth'
]);

Route::get('invoices/{id}/show', [
    'as' => 'invoices.show',
    'uses' => 'InvoicesController@show',
    'middleware' => 'auth'
]);

Route::get('invoices/{id}/edit', [
    'as' => 'invoices.edit',
    'uses' => 'InvoicesController@edit',
    'middleware' => 'auth'
]);

Route::put('invoices/{id}/update', [
    'as' => 'invoices.update',
    'uses' => 'InvoicesController@update',
    'middleware' => 'auth'
]);
Route::delete('invoices/{id}/delete', [
    'as' => 'invoices.delete',
    'uses' => 'InvoicesController@delete',
    'middleware' => 'auth'
]);

// ======Post============
Route::get('post', function()
{
 return View::make('dashboard_user.post.index');
});

/*Route::get('new_post', function()
{
 return View::make('dashboard_user.post.add_post');
});*/

Route::get('vacancies/getProvince', [
    'as' => 'vacancies.getProvince',
    'uses' => 'VacancyController@getProvinceByCountry',
    'middleware' => 'permission:vacancies.create'
]);

Route::get('vacancies/create/{id?}', [
    'as' => 'vacancies.create',
    'uses' => 'VacancyController@create',
    'middleware' => ['auth', 'permission:vacancies.create']
]);

Route::get('vacancies/{id?}/edit/', [
    'as' => 'vacancies.edit.front',
    'uses' => 'VacancyController@create',
    'middleware' => ['auth', 'permission:vacancies.create']
]);

Route::post('vacancies/store/{id?}', [
    'as' => 'vacancies.store',
    'uses' => 'VacancyController@store',
    'middleware' => ['auth', 'permission:vacancies.create']
]);

Route::get('vacancies/step/1/{id?}', [
    'as' => 'vacancies.step1',
    'uses' => 'VacancyController@getVacancyStepOne',
    'middleware' => ['auth', 'permission:vacancies.create']
]);

Route::get('vacancies/step/2/{id?}', [
    'as' => 'vacancies.step2',
    'uses' => 'VacancyController@getVacancyStepTwo',
    'middleware' => ['auth', 'permission:vacancies.create']
]);

Route::post('vacancies/step/1/{id?}', [
    'as' => 'vacancies.step1',
    'uses' => 'VacancyController@postVacancyStepOne',
    'middleware' => ['auth', 'permission:vacancies.create']
]);

Route::post('vacancies/step/1/{id}', [
    'as' => 'vacancies.step1.ajax',
    'uses' => 'VacancyController@postVacancyStepOneAjax',
    'middleware' => ['auth', 'permission:vacancies.create']
]);

Route::get('vacancies/{vacancy}/show', [
    'as' => 'vacancies.show',
    'uses' => 'VacancyController@view',
    'middleware' => ['auth', 'permission:vacancies.view']
]);

Route::get('vacancies/{vacancy}/showVacancy', [
    'as' => 'vacancies.showVacancy',
    'uses' => 'VacancyController@showVacancy',
    'middleware' => ['auth', 'permission:vacancies.view']
]);

Route::get('vacancies/{vacancy}/getSuppliers', [
    'as' => 'vacancies.show.getsuppliers',
    'uses' => 'VacancyController@getSupplierRecommended',
    'middleware' => ['auth', 'permission:vacancies.view']
]);

Route::get('vacancies/{vacancy}/editVacancy', [
    'as' => 'vacancies.editVacancy',
    'uses' => 'VacancyController@edit',
    'middleware' => ['auth', 'permission:vacancies.edit']
]);

Route::put('vacancies/{vacancy}/update', [
    'as' => 'vacancies.update',
    'uses' => 'VacancyController@update',
    'middleware' => ['auth', 'permission:vacancies.edit']
]);

Route::delete('vacancies/{vacancy}/delete', [
    'as' => 'vacancies.delete',
    'uses' => 'VacancyController@delete',
    'middleware' => ['auth', 'permission:vacancies.delete']
]);

Route::get('vacancies/{vacancy}/status', [
    'as' => 'vacancies.vacancy_status',
    'uses' => 'VacancyController@status',
    'middleware' => ['auth', 'permission:vacancies.edit']
]);

Route::post('vacancies/change_status', [
    'as' => 'vacancies.change_status',
    'uses' => 'VacancyController@change_status',
    'middleware' => ['auth']
]);

Route::post('vacancies/{id}/change_status/candidate', [
    'as' => 'vacancies.change_status.candidate',
    'uses' => 'VacancyController@change_status_candidate',
    'middleware' => ['auth']
]);

//Post-User (Oportunities Available)
Route::get('vacancies/{vacancy}/show_post_user', [
    'as' => 'vacancies.post_user',
    'uses' => 'VacancyController@show_post_user',
    'middleware' => ['auth', 'permission:vacancies.view']
]);

//Post-Supplier (Solicitud Supplier)
Route::post('vacancies/{vacancy}/post_supplier', [
    'as' => 'vacancies.post_supplier',
    'uses' => 'VacancyController@post_supplier',
    'middleware' => ['auth', 'permission:vacancies.view']
]);

Route::post('vacancies/{id}/approbate', [
    'as' => 'vacancies.approbate.supplier',
    'uses' => 'VacancyController@approbateSupplier',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/reject/supplier', [
    'as' => 'vacancies.reject.supplier',
    'uses' => 'VacancyController@rejectSupplier',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/supplier/external', [
    'as' => 'vacancies.invited.supplier.external',
    'uses' => 'VacancyController@invitedSupplierExternal',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/supplier/invited', [
    'as' => 'vacancies.invited.supplier',
    'uses' => 'VacancyController@invitedSupplier',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/approbate/invited', [
    'as' => 'vacancies.approbate.supplier.invited',
    'uses' => 'VacancyController@approbateInvitedSupplier',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/reject/supplier/invited', [
    'as' => 'vacancies.reject.supplier.invited',
    'uses' => 'VacancyController@rejectInvitedSupplier',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/approbate/candidate', [
    'as' => 'vacancies.approbate.candidate',
    'uses' => 'VacancyController@approbateCandidate',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/reject/candidate', [
    'as' => 'vacancies.reject.candidate',
    'uses' => 'VacancyController@rejectCandidate',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/delete/candidate', [
    'as' => 'vacancies.delete.candidate',
    'uses' => 'VacancyController@deleteCandidate',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/postulate/candidate', [
    'as' => 'vacancies.postulate.candidate',
    'uses' => 'VacancyController@postulateCandidate',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/read/candidate', [
    'as' => 'vacancies.read.candidate',
    'uses' => 'VacancyController@read',
    'middleware' => 'permission:vacancies.view'
]);

Route::get('vacancies/{id}/history/candidate', [
    'as' => 'vacancies.history.candidate',
    'uses' => 'VacancyController@getHistory',
    'middleware' => ['auth', 'permission:vacancies.view']
]);

Route::get('vacancies/{id}/contract/candidate', [
    'as' => 'vacancies.contract.candidate',
    'uses' => 'VacancyController@getContractCandidate',
    'middleware' => ['auth', 'permission:vacancies.view']
]);

Route::post('vacancies/{id}/contract/candidate/save', [
    'as' => 'vacancies.contract.candidate.post',
    'uses' => 'VacancyController@postContractCandidate',
    'middleware' => 'permission:vacancies.view'
]);

Route::post('vacancies/{id}/qualify/supplier', [
    'as' => 'vacancies.qualify.supplier',
    'uses' => 'VacancyController@qualifySupplier',
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
Route::get('message/list', [
    'as' => 'message.indexFrontend',
    'uses' => 'MessageController@indexFrontend'
]);

Route::get('message_list', [
    'as' => 'message.index',
    'uses' => 'MessageController@index'
]);

Route::delete('message/{message}/delete', [
    'as' => 'message.delete',
    'uses' => 'MessageController@delete'
]);

Route::get('conversations/{id}/messages', [
    'as' => 'conversations.message',
    'uses' => 'MessageController@getMessages'
]);

Route::post('conversations/messages', [
    'as' => 'conversations.message.save',
    'uses' => 'MessageController@PostMessages'
]);

// ======Equipo============
Route::get('team', [
    'as' => 'team.index',
    'uses' => 'TeamController@index'
]);

Route::post('team/store', [
    'as' => 'team.store',
    'uses' => 'TeamController@store'
]);

Route::put('team/{team}/update', [
    'as' => 'team.update',
    'uses' => 'TeamController@update'
]);

Route::delete('team/{team}/delete', [
    'as' => 'team.delete',
    'uses' => 'TeamController@delete'
]);

// ======Supplier============

Route::get('supplier/list', [
    'as' => 'supplier.index',
    'uses' => 'SupplierController@index'
]);

Route::get('supplier/{id}/calification_supplier', [
    'as' => 'supplier.calification_supplier',
    'uses' => 'SupplierController@calificationSupplier'
]);

Route::post('supplier/{id}/calification_supplier', [
    'as' => 'supplier.calification_supplier.store',
    'uses' => 'SupplierController@calificationSupplierStore'
]);

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

Route::get('country/getCities', [
    'as' => 'country.getCities',
    'uses' => 'CountryController@getCitiesByCountry'
]);