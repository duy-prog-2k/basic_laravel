<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        All Brand
      </h2>
    </x-slot>
    <div class="py-12">
      <div class="container">
        <div class="row">

          <!-- Brand col -->
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
                All Brand
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Brand Name</th>
                    <th scope="col">Brane Image</th>
                    <th scope="col">Create At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- @php($i = 1) -->
                  @foreach($brands as $brand)
                  <tr>
                  <!-- Ham paginator->firstItem() de lay ket qua index dau tien cua 1 phan trang -->
                    <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                    <td>{{ $brand->brand_name }}</td>
                    <td><img src="{{ asset($brand->brand_img) }}" alt="" style="height: 40px; width: 70px"></td>
                    <td>{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</td>
                    <td>
                      <a href="{{ url('brand/edit/'. $brand->id) }}" class="btn btn-info">Edit</a>
                      <a href="{{ url('brand/delete/' . $brand->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $brands->links() }}
            </div>
          </div>

          <!-- Add Brand col -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">Add Brand</div>
              <div class="card-body">
                <form action="{{ route('brand.insert') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="brandInput" class="form-label">Brand name</label>
                    <input type="text" class="form-control" id="brandNameInput" name="brand_name" aria-describedby="emailHelp">
                    <label for="brandImg" class="form-label">Brand Image</label>
                    <input type="file" class="form-control" id="brandImageInput" name="brand_img" aria-describedby="emailHelp">
                    @error('brand_name')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary">Add Brand</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>
