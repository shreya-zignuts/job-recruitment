<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header class="p-3 text-bg-dark">
        <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="/job_seeker/dashboard" class="nav-link px-2 text-white">Home</a></li>
            <li><a href="{{ route('job_seeker.companies') }}" class="nav-link px-2 text-white">Companies</a></li>
          <li><a href="{{ route('job_seeker.job_listings') }}" class="nav-link px-2 text-white">Job Listings</a></li>
          <li><a href="{{ route('job_seeker.resumes') }}" class="nav-link px-2 text-white">Resume</a></li>
            </ul>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <button type="button" class="btn btn-outline-light me-2">Logout</button>
                        </x-responsive-nav-link>
                    </form>
            </div>
        </div>
        </div>
    </header>
    <section>
        <div>
            <h3 class="text-center h3 mt-3">All Job Listings</h3>
            <div class="container text-center mt-5">
                <div class="row">
                    @foreach ($jobs as $job) <!-- Displaying only 6 job listings -->
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $job->title }}</h4>
                                    <h6 class="card-text">{{ $job->company_name }}</h6>
                                    <p class="card-text">{{ $job->description }}</p>
                                    <a href="{{ route('job_seeker.show',['id' => $job->id]) }}" class="btn btn-primary">View More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>