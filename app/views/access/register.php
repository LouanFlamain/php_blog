
<section class="field width ml-auto mr-auto card-content">
    <form class="card p-3" action="/setregister" method="post">
        <div>
            <label class="label">User</label>
            <input class="input" type="text" name="user" placeholder="user">
        </div>
        <div class="mb-4">
            <label class="label">Password</label>
            <input class="input" type="password" name="password" placeholder="password">
        </div>
        <div class="mb-4">
            <label class="label">Retype-Password</label>
            <input class="input" type="password" name="verifpassword" placeholder="retype-password">
        </div>
        <input type="submit" class="button is-info">
    </form>
    <div>
        <a href="/login">
            <button class="button is-link w-100">
                Login
            </button>
        </a>
    </div>
</section>

