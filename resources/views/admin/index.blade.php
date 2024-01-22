@extends('template.temp_navbar')

@section('content')
    <div class="bg-base-200 w-full h-full">
        <div class="container mx-auto">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center gap-2">
                    <span class="text-xl">Hello {{ Auth::user()->name }}</span>
                    <span class="badge badge-outline mt-1">{{ Auth::user()->roles->name }}</span>
                </div>
                <a href="#modal_create_user" class="btn btn-success">Create User</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table glass">
                    <thead>
                        <tr>
                            <th class="text-center text-lg font-bold">No</th>
                            <th class="text-center text-lg font-bold">Name</th>
                            <th class="text-center text-lg font-bold">Role</th>
                            <th class="text-center text-lg font-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td class="text-center text-base">{{ $key + 1 }}</td>
                                <td class="text-center text-base">{{ $user->name }}</td>
                                <td class="text-center text-base">{{ $user->roles->name }}</td>
                                <td class="flex justify-center gap-3">
                                    <a href="#modal_edit_user_{{ $user->id }}" class="btn btn-warning">Edit</a>
                                    <form action="/delete-user/{{ $user->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal" role="dialog" id="modal_edit_user_{{ $user->id }}">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Edit User</h3>
                                    <form action="/put-user/{{ $user->id }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex flex-col gap-3">
                                            <div class="flex items-center mt-3 gap-3">
                                                <input type="text" name="name" placeholder="Name"
                                                    value="{{ $user->name }}"
                                                    class="input input-bordered w-full max-w-xs" />
                                                <select name="roles_id" class="select select-bordered w-full max-w-xs">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $role->id == $user->roles_id ? 'selected' : 'disabled' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="text" name="password" placeholder="Password"
                                                class="input input-bordered w-[48%]" />
                                        </div>

                                        <div class="modal-action">
                                            <button type="submit" class="btn">Submit</button>
                                    </form>
                                    <a href="#" class="btn">Close</a>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="modal" role="dialog" id="modal_create_user">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Create User</h3>
            <form action="/post-user" method="post">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex items-center mt-3 gap-3">
                        <input type="text" name="name" placeholder="Name"
                            class="input input-bordered w-full max-w-xs" />
                        <select name="roles_id" class="select select-bordered w-full max-w-xs">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" name="password" placeholder="Password" class="input input-bordered w-[48%]" />
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn">Submit</button>
            </form>
            <a href="#" class="btn">Close</a>
        </div>
    </div>
@endsection
