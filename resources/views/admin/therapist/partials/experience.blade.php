<p class="tbr_weight-semi-bold mb-2">Pengalaman</p>
<div class="accordion tbr_accordion_line" id="experience">
	<div class="card">
		<div class="card-header" id="headingGraduate">
			<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#graduate" aria-expanded="true" aria-controls="graduate">
				Riwayat pendidikan formal
				<div class="tbr_icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
						<g id="arrow-ios-back" transform="translate(0.319 24) rotate(-90)" opacity="0.5">
							<rect id="Rectangle_31" data-name="Rectangle 31" width="24" height="24" transform="translate(24 -0.319) rotate(90)" fill="#777" opacity="0"/>
							<path id="Path_3" data-name="Path 3" d="M13.677,18.634a.974.974,0,0,1-.76-.36l-4.7-5.843a.974.974,0,0,1,0-1.237l4.869-5.843a.975.975,0,1,1,1.5,1.247l-4.353,5.22,4.207,5.22a.974.974,0,0,1-.76,1.6Z" transform="translate(-0.209 -0.024)" fill="#777"/>
						</g>
					</svg>
				</div>
			</button>
		</div>
		<div id="graduate" class="collapse show" aria-labelledby="headingGraduate" data-parent="#experience">
			<div class="card-body">
			{!!$therapist->edu_history!!}
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header" id="headingWorkshop">
			<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#workshop" aria-expanded="false" aria-controls="workshop">
				Riwayat seminar dan pelatihan
				<div class="tbr_icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
						<g id="arrow-ios-back" transform="translate(0.319 24) rotate(-90)" opacity="0.5">
							<rect id="Rectangle_31" data-name="Rectangle 31" width="24" height="24" transform="translate(24 -0.319) rotate(90)" fill="#777" opacity="0"/>
							<path id="Path_3" data-name="Path 3" d="M13.677,18.634a.974.974,0,0,1-.76-.36l-4.7-5.843a.974.974,0,0,1,0-1.237l4.869-5.843a.975.975,0,1,1,1.5,1.247l-4.353,5.22,4.207,5.22a.974.974,0,0,1-.76,1.6Z" transform="translate(-0.209 -0.024)" fill="#777"/>
						</g>
					</svg>
				</div>
			</button>
		</div>
		<div id="workshop" class="collapse" aria-labelledby="headingWorkshop" data-parent="#experience">
			<div class="card-body">
			{!!$therapist->workshop_history!!}
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header" id="headingIntership">
			<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#intership" aria-expanded="false" aria-controls="intership">
				Pengalaman praktik kerja lapangan (PKL)
				<div class="tbr_icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
						<g id="arrow-ios-back" transform="translate(0.319 24) rotate(-90)" opacity="0.5">
							<rect id="Rectangle_31" data-name="Rectangle 31" width="24" height="24" transform="translate(24 -0.319) rotate(90)" fill="#777" opacity="0"/>
							<path id="Path_3" data-name="Path 3" d="M13.677,18.634a.974.974,0,0,1-.76-.36l-4.7-5.843a.974.974,0,0,1,0-1.237l4.869-5.843a.975.975,0,1,1,1.5,1.247l-4.353,5.22,4.207,5.22a.974.974,0,0,1-.76,1.6Z" transform="translate(-0.209 -0.024)" fill="#777"/>
						</g>
					</svg>
				</div>
			</button>
		</div>
		<div id="intership" class="collapse" aria-labelledby="headingIntership" data-parent="#experience">
			<div class="card-body">
			{!!$therapist->internship_experience!!}
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header" id="headingWork">
			<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#work" aria-expanded="false" aria-controls="work">
				Pengalaman kerja
				<div class="tbr_icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
						<g id="arrow-ios-back" transform="translate(0.319 24) rotate(-90)" opacity="0.5">
							<rect id="Rectangle_31" data-name="Rectangle 31" width="24" height="24" transform="translate(24 -0.319) rotate(90)" fill="#777" opacity="0"/>
							<path id="Path_3" data-name="Path 3" d="M13.677,18.634a.974.974,0,0,1-.76-.36l-4.7-5.843a.974.974,0,0,1,0-1.237l4.869-5.843a.975.975,0,1,1,1.5,1.247l-4.353,5.22,4.207,5.22a.974.974,0,0,1-.76,1.6Z" transform="translate(-0.209 -0.024)" fill="#777"/>
						</g>
					</svg>
				</div>
			</button>
		</div>
		<div id="work" class="collapse" aria-labelledby="headingWork" data-parent="#experience">
			<div class="card-body">
			{!!$therapist->job_experience!!}
			</div>
		</div>
	</div>
</div>