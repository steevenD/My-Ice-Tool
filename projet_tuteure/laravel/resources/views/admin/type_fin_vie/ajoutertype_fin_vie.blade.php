<?php
  $titre='Ajout Type Fin de Vie';
?>

<div id="casc-open-life" class="casc-open">
  <div class="casc-list">
    <div class="close-pop">
      <button onclick="closeAddLife()" type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <h4>Ajouter un type de fin de vie</h4>
    <form method="POST" action="{{ route('ajouterUnType_fin_vie') }}">
      {{ csrf_field() }}
      <label for="libTypeFin">Nom du type de fin de vie</label>
      <input type="text" name="libTypeFin" id="libTypeFin" required><br>

      <button type="submit">Ajouter le type de fin de vie</button>
    </form>
  </div>
</div>
