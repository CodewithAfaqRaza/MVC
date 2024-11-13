<ul>
    <?php foreach ($all_article as $news): ?>
    <li>
        <a>
            <?= $news['title'] ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>