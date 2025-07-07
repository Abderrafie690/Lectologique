document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('#loginForm');

  form?.addEventListener('submit', async e => {
    e.preventDefault();

    const formData = new FormData(form);

    try {
      const response = await fetch('../login_api.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        window.location.href = '/dashboard';
      } else {
        const alert = document.querySelector('#loginError');
        alert.textContent = result.message;
        alert.classList.remove('d-none');
      }

    } catch (err) {
      console.error('Erreur réseau:', err);
    }
  });
});
