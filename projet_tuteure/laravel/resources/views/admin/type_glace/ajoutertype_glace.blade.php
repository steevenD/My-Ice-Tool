<?php
  $titre='Ajout Type Glace';
?>


<div id="casc-open-ice" class="casc-open">
  <div class="casc-list">
    <div class="close-pop">
      <button onclick="closeAddIce()" type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <h4>Ajouter un type de glace</h4>
    <form method="POST" action="{{ route('ajouterUnType_glace') }}">
      {{ csrf_field() }}
      <label for="libType">Nom du type de glace</label>
      <input type="text" name="libType" id="libType" required><br>

      <button type="submit">Ajouter le type de glace</button>
    </form>
  </div>
</div>
