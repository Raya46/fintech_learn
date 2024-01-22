@extends('template.temp_navbar')

@section('content')
    <div class="bg-base-200 w-full h-full">
        <div class="container mx-auto">
            <div class="flex items-center justify-between p-4">
                <span class="text-xl">Manage Category</span>
                <a href="#modal_create_category" class="btn btn-success">Create category</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table glass">
                    <thead>
                        <tr>
                            <th class="text-center text-lg font-bold">No</th>
                            <th class="text-center text-lg font-bold">Name</th>
                            <th class="text-center text-lg font-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td class="text-center text-base">{{ $key + 1 }}</td>
                                <td class="text-center text-base">{{ $category->name }}</td>
                                <td class="flex justify-center gap-3">
                                    <a href="#modal_edit_category_{{ $category->id }}" class="btn btn-warning">Edit</a>
                                    <form action="/delete-category/{{ $category->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal" role="dialog" id="modal_edit_category_{{ $category->id }}">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Edit category</h3>
                                    <form action="/put-category/{{ $category->id }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex flex-col gap-3">
                                            <div class="flex items-center mt-3 gap-3">
                                                <input type="text" name="name" placeholder="Name"
                                                    value="{{ $category->name }}"
                                                    class="input input-bordered w-full max-w-xs" />
                                            </div>
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


    <div class="modal" role="dialog" id="modal_create_category">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Create category</h3>
            <form action="/post-category" method="post">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex items-center mt-3 gap-3">
                        <input type="text" name="name" placeholder="Name"
                            class="input input-bordered w-full max-w-xs" />
                    </div>
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn">Submit</button>
            </form>
            <a href="#" class="btn">Close</a>
        </div>
    </div>
@endsection
