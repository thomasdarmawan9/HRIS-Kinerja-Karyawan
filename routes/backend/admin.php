<?php

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Admin
Route::get('/profile', 'AdminController@profile')->name('profile');
Route::get('/edit_profile', 'AdminController@edit')->name('edit');
Route::patch('/edit_profile', 'AdminController@update')->name('update');
Route::get('/change_password', 'AdminController@change_password')->name('password_change');
Route::patch('/change_password', 'AdminController@update_password')->name('change_password');


/* ===== Blog Start =========== */

// kinerja Controller
Route::resource('kinerja', 'KinerjaController');
Route::get('/allPenilaian', 'KinerjaController@getAll')->name('allPenilaian');
Route::post('/storeNilai', 'KinerjaController@storeNilai')->name('storeNilai');
Route::delete('/deleteFaktor/{id}', 'KinerjaController@deleteFaktor');

/* ===== kinerja End =========== */

/* ===== Laporan PKK End =========== */
Route::resource('laporanPKK', 'LaporanpkkController');
Route::get('/allLaporanPKK', 'LaporanpkkController@getAll')->name('allLaporanPKK');

/* ===== Access Management Start =========== */
Route::resource('users', 'UserController');
Route::get('/allUser', 'UserController@getAll')->name('allUser.users');
Route::get('/export', 'UserController@export')->name('export');

Route::resource('permissions', 'PermissionController');
Route::get('/allPermissions', 'PermissionController@getAll')->name('allPermissions');

Route::resource('roles', 'RoleController');
Route::get('/allRoles', 'RoleController@getAll')->name('allRoles');

// DEPARTMENT ROUTE
Route::resource('departmentseksi', 'DepartmentSeksiController');
Route::get('/allDepartment', 'DepartmentSeksiController@getAllDepartment')->name('allDepartment');
Route::get('/createDepartment', 'DepartmentSeksiController@createDepartment')->name('createDepartment');
// SEKSI ROUTE
Route::get('/allSeksi', 'DepartmentSeksiController@getAllSeksi')->name('allSeksi');
Route::get('/createSeksi', 'DepartmentSeksiController@createSeksi')->name('createSeksi');
Route::get('/editSeksi/{id}', 'DepartmentSeksiController@editSeksi')->name('editSeksi');
Route::delete('/deleteSeksi/{id}', 'DepartmentSeksiController@deleteSeksi');

/* ===== Settings Start =========== */

// Settings Controller
Route::resource('settings', 'SettingsController');
Route::get('/allSettings', 'SettingsController@getAll')->name('allSettings');

/* ===== Settings End =========== */

/* ===== Backup Start =========== */

Route::get('backups', 'BackupController@index');
Route::get('allBackups', 'BackupController@getAll')->name('allBackups');
Route::post('backups/db_backup', 'BackupController@db_backup');
Route::post('backups/full_backup', 'BackupController@full_backup');
Route::get('backups/download/{file_name}', 'BackupController@download');
Route::delete('backups/delete/{file_name}', 'BackupController@delete');

/* ===== Backup End =========== */


// Examples

Route::get('/barcode', 'AdminController@barcode');
Route::get('/passport', 'AdminController@passport');