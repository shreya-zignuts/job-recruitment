<x-app-layout>
            <h3 class="text-center h3 mt-3">All Job Listings</h3>
            <div class="container text-center">
                <table class="table table-bordered border-3 border-dark mt-3">
                    <thead class="table-dark border-solid border-2 border-gray-600">
                        <tr style="border-width:3px">
                        <th scope="col" style="border-width:3px">Category</th>
                            <th scope="col pl-3" style="border-width:3px">Title</th>
                            <th scope="col" style="border-width:3px">Description</th>
                            <th scope="col" style="border-width:3px">status</th>
                            <th scope="col" style="border-width:3px"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($jobs as $job)
                            <tr style="border-width:3px">
                                <td style="border-width:3px">
                                @foreach ($categories as $category)
                                    {{ $category->name }}
                                    @endforeach
                                </td>
                                <td style="border-width:3px">{{ $job->title }}<t/td>
                                <td style="border-width:3px">{{ $job->description }}</td>
                                <td style="border-width:3px">{{ $job->status }}</td>
                                <td class="d-flex justify-content-center align-center"><a href="{{ route('employer.show',['id' => $job->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg></a></td>
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