<x-guest-layout>
        <div class="login-box">
            <div class="card card-outline card-info rounded-0">
                <div class="card-header text-center">
                    <a href="#" class="h1 text-info"><b class="text-dark">Nziza</b>CRAFTS</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                        @include('layouts.partials.notification')
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember_me" name="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-info btn-block rounded-0">Sign In</button>
                            </div>
                        </div>
                    </form>
                    @if(Route::has('password.request'))
                        <p class="mb-1">
                            <a href="{{route('password.request')}}">I forgot my password</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>

</x-guest-layout>
