<?php
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
<x-app-layout>
    <section class="py-4 sm:py-24" x-data="progressBar">
        <div class="container">
            <div class="w-full grid grid-cols-3 gap-1.5 mb-5">
                <div class="w-full p-4 rounded-xl bg-white shadow-sm">
                    <h6 class="text-sm">Requested</h6>
                    <p class="text-base">{{ $count_requested }}</p>
                </div>

                <div class="w-full p-4 rounded-xl bg-white shadow-sm">
                    <h6 class="text-sm">Helped</h6>
                    <p class="text-base">{{ $count_helped }}</p>
                </div>

                <div class="w-full p-4 rounded-xl bg-white shadow-sm">
                    <h6 class="text-sm">Need Help</h6>
                    <p class="text-base">{{ $count_need_help }}</p>
                </div>
            </div>
            <div class="w-full p-4 sm:p-12 rounded-xl bg-white shadow-sm overflow-hidden">
                <h1 class="text-red-600 text-center">Emergency Help list</h1>
                <div class="flex gap-5 items-center">
                    <a href="{{ route('need-help.create') }}"
                        class="text-blue-700 font-medium text-center mx-auto mt-2.5">Request a help</a>
                </div>

                <template x-if="isReload">
                <a href="{{ route('need-help.index') }}"
                class="bg-blue-600 rounded-md text-white px-2 py-1 text-sm font-medium text-center mx-auto mt-2.5 block w-max">Page Reload</a>
                </template>

                <div class="flex flex-col gap-4 mt-6">
                    @foreach ($needHelps as $needHelp)
                        <div
                            class="w-full sm:p-6 rounded-md overflow-hidden border flex flex-col sm:flex-row 2.5 sm:gap-5">
                            @if (isset($needHelp->picture))
                                <div class="max-w-[500px] aspect-[16/9]">
                                    <img class="w-full h-full object-cover object-center" src="{{ $needHelp->picture }}"
                                        alt="Image" />
                                </div>
                            @endif
                            <div class="w-full p-4 sm:p-0">
                                <div class="col-span-2 ">
                                    <div>
                                        <p class="text-sm">
                                            <?php
                                            echo time_elapsed_string($needHelp->created_at);
                                            ?>
                                        </p>
                                        <h2 class="mb-1.5">{{ $needHelp->details }}</h2>
                                    </div>

                                    <div class="flex flex-col ">
                                        <div class="flex flex-wrap gap-2 items-center">
                                            <p class="font-medium">Location: </p>
                                            <a class="text-blue-600 underline"
                                                href="https://maps.google.com/?q={{ $needHelp->location }}"
                                                target="_blank">{{ $needHelp->location }}</a>
                                        </div>

                                        <div class="flex flex-wrap gap-2 items-center">
                                            <p class="font-medium">Phone: </p>
                                            <a class="text-blue-600 underline" href="tel:{{ $needHelp->phone }}"
                                                target="_blank">{{ $needHelp->phone }}</a>
                                        </div>

                                        <div class="flex flex-wrap gap-2 items-center">
                                            <p class="font-medium">Phone: </p>
                                            <a class="text-blue-600 underline"
                                                href="tel:{{ $needHelp->phone_optional }}"
                                                target="_blank">{{ $needHelp->phone_optional }}</a>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end gap-2.5">
                                        <div class="w-4 h-[1px] bg-gray-600"></div>
                                        <p class="text-sm">{{ $needHelp->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="container pagination mt-5">
                    {{ $needHelps->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('progressBar', () => ({
                isReload: '',
                init() {
                    Echo.channel('helps')
                    .listen('OrderShipmentStatusUpdated', (e) => {
                        this.isReload = true;
                    });
                },
            }));
        });
    </script>
</x-app-layout>
