<div class="auth-container">
    <h2>Авторизация</h2>
    <h3><?= $message ?? ''; ?></h3>
    <h3><?= app()->auth->user()->name ?? ''; ?></h3>

    <?php if (!app()->auth::check()): ?>
        <form method="post">
            <?php if (!empty($errors['login'])): ?>
                <p class="error"><?= implode(', ', $errors['login']) ?></p>
            <?php endif; ?>
            <label>Логин
                <input type="text" name="login">
            </label>
            <label>Пароль
                <input type="password" name="password">
            </label>
            <button>Войти</button>
        </form>
    <?php endif; ?>
</div>
