<div class="card mt-0 mb-4 mb-lg-0">
	<div class="card-body pb-3">
		<h4 class="m-0 tbr_heading_info">Detail Pasien</h4>
		<div class="tbr_block_info">
			<div>Nama</div>
			<div>{{ $order->buyer_name }}</div>
		</div>
		<div class="tbr_block_info">
			<div>Keluhan yang dialami</div>
			<div>{{ $order->buyer_symptoms }}</div>
		</div>
		<h4 class="mt-4 mb-0 tbr_heading_info">Alamat Kunjungan</h4>
		<div class="tbr_block_info">
			<div>Provinsi</div>
			<div>{{ $order->buyer_province }}</div>
		</div>
		<div class="tbr_block_info">
			<div>Kabupaten</div>
			<div>{{ $order->buyer_regency }}</div>
		</div>
		<div class="tbr_block_info">
			<div>Kecamatan</div>
			<div>{{ $order->buyer_district }}</div>
		</div>
		<div class="tbr_block_info">
			<div>Kelurahan</div>
			<div>{{ $order->buyer_sub_district }}</div>
		</div>
		<div class="tbr_block_info">
			<div>Detail Alamat</div>
			<div>{{ $order->buyer_address }}</div>
		</div>
	</div>
</div>