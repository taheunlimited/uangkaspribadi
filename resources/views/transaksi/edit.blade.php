@extends('transaksi.layouts')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }
    .container {
        max-width: 600px;
        margin: auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h1 {
        color: #333;
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin: 10px 0 5px;
        font-weight: bold;
    }
    input, textarea, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
    }
    button:hover {
        background-color: #0056b3;
    }
    .alert {
        padding: 10px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .btn {
        padding: 10px 15px;
        margin: 5px 0;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn-danger {
        margin-left: 10px;
        background-color: #007bff;
        color: #fff;
        font-family: comic sans ms;
    }

</style>

<div class="container">
    <h1>Edit Transaksi</h1>
    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Method PUT untuk update -->

        <label for="type">Tipe Transaksi</label>
        <select name="type" id="type">
            <option value="pemasukan" {{ $transaction->type == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
            <option value="pengeluaran" {{ $transaction->type == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
        </select>

        <label for="amount">Jumlah</label>
        <input type="number" name="amount" id="amount" placeholder="Masukan jumlah transaksi" value="{{ $transaction->amount }}" min="0" required>

        <label for="wallets">Jenis Wallet</label>
        <select name="wallets" id="wallets">
            <option value="UangTunai" {{ $transaction->wallets == 'UangTunai' ? 'selected' : '' }}>Uang Tunai</option>
            <option value="UangDigital" {{ $transaction->wallets == 'UangDigital' ? 'selected' : '' }}>Uang Digital</option>
            <option value="ATM" {{ $transaction->wallets == 'ATM' ? 'selected' : '' }}>ATM</option>
        </select>

        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" placeholder="(Opsional)">{{ $transaction->description }}</textarea>

        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="{{ $transaction->date }}" required>

        <button type="submit">Update</button>
        <a href="{{ route('transaction.index') }}" class="btn btn-danger">Kembali</a>
    </form>
</div>
@endsection
