<p class="tbr_weight-semi-bold mb-2">Area yang Dilayani</p>
@foreach ($therapist->therapistAreas as $area)
	<div class="tbr_block_info">
		<div>Kecamatan {{ getDistrictName($area->district_id) }}, {{ getRegencyName($area->regency_id) }}</div>
	</div>
@endforeach