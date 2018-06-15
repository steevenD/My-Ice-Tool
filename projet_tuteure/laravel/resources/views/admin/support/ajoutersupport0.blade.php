<?php
  $titre='Ajout Support';
?>

<!--


<h1>Ajouter support</h1>
<h3><a href="{{ route('supprimermodifiersupport')}}">Supprimer / Modifier un support</a></h3>
<h3><a href="{{ route('admin')}}">Tableau Administrateur</a></h3>
<form method="POST" action="{{ route('ajouterUnSupport') }}">
    {{ csrf_field() }}
    <label for="libSupp">Nom du support</label>
    <input type="text" name="libSupp" id="libSupp" required><br>

    <button type="submit">Ajouter le support</button>
</form>
-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ajouter un support</h4>
            </div>

            <form method="POST" action="{{ route('ajouterUnSupport') }}">
                {{ csrf_field() }}
                <label for="libSupp">Nom du support</label>
                <input type="text" name="libSupp" id="libSupp" required><br>

                <button type="submit">Ajouter le support</button>
            </form>
        </div>

    </div>
</div>
