@extends('client.layout.master')

@section('content')
    <section class="blog-container">
        <h2 class="black-route-title">وبلاگ</h2>
        <span class="black-route-path"> خانه > وبلاگ </span>
    </section>

    <section class="container relative">
        <div class="flex flex-col items-center">

            <div class="flex w-full justify-between mt-10">
                <h2 class="section-title"><span> </span>پست های وبلاگ</h2>
            </div>
            <div
                class="grid grid-flow-row lg:grid-cols-4 max-lg:grid-cols-2 gap-10 border-b"
            >
                @foreach($articles as $article)
                    <a href="{{ route('article.show', $article->id) }}">
                        <div class="portfolio-box max-lg:my-2">
                            <img
                                src="{{ $article->getFirstMediaUrl('thumbnail') }}"
                                width="400"
                                height="400"
                                alt="portfolio"
                            />
                            <div class="portfolio-layer">
                                <h5>{{ $article->title }}</h5>
                                <span>{{ $article->short_description }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
