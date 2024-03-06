@if(session('success'))
    <div class="alert alert-success text-center" role="alert" id="success">
        {{ session('success') }}
    </div>
@endif
<x-app-layout>
            <h3 class="text-center h3 mt-3">All Job Listings</h3>
            <div class="container text-center">
                <table class="table table-bordered border-3 border-dark mt-3">
                    <thead class="table-dark border-solid border-2 border-gray-600">
                        <tr style="border-width:3px">
                        <th scope="col" style="border-width:3px">Categories</th>
                            <th scope="col" style="border-width:3px">Title</th>
                            <th scope="col" style="border-width:3px">Description</th>
                            <th scope="col" style="border-width:3px">status</th>
                            <th scope="col" style="border-width:3px" colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-width:3px">
                            @foreach ($jobs as $job)
                                    <td style="border-width:3px">
                                        @php $count = 0; @endphp
                                            @foreach($job->categories as $category)
                                                {{ $category->name }}
                                                @php $count++; @endphp
                                                @if ($count % 3 == 0)
                                                    ,<br>
                                                    @elseif ($count != count($job->categories))
                                                        ,
                                                @endif

                                            @endforeach
                                    </td>
                                        <td style="border-width:3px" class="text-center">{{ $job->title }}</td>
                                        <td style="border-width:3px">{{ $job->description }}</td>
                                        <td style="border-width:3px">{{ $job->status }}</td>
                                        <td style="border-width:3px">
                                            <a href="{{ route('employer.show',['id' => $job->id]) }}">view</a>
                                            <a href="{{ route('employer.edit',['id' => $job->id]) }}">edit</i></a>
                                            <form action="{{ route('employer.delete', ['id' => $job->id]) }}" method="post">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')">delete</button>
                                            </form>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                
                    </tbody>
                </table>
            </div>
            <div class="container text-center">
                <a href="{{ route('employer.create') }}"><button class="btn btn-dark p-2">Create Job Title</button></a>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</x-app-layout>