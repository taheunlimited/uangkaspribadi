@extends('goals.layouts')

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
    <h2>Edit Goal</h2>
    <form action="{{ route('goals.update', $goal) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nama Target</label>
        <textarea name="name" id="name" placeholder="Masukan Nama Target">{{old('name') }}</textarea>
        <label for="target_amount">Jumlah</label>
        <input type="number" name="target_amount" id="target_amount" placeholder="Masukan jumlah transaksi" value="{{ old('target_amount') }}" min="0" required>
        <button type="submit">Update</button>
        <a href="{{ route('transaction.wallets') }}" class="btn btn-danger">Kembali</a>
    </form>
</div>
@endsection
