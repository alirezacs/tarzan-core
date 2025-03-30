@extends('client.layout.master')

@section('content')

    <section class="product-section">
        <h2 class="section-title mb-5">
            <span></span>
            صفحه محصول
        </h2>
        <?php
            $colors = $product->product_variants->unique('color.id')->pluck('color');
            $sizes = request()->has('color') ? $product->product_variants->where('color_id', request()->get('color'))->unique('size.id')->pluck('size') : null;
            $productVariant = request()->has(['color', 'size']) ? $product->product_variants()->where([
                'color_id' => request()->get('color'),
                'size_id' => request()->get('size')
            ])->first() : null;
        ?>
        <div class="product-container">
            <div class="productOne-img-container w-full">
                <div class="border shadow-lg relative rounded-xl p-1">
                    <img src="{{ $product->getFirstMediaUrl('gallery') }}" id="gallery-main" width="600" alt="product" />
                </div>
                <div class="grid lg:grid-cols-4 max-lg:grid-cols-2 max-md:grid-cols-4 gap-5 pt-5">
                    @foreach($product->getMedia('gallery') as $media)
                        <div class="flex">
                            <img
                                src="{{ $media->getUrl() }}"
                                alt="product"
                                width="150"
                                class="border cursor-pointer shadow-lg rounded-xl p-1 max-md:w-[300px]"
                                onclick="handleChangePhoto('{{ $media->getUrl() }}')"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col items-start w-full gap-10">
                <div class="path text-black-300">
                    <a
                        href="{{ route('home') }}"
                        class="hover:text-[--primary-color] duration-300 ease-in-out"
                    >
                        خانه
                    </a>
                    >
                    <a
                        href="{{ route('product.index', ['category' => $product->productCategory->id]) }}"
                        class="hover:text-[--primary-color] duration-300 ease-in-out"
                    >
                        {{ $product->productCategory->name }}
                    </a>
                    >
                    <a
                        href="#"
                        class="hover:text-[--primary-color] duration-300 ease-in-out"
                    >
                        {{ $product->title }}
                    </a>
                </div>
                <div class="">
                    <h2 class="font-bold text-5xl max-md:text-xl">{{ $productVariant ? $productVariant->title : $product->title }}</h2>
                </div>
                <form action="{{ route('product.show', $product) }}" method="GET" id="color-size-form">
                    <div>
                        <select name="color" id="color-select">
                            <option>Select Color</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}" @if(request()->has('color') && request()->get('color') === $color->id) selected @endif>{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($sizes)
                        <div>
                            <select name="size" id="size-select">
                                <option>Select Size</option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" @if(request()->has('size') && request()->get('size') === $size->id) selected @endif>{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </form>
                @if($productVariant)
                    <?php
                        $discount = $productVariant->discount;
                    ?>
                    <div>
                        <span class="text-gray-700 font-bold {{ $discount ? 'line-through text-sm' : 'text-3xl' }}">{{ $productVariant->price }}</span>
                        <span class="text-gray-700 font-bold {{ $discount ? 'text-sm line-through' : 'text-xl' }}">تومان</span>
                        @if($productVariant->discount)
                            <span class="text-gray-700 font-bold text-3xl">۱۵۰،۰۰۰۰ تومان</span>
                        @endif
                    </div>
                @endif
                <div class="">
                    <p class="text-black-300">{{ $product->description }}</p>
                </div>
                @if($productVariant)
                    <form action="{{ route('basket.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_variant_id" value="{{ $productVariant->id }}">
                        <input type="hidden" name="type" value="product_variant">
                        <input type="hidden" name="quantity" value="1">
                        <button class="blackBtn px-[5rem]" type="submit">
                            افزودن به سبد خرید
                        </button>
                    </form>
                @else
                    <div class="flex">
                        <button class=" flex flex-col bg-black transition text-gray-400 py-3 px-[5rem] rounded-full pop" disabled>
                            <span>افزودن به سبد خرید</span>
                            <span class="text-xs mt-2 text-gray-400">رنگ و سایز را انتخاب کنید</span>
                        </button>
                    </div>
                @endif
                <div class="flex items-center gap-10">
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-heart p-5 border rounded-full"></i>

                        <form action="{{ route('favorite.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="text-sm font-bold" type="submit">افزودن به علاقه‌مندی‌ها</button>
                        </form>
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <span class="text-black-300 text-sm font-normal">
                      شناسه محصول:
                        <a
                            href="#"
                            class="text-black font-medium text-sm px-2 hover:text-[--primary-color] duration-300 ease-in-out"
                        >
                            {{ $product->slug }}
                        </a>
                    </span>
                    <span class="text-black-300 text-sm font-normal">
                        دسته:
                        <a
                          href="{{ route('product.index', ['category' => $product->productCategory->id]) }}"
                          class="text-black font-medium text-sm px-2 hover:text-[--primary-color] duration-300 ease-in-out"
                        >
                            {{ $product->productCategory->name }}
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="py-[5rem] text-center">
            <span class="text-[28px] font-bold ">توضیحات</span>
            <div class="mt-2">
                <p class="text-gray-500">{!! $product->body !!}</p>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        let galleryMain = document.getElementById('gallery-main');
        const handleChangePhoto = (url) => {
            galleryMain.setAttribute('src', url);
        }

        let colorSelect = document.getElementById('color-select');
        let sizeSelect = document.getElementById('size-select');
        colorSelect.addEventListener('change', e => {
            document.getElementById('color-size-form').submit();
        });
        sizeSelect.addEventListener('change', e => {
            document.getElementById('color-size-form').submit();
        })
    </script>
@endsection
