<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/job_seeker/dashboard" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="{{ route('job_seeker.companies') }}" class="nav-link px-2 text-white">Companies</a>
                    </li>
                    <li><a href="{{ route('job_seeker.job_listings') }}" class="nav-link px-2 text-white">Job
                            Listings</a></li>
                    <li><a href="{{ route('resume.form') }}" class="nav-link px-2 text-white">Resume</a></li>
                </ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <button type="button" class="btn btn-outline-light me-2">Logout</button>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </header>
    <div class="container mt-4">
        @if(session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
        @endif
    </div>
    <div>
        <a href="{{ URL::previous() }}">
            <div class="fs-4 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z">
                    </path>
                </svg>
            </div>
        </a>
        <div>
            @if($job->status == 'active')
            <div class="container text-end">
                <a href="{{ route('resume.mail') }}"><button class="btn btn-dark p-2 mt-1">Apply Now</button></a>
            </div>
            @endif
            <div class="container mt-3">
                <div class="mt-3 mb-3">
                    <h3 class="text-center h3 m-0 ">Job Details</h5>
                </div>
                <div class="card p-3 border border-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-3 text-center">
                                <div class="card-header">Categories</div>
                                <div class="card-body">
                                    @foreach($job->categories as $category)
                                    <span class="badge bg-secondary">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-6 text-center mb-3">
                                <div class="card mt-3">
                                    <div class="card-header">Company Name</div>
                                    <div class="card-body ">
                                        <span class="card-title p-2 text-lg">{{ $job->company_name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Job Title</div>
                                <div class="card-body">{{ $job->title }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Description</div>
                                <div class="card-body">{{ $job->description }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Requirements</div>
                                <div class="card-body">{{ $job->requirements }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Location</div>
                                <div class="card-body">{{ $job->location }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Salary</div>
                                <div class="card-body">{{ $job->salary }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Status</div>
                                <div class="card-body">{{ $job->status }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>