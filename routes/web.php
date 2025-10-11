<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Mds\Setting\BookingStatusController;
use App\Http\Controllers\GeneralSettings\AttachmentController;
use App\Http\Controllers\Bbs\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Bbs\Admin\UserController as AdminUserController;
use App\Http\Controllers\Bbs\Setting\EventController;
use App\Http\Controllers\Mds\Auth\AdminController as AuthAdminController;
use App\Http\Controllers\Bbs\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Mds\Customer\UserController as CustomerUserController;
use App\Http\Controllers\Mds\Manager\BookingController as ManagerBookingController;
use App\Http\Controllers\Mds\Manager\UserController as ManagerUserController;
use App\Http\Controllers\Mds\Setting\AppSettingController;
use App\Http\Controllers\Mds\Setting\EventImageController;
use App\Http\Controllers\Bbs\Setting\ServiceController;
use App\Http\Controllers\Mds\Setting\ServiceImageController;
use App\Http\Controllers\StatusController;

use App\Http\Controllers\Bbs\Setting\VenueController;
use App\Http\Controllers\PaymentController;
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

// 'XssSanitizer'

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::middleware(['auth', 'otp', 'mutli.event', 'role:SuperAdmin', 'prevent-back-history', 'auth.session'])->group(function () {


        // Broadcast Booking Routes
        Route::controller(AdminBookingController::class)->group(function () {
            Route::get('/bbs/admin/booking', 'index')->name('bbs.admin.booking');
            Route::get('/bbs/admin/booking/list', 'list')->name('bbs.admin.booking.list');
            Route::get('/bbs/admin/booking/detail/{id}', 'detail')->name('bbs.admin.booking.detail');
            Route::delete('/bbs/admin/booking/delete/{id}',  'deleteBooking')->name('bbs.admin.booking.delete');
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


        Route::controller(ServiceController::class)->group(function () {
            Route::get('/bbs/setting/service', 'index')->name('bbs.setting.service');
            Route::get('/bbs/setting/service/list', 'list')->name('bbs.setting.service.list');
            Route::get('/bbs/setting/service/get/{id}', 'get')->name('bbs.setting.service.get');
            Route::get('/bbs/setting/service/create', 'create')->name('bbs.setting.service.create');
            // Route::post('bbs/setting/service/update', 'update')->name('bbs.setting.service.update');
            Route::delete('/bbs/setting/service/delete/{id}',  'delete')->name('bbs.setting.service.delete');
            // Route::post('/bbs/setting/service/store', 'store')->name('bbs.setting.service.store');
            Route::post('bbs/service/status/update', 'updateStatus')->name('bbs.service.status.update');
            Route::get('bbs/service/status/edit/{id}', 'editStatus')->name('mds.service.status.edit');
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

        // // Functional Area
        // Route::controller(FunctionalAreaController::class)->group(function () {
        //     Route::get('/bbs/setting/funcareas', 'index')->name('bbs.setting.funcareas');
        //     Route::get('/bbs/setting/funcareas/list', 'list')->name('bbs.setting.funcareas.list');
        //     Route::get('/bbs/setting/funcareas/get/{id}', 'get')->name('bbs.setting.funcareas.get');
        //     Route::post('/bbs/setting/funcareas/update', 'update')->name('bbs.setting.funcareas.update');
        //     Route::delete('/bbs/setting/funcareas/delete/{id}', 'delete')->name('bbs.setting.funcareas.delete');
        //     Route::post('/bbs/setting/funcareas/store', 'store')->name('bbs.setting.funcareas.store');
        // });

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

        //Booking Status
        // Route::controller(BookingStatusController::class)->group(function () {
        //     Route::get('/mds/setting/status/booking', 'index')->name('mds.setting.status.booking');
        //     Route::get('/mds/setting/status/booking/list', 'list')->name('mds.setting.status.booking.list');
        //     Route::get('/mds/setting/status/booking/get/{id}', 'get')->name('mds.setting.status.booking.get');
        //     Route::post('mds/setting/status/booking/update', 'update')->name('mds.setting.status.booking.update');
        //     Route::delete('/mds/setting/status/booking/delete/{id}', 'delete')->name('mds.setting.status.booking.delete');
        //     Route::post('/mds/setting/status/booking/store', 'store')->name('mds.setting.status.booking.store');
        // });

        Route::controller(AdminUserController::class)->group(function () {
            Route::get('/bbs/admin/users/profile', 'profile')->name('bbs.admin.users.profile');
            Route::post('/bbs/admin/users/profile/update', 'update')->name('bbs.admin.users.profile.update');
            Route::post('/bbs/admin/users/profile/password/update', 'updatePassword')->name('bbs.admin.users.profile.password.update');
        });


        // General Settings MANAGEMENT ******************************************************************** Admin All Route
        // company Routes
        // Route::controller(CompanyController::class)->group(function () {
        //     Route::get('/general/settings/company/', 'index')->name('general.settings.company');
        //     Route::post('/general/settings/update', 'update')->name('general.settings.update');
        // });

        // // Address Routes
        // Route::controller(CompanyAddressController::class)->group(function () {
        //     Route::get('/general/settings/address/', 'index')->name('general.settings.address');
        //     Route::get('/general/settings/address/list/{id?}', 'list')->name('general.settings.address.list');
        //     Route::get('/general/settings/address/mv/edit/{id}', 'getAddressEditView')->name('general.settings.address.mv.edit');
        //     Route::post('/general/settings/address/update',  'update')->name('general.settings.address.update');
        //     Route::get('/general/settings/address/add', 'add')->name('general.settings.address.add');
        //     Route::post('/general/settings/address/store', 'store')->name('general.settings.address.store');
        //     Route::get('general/settings/address/delete/{id}', 'delete')->name('general.settings.address.delete');
        // });

        // Currency Routes
        // Route::controller(CurrencyController::class)->group(function () {
        //     Route::get('/general/settings/currency/', 'index')->name('general.settings.currency');
        //     Route::get('/general/settings/currency/list/{id?}', 'list')->name('general.settings.currency.list');
        //     Route::get('/general/settings/currency/get/{id}', 'get')->name('general.settings.currency.get');
        //     Route::post('/general/settings/currency/update',  'update')->name('general.settings.currency.update');
        //     Route::get('/general/settings/currency/add', 'add')->name('general.settings.currency.add');
        //     Route::post('/general/settings/currency/store', 'store')->name('general.settings.currency.store');
        //     Route::get('general/settings/currency/delete/{id}', 'delete')->name('general.settings.currency.delete');
        // });
    });

    // Customer ******************************************************************** user All Route
    Route::middleware(['auth', 'otp', 'mutli.event', 'XssSanitizer', 'role:Customer', 'roles:user', 'prevent-back-history', 'auth.session'])->group(function () {

        // Customer Booking Routes
        Route::controller(CustomerBookingController::class)->group(function () {
            Route::get('/bbs/customer/booking', 'index')->name('bbs.customer.booking');
            Route::get('/bbs/customer/booking/list', 'list')->name('bbs.customer.booking.list');
            Route::get('/bbs/customer/booking/service/list', 'listService')->name('bbs.customer.booking.service.list');
            Route::get('/bbs/customer/booking/detail/{id}', 'detail')->name('bbs.customer.booking.detail');
            Route::get('/bbs/customer/booking/cart', 'cart')->name('bbs.customer.booking.cart');
            Route::delete('/bbs/customer/booking/delete/{id}',  'deleteBooking')->name('bbs.customer.booking.delete');
            Route::post('bbs/customer/booking/cart/store', 'storeService')->name('customer.booking.cart.store');
            Route::get('/bbs/customer/booking/{id}/switch', 'venueSwitch')->name('bbs.customer.booking.switch');
            Route::get('bbs/customer/booking/{id}/switch', 'switch')->name('bbs.customer.booking.switch');

            Route::delete('/bbs/customer/booking/delete/{id}', 'delete')->name('bbs.customer.booking.delete');

            Route::get('/bbs/customer/booking/menu/{id}', 'showServices')->name('bbs.customer.booking.menu.show.services');
            Route::get('/bbs/customer/booking/menu', 'build_menu')->name('bbs.customer.booking.menu');

        });


        Route::controller(CustomerUserController::class)->group(function () {
            Route::get('/mds/customer/users/profile', 'profile')->name('mds.customer.users.profile');
            Route::post('/mds/customer/users/profile/update', 'update')->name('mds.customer.users.profile.update');
            Route::post('/mds/customer/users/profile/password/update', 'updatePassword')->name('mds.customer.users.profile.password.update');
        });
    });

    // // Manager ******************************************************************** user All Route
    // Route::middleware(['auth', 'otp', 'mutli.event', 'XssSanitizer', 'role:Manager', 'roles:user', 'prevent-back-history', 'auth.session'])->group(function () {

    //     // Manager Booking Routes
    //     Route::controller(ManagerBookingController::class)->group(function () {

    //         // booking routes
    //         Route::get('/mds/manager', 'index')->name('mds.manager');
    //         Route::get('/mds/manager/booking', 'index')->name('mds.manager.booking');
    //         Route::get('/mds/manager/booking/list', 'list')->name('mds.manager.booking.list');
    //         Route::get('/mds/manager/booking/schedule/{id}', 'listEvent')->name('mds.manager.booking.schedule'); // for calendar
    //         Route::get('/mds/manager/booking/create', 'create')->name('mds.manager.booking.create');
    //         Route::get('/mds/manager/booking/manage/{id}', 'manage')->name('mds.manager.booking.manage');
    //         Route::get('/mds/manager/booking/get/{id}', 'get')->name('mds.manager.booking.get');
    //         Route::get('/mds/manager/booking/get_times/{date}/{venue_id}', 'get_times')->name('mds.manager.booking.get_times');
    //         Route::get('/mds/manager/booking/times/cal/{date}/{venue_id}', 'get_times_cal')->name('mds.manager.booking.times.cal');
    //         Route::post('mds/manager/booking/update', 'update')->name('mds.manager.booking.update');
    //         Route::get('mds/manager/booking/edit/{id}', 'edit')->name('mds.manager.booking.edit');
    //         Route::delete('/mds/manager/booking/delete/{id}', 'delete')->name('mds.manager.booking.delete');
    //         Route::post('/mds/manager/booking/store', 'store')->name('mds.manager.booking.store');
    //         Route::get('/mds/manager/booking/mv/detail/{id}', 'detail')->name('mds.manager.mv.detail');
    //         Route::get('/mds/manager/booking/pass/pdf/{id?}', 'passPdf')->name('mds.manager.booking.pass.pdf');

    //         Route::get('/mds/manager/events/{id}/switch',  'switch')->name('mds.manager.booking.switch');

    //         Route::get('/mds/manager/dashboard', 'dashboard')->name('mds.manager.dashboard');


    //         Route::get('/mds/manager/booking/confirmation', function () {
    //             return view('/mds/manager/booking/confirmation');
    //         })->name('mds.manager.booking.confirmation');


    //         //Booking note
    //         Route::get('/mds/manager/booking/mv/notes/{id}', 'getNotesView')->name('mds.manager.booking.mv.notes');
    //         Route::post('mds/manager/booking/note/store', 'noteStore')->name('mds.manager.booking.note.store');
    //         Route::delete('mds/manager/booking/note/delete/{id}', 'deleteNote')->name('mds.manager.booking.note.delete');

    //         //Booking file upload
    //         Route::post('mds/manager/booking/file/store', 'fileStore')->name('mds.manager.booking.file.store');
    //         Route::delete('mds/manager/booking/file/{id}/delete', 'fileDelete')->name('mds.manager.booking.file.delete');
    //     });

    //     Route::controller(ManagerUserController::class)->group(function () {
    //         Route::get('/mds/manager/users/profile', 'profile')->name('mds.manager.users.profile');
    //     });
    // });
});


// ****************** ADMIN *********************
Route::group(['middleware' => 'prevent-back-history'], function () {

    // Add User
    Route::get('/mds/auth/signup', [AuthAdminController::class, 'signUp'])->name('mds.auth.signup');
    Route::post('/signup/store', [UserController::class, 'store'])->name('admin.signup.store');

    Route::middleware(['auth', 'prevent-back-history'])->group(function () {

        Route::get('mds/auth/otp', [AuthAdminController::class, 'showOtp'])->name('otp.get');
        Route::post('verify-otp', [AuthAdminController::class, 'verifyOtpAndLogin'])->name('auth.otp.post');
        Route::get('mds/auth/resend', [AuthAdminController::class, 'resendOTP'])->name('otp.resend.get');

        //used to show images in private folder
        Route::get('/doc/{file}', [UtilController::class, 'showImage'])->name('a');

        /*************************************** Play ground */
        // Route::get('/a/{GlobalAttachment}', [UtilController::class, 'serve'])->name('a');
        Route::get('/doc/{file}', [UtilController::class, 'showImage'])->name('a');
        Route::get('/a', function () {
            return response()->file(storage_path('app/private/users/502828276250308124600avatar-2.png'));
        })->name('b');
        /*************************************** End Play ground */

        Route::get('/mds/admin/booking/pick', function () {
            return view('/mds/admin/booking/pick');
        })
            ->name('mds.admin.booking.pick')
            ->middleware('role:SuperAdmin');
        Route::post('/mds/admin/events/switch', [AdminBookingController::class, 'pickEvent'])
            ->name('mds.admin.booking.event.switch')
            ->middleware('role:SuperAdmin');

        Route::get('/bbs/customer/booking/pick', function () {
            return view('/bbs/customer/booking/pick');
        })->name('bbs.customer.booking.pick')->middleware('role:Customer');
        Route::post('/bbs/customer/events/switch', [CustomerBookingController::class, 'pickEvent'])->name('bbs.customer.booking.event.switch')->middleware('role:Customer');

        Route::get('/bbs/logout', [AuthAdminController::class, 'logout'])->name('bbs.logout');

        // Route::get('/bbs/admin/booking/confirmation', function () {
        //     return view('/bbs/admin/booking/confirmation');
        // })->name('bbs.admin.booking.confirmation');

        // Route::get('/mds/booking/pass/pdf/{id}', [BookingController::class, 'passPdf'])->name('mds.booking.pass.pdf');


        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        // Route::get('/mds/users/profile', [UserController::class, 'profile'])->name('mds.users.profile');


        //Status
        Route::get('/mds/setup/status/manage', [StatusController::class, 'index'])->name('mds.setup.status.manage');
        Route::get('/mds/setup/status/list', [StatusController::class, 'list'])->name('mds.setup.status.list');
        Route::get('/mds/setup/status/{id}/get', [StatusController::class, 'get'])->name('mds.setup.status.get');
        Route::post('mds/setup/status/update', [StatusController::class, 'update'])->name('mds.setup.status.update');
        Route::delete('/mds/setup/status/{id}/delete', [StatusController::class, 'delete'])->name('mds.setup.status.delete');
        Route::post('/mds/setup/status/store', [StatusController::class, 'store'])->name('mds.setup.status.store');

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
        Route::get('/mds/auth/login', [AuthAdminController::class, 'login'])->name('mds.auth.login')->middleware('prevent-back-history');

        Route::get('/mds/auth/forgot', [AdminController::class, 'forgotPassword'])->name('mds.auth.forgot');
        Route::post('forget-password', [AdminController::class, 'submitForgetPasswordForm'])->name('forgot.password.post');
        Route::get('tracki/auth/reset/{token}', [AdminController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [AdminController::class, 'submitResetPasswordForm'])->name('reset.password.post');


        // Route::get('/send-mail/nb', [SendMailController::class, 'newBookingEmail']);
        // Route::get('/send-mail', [SendMailController::class, 'index']);
        // Route::get('/send-mail2', [SendMailController::class, 'sendTaskAssignmentEmail']);

        // Route::get('mail', function () {
        //     // $order = App\Order::find(1);
        //     $user = App\Models\User::find(41);
        //     $details = [
        //         'subject' => 'Tracki Notification Center. New task assignment',
        //         'greeting' => 'Hi Raafat,',
        //         'body' => 'task ABC has been assigned to you and ready for some action. chop chop start churning',
        //         'startdate' => 'Start Date: 1/1/2025',
        //         'duedate' => 'Due by: 1/1/2025',
        //         'description' => 'Describe me',
        //         'actiontext' => 'Go to Tracki',
        //         'actionurl' => '/',
        //         'lastline' => 'Please check the task online for any notes or attachments',
        //     ];
        //     // return (new App\Notifications\AnnouncementCenter($details))
        //     //             ->toMail($user);
        //     return (new App\Notifications\NewUserNotification($user))
        //         ->toMail($user);
        // });


        // Route::get('/send', [SendMailController::class, 'sendTaskAssignmentNotifcation']);
        // Route::get('/whatsapp', [CommunicationChannels::class, 'sendWhatsapp'])->name('whatsapp.send');
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
