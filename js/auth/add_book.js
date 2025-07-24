document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("bookForm");
  if (!form) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    try {
      const res = await fetch("/api/book", {
        method: "POST",
        body: formData
      });

      const result = await res.json();

      if (result.success) {
        alert("📘 Livre enregistré !");
        form.reset();
        window.location.href = "/mes-livres";
      } else {
        alert("❌ Erreur lors de l’enregistrement.");
      }

    } catch (err) {
      alert("❌ Problème réseau: " + err.message);
    }
  });
});

