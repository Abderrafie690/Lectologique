document.addEventListener('DOMContentLoaded', async () => {
  const usernameEl = document.getElementById('username');
  const adminEl = document.getElementById('adminStatus');

  try {
    const response = await fetch('../user_info_api.php');
    const data = await response.json();

    if (!data.loggedIn) {
      window.location.href = '/login';
      return;
    }

    usernameEl.textContent = data.username;

    if (data.is_admin) {
      adminEl.classList.remove('d-none');
    }

  } catch (err) {
    console.error('Erreur en récupérant le profil:', err);
  }
});
