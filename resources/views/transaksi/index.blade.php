@extends('transaksi.layouts')

@section('content')
<style>
    body {
    margin: 0px;
    padding: 0px;
    font-family: 'Open Sans ',sans-serif;
    }
    h1 {
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }
    .btn {
        padding: 10px 15px;
        margin: 5px 0;
        text-decoration: none;
        border-radius: 5px;
    }
    .btn-success {
        margin-left: 10px;
        background-color: #007bff;
        color: #fff;
        font-family: comic sans ms;
    }
    .btn-danger {
        margin-left: 10px;
        background-color: #007bff;
        color: #fff;
        font-family: comic sans ms;
    }
    .btn-warning {
        margin-left: 10px;
        background-color: #007bff;
        color: #fff;
        font-family: comic sans ms;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }
    .table th {
        background-color: #f8f9fa;
        color: #333;
    }
    .table tr:hover {
        background-color: #f1f1f1;
    }
    .alert {
        padding: 10px;
        margin-top:30px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .wrapper {
        width: 100%;
        max-width: 1400px;
        margin: auto;
        position: relative;
    }

    .logo a {
        font-size: 50px;
        font-weight: bold;
        float: left;
        font-family: comic sans ms;
        color: white;
    }
    .logo a.active {
        text-decoration:none;
    }

    .menu {
        float: right;
    }

    nav {
        width: 100%;
        margin: auto;
        display: flex;
        line-height: 80px;
        position: sticky;
        position: -webkit-sticky;
        background: #1E2A5E;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    nav ul li {
        float: left;
    }

    nav ul li a {
        display: inline-block;
        color: white;
        font-weight: bold;
        text-align: center;
        padding: 0px 16px 0px 16px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    nav ul li a:hover {
        background-color:rgb(23, 30, 61) ;
    }
</style>

<nav>
    <div class = "wrapper">
        <div class="logo"><a href="{{ route('transaction.index') }}" class="active">Transaksi</a></div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('transaction.index') }}">Transaksi</a></li>
                <li><a href="{{ route('transaction.wallets') }}">Dompet</a></li>
            </ul>
        </div>
    </div>
</nav>

<h1></h1>
    <a href="{{ route('transaction.income') }}" class="btn btn-success">Tambah Pemasukan</a>
    <a href="{{ route('transaction.expense') }}" class="btn btn-danger">Tambah Pengeluaran</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($transaction->isEmpty())
    <!-- Tampilkan teks jika tidak ada transaksi -->
    <div style="
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
        text-align: center;
        font-family:comic sans ms;
        font-size: 50px;
        color: rgb(182, 182, 182);
        ">
        <p>BELUM ADA TRANSAKSI</p>
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Jenis Transaksi</th>
                <th>Jumlah</th>
                <th>Dompet</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction as $transactions)
                <tr>
                    <td>{{ str_pad($transactions->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $transactions->type }}</td>
                    <td>
                        @if ($transactions->type == 'Pemasukan')
                            <span style="color: green;">+Rp{{ number_format($transactions->amount, 0, ',', '.') }}</span>
                        @elseif ($transactions->type == 'Pengeluaran')
                            <span style="color: red;">-Rp{{ number_format($transactions->amount, 0, ',', '.') }}</span>
                        @endif
                    </td>
                    <td>{{ $transactions->wallets }}</td>
                    <td>{{ $transactions->description }}</td>
                    <td>{{ $transactions->date }}</td>
                    <td>
                        <a href="{{ route('transaction.edit', $transactions->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('transaction.destroy', $transactions->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
