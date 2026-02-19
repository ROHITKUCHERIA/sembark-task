@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="row mb-3">
    <div class="col-12">

        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <a href="{{ route('short-urls.create') }}" class="btn btn-sm btn-light">
                + Create URL
            </a>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-12">

        <div class="card">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    {{ Auth::user()->company->name }} - URLs
                </h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-light">
                            <tr>
                                <th>Created By</th>
                                <th>Original URL</th>
                                <th>Short URL</th>
                                <th>Clicks</th>
                                <th>Created</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($shortUrls as $url)
                                <tr>
                                    <td>
                                        {{ $url->user->name }}
                                        ({{ $url->user->role }})
                                    </td>

                                    <td style="max-width:220px;">
                                        <a href="{{ $url->original_url }}"
                                           target="_blank"
                                           class="text-truncate d-inline-block"
                                           style="max-width:200px;">
                                            {{ $url->original_url }}
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ url('/s/' . $url->short_code) }}"
                                           target="_blank">
                                            {{ url('/s/' . $url->short_code) }}
                                        </a>
                                    </td>

                                    <td>
                                        {{ $url->clicks }}
                                    </td>

                                    <td>
                                        {{ $url->created_at->format('Y-m-d') }}
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No short URLs found in your company.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection
