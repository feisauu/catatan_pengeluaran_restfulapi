@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between align-items-center">
    <h1>Daftar Pemasukan</h1>
    <a href="{{ route('incomes.create') }}" class="btn btn-primary">Tambah</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Sumber</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($incomes as $income)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $income->income_date }}</td>
            <td>{{ $income->source }}</td>
            <td>{{ $income->description }}</td>
            <td>Rp {{ number_format($income->amount, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada pemasukan tercatat.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection