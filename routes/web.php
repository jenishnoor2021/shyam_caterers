<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminFaqController;
use App\Http\Controllers\AdminReelController;
use App\Http\Controllers\AdminTarotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDishesController;
use App\Http\Controllers\AdminEventsController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminCompanyController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\AdminInquiryController;
use App\Http\Controllers\AdminSlidersController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminFunctionController;
use App\Http\Controllers\AdminMealTypeController;
use App\Http\Controllers\AdminMenuItemController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminEventTypeController;
use App\Http\Controllers\AdminTestominalController;
use App\Http\Controllers\AdminCuisineItemsController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AdminCuisineCategoryController;
use App\Models\Gallery;
use App\Models\Reel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [AdminController::class, 'siteHomePage'])->name('site.home');

Route::get('/about', [AdminController::class, 'about'])->name('site.about');
Route::get('/gallerys', [AdminController::class, 'gallery'])->name('site.gallerys');
Route::get('/event/{id}', [AdminController::class, 'event'])->name('site.event');
Route::get('/cuisine/{id}', [AdminController::class, 'cuisine'])->name('site.cuisine');
Route::get('/contact', [AdminController::class, 'contact'])->name('site.contact');
Route::get('/packages', [AdminController::class, 'packages'])->name('site.packages');

Route::post('/contactstore', [AdminController::class, 'storeContact'])->name('storeContact')->middleware('throttle:5,1');

Route::get('/load-gallery', function () {
    $images = Gallery::where('is_active', 1)->inRandomOrder()->take(5)->get();
    return view('sections.gallery', compact('images'));
});

Route::get('/load-reel', function () {
    $reels = Reel::where('is_active', 1)->inRandomOrder()->take(3)->get();
    return view('sections.reel', compact('reels'));
});

Route::get('/load-about-slider', function () {
    return view('sections.about-slider');
});

Route::post('/contactsFind', [EventController::class, 'contactsFind'])->name('contactsFind');
Route::get('/booking', [EventController::class, 'bookingPage']);
Route::get('/booking-form', [EventController::class, 'create']);
Route::post('/booking-form', [EventController::class, 'store'])->name('booking.submit');
Route::get('/bookings/{id}/edit', [EventController::class, 'edit'])->name('bookings.edit');
Route::put('/bookings/{id}', [EventController::class, 'update'])->name('bookings.update');
Route::get('/menu-preparation/{booking}', [EventController::class, 'menuPreparation'])->name('menu.preparation');
Route::post('/menu-preparation/save', [EventController::class, 'menuStore'])->name('menu.store');
Route::post('/menu/add-item', [EventController::class, 'addItem'])->name('menu.addItem');
Route::post('/menu/remove-item', [EventController::class, 'removeItem'])->name('menu.removeItem');
Route::get('/menu/pdf/{booking}', [EventController::class, 'generatePDF'])->name('menu.pdf');



//  for admin registration below comment uncomment karvi and above auth.login ne comment karvi
// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();

// Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/admin/login', function () {
    return view('auth.login');
})->name('admin.login');
Route::post('/login', [AdminController::class, 'login'])->name('login');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'usersession']], function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin');

    Route::get('/profile/{id}', [AdminController::class, 'profiledit'])->name('profile.edit');
    Route::post('/profile/update', [AdminController::class, 'profileUpdate'])->name('profile.update');

    Route::get("admin/company", [AdminCompanyController::class, 'index'])->name('admin.company.index');
    Route::get('admin/company/create', [AdminCompanyController::class, 'create'])->name('admin.company.create');
    Route::post('admin/company/store', [AdminCompanyController::class, 'store'])->name('admin.company.store');
    Route::get('admin/company/edit/{id}', [AdminCompanyController::class, 'edit'])->name('admin.company.edit');
    Route::patch('admin/company/update/{id}', [AdminCompanyController::class, 'update'])->name('admin.company.update');
    Route::get('admin/company/destroy/{id}', [AdminCompanyController::class, 'destroy'])->name('admin.company.destroy');
    Route::post("admin/company/active", [AdminCompanyController::class, 'statusUpdate'])->name('admin.company.active');


    Route::get("admin/slider", [AdminSlidersController::class, 'index'])->name('admin.slider.index');
    Route::get('admin/slider/create', [AdminSlidersController::class, 'create'])->name('admin.slider.create');
    Route::post('admin/slider/store', [AdminSlidersController::class, 'store'])->name('admin.slider.store');
    Route::get('admin/slider/edit/{id}', [AdminSlidersController::class, 'edit'])->name('admin.slider.edit');
    Route::patch('admin/slider/update/{id}', [AdminSlidersController::class, 'update'])->name('admin.slider.update');
    Route::get('admin/slider/destroy/{id}', [AdminSlidersController::class, 'destroy'])->name('admin.slider.destroy');
    Route::post("admin/slider/active", [AdminSlidersController::class, 'statusUpdate'])->name('admin.slider.active');

    Route::get("admin/dishes", [AdminDishesController::class, 'index'])->name('admin.dishes.index');
    Route::get('admin/dishes/create', [AdminDishesController::class, 'create'])->name('admin.dishes.create');
    Route::post('admin/dishes/store', [AdminDishesController::class, 'store'])->name('admin.dishes.store');
    Route::get('admin/dishes/edit/{id}', [AdminDishesController::class, 'edit'])->name('admin.dishes.edit');
    Route::patch('admin/dishes/update/{id}', [AdminDishesController::class, 'update'])->name('admin.dishes.update');
    Route::get('admin/dishes/destroy/{id}', [AdminDishesController::class, 'destroy'])->name('admin.dishes.destroy');
    Route::post("admin/dishes/active", [AdminDishesController::class, 'statusUpdate'])->name('admin.dishes.active');

    Route::get("admin/events", [AdminEventsController::class, 'index'])->name('admin.events.index');
    Route::get('admin/events/create', [AdminEventsController::class, 'create'])->name('admin.events.create');
    Route::post('admin/events/store', [AdminEventsController::class, 'store'])->name('admin.events.store');
    Route::get('admin/events/edit/{id}', [AdminEventsController::class, 'edit'])->name('admin.events.edit');
    Route::patch('admin/events/update/{id}', [AdminEventsController::class, 'update'])->name('admin.events.update');
    Route::get('admin/events/destroy/{id}', [AdminEventsController::class, 'destroy'])->name('admin.events.destroy');
    Route::post("admin/events/active", [AdminEventsController::class, 'statusUpdate'])->name('admin.events.active');

    Route::get("admin/function", [AdminFunctionController::class, 'index'])->name('admin.function.index');
    Route::get('admin/function/create', [AdminFunctionController::class, 'create'])->name('admin.function.create');
    Route::post('admin/function/store', [AdminFunctionController::class, 'store'])->name('admin.function.store');
    Route::get('admin/function/edit/{id}', [AdminFunctionController::class, 'edit'])->name('admin.function.edit');
    Route::patch('admin/function/update/{id}', [AdminFunctionController::class, 'update'])->name('admin.function.update');
    Route::get('admin/function/destroy/{id}', [AdminFunctionController::class, 'destroy'])->name('admin.function.destroy');
    Route::post("admin/function/active", [AdminFunctionController::class, 'statusUpdate'])->name('admin.function.active');

    Route::get("admin/meal", [AdminMealTypeController::class, 'index'])->name('admin.meal.index');
    Route::get('admin/meal/create', [AdminMealTypeController::class, 'create'])->name('admin.meal.create');
    Route::post('admin/meal/store', [AdminMealTypeController::class, 'store'])->name('admin.meal.store');
    Route::get('admin/meal/edit/{id}', [AdminMealTypeController::class, 'edit'])->name('admin.meal.edit');
    Route::patch('admin/meal/update/{id}', [AdminMealTypeController::class, 'update'])->name('admin.meal.update');
    Route::get('admin/meal/destroy/{id}', [AdminMealTypeController::class, 'destroy'])->name('admin.meal.destroy');
    Route::post("admin/meal/active", [AdminMealTypeController::class, 'statusUpdate'])->name('admin.meal.active');

    Route::get("admin/event-type", [AdminEventTypeController::class, 'index'])->name('admin.event-type.index');
    Route::get('admin/event-type/create', [AdminEventTypeController::class, 'create'])->name('admin.event-type.create');
    Route::post('admin/event-type/store', [AdminEventTypeController::class, 'store'])->name('admin.event-type.store');
    Route::get('admin/event-type/edit/{id}', [AdminEventTypeController::class, 'edit'])->name('admin.event-type.edit');
    Route::patch('admin/event-type/update/{id}', [AdminEventTypeController::class, 'update'])->name('admin.event-type.update');
    Route::get('admin/event-type/destroy/{id}', [AdminEventTypeController::class, 'destroy'])->name('admin.event-type.destroy');
    Route::post("admin/event-type/active", [AdminEventTypeController::class, 'statusUpdate'])->name('admin.event-type.active');

    Route::get("admin/category", [AdminCategoryController::class, 'index'])->name('admin.category.index');
    Route::get('admin/category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('admin/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::patch('admin/category/update/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::get('admin/category/destroy/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::post("admin/category/active", [AdminCategoryController::class, 'statusUpdate'])->name('admin.category.active');

    Route::get('admin/import-category', [AdminCategoryController::class, 'importPage'])->name('admin.category.import');
    Route::post('admin/import-category-store', [AdminCategoryController::class, 'importStore'])->name('admin.category.import-store');

    Route::get("admin/menu-item", [AdminMenuItemController::class, 'index'])->name('admin.menu-item.index');
    Route::get('admin/menu-item/create', [AdminMenuItemController::class, 'create'])->name('admin.menu-item.create');
    Route::post('admin/menu-item/store', [AdminMenuItemController::class, 'store'])->name('admin.menu-item.store');
    Route::get('admin/menu-item/edit/{id}', [AdminMenuItemController::class, 'edit'])->name('admin.menu-item.edit');
    Route::patch('admin/menu-item/update/{id}', [AdminMenuItemController::class, 'update'])->name('admin.menu-item.update');
    Route::get('admin/menu-item/destroy/{id}', [AdminMenuItemController::class, 'destroy'])->name('admin.menu-item.destroy');
    Route::post("admin/menu-item/active", [AdminMenuItemController::class, 'statusUpdate'])->name('admin.menu-item.active');

    Route::get('admin/import-item', [AdminMenuItemController::class, 'importPage'])->name('admin.menu-item.import');
    Route::post('admin/import-item-store', [AdminMenuItemController::class, 'importStore'])->name('admin.menu-item.import-store');

    Route::get("admin/album", [AdminGalleryController::class, 'index'])->name('admin.album.index');
    Route::get('admin/album/create', [AdminGalleryController::class, 'create'])->name('admin.album.create');
    Route::post('admin/album/store', [AdminGalleryController::class, 'store'])->name('admin.album.store');
    Route::get('admin/album/edit/{id}', [AdminGalleryController::class, 'edit'])->name('admin.album.edit');
    Route::patch('admin/album/update/{id}', [AdminGalleryController::class, 'update'])->name('admin.album.update');
    Route::get('admin/album/destroy/{id}', [AdminGalleryController::class, 'destroy'])->name('admin.album.destroy');
    Route::post("admin/album/active", [AdminGalleryController::class, 'statusUpdate'])->name('admin.album.active');

    Route::get("admin/booking-list", [AdminBookingController::class, 'index'])->name('admin.booking.index');
    Route::get('admin/booking/destroy/{id}', [AdminBookingController::class, 'destroy'])->name('admin.booking.destroy');
    Route::post('/admin/bookings/bulk-delete', [AdminBookingController::class, 'bulkDelete'])->name('admin.booking.bulkDelete');

    Route::get("admin/contact", [AdminContactController::class, 'index'])->name('admin.contact.index');
    Route::get('admin/contact/create', [AdminContactController::class, 'create'])->name('admin.contact.create');
    Route::post('admin/contact/store', [AdminContactController::class, 'store'])->name('admin.contact.store');
    Route::get('admin/contact/edit/{id}', [AdminContactController::class, 'edit'])->name('admin.contact.edit');
    Route::patch('admin/contact/update/{id}', [AdminContactController::class, 'update'])->name('admin.contact.update');
    Route::get('admin/contact/destroy/{id}', [AdminContactController::class, 'destroy'])->name('admin.contact.destroy');
    Route::post("admin/contact/active", [AdminContactController::class, 'statusUpdate'])->name('admin.contact.active');
    Route::post('/admin/contact/bulk-delete', [AdminContactController::class, 'bulkDelete'])->name('admin.contact.bulkDelete');

    Route::get("admin/reel", [AdminReelController::class, 'index'])->name('admin.reel.index');
    Route::get('admin/reel/create', [AdminReelController::class, 'create'])->name('admin.reel.create');
    Route::post('admin/reel/store', [AdminReelController::class, 'store'])->name('admin.reel.store');
    Route::get('admin/reel/edit/{id}', [AdminReelController::class, 'edit'])->name('admin.reel.edit');
    Route::patch('admin/reel/update/{id}', [AdminReelController::class, 'update'])->name('admin.reel.update');
    Route::get('admin/reel/destroy/{id}', [AdminReelController::class, 'destroy'])->name('admin.reel.destroy');
    Route::post("admin/reel/active", [AdminReelController::class, 'statusUpdate'])->name('admin.reel.active');

    Route::get("admin/cuisine_category", [AdminCuisineCategoryController::class, 'index'])->name('admin.cuisine_category.index');
    Route::get('admin/cuisine_category/create', [AdminCuisineCategoryController::class, 'create'])->name('admin.cuisine_category.create');
    Route::post('admin/cuisine_category/store', [AdminCuisineCategoryController::class, 'store'])->name('admin.cuisine_category.store');
    Route::get('admin/cuisine_category/edit/{id}', [AdminCuisineCategoryController::class, 'edit'])->name('admin.cuisine_category.edit');
    Route::patch('admin/cuisine_category/update/{id}', [AdminCuisineCategoryController::class, 'update'])->name('admin.cuisine_category.update');
    Route::get('admin/cuisine_category/destroy/{id}', [AdminCuisineCategoryController::class, 'destroy'])->name('admin.cuisine_category.destroy');
    Route::post("admin/cuisine_category/active", [AdminCuisineCategoryController::class, 'statusUpdate'])->name('admin.cuisine_category.active');

    Route::get("admin/cuisine_items", [AdminCuisineItemsController::class, 'index'])->name('admin.cuisine_items.index');
    Route::get('admin/cuisine_items/create', [AdminCuisineItemsController::class, 'create'])->name('admin.cuisine_items.create');
    Route::post('admin/cuisine_items/store', [AdminCuisineItemsController::class, 'store'])->name('admin.cuisine_items.store');
    Route::get('admin/cuisine_items/edit/{id}', [AdminCuisineItemsController::class, 'edit'])->name('admin.cuisine_items.edit');
    Route::patch('admin/cuisine_items/update/{id}', [AdminCuisineItemsController::class, 'update'])->name('admin.cuisine_items.update');
    Route::get('admin/cuisine_items/destroy/{id}', [AdminCuisineItemsController::class, 'destroy'])->name('admin.cuisine_items.destroy');
    Route::post("admin/cuisine_items/active", [AdminCuisineItemsController::class, 'statusUpdate'])->name('admin.cuisine_items.active');
});

//Clear Cache facade value:
Route::get('/admin/clear-cache', function () {
    Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/admin/optimize', function () {
    Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/admin/route-cache', function () {
    Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/admin/route-clear', function () {
    Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/admin/view-clear', function () {
    Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/admin/config-cache', function () {
    Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
