@extends('layouts.portal')

@section('title', 'Login - Four Square Designs Portal')

@section('content')
<div class="login-page" style="background-image: url('{{ asset('images/kitchen-hero.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="login-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(2,6,23,0.72) 0%, rgba(250,177,51,0.18) 100%);"></div>
    <div class="login-card-container" style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: center; width: 100%; height: 100vh;">
        <div class="login-card" style="background: #fff; padding: 2.5rem; border-radius: 8px; width: 100%; max-width: 440px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div class="sidebar-brand" style="display: inline-flex; background: transparent; padding: 0; color: #020617; font-size: 1rem;">
                    <span class="brand-full" style="font-size: 1.1rem; letter-spacing: 0.08em;">FOUR SQUARE<span style="color: var(--primary-color);"> DESIGNS</span></span>
                </div>
                <p style="margin: 0.5rem 0 0; font-size: 0.82rem; color: #64748b; letter-spacing: 0.04em;">Client Portal</p>
            </div>
            <form action="{{ route('portal.login') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <label style="display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">Email*</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required autofocus>
                    @error('email')
                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; margin-top: 1.5rem;">
                        <label style="font-size: 0.9rem; font-weight: 500; margin-bottom: 0;">Password*</label>
                        <a href="{{ route('portal.forgot-password') }}" class="forgot-link">Forgot password?</a>
                    </div>
                    <div style="position: relative;">
                        <input type="password" name="password" class="form-input" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required>
                        <i class="far fa-eye-slash" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #64748b; cursor: pointer;"></i>
                    </div>
                    @error('password')
                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                    <input type="checkbox" name="remember" id="remember" style="cursor: pointer; accent-color: var(--primary-color);">
                    <label for="remember" style="font-size: 0.85rem; color: #64748b; cursor: pointer;">Remember me</label>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script>
    document.querySelectorAll('.fa-eye-slash, .fa-eye').forEach(icon => {
        icon.addEventListener('click', function() {
            const input = this.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            }
        });
    });
</script>
@endsection
@endsection
