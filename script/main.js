document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);

    if (params.get('error') === 'invalid') {
        alert('Email atau password salah.');
    } else if (params.get('error') === 'password_mismatch') {
        alert('Password tidak cocok.');
    } else if (params.get('success') === 'registered') {
        alert('Registrasi berhasil! Silakan login.');
    } else if (params.get('info') === 'reset_sent') {
        alert('Link reset password telah dikirim ke email kamu.');
    }
});
