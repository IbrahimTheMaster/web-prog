<h2>Images Gallery</h2>
<p class="gallery-intro">
    Curated city photos below. Logged-in users can upload new images to the community section.
</p>

<section class="gallery-section" aria-labelledby="gallery-upload-heading">
    <h3 id="gallery-upload-heading">Upload a new image</h3>
    <?php if (!empty($uploadSuccess)) { ?>
        <p class="upload-success"><?= htmlspecialchars($uploadSuccess, ENT_QUOTES, 'UTF-8') ?></p>
    <?php } ?>
    <?php if (!empty($uploadErrors)) { ?>
        <ul class="upload-errors">
            <?php foreach ($uploadErrors as $error) { ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <?php if (isset($_SESSION['login'])) { ?>
        <form action="images" method="post" enctype="multipart/form-data" class="upload-form">
            <label for="image_file">Image file (jpg, png, gif, webp, max 3 MB, checked server-side):</label><br>
            <input type="file" name="image_file" id="image_file" accept=".jpg,.jpeg,.png,.gif,.webp" required>
            <button type="submit" name="upload_image" value="1">Upload</button>
        </form>
    <?php } else { ?>
        <p class="gallery-empty">Login first to upload images.</p>
    <?php } ?>
</section>

<section class="gallery-section" aria-labelledby="gallery-curated-heading">
    <h3 id="gallery-curated-heading">Featured gallery</h3>
    <?php if (empty($galleryImages)) { ?>
        <p class="gallery-empty">No gallery images yet. Add image files under <code>images/gallery/</code>.</p>
    <?php } else { ?>
        <ul class="gallery-grid">
            <?php foreach ($galleryImages as $file) {
                $safe = htmlspecialchars($file, ENT_QUOTES, 'UTF-8');
                ?>
            <li class="gallery-item">
                <figure>
                    <a href="./images/gallery/<?= $safe ?>" target="_blank" rel="noopener">
                        <img src="./images/gallery/<?= $safe ?>" alt="Gallery photo: <?= $safe ?>" loading="lazy" width="320" height="240">
                    </a>
                    <figcaption><?= $safe ?></figcaption>
                </figure>
            </li>
            <?php } ?>
        </ul>
    <?php } ?>
</section>

<section class="gallery-section" aria-labelledby="gallery-uploads-heading">
    <h3 id="gallery-uploads-heading">Community uploads</h3>
    <?php if (empty($uploadImages)) { ?>
        <p class="gallery-empty">No uploads yet. This area will list files saved under <code>images/uploads/</code> after upload is enabled.</p>
    <?php } else { ?>
        <ul class="gallery-grid">
            <?php foreach ($uploadImages as $file) {
                $safe = htmlspecialchars($file, ENT_QUOTES, 'UTF-8');
                ?>
            <li class="gallery-item">
                <figure>
                    <a href="./images/uploads/<?= $safe ?>" target="_blank" rel="noopener">
                        <img src="./images/uploads/<?= $safe ?>" alt="Uploaded photo: <?= $safe ?>" loading="lazy" width="320" height="240">
                    </a>
                    <figcaption><?= $safe ?></figcaption>
                </figure>
            </li>
            <?php } ?>
        </ul>
    <?php } ?>
</section>

<?php if (!empty($uploadHistory)) { ?>
<section class="gallery-section" aria-labelledby="gallery-upload-history-heading">
    <h3 id="gallery-upload-history-heading">Recent upload activity</h3>
    <table class="upload-history-table">
        <tr>
            <th>Time</th>
            <th>User</th>
            <th>File</th>
        </tr>
        <?php foreach ($uploadHistory as $row) { ?>
            <tr>
                <td><?= htmlspecialchars((string) $row['uploaded_at'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars((string) $row['uploaded_by'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars((string) $row['file_name'], ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php } ?>
    </table>
</section>
<?php } ?>
