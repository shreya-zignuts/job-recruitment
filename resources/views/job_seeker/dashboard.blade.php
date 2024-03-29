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
                <div class="d-flex align-items-center">
                    <span class="me-3">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            <button type="button" class="btn btn-outline-light me-2">Logout</button>
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </header>
    <div class="container mt-4">
        @if(session('success'))
        <div class="alert alert-success text-center" role="alert" id="success">
            {{ session('success') }}
        </div>
        @elseif(session('fail'))
        <div class="alert alert-danger text-center" role="alert" id="fail">
            {{ session('fail') }}
        </div>
        @endif
    </div>
    <section>
        <div class="row justify-content-center mt-3">
            <div class="col-md-4">
                <form method="POST" action="{{ route('job_seeker.filter') }}">
                    @csrf
                    <div class="form-group card mt-3" style="width: 100%;">
                        <div class="card-header">
                            Select Categories
                        </div>
                        <div class="card-body">
                            <select class="select2-multiple form-control mt-3 text-center" name="categories[]"
                                multiple="multiple" id="select2Multiple" style="width: 100%;">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ is_array($selectedCategories) && in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-dark">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr class="mt-5">
        @if($selectedCategories)
        <div>
            <h2 class="text-center h3 bg-dark-subtle text-dark-emphasis text-black py-2">All Job Listings</h2>
            <div class="container text-center mt-5">
                <div class="row">
                    @foreach ($jobs->take(4) as $job)
                    <div class="col-md-6 mb-4">
                        <div class="card border border-4">
                            <div class="card-body">
                                <h4 class="card-text">{{ $job->company_name }}</h4>
                                <p class="card-text">{{ $job->description }}</p>
                                <a href="{{ route('job_seeker.show',['id' => $job->id]) }}" style="color: black;"
                                    onmouseover="this.style.color='gray'" onmouseout="this.style.color='black'">View
                                    More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($jobs->isNotEmpty())
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('job_seeker.job_listings') }}" class="btn btn-dark">View All Job Listings</a>
                    </div>
                </div>
                @else
                <div class="container mt-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-body-secondary rounded-3"
                            style="display: flex; justify-content: center;">
                            <li class="breadcrumb-item">
                                <p class="link-body-emphasis fw-semibold text-decoration-none text-center p-1 mt-3">No
                                    data available</p>
                            </li>
                        </ol>
                    </nav>
                </div>
                @endif
            </div>
        </div>
        @elseif(!$selectedCategories)
        <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-body-secondary rounded-3" style="display: flex; justify-content: center;">
                    <li class="breadcrumb-item">
                        <p class="link-body-emphasis fw-semibold text-decoration-none text-center p-1 mt-3">No
                            Categories Selected</p>
                    </li>
                </ol>
            </nav>
        </div>
        @endif
    </section>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Check if the alert element exists
            if ($('.alert').length) {
                // Fade out the alert after 2 seconds
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                }, 2000); // 2000 milliseconds = 2 seconds
            }
        });
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                placeholder: "Select",
                allowClear: true
            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>