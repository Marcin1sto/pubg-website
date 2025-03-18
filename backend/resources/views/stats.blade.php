@extends('layout')

@section('content')
	<div class="container mx-auto" style="margin-top: 73px">
		<div style="margin-top: 35px">
			<div class="grid grid-cols-1 md:grid-cols-2 p-5 lg:p-0" style="margin-top: 35px">
				<div class="flex justify-center order-1">
					<form class="formSearchPlayer flex items-center w-full p-10" method="GET" action="/stats">
						<div class="relative w-full">
							<div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
								<svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
							</div>
							<input type="text" id="player-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Nickname player" required autocomplete="off">
						</div>
						<button id="btnSubmit" type="submit" class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
							<svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>Search
						</button>
					</form>
				</div>
				@if(count($players) >= 15)
                    <div class="text-white flex justify-center items-center border border-gray-300 rounded-lg overflow-y-auto" style="height: 443px">
                        <table class="table-auto text-md text-left text-white w-full">
                            <tbody class=" overflow-auto">
                            @foreach($players->random(15) as $player)
                                <tr class="border-b dark:bg-gray-900 hover:bg-blue-800">
                                    <th scope="row"
                                        class="py-4 px-6 font-medium whitespace-nowrap ">
                                        {{ $player->playerName }}
                                    </th>
                                    <td class="py-4 px-6 border-r flex justify-end">
                                        <a href="{{ env('APP_URL') }}/stats/{{ $player->playerName }}" class="inline-flex items-center py-1 px-3 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                           Staty
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
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
		playerName = $('#player-name').val()
		checkFormAction()
	})

</script>
@endsection
