<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<section class="bg-gray-50 dark:bg-gray-900 h-screen">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Create <span class="text-blue-500">DevLog</span> account
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="/signup">
                    <div>
                        <label for="email"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email<span
                                    class="text-red-500 ml-2">*</span></label>
                        <input type="email" name="email" value="<?= old('email') ?>" id="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                               required="">
                        <?php if (isset($errors['email'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['email'] ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name<span
                                    class="text-red-500 ml-2">*</span></label>
                        <input type="text" name="name" id="name" value="<?= old('name') ?>"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500">
                        <?php if (isset($errors['name'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['name'] ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username<span
                                    class="text-red-500 ml-2">*</span></label>
                        <input type="text" name="username" id="username" value="<?= old('username') ?>"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                               required="">
                        <?php if (isset($errors['username'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['username'] ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password<span
                                    class="text-red-500 ml-2">*</span></label>
                        <input type="password" name="password" id="password" value="<?= old('password') ?>"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                               required="">
                        <?php if (isset($errors['password'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['password'] ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <label for="password-confirmation"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                            password<span class="text-red-500 ml-2">*</span></label>
                        <input type="password" name="password-confirmation" id="password-confirmation"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                               required="">
                        <?php if (isset($errors['password-confirmation'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['password-confirmation'] ?></p>
                        <?php endif ?>
                    </div>
                    <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 cursor-pointer dark:hover:bg-blue-600">
                        Create an account
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="/login"
                                                    class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
                            here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require base_path('views/partials/foot.php'); ?>
