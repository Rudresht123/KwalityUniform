<script>

alertify.set(
    'notifier',
    'position',
    'top-right'
);

alertify.set(
    'notifier',
    'delay',
    5
);

</script>

@if(session('success'))

<script>

alertify.success(
    "{{ session('success') }}"
);

</script>

@endif

@if(session('error'))

<script>

alertify.error(
    "{{ session('error') }}"
);

</script>

@endif

@if(session('warning'))

<script>

alertify.warning(
    "{{ session('warning') }}"
);

</script>

@endif

@if(session('info'))

<script>

alertify.message(
    "{{ session('info') }}"
);

</script>

@endif