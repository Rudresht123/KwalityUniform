@if(session('success'))
<div class="app-toast success-toast">
    <i class="ti ti-circle-check"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="app-toast error-toast">
    <i class="ti ti-alert-circle"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

@if(session('warning'))
<div class="app-toast warning-toast">
    <i class="ti ti-alert-triangle"></i>
    <span>{{ session('warning') }}</span>
</div>
@endif

@if(session('info'))
<div class="app-toast info-toast">
    <i class="ti ti-info-circle"></i>
    <span>{{ session('info') }}</span>
</div>
@endif

@if($errors->any())
<div class="app-toast error-toast">
    <i class="ti ti-alert-circle"></i>
    <span>{{ $errors->first() }}</span>
</div>
@endif

<style>

.app-toast{

    position:fixed;

    top:20px;

    right:20px;

    min-width:320px;

    max-width:450px;

    padding:14px 18px;

    border-radius:10px;

    color:#fff;

    display:flex;

    align-items:center;

    gap:10px;

    z-index:99999;

    box-shadow:
    0 10px 30px rgba(0,0,0,.15);

    animation:
    slideIn .35s ease,
    fadeOut .4s ease 4.6s forwards;
}

.app-toast i{

    font-size:22px;
}

.success-toast{

    background:#22c55e;
}

.error-toast{

    background:#ef4444;
}

.warning-toast{

    background:#f59e0b;
}

.info-toast{

    background:#3b82f6;
}

@keyframes slideIn{

    from{

        opacity:0;
        transform:translateX(100%);
    }

    to{

        opacity:1;
        transform:translateX(0);
    }
}

@keyframes fadeOut{

    to{

        opacity:0;
        transform:translateX(100%);
    }
}

</style>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function(){

        setTimeout(function(){

            document
                .querySelectorAll('.app-toast')
                .forEach(function(toast){

                    toast.remove();

                });

        },5000);

    }
);

</script>