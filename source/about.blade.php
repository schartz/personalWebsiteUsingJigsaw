@extends('_layouts.master')

@push('meta')
    <meta property="og:title" content="About {{ $page->siteName }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="A little bit about {{ $page->siteName }}" />
@endpush

@section('body')
    <h1>About</h1>

    <img src="/assets/img/about.png"
        alt="About image"
        class="flex rounded-full h-64 w-64 bg-contain mx-auto md:float-right my-6 md:ml-10">

    <p class="mb-6">
        I am a Software architect with an inclination towards machine learning, distributed computing and all things cloud.
    </p>

    <p class="mb-6">
        I'm currently working as Technology Lead at <a href="https://allps.ch/">ALLPS GmbH</a>
    </p>

    <h3>
        Contact
    </h3>
    <ul>
        <li>
            <a href="https://github.com/schartz">
                Github
            </a>
        </li>
        <li>
            <a href="https://twitter.com/schartzium">
                Twitter
            </a>
        </li>
        <li>
            <a href="https://facebook.com/schartzrehan">
                Facebook
            </a>
        </li>
        <li>
            <a href="https://www.linkedin.com/in/schartzrehan/">
                LinkedIn
            </a>
        </li>
    </ul>
@endsection
