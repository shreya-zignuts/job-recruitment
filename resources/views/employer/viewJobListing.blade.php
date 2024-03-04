<x-app-layout>
            <div>
                <a href="{{ route('employer.dashboard') }}"><div class="fs-4 mb-3 mt-2 ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"></path>
                    </svg>
                    </div></a>
            </div>
            <div>
                <div class="container text-center mt-5">
                             <ul class="list-group card-body">
                                <li class="list-group-item list-group-item-dark mt-5" aria-current="true">Task Name</li>
                                <li class="list-group-item">{{ $job->company_name }}</li>
                            </ul>
                            <ul class="list-group card-body">
                                <li class="list-group-item list-group-item-dark mt-5" aria-current="true">Task Name</li>
                                <li class="list-group-item">{{ $job->title }}</li>
                            </ul>
                            <ul class="list-group">
                            <li class="list-group-item list-group-item-dark mt-5" aria-current="true">Description</li>
                            <li class="list-group-item">{{ $job->description }}</li>
                        </ul> 
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-dark mt-5" aria-current="true">Requirements</li>
                            <li class="list-group-item">{{ $job->requirements }}</li>
                        </ul> 
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-dark mt-5" aria-current="true">Location</li>
                            <li class="list-group-item">{{ $job->location }}</li>
                        </ul> 
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-dark mt-5" aria-current="true">Salary</li>
                            <li class="list-group-item">{{ $job->salary }}</li>
                        </ul> 
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-dark mt-5" aria-current="true">Status</li>
                            <li class="list-group-item">{{ $job->status }}</li>
                        </ul> 
                </div>      
            </div>
</x-app-layout>
