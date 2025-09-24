<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="/">
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                             alt="DevLog" class="size-8"/>
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- User is logged in -->
                        <a href="/posts/create"
                           class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                            Create Post
                        </a>
                        <a href="/logout"
                           class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                            Logout
                        </a>
                    <?php else: ?>
                        <!-- Guest -->
                        <a href="/login"
                           class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                            Login
                        </a>
                        <a href="/signup"
                           class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                            Create account
                        </a>
                    <?php endif; ?>

                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" command="--toggle" commandfor="mobile-menu"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                         aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                         aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <el-disclosure id="mobile-menu" hidden class="block md:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
            <a href="/login"
               class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Login</a>
            <a href="/signup"
               class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Create
                account</a>
        </div>
    </el-disclosure>
</nav>
