<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\MicrosoftController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\GeneralSettings\AttachmentController;
use App\Http\Controllers\Bbs\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Bbs\Admin\UserController as AdminUserController;
use App\Http\Controllers\Bbs\Setting\EventController;
use App\Http\Controllers\Bbs\Auth\AdminController as AuthAdminController;
use App\Http\Controllers\Bbs\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Bbs\Setting\AppSettingController;
use App\Http\Controllers\Bbs\Setting\EventImageController;
use App\Http\Controllers\Bbs\Setting\ServiceController;
use App\Http\Controllers\Bbs\Setting\ServiceImageController;
use App\Http\Controllers\StatusController;

use App\Http\Controllers\Bbs\Setting\VenueController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Bbs\Admin\ImportExportController;
use App\Http\Controllers\Bbs\Setting\VariationController;
use App\Http\Controllers\Bbs\Customer\UserController;
use App\Http\Controllers\UtilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return redirect()->route('bbs.admin.booking');
        } elseif (auth()->user()->hasRole('Customer')) {
            Log::info('Redirecting to bbs.customer.booking');
            return redirect()->route('bbs.customer.booking');
        } else {
            return redirect()->route('login');
        }
    } else {
        return redirect()->route('login');
    }
})->name('home');


Route::controller(MicrosoftController::class)->group(function () {
    Route::get('auth/microsoft', 'redirectToMicrosoft')->name('auth.microsoft');
    Route::get('auth/microsoft/callback', 'handleMicrosoftCallback');
});

