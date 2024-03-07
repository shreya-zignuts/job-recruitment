<x-app-layout>
            <div>
                <a href="{{ route('job_seeker.dashboard') }}"><div class="fs-4 mb-3 mt-2 ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"></path>
                    </svg>
                    </div></a>
            </div>
            <div>
                <div class="container text-center outline outline-offset-4 w-1/2 outline-gray-500 sm:rounded-lg bg-black p-6">
                            <div class="mt-1 block w-sm p-2 bg-gray-500 rounded-lg">
                                <div class="list-group-item list-group-item-dark p-4 text-xl text-black font-semibold text-center justify-center" aria-current="true">Categories
                                    <div class="list-group-item mt-2 font-medium text-black">
                                        @foreach($categories as $category)
                                            <span class="underline underline-offset-4">{{ $category->name }}</span>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                </div>
                                <div class="mt-2 block w-sm p-2 bg-gray-500 rounded-lg">
                                    <div class="list-group-item list-group-item-dark p-4 text-xl text-black font-semibold" aria-current="true">Company Name
                                        <div class="list-group-item mt-2 font-medium text-black underline decoration-double underline-offset-4">{{ $job->company_name }}</div>
                                    </div>
                                </div>
                                <div class="mt-2 block justify-end w-sm p-2 bg-gray-500 rounded-lg">
                                    <div class="list-group-item list-group-item-dark p-4 text-xl text-black font-semibold" aria-current="true">Job Title
                                        <div class="list-group-item mt-2 font-medium text-black underline decoration-double underline-offset-4">{{ $job->title }}</div>
                                    </div>
                                </div>
                                <div class="mt-2 block w-sm p-2 bg-gray-500 rounded-lg">
                                    <div class="list-group-item list-group-item-dark p-4 text-xl text-black font-semibold" aria-current="true">Description
                                        <div class="list-group-item mt-2 font-medium text-black underline decoration-double underline-offset-4">{{ $job->description }}</div>
                                    </div>
                                </div>
                                <div class="mt-2 w-sm p-2 bg-gray-500 rounded-lg">
                                    <div class="list-group-item list-group-item-dark p-4 text-xl text-black font-semibold" aria-current="true">Requirements
                                        <div class="list-group-item mt-2 font-medium text-black underline decoration-double underline-offset-4">{{ $job->requirements }}</div>
                                    </div>
                                </div>
                                <div class="mt-2 block w-sm p-2 bg-gray-500 rounded-lg">
                                    <div class="list-group-item list-group-item-dark p-4 text-xl text-black font-semibold" aria-current="true">Location
                                        <div class="list-group-item mt-2 font-medium text-black underline decoration-double underline-offset-4">{{ $job->location }}</div>
                                    </div>
                                </div>
                                <div class="mt-2 w-sm p-2 bg-gray-500 rounded-lg">
                                    <div class="list-group-item list-group-item-dark p-4 text-xl text-black font-semibold" aria-current="true">Salary
                                        <div class="list-group-item mt-2 font-medium text-black underline decoration-double underline-offset-4">{{ $job->salary }}</div>
                                    </div>
                                </div>
                                <div class="mt-2 w-sm p-2 bg-gray-500 rounded-lg">
                                    <div class="list-group-item list-group-item-dark p-4 text-xl text-black font-semibold" aria-current="true">Status
                                        <div class="list-group-item mt-2 font-medium text-black underline decoration-double underline-offset-4">{{ $job->status }}</div>
                                    </div>
                                </div>
                </div>      
            </div>
</x-app-layout>
