<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form id="postForm" method="POST" action="/posts">
            <div class="space-y-12">
                <div class="pb-8">
                    <h2 class="text-base/7 font-bold text-gray-900">Write a New Post</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">
                        Share your thoughts, stories, or updates with the community. Once published, your post will be
                        visible to everyone.
                    </p>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="title" class="block text-sm/6 font-semibold text-gray-900">Title</label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <input id="title" type="text" name="title" placeholder="New post title here..."
                                           value="<?= isset($errors['title']) ? old('title') : '' ?>"
                                           class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"/>
                                </div>
                                <?php if (isset($errors['title'])) : ?>
                                    <p class="text-red-500 text-xs mt-2"><?= $errors['title'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="content" class="block text-sm/6 font-semibold text-gray-900">Content</label>
                            <div class="mt-2">
                                <!--<textarea id="content" name="content" placeholder="Write your post content here..."
                                          rows="3"
                                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"><?php /*= old('content') */ ?></textarea>-->
                                <div id="editor">
                                </div>
                                <input type="hidden" name="content" id="content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Save
                </button>
            </div>
        </form>

    </div>
</main>
<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Write your post content here...'
    });

    const form = document.getElementById('postForm');
    form.addEventListener('submit', function (e) {
        document.getElementById('content').value = JSON.stringify(quill.getContents());
    });

</script>

<?php require base_path('views/partials/foot.php'); ?>;


