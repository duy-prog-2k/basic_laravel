<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			Edit Category
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
						<div class="card-header">Edit Category</div>
						<div class="card-body">
							<form action="{{ url('category/update/' . $categories->id) }}" method="POST">
								@csrf
								<div class="mb-3">
									<label for="categoryInput" class="form-label">Update Category</label>
									<input type="text" class="form-control" id="categoryInput" name="category_name" aria-describedby="emailHelp" value="{{ $categories->category_name }}">
									@error('category_name')
									<span class="text-danger"> {{ $message }}</span>
									@enderror
								</div>
								<button type="submit" class="btn btn-primary">Update Category</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</x-app-layout>
