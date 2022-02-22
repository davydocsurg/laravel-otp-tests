@extends('layouts.app')

@section('content')
    <div class="mx-auto col-lg-6">
        <h3 class="text-center">An OTP was sent to your email address.</h3>
        <div class="card">
            {{-- <div class="card-header">
                Enter OTP
            </div> --}}
            <div class="card-body">
                <form action="{{ route('submitOTP') }}" method="POST">
                    @csrf

                    <div class="form-group">

                        <div class="col-lg-8">
                            <label for="otp" class="col-form-label text-md-right">{{ __('Enter OTP') }}</label>
                            <input id="otp" type="number" class="form-control @error('otp') is-invalid @enderror" name="otp"
                                required autocomplete="otp" autofocus placeholder="Enter OTP">

                            @error('otp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <div class="col-lg-8">
                            <button type=" submit" class="btn btn-primary">
                                {{ __('Verify') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
