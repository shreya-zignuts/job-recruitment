<x-app-layout>
    <section>
        <div class="container mt-3">
            <form method="POST" action="{{ route('category.show') }}">
                @csrf
                <div class="container text-center">
                    <h3 class="h3 font-semibold">Select Category</h3>
                </div>
                <div class="row mt-3 ml-56">
                    <select required="required" class="form-control" name="categories[]">
                        <option>Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $selectedCategory == $category ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="container mt-3 text-center">
                    <button class="btn btn-dark p-1 px-2">Show Job Listings</button>
                </div>
            </form>
            <hr class="mt-4">

            @if ($selectedCategory)
            <h2 class="mt-4 h2 text-center">{{ $selectedCategory->name }}</h2>
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
            @elseif($jobListings->isEmpty())
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
                        <tr>
                            <td colspan="3">Data not available</td>

                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
            @else
            <div class="py-5">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-1 text-black">
                            <h4 class="h4 mt-2 text-center">No categories selected</h4>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>
</x-app-layout>