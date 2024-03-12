<x-app-layout>
    <section>
        <div class="container mt-3">
            <form method="POST" action="{{ route('categorY.show') }}">
                @csrf
                <div class="container text-center">
                    <h3 class="h3 font-semibold">Select Category</h3>
                </div>
                <div class="row mt-3 ml-56">
                    @foreach ($categories as $category)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="category{{ $category->id }}"
                                name="categories[]" value="{{ $category->id }}">
                            <label class="form-check-label"
                                for="category{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="container mt-3 text-center">
                    <button class="btn btn-dark p-1 px-2">Show Job Listings</button>
                </div>
            </form>
            <hr class="mt-4">

            @if ($selectedCategory)
            <h2 class="mt-4 h2 text-center">{{ $selectedCategory->name }}</h2>
            @else
            <div class="py-5">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-gray-500 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-1 text-white">
                            <h4 class="h4 mt-2 text-center">No categories selected</h4>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if ($jobListings->isNotEmpty())
            <div class="table-responsive text-center">
                <table class="table table-bordered border-3 border-dark mt-3 text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Company Name</th>
                            <th>Title</th>
                            <th>Description</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobListings as $job)
                        <tr>
                        <td>{{ $job->company_name }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif
        </div>
    </section>
</x-app-layout>