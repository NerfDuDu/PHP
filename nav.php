<?php if (isset($_SESSION['user'])): ?>
<ul class="ult">
  <li class="lit">
    <button class="button" onclick="window.location.href='index.php'"><p class="pa">Accueil</p></button>
  </li>
  <li class="lit">
    <button class="button" onclick="window.location.href='panier.php'"><p class="pa">Panier</p></button>
  </li>
  <li class="lit">
    <button class="button" onclick="window.location.href='deconnexion.php'"><p class="pa">Déconnexion</p></button>
  </li>
</ul>
<?php else: ?>
  <ul class="ult">
  <li class="lit">
    <button class="button" onclick="window.location.href='index.php'"><p class="pa">Accueil</p></button>
  </li>
  <li class="lit">
    <button class="button" onclick="window.location.href='panier.php'"><p class="pa">Panier</p></button>
  </li>
  <li class="lit">
    <button class="button" onclick="window.location.href='connexion.php'"><p class="pa">Connexion</p></button>
  </li>
</ul>
<?php endif; ?>