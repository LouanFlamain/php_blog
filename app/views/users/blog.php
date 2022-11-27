
<header>
    <nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">


    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="/blog">
        Home
      </a>

      <a class="navbar-item" href="/mesarticles">
        Mes articles
      </a>
      <?php if($_SESSION['type'] === 'admin'){ ?>
        <a class="navbar-item" href="/userManagement">Gérer Users</a>
      <?php } ?>

      <p class="navbar-item">Votre pseudo : <?= $_SESSION['user'] ?></p>
      <?php if($_SESSION['type'] === 'admin'){ ?>
      <p style="color:red" class="navbar-item">Vous êtes Administrateur</p>
      <?php } ?>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-danger" href="/disconnect">
            Logout
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
    </header>
    <section id="formulaire" class="width ml-auto mr-auto mt-4 container card p-4">
        <form action="addpost" method="post">
            <div>
                <label>Content</label>
                <textarea class="textarea" type="text" name="content" placeholder="content" require></textarea>
            </div>
            <button class="button is-info">Envoyer</button>
        </form>
    </section>
<section id="post" class="width ml-auto mr-auto">
    <?php 
    $posts = array_reverse($posts);
    foreach($posts as $post){ 
      $author = $post->getUser();
      $content = $post->getContent();
      $id = $post->getId();
      //$dateTime = $post->getdate();
      ?>
        <div class="card mt-2">
            <div class="card-content">
                <div class="mb-3">
                    <strong><p><?= $author ?></p></strong>
                </div>
                <div class="content">
                    <p><?= $content ?></p>
                </div>
            </div>
            <footer class="card-footer">
              <?php if($_SESSION['user'] === $author){ ?>
                <a href="/update/<?= $id  ?>" class="card-footer-item">Edit</a>
                <?php } 
                if(($_SESSION['user'] === $author) || $_SESSION['type'] === 'admin'){
                ?>
                
                <a href="/delete/<?=$id ?>" class="card-footer-item">Delete</a>
                <?php } ?>
            </footer>
        </div>
        <?php } ?>
        
    </section>