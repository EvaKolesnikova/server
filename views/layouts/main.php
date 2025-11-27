<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no,
          initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Исправлена ошибка: не хватало закрывающей кавычки -->
    <link rel="stylesheet" href="/upractic/public/css/style.css">
</head>

<body>

<header>
    <nav>

        <!-- Главная страница теперь / -->
        <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>

        <?php if (!app()->auth::check()): ?>

            <!-- Если не авторизован -->
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>

        <?php else: ?>

            <!-- Если авторизован -->
            <a href="<?= app()->route->getUrl('/logout') ?>">
                Выход (<?= app()->auth::user()->name ?>)
            </a>

            <!-- Доступ на основе ролей -->

            <?php if (in_array(app()->auth::user()->role, ['librarian', 'admin'])): ?>
                <a href="<?= app()->route->getUrl('/books') ?>">Книги</a>
                <a href="<?= app()->route->getUrl('/readers') ?>">Читатели</a>
                <a href="<?= app()->route->getUrl('/issue-book') ?>">Выдача</a>
                <a href="<?= app()->route->getUrl('/return-book') ?>">Возврат</a>
                <a href="<?= app()->route->getUrl('/most-popular-books') ?>">Популярное</a>
            <?php endif; ?>

            <?php if (app()->auth::user()->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/create-librarian') ?>">Создать библиотекаря</a>
                <a href="<?= app()->route->getUrl('/librarians') ?>">Библиотекари</a>
            <?php endif; ?>

        <?php endif; ?>

    </nav>
</header>

<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>
