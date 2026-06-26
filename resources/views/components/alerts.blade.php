<style>
/*==============================
      ALERTIFY PREMIUM UI
===============================*/

.ajs-notifier{
    top:20px !important;
    right:20px !important;
    z-index:999999;
}

.ajs-notifier .ajs-message{

    display:flex !important;
    align-items:center;
    gap:12px;

    min-width:280px;
    max-width:420px;
    width:auto;

    padding:14px 18px !important;

    border:none !important;
    border-radius:16px !important;

    color:#fff !important;
    font-size:14px;
    font-weight:500;
    line-height:1.45;

    backdrop-filter:blur(16px);

    box-shadow:
        0 12px 35px rgba(0,0,0,.18);

    overflow:hidden;
    position:relative;

    animation:toastIn .35s ease;
}

/* Small shine */

.ajs-notifier .ajs-message::before{

    content:"";

    position:absolute;
    inset:0;

    background:linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,.08),
        transparent
    );

    transform:translateX(-100%);
    animation:shine 3s infinite;
}

/*==============================
        ICON
===============================*/

.ajs-message i{

    width:28px;
    height:28px;

    min-width:28px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:50%;

    background:rgba(255,255,255,.18);

    font-size:15px;
}

/*==============================
       COLORS
===============================*/

.ajs-success{
    background:linear-gradient(135deg,#16a34a,#22c55e)!important;
}

.ajs-error{
    background:linear-gradient(135deg,#dc2626,#ef4444)!important;
}

.ajs-warning{
    background:linear-gradient(135deg,#f59e0b,#fbbf24)!important;
}

.ajs-message:not(.ajs-success):not(.ajs-error):not(.ajs-warning){
    background:linear-gradient(135deg,#2563eb,#3b82f6)!important;
}

/*==============================
      CLOSE BUTTON
===============================*/

.ajs-close{

    color:#fff!important;

    opacity:.75;

    transition:.25s;

    font-size:16px;
}

.ajs-close:hover{

    opacity:1;

    transform:scale(1.15);
}

/*==============================
      ANIMATION
===============================*/

@keyframes toastIn{

    from{

        opacity:0;
        transform:translateX(60px);
    }

    to{

        opacity:1;
        transform:translateX(0);
    }

}

@keyframes shine{

    from{

        transform:translateX(-120%);
    }

    to{

        transform:translateX(120%);
    }

}
/* Content wrapper */

.ajs-notifier .ajs-message{
    display:flex;
    align-items:flex-start;
}

.ajs-notifier .ajs-message span{
    flex:1;
    display:block;
    word-break:break-word;
    white-space:normal;
}

/* Icon */

.ajs-notifier .ajs-message i{
    flex-shrink:0;
    width:28px;
    height:28px;
    min-width:28px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    margin-top:1px;
}
.toast-content{
    display:flex;
    align-items:flex-start;
    gap:10px;
}

.toast-content i{
    flex:0 0 28px;
    width:28px;
    height:28px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    background:rgba(255,255,255,.18);
}

.toast-text{
    flex:1;
    word-break:break-word;
    line-height:1.45;
}
/* Remove extra margin Alertify adds */

.ajs-notifier .ajs-message *{
    margin:0;
}
.ajs-notifier .ajs-message {
    max-width: 480px; /* increase from 420px */
}
</style>


<script>
   alertify.set('notifier','position','top-right');
alertify.set('notifier','delay',4);
alertify.defaults.notifier.closeButton = true;
function toast(icon, message){
    return `
        <div class="toast-content">
            <i class="${icon}"></i>
            <div class="toast-text">${message}</div>
        </div>
    `;
}

function showSuccess(message){
    alertify.success(
        toast('ti-check', message)
    );
}

function showError(message) {
    alertify.set('notifier', 'delay', 8); // longer for errors
    alertify.error(toast('ti-x', message));
    alertify.set('notifier', 'delay', 4); // reset back
}
function showWarning(message){
    alertify.warning(
        toast('ti-alert-triangle', message)
    );
}

function showInfo(message){
    alertify.message(
        toast('ti-info-circle', message)
    );
}</script>

</script>

@if (session('success'))
    <script>
        showSuccess(@json(session('success')));
    </script>
    @endif @if (session('error'))
        <script>
            showError(@json(session('error')));
        </script>
        @endif @if (session('warning'))
            <script>
                showWarning(@json(session('warning')));
            </script>
            @endif @if (session('info'))
                <script>
                    showInfo(@json(session('info')));
                </script>
            @endif

            @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let messages = @json($errors->all());
            let list = messages.map(m => `<li style="margin:2px 0">${m}</li>`).join('');
            showError(`
                <strong>Please fix the following errors:</strong>
                <ul style="margin:6px 0 0 0; padding-left:16px; list-style:disc;">
                    ${list}
                </ul>
            `);
        });
    </script>
@endif