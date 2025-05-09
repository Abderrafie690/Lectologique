

<footer class="bg-light text-center text-muted py-3 mt-5 border-top shadow-sm">
  <div class="container">
    <p class="mb-1">📚 <strong>Lectologique</strong> — Votre bibliothèque numérique personnelle</p>
    <small>&copy; <?= date('Y') ?> Tous droits réservés | Développé avec ❤️ par vous</small>
  </div>
  <script>
document.addEventListener('DOMContentLoaded', () => {
  const toggleDark = document.getElementById('toggleDarkMode');
  const body = document.body;

  // Aplica modo oscuro si está activado
  if (localStorage.getItem('darkMode') === 'on') {
    body.classList.add('dark-mode');
  }

  toggleDark.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    const isDark = body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDark ? 'on' : 'off');
  });
});
</script>

</footer>

 
  
</body>

</html>
