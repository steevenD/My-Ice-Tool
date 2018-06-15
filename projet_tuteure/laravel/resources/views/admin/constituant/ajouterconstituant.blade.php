<?php
  $titre='Ajout Constituant';
?>

<div id="casc-open-con" class="casc-open">
  <div class="casc-list">
    <div class="close-pop">
      <button onclick="closeAddCon()" type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <h4>Ajouter un constituant</h4>
    <form method="POST" action="{{ route('ajouterUnConstituant') }}">
      {{ csrf_field() }}
      <label for="libConst">Nom du constituant</label>
      <input type="text" name="libConst" id="libConst" required><br>

      <button type="submit">Ajouter le constituant</button>
    </form>
  </div>
</div>
