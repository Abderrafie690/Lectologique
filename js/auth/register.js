document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('#registerForm');

  form?.addEventListener('submit', async e => {
    e.preventDefault();

    const formData = new FormData(form);
    const password = formData.get('password');
    const confirm = formData.get('confirm');

    if (password !== confirm) {
      const alert = document.querySelector('#registerError');
      alert.textContent = "Les mots de passe ne correspondent pas.";
      alert.classList.remove('d-none');
      return;
    }

    try {
      const response = await fetch('../register_api.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        window.location.href = '/dashboard';
      } else {
        const alert = document.querySelector('#registerError');
        alert.textContent = result.message;
        alert.classList.remove('d-none');
      }

    } catch (err) {
      console.error('Erreur réseau:', err);
    }
  });
});
