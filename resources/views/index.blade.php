@extends('layout')

@section('content')
    <div class="container mx-auto h-screen">
        <div class="text-white mt-10 flex justify-center text-2xl mb-10 uppercase">Nasza społeczność</div>
        <div class="px-4 py-16 mx-auto sm:max-w-xl text-white md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="grid grid-cols-2 row-gap-8 md:grid-cols-4">
                <div class="text-center md:border-r">
                    <h6 class="text-4xl font-bold lg:text-5xl xl:text-6xl">{{ $players }}</h6>
                    <p class="text-sm font-medium tracking-widest uppercase lg:text-base" style="color: #22a0ec">
                        Graczy
                    </p>
                </div>
                <div class="text-center md:border-r">
                    <h6 class="text-4xl font-bold lg:text-5xl xl:text-6xl">4</h6>
                    <p class="text-sm font-medium tracking-widest uppercase lg:text-base" style="color: #22a0ec">
                        Moderatorów
                    </p>
                </div>
                <div class="text-center md:border-r">
                    <h6 class="text-4xl font-bold lg:text-5xl xl:text-6xl">{{ round(($allKills / 1000), 1) }}K</h6>
                    <p class="text-sm font-medium tracking-widest uppercase lg:text-base" style="color: #22a0ec">
                        Zabójstw
                    </p>
                </div>
                <div class="text-center">
                    <h6 class="text-4xl font-bold lg:text-5xl xl:text-6xl">{{ round(($allWins / 1000), 1) }}K</h6>
                    <p class="text-sm font-medium tracking-widest uppercase lg:text-base" style="color: #22a0ec">
                        Wygranych Meczy
                    </p>
                </div>
            </div>
        </div>
        <div class="text-white mt-10 flex justify-center text-2xl mb-10 uppercase">Współpracujący z nami stremerzy</div>
        <div class="px-4 py-16 mx-auto text-white sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="grid grid-cols-2 row-gap-8 md:grid-cols-4">
                <div class="text-center">
                    <h6 class="text-3xl font-bold"><a href="https://www.twitch.tv/diehl" target="_blank">di3hl</a></h6>
                    <a href="https://www.twitch.tv/di3hl" target="_blank" class="font-bold" style="color: #22a0ec">twitch.tv/di3hl</a>
                </div>
                <div class="text-center">
                    <h6 class="text-3xl font-bold"><a href="#" target="_blank">Wolne</a></h6>
                    <a href="#" target="_blank" class="font-bold" style="color: #22a0ec">Zacznij współpracę z nami!</a>
                </div>
{{--                <div class="text-center">--}}
{{--                    <h6 class="text-3xl font-bold text-deep-purple-accent-400">12.9K</h6>--}}
{{--                    <p class="font-bold">Subscribers</p>--}}
{{--                </div>--}}
{{--                <div class="text-center">--}}
{{--                    <h6 class="text-3xl font-bold text-deep-purple-accent-400">24.5K</h6>--}}
{{--                    <p class="font-bold">Cookies</p>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="text-white mt-10 flex justify-center text-2xl mb-10 uppercase">Nasze wydarzenia.</div>
        <div class="px-4 py-16 mx-auto text-white sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="grid grid-cols-2 row-gap-8 md:grid-cols-4">
                @foreach($events as $event)
                <div class="text-center">
                    <h6 class="text-3xl font-bold"><a href="https://www.twitch.tv/diehl" target="_blank">{{$event['name']}} {{ $event['number'] }}</a></h6>
                    <p class="text-sm font-bold tracking-widest uppercase lg:text-base" style="color: #22a0ec">
                        {{ $event['type'] }} - {{ $event['group_max_players'] === 2 ? 'DUO' : 'FPP' }}
                    </p>
                    <a href="https://www.twitch.tv/di3hl" target="_blank" class="font-medium text-sm" style="color: #22a0ec">{{ date('Y-m-d', strtotime($event['created_at'])) }}</a>
                </div>
                @endforeach
            </div>
        </div>
{{--        <div class="text-white mt-10 flex justify-center text-2xl mb-10">Zewnętrzne wydarzenia.</div>--}}
    </div>

@endsection
