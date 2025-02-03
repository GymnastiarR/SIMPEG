<x-guest-layout>
    <x-slot:title>
        {{ __('Log in') }}
    </x-slot:title>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="p-2 d-flex align-items-center min-vh-100">
        <section style="height: 420px"
            class="mx-auto overflow-hidden rounded shadow w-100 w-sm-75 w-md-50 w-lg-75 d-flex">
            <div style="position: relative;" class="d-none d-lg-block w-50">
                <!-- <h3>Welcome</h3> -->
                <img src="/login-background.jpg" style="position: absolute;" class="border w-100 h-100 object-fit-cover"
                    alt="">
            </div>
            <form class="p-4 flex-grow-1 d-flex flex-column" method="POST" action="{{ route('login') }}">
                @csrf

                <h1 class="mb-4 fs-2 fw-bold" style="margin-top: 30px">Login</h1>
                <div style="margin-bottom: 40px;" class="flex-grow-1 d-flex flex-column justify-content-center">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <x-input-error :messages="$errors->get('email')" />
                        <input name="email" type="email" class="form-control" id="email"
                            placeholder="name@example.com">
                    </div>

                    <!-- Passwoed -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password"
                            placeholder="********">
                    </div>

                    <button type="submit" class="px-4 btn btn-primary">Sign In</button>
                </div>
            </form>
        </section>
    </div>
</x-guest-layout>
