@extends('layouts.main')
@section('container')

<h1 style="text-align: left">Edit Data</h1>

<form action="/users/{{ $user->id }}/update" method="post">
    @csrf
<div class="table-responsive small col-lg-8">
<table class="table table-striped table-sm">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><input type="text" value="{{ $user->name }}" name="name"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td><input type="text" value="{{ $user->email }}" name="email"></td>
    </tr>
    <tr>
        <td>Role</td>
        <td>:</td>
        <td>
            {{-- @foreach ($roles as $role)
            @if ($role->name == 'master_admin')
                @continue
            @endif
            <div class="form-check d-inline-block ">
                <input type="hidden" name="role_id" value="{{ $role->id }}">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="{{ $role->name }}"
                {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault">
                    {{ $role->name }}
                </label>
            </div>
            @endforeach --}}

            {{-- <select name="roles[]" id="">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select> --}}
                @if ($user->roles->contains('id', 1))
                    <input type="hidden" name="checked_roles[]" value="1">
                @endif
            @foreach($roles as $role)
                @if ($role->name === "master_admin")
                    @continue
                @endif
                <input id="{{ $role->id }}" type="checkbox" value="{{ $role->id }}" name="checked_roles[]" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label for="{{ $role->id }}">{{ $role->name }}</label>
            @endforeach
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td><input type="submit" value="Submit" name="submit"></td>
    </tr>
</table>
</form>
{{-- {{ dd($users) }} --}}
@endsection
