<div class="readers-page">
    <h2 class="page-title">Список читателей</h2>

    <div class="search-section">
        <form method="GET" action="" class="search-form">
            <div class="search-container">
                <input type="text"
                       name="search"
                       value="<?= htmlspecialchars($search ?? '') ?>"
                       placeholder="Поиск по ФИО"
                       class="search-input">
                <button type="submit" class="search-btn">Найти</button>
                <?php if (!empty($search)): ?>
                    <a href="<?= app()->route->getUrl('/readers') ?>" class="clear-btn">Очистить</a>
                <?php endif; ?>
            </div>
        </form>

        <?php if (!empty($search)): ?>
            <span class="search-count">
                Найдено: <?= count($readers) ?> читателей
            </span>
        <?php endif; ?>
    </div>

    <?php if (empty($readers)): ?>
        <p class="empty-msg">
            Читателей пока нет
            <?php if (!empty($search)): ?>
                или не найдено по запросу "<?= htmlspecialchars($search) ?>"
            <?php endif; ?>.
        </p>
    <?php else: ?>
        <div class="actions">
            <a href="<?= app()->route->getUrl('/create-reader') ?>" class="btn">
                Добавить читателя
            </a>
        </div>

        <table class="readers-table">
            <thead>
            <tr>
                <th>№</th>
                <th>ФИО читателя</th>
                <th>Номер читательского билета</th>
                <th>Номер телефона</th>
                <th>Адрес</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($readers as $i => $reader): ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= htmlspecialchars($reader->full_name) ?></td>
                    <td><?= htmlspecialchars($reader->card_number) ?></td>
                    <td><?= htmlspecialchars($reader->phone_number) ?></td>
                    <td><?= htmlspecialchars($reader->address) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
