<?php if (!empty($message)): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" class="reader-form">
    <h2>Добавить читателя</h2>

    <label>Номер читательского билета:</label>
    <input type="text" name="card_number" required>

    <label>ФИО:</label>
    <input type="text" name="full_name" required>

    <label>Адрес:</label>
    <textarea name="address" required></textarea>

    <label>Телефон:</label>
    <input type="text" name="phone_number" required>

    <button type="submit">Добавить читателя</button>
</form>
