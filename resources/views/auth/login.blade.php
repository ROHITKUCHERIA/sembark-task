@extends('layouts.app')

@section('title', 'Login - URL Shortener')

@section('content')

<div class="row justify-content-center mt-4">
    <div class="col-md-5">

        <div class="card shadow">

            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"name="email"class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"name="password"class="form-control"required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>

                </form>

            </div>

            <div class="card-footer text-center small text-muted">
                superadmin@example.com / password </br>
                admin1@example.com / password </br>
                member1@example.com / password
            </div>

        </div>

    </div>
</div>

@endsection


@push('scripts')
<script>

$('#loginForm').on('submit', function(e){

    e.preventDefault();

    let form = $(this);

    $.post(form.attr('action'), form.serialize())
        .done(function(){
            window.location.href = "{{ route('dashboard') }}";
        })
        .fail(function(){
            alert('Invalid credentials');
        });

});

</script>
@endpush
