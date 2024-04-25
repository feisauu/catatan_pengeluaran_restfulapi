@extends('layouts.main')

@section('container')
<div class="container">
    <h1>Catat Pemasukan</h1>
    <form action="{{ route('incomes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="source">Sumber</label>
            <input type="text" class="form-control" id="source" name="source" placeholder="Source" required>
        </div>
        <div class="form-group">
            <label for="description">Keterangan</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
        </div>
        <div class="form-group">
            <label for="amount">Jumlah</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" required>
        </div>
        <div class="form-group">
            <label for="income_date">Tanggal</label>
            <input type="date" class="form-control" id="income_date" name="income_date" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<style>
    .form-group {
        margin-bottom: 20px;
        /* Jarak antar kolom */
    }
</style>
@endsection