<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Supprimer le compte</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }

    section {
      background: white;
      border-radius: 8px;
      padding: 20px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
      font-size: 1.2rem;
      color: #1f2937;
    }

    p {
      font-size: 0.9rem;
      color: #4b5563;
      margin-top: 10px;
    }

    .danger-button {
      background-color: #dc2626;
      color: white;
      padding: 10px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 20px;
    }

    .modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      padding: 24px;
      border-radius: 8px;
      max-width: 400px;
      width: 90%;
    }

    .input-field {
      width: 100%;
      padding: 8px;
      margin-top: 10px;
      border: 1px solid #d1d5db;
      border-radius: 4px;
    }

    .modal-footer {
      margin-top: 20px;
      display: flex;
      justify-content: flex-end;
    }

    .secondary-button {
      background-color: #e5e7eb;
      color: #111827;
      padding: 8px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .secondary-button:hover {
      background-color: #d1d5db;
    }

    .ms-3 {
      margin-left: 12px;
    }
  </style>
</head>
<body>

<section>
  <header>
    <h2>Supprimer le compte</h2>
    <p>
      Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées.
      Veuillez télécharger toutes les données que vous souhaitez conserver.
    </p>
  </header>

  <button class="danger-button" onclick="openModal()">Supprimer le compte</button>
</section>

<!-- Modal -->
<div class="modal" id="confirmModal">
  <div class="modal-content">
    <form method="post" action="/delete-account">
      <h2>Êtes-vous sûr de vouloir supprimer votre compte ?</h2>
      <p>
        Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées.
        Veuillez entrer votre mot de passe pour confirmer.
      </p>

      <input type="password" name="password" class="input-field" placeholder="Mot de passe" required />

      <div class="modal-footer">
        <button type="button" class="secondary-button" onclick="closeModal()">Annuler</button>
        <button type="submit" class="danger-button ms-3">Supprimer</button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('confirmModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('confirmModal').style.display = 'none';
  }

  // Pour fermer la modal en cliquant à l'extérieur
  window.onclick = function(event) {
    const modal = document.getElementById('confirmModal');
    if (event.target === modal) {
      modal.style.display = "none";
    }
  }
</script>

</body>
</html>
