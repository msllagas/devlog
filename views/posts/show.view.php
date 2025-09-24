<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<main>
    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <article class="prose lg:prose-xl prose-invert">
            <!-- Post title -->
            <h1 class="mb-2 text-4xl font-bold tracking-tight text-white dark:text-gray-900">
                <?= htmlspecialchars($post['title']) ?>
            </h1>

            <!-- Author & published date -->
            <p class="text-gray-400 dark:text-gray-600 text-sm">
                By <span class="font-semibold text-black text-base"><?= htmlspecialchars($author_name) ?></span>
            </p>
            <p class="text-gray-400 dark:text-gray-600 text-sm mb-6">
                Published on <?= date("M j, Y", strtotime($post['published_at'])) ?>
            </p>

            <!-- Divider -->
            <hr class="my-6 border-gray-700 dark:border-gray-300">

            <!-- Post content -->
            <div class="prose prose-invert leading-relaxed" id="post-content">
            </div>
        </article>
    </div>
</main>
<script>
    const delta = <?= $post['content'] ?>; // the JSON stored in DB
    const display = new Quill('#post-content', {
        theme: 'bubble', // or 'snow'
        readOnly: true
    });
    display.setContents(delta);

    const editor = document.querySelector('#post-content');
    editor.querySelectorAll('h1').forEach(h1 => {
        h1.classList.add('text-2xl', 'mb-4');
    });

    editor.querySelectorAll('h2').forEach(h2 => {
        h2.classList.add('text-xl', 'mb-3');
    });

    editor.querySelectorAll('h3').forEach(h3 => {
        h3.classList.add('text-base');
    });

    editor.querySelectorAll('p').forEach(p => {
        p.classList.add('text-sm');
    });

    editor.querySelectorAll('strong').forEach(strong => {
        strong.classList.add('font-semibold');
    })
</script>

<?php require base_path('views/partials/foot.php'); ?>

