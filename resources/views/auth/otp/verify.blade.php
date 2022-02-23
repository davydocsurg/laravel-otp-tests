@extends('layouts.app')

@section('content')
    <div class="mx-auto col-lg-6">
        <h3 class="text-center">An OTP was sent to your email address.</h3>

        @if ($errors->count() > 0)
            <div class="alert bg-danger">
                @foreach ($errors->all() as $error)
                    <b class="text-white">
                        ⚠️ {{ $error }}
                    </b>
                @endforeach
            </div>
        @endif

        <div class="card mx-auto">
            {{-- <div class="card-header">
                Enter OTP
            </div> --}}
            <div class="card-body">
                <div class="mx-auto">
                    <form action="{{ route('submitOTP') }}" method="POST">
                        @csrf

                        <div class="form-group">

                            <div class="col-lg-8">
                                <label for="otp" class="col-form-label text-md-right">{{ __('Enter OTP') }}</label>
                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror"
                                    name="otp" minlength="6" maxlength="6" autofocus placeholder="******">

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="col-lg-8">
                                <button type=" submit" class="btn btn-primary">
                                    {{ __('Verify') }}
                                </button>
                            </div>
                        </div>

                    </form>
                    <hr>
                    <form action="" id="resendOTPForm">
                        @csrf
                        <div class="form-group">
                            <div class="ml-3">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        <button class="btn btn-outline-primary">
                                            <span>Resend OTP</span>
                                            <span class="spinner-border spinner-border-sm mb-" role="status"
                                                aria-hidden="true" style="display: none">
                                            </span>
                                        </button>
                                        <strong>
                                            via:
                                        </strong>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="via" id="sms" value="sms">

                                            <label class="form-check-label text-dark font-weight-bold" for="sms">
                                                {{ __('SMS') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="via" id="email" value="email"
                                                checked>

                                            <label class="form-check-label text-dark font-weight-bold" for="email">
                                                {{ __('E-Mail') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            // $('#email').submit(el => {
            //     el.preventDefault();
            //     sendSMS(el)
            // })

            // $('#sms').submit(el => {
            //     el.preventDefault();
            //     sendEmail(el)
            // })

            $('#resendOTPForm').submit(el => {
                el.preventDefault();
                sendNewOTP(el)
            })
        })

        function sendNewOTP(el) {
            offError()
            sendReq()

            let data = new FormData(el.target)
            let url = `{{ route('resendOTP') }}`

            goPost(url, data)
                .then(suc => {
                    // location.reload()
                    stopLoading()
                    handleOTPResendSuccess(suc)

                })
                .catch(err => {

                    handleOTPResendErr(err)

                })
        }

        function sendEmail(el) {
            offError()
            sendReq()

            let data = new FormData(el.target)
            let url = `{{ route('resendOTP') }}`

            goPost(url, data)
                .then(suc => {
                    // location.reload()
                    stopLoading()
                    handleOTPResendSuccess(suc)
                    clearForm()
                })
                .catch(err => {

                    handleErr(err)
                    handleOTPResendErr(err)

                })
        }
    </script>
@endpush
