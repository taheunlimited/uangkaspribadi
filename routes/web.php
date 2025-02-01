<?php

use App\Http\Controllers\GoalsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Buat route manual untuk index, store, edit, update, destroy
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaction/{transaction}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
Route::put('/transaction/{transaction}', [TransactionController::class, 'update'])->name('transaction.update');
Route::delete('/transaction/{transaction}', [TransactionController::class, 'destroy'])->name('transaction.destroy');

// Tambahkan route untuk income, expense, dan wallets
Route::get('/transaction/income', [TransactionController::class, 'income'])->name('transaction.income');
Route::get('/transaction/expense', [TransactionController::class, 'expense'])->name('transaction.expense');
Route::get('/transaction/wallets', [TransactionController::class, 'wallets'])->name('transaction.wallets');

//tambah goals
Route::get('/goals/create', [GoalsController::class, 'create'])->name('goals.create');
Route::post('/goals', [GoalsController::class, 'store'])->name('goals.store');
Route::get('/goals/{goal}/edit', [GoalsController::class, 'edit'])->name('goals.edit');
Route::put('/goals/{goal}', [GoalsController::class, 'update'])->name('goals.update');
Route::delete('/goals/{goal}', [GoalsController::class, 'destroy'])->name('goals.destroy');



