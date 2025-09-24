<?php require 'partials/head.php'; ?>
<?php require "partials/nav.php"; ?>
<?php require 'partials/banner.php'; ?>

<main>
    <div class="mx-auto max-w-7xl px-2 py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 lg:p-6">
            <?php foreach ($posts as $post): ?>
                <a href="<?= htmlspecialchars($post['url']) ?>"
                      class="flex items-start gap-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <!-- Avatar -->
                    <div class="flex-shrink-0 w-10 h-10">
                        <img src="https://randomuser.me/api/portraits/men/39.jpg" alt="Profile Picture" class="w-full h-full rounded-full">
                    </div>

                    <div>
                        <div class="mb-4">
                            <p class="!text-base font-normalfont-semibold text-gray-500 dark:text-gray-200">
                                <?= htmlspecialchars($post['username']) ?>
                            </p>
                            <p class="text-sm font-normal italic text-gray-500 dark:text-gray-200">
                                <?= date("M. j, Y", strtotime($post['published_at'])) ?>
                            </p>
                        </div>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <?= htmlspecialchars($post['title']) ?>
                        </h5>
                    </div>
                </a>

            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php require 'partials/foot.php'; ?>

