<div class="modal fade {{ $modalClass ?? '' }}" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog {{ $modalSize ?? 'modal-lg' }} modal-dialog-centered">

        <div class="modal-content">

            {{-- ========================================================= --}}
            {{-- Modal Header --}}
            {{-- ========================================================= --}}
            <div class="modal-header">

                <div class="d-flex align-items-center">

                    <div class="modal-icon-box me-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round">

                            <path d="M12 5v14"></path>
                            <path d="M5 12h14"></path>

                        </svg>

                    </div>

                    <div>

                        <h5 class="modal-title addModalTitle mb-1">
                            {{ $title ?? 'Modal Title' }}
                        </h5>

                        @if(!empty($subtitle))
                            <p class="modal-subtitle mb-0">
                                {{ $subtitle }}
                            </p>
                        @endif

                    </div>

                </div>

                <button
                    type="button"
                    class="custom-close-btn"
                    data-bs-dismiss="modal"
                    aria-label="Close">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="18"
                         height="18"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <path d="M18 6L6 18"></path>
                        <path d="M6 6l12 12"></path>

                    </svg>

                </button>

            </div>

            {{-- ========================================================= --}}
            {{-- Modal Body --}}
            {{-- ========================================================= --}}
            <div class="modal-body">

                <div class="modal-loading text-center">

                    <div class="spinner-border text-primary mb-3"
                         role="status">
                    </div>

                    <h6 class="fw-semibold mb-1">
                        Please Wait...
                    </h6>

                    <small class="text-muted">
                        Loading data...
                    </small>

                </div>

            </div>

            {{-- ========================================================= --}}
            {{-- Modal Footer --}}
            {{-- ========================================================= --}}
            @if($showFooter ?? false)

                <div class="modal-footer">

                    <div class="text-muted small">

                        <i class="ti ti-info-circle me-1"></i>

                        Please review the information before saving.

                    </div>

                    <div class="d-flex align-items-center gap-2">

                        <button
                            type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal">

                            <i class="ti ti-x me-1"></i>

                            Cancel

                        </button>

                        <button
                            type="submit"
                            form="{{ $formId ?? '' }}"
                            class="btn btn-primary">

                            <i class="ti ti-device-floppy me-1"></i>

                            {{ $buttonText ?? 'Save Changes' }}

                        </button>

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>