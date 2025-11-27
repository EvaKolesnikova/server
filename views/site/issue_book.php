<h2 class="page-title">Выдача книги читателю</h2>

<?php if (!empty($message)): ?>
    <p class="success-message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="" class="issue-form">
    <label>Книга:
        <select name="book_id" required>
            <option value="">Выберите книгу</option>
            <?php foreach ($books as $book): ?>
                <option value="<?= $book->id ?>"><?= htmlspecialchars($book->title) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>Читатель:
        <select name="reader_id" required>
            <option value="">Выберите читателя</option>
            <?php foreach ($readers as $reader): ?>
                <option value="<?= $reader->id ?>"><?= htmlspecialchars($reader->full_name) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <button type="submit">Выдать книгу</button>
</form>
