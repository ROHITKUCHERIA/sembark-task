@extends('layouts.app')

@section('title', 'Send Invitation')

@section('content')

<div class="row justify-content-center mt-4">
    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    Send Invitation
                </h5>
            </div>

            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('invitations.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role"
                                class="form-select"
                                required>
                            <option value="">Select Role</option>

                            @if(Auth::user()->isSuperAdmin())
                                <option value="Admin">Admin</option>
                            @elseif(Auth::user()->isAdmin())
                                <option value="Admin">Admin</option>
                                <option value="Member">Member</option>
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Company</label>
                        <select name="company_id"
                                class="form-select"
                                required>

                            <option value="">Select Company</option>

                            @foreach($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ Auth::user()->isAdmin() && Auth::user()->company_id == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>

                        @if(Auth::user()->isAdmin())
                            <small class="text-muted">
                                You can only invite users to your own company.
                            </small>
                        @endif
                    </div>

                    <div class="alert alert-info">
                        @if(Auth::user()->isSuperAdmin())
                            SuperAdmin can invite Admin or Member to any company.
                        @elseif(Auth::user()->isAdmin())
                            Admin can invite users only to their own company.
                        @endif
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit"class="btn btn-primary">Send Invitation</button>

                        <a href="{{ route('invitations.index') }}"class="btn btn-secondary"> Back</a>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
