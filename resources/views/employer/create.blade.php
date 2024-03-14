<x-app-layout>
    <div class="py-12 w-1/2 m-auto mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gray-300 border-solid border-5 border-black sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <div>
                            <a href="{{ route('employer.dashboard') }}">
                                <div class="fs-4 mb-3 mt-2 ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z">
                                        </path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <header class="text-center">
                            <h2 class="text-2xl font-semibold text-black">
                                {{ __('Job Listings') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Enter job details of your company") }}
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('employer.store')}}" class="mt-6 space-y-6">
                            @csrf

                            <div class="form-group">
                                <label>Categories:</label><br>
                                @foreach ($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]"
                                        id="category_{{ $category->id }}" value="{{ $category->id }}">
                                    <label class="form-check-label"
                                        for="category_{{ $category->id }}">{{ $category->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            <div>
                                <x-input-label for="company_name" :value="__('Company Name')" />
                                <x-text-input class="form-control mt-1" name="company_name" id="company_name"
                                    placeholder="company name.." />
                                @error('company_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="title" :value="__(' Job Title ')" />
                                <x-text-input id="title" name="title" class="mt-1 block w-full"
                                    placeholder="job title.." required autocomplete="title" />
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="description" :value="__(' Description ')" />
                                <textarea id="description" name="description"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="description of your job .." required autocomplete="name"></textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for="requirements" :value="__('Requirements')" />
                                <x-text-input id="requirements" name="requirements" class="mt-1 block w-full"
                                    placeholder="requirements.." required autocomplete="name" />
                                @error('requirements')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input class="form-control mt-1" name="location" id="location"
                                    placeholder="location.." />
                                @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="salary" :value="__('Salary')" />
                                <x-text-input type="number" class="form-control mt-1" name="salary" id="salary"
                                    placeholder="salary in decimal value.. " />
                                @error('salary')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select
                                    class="form-select mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="select" name="status" id="status" aria-label="Default select example">
                                    <option selected>Select</option>
                                    <option value="active">active</option>
                                    <option value="closed">closed</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                        crossorigin="anonymous"></script>
                </div>
            </div>
        </div>
</x-app-layout>