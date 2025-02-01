@extends('transaksi.layouts')

@section('content')
    <h1>Transaction Detail</h1>

    <p><strong>ID:</strong> {{ $transaction->id }}</p>
    <p><strong>Type:</strong> {{ $transaction->type }}</p>
    <p><strong>Amount:</strong> {{ $transaction->amount }}</p>
    <p><strong>Date:</strong> {{ $transaction->date }}</p>
    <p><strong>Description:</strong> {{ $transaction->description }}</p>

    <a href="{{ route('transaction.index') }}">Back to Transactions</a>
@endsection
