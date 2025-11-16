@props([
    'name' => 'tanggal',
    'placeholder' => 'Pilih tanggal',
])

<div class="datepicker-wrapper">
    <div class="datepicker-box">
        <input type="text" class="datepicker-input" placeholder="{{ $placeholder }}" readonly>
        <span class="datepicker-icon">
            {{ $icon ?? '' }}
        </span>
    </div>
    <div class="datepicker hidden">
        <div class="datepicker-header">
            <button type="button" class="datepicker-prevBtn">&lt;</button>
            <div class="datepicker-monthYear"></div>
            <button type="button" class="datepicker-nextBtn">&gt;</button>
        </div>

        <div class="datepicker-days">
            <div class="datepicker-day">Sen</div>
            <div class="datepicker-day">Sel</div>
            <div class="datepicker-day">Rab</div>
            <div class="datepicker-day">Kam</div>
            <div class="datepicker-day">Jum</div>
            <div class="datepicker-day">Sab</div>
            <div class="datepicker-day">Min</div>
        </div>

        <div class="datepicker-dates"></div>
        <div class="datepicker-month hidden"></div>
        <div class="datepicker-year hidden"></div>
    </div>

    <input type="hidden" class="datepicker-hidden" name="{{ $name }}">
</div>