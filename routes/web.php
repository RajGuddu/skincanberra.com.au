<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Courses As CoursesFront;
use App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Admin\Services;
use App\Http\Controllers\Admin\ContactUs;
use App\Http\Controllers\Admin\Testimonial;
use App\Http\Controllers\Admin\Cms;
use App\Http\Controllers\Admin\Banner;
use App\Http\Controllers\Admin\RealResult;
use App\Http\Controllers\Admin\HomeContent;
use App\Http\Controllers\Admin\AboutContent;
use App\Http\Controllers\Admin\Products;
use App\Http\Controllers\Admin\Customers;
use App\Http\Controllers\Admin\Appointment;
use App\Http\Controllers\Admin\Courses;
use App\Http\Controllers\Admin\Holidays;
use App\Http\Controllers\Shop;
use App\Http\Controllers\Member;
use App\Http\Controllers\Test;

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

/* Route::get('/', function () {
    return view('home');
}); */
Route::get('/404', function () {
    return view('errors/404');
});
Route::get('/', [Home::class,'index']);
Route::get('services', [Home::class,'services']);
Route::get('service/{id}', [Home::class,'service_list']);
Route::match(['get','post'],'save_appointment_service', [Home::class,'save_appointment_service']);
Route::match(['get','post'],'save_book_appointment_h', [Home::class,'save_book_appointment_h']);
Route::match(['get','post'],'save_contact_us', [Home::class,'save_contact_us']);
Route::get('thank-you', [Home::class,'thank_you']);
Route::get('contact', [Home::class,'contact']);
Route::get('about-us', [Home::class,'about_us']);
Route::get('products', [Home::class,'products']);
Route::get('product/{id}', [Home::class,'product_details']);
Route::get('book-variant/{id}', [Home::class,'book_variant']);
Route::get('book-appointment', [Home::class,'book_an_appointment']);
Route::get('book-appointment/{id}', [Home::class,'book_an_appointment']);
Route::match(['get','post'],'get_variants_by_ajax', [Home::class,'get_variants_by_ajax']);
Route::match(['get','post'],'get_available_time_by_ajax', [Home::class,'get_available_time_by_ajax']);
Route::match(['get','post'],'check_next_availability_by_ajax', [Home::class,'check_next_availability_by_ajax']);
Route::match(['get','post'],'book-online', [Home::class,'book_online']);
Route::match(['get','post'],'booking-form', [Home::class,'booking_form']);
Route::get('booking-success', [Home::class,'booking_success']); // for data update 
Route::get('payment-success', [Home::class,'payment_success']); // for thank you page
Route::get('payment-cancel', [Home::class,'payment_cancel']);
Route::get('courses', [CoursesFront::class,'index']);
Route::get('course-detail', [CoursesFront::class,'course_detail']);


//for testing
Route::get('/viewmail', [Home::class,'viewmail']);
Route::get('/testmail', [Home::class,'testmail']);
Route::match(['get','post'],'add_to_cart', [Shop::class,'add_to_cart']);
Route::match(['get','post'],'remove-item/{id}', [Shop::class,'remove_item']);
Route::get('book48', [Test::class,'book48']);

Route::middleware(['MemberAuth'])->group(function () {
    Route::match(['get','post'],'checkout', [Shop::class,'checkout']);
    Route::get('product-payment-success', [Shop::class,'product_payment_success']); // for data update
    Route::get('member-dashboard', [Member::class,'dashboard']);
    Route::get('member-orders', [Member::class,'orders']);
    Route::match(['get','post'],'member-addresses', [Member::class,'addresses']);
    Route::match(['get','post'],'member-addresses/{id}', [Member::class,'addresses']);
    Route::match(['get','post'],'member-deladdress/{id}', [Member::class,'delete_address']);
    Route::match(['get','post'],'member-profile', [Member::class,'profile']);
    Route::match(['get','post'],'member-changepassword', [Member::class,'change_password']);
    /******************************************Courses****************************************** */
    Route::get('buy-course/{id}', [CoursesFront::class,'buy_course']);
    Route::get('course-payment-success', [CoursesFront::class,'course_payment_success']); // for data update
    Route::get('member-courses', [Member::class,'courses']);
    Route::get('course-video/{id}', [Member::class,'course_video']);

    Route::get('member-logout', [Member::class,'logout']);

    //Download Pdf Secure
    Route::get('/course-pdf/{filename}/{customName}', function ($filename, $customName) {

        $path = storage_path('app/pdf/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }
        // $customName = 'course_'.time().'.pdf';
        return response()->download($path, $customName); 
        /*return response()->file($path)->withHeaders([
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$customName.'"',
        ]);
        return response()->streamDownload(function () use ($path) {
            echo file_get_contents($path);
        }, $customName, [
            'Content-Type' => 'application/pdf',
        ]);*/

    })->name('course.pdf');
});
Route::middleware(['AlreadyloggedMember'])->group(function () {
    Route::match(['get','post'],'member-login', [Member::class,'login']);
    Route::match(['get','post'],'member-register', [Member::class,'register']);
});

// *************************Testing url********************************
Route::get('testcart', [Shop::class,'testcart1']);
Route::get('getcart', [Shop::class,'view_cart']);
Route::get('/pay', [Shop::class, 'pay']);
Route::post('/stripe-payment', [Shop::class, 'payment']);
Route::get('/stripe-success', [Shop::class, '_success']);
Route::get('/stripe-cancel', [Shop::class, 'cancel']);

// *************************End Testing url********************************


Route::middleware(['Authcheck'])->group(function () {
    Route::get('admin/dashboard', [Dashboard::class,'index']);

    /*************************Settings Controllers********************* */
    Route::match(['get','post'], 'admin/settings', [Settings::class,'update_settings']);
    Route::match(['get','post'], 'admin/remove_image', [Settings::class,'remove_image']); //for all modules

    /*************************Services Controllers********************* */
    // Route::match(['get','post'], ADMIN.'-services', [Services::class,'index']);
    Route::match(['get','post'], 'admin/services', [Services::class,'index']);
    Route::match(['get','post'], 'admin/add_service', [Services::class,'add_edit_service']);
    Route::match(['get','post'], 'admin/edit_service/{id}', [Services::class,'add_edit_service']);
    Route::match(['get','post'], 'admin/delete_service/{id}', [Services::class,'delete_service']);
    Route::match(['get','post'], 'admin/variants/{id}', [Services::class,'variants']);
    Route::match(['get','post'], 'admin/variants/{id}/{id2}', [Services::class,'variants']);
    Route::match(['get','post'], 'admin/delete_variants/{id}/{id2}', [Services::class,'delete_variants']);

    /*************************ContactUs Controllers********************* */
    Route::match(['get','post'], 'admin/contact_us', [ContactUs::class,'index']);
    /*************************Testimonials Controllers********************* */
    Route::match(['get','post'], 'admin/testimonials', [Testimonial::class,'index']);
    Route::match(['get','post'], 'admin/add_edit_testimonial', [Testimonial::class,'add_edit_testimonial']);
    Route::match(['get','post'], 'admin/add_edit_testimonial/{id}', [Testimonial::class,'add_edit_testimonial']);
    Route::match(['get','post'], 'admin/delete_testimonial/{id}', [Testimonial::class,'delete_testimonial']);
    /*************************CMS Controllers******************************* */
    Route::match(['get','post'], 'admin/cms', [Cms::class,'index']);
    Route::match(['get','post'], 'admin/add_edit_cms', [Cms::class,'add_edit_cms']);
    Route::match(['get','post'], 'admin/add_edit_cms/{id}', [Cms::class,'add_edit_cms']);
    Route::match(['get','post'], 'admin/delete_cms/{id}', [Cms::class,'delete_cms']);
    /**************************Banner Controllers*********************** */
    Route::match(['get','post'], 'admin/banner', [Banner::class,'index']);
    Route::match(['get','post'], 'admin/add_edit_banner', [Banner::class,'add_edit_banner']);
    Route::match(['get','post'], 'admin/add_edit_banner/{id}', [Banner::class,'add_edit_banner']);
    Route::match(['get','post'], 'admin/delete_banner/{id}', [Banner::class,'delete_banner']);
    /**************************RealResult************************************ */
    Route::match(['get','post'], 'admin/realResult', [RealResult::class,'index']);
    Route::match(['get','post'], 'admin/add_realResult', [RealResult::class,'add_realResult']);
    Route::match(['get','post'], 'admin/edit_realResult/{id}', [RealResult::class,'edit_realResult']);
    Route::match(['get','post'], 'admin/delete_realResult/{id}', [RealResult::class,'delete_realResult']);
    /******************************************HomeContent************************************ */
    Route::match(['get','post'], 'admin/homeContent', [HomeContent::class,'update_content']);
    /******************************************AboutContent************************************ */
    Route::match(['get','post'], 'admin/aboutContent', [AboutContent::class,'update_content']);
    /******************************************Products************************************ */
    Route::match(['get','post'], 'admin/product_category', [Products::class,'product_category']);
    Route::match(['get','post'], 'admin/product_category/{id}', [Products::class,'product_category']);
    Route::match(['get','post'], 'admin/add_edit_pro_category', [Products::class,'add_edit_pro_category']);
    Route::match(['get','post'], 'admin/delete_pro_category/{id}', [Products::class,'delete_pro_category']);

    Route::match(['get','post'], 'admin/products', [Products::class,'index']);
    Route::match(['get','post'], 'admin/add_edit_product', [Products::class,'add_edit_product']);
    Route::match(['get','post'], 'admin/add_edit_product/{id}', [Products::class,'add_edit_product']);
    Route::match(['get','post'], 'admin/add_edit_product/{id}/{id2}', [Products::class,'add_edit_product']);
    Route::match(['get','post'], 'admin/delete_product/{id}', [Products::class,'delete_product']);
    Route::match(['get','post'], 'admin/delete_attr/{id}/{id2}', [Products::class,'delete_attr']);

    /******************************************Customers************************************ */
    Route::get('admin/customers', [Customers::class,'index']);
    Route::get('admin/customer_orders/{id}', [Customers::class,'customer_orders']);
    Route::get('admin/new_orders', [Customers::class,'new_orders']);
    Route::match(['get','post'],'admin/change_order_status', [Customers::class,'change_order_status']);
    Route::get('admin/all_orders', [Customers::class,'all_orders']);
    Route::get('admin/purchased_courses/{id}', [Customers::class,'purchased_courses']);

    /******************************************Appointment************************************ */
    Route::get('admin/appointment', [Appointment::class,'index']);
    Route::match(['get','post'], 'admin/appointment/{id}', [Appointment::class,'index']);
    Route::match(['get','post'],'admin/appointment-list', [Appointment::class,'appointment_list']);
    Route::match(['get','post'],'admin/appointment-list/{id}', [Appointment::class,'appointment_list']);
    Route::match(['get','post'],'admin/delete_appointment/{id}', [Appointment::class,'delete_appointment']);
    Route::match(['get','post'],'admin/search_appointment', [Appointment::class,'search_appointment']);
    Route::match(['get','post'],'admin/search_reset', [Appointment::class,'search_reset']);

    Route::get('admin/get-times-by-date', [Appointment::class,'get_times_by_date']); // ajax

    /*******************************************Courses*************************************** */
    Route::match(['get', 'post'], 'admin/courses', [Courses::class,'index']);
    Route::match(['get', 'post'], 'admin/courses/{id}', [Courses::class,'index']);
    Route::get('admin/delete_course/{id}', [Courses::class,'delete_course']);
    Route::match(['get', 'post'], 'admin/search_course', [Courses::class,'search_course']);
    Route::get('admin/c_search_reset', [Courses::class,'search_reset']);

    /*******************************************Holidays*************************************** */
    Route::match(['get', 'post'], 'admin/holidays', [Holidays::class,'index']);
    Route::match(['get', 'post'], 'admin/holidays/{id}', [Holidays::class,'index']);
    Route::get('admin/delete_holiday/{id}', [Holidays::class,'delete_holiday']);


    /*****************************************Auth Controllers****************************** */
    Route::get('admin/logout', [Auth::class,'logout']);
    Route::match(['get','post'], 'admin/profile', [Auth::class,'edit_profile']);

    /******************************************Pdf******************************************* */
    Route::get('/secure-pdf/{filename}', function ($filename) {

        $path = storage_path('app/pdf/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);

    })->name('secure.pdf');
});
Route::middleware(['Alreadyloggedcheck'])->group(function () {
    Route::match(['get','post'], '/'.ADMIN, [Auth::class,'login']);
});


Route::get('/{any}', [Home::class,'cms']);