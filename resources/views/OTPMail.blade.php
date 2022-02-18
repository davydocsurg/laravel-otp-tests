@extends('layouts.app')

@component('mail::message')
    # Introduction

    Your OTP is {{ $otp }}

    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
