<script>
    (function() {
        const container = document.getElementById('class-fields-container');
        const addBtn = document.getElementById('add-class-btn');
        const countNum = document.getElementById('class-count-pill');
        const toggle = document.getElementById('is_active');
        const statusLbl = document.getElementById('toggle-status-label');

        function reindex() {
            const rows = container.querySelectorAll('.bcs-row');
            rows.forEach((row, i) => {
                row.querySelector('.bcs-row-num').textContent = i + 1;
                const inp = row.querySelector('.bcs-row-input');
                inp.setAttribute('aria-label', 'Class name ' + (i + 1));
                const del = row.querySelector('.bcs-del-btn');
                del.disabled = rows.length <= 1;
                del.setAttribute('aria-label', 'Remove class ' + (i + 1));
            });
            const n = rows.length;
            countNum.innerHTML =
                `<i class="ti ti-list" style="font-size:11px"></i> ${n} ${n === 1 ? 'class' : 'classes'}`;
        }

        addBtn.addEventListener('click', function() {
            const n = container.querySelectorAll('.bcs-row').length + 1;
            const row = document.createElement('div');

            row.className = 'bcs-row';

            row.innerHTML = `
        <div class="bcs-row-num">${n}</div>
        <input type="text"
               name="standard_names[]"
               class="bcs-row-input"
               placeholder="Primary, Secondary....."
               aria-label="Academic Standard ${n}"
               required>
        <button type="button"
                class="bcs-del-btn remove-row"
                aria-label="Remove Standard ${n}">
            <i class="ti ti-x"></i>
        </button>
    `;

            row.querySelector('.bcs-del-btn').addEventListener('click', function() {
                row.remove();
                reindex();
            });

            container.appendChild(row);
            row.querySelector('input').focus();
            reindex();
        });

        container.addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-row');
            if (btn && !btn.disabled) {
                btn.closest('.bcs-row').remove();
                reindex();
            }
        });

        toggle.addEventListener('change', function() {
            if (this.checked) {
                statusLbl.textContent = 'Active';
                statusLbl.classList.remove('inactive');
            } else {
                statusLbl.textContent = 'Inactive';
                statusLbl.classList.add('inactive');
            }
        });
    })();
</script>
