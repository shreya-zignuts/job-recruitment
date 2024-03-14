<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header class="p-3 bg-dark text-white">
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
                    <li><a href="{{ route('job_seeker.job_listings') }}" class="nav-link px-2 text-white">Job Listings</a></li>
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
    <section class="mt-5">
        <div class="container border border-4 bg-secondary">
            <div class="row justify-content-center py-5">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-black text-white">Compose Mail</div>

                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('success') }}
                                </div>
                            @elseif(session('fail'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ session('fail') }}
                                </div>
                            @endif

                            <form action="{{ route('job.sendMail',['id'=> $job->id])}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="mailMessage" class="form-label">Message</label>
                                    <textarea class="form-control" id="mailMessage" name="mailMessage" rows="5"
                                        placeholder="Enter the message you want to send to the employer.."></textarea>
                                </div>

                                @if(Auth::user()->resume)
                                    <div class="text-center p-3">
                                        Uploaded Resume : {{ basename(Auth::user()->resume->filename) }}
                                        <br>
                                        <p class="mt-3"><a href="{{ route('resume.show') }}">Review Resume</a></p>
                                    </div>
                                @else
                                    <div class="alert alert-warning text-center" role="alert">
                                        You have not uploaded your resume yet.
                                        <br>
                                        <a href="{{ route('resume.form') }}" class="btn btn-warning mt-2">Upload
                                            Resume</a>
                                    </div>
                                @endif

                                <div class="text-center mt-4 mb-2">
                                    <button class="btn btn-dark">Send Mail</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-iwU0T7ln4w+cFe6L9LQGp8nJ3I/cEz8+Cp3B5m12U0JgNVXyvqp4u9k9bYOlkp5g" crossorigin="anonymous">
    </script>
</body>

</html>

