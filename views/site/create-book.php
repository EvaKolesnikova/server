<?php if (!empty($message)): ?>
    <p class="message success"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="book-form">
    <h2>Добавить книгу</h2>

    <label>Название:</label>
    <input type="text" name="title" required>

    <label>Автор:</label>
    <input type="text" name="author" required>

    <label>Год издания:</label>
    <input type="number" name="published_year" required>

    <label>Цена:</label>
    <input type="number" step="0.01" name="price" required>

    <label><input type="checkbox" name="is_new_edition"> Новое издание</label>

    <label>Аннотация:</label>
    <textarea name="description" rows="4"></textarea>

    <label>Обложка книги:</label>
    <input type="file" name="cover_file" accept="image/*">

    <div class="preview">
        <img id="coverPreview" src="" alt="Превью обложки" style="display:none;">
    </div>

    <button type="submit">ДОБАВИТЬ КНИГУ</button>
</form>
