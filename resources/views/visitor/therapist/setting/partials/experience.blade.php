<form action="{{ route('therapist.setting.updateExperience') }}" method="POST" class="main_form" autocomplete="off">
    @csrf
    <div class="accordion tbr_accordion" id="e-accordion">
        <div class="tbr_accordion_item">
            <button
                class="btn"
                type="button"
                data-toggle="collapse"
                data-target="#e-collapse-1"
                aria-expanded="true"
                aria-controls="e-collapse-1"
            >
                <h4 class="w-100 mr-2">Riwayat pendidikan formal</h4>
                <div class="tbr_accordion_icon"></div>
            </button>
            <input type="hidden" name="edu_history">
            <div class="invalid-feedback tbr_block_invalid_feedback mb-4" role="alert"></div>
            <div id="e-collapse-1" class="collapse show" data-parent="#e-accordion">
                <div class="tbr_accordion_content pt-0">
                    <textarea
                        class="summernote d-none"
                        id="edu_history"
                        name="edu_history"
                    >{{ $therapist->edu_history }}</textarea>
                </div>
            </div>
        </div>
        <div class="tbr_accordion_item">
            <button
                class="btn"
                type="button"
                data-toggle="collapse"
                data-target="#e-collapse-2"
                aria-expanded="false"
                aria-controls="e-collapse-2"
            >
                <h4 class="w-100 mr-2">Riwayat seminar dan pelatihan</h4>
                <div class="tbr_accordion_icon"></div>
            </button>
            <input type="hidden" name="workshop_history">
            <div class="invalid-feedback tbr_block_invalid_feedback mb-4" role="alert"></div>
            <div id="e-collapse-2" class="collapse" data-parent="#e-accordion">
                <div class="tbr_accordion_content pt-0">
                    <textarea
                        class="summernote d-none"
                        id="workshop_history"
                        name="workshop_history"
                    >{{ $therapist->workshop_history }}</textarea>
                </div>
            </div>
        </div>
        <div class="tbr_accordion_item">
            <button
                class="btn"
                type="button"
                data-toggle="collapse"
                data-target="#e-collapse-3"
                aria-expanded="false"
                aria-controls="e-collapse-3"
            >
                <h4 class="w-100 mr-2">Pengalaman praktik kerja lapangan (PKL)</h4>
                <div class="tbr_accordion_icon"></div>
            </button>
            <input type="hidden" name="internship_experience">
            <div class="invalid-feedback tbr_block_invalid_feedback mb-4" role="alert"></div>
            <div id="e-collapse-3" class="collapse" data-parent="#e-accordion">
                <div class="tbr_accordion_content pt-0">
                    <textarea
                        class="summernote d-none"
                        id="internship_experience"
                        name="internship_experience"
                    >{{ $therapist->internship_experience }}</textarea>
                </div>
            </div>
        </div>
        <div class="tbr_accordion_item">
            <button
                class="btn"
                type="button"
                data-toggle="collapse"
                data-target="#e-collapse-4"
                aria-expanded="false"
                aria-controls="e-collapse-4"
            >
                <h4 class="w-100 mr-2">Pengalaman kerja</h4>
                <div class="tbr_accordion_icon"></div>
            </button>
            <input type="hidden" name="job_experience">
            <div class="invalid-feedback tbr_block_invalid_feedback mb-4" role="alert"></div>
            <div id="e-collapse-4" class="collapse" data-parent="#e-accordion">
                <div class="tbr_accordion_content">
                    <textarea
                        class="summernote d-none"
                        id="job_experience"
                        name="job_experience"
                    >{{ $therapist->job_experience }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-4 pt-3">
        <a href="{{ url()->previous() }}" anim="ripple" class="btn tbr_btn tbr_btn-light d-inline-flex">Kembali</a>
        <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary d-inline-flex ml-3">Simpan</button>
    </div>
</form>