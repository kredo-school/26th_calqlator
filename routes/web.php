<?php 
    
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

      Route::prefix('foods')->group(function () {
        Route::get('/', [FoodsController::class, 'index'])->name('foods.index');
        Route::get('/create', [FoodsController::class, 'create'])->name('foods.create');
        Route::post('/', [FoodsController::class, 'store'])->name('foods.store');
        Route::get('/{id}/edit', [FoodsController::class, 'edit'])->name('foods.edit');
        Route::put('/{id}', [FoodsController::class, 'update'])->name('foods.update');
        Route::delete('/{id}', [FoodsController::class, 'destroy'])->name('foods.destroy');

        Route::get('/{id}/confirm-edit', [FoodsController::class, 'confirmEdit'])
             ->name('foods.confirm-edit');
        Route::get('/{id}/confirm-delete', [FoodsController::class, 'confirmDelete'])
             ->name('foods.confirm-delete');

      });

      Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'user_list'])->name('users.user_list');
        Route::get('/', [UsersController::class, 'store'])->name('users.store');
        Route::get('create', [UsersController::class, 'store'])->name('users.store');
        Route::post('/', [UsersController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

    });

});


?>