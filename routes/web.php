
Route::middleware(['auth'])->group(function() {
    Route::get('/home', function() {
        return view('home');
    })->name('home')
});
