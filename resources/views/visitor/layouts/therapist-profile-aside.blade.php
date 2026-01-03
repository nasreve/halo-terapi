<div class="tbr_member_aside">
    <div class="tbr_card_image">
        @if ($therapist->photo_path)
            <img class="w-100" src="{{ Storage::url($therapist->photo_path) }}" alt="{{ $therapist->photo_path }}">
        @else
            <img class="w-100" src="{{ asset('/assets/images/sample_therapist_01.png') }}" alt="{{ $therapist->photo_path }}">
        @endif
    </div>
</div>