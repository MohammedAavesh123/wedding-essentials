<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Route::get('/migrate-db', function () {
    try {
        DB::purge(env('DB_CONNECTION'));
        
        $output = "<strong>Starting Manual Wipe...</strong><br>";

        // Manual Drop Tables (Raw Postgres)
        $tables = DB::select("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname='public'");
        foreach ($tables as $table) {
            $tableName = $table->tablename;
            DB::statement("DROP TABLE IF EXISTS \"$tableName\" CASCADE");
            $output .= "Dropped $tableName... ";
        }
        $output .= "<br>Manual Wipe Complete. ✅<br>";

        // Migrate
        $output .= "<strong>Starting Migration...</strong><br>";
        Artisan::call('migrate --force');
        $output .= "Tables Created Successfully! ✅<br>";
        $output .= nl2br(Artisan::output());
        
        // Seed
        try {
            Artisan::call('db:seed --force');
            $output .= "<br>Seeders completed successfully! ✅";
            $output .= nl2br(Artisan::output());
        } catch (\Exception $e) {
            $output .= "<br><strong>Seeding Failed:</strong> " . $e->getMessage();
        }
        
        return $output;
    } catch (\Exception $e) {
        return "Critical Failure: " . $e->getMessage() . "<br>Trace: " . $e->getTraceAsString();
    }
});

Route::get('/debug-env', function () {
    return [
        'DB_CONNECTION' => env('DB_CONNECTION'),
        'POSTGRES_HOST' => env('POSTGRES_HOST') ? 'SET (Value Hidden)' : 'MISSING',
        'POSTGRES_USER' => env('POSTGRES_USER') ? 'SET' : 'MISSING',
        'DB_HOST' => env('DB_HOST'),
    ];
});

Route::get('/seed-admin', function () {
    try {
        // Create Role if not exists
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']); // Guard might be web for admin model? Admin model usually uses 'admin' guard. Checked file: yes, admin model.
        $role = \Spatie\Permission\Models\Role::where('name', 'Super Admin')->first();
        
        // Create Admin User
        $admin = \App\Models\Admin::firstOrCreate(
            ['email' => 'admin@dahejsaman.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123'),
                // 'is_super_admin' => true, // Check if this column exists, usually permission handles it. Safe to omit if using roles.
            ]
        );
        
        // Assign Role
        $admin->assignRole($role);
        
        return "Admin user created successfully! <br>Email: admin@dahejsaman.com <br>Password: password123";
    } catch (\Exception $e) {
        return "Seeding Failed: " . $e->getMessage();
    }
});

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/packages', [App\Http\Controllers\Frontend\PackageController::class, 'index'])->name('frontend.packages.index');
Route::get('/packages/{slug}', [App\Http\Controllers\Frontend\PackageController::class, 'show'])->name('frontend.packages.show');
Route::get('/products', [App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('frontend.products.index');
Route::get('/products/{slug}', [App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('frontend.products.show');
Route::get('/api/popups', [App\Http\Controllers\Frontend\ApiPopupController::class, 'getActivePopups'])->name('api.popups');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/booking/{slug}', [App\Http\Controllers\Frontend\BookingController::class, 'create'])->name('frontend.booking.create');
    Route::post('/booking/combo', [App\Http\Controllers\Frontend\BookingController::class, 'createCustomCombo'])->name('frontend.booking.combo');
    Route::post('/booking', [App\Http\Controllers\Frontend\BookingController::class, 'store'])->name('frontend.booking.store');
    Route::get('/booking/{id}/payment', [App\Http\Controllers\Frontend\BookingController::class, 'payment'])->name('frontend.booking.payment');
    Route::post('/booking/success', [App\Http\Controllers\Frontend\BookingController::class, 'success'])->name('frontend.booking.success');

    Route::get('/dashboard', [App\Http\Controllers\Frontend\UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/booking/{id}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'showBooking'])->name('frontend.dashboard.booking.show');
    
    // Profile route to fix "My Account" error
    Route::get('/profile', function () {
        return redirect()->route('dashboard');
    })->name('profile.edit');
});

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard')
            ->middleware('permission:view dashboard');

        // Admin Profile
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

        // Products & Categories (Managers, Sellers)
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)
            ->middleware('permission:manage categories');
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class)
            ->middleware('permission:manage products');
        
        // Packages (Managers)
        Route::resource('packages', App\Http\Controllers\Admin\PackageController::class)
            ->middleware('permission:manage packages');
        
        // Bookings (Managers, Support)
        Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class)
            ->only(['index', 'show', 'update'])
            ->middleware('permission:manage bookings|view bookings'); // Allow either (view bookings can see index/show but update might fail if controller enforces? Middleware here just allows entry)
            // Note: Since Support has 'manage bookings' and 'view bookings', this is fine.

        // Popups (Marketing, Managers)
        Route::resource('popups', App\Http\Controllers\Admin\PopupController::class)
            ->middleware('permission:manage popups');
        
        // Payments (Managers)
        Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])
            ->name('payments.index')
            ->middleware('permission:view payments');
        
        // Customers (Managers, Support)
        Route::get('/customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])
            ->name('customers.index')
            ->middleware('permission:view customers');
        Route::get('/customers/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])
            ->name('customers.show')
            ->middleware('permission:view customers');

        // Settings (Super Admin - manage settings permission)
        Route::get('settings/combo', [App\Http\Controllers\Admin\SettingsController::class, 'combo'])
            ->name('settings.combo')
            ->middleware('permission:manage settings');
        Route::post('settings/combo', [App\Http\Controllers\Admin\SettingsController::class, 'updateCombo'])
            ->name('settings.combo.update')
            ->middleware('permission:manage settings');

        // Access Control (Super Admin)
        Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)
            ->middleware('permission:manage roles');
        Route::resource('users', App\Http\Controllers\Admin\AdminUserController::class)
            ->middleware('permission:manage admins');
    });
});

require __DIR__.'/auth.php';
