@if(
    Route::is('positions.create') ||
    Route::is('positions.edit') ||
    Route::is('contracts.create') ||
    Route::is('contracts.edit')
    )
    @vite(['resources/js/sd-repeater.js'])
@endif
