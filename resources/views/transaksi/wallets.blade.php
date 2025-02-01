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

    .balance-container {
    margin-top: 30px;
    padding: 20px;
    text-align: center;
    font-family: 'Comic Sans MS', sans-serif;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: #333;
    width: 50%;
    margin: 30px auto;
    }

    .balance-container h2 {
        margin: 0;
        font-size: 24px;
        color: #1E2A5E;
    }

    .balance-container span {
        display: block;
        margin-top: 10px;
        font-size: 28px;
        font-weight: bold;
        color: #28a745;
    }

    .balance-container span.zero {
    color: #999; /* Warna abu-abu untuk menandakan saldo habis */
    font-weight: bold;
    }




</style>

<nav>
    <div class="wrapper">
        <div class="logo"><a href="{{ route('transaction.index') }}" class="active">Dompet</a></div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('transaction.index') }}">Transaksi</a></li>
                <li><a href="{{ route('transaction.wallets') }}">Dompet</a></li>
            </ul>
        </div>
    </div>
</nav>

<h1></h1>

<div class="balance-container">
    <h2>Saldo Tiap Dompet</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Dompet</th>
                <th>Total Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wallets as $wallet => $saldo)
                <tr>
                    <td>{{ $wallet }}</td>
                    <td>
                        <span class="{{ $saldo == 0 ? 'zero' : 'positive' }}">
                            Rp{{ number_format((float)$saldo, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
        @php
            $totalIncome = 0;
            $totalExpense = 0;
        @endphp
        @foreach($transaction as $transactions)
            @php
                if ($transactions->type == 'Pemasukan') {
                    $totalIncome += $transactions->amount;
                } else if ($transactions->type == 'Pengeluaran') {
                    $totalExpense -= $transactions->amount;
                }
            @endphp
        @endforeach
    </tbody>
</table>

<div class="balance-container">
    <h2>Saldo Anda</h2>
    <p style="color: green;"><strong>Total Pemasukan : </strong> +Rp{{ number_format($totalIncome, 0, ',', '.') }}</p>
    <p style="color: red;"><strong>Total Pengeluaran : </strong> -Rp{{ number_format(abs($totalExpense), 0, ',', '.') }}</p>
    <p style="font-size: 40px;"><strong>Total Saldo : </strong> Rp{{ number_format($totalIncome + $totalExpense, 0, ',', '.') }}</p>
</div>

<a style="margin-left: 370px;" href="{{ route('goals.create') }}" class="btn btn-success">Tambah Goals</a>
<div class="balance-container">
    <h2>Daftar Goals</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Goal</th>
                <th>Target</th>
                <th>Progress</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($goals as $goal)
                <tr>
                    <td>{{ $goal->name }}</td>
                    <td>Rp{{ number_format($goal->target_amount, 0, ',', '.') }}</td>
                    <td>
                        @if ($goal->remaining > 0)
                            <span style="color: red;"class="text-danger">-Rp{{ number_format($goal->remaining, 0, ',', '.') }}</span>
                        @else
                            <span style="color: green;" class="text-success">Tercapai!</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('goals.edit', $goal->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus goals ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection