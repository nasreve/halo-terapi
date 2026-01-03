<p class="tbr_weight-semi-bold mb-2">Data Personal Terapis</p>
<div class="tbr_block_info">
	<div>Nama dan Gelar</div>
	<div>{{ $therapist->name }}</div>
</div>
<div class="tbr_block_info">
	<div>Provinsi</div>
	<div>{{ $therapist->province->name }}</div>
</div>
<div class="tbr_block_info">
	<div>Kabupaten</div>
	<div>{{ $therapist->regency->name }}</div>
</div>
<div class="tbr_block_info">
	<div>Kecamatan</div>
	<div>{{ $therapist->district->name }}</div>
</div>
<div class="tbr_block_info">
	<div>Kelurahan</div>
	<div>{{ $therapist->village }}</div>
</div>
<div class="tbr_block_info">
	<div>Detail Alamat</div>
	<div>{{ $therapist->address }}</div>
</div>
<div class="tbr_block_info">
	<div>Alamat Asal</div>
	<div>{{ $therapist->address_origin }}</div>
</div>
<div class="tbr_block_info">
	<div>Agama</div>
	<div>{{ $therapist->religion }}</div>
</div>
<div class="tbr_block_info">
	<div>Nomor Telepon</div>
	<div>62 {{ $therapist->phone }}</div>
</div>
<div class="tbr_block_info">
	<div>Nomor WhatsApp</div>
	<div>62 {{ $therapist->whatsapp }}</div>
</div>
<div class="tbr_block_info">
	<div>Tahun Lulus</div>
	<div>{{ $therapist->year_of_graduate }}</div>
</div>