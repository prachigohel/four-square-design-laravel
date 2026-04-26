@extends('layouts.portal')

@section('title', 'Login - Foursquaredesigns Portal')

@section('content')
<div class="login-page" style="background-image: url('{{ asset('images/kitchen-login.png') }}'); background-size: cover; background-position: center;">
    <div class="login-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4);"></div>
    <div class="login-card-container" style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: center; width: 100%; height: 100vh;">
        <div class="login-card" style="background: #fff; padding: 2.5rem; border-radius: 8px; width: 100%; max-width: 440px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
            <form action="{{ route('portal.dashboard') }}" class="login-form">
                <div class="form-group">
                    <label style="display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">Username*</label>
                    <input type="email" class="form-input" value="hello@gmail.com" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required>
                </div>
                <div class="form-group">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; margin-top: 1.5rem;">
                        <label style="font-size: 0.9rem; font-weight: 500; margin-bottom: 0;">Password*</label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>
                    <div style="position: relative;">
                        <input type="password" class="form-input" value="password" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required>
                        <i class="far fa-eye-slash" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #64748b; cursor: pointer;"></i>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                    <input type="checkbox" id="remember" style="cursor: pointer; accent-color: var(--primary-color);">
                    <label for="remember" style="font-size: 0.85rem; color: #64748b; cursor: pointer;">Remember me</label>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <div style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: #475569;">
                    Not a Member yet? <a href="#" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Sign up</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
