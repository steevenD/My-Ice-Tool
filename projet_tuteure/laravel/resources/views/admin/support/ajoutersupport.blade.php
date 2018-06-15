<?php
  $titre='Ajout Support';
?>

<div id="casc-open-sup" class="casc-open">
  <div class="casc-list">
    <div class="close-pop">
      <button onclick="closeAddSup()" type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <h4>Ajouter un support</h4>
    <form method="POST" action="{{ route('ajouterUnSupport') }}">
        {{ csrf_field() }}
        <label for="libSupp">Nom du support</label>
        <input type="text" name="libSupp" id="libSupp" required><br>

        <button type="submit">Ajouter le support</button>
    </form>
  </div>
</div>
