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

      <p class="navbar-item">Votre pseudo : <?= $_SESSION['user'] ?></p>
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
    <section id="post" class="width ml-auto mr-auto">
    <?php 
    $posts = array_reverse($posts);
    foreach($posts as $post){ 
      $author = $post->getUser();
      $content = $post->getContent();
      $id = $post->getId();
      ?>
        <div class="card mt-2">
            <div class="card-content">
                <div class="mb-3">
                    <strong><p><?= $author ?></p></strong>
                </div>
                <div class="content">
                    <p><?= $content ?></p>
                    <p><?php ?></p>
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