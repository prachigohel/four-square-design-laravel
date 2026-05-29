@extends('layouts.portal')

@section('title', 'Sign Up - Four Square Design Portal')

@section('content')
<div class="login-page" style="background-image: url('{{ asset('images/kitchen-login.png') }}'); background-size: cover; background-position: center;">
    <div class="login-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4);"></div>
    <div class="login-card-container" style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: center; width: 100%; height: 100vh;">
        <div class="login-card" style="background: #fff; padding: 2.5rem; border-radius: 8px; width: 100%; max-width: 540px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
            <form action="{{ route('portal.signup') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <label style="display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">Full Name*</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Enter your full name" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required autofocus>
                    @error('name')
                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label style="display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">Email Address*</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="hello@gmail.com" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required>
                    @error('email')
                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label style="display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">Password*</label>
                    <div style="position: relative;">
                        <input type="password" name="password" class="form-input" placeholder="••••••••" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required>
                        <i class="far fa-eye-slash" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #64748b; cursor: pointer;"></i>
                    </div>
                    @error('password')
                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label style="display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">Confirm Password*</label>
                    <div style="position: relative;">
                        <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required>
                        <i class="far fa-eye-slash" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #64748b; cursor: pointer;"></i>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label style="display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">Select Role*</label>
                    <select name="role_id" class="form-input" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 4px; background: #f8fafc;" required>
                        <option value="">Select a role...</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div style="display: flex; align-items: flex-start; gap: 0.5rem; margin-top: 1rem;">
                    <input type="checkbox" id="terms" style="cursor: pointer; accent-color: var(--primary-color); margin-top: 0.2rem;" required>
                    <label for="terms" style="font-size: 0.85rem; color: #64748b; cursor: pointer;">I agree to the <a href="#" style="color: var(--primary-color); text-decoration: none;">Terms & Conditions</a></label>
                </div>
                <button type="submit" class="login-btn">Sign Up</button>
                <div style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: #475569;">
                    Already have an account? <a href="{{ route('portal.login') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Login</a>
                </div>
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
