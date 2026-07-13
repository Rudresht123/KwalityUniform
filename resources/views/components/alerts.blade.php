<style>
/*==========================================================================
   ULTRA-SPECIFIC ALERTIFY OVERRIDE - PREMIUM LIVE TOASTS
==========================================================================*/

/* Target with body to ensure maximum specificity */
body .ajs-notifier {
    top: 20px !important;
    right: 20px !important;
    z-index: 9999999 !important;
}

body .ajs-notifier .ajs-message {
    position: relative !important;
    display: block !important;
    min-width: 320px !important;
    max-width: 420px !important;
    padding: 18px 35px 18px 18px !important; /* Extra right padding for X button */
    border: none !important;
    border-radius: 16px !important;
    color: #ffffff !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    line-height: 1.5 !important;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2) !important;
    backdrop-filter: blur(12px) !important;
    animation: toastIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    overflow: visible !important;
    cursor: pointer !important;
}

/* FORCE CLOSE BUTTON TO TOP RIGHT */
body .ajs-notifier .ajs-message .ajs-close {
    position: absolute !important;
    top: 12px !important;
    right: 12px !important;
    width: 20px !important;
    height: 20px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: rgba(255,255,255,0.7) !important;
    font-size: 16px !important;
    opacity: 0.7 !important;
    transition: all 0.2s ease !important;
    cursor: pointer !important;
    z-index: 1000 !important;
    background: transparent !important;
    border: none !important;
}

body .ajs-notifier .ajs-message .ajs-close:hover {
    opacity: 1 !important;
    color: #ffffff !important;
    transform: scale(1.2) !important;
}

/* CONTENT LAYOUT */
.toast-content {
    display: flex !important;
    align-items: flex-start !important;
    gap: 14px !important;
    width: 100% !important;
}

.toast-content i {
    flex-shrink: 0 !important;
    width: 32px !important;
    height: 32px !important;
    min-width: 32px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 50% !important;
    background: rgba(255,255,255,0.2) !important;
    font-size: 18px !important;
    color: #fff !important;
    margin-top: 2px !important;
}

.toast-text {
    flex: 1 !important;
    word-break: break-word !important;
    white-space: normal !important;
    color: #fff !important;
    font-size: 14px !important;
}

.toast-link {
    display: block !important;
    margin-top: 8px !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-decoration: underline !important;
    opacity: 0.9 !important;
}

/* VIBRANT GRADIENTS */
body .ajs-notifier .ajs-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
}

body .ajs-notifier .ajs-error {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
}

body .ajs-notifier .ajs-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
}

body .ajs-notifier .ajs-message:not(.ajs-success):not(.ajs-error):not(.ajs-warning) {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
}

/* ANIMATION */
@keyframes toastIn {
    from { opacity: 0; transform: translateX(50px) scale(0.9); }
    to { opacity: 1; transform: translateX(0) scale(1); }
}

/* Cleanup default Alertify margins */
body .ajs-notifier .ajs-message * {
    margin: 0 !important;
}
</style>


<script>
alertify.set('notifier','position','top-right');
alertify.set('notifier','delay',4);
alertify.defaults.notifier.closeButton = true;

function toast(icon, message, url = null){
    let content = `
        <div class="toast-content">
            <i class="${icon}"></i>
            <div class="toast-text">
                ${message}
                ${url ? `<span class="toast-link">View Details →</span>` : ''}
            </div>
        </div>
    `;
    
    return content;
}

function showSuccess(message, url = null){
    alertify.success(toast('ti-check', message, url));
    if(url) {
        // Add click listener to the last created alertify message
        setTimeout(() => {
            const msg = document.querySelector('.ajs-success');
            if(msg) msg.onclick = () => window.location.href = url;
        }, 50);
    }
}

function showError(message, url = null){
    alertify.set('notifier', 'delay', 8); 
    alertify.error(toast('ti-x', message, url));
    alertify.set('notifier', 'delay', 4); 
    if(url) {
        setTimeout(() => {
            const msg = document.querySelector('.ajs-error');
            if(msg) msg.onclick = () => window.location.href = url;
        }, 50);
    }
}

function showWarning(message, url = null){
    alertify.warning(toast('ti-alert-triangle', message, url));
    if(url) {
        setTimeout(() => {
            const msg = document.querySelector('.ajs-warning');
            if(msg) msg.onclick = () => window.location.href = url;
        }, 50);
    }
}

function showInfo(message, url = null){
    alertify.message(toast('ti-info-circle', message, url));
    if(url) {
        setTimeout(() => {
            const msg = document.querySelector('.ajs-message:not(.ajs-success):not(.ajs-error):not(.ajs-warning)');
            if(msg) msg.onclick = () => window.location.href = url;
        }, 50);
    }
}
</script>

@if (session('success'))
    <script>
        showSuccess(@json(session('success')));
    </script>
@endif 
@if (session('error'))
    <script>
        showError(@json(session('error')));
    </script>
@endif 
@if (session('warning'))
    <script>
        showWarning(@json(session('warning')));
    </script>
@endif 
@if (session('info'))
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