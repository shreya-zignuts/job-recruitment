<x-app-layout>
        <div class="container mt-3">
            <form action="{{ route('employer.store')}}" method="post">
                @csrf
                <div class="form-group card p-3">
                    <div>
                        <a href="{{ route('employer.dashboard') }}"><div class="fs-4 mb-3 mt-2 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"></path>
                            </svg>
                            </div></a>
                    </div>
                    <div>
                        <x-text-input id="users_id" name="users_id" type="hidden" class="mt-1 block w-full" required autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('users_id')" />
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                                Company Name
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="company_name">
                            <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                        </div>
                    </div>
                    <div class="form-group card mt-2">
                        <div class="card-header">
                                Title
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter job title">
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                    </div>
                    <div class="form-group card mt-2">
                        <div class="card-header">
                                Description
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" id="description" name="description" placeholder="Enter description of your job" rows="3"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                    </div>
                    <div class="form-group card mt-2">
                        <div class="card-header">
                                Requirements
                        </div>
                        <div class="card-body">
                            <input class="form-control" name="requirements" id="requirements" placeholder="Enter job title">
                            <x-input-error class="mt-2" :messages="$errors->get('requirements')" />
                        </div>
                    </div>
                    <div class="form-group card mt-2">
                        <div class="card-header">
                                Location
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>
                    </div>
                    <div class="form-group card mt-2">
                        <div class="card-header">
                                Salary
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" name="salary" id="salary" placeholder="Enter salary">
                            <x-input-error class="mt-2" :messages="$errors->get('salary')" />
                        </div>
                    </div>
                    <div class="form-group card mt-2">
                        <div class="card-header">
                                Status
                        </div>
                        <div class="card-body">
                        <select class="form-select" name="status" id="status" aria-label="Default select example">
                            <option selected>Select</option>
                            <option value="active">active</option>
                            <option value="closed">closed</option>
                        </select>
                        </div>
                    </div>
                    <div class="container mt-3 d-flex justify-content-center align-center">
                    <button class="btn btn-secondary p-2">Save</button>
                    </div>
                </div>
            </div>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</x-app-layout>