<div class="max-w-2xl mx-auto">
	<div class="p-3 bg-gradient-to-r from-indigo-800 to-blue-500 text-center relative">

		<div class="text-white">
			<div class="h-5 w-5 rounded-full animate-ping bg-blue-500" wire:loading></div>
			<div wire:loading.remove>
				<div class="uppercase text-sm text-gray-300">
				available
				</div>
				<div class="text-xl">
				${{ number_format($total_available, 0, ',', ' ') }}
				</div>
				@if(2 == 1)
				<div class="uppercase text-sm text-gray-300 mt-3">
				quantity
				</div>
				<div class="text-xl">
				{{ $total_quantity }}
				</div>
				@endif
				<div class="uppercase text-sm text-gray-300 mt-3">
				active trades p / l
				</div>
				<div class="text-xl">
				@if($current_profit < 0) <span class="text-xl">-</span> @endif
				${{ number_format(abs($current_profit), 2, ',', ' ') }}
				</div>
			</div>

		</div>
		<div class="flex flex-col text-white text-xs uppercase">
			<div>
				<div class="mt-4 mb-2 uppercase text-center text-xs text-gray-300">
				Exchanges
				</div>
				<div class="h-3 w-3 rounded-full animate-ping bg-white" wire:loading></div>
				<div class="text-left" wire:loading.remove>
						<a class="inline-block mt-1 mr-1 rounded p-1 cursor-pointer @if($selectedExchange == 0) border border-gray-300 @endif"	wire:click="selectExchange(0)">ALL</a>
						@foreach($user_exchanges as $exchange)
								<a class="inline-block mt-1 mr-1 rounded p-1 cursor-pointer @if($selectedExchange == $exchange->id) border border-gray-300 @endif" 
									 wire:click="selectExchange({{ $exchange->id }})">{{ $exchange->name }}</a>
						@endforeach
				</div>
			</div>
			<div class="mb-1">
				<div class="mt-4 mb-2 uppercase text-center text-xs text-gray-300">
				Coins
				</div>
				<div class="h-3 w-3 rounded-full animate-ping bg-white" wire:loading></div>
				<div class="text-left" wire:loading.remove>
						<a class="inline-block mt-1 mr-1 rounded p-1 cursor-pointer @if(empty($selectedCoins)) border border-gray-300 @endif" wire:click="clearSelectedCoins()">ALL</a>
						@foreach($user_coins as $coin)
								<a class="inline-block mt-1 mr-1 rounded p-1 cursor-pointer
								@if(in_array($coin->id, $selectedCoins)) border border-gray-300 @endif
								"
								@if(in_array($coin->id, $selectedCoins)) wire:click="unselectCoin({{ $coin->id }})" @else wire:click="selectCoin({{ $coin->id }})" @endif
								>{{ $coin->symbol }}@if(in_array($coin->id, $selectedCoins)) <i class="font-xs uppercase text-red-400">x</i> @endif</a>
						@endforeach
				</div>
			</div>
		</div>
	</div>


	@foreach($user_trades as $trade)
		<div class="p-4 bg-white flex" wire:loading.remove>

			<div class="flex-1 pt-4">
				{{-- <img src="logos/{{ strtolower($trade->coin->symbol) }}-icon-200.png" class="w-10 mx-auto" /> --}}
				<div class="mx-auto text-center text-black text-sm md:text-lg ">{{ $trade->coin->symbol }}</div>	
			</div>

			<div class="flex-auto pl-3">
				<div class="flex">

					<div class="flex-auto">
						<div class="uppercase text-blue-500 font-semibold md:text-lg">{{ $trade->exchange->name }}</div>
						<div class="font-light text-xs text-gray-400">Paid ${{ number_format($trade->paid, 2) }}</div>
						<div class="text-gray-400 text-xs">Available ${{ number_format($trade->available, 2) }}</div>
					</div>
					
					<div class="flex-auto text-right">
						<div class="text-base font-semibold md:text-xl @if($trade->profit < 0) text-red-400 @else text-green-400 @endif">
							@if($trade->profit < 0) - @else + @endif
							${{ number_format(abs($trade->profit), 2, ',', ' ') }}
						</div>
						<div class="text-xs md:text-lg @if($trade->profit < 0) text-red-400 @else text-green-400 @endif"">{{ round(($trade->profit * 100) / $trade->paid, 2) }}%</div>
						<a href="" class="flex justify-end">
							<x-heroicon-s-chevron-down class="text-gray-300 h-6 w-6 -mr-1" />
						</a>
					</div>

				</div>
				
				<div class="text-left text-gray-600 text-xs">
					Bought {{ number_format($trade->quantity, 6) }} at ${{ number_format($trade->open_price, 4) }}
				</div>
					
			</div>
			
		</div>
		

	@endforeach

</div>