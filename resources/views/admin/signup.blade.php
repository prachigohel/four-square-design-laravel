@extends('layouts.portal')

@section('title', 'Sign Up - Four Square Designs Portal')

@section('styles')
<style>
    .signup-card {
        background: #fff;
        padding: 2.5rem 3rem;
        border-radius: 12px;
        width: 100%;
        max-width: 580px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
    }

    .signup-brand {
        text-align: center;
        margin-bottom: 1.75rem;
    }

    .signup-brand .brand-name {
        font-size: 1.15rem;
        font-weight: 900;
        letter-spacing: 0.08em;
        color: #020617;
        text-transform: uppercase;
    }

    .signup-brand .brand-name span {
        color: var(--primary-color);
    }

    .signup-brand .brand-sub {
        font-size: 0.78rem;
        color: #64748b;
        letter-spacing: 0.05em;
        margin-top: 0.2rem;
    }

    .signup-divider {
        height: 1px;
        background: #e2e8f0;
        margin-bottom: 1.75rem;
    }

    .signup-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #020617;
        margin: 0 0 0.25rem;
        text-align: center;
    }

    .signup-subtitle {
        font-size: 0.82rem;
        color: #64748b;
        text-align: center;
        margin-bottom: 1.75rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .form-field {
        margin-bottom: 1.25rem;
    }

    .form-field label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .form-field label .req {
        color: var(--primary-color);
        margin-left: 1px;
    }

    .field-input {
        width: 100%;
        padding: 0.7rem 0.9rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 6px;
        background: #f8fafc;
        font-size: 0.92rem;
        color: #020617;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }

    .field-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(250, 177, 51, 0.15);
        background: #fff;
    }

    .field-input.is-error {
        border-color: #ef4444;
    }

    .field-error {
        color: #ef4444;
        font-size: 0.76rem;
        margin-top: 0.3rem;
        display: block;
    }

    .password-wrap {
        position: relative;
    }

    .password-wrap .field-input {
        padding-right: 2.75rem;
    }

    .toggle-pw {
        position: absolute;
        right: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        cursor: pointer;
        font-size: 0.9rem;
        transition: color 0.2s;
    }

    .toggle-pw:hover {
        color: #475569;
    }

    .terms-row {
        display: flex;
        align-items: flex-start;
        gap: 0.6rem;
        margin-bottom: 1.5rem;
    }

    .terms-row input[type="checkbox"] {
        margin-top: 0.15rem;
        accent-color: var(--primary-color);
        cursor: pointer;
        flex-shrink: 0;
        width: 15px;
        height: 15px;
    }

    .terms-row label {
        font-size: 0.82rem;
        color: #64748b;
        cursor: pointer;
        line-height: 1.5;
    }

    .terms-row label a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
    }

    .signup-footer {
        text-align: center;
        margin-top: 1.25rem;
        font-size: 0.875rem;
        color: #475569;
    }

    .signup-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
    }

    @media (max-width: 520px) {
        .signup-card {
            padding: 2rem 1.5rem;
        }
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="login-page" style="background-image: url('{{ asset('images/kitchen-hero.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="login-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(2,6,23,0.72) 0%, rgba(250,177,51,0.18) 100%);"></div>
    <div class="login-card-container" style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: center; width: 100%; min-height: 100vh; padding: 2rem 1rem;">
        <div class="signup-card">

            {{-- Brand --}}
            <div class="signup-brand">
                <div class="brand-name">FOUR SQUARE<span> DESIGN</span></div>
                <div class="brand-sub">Client Portal</div>
            </div>
            <div class="signup-divider"></div>

            <h2 class="signup-title">Create your account</h2>
            <p class="signup-subtitle">Fill in the details below to get started</p>

            <form action="{{ route('portal.signup') }}" method="POST">
                @csrf

                {{-- Row 1: Name + Email --}}
                <div class="form-row">
                    <div class="form-field">
                        <label>Full Name <span class="req">*</span></label>
                        <input type="text" name="name" class="field-input {{ $errors->has('name') ? 'is-error' : '' }}" value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                        @error('name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label>Email Address <span class="req">*</span></label>
                        <input type="email" name="email" class="field-input {{ $errors->has('email') ? 'is-error' : '' }}" value="{{ old('email') }}" placeholder="hello@gmail.com" required>
                        @error('email')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Row 2: Password + Confirm Password --}}
                <div class="form-row">
                    <div class="form-field">
                        <label>Password <span class="req">*</span></label>
                        <div class="password-wrap">
                            <input type="password" name="password" id="password" class="field-input {{ $errors->has('password') ? 'is-error' : '' }}" placeholder="••••••••" required>
                            <i class="far fa-eye-slash toggle-pw" data-target="password"></i>
                        </div>
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label>Confirm Password <span class="req">*</span></label>
                        <div class="password-wrap">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="field-input" placeholder="••••••••" required>
                            <i class="far fa-eye-slash toggle-pw" data-target="password_confirmation"></i>
                        </div>
                    </div>
                </div>

                {{-- Role --}}
                <div class="form-field">
                    <label>Select Role <span class="req">*</span></label>
                    <select name="role_id" class="field-input {{ $errors->has('role_id') ? 'is-error' : '' }}" required>
                        <option value="">Select a role...</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Terms --}}
                <div class="terms-row">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms & Conditions</a></label>
                </div>

                <button type="submit" class="login-btn" style="text-transform: uppercase; letter-spacing: 0.08em;">Sign Up</button>

                <div class="signup-footer">
                    Already have an account? <a href="{{ route('portal.login') }}">Login</a>
                </div>
            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
    document.querySelectorAll('.toggle-pw').forEach(icon => {
        icon.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                input.type = 'password';
                this.classList.replace('fa-eye', 'fa-eye-slash');
            }
        });
    });
</script>
@endsection
@endsection
