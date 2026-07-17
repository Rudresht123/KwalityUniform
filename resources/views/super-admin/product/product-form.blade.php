    <script>$(document).ready(function() {
        // Variant Logic
    let variantIndex = window.productConfig.variantIndex;

        
        $(document).on('click', '.add-variant-btn', function() {
            let row = `
                <tr class="variant-row">
                    <td><input type="text" name="variants[${variantIndex}][sku]" class="form-control form-control-sm" placeholder="e.g. SKU-01" required></td>
                    <td>
                        <select name="variants[${variantIndex}][size_id]" class="form-control select2 ">
                            <option value="">N/A</option>
                            @foreach($sizes as $size) <option value="{{ $size->size_id }}">{{ $size->size_name }}</option> @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="variants[${variantIndex}][color_id]" class="form-control select2">
                            <option value="">N/A</option>
                            @foreach($colors as $color) <option value="{{ $color->color_id }}">{{ $color->color_name }}</option> @endforeach
                        </select>
                    </td>
                    <td><input type="number" step="0.01" name="variants[${variantIndex}][mrp]" class="form-control form-control-sm mrp" placeholder="0.00" required></td>
                    <td><input type="number" step="0.01" name="variants[${variantIndex}][vendor_price]" class="form-control form-control-sm vendor_price" placeholder="0.00" required></td>
                    <td><input type="number" step="0.01" name="variants[${variantIndex}][selling_price]" class="form-control form-control-sm selling_price" placeholder="0.00" required></td>
                    <td><input type="number" name="variants[${variantIndex}][stock_qty]" class="form-control form-control-sm" placeholder="0" required></td>
                    <td><input type="number" name="variants[${variantIndex}][low_stock_alert]" class="form-control form-control-sm" value="5" placeholder="5"></td>
                    <td><input type="text" name="variants[${variantIndex}][barcode]" class="form-control form-control-sm" placeholder="UPC/EAN"></td>
                    <input type="hidden" name="variants[${variantIndex}][is_active]" value="1">
                    <td class="text-center">
                        <div class="variant-action-group">
                            <button type="button" class="btn-variant btn-variant-danger remove-variant" title="Remove Row"><i class="ti-trash"></i></button>
                            <button type="button" class="btn-variant btn-variant-primary add-variant-btn" title="Add Row Below"><i class=" ti-plus"></i></button>
                        </div>
                    </td>
                </tr>
            `;
            $(this).closest('tr').after(row);
            variantIndex++;
        });

        $(document).on('click', '.remove-variant', function() {
            if ($('#variants-table tbody tr').length > 1) $(this).closest('tr').remove();
            else alert('At least one variant is required.');
        });

        // Media Upload Logic with Animation
        const dt = new DataTransfer();
        $('#images-input').on('change', function(e) {
            const files = e.target.files;
            const container = $('#media-preview-container');
            const globalBar = $('#global-upload-bar');

            globalBar.css('width', '100%');
            
            setTimeout(() => {
                for(let file of files) {
                    dt.items.add(file);
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewHtml = `
                            <div class="preview-item">
                                <img src="${e.target.result}">
                                <button type="button" class="remove-preview" data-name="${file.name}"><i class="ti ti-x"></i></button>
                            </div>
                        `;
                        $(previewHtml).insertBefore('#upload-trigger');
                    }
                    reader.readAsDataURL(file);
                }
                globalBar.css('width', '0%');
                this.files = dt.files;
            }, 600);
        });

        $(document).on('click', '.remove-preview', function() {
            const name = $(this).data('name');
            for(let i = 0; i < dt.items.length; i++) {
                if(dt.items[i].getAsFile().name === name) {
                    dt.items.remove(i);
                    break;
                }
            }
            $('#images-input')[0].files = dt.files;
            $(this).parent().remove();
        });
    });
$(document).on('input', '.selling_price', function () {

    const row = $(this).closest('tr');

    const mrp = parseFloat(row.find('.mrp').val()) || 0;
    const sellingPrice = parseFloat($(this).val()) || 0;

    if (mrp <= 0) {

        $(this).val('');

        alertify.warning('Please enter the MRP first.');

        return;
    }

    if (sellingPrice > mrp) {

        $(this).val(mrp);

        alertify.warning('Selling Price cannot be greater than MRP.');
    }

});
</script>