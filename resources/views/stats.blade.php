@extends('layout')

@section('content')
    <div class="text-white flex justify-center w-full h-screen">
        <div class="flex items-center">
            <div>
                <img class="w-full" src="images/statsimg2.png" alt="Stats Image PUBG">
            </div>
            <div class="grid grid-rows-2">
                <div class="w-full py-2">
                    <h1 class="text-white font-bold text-xl">Search for a player</h1>
                </div>
                <form class="formSearchPlayer flex items-center w-full" method="GET" action="/stats">
                    <div class="relative w-full">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="text" id="player-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Nickname player" required>
                    </div>
                    <button id="btnSubmit" type="submit" class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                        <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>Search
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const $form = $('.formSearchPlayer');
    let playerName = $('#player-name').val();

    function checkFormAction() {
        $form.attr('action' , "/stats/"+playerName)
    }

    $('#player-name').on('change', () => {
        console.log('asdasd')
        playerName = $('#player-name').val()
        checkFormAction()
    })

</script>
@endsection
