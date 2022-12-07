@extends('layout')

@section('content')
    <div class="text-white flex justify-center w-full mt-10">
        <div class="grid grid-cols-3 gap-1">
            Welcome :)
{{--            <div class="border border-green-500 p-5 m-5 rounded">--}}
{{--                <div class="flex items-center justify-center">Rozegraliśmy meczy</div>--}}
{{--                <div class="flex items-center justify-center p-5">{{ $allMatches }}</div>--}}
{{--            </div>--}}
{{--            <div class="border border-green-500 p-5 m-5 rounded">--}}
{{--                <div class="flex items-center justify-center">Zabiliśmy łącznie</div>--}}
{{--                <div class="flex items-center justify-center p-5">{{ $allKills }} graczy</div>--}}
{{--            </div>--}}
{{--            <div class="border border-green-500 p-5 m-5 rounded">--}}
{{--                <div class="flex items-center justify-center">Asystowaliśmy przy</div>--}}
{{--                <div class="flex items-center justify-center p-5">{{ $allAssists }} zabójstwach</div>--}}
{{--            </div>--}}
{{--            <div class="border border-green-500 p-5 m-5 rounded">--}}
{{--                <div class="flex items-center justify-center">Przejechaliśmy łacznie</div>--}}
{{--                <div class="flex items-center justify-center p-5">{{ $rideDistance }} km</div>--}}
{{--            </div>--}}
{{--            <div class="border border-green-500 p-5 m-5 rounded">--}}
{{--                <div class="flex items-center justify-center">Przepłyneliśmy łodzią</div>--}}
{{--                <div class="flex items-center justify-center p-5">{{ $swimDistance }} km</div>--}}
{{--            </div>--}}
{{--            <div class="border border-green-500 p-5 m-5 rounded">--}}
{{--                <div class="flex items-center justify-center">Przeszliśmy łącznie</div>--}}
{{--                <div class="flex items-center justify-center p-5">{{ $walkDistance }} km</div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
