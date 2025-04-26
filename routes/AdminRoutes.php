<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\AdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// D A S H B O A R D  P A G E
// Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('dashboard');
Route::get('/dashboard', [AdminController::class, 'Dashboard'])->middleware(['auth', 'verified']);

// V E R I F I C A T I O N  N O T I C E
Route::get('/email/verify', function () {
    return view('Login.Pages.auth-verify-email');
})->middleware(middleware: 'auth')->name('verification-notice');

// R E S E N D  V E R I F I C A T I O N
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification-send');

// E M A I L  V E R I F I C A T I O N
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return redirect()->to('/');
    }

    $request->fulfill(); // Automatically sets email_verified_at
    return redirect()->route('verification-success');
})->middleware(['signed'])->name('verification-verify');

// A C C O U N T  R E Q U E S T  M A I N P A G E
Route::get('/account-request-page', [AdminController::class, 'AccountRequestPage'])->name('account-request-page');

// E V E N T  S C H E D U L E  M A I N P A G E
Route::get('/event-schedule', function () {
    return view('Admin.Pages.Events.event-schedule');
})->name('event-schedule');

// A C C O U N T  A P P R O V E
Route::patch('/account-approve/{id}', [AdminController::class, 'AccountAprrove'])->name('account-approve');

// A C C O U N T  D E C L I N E
Route::get('/account-decline/{id}', [AdminController::class, 'AccountDecline'])->name('account-decline');

// E V E N T  S C H E D U L E  V A L I D A T I O N
Route::post('/event-schedule-validation', [AdminController::class, 'EventScheduleValiation'])->name('event-schedule-validation');

// E V E N T  L I S T  M A I N P A G E
Route::get('/event-list-page', [AdminController::class, 'EventListPage'])->name('event-list-page');

// E V E N T  V I E W  P A G E
Route::get('/event-view-page/{id}', [AdminController::class, 'EventScheduleViewPage'])->name('event-view-page');

// E V E N T  E D I T  P A G E
Route::get('/event-edit-page/{id}', [AdminController::class, 'EventScheduleEditPage'])->name('event-edit-page');

// E V E N T  E D I T  V A L I D A T I O N
Route::put('/event-schedue-edit-validation/{id}', [AdminController::class, 'EventScheduleEditValidation'])->name('event-schedue-edit-validation');

// E V E N T  S A V E D  L I S T  M A I N P A G E
Route::get('/event-saved-list-page', [AdminController::class, 'EventSavedListPage'])->name('event-saved-list-page');

// E V E N T  S A V E D  V I E W  P A G E
Route::get('/event-saved-view-page/{id}', [AdminController::class, 'EventSavedScheduleViewPage'])->name('event-saved-view-page');

// E V E N T  S C H E D U L E  D E L E T E
Route::delete('/event-delete/{id}', [AdminController::class, 'EventScheduleDelete'])->name('event-delete');

// E V E N T S A V E D  S C H E D U L E  D E L E T E
Route::delete('/event-saved-delete/{id}', [AdminController::class, 'EventSavedScheduleDelete'])->name('event-saved-delete');

// E V E N T  P U B L I S H
Route::patch('/publish-event/{id}', [AdminController::class, 'PublishEvent'])->name('publish-event');

// E V E N T  P H O T O S
Route::get('/event-photos', [AdminController::class, 'EventPhotos'])->name('event-photos');

// E V E N T  H I S T O R Y
Route::get('/event-history', [AdminController::class, 'EventHistory'])->name('event-history');

// E V E N T  H I S T O R Y  V I E W
Route::get('/event-history-view/{id}', [AdminController::class, 'EventtHistoryView'])->name('event-history-view');

// E V E N T  H I S T O R Y  V I E W  D E L E T E
Route::delete('/event-history-delete', [AdminController::class, 'EventHistoryDelete'])->name('event-history-delete');

// E V E N T  H I S T O R Y U P L O A D  I M A G E S
Route::patch('/event-history-upload-images/{id}', [AdminController::class, 'EventHistoryUploadImages'])->name('event-history-upload-images');
