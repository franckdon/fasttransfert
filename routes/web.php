<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\MailTestController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReglementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');



Route::view('/contact-us', 'contact')->name('contact');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/dump-mail-config', [MailTestController::class, 'dumpMailConfig']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/permissions/', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::get('/roles/', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('/articles/', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::post('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/', [ArticleController::class, 'destroy'])->name('articles.destroy');

    Route::get('/users/', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');

    Route::prefix('admin/settings')->group(function () {
        Route::get('/', [GeneralSettingsController::class, 'index'])->name('settings.index');
        Route::get('general', [GeneralSettingsController::class, 'general'])->name('settings.general');
        Route::get('mail', [GeneralSettingsController::class, 'mail'])->name('settings.email');
        Route::post('mail', [GeneralSettingsController::class, 'mailUpdate'])->name('settings.email.update');
        Route::post('general', [GeneralSettingsController::class, 'updateSiteInfo'])->name('settings.general.update');
    });

    Route::get('/companies/', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::post('/companies/{id}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/', [CompanyController::class, 'destroy'])->name('companies.destroy');

    Route::get('reglements', [ReglementController::class, 'index'])->name('reglements.index');
    Route::get('reglements/create', [ReglementController::class, 'create'])->name('reglements.create');
    Route::post('reglements', [ReglementController::class, 'store'])->name('reglements.store');
    Route::get('reglements/{id}/edit', [ReglementController::class, 'edit'])->name('reglements.edit');
    Route::post('reglements/{id}', [ReglementController::class, 'update'])->name('reglements.update');
    Route::delete('reglements/', [ReglementController::class, 'destroy'])->name('reglements.destroy');

    Route::get('/reglements/documents/{id}', [ReglementController::class, 'documents'])->name('reglements.documents');
    Route::post('/reglements/documents/{id}', [ReglementController::class, 'attachDocuments'])->name('reglements.documents.attach');
    Route::delete('/reglements/documents/{id}', [ReglementController::class, 'detachDocuments'])->name('reglements.documents.detach');


    route::get('/reglements/{id}/questions', [QuestionController::class, 'index'])->name('questions.index');
    route::get('/reglements/{id}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    route::post('/reglements/{id}/questions', [QuestionController::class, 'store'])->name('questions.store');
    route::get('/reglements/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    route::post('/reglements/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
    route::delete('/reglements/questions/', [QuestionController::class, 'destroy'])->name('questions.destroy');

    route::get('/documents/', [DocumentController::class, 'index'])->name('documents.index');
    route::get('documents/create', [DocumentController::class, 'create'])->name('documents.create');
    route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
    route::get('documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    route::post('documents/{id}', [DocumentController::class, 'update'])->name('documents.update');
    route::delete('documents/', [DocumentController::class, 'destroy'])->name('documents.destroy');

    route::get('/demandes/', [DemandeController::class, 'index'])->name('demandes.index');
    route::get('/demandes/create', [DemandeController::class, 'create'])->name('demandes.create');
    route::get('/demandes/{id}', [DemandeController::class, 'show'])->name('demandes.show');
    route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');
    route::get('/demandes/{id}/edit', [DemandeController::class, 'edit'])->name('demandes.edit');
    route::post('/demandes/{id}', [DemandeController::class, 'update'])->name('demandes.update');
    route::delete('/demandes/', [DemandeController::class, 'destroy'])->name('demandes.destroy');

    route::get('/domaines/', [DomaineController::class, 'index'])->name('domaines.index');
    route::get('/domaines/create', [DomaineController::class, 'create'])->name('domaines.create');
    route::post('/domaines', [DomaineController::class, 'store'])->name('domaines.store');
    route::get('/domaines/{id}/edit', [DomaineController::class, 'edit'])->name('domaines.edit');
    route::post('/domaines/{id}', [DomaineController::class, 'update'])->name('domaines.update');
    route::delete('/domaines/', [DomaineController::class, 'destroy'])->name('domaines.destroy');


    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity.logs');
});

require __DIR__ . '/auth.php';
