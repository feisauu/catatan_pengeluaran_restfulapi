@extends('layouts.main')
@section('container')

<h1 style="text-align: left">{{ $title }}</h1>

<div class="table-responsive small col-sm-8" style="width: 100%">
<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Roles</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
@foreach ($users as $user)
    <tr>
        @if ($user->name == 'master_admin')
            @continue
        @endif
        <td scope="col">{{ $loop->index }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @foreach ($user->roles->sortBy('name') as $role)
                <span class="badge text-bg-dark">{{ $role->name }}</span>
            @endforeach
        </td>
        <td>
            <a href="/users/{{ $user->id }}/edit" class="btn btn-primary">Edit</a>
        </td>
    </tr>
@endforeach
</table>
</div>

@endsection
