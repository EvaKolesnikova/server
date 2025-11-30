<?php if (!empty($message)): ?>
    <p class="message success"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="book-form">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <h2>Добавить книгу</h2>

    <label>Название:</label>
    <?php if (!empty($errors['title'])): ?>
        <div class="field-error"><?= htmlspecialchars($errors['title'][0]) ?></div>
    <?php endif; ?>
    <input type="text" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>">


    <label>Автор:</label>
    <?php if (!empty($errors['author'])): ?>
        <div class="field-error"><?= htmlspecialchars($errors['author'][0]) ?></div>
    <?php endif; ?>
    <input type="text" name="author" value="<?= htmlspecialchars($old['author'] ?? '') ?>">

    <label>Год издания:</label>
    <?php if (!empty($errors['published_year'])): ?>
        <div class="field-error"><?= htmlspecialchars($errors['published_year'][0]) ?></div>
    <?php endif; ?>
    <input type="number" name="published_year" min="0" value="<?= htmlspecialchars($old['published_year'] ?? '') ?>">


    <label>Цена:</label>
    <?php if (!empty($errors['price'])): ?>
        <div class="field-error"><?= htmlspecialchars($errors['price'][0]) ?></div>
    <?php endif; ?>
    <input type="number" step="0.01" name="price" min="0" value="<?= htmlspecialchars($old['price'] ?? '') ?>">

    <label><input type="checkbox" name="is_new_edition" <?= isset($old['is_new_edition']) ? 'checked' : '' ?>> Новое издание</label>

    <label>Аннотация:</label>
    <textarea name="description" rows="4"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>

    <label>Обложка книги:</label>
    <input type="file" name="cover_file" accept="image/*">

    <div class="preview">
        <img id="coverPreview" src="" alt="Превью обложки" style="display:none;">
    </div>

    <button type="submit">ДОБАВИТЬ КНИГУ</button>
</form>
