@extends('layouts.app')

@section('title', 'Manage Invitations')

@section('content')

<div class="row mt-3">
    <div class="col-12">

        <div class="card">

            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    Invitations
                </h5>

                <a href="{{ route('invitations.create') }}"
                   class="btn btn-sm btn-light">
                    + New Invitation
                </a>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-light">
                            <tr>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Company</th>
                                <th>Invited By</th>
                                <th>Expires</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($invitations as $invitation)
                            {{-- @dd($invitation)  --}}
                                <tr>
                                    <td>
                                        {{ $invitation->email }}
                                    </td>

                                    <td>
                                        {{ $invitation->role }}
                                    </td>

                                    <td>
                                        {{ $invitation->company->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $invitation->inviter->name }}
                                    </td>

                                    <td>
                                        {{ $invitation->expires_at->format('Y-m-d') }}
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No invitations found.
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
