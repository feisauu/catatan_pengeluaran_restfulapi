@extends('layouts.main')

@section('container')
<div class="container mt-5">
    <h1 class="text-center mb-5">Selamat Datang di Catatan Pengeluaran!</h1>

    <!-- Tampilkan total pemasukan -->
    @isset($totalIncomes)
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Total Pemasukan</h3>
                    <p class="card-text">Rp {{ number_format($totalIncomes, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endisset

    <!-- Tampilkan total pengeluaran -->
    @isset($totalExpenses)
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Total Pengeluaran</h3>
                    <p class="card-text">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endisset

    <!-- Tampilkan selisih pemasukan dan pengeluaran -->
    @isset($incomeExpenseDifference)
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Selisih Pemasukan dan Pengeluaran</h3>
                    <p class="card-text">Rp {{ number_format($incomeExpenseDifference, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endisset

</div>
@endsection