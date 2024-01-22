@extends('template.temp_navbar')

@section('content')
    <div class="bg-base-200 w-full h-full">
        <div class="container mx-auto">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center gap-2">
                    <span class="text-xl">Hello {{ Auth::user()->name }}</span>
                    <span class="badge badge-outline mt-1">{{ Auth::user()->roles->name }}</span>
                </div>
                <a href="#modal_create_product" class="btn btn-success">Create product</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table glass">
                    <thead>
                        <tr>
                            <th class="text-center text-lg font-bold">No</th>
                            <th class="text-center text-lg font-bold">Photo</th>
                            <th class="text-center text-lg font-bold">Name</th>
                            <th class="text-center text-lg font-bold">Price</th>
                            <th class="text-center text-lg font-bold">Stock</th>
                            <th class="text-center text-lg font-bold">Stand</th>
                            <th class="text-center text-lg font-bold">Category</th>
                            <th class="text-center text-lg font-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <div class="modal" role="dialog" id="modal_edit_product_{{ $product->id }}">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Edit product</h3>
                                    <form action="/put-product/{{ $product->id }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex flex-col gap-3">
                                            <div class="flex gap-3">
                                                <label class="form-control w-[47%]">
                                                    <div class="label">
                                                        <span class="label-text">Photo</span>
                                                    </div>
                                                    <input type="file" name="photo" value="{{ $product->photo }}" />
                                                </label>

                                                <label class="form-control w-[13.5rem]">
                                                    <div class="label">
                                                        <span class="label-text">Category</span>
                                                    </div>
                                                    <select name="categories_id" class="select select-bordered">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == $product->category->id ? 'selected' : 'disabled' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>

                                            <div class="flex gap-3">
                                                <label class="form-control">
                                                    <div class="label">
                                                        <span class="label-text">Name</span>
                                                    </div>
                                                    <input type="text" name="name" placeholder="Name"
                                                        class="input input-bordered" value="{{ $product->name }}" />
                                                </label>
                                                <label class="form-control">
                                                    <div class="label">
                                                        <span class="label-text">Price</span>
                                                    </div>
                                                    <input type="number" name="price" placeholder="Price"
                                                        class="input input-bordered" value="{{ $product->price }}" />
                                                </label>
                                            </div>
                                            <div class="flex gap-3">
                                                <label class="form-control">
                                                    <div class="label">
                                                        <span class="label-text">Stand</span>
                                                    </div>
                                                    <input type="text" name="stand" placeholder="Stand"
                                                        class="input input-bordered" value="{{ $product->stand }}" />
                                                </label>
                                                <label class="form-control">
                                                    <div class="label">
                                                        <span class="label-text">Stock</span>
                                                    </div>
                                                    <input type="number" name="stock" placeholder="Stock"
                                                        class="input input-bordered" value="{{ $product->stock }}" />
                                                </label>
                                            </div>

                                            <label class="form-control">
                                                <div class="label">
                                                    <span class="label-text">Description</span>
                                                </div>
                                                <textarea class="textarea textarea-bordered h-20" placeholder="Description" name="description">{{ $product->description }}</textarea>
                                            </label>
                                        </div>

                                        <div class="modal-action">
                                            <button type="submit" class="btn">Submit</button>
                                    </form>
                                    <a href="#" class="btn">Close</a>
                                </div>
                            </div>
                            <tr>
                                <td class="text-center text-base">{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ $product->photo }}" alt="none"
                                        class="object-cover w-28 h-w-28 ml-0 lg:ml-[4.5rem] rounded shadow-lg">
                                </td>
                                <td class="text-center text-base">{{ $product->name }}</td>
                                <td class="text-center text-base">{{ $product->price }}</td>
                                <td class="text-center text-base">{{ $product->stock }}</td>
                                <td class="text-center text-base">{{ $product->stand }}</td>
                                <td class="text-center text-base">{{ $product->category->name }}</td>
                                <td class="flex justify-center gap-3 items-center mt-[0.70rem]">
                                    <a href="#modal_edit_product_{{ $product->id }}" class="btn btn-warning">Edit</a>
                                    <form action="/delete-product/{{ $product->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>



    <div class="modal" role="dialog" id="modal_create_product">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Create product</h3>
            <form action="/post-product" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex gap-3">
                        <label class="form-control w-[47%]">
                            <div class="label">
                                <span class="label-text">Photo</span>
                            </div>
                            <input type="file" name="photo" />
                        </label>

                        <label class="form-control w-[13.5rem]">
                            <div class="label">
                                <span class="label-text">Category</span>
                            </div>
                            <select name="categories_id" class="select select-bordered">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Name</span>
                            </div>
                            <input type="text" name="name" placeholder="Name" class="input input-bordered" />
                        </label>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Price</span>
                            </div>
                            <input type="number" name="price" placeholder="Price" class="input input-bordered" />
                        </label>
                    </div>
                    <div class="flex gap-3">
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Stand</span>
                            </div>
                            <input type="text" name="stand" placeholder="Stand" class="input input-bordered" />
                        </label>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Stock</span>
                            </div>
                            <input type="number" name="stock" placeholder="Stock" class="input input-bordered" />
                        </label>
                    </div>

                    <label class="form-control">
                        <div class="label">
                            <span class="label-text">Description</span>
                        </div>
                        <textarea class="textarea textarea-bordered h-20" placeholder="Description" name="description"></textarea>
                    </label>


                </div>

                <div class="modal-action">
                    <button type="submit" class="btn">Submit</button>
            </form>
            <a href="#" class="btn">Close</a>
        </div>
    </div>
@endsection
