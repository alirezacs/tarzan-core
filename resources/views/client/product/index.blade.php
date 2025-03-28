@extends('client.layout.master')

@section('content')
    <section class="store-container">
        <h2 class="route-title">  فروشگاه </h2>
        <span class="route-path"> خانه >   فروشگاه </span>
    </section>

    <section class="container flex flex-row !my-10 gap-5">

        <div class="options-container">
            <div class="categories">
                <h4 class="option-title">دسته بندی</h4>
                <form action="{{ route('product.index') }}" id="products-category-form" method="GET">
                    <select name="category" id="products-category-select" class="w-full">
                        @foreach($categories as $category)
                            <option value="all">-</option>
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <div class="reveal flex flex-col gap-10">
            @if($products)
                @foreach($products as $product)
                    <div class="grid grid-flow-row lg:grid-cols-4 md:grid-cols-3 max-sm:grid-cols-2 gap-2">
                        <a href="{{ route('product.show', $product->id) }}" class="shop-card">
                            <div class="card-item relative">
                                <img src="{{ $product->getFirstMediaUrl('thumbnail') }}" alt="product" width="300" class="default-img"/>
                                <div class="like-product">
                                    <form action="{{ route('favorite.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="flex">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-details mt-2">
                                <span class="card-name block font-bold">{{ $product->title }}</span>
                                <span class="card-price block text-gray-500">{{ $product->product_variants->first()->price }} تومان</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="flex justify-center items-center">
                    هیج محصولی در این دسته بندی نمیباشد
                </div>
            @endif
        </div>

    </section>
@endsection

@section('script')
    <script>
        let productCategory = document.getElementById('products-category-select');
        let productCategoryForm = document.getElementById('products-category-form');
        productCategory.addEventListener('change', e => {
            productCategoryForm.submit();
        })
    </script>
@endsection
