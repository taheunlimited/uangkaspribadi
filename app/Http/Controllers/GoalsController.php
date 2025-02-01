<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goals;

class GoalsController extends Controller
{
    //menampilkan form tambah goal
    public function create()
    {
        return view('goals.create');
    }

    //menyimpan data goal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
        ]);

        //simpan data ke database
        Goals::create($validated);

        return redirect()->route('transaction.wallets')->with('success', 'Goal Berhasil Ditambahkan!');
    }

    //menampilkan form edit goals
   public function edit(Goals $goal)
   {
    return view('goals.edit', compact('goal'));
   }

   //update ke goal
   public function update(Request $request, Goals $goal)
   {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'target_amount' => 'required|numeric|min:0',
    ]);

    //update data goal
    $goal->update($validated);

    return redirect()->route('transaction.wallets')->with('success', 'Goal Berhasil Diperbarui!');
   }

   //hapus data goal
   public function destroy(Goals $goal)
   {
    $goal->delete();
    return redirect()->route('transaction.wallets')->with('success', 'Goal Berhasil Dihapus!');
   }
}
