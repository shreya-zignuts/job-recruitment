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
    @if(session('success'))
        <div class="alert alert-success text-center" role="alert" id="success">
            {{ session('success') }}
        </div>
    @endif
    <section>
        <div class="container mt-5 d-flex justify-content-center align-center">
            <div class="card border border-5 border-dark" style="width: 50rem; height: auto">
                <div class="card-body">
                    <form action="{{ route('job.sendMail',['id'=> $job->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h5 class="card-title bg-secondary p-2 mt-4 text-white text-center">Send Mail </h5>
                        <p class="card-text mt-5">
                            <label for="exampleFormControlTextarea1">Enter Message</label>
                            <textarea class="form-control mt-2" id="mailMessage" name="mailMessage" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </p>
                        @if(Auth::user()->resume)
                            <p class="card-text mt-4 text-center">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Uploaded Resume</h4>
                                    <div class="container text-center">
                                        <p class="card-text">File Name: {{ basename(Auth::user()->resume->filename) }}</p>
                                        <a href="{{ route('resume.show') }}" class="btn btn-secondary">Review Resume</a>
                                    </div>
                                </div>
                            </div>

                            </p>
                        @else
                        <div class="alert alert-primary text-center" role="alert">
                           <a href="{{ route('resume.form') }}">Click to Upload Resume</a>
                        </div>
                        @endif
                            <div class="form-group mt-5 mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Send Mail</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
