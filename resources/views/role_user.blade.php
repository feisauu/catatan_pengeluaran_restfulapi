@extends('layouts.main')

@section('container')
<h1 style="text-align: left">Users and Their Roles</h1>

<form action="/role_user" method="post">
    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Roles</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            
        @foreach ($users as $user)
            @if ($user->name == 'master_admin')
                @continue
            @endif
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $user->name }}</td>
                {{-- <td>
                    @foreach ($user->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </td> --}}
                <td>
                    {{-- <form action="" method="POST">
                        <input type="submit" value="Edit">
                    </form> --}}
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    @foreach ($roles as $role)
                        @if ($role->name == 'master_admin')
                            @continue
                        @endif
                        <div class="form-check d-inline-block ">
                            {{-- <input type="hidden" name="role_id" value="{{ $role->id }}"> --}}
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="role_id"
                            {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </table>
    </div>
    <input type="submit" name="submit" value="Simpan">
</form>
@endsection
