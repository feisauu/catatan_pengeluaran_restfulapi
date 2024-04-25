@extends('layouts.main')

@section('container')
<div class="container">
    <h1>Catat Pengeluaran</h1>
    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Kategori</label>
            <input type="text" class="form-control" id="type" name="type" placeholder="Type" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
        </div>
        <div class="form-group">
            <label for="amount">Jumlah</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" required>
        </div>
        <div class="form-group">
            <label for="expense_date">Tanggal</label>
            <input type="date" class="form-control" id="expense_date" name="expense_date" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<style>
    .form-group {
        margin-bottom: 20px; /* Jarak antar kolom */
    }
</style>
@endsection
