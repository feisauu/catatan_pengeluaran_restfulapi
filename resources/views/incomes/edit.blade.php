@extends('layouts.main')

@section('container')
<div class="container mt-5">
    <h1>Edit Pemasukan</h1>
    <form method="POST" action="{{ route('incomes.update', ['income' => $income->id]) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="source" class="form-label">Sumber</label>
            <input type="text" class="form-control" id="source" name="source" value="{{ $income->source }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $income->description }}">
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah</label>
            <input type="text" class="form-control" id="amount" name="amount" value="{{ $income->amount }}">
        </div>
        <div class="mb-3">
            <label for="income_date" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="income_date" name="income_date" value="{{ $income->income_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Pemasukan</button>
    </form>
</div>
@endsection