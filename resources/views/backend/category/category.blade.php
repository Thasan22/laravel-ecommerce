@extends('backend.dashboard')
@section('contents')
    <section>
        <div class="container mt-5">
            <div class="row">
                <!-- FORM -->
                @if (Route::is('category'))
                <div class="col-lg-4">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h4 class="text-light text-center">Add Category</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('categoryInsert') }}" method="POST">
                                @csrf

                                <label for="category">category</label>
                                <input name="category" placeholder="Enter category" type="text" id="category" class="form-control" >
                                <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-4">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h4 class="text-light text-center">Edit Category</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('categoryUpdate',$findCategory->id) }}" method="POST">
                                @csrf
                                @method('put')

                                <label for="category">category</label>
                                <input value="{{$findCategory->category}}" name="category" placeholder="Enter category" type="text" id="category" class="form-control" >
                                <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
                @endif


                <!-- TABLE -->
                <div class="col-lg-8">
                    <table class="table table-striped table-hover shadow">
                    <tr class="text-center">
                            <th>#</th>
                            <th>category</th>
                            <th>Category-Slug</th>
                            <th>Action</th>
                        </tr>
                        
                        @forelse ($categories as $key => $category)
                        <tr class="text-center">
                            <td>{{  ++$key }}</td>
                            <td>{{$category->category}}</td>
                            <td>{{$category->category_slug}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('categoryEdit', $category->id)}}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{route('categoryDelete', $category->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td>No Data Found</td>
                            </tr>
                        @endforelse

                    </table>

                    <!-- $categories->links() -->

                </div>
            </div>
        </div>
    </section>
@endsection