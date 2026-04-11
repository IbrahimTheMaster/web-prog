<h2>Images Gallery</h2>
<p class="gallery-intro">
    Curated city photos below. The uploads folder is prepared for logged-in users; upload support comes in the next milestone.
</p>

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
