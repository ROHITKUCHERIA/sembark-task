@extends('layouts.app')
@section('title', 'SuperAdmin Dashboard')
@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-link"></i>All Short URLs
                </h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped" id="urlsTable">

                        <thead class="table-light">
                            <tr>
                                <th>Company</th>
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
                                        {{ $url->company->name }}
                                    </td>

                                    <td>
                                        {{ $url->user->name }}
                                        ({{ $url->user->role }})
                                    </td>

                                    <td style="max-width:220px;">
                                        <a href="{{ $url->original_url }}"
                                           target="_blank"
                                           class="d-inline-block text-truncate"
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
                                    <td colspan="6" class="text-center">
                                        No short URLs found
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
