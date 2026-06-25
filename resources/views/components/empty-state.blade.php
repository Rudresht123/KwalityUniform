<div class="empty-state text-center py-5">

    <div class="empty-state-icon mb-4">
        <i class="{{ $icon ?? 'ti ti-database-off' }}"></i>
    </div>

    <h4 class="empty-state-title">
        {{ $title ?? 'No Data Found' }}
    </h4>

    <p class="empty-state-description">
        {{ $description ?? 'There is nothing to display at the moment.' }}
    </p>

    @isset($action)
        <div class="mt-4">
            {!! $action !!}
        </div>
    @endisset

</div>

<style>
    .empty-state{
    padding:60px 20px;
}

.empty-state-icon{
    width:90px;
    height:90px;

    margin:auto;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:24px;

    background:
        linear-gradient(
            135deg,
            rgba(98,89,202,.12),
            rgba(124,113,255,.12)
        );

    color:#6259ca;

    font-size:42px;
}

.empty-state-title{
    font-size:24px;
    font-weight:700;
    color:#1e293b;
    margin-bottom:10px;
}

.empty-state-description{
    max-width:450px;
    margin:auto;

    color:#64748b;
    font-size:14px;
}
</style>