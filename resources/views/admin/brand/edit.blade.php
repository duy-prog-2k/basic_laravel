<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			Edit Brand
		</h2>
	</x-slot>
	<div class="py-12">
		<div class="container">
			<div class="row">
				<!-- Add Category col -->
				<div class="col-md-8">

					@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{ session('success') }}</strong>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					@endif

					<div class="card">
						<div class="card-header">Edit Brand</div>
						<div class="card-body">
							<form action="{{ url('brand/update/' . $brand->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="mb-3">
                                    <input type="hidden" name="old_img" value="{{ $brand->brand_img }}">
									<label for="brandInput" class="form-label">Update Brand Name & Image</label>
									<input type="text" class="form-control" id="brandNameInput" name="brand_name" aria-describedby="emailHelp" value="{{ $brand->brand_name }}">
									<input type="file" class="form-control" id="brandImgInput" name="brand_img" aria-describedby="emailHelp" value="">
                                    <img src="{{ asset($brand->brand_img) }}" alt="" style="width: 200px; height: 200px;">
                                    @error('brand_name')
									<span class="text-danger"> {{ $message }}</span>
									@enderror
								</div>
								<button type="submit" class="btn btn-primary">Update Brand</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</x-app-layout>
