@if(session('success'))
    <div class="alert alert-success text-center" role="alert" id="success">
        {{ session('success') }}
    </div>
@endif
<x-app-layout>
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <h3 class="h3 font-semibold mt-2">All Job Listings</h3>
            </div>
            <div class="col text-end">
                <a href="{{ route('employer.create') }}"><button class="btn btn-dark p-2 mt-1">Create Job Title</button></a>
            </div>
        </div>
            <table class="table table-bordered border-3 border-dark mt-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Categories</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col" colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <td class="align-middle text-center">
                            @php $count = 0; @endphp
                            @foreach($job->categories as $category)
                            {{ $category->name }}
                            @php $count++; @endphp
                            @if ($count % 3 == 0 && $count != count($job->categories))
                            <br>
                            @else
                            ,
                            @endif
                            @endforeach
                        </td>
                        <td class="align-middle text-center">{{ $job->title }}</td>
                        <td class="align-middle">{{ $job->description }}</td>
                        <td class="align-middle text-center">
                            @if ($job->status == 'active')
                            <button class="btn btn-success">ON</button>
                            @elseif ($job->status == 'closed')
                            <button class="btn btn-danger">OFF</button>
                            @else
                            {{ $job->status }} <!-- Displaying status text if neither "active" nor "closed" -->
                            @endif
                        </td>
                        <td class="align-middle text-center" style="border: none;">
                            <a href="{{ route('employer.show',['id' => $job->id]) }}"><i class="bi bi-eye-fill"></i></a>
                        </td>
                        <td class="align-middle text-center" style="border: none;">
                            <a href="{{ route('employer.edit',['id' => $job->id]) }}"><i class="bi bi-pencil-square"></i></a>
                        </td>
                        <td class="align-middle text-center" style="border: none;">
                            <form action="{{ route('employer.delete', ['id' => $job->id]) }}" method="post">
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        {{ $jobs->links() }}
                    </div>
                </div>
    
            </div>
        </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</x-app-layout>