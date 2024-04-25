@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between align-items-center">
    <h1>Daftar Pengeluaran</h1>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Tambah</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenses as $expense)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $expense->expense_date }}</td>
            <td>{{ $expense->type }}</td>
            <td>{{ $expense->description }}</td>
            <td>Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
            <td>
            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning">Edit</a>
                <form id="deleteForm{{ $expense->id }}" action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $expense->id }}')">Delete</button>
            </form>
            <script>
                function confirmDelete(expenseId) {
                    if (confirm('Apakah yakin untuk menghapus pengeluaran ini?')) {
                        document.getElementById('deleteForm' + expenseId).submit();
                    }
                }
            </script>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
