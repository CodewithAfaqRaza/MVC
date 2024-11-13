<ul>
    <?php foreach ($all_news as $news): ?>
        <li>
            <a>
                <?= $news['title'] ?></a>
        </li>
    <?php endforeach; ?>
</ul>