<div {{ $attributes->merge(['class' => 'metric-tile']) }}>
    @if(isset($icon))
        <div class="metric-icon {{ $iconClass ?? 'bg-primary-transparent text-primary' }}">
            <i class="{{ $icon }}"></i>
        </div>
    @endif
    <div>
        <div class="metric-label">{{ $label }}</div>
        <div class="metric-value">{{ $value }}</div>
        @if(isset($footer))
            <div class="metric-footer {{ $footerClass ?? 'text-muted' }}">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
