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
          <li><a href="/jobSeeker/dashboard" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Companies</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Job Listings</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Resume</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <button type="button" class="btn btn-outline-light me-2">Login</button>
          <button type="button" class="btn btn-warning">Sign-up</button>
        </div>
      </div>
    </div>
  </header>
  <section>
    <div class="container">
        <h2>Select Category</h2>
        <form method="post" action="{{ route('employer.store') }}">
            @csrf
            <div class="form-group">
                <label>Categories:</label><br>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}">
                            <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Continue</button>
        </form>
    </div>
    <div>
      <h2>Job Listings</h2>
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
                            @foreach ($job->categories as $category)
                                    <td style="border-width:3px">
                                                {{ $category->name }}
                                    </td>
                                        <td style="border-width:3px" class="text-center">{{ $job->title }}</td>
                                        <td style="border-width:3px">{{ $job->description }}</td>
                                        <td style="border-width:3px">{{ $job->status }}</td>
                                        <td style="border-width:3px">
                                            <a href="{{ route('employer.show',['id' => $job->id]) }}">view</a>
                                    </tr>
                                @endforeach
                                @endforeach

                
                    </tbody>
                </table>
            </div>
            <div class="container text-center">
                <a href="{{ route('employer.create') }}"><button class="btn btn-dark p-2">Create Job Title</button></a>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </div>
</section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>