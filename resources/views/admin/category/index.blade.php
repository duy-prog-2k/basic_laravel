<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      All Category
      <!-- <b style="float: right">Total User:
            <span class="badge bg-danger"></span>
            </b> -->
    </h2>
  </x-slot>
  <div class="py-12">
    <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div> -->

    <div class="container">
      <div class="row">

        <!-- Category col -->
        <div class="col-md-8">
          <div class="card">
            <!-- Alert inserted successful -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{ session('success') }}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card-header">
              All Category
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Category Name</th>
                  <th scope="col">Create At</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- @php($i = 1) -->
                @foreach($categories as $category)
                <tr>
                <!-- Ham paginator->firstItem() de lay ket qua index dau tien cua 1 phan trang -->
                  <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                  <td>{{ $category->user->name }}</td>
                  <td>{{ $category->category_name }}</td>
                  <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                  <td>
                    <a href="{{ url('category/edit/'. $category->id) }}" class="btn btn-info">Edit</a>
                    <a href="{{ url('soft-delete/category/' . $category->id) }}" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $categories->links() }}
          </div>
        </div>

        <!-- Add Category col -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">Add Category</div>
            <div class="card-body">
              <form action="{{ route('store.category') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="categoryInput" class="form-label">Category name</label>
                  <input type="text" class="form-control" id="categoryInput" name="category_name" aria-describedby="emailHelp">
                  @error('category_name')
                  <span class="text-danger"> {{ $message }}</span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
              </form>
            </div>
          </div>
        </div>

        {{-- Trash part --}}
        <div class="container">
            <div class="row">
              <!-- Category col -->
              <div class="col-md-8">
                <div class="card">

                  <div class="card-header">
                    Trash List
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Create At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- @php($i = 1) -->
                      @foreach($trash_cat as $trash)
                      <tr>
                      <!-- Ham paginator->firstItem() de lay ket qua index dau tien cua 1 phan trang -->
                        <th scope="row">{{ $trash_cat->firstItem() + $loop->index }}</th>
                        <td>{{ $trash->user->name }}</td>
                        <td>{{ $trash->category_name }}</td>
                        <td>{{ Carbon\Carbon::parse($trash->created_at)->diffForHumans() }}</td>
                        <td>
                            <a href="{{ url('soft-delete/category/restore/'. $trash->id) }}" class="btn btn-warning">Restore</a>
                            <a href="{{ url('soft-delete/category/delete/'. $trash->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $trash_cat->links() }}
                </div>
              </div>

              <!-- Add Category col -->
              <div class="col-md-4">

              </div>


      </div>
    </div>
  </div>
</x-app-layout>
