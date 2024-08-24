<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased" x-data="globalState()" x-init="initState()">
    <div class="min-h-screen bg-gray-100">
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Master Toast -->
    <template x-if="toast.show">
        <div id="master-toast"
            class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg  dark:text-gray-400 dark:bg-gray-700 fixed top-[85%] right-5 drop-shadow-2xl z-50"
            role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg"
                :class="toast.success === 1 ? 'text-green-500 bg-green-100 dark:bg-green-800 dark:text-blue-200' :
                    'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200'">
                <template x-if="toast.success === 1">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 11.917 9.724 16.5 19 7.5" />
                    </svg>
                </template>
                <template x-if="toast.success === 0">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </template>
                <span class="sr-only">Fire icon</span>
            </div>
            <div class="ms-3 text-sm font-normal" x-text="toast.message"></div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#master-toast" id="master-toast-trigger" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </template>

    <script>
        function globalState() {
            return {
                toast: {
                    success: 0,
                    show: false,
                    message: "",
                    sound: () => {
                        var audio = new Audio("{{ asset('audios/popup.mp3') }}");
                        audio.play();
                        audio.play();
                    }
                },
                initState() {
                    this.dismissToast();

                    <?php if (session('success') || session('error')) { ?>
                    this.toastAlert({{ session('success') ? '1' : '0' }}, "{{ session('success') }}{{ session('error') }}");
                    <?php } ?>

                    <?php if ($errors->any()) { ?>
                    this.toastAlert(0, "{{ $errors->first() }}");
                    <?php } ?>
                },
                dismissToast() {
                    setTimeout(() => {
                        this.toast.show = false;
                    }, 1500);
                },
                toastAlert(status, message) {
                    this.toast.sound();
                    this.toast.show = 1;
                    this.toast.success = status;
                    this.toast.message = message;
                    this.dismissToast();
                }
            }
        }
    </script>
    @stack('modals')
    @livewireScripts
    @stack('scripts')
    @yield('scripts')
</body>

</html>
