<div>
    <button wire:click="addToCart" class="{{ $class ?? 'btn btn-primary btn-sm rounded-pill px-4 fw-bold' }}">
        <span wire:loading.remove wire:target="addToCart">
            Add To Basket
        </span>
        <span wire:loading wire:target="addToCart">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Adding...
        </span>
    </button>
</div>
