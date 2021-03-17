@extends('partials._layout')

@section('title')
    <title>Movie Name here | {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="border-b border-gray-800">
        <div class="container mx-auto">
            <div class="px-8 py-16">
                <div class="flex">
                    <img src="{{ asset('/images/parasite.jpg') }}" alt="Parasite" class="w-96" />

                    <div class="ml-24">
                        <h1 class="text-4xl font-bold">Parasite (2019)</h1>

                        <div class="flex items-center text-gray-400 text-sm mt-2">
                            <svg class="fill-current text-yellow-600 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                            <span class="ml-1">85%</span>
                            <span class="mx-2">|</span>
                            <span>Feb 20th 2020</span>
                            <span class="mx-2">|</span>
                            <span>Action, Thriller, Comedy</span>
                        </div>

                        <p class="mt-12 text-gray-300">
                            Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Nulla accusantium nostrum, labore voluptatibus quis commodi itaque sapiente qui rem! Optio et iure aliquam deserunt voluptate ad commodi nisi dolorem qui error voluptas, officia assumenda vero adipisci sequi ea dolor voluptatum eos minima quam eveniet officiis explicabo magnam? Ipsum, reprehenderit odio?
                        </p>

                        <div class="mt-12">
                            <h2 class="text-white font-bold">Featured Cast</h2>

                            <div class="flex mt-4">
                                <div>
                                    <div>Bong Joon-Ho</div>
                                    <div class="text-sm text-gray-400">Screenplay, Director, Story</div>
                                </div>
                                <div class="ml-8">
                                    <div>Han Jin-won</div>
                                    <div class="text-sm text-gray-400">Screenplay</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12">
                            <button class="flex items-center bg-yellow-600 text-gray-900 rounded font-bold px-5 py-4 hover:bg-yellow-700 focus:bg-yellow-700 focus:outline-none transition ease-in-out duration-150">
                                <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border-b border-gray-800">
        <div class="container mx-auto">
            <div class="px-8 py-16">
                <h2 class="text-3xl font-bold">Images</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="movieCard mt-8">
                        <a href="#">
                            <img src="{{ asset('/images/image1.jpg') }}" alt="Image 1" title="Image 1" class="hover:opacity-75 transition ease-in-out duration-150" />
                        </a>
                    </div>
                    <div class="movieCard mt-8">
                        <a href="#">
                            <img src="{{ asset('/images/image2.jpg') }}" alt="Image 2" title="Image 2" class="hover:opacity-75 transition ease-in-out duration-150" />
                        </a>
                    </div>
                    <div class="movieCard mt-8">
                        <a href="#">
                            <img src="{{ asset('/images/image3.jpg') }}" alt="Image 3" title="Image 3" class="hover:opacity-75 transition ease-in-out duration-150" />
                        </a>
                    </div>
                    <div class="movieCard mt-8">
                        <a href="#">
                            <img src="{{ asset('/images/image4.jpg') }}" alt="Image 4" title="Image 4" class="hover:opacity-75 transition ease-in-out duration-150" />
                        </a>
                    </div>
                    <div class="movieCard mt-8">
                        <a href="#">
                            <img src="{{ asset('/images/image5.jpg') }}" alt="Image 5" title="Image 5" class="hover:opacity-75 transition ease-in-out duration-150" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto">
        <div class="px-8 py-16">
            <h2 class="text-3xl font-bold">Cast</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                <div class="movieCard mt-8">
                    <a href="#">
                        <img src="{{ asset('/images/actor1.jpg') }}" alt="Actor 1" title="Actor 1" class="hover:opacity-75 transition ease-in-out duration-150" />
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg hover:text-gray-300 focus:text-gray-300 focus:outline-none">Real Name</a>

                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            John Smith
                        </div>
                    </div>
                </div>
                <div class="movieCard mt-8">
                    <a href="#">
                        <img src="{{ asset('/images/actor2.jpg') }}" alt="Actor 2" title="Actor 2" class="hover:opacity-75 transition ease-in-out duration-150" />
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg hover:text-gray-300 focus:text-gray-300 focus:outline-none">Real Name</a>

                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            John Smith
                        </div>
                    </div>
                </div>
                <div class="movieCard mt-8">
                    <a href="#">
                        <img src="{{ asset('/images/actor3.jpg') }}" alt="Actor 3" title="Actor 3" class="hover:opacity-75 transition ease-in-out duration-150" />
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg hover:text-gray-300 focus:text-gray-300 focus:outline-none">Real Name</a>

                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            John Smith
                        </div>
                    </div>
                </div>
                <div class="movieCard mt-8">
                    <a href="#">
                        <img src="{{ asset('/images/actor4.jpg') }}" alt="Actor 4" title="Actor 4" class="hover:opacity-75 transition ease-in-out duration-150" />
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg hover:text-gray-300 focus:text-gray-300 focus:outline-none">Real Name</a>

                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            John Smith
                        </div>
                    </div>
                </div>
                <div class="movieCard mt-8">
                    <a href="#">
                        <img src="{{ asset('/images/actor5.jpg') }}" alt="Actor 5" title="Actor 5" class="hover:opacity-75 transition ease-in-out duration-150" />
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg hover:text-gray-300 focus:text-gray-300 focus:outline-none">Real Name</a>

                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            John Smith
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
