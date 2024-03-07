<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- selec2 cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

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
    <div class="container mt-5">
        <table class="table table-bordered border-3 border-dark mt-3 text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Company Names</th>
                        <th scope="col">Description</th>
                        <th scope="col">More</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <td class="align-middle text-center">{{ $job->company_name }}</td>
                        <td class="align-middle">{{ $job->description }}</td>
                        <td class="align-middle text-center">
                        <a href="{{ route('job_seeker.show',['id' => $job->id]) }}" class="btn btn-secondary">View More</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
  </section>