<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('loginPage');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// $routes->set404Override(function () {
//     echo view('error-404.php');
// });
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


/*===================== USER Controller ROUTES============================*/
$routes->get('/', 'Home::index', ["filter" => "userauth"]);
$routes->match(['get', 'post'], 'login', 'Home::loginPage', ["filter" => "usernoauth"]);
$routes->match(['get', 'post'], 'register', 'Home::register');
$routes->get('logout', 'Home::logout');

$routes->match(['get', 'post'], 'login/user', 'Home::UserLogin');
$routes->match(['get', 'post'], 'register/user', 'Home::UserRegistration');

/*=====================USER DASHBAORD ROUTES============================*/
$routes->group("/", ["filter" => "userauth"], function ($routes) {
    $routes->get('user/dashboard', 'Home::index');
    $routes->match(['get', 'post'], 'user/profile', 'Home::profile');
});

/*===================== Admin Controller ROUTES ============================*/
$routes->match(['get', 'post'], 'login/auth', 'Home::AuthLogin');
$routes->match(['get', 'post'], 'admin/login', 'Home::adminLogin', ["filter" => "noauth"]);
$routes->get('admin/logout', 'Home::adminLogout');

$routes->group("admin", ["filter" => "auth"], function ($routes) {
    $routes->match(['get', 'post'], 'dashboard', 'Home::adminDashboard');
    $routes->match(['get', 'post'], 'user-list', 'Home::usersListDetails');
    $routes->match(['get', 'post'], 'job-list-mapping', 'Home::jobListMapping');
});
/*========================= API Controller Routes ========================================*/
$routes->group("api", ['namespace' => 'App\Controllers\api\v1'], function ($routes) {

    //===================|USER API|======================
    $routes->post("login", "UserController::loginUser");
    $routes->post("register", "UserController::createUser");
    $routes->post("get/user/profile", "UserController::getUserDetails");
    $routes->post("inser/user/profile", "UserController::insertUserProfile");
    $routes->post("update/user/profile", "UserController::updateUserDetails");

    //======================|ADMIN API|=============================
    $routes->post("login/auth", "UserController::authLoginUser");
    $routes->get("getAllUsersListDetails", "Admin/AdminController::getUsersListDetails");
    $routes->get("getAllJobListMapping", "Admin/AdminController::getAllJobListMapping");

});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
