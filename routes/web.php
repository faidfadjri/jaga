    <?php

    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\BarcodeController;
    use App\Http\Controllers\Menu\SikatController;
    use App\Http\Controllers\Menu\VerifController;
    use App\Http\Controllers\MenuController;
    use App\Http\Controllers\PageController;
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


    Route::get('/', [PageController::class, 'index']);
    Route::get('about', [PageController::class, 'about']);


    Route::prefix('admin')->group(function () {
        Route::get('/', [PageController::class, 'record']);
        Route::get('/report', [PageController::class, 'report']);
        Route::get('/user', [PageController::class, 'user']);
    });


    // Menu
    Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index']);
        Route::post('verif/store', [VerifController::class, 'store']);
        Route::post('sikat/store', [SikatController::class, 'store']);
    });

    Route::prefix('auth')->group(function () {
        Route::get('login', fn () => view('auth.login'));
        Route::get('register', fn () => view('auth.register'));
        Route::get('logout', [LoginController::class, 'logout']);

        Route::get('otp', function () {
            $email = session()->get('email') ?? 'test@gmail.com';
            return view('auth.otp', [
                'email' => $email
            ]);
        });

        Route::prefix("verification")->group(function () {
            Route::post('login', [LoginController::class, 'save']);
            Route::post('register', [RegisterController::class, 'save']);
            Route::post('otp', [RegisterController::class, 'emailVerification']);
        });
    });
