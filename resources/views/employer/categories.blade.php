<section>
    <div class="container">
        <h2>Select Category</h2>
        <form method="post" action="{{ route('employer.store') }}">
            @csrf
            <div class="form-group">
                <label>Categories:</label><br>
                @foreach ($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]"
                        id="category_{{ $category->id }}" value="{{ $category->id }}">
                    <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Continue</button>
        </form>
    </div>
</section>