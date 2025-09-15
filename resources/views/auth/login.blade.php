@extends('panel.layouts.app')

@section('content')
    <main class="d-flex w-100" >
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome to Sigma Ecommerce</h1>
                            <p class="lead-50">
                                Sign in to manage your store and continue
                            </p>
                        </div>

                        <div class="card shadow-lg border-0" style="border-radius: 15px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.9);">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <img src="{{ asset('template/static/img/logo/logo-sigma.png') }}" alt="Sigma Ecommerce"
                                        class="img-fluid rounded-circle" width="100" height="100" style="border: 3px solid #66baea;" />
                                    <h4 class="mt-3 text-dark">Admin Login</h4>
                                </div>
                                <form method="POST" action="{{ route('login.post') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email Address</label>
                                        <input class="form-control form-control-lg" type="email" name="email"
                                            placeholder="Enter your email" required style="border-radius: 10px;" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Password</label>
                                        <input class="form-control form-control-lg" type="password" name="password"
                                            placeholder="Enter your password" required style="border-radius: 10px;" />
                                        <small class="text-muted">
                                            <a href="#" class="text-decoration-none">Forgot password?</a>
                                        </small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="remember-me"
                                                name="remember-me" checked>
                                            <span class="form-check-label fw-bold">
                                                Remember me next time
                                            </span>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary w-100" style="border-radius: 10px; background: linear-gradient(135deg, #66baea 0%, #a27c4b 100%); border: none;">Sign In</button>
                                    </div>
                                </form>
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3" style="border-radius: 10px;">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-white-50 small">© 2025 Sigma Ecommerce. All rights reserved.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
