@extends('layouts.main')

@section('container')
<div class="col-lg-6">
    <h1>New Category</h1>
    <form action="/categories/{{ $category->id }}/update" method="post">
        @csrf
        <table class="table">
            <tr>
                <td>Category Name</td>
                <td>:</td>
                <td><input type="text" name="name" id="name" class="input-group" value="{{ old('name', $category->name) }}"></td>
            </tr>
            <tr>
                <td>Category Type</td>
                <td>:</td>
                <td>
                    @foreach($category_types as $type)
                    <label>
                        <input type="radio" name="category_type_id" value="{{ $type->id }}" 
                        {{-- {{ old('category_type_id') == $type->id ? 'checked' : '' }} --}}
                        {{ $category->category_type->id == $type->id ? 'checked' : '' }}>
                        {{ $type->name }}
                    </label>
                    @endforeach
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Create" class="btn btn-primary ">
    </form>
</div>
@endsection