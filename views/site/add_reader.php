<form method="POST" class="reader-form">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <h2>Добавить читателя</h2>

    <?php if (!empty($message)): ?>
        <div style="color: green; font-size: 1em; margin-bottom: 10px;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <label>Номер читательского билета:</label>
    <?php if (!empty($errors['card_number'])): ?>
        <div style="color: red; font-size: 0.9em; margin-bottom: 5px;">
            <?= htmlspecialchars($errors['card_number'][0]) ?>
        </div>
    <?php endif; ?>
    <input type="number"
           name="card_number"
           maxlength="14"
           min="0"
           value="<?= htmlspecialchars($old['card_number'] ?? '') ?>">

    <label>ФИО:</label>
    <?php if (!empty($errors['full_name'])): ?>
        <div style="color: red; font-size: 0.9em; margin-top: 2px; margin-bottom: 5px;">
            <?= htmlspecialchars($errors['full_name'][0]) ?>
        </div>
    <?php endif; ?>
    <input type="text" name="full_name" value="<?= htmlspecialchars($old['full_name'] ?? '') ?>">

    <label>Адрес:</label>
    <?php if (!empty($errors['address'])): ?>
        <div style="color: red; font-size: 0.9em; margin-top: 2px; margin-bottom: 5px;">
            <?= htmlspecialchars($errors['address'][0]) ?>
        </div>
    <?php endif; ?>
    <textarea name="address"><?= htmlspecialchars($old['address'] ?? '') ?></textarea>

    <label>Телефон:</label>
    <?php if (!empty($errors['phone_number'])): ?>
        <div style="color: red; font-size: 0.9em; margin-top: 2px; margin-bottom: 5px;">
            <?= htmlspecialchars($errors['phone_number'][0]) ?>
        </div>
    <?php endif; ?>
    <input type="text"
           name="phone_number"
           value="<?= htmlspecialchars($old['phone_number'] ?? '') ?>">

    <button type="submit">Добавить читателя</button>
</form>
