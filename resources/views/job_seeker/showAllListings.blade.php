<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <section>
        <div>
            <h3 class="text-center h3 mt-3">All Job Listings</h3>
            <div class="container text-center mt-5">
                <div class="row">
                    @foreach ($jobs as $job) <!-- Displaying only 6 job listings -->
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $job->company_name }}</h5>
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