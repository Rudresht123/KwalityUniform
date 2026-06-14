/**
 * School Class Bulk Setup Functionality
 */

(function($) {
    'use strict';

    $(document).ready(function () {
        console.log('School Class JS Initialized');

        // Initialize Choices.js for searchable dropdowns
        const initChoices = () => {
            const elements = document.querySelectorAll('.searchable-select');
            elements.forEach(element => {
                // Prevent double initialization
                if (!element.classList.contains('choices-initialized')) {
                    new Choices(element, {
                        allowHTML: true,
                        searchEnabled: true,
                        searchPlaceholderValue: "Search for a school...",
                        itemSelectText: '',
                    });
                    element.classList.add('choices-initialized');
                }
            });
        };

        // Run on load
        if (typeof Choices !== 'undefined') {
            initChoices();
        } else {
            console.error('Choices.js not found!');
        }

        // Add More Fields
        $('#add-class-field').on('click', function() {
            const nextNum = $('.class-input-row').length + 1;
            const newRow = `
                <div class="row class-input-row mb-3 gx-3 align-items-center p-3 bg-white rounded-3 border border-light shadow-sm mx-0" style="display: none;">
                    <div class="col-auto">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            <span class="fw-bold row-number">${nextNum}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group input-group-merge border rounded-pill overflow-hidden shadow-none border-2">
                            <span class="input-group-text bg-transparent border-0 ps-3">
                                <i class="ti ti-edit text-muted"></i>
                            </span>
                            <input type="text" name="class_names[]" class="form-control border-0 py-2 ps-1" placeholder="e.g. Class 1A, Senior KG..." required>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-light-danger btn-icon rounded-circle remove-class-field" title="Remove">
                            <i class="ti ti-x fs-5"></i>
                        </button>
                    </div>
                </div>`;
            
            const $newRow = $(newRow);
            $('#class-fields-container').append($newRow);
            $newRow.slideDown(250);
            updateRemoveButtons();
            
            // Auto scroll to bottom
            const container = document.getElementById('class-fields-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        });

        // Remove Field
        $(document).on('click', '.remove-class-field', function() {
            const row = $(this).closest('.class-input-row');
            row.slideUp(200, function() {
                row.remove();
                updateRowNumbers();
                updateRemoveButtons();
            });
        });

        function updateRowNumbers() {
            $('.class-input-row').each(function(index) {
                $(this).find('.row-number').text(index + 1);
            });
        }

        function updateRemoveButtons() {
            const rowCount = $('.class-input-row').length;
            $('.remove-class-field').prop('disabled', rowCount <= 1);
        }
    });

})(jQuery);
