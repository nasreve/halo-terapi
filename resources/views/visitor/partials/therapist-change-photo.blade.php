<div class="modal tbr_modal fade" id="therapistChangePhoto" tabindex="-1" aria-labelledby="therapistChangePhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light tbr_btn-circle modal-dismiss tbr_modal_dismiss" data-dismiss="modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g id="Layer_2" data-name="Layer 2" opacity="0.7">
                        <g id="close">
                            <rect id="Rectangle_1936" data-name="Rectangle 1936" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#8a949b" opacity="0"/>
                            <path id="Path_751" data-name="Path 751" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" fill="#8a949b"/>
                        </g>
                    </g>
                </svg>
            </button>
            <div class="modal-body p-0">
                <form action="{{ route('therapist.setting.updatePhoto') }}" method="post" class="main_form_file" enctype="multipart/form-data">
                    @csrf
                    <div class="tbr_photo_wrap">
                        <div class="tbr_photo_preview">
                            @if ($therapist->photo_path)
                                <img id="output" src="{{ Storage::url($therapist->photo_path) }}">
                            @else
                                <img id="output" src="{{ asset('/assets/svg/etc/Default.svg') }}">
                            @endif
                        </div>
                        <div class="tbr_photo_desc">
                            <p><em>File yang diupload harus ber-extensi jpg, jpeg, dan png. Dimensi 400 x 400 pixels dengan size maksimal 1 MB.</em></p>
                            <div class="form-group mb-0">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            name="photo_path"
                                            type="file"
                                            class="custom-file-input"
                                            id="photo"
                                            accept="image/png, image/gif, image/jpeg"
                                            value=""
                                        >
                                        <label class="custom-file-label" for="photo">{{ $therapist->photo_name }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4 pt-2">
                        <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light d-inline-flex" data-dismiss="modal">Batal</button>
                        <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary d-inline-flex ml-3">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('aside-blockfoot')
    <script src="{{ asset('assets/js/visitor/therapist/update-setting-file.js') }}"></script>
    <script>
        $("[name='photo_path']").on("change", function (e) {
            $(this).parents(".input-group").find('.invalid-feedback').remove();

            const prevText = $("[for='photo']").html();

            const fileSize = this.files[0].size / 1024 / 1024;
            if (fileSize > 1) {
                $(this).parents(".input-group").append(`
                    <span class="invalid-feedback d-block" role="alert">
                        Ukuran file maksimal 1 MB.
                    </span>
                `);

                $(this).val(null);

                setTimeout(() => {
                    $(this).next().html(prevText);
                }, 100);
            } else {
                document.getElementById('output').src = window.URL.createObjectURL(this.files[0])
            }
        });
    </script>
@endsection