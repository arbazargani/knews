<?php

locality();

require base_path('routes/routes.php');

Route::group(['prefix' => App::getLocale()], function() {

    require base_path('routes/routes.php');

});