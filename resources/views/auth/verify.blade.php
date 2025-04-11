@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive">
                            <i class="bi bi-check-circle"></i> {{ __('A fresh verification link has been sent to your email address.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <p class="mb-3">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                    <p>{{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-decoration-none">
                                <i class="bi bi-arrow-clockwise"></i> {{ __('click here to request another') }}
                            </button>.
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 10px;
        }

        .alert {
            border-radius: 8px;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .card-header {
            font-weight: bold;
            font-size: 1.25rem;
        }
        
        .container {
            max-width: 960px;
        }
    </style>
@endpush
