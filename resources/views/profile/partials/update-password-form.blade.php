<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modifier le mot de passe</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f3f4f6;
    }

    section {
      background: white;
      border-radius: 8px;
      padding: 24px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    h2 {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1f2937;
    }

    p {
      font-size: 0.95rem;
      color: #4b5563;
      margin-top: 8px;
    }

    .form-group {
      margin-top: 20px;
    }

    label {
      display: block;
      font-weight: 500;
      color: #374151;
      margin-bottom: 6px;
    }

    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 0.95rem;
    }

    .error-message {
      font-size: 0.85rem;
      color: #dc2626;
      margin-top: 4px;
    }

    .btn-primary {
      background-color: #2563eb;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
    }

    .btn-primary:hover {
      background-color: #1d4ed8;
    }

    .status-message {
      font-size: 0.9rem;
      color: #10b981;
      margin-left: 16px;
    }

    .form-actions {
      margin-top: 24px;
      display: flex;
      align-items: center;
      gap: 16px;
    }
  </style>
</head>
<body>

<section>
  <header>
    <h2>Modifier le mot de passe</h2>
    <p>Assurez-vous d'utiliser un mot de passe long et aléatoire pour sécuriser votre compte.</p>
  </header>

  <form method="post" action="/update-password" class="mt-6 space-y-6">
    <!-- Champ mot de passe actuel -->
    <div class="form-group">
      <label for="current_password">Mot de passe actuel</label>
      <input type="password" id="current_password" name="current_password" autocomplete="current-password" required />
      <div class="error-message" id="error-current-password"></div>
    </div>

    <!-- Nouveau mot de passe -->
    <div class="form-group">
      <label for="password">Nouveau mot de passe</label>
      <input type="password" id="password" name="password" autocomplete="new-password" required />
      <div class="error-message" id="error-password"></div>
    </div>

    <!-- Confirmation mot de passe -->
    <div class="form-group">
      <label for="password_confirmation">Confirmer le mot de passe</label>
      <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" required />
      <div class="error-message" id="error-password-confirmation"></div>
    </div>

    <!-- Bouton de sauvegarde + message -->
    <div class="form-actions">
      <button type="submit" class="btn-primary">Sauvegarder</button>
      <p class="status-message" id="success-message" style="display: none;">Modifié avec succès.</p>
    </div>
  </form>
</section>

<script>
  // Simulation de feedback après soumission (à adapter selon backend réel)
  const form = document.querySelector("form");
  form.addEventListener("submit", function(e) {
    e.preventDefault(); // Supprimer cette ligne en production
    document.getElementById("success-message").style.display = "inline";
    setTimeout(() => {
      document.getElementById("success-message").style.display = "none";
    }, 2000);
  });
</script>

</body>
</html>
