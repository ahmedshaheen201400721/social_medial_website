<x-guest-layout>
    {{-- <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        {{-- <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
       
        </form> --}}

        <!-- component -->
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div
                    class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                    style="background-image: url('https://source.unsplash.com/Mv9hjnEUHR4/600x800')"
                ></div>
                <!-- Col -->
                <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="pt-4 text-2xl text-center">Create an Account!</h3>
                    <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" enctype="multipart/form-data" method="POST" action="{{ route('register') }}" >
                        @csrf
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <x-input name="username" ></x-input>
                            </div>
                            <div class="md:ml-2">
                                <x-input name="name" ></x-input>

                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input name="email" ></x-input>
                        </div>

                        <div class="mb-4">
                            <x-input name="avatar" type='file' :required="false"></x-input>
                        </div>

                        <div class="mb-4">
                            <x-input name="cover" type='file' :required="false"></x-input>
                        </div>

                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <x-input type="password" name="password" ></x-input>

                            </div>
                            <div class="md:ml-2">
                                <x-input type="password" name="password_confirmation" ></x-input>

                            </div>
                        </div>
                        <div class="mb-6 text-center">
                            <input
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="submit"
                                value="Register Account"

                            >
                                
                        </div>
                        <hr class="mb-6 border-t" />
                        <div class="text-center">
                            <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                 href="{{route('password.request')}}"
                            >
                                Forgot Password?
                            </a>
                        </div>
                        <div class="text-center">
                            <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="{{route('login')}}"
                            >
                                Already have an account? Login!
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    {{-- </x-auth-card> --}}
</x-guest-layout>
