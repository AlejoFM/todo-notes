<?php

use App\Http\Controllers\NotesController;
Use App\Http\Controllers\CategoriesController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('notes/active-notes', [NotesController::class, 'listActiveNotes'])->name("notes.listActive");
Route::get('notes/unactive-notes', [NotesController::class, 'listUnActiveNotes'])->name("notes.listUnActive");
Route::get('notes/filter-notes/{category}', [NotesController::class, 'filterNotes'])->name("notes.filter-notes");

Route::post('notes/{id}/archive', [NotesController::class, 'archiveNote'])->name("notes.archive");
Route::post('notes/{id}/unarchive', [NotesController::class, 'unArchiveNote'])->name("notes.unarchive");

Route::post('notes/{id}/add-category', [CategoriesController::class, 'addCategory'])->name("notes.add-category");
Route::delete('notes/{note_id}/remove-category', [CategoriesController::class, 'removeCategory'])->name("notes.remove-category");
Route::resource('categories', CategoriesController::class);

Route::resource('notes', NotesController::class);
