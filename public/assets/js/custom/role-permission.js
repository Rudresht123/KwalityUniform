/**
 * Role & Permission Management Functionality
 */

(function($) {
    'use strict';

    $(document).ready(function () {
        // Select Group
        $(document).on('click', '.select-group', function () {
            const pane = $(this).closest('.tab-pane');
            pane.find('.permission-checkbox').prop('checked', true).trigger('change');
        });

        // Clear Group
        $(document).on('click', '.clear-group', function () {
            const pane = $(this).closest('.tab-pane');
            pane.find('.permission-checkbox').prop('checked', false).trigger('change');
        });

        // Global Select All
        $('#selectAllGlobal').on('change', function () {
            const isChecked = $(this).is(':checked');
            $('.permission-checkbox').prop('checked', isChecked).trigger('change');
        });

        // Individual checkbox change
        $(document).on('change', '.permission-checkbox', function() {
            updateGroupCount($(this).closest('.tab-pane'));
            updateGlobalCheckbox();
        });

        function updateGroupCount(pane) {
            const groupId = pane.attr('id');
            const total = pane.find('.permission-checkbox').length;
            const checked = pane.find('.permission-checkbox:checked').length;
            const badge = $(`.nav-link[data-bs-target="#${groupId}"] .group-count`);
            
            if (checked > 0) {
                badge.text(`${checked}/${total}`).addClass('bg-success text-white').removeClass('bg-light text-dark');
            } else {
                badge.text(total).removeClass('bg-success text-white').addClass('bg-light text-dark');
            }
        }

        function updateGlobalCheckbox() {
            const total = $('.permission-checkbox').length;
            if (total === 0) return;
            
            const checked = $('.permission-checkbox:checked').length;
            $('#selectAllGlobal').prop('checked', total === checked);
            $('#selectAllGlobal').prop('indeterminate', checked > 0 && checked < total);
        }

        // Initialize counts on page load
        $('.tab-pane').each(function() {
            updateGroupCount($(this));
        });
        updateGlobalCheckbox();
    });

})(jQuery);