// 'XssSanitizer'

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::middleware(['auth', 'otp', 'mutli.event', 'role:SuperAdmin', 'prevent-back-history', 'auth.session'])->group(function () {

        // Service variation
        Route::controller(VariationController::class)->group(function () {
            Route::get('/bbs/setting/service/variation', 'index')->name('bbs.setting.service.variation');
            Route::get('/bbs/setting/service/variation/list', 'list')->name('bbs.setting.service.variation.list');
            Route::get('/bbs/setting/service/variation/get/{id}', 'get')->name('bbs.setting.service.variation.get');
            Route::post('bbs/setting/service/variation/update', 'update')->name('bbs.setting.service.variation.update');
            Route::delete('/bbs/setting/service/variation/delete/{id}', 'delete')->name('bbs.setting.service.variation.delete');
            Route::post('/bbs/setting/service/variation/store', 'store')->name('bbs.setting.service.variation.store');
            // add inventroy to this variation
            Route::post('/bbs/setting/inventory/variation/store', 'inventory_store')->name('bbs.setting.inventory.variation.store');
            Route::get('/bbs/setting/inventory/variation/get/{id}', 'get_inventory_variation_info')->name('bbs.setting.inventory.variation.get');
            // end inventroy to this variation

            Route::get('/bbs/setting/service/variation/mv/get/{id}', 'getView')->name('bbs.setting.service.variation.get.mv');

            // functional areas and bbs sizes associated with service code
            Route::get('/bbs/setting/service/code/functional_areas/{id}', 'getAssicatedFunctionalAreas')->name('bbs.setting.service.code.functional_areas');
            Route::get('bbs_get_parking_code_from_event/{id}', 'getParkingCodeFromEvent')->name('bbs.setting.parking.code.get_from_event');
        });

        // Broadcast Booking Routes
        Route::controller(AdminBookingController::class)->group(function () {
            Route::get('/bbs/admin/booking', 'index')->name('bbs.admin.booking');
            Route::get('/bbs/admin/booking/list', 'list')->name('bbs.admin.booking.list');
            Route::get('/bbs/admin/booking/detail/{id}', 'detail')->name('bbs.admin.booking.detail');
            Route::delete('/bbs/admin/booking/delete/{id}', 'delete')->name('bbs.admin.booking.delete');
            Route::post('bbs/admin/booking/cart/store', 'storeService')->name('admin.booking.cart.store');
        });
        // Broadcast Service

        Route::get('/pay', [PaymentController::class, 'pay']);
        Route::get('/dibsy-callback', [PaymentController::class, 'dibsyCallback'])->name('dibsy.callback');


        // Service Image
        Route::controller(ServiceImageController::class)->group(function () {
            Route::get('/bbs/setting/service/file/{file}', 'getPrivateFile')->name('bbs.setting.service.file');
        });

        // Event Image
        Route::controller(EventImageController::class)->group(function () {
            Route::get('/bbs/setting/event/file/{file}', 'getPrivateFile')->name('bbs.setting.event.file');
        });
    });

    Route::middleware(['auth', 'otp', 'mutli.event', 'role:SuperAdmin', 'roles:admin', 'prevent-back-history', 'auth.session'])->group(function () {
        Route::controller(ServiceController::class)->group(function () {
            Route::post('/bbs/setting/service/store', 'store')->name('bbs.setting.service.store');
            Route::post('bbs/setting/service/update', 'update')->name('bbs.setting.service.update');
        });
    });

    // Setting ROUTE ******************************************************************** Admin All Route
    Route::middleware(['auth', 'otp', 'mutli.event', 'XssSanitizer', 'role:SuperAdmin', 'roles:admin', 'prevent-back-history', 'auth.session'])->group(function () {

        Route::get('/auth/ms-signup', [AuthAdminController::class, 'msSignUp'])->name('auth.ms.signup');
        Route::post('/signup/ms/store', [AdminUserController::class, 'msStore'])->name('admin.signup.ms.store');

        //Import and Export
        Route::controller(ImportExportController::class)->group(function () {
            Route::get('/bbs/admin/booking/import', 'showImportForm')->name('bbs.admin.import.show.form');
            Route::post('/bbs/admin/booking/import', 'import')->name('bbs.admin.import.store');
            Route::post('/bbs/admin/booking/export', 'export')->name('bbs.admin.export');
        });

        Route::controller(ServiceController::class)->group(function () {
            Route::get('/bbs/setting/service', 'index')->name('bbs.setting.service');
            Route::get('/bbs/setting/service/list', 'list')->name('bbs.setting.service.list');
            Route::get('/bbs/setting/service/get/{id}', 'get')->name('bbs.setting.service.get');
            Route::get('/bbs/setting/service/create', 'create')->name('bbs.setting.service.create');
            // Route::post('bbs/setting/service/update', 'update')->name('bbs.setting.service.update');
            Route::delete('/bbs/setting/service/delete/{id}',  'delete')->name('bbs.setting.service.delete');
            // Route::post('/bbs/setting/service/store', 'store')->name('bbs.setting.service.store');
            Route::post('bbs/service/status/update', 'updateStatus')->name('bbs.service.status.update');
            Route::get('bbs/service/status/edit/{id}', 'editStatus')->name('bbs.service.status.edit');
            Route::get('/bbs/setting/service/mv/get/{id}', 'getView')->name('bbs.setting.service.get.mv');
            Route::get('bbs/admin/booking/{id}/switch', 'switch')->name('bbs.admin.booking.switch');

            // Route::get('/bbs/manager', 'index')->name('bbs.manager');
            // Route::get('/bbs/manager/booking/cart', 'cart')->name('bbs.manager.booking.cart');
            // Route::get('/bbs/manager/booking/list', 'adminList')->name('bbs.manager.booking.list');
            // Route::get('/bbs/manager/booking/detail/{id}', 'detail')->name('bbs.manager.booking.detail');
            // Route::delete('/bbs/manager/booking/delete/{id}',  'deleteBooking')->name('bbs.manager.booking.delete');
            // Route::post('bbs/manager/booking/cart/store', 'storeService')->name('manager.booking.cart.store');
            // Route::get('bbs/manager/orders/{id}/switch', 'switch')->name('bbs.manager.orders.switch');
        });

        // Venue
        Route::controller(VenueController::class)->group(function () {
            Route::get('/bbs/setting/venue', 'index')->name('bbs.setting.venue');
            Route::get('/bbs/setting/venue/list', 'list')->name('bbs.setting.venue.list');
            Route::get('/bbs/setting/venue/get/{id}', 'get')->name('bbs.setting.venue.get');
            Route::post('/bbs/setting/venue/update', 'update')->name('bbs.setting.venue.update');
            Route::delete('/bbs/setting/venue/delete/{id}', 'delete')->name('bbs.setting.venue.delete');
            Route::post('/bbs/setting/venue/store', 'store')->name('bbs.setting.venue.store');
        });

        //Event
        Route::controller(EventController::class)->group(function () {
            Route::get('/bbs/setting/event', 'index')->name('bbs.setting.event');
            Route::get('/bbs/setting/event/list', 'list')->name('bbs.setting.event.list');
            Route::get('/bbs/setting/event/get/{id}', 'get')->name('bbs.setting.event.get');
            Route::post('/bbs/setting/event/update', 'update')->name('bbs.setting.event.update');
            Route::delete('/bbs/setting/event/delete/{id}', 'delete')->name('bbs.setting.event.delete');
            Route::post('/bbs/setting/event/store', 'store')->name('bbs.setting.event.store');
            Route::get('/bbs/setting/event/mv/get/{id}', 'getEventView')->name('bbs.setting.event.get.mv');
            // Route::get('/mds/setting/event/file/{file}', 'getPrivateFile')->name('mds.setting.event.file');
        });

        //Application Setting
        Route::controller(AppSettingController::class)->group(function () {
            Route::get('/bbs/setting/application', 'index')->name('bbs.setting.application');
            Route::get('/bbs/setting/application/list', 'list')->name('bbs.setting.application.list');
            Route::get('/bbs/setting/application/get/{id}', 'get')->name('bbs.setting.application.get');
            Route::post('bbs/setting/application/update', 'update')->name('bbs.setting.application.update');
            Route::delete('/bbs/setting/application/delete/{id}', 'delete')->name('bbs.setting.application.delete');
            Route::post('/bbs/setting/application/store', 'store')->name('bbs.setting.application.store');
        });


        Route::controller(AdminUserController::class)->group(function () {
            Route::get('/bbs/admin/users/profile', 'profile')->name('bbs.admin.users.profile');
            Route::post('/bbs/admin/users/profile/update', 'update')->name('bbs.admin.users.profile.update');
            Route::post('/bbs/admin/users/profile/password/update', 'updatePassword')->name('bbs.admin.users.profile.password.update');
        });
    });

    // Customer ******************************************************************** user All Route
    Route::middleware(['auth', 'otp', 'mutli.event', 'XssSanitizer', 'role:Customer', 'roles:user', 'prevent-back-history', 'auth.session'])->group(function () {

        // Customer Booking Routes
        Route::controller(CustomerBookingController::class)->group(function () {
            Route::get('/bbs/customer/booking', 'index')->name('bbs.customer.booking');
            Route::get('/bbs/customer/booking/list', 'list')->name('bbs.customer.booking.list');
            Route::get('/bbs/customer/booking/service/list', 'listService')->name('bbs.customer.booking.service.list');
            Route::get('/bbs/customer/booking/detail/{id}', 'detail')->name('bbs.customer.booking.detail');
            // Route::get('/bbs/customer/booking/cart', 'cart')->name('bbs.customer.booking.cart');
            Route::post('bbs/customer/booking/cart/store', 'storeService')->name('customer.booking.cart.store');
            Route::get('/bbs/customer/booking/{id}/switch', 'venueSwitch')->name('bbs.customer.booking.switch');
            Route::get('bbs/customer/booking/{id}/switch', 'switch')->name('bbs.customer.booking.switch');
            Route::get('/get-service-details', 'getServiceAvailability')->name('bbs.get.service.details');
            Route::get('/get-matches-by-venue', 'getMatchesByVenue')->name('bbs.get.match.by.venue');

            Route::delete('/bbs/customer/booking/delete/{id}', 'delete')->name('bbs.customer.booking.delete');

            Route::get('/bbs/customer/booking/menu/{id}', 'showServices')->name('bbs.customer.booking.menu.show.services');
            Route::get('/bbs/customer/booking/menu', 'build_menu')->name('bbs.customer.booking.menu');
        });

        Route::controller(VariationController::class)->group(function () {
            Route::get('/get-service-variation', 'get_variation_info')->name('bbs.get.variation.info');
            // Route::post('/bbs/customer/checkout/process', 'processCheckout')->name('bbs.customer.checkout.process');
            // Route::get('/bbs/customer/checkout/confirmation', 'confirmation')->name('bbs.customer.checkout.confirmation');
        });


        Route::controller(UserController::class)->group(function () {
            Route::get('/bbs/customer/users/profile', 'profile')->name('bbs.customer.users.profile');
            Route::post('/bbs/customer/users/profile/update', 'update')->name('bbs.customer.users.profile.update');
            Route::post('/bbs/customer/users/profile/password/update', 'updatePassword')->name('bbs.customer.users.profile.password.update');
        });
    });
});


// ****************** ADMIN *********************
Route::group(['middleware' => 'prevent-back-history'], function () {

    // Add User
    Route::get('/auth/signup', [AuthAdminController::class, 'signUp'])->name('mds.auth.signup');
    Route::post('/signup/store', [UserController::class, 'store'])->name('admin.signup.store');

    Route::middleware(['auth', 'prevent-back-history'])->group(function () {

        Route::get('auth/otp', [AuthAdminController::class, 'showOtp'])->name('otp.get');
        Route::post('verify-otp', [AuthAdminController::class, 'verifyOtpAndLogin'])->name('auth.otp.post');
        Route::get('auth/resend', [AuthAdminController::class, 'resendOTP'])->name('otp.resend.get');

        //used to show images in private folder
        Route::get('/doc/{file}', [UtilController::class, 'showImage'])->name('a');

        /*************************************** Play ground */
        // Route::get('/a/{GlobalAttachment}', [UtilController::class, 'serve'])->name('a');
        Route::get('/doc/{file}', [UtilController::class, 'showImage'])->name('a');
        Route::get('/a', function () {
            return response()->file(storage_path('app/private/users/502828276250308124600avatar-2.png'));
        })->name('b');
        /*************************************** End Play ground */

                Route::get('/bbs/admin/booking/pick', function () {
            return view('/bbs/admin/booking/pick');
        })->name('bbs.admin.booking.pick')->middleware('role:SuperAdmin');
        Route::post('/bbs/admin/events/switch', [AdminBookingController::class, 'pickEvent'])->name('bbs.admin.booking.event.switch')->middleware('role:SuperAdmin');



        Route::get('/bbs/customer/booking/pick', function () {
            return view('/bbs/customer/booking/pick');
        })->name('bbs.customer.booking.pick')->middleware('role:Customer');
        Route::post('/bbs/customer/events/switch', [CustomerBookingController::class, 'pickEvent'])->name('bbs.customer.booking.event.switch')->middleware('role:Customer');


        Route::get('/bbs/logout', [AuthAdminController::class, 'logout'])->name('bbs.logout');


        Route::get('/users', [UserController::class, 'index'])->name('users.index');

        // Charts
        Route::get('/charts/piechart', [ChartsController::class, 'pieChart'])->name('charts.pie');
        Route::get('/charts/piechart2', [ChartsController::class, 'pieChart'])->name('charts.pie2');
        Route::get('/charts/charts', [ChartsController::class, 'eventDash'])->name('charts.dashboard');
    });

    require __DIR__ . '/auth.php';

    // file manager routes
    Route::middleware(['auth', 'otp', 'XssSanitizer', 'role:SuperAdmin|Procurement', 'roles:admin', 'prevent-back-history', 'auth.session'])->group(function () {
        Route::controller(AttachmentController::class)->group(function () {
            Route::post('file/store', 'store')->name('file.store');
            Route::get('/global/files/list/{id?}', 'list')->name('global.files.list')->middleware('permission:employee.file.list');
            // Route::get('/global/files/list/{project?}', 'list')->name('global.files.list')->middleware('permission:employee.file.list');
            Route::get('/global/file/serve/{file}', 'serve')->name('global.file.serve');
            Route::delete('/global/files/delete/{id}', 'delete')->name('global.files.delete');
        });
    });

    // Admin Group Middleware
    Route::middleware(['auth', 'role:admin', 'prevent-back-history'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
        Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
        Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    });  // End groupd admin middleware

    // Route::middleware(['auth', 'role:agent'])->group(function () {
    //     Route::get('/agent/dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
    // });  // End groupd agent middleware

    Route::middleware(['prevent-back-history'])->group(function () {

        // Route::get('/tracki/auth/login', [AdminController::class, 'login'])->name('tracki.auth.login')->middleware('prevent-back-history');
        Route::get('/auth/login', [AuthAdminController::class, 'login'])->name('auth.login')->middleware('prevent-back-history');

        Route::get('/auth/forgot', [AuthAdminController::class, 'forgotPassword'])->name('auth.forgot');
        Route::post('forget-password', [AuthAdminController::class, 'submitForgetPasswordForm'])->name('forgot.password.post');
        Route::get('/auth/reset/{token}', [AuthAdminController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [AuthAdminController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    });

    // HR Security Settings all routes
    Route::middleware(['auth', 'otp', 'XssSanitizer', 'role:SuperAdmin', 'roles:admin', 'prevent-back-history', 'auth.session'])->group(function () {

        Route::controller(RoleController::class)->group(function () {
            //Admin User
            Route::get('/sec/adminuser/list', 'listAdminUser')->name('sec.adminuser.list');
            Route::post('updateadminuser', 'updateAdminUser')->name('sec.adminuser.update');
            Route::post('createadminuser', 'createAdminUser')->name('sec.adminuser.create');
            Route::get('/sec/adminuser/{id}/edit', 'editAdminUser')->name('sec.adminuser.edit');
            Route::get('/sec/adminuser/{id}/delete', 'deleteAdminUser')->name('sec.adminuser.delete');
            Route::get('/sec/adminuser/add', 'addAdminUser')->name('sec.adminuser.add');
            Route::get('/sec/adminuser/add2', 'addAdminUser2')->name('sec.adminuser.add2');

            // Roles
            Route::get('/sec/roles/add', function () {
                return view('/sec/roles/add');
            })->name('sec.roles.add');
            Route::get('/sec/roles/roles/list', 'listRole')->name('sec.roles.list');
            Route::post('updaterole', 'updateRole')->name('sec.roles.update');
            Route::post('createrole', 'createRole')->name('sec.roles.create');
            Route::get('/sec/roles/{id}/edit', 'editRole')->name('sec.roles.edit');
            Route::get('/sec/roles/{id}/delete', 'deleteRole')->name('sec.roles.delete');

            // group
            Route::get('/sec/groups/add', function () {
                return view('/sec/groups/add');
            })->name('sec.groups.add');
            Route::get('/sec/groups/list', 'listGroup')->name('sec.groups.list');
            Route::post('updategroup', 'updateGroup')->name('sec.groups.update');
            Route::post('creategroup', 'createGroup')->name('sec.groups.create');
            Route::get('/sec/groups/{id}/edit', 'editGroup')->name('sec.groups.edit');
            Route::get('/sec/groups/{id}/delete', 'deleteGroup')->name('sec.groups.delete');

            // Permission
            Route::get('/sec/permissions/list', 'listPermission')->name('sec.perm.list');
            Route::post('updatepermission', 'updatePermission')->name('sec.perm.update');
            Route::post('createpermission', 'createPermission')->name('sec.perm.create');
            Route::get('/sec/perm/{id}/edit', 'editPermission')->name('sec.perm.edit');
            Route::get('/sec/perm/{id}/delete', 'deletePermission')->name('sec.perm.delete');
            Route::get('/sec/permissions/add', 'addPermission')->name('sec.perm.add');

            Route::get('/sec/perm/import', 'ImportPermission')->name('sec.perm.import');
            Route::post('importnow', 'ImportNowPermission')->name('sec.perm.import.now');


            // Roles in Permission
            Route::get('/sec/rolesetup/list', 'listRolePermission')->name('sec.rolesetup.list');
            Route::post('updaterolesetup', 'updateRolePermission')->name('sec.rolesetup.update');
            Route::post('createrolesetup', 'createRolePermission')->name('sec.rolesetup.create');
            Route::get('/sec/rolesetup/{id}/edit', 'editRolePermission')->name('sec.rolesetup.edit');
            Route::get('/sec/rolesetup/{id}/delete', 'deleteRolePermission')->name('sec.rolesetup.delete');
            Route::get('/sec/rolesetup/add', 'addRolePermission')->name('sec.rolesetup.add');
        });  //
    });  //
    // Route::get('/run-migration', function () {
    //     Artisan::call('optimize:clear');

    //     Artisan::call('migrate:refresh --seed');
    //     return "Migration executed successfully";
    // });

    // Route::get('echarts', [EchartController::class,'echart']);


    // Route::get("/charts/piechart", "Controller@Piechart");

});
