<section class="width absolute-center">
    <div class="card">
  <div class="card-content">
    <div class="media">
      <div class="media-left">
        <figure class="image is-48x48">
          <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
        </figure>
        <?php //$users = array_reverse($users); 
        foreach($users as $user){
            $author = $user->getUser();
            $type = $user->getTypeUser();
            $id = $user->getId();
        ?>
      </div>
      <div class="media-content">
        <p class="title is-4"><?= $author?></p>
        <p class="subtitle is-6">type d'utilisateur : <?= $type ?> </p>
      </div>
    </div>

    <div class="content">
      <p>Id de l'utilisateur : <?= $id ?></p>
    </div>
    <div class="control">
        <?php if($type !== 'admin'){ ?>
        <a href="/deleteUser/<?=$id?>">
        <button class="button is-link">Supprimer utilisateur</button>
        </a>
        <?php } ?>
    </div>
  </div>
</div>
<?php } ?>
    </section>