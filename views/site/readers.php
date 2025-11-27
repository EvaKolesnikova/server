<div class="readers-page">
    <h2 class="page-title">Список читателей</h2>

    <?php if (empty($readers)): ?>
        <p class="empty-msg">Читателей пока нет.</p>
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