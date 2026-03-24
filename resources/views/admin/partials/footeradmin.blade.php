<footer class="mt-4 text-center text-muted" style="font-size:13px;">
    &copy; {{ date('Y') }} Dinas Kebudayaan Provinsi Bali | SIMONTORIN <small>v.{{ config('app.version') }}</small> | Developed by <a href="#" class="text-decoration-none">ARIN</a> 
</footer>
<script>
document.getElementById('role').addEventListener('change', function() {
    let newRole = this.value;

    fetch('/set-role', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ role: newRole })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status) {
            // reload dashboard sesuai role baru
            window.location.href = data.redirect;
        } else {
            alert('Gagal mengubah role!');
        }
    });
});
</script>