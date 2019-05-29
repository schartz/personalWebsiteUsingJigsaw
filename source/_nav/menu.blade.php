<nav class="hidden lg:flex items-center justify-end text-lg">
    <a title="{{ $page->siteName }} Blog" href="/blog"
        class="ml-6 text-grey-darker hover:text-blue-dark {{ $page->isActive('/blog') ? 'active text-blue-dark' : '' }}">
        Blog
    </a>

    <a title="{{ $page->siteName }} About" href="/about"
        class="ml-6 text-grey-darker hover:text-blue-dark {{ $page->isActive('/about') ? 'active text-blue-dark' : '' }}">
        About
    </a>

    <a title="{{ $page->siteName }} Resume" href="/resume" target="_blank"
        class="ml-6 text-grey-darker hover:text-blue-dark {{ $page->isActive('/resume') ? 'active text-blue-dark' : '' }}">
        Resume
    </a>
</nav>
