<?php
  $titre='Ajout Structure';
?>

    <div id="casc-open-str" class="casc-open">
      <div class="casc-list">
        <div class="close-pop">
          <button onclick="closeAddStr()" type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <h4>Ajouter une structure</h4>
          <label for="nomStructure">Nom de la structure</label>
          <input type="text" name="nomStructure" id="nomStructure" required><br>
          <button onclick="ajoutStructure()">Ajouter la structure</button>
      </div>
    </div>


