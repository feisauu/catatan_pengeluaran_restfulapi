@extends('layouts.main')

@section('container')
   
<h1 style="text-align: left">Categories</h1>
<a href="/categories/create" class="btn btn-primary ">Create Category</a>
<div class="table-responsive small col-lg-8">
<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>No.</th>
            <th>Category</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
@foreach ($categories as $category)
    <tr>
        {{-- @if ($user->name == 'master_admin')
            @continue
        @endif --}}
        <td>{{ $loop->iteration }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->category_type->name }}</td>
        
        <td>
            <a href="/categories/{{ $category->id }}/edit" class="btn btn-primary">Edit</a>
        </td>
    </tr>
@endforeach
</table>
</div>

@endsection