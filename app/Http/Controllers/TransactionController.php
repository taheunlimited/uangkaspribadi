<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Goals;


class TransactionController extends Controller
{
    public function index()
    {
        //tampilkan semua transaksi
        $transaction = Transaction::all();
        return view('transaksi.index', compact('transaction'));
    }

    public function wallets()
    {
        $transaction = Transaction::all();

        //inisialisasi saldo tiap wallet
        $wallets = [
            'UangTunai' => 0,
            'UangDigital' => 0,
            'ATM' => 0,
        ];

        //Hitung saldo tiap wallet
        foreach ($transaction as $transactions) {
            if (array_key_exists($transactions->wallets, $wallets)) {
                if ($transactions->type == 'Pemasukan') {
                    $wallets[$transactions->wallets] += (float) $transactions->amount;
                } elseif ($transactions->type == 'Pengeluaran') {
                    $wallets[$transactions->wallets] = max(0, $wallets[$transactions->wallets] - (float) $transactions->amount);
                }
            }
        }

        //ambil semua goals
        $goals = Goals::all();

        //hitung progres tiap goal
        foreach ($goals as $goal) {
            $totalSaldo = array_sum($wallets); //total saldo dari semua wallet
            $goal->remaining = max(0, $goal->target_amount - $totalSaldo); //hitung progress berdasarkan kurang berapa lagi
        }

        return view('transaksi.wallets', ['wallets' => $wallets, 'transaction' => $transaction, 'goals' => $goals,]);
    }

    public function income()
    {
        $transaction = Transaction::where('type', 'pemasukan')->get();
        return view('transaksi.income', compact('transaction'));
    }

    public function expense()
    {
        $transaction = Transaction::where('type', 'pengeluaran')->get();
        return view('transaksi.expense', compact('transaction'));
    }

    public function create()
    {

    }
    public function store(Request $request)
    {
        //validasi dan simpan transaksi baru
        $validated = $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:0',
            'wallets' => 'required|in:UangTunai,UangDigital,ATM',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        //hitung saldo saat ini untuk wallet yang di pilih
        $currentBalance = Transaction::where('wallets', $validated['wallets'])
            ->selectRaw("SUM(CASE WHEN type = 'pemasukan' THEN amount ELSE -amount END) as balance")
            ->value('balance') ?? 0;

        //Pengecekan jika saldo wallet adalah 0
        if ($currentBalance == 0) {
            return redirect()->back()->withErrors([
                'amount' => 'Anda tidak memiliki saldo pada dompet ini',
            ])->withInput();
        }

        //cek jika ini adalah pengeluaran dan melebihi saldo
        if ($validated['type'] === 'pengeluaran' && $validated['amount'] > $currentBalance) {
            return redirect()->back()->withErrors([
                'amount' => 'Pengeluaran melebihi saldo! Maksimum pengeluaran: ' . number_format($currentBalance, 2),
            ])->withInput();
        }

        //simpan transaksi jika valid
        Transaction::create($validated);
        
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit(Transaction $transaction)
    {
        //form untuk edit transaksi
        return view('transaksi.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        //validasi dan update transaksi
        $validated = $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:0',
            'wallets' => 'required|in:UangTunai,UangDigital,ATM',
            'description' => 'nullable|string',
        ]);

        $transaction->update($validated);
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy(Transaction $transaction)
    {
        //hapus transaksi dari database
        $transaction->delete();

        //redirect ke halaman index dengan pesan sukses delete
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil di hapus');
    }

    public function show($id)
    {
    $transaction = Transaction::findOrFail($id);
    return view('transaksi.show', compact('transaction'));
    }


}
