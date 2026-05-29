@extends('layouts.portal')

@section('title', 'Forgot Password - Foursquaredesigns Portal')

@section('content')
<div class="login-page" style="background-image: url('{{ asset('images/kitchen-login.png') }}'); background-size: cover; background-position: center;">
    <div class="login-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4);"></div>
    <div class="login-card-container" style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: center; width: 100%; height: 100vh;">
        <div class="login-card" style="background: #fff; padding: 2.5rem; border-radius: 8px; width: 100%; max-width: 440px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <p style="font-size: 0.95rem; color: #475569; font-weight: 500;">No worries, we'll send you reset instructions.</p>
            </div>
            @if (session('status'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; font-size: 0.9rem; text-align: center;">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('portal.forgot-password') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <label style="display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">Email Address*</label>
                    <input type="email" name="email" class="form-input" placeholder="Enter your email address" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required autofocus>
                    @error('email')
                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="login-btn">Send Reset Link</button>
                <div style="text-align: center; margin-top: 2rem; font-size: 0.9rem;">
                    <a href="{{ route('portal.login') }}" style="color: #64748b; text-decoration: none; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fas fa-arrow-left"></i> Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
