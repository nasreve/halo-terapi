<div class="card mt-0 mb-4">
	<div class="card-body pt-3 pr-4 pb-3 pl-4">
		<div class="tbr_block_info">
			<div>ID Pesanan</div>
			<div>{{ $order->order_id }}</div>
		</div>
		<div class="tbr_block_info">
			<div>Terapis</div>
			<div>
				@if ($order->therapist()->exists())
					<a class="tbr_text-success" href="{{ route('therapist.edit', $order->therapist->id) }}">
						{{ $order->therapist->name }}
					</a>
				@else
					<a class="tbr_text-success" href="javascript:void(0)" style="cursor: default">
						{{ $order->therapist->name }}
					</a>
				@endif
			</div>
		</div>
		<div class="tbr_block_info">
			<div>Referrer</div>
			<div>
				@if ($order->referrer()->exists())
					<a class="tbr_text-success" href="{{ route('referrer.edit', $order->referrer->id) }}">
						{{ $order->referrer->getReferrerName() }}
					</a>
				@else
					<a class="tbr_text-grey" href="javascript:void(0)" style="cursor: default">
						Tidak ada
					</a>
				@endif
			</div>
		</div>
		<div class="tbr_block_info">
			<div>Dibuat Pada</div>
			<div>{{ formatDate($order->created_at, 'd F Y \j\a\m H.i') }}</div>
		</div>
	</div>
</div>
<div class="card mt-0 mb-4 mb-lg-0">
	<div class="card-body pt-4 pr-4 pb-3 pl-4">
		<p class="tbr_weight-semi-bold mb-2">Layanan</p>
		@foreach ($order->orderItems as $orderItem)
			<div class="tbr_block_info">
				<div class="tbr_text-primary">{{ $orderItem->service }}</div>
				<div>{{ formatPrice($orderItem->rate) }}</div>
			</div>
		@endforeach
		<div class="tbr_block_info">
			<div class="help-block mb-0"><em>Yang harus dibayar pasien :</em></div>
			<div>
				<h5 class="tbr_text-danger m-0">{{ formatPrice($order->transaction_amount) }}</h5>
			</div>
		</div>
		<div class="tbr_block_info">
			<div>Metode Pembayaran</div>
			<div>{{ $order->buyer_payment_method }}</div>
		</div>
	</div>
</div>