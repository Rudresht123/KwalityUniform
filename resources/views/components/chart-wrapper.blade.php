<div {{ $attributes->merge(['class' => 'chart-container']) }}>
    @if(isset($title))
        <div class="section-title">
            @if(isset($icon)) <i class="{{ $icon }} text-primary"></i> @endif
            {{ $title }}
        </div>
    @endif
    <div class="chart-body">
        {{ $slot }}
    </div>
</div>
