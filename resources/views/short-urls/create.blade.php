@extends('layouts.app')

@section('title', 'Create Short URL')

@section('content')

<div class="row mt-4 justify-content-center">

    <div class="col-md-8 col-lg-7">

        <div class="card">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    Create New Short URL
                </h5>
            </div>

            <div class="card-body px-4 py-4">

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form method="POST" action="{{ route('short-urls.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="original_url" class="form-label fw-semibold">
                            Original URL
                        </label>

                        <input type="url"
                               class="form-control form-control-lg"
                               id="original_url"
                               name="original_url"
                               placeholder="https://example.com/very/long/url"
                               value="{{ old('original_url') }}"
                               required>

                    </div>


                    <div class="d-flex gap-2 pt-2">

                        <button type="submit"
                                class="btn btn-outline-primary px-4">
                            Create Short URL
                        </button>

                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary"> Back </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
