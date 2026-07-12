<!-- School Search Modal -->
<div class="modal fade" id="schoolSearchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ssm-modal">

            <div class="ssm-header">
                <div class="d-flex align-items-center gap-3">
                    <div class="ssm-icon">
                        <i class="ti ti-building-community"></i>
                    </div>
                    <div>
                        <h5 class="ssm-title">Find your school</h5>
                        <p class="ssm-subtitle">Search to unlock its official uniform catalogue</p>
                    </div>
                </div>
                <button type="button" class="btn-close ssm-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ssm-body">

                <div class="ssm-search-wrap">
                    <i class="ti ti-search ssm-search-icon"></i>
                    <input type="text" id="modal-school-search-input" class="ssm-search-input"
                           placeholder="Start typing your school name..." autocomplete="off">
                    <div id="modal-school-suggestions" class="ssm-suggestions"></div>
                </div>

                <!-- Empty state: shown until suggestions actually populate -->
                <div id="ssm-empty-state" class="ssm-empty-state">
                    <div class="ssm-empty-icon">
                        <i class="ti ti-school"></i>
                    </div>
                    <p class="ssm-empty-title">Search for your school</p>
                    <p class="ssm-empty-text">Type a school name, city, or board to find its official uniform catalogue.</p>

                    <div class="ssm-hint">
                        <i class="ti ti-bulb"></i>
                        <span>Try searching by name, city, or board affiliation</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .ssm-modal {
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
        min-height: 500px;
        display: flex;
        flex-direction: column;
    }

    .ssm-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.75rem 1.75rem 1.5rem;
        background: #fafafa;
        border-bottom: 1px solid #eef0f2;
        flex-shrink: 0;
    }

    .ssm-icon {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #ffffff;
        color: var(--qu-primary);
        font-size: 1.25rem;
    }

    .ssm-title {
        font-weight: 600;
        font-size: 1.05rem;
        color: #1e293b;
        margin-bottom: 2px;
    }

    .ssm-subtitle {
        font-size: .82rem;
        color: #94a3b8;
        margin: 0;
    }

    .ssm-close {
        margin-top: .2rem;
        opacity: 0.5;
        transition: opacity .15s ease;
    }
    .ssm-close:hover { opacity: 1; }

    .ssm-body {
        padding: 1.75rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .ssm-search-wrap {
        position: relative;
    }

    .ssm-search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.05rem;
        pointer-events: none;
    }

    .ssm-search-input {
        width: 100%;
        padding: 14px 16px 14px 46px;
        font-size: .95rem;
        color: #1e293b;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        outline: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .ssm-search-input:focus {
        border-color: var(--qu-primary);
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.06);
    }

    .ssm-search-input::placeholder {
        color: #cbd5e1;
    }

    .ssm-suggestions {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        width: 100%;
        z-index: 1050;
        background: #ffffff;
        border: 1px solid #eef0f2;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        max-height: 280px;
        overflow-y: auto;
    }

    /* Empty state */
    .ssm-empty-state {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2.5rem 1.5rem 1.5rem;
        transition: opacity .15s ease;
    }

    .ssm-empty-icon {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #eef0f2;
        border-radius: 50%;
        background: #fafafa;
        color: #cbd5e1;
        font-size: 1.6rem;
        margin-bottom: 1rem;
    }

    .ssm-empty-title {
        font-weight: 600;
        font-size: .95rem;
        color: #334155;
        margin-bottom: .3rem;
    }

    .ssm-empty-text {
        font-size: .82rem;
        color: #94a3b8;
        max-width: 280px;
        margin: 0 0 1.5rem;
        line-height: 1.5;
    }

    .ssm-hint {
        display: flex;
        align-items: center;
        gap: .5rem;
        font-size: .78rem;
        color: #94a3b8;
        border-top: 1px solid #eef0f2;
        padding-top: 1rem;
        width: 100%;
        justify-content: center;
    }

    .ssm-hint i {
        font-size: .9rem;
        color: #cbd5e1;
        flex-shrink: 0;
    }
</style>

<script>
    (function () {
        const suggestionsBox = document.getElementById('modal-school-suggestions');
        const emptyState = document.getElementById('ssm-empty-state');

        if (!suggestionsBox || !emptyState) return;

        const toggleEmptyState = () => {
            const hasSuggestions = suggestionsBox.children.length > 0;
            emptyState.style.display = hasSuggestions ? 'none' : 'flex';
        };

        const observer = new MutationObserver(toggleEmptyState);
        observer.observe(suggestionsBox, { childList: true });

        toggleEmptyState();
    })();
</script>