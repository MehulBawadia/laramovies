<footer class="py-6 px-8 text-sm">
    <div class="container mx-auto">
        <div class="flex flex-col items-center justify-center">
            <div>
                Powered By <a href="#" class="ml-1 inline-block underline hover:text-gray-300 focus:text-gray-300" target="_blank">TMDB API</a>
            </div>

            <div class="flex items-center mt-3">
                Made with <svg class="text-red-600 w-6 h-6 mx-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg> using Laravel {{ app()->version() }}
            </div>

            <div class="flex mt-3">
                Copyright &copy; {{ date('Y') }}. All Rights Reserved.
            </div>
        </div>
    </div>
</footer>
