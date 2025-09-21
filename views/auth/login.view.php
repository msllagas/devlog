<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<section class="bg-gray-50 dark:bg-gray-900 h-screen">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Login to <span class="text-blue-500">DevLog</span>
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="/login">
                    <div>
                        <label for="username"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username"
                               value="<?= old('username') ?>"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500">
                        <?php if (isset($errors['username'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['username'] ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password"
                               value="<?= old('password') ?>"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500">
                        <?php if (isset($errors['password'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['password'] ?></p>
                        <?php endif ?>
                        <?php if (isset($errors['login'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['login'] ?></p>
                        <?php endif ?>
                    </div>
                    <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 cursor-pointer dark:hover:bg-blue-600">
                        Login
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Don't have an account? <a href="/signup"
                                                  class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign
                            Up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require base_path('views/partials/foot.php'); ?>
