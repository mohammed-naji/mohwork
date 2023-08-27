<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

class GlobalService {

    public static function Routes() {
        Route::get('/' , function() {
            return 'Home';
        });

        Route::get('/about' , function() {
            return 'About';
        });
    }

}
