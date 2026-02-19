@extends('layouts.app')
@section('title', 'Member Dashboard')
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
                    My Short URLs
                </h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-light">
                            <tr>
                                <th>Original URL</th>
                                <th>Short URL</th>
                                <th>Clicks</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($shortUrls as $url)
                                <tr>
                                    {{-- @dd($url) --}}
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

                                    <td>
                                       
                                        <button class="btn btn-sm btn-outline-danger delete-btn"
                                                data-id="{{ $url->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No short URLs yet.
                                        <a href="{{ route('short-urls.create') }}"
                                           class="btn btn-sm btn-success ms-2">
                                            Create One
                                        </a>
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


@push('scripts')
<script>

$(function(){

    $('.delete-btn').click(function(){

        let id = $(this).data('id');

        if(confirm('Are you sure you want to delete this URL?')){

            $.ajax({
                url: '/short-urls/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(){
                    location.reload();
                },
                error: function(){
                    alert('Something went wrong');
                }
            });

        }

    });

});

</script>
@endpush
