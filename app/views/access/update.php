<section class="field width ml-auto mr-auto card absolute-center">
    <div class="card-content">
        <form action="/setupdate/<?= $id ?>" method="post">
            <div>
                <label>Content</label>
                <textarea class="textarea" type="text" name="content" placeholder="content" require></textarea>
            </div>
            <button class="button is-info">Envoyer</button>
        </form>
    </div>
</section>