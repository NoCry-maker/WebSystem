@extends('layouts.app')
@section('content')
    <style>
        .filled-heart {
            color: orange;
        }

        .product-main-image {
            overflow: hidden;
            position: relative;
            display: inline-block;
            cursor: zoom-in;
        }

        .product-main-image img {
            transition: transform 0.4s ease;
        }

        .product-main-image:hover img {
            transform: scale(1.5);
            /* adjust zoom level */
        }
    </style>

    <main class="pt-90">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>

                <nav class="product-pager ml-auto" aria-label="Product">
                    <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                        <i class="icon-angle-left"></i>
                        <span>Prev</span>
                    </a>

                    <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                        <span>Next</span>
                        <i class="icon-angle-right"></i>
                    </a>
                </nav><!-- End .pager-nav -->
            </div><!-- End .container -->
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="row">
                                    <figure class="product-main-image">
                                        <img id="product-zoom" src="{{ asset('uploads/products') }}/{{ $product->image }}"
                                            data-zoom-image="{{ asset('uploads/products') }}/{{ $product->image }}"
                                            alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>


                                    </figure><!-- End .product-main-image -->



                                    <div id="product-zoom-gallery" class="product-image-gallery">

                                        @foreach (explode(',', $product->images) as $gimg)
                                            <a class="product-gallery-item active"
                                                href="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                data-image="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                data-zoom-image="assets/images/products/single/1-big.jpg">
                                                <img src="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                    alt="product side">
                                            </a>
                                        @endforeach

                                    </div><!-- End .product-image-gallery -->

                                </div><!-- End .row -->

                            </div><!-- End .product-gallery -->
                        </div>

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->
                                <div class="ratings-container">
                                    @php
                                        $avgRating = round($product->reviews->avg('rating'), 1); // example: 3.7
                                    @endphp

                                    @php
                                        $reviewCount = $product->reviews->count();
                                        $avgRating = $reviewCount ? round($product->reviews->avg('rating'), 1) : 0;
                                    @endphp

                                    <div id="averageRatingDisplay" class="ratings-container my-1">
                                        @if ($reviewCount > 0)
                                            <span class="flex gap-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="display-star-icon" width="20" height="20"
                                                        fill="{{ $i <= $avgRating ? '#facc15' : '#d1d5db' }}"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 .587l3.668 7.568L24 9.423l-6 5.846 1.417 8.254L12 18.897l-7.417 4.626L6 15.269 0 9.423l8.332-1.268z" />
                                                    </svg>
                                                @endfor
                                            </span>

                                            <span
                                                class="ml-2 text-sm text-gray-600">({{ number_format($avgRating, 1) }}/5)</span>
                                        @else
                                            <span class="ml-2 text-sm text-gray-600">No reviews yet</span>
                                        @endif
                                    </div>


                                </div><!-- End .rating-container -->

                                <div class="product-price">
                                    @if ($product->sale_price)
                                        <s>₱{{ $product->regular_price }} </s> ₱{{ $product->sale_price }}
                                    @else
                                        ₱{{ $product->regular_price }}
                                    @endif
                                </div><!-- End .product-price -->

                                <div class="product-content">
                                    <p>{{ $product->short_description }} </p>
                                </div><!-- End .product-content -->

                                {{-- <div class="details-filter-row details-row-size">
                                    <label>Color:</label>

                                    <div class="product-nav product-nav-thumbs">
                                        <a href="#" class="active">
                                            <img src="assets/images/products/single/1-thumb.jpg" alt="product desc">
                                        </a>
                                        <a href="#">
                                            <img src="assets/images/products/single/2-thumb.jpg" alt="product desc">
                                        </a>
                                    </div><!-- End .product-nav -->
                                </div><!-- End .details-filter-row --> --}}

                                {{-- <div class="details-filter-row details-row-size">
                                        <label for="size">Size:</label>
                                        <div class="select-custom">
                                            <select name="size" id="size" class="form-control">
                                                <option value="#" selected="selected">Select a size</option>
                                                <option value="s">Small</option>
                                                <option value="m">Medium</option>
                                                <option value="l">Large</option>
                                                <option value="xl">Extra Large</option>
                                            </select>
                                        </div><!-- End .select-custom -->

                                        <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                                    </div><!-- End .details-filter-row --> --}}

                                <div class="product-details-action">
                                    @auth
                                        <!-- Add to Cart / Go to Cart -->
                                        @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                                            <a href="{{ route('cart.index') }}" class="btn-product btn-cart"><span>Go to
                                                    Cart</span></a>
                                        @else
                                            <form method="POST" action="{{ route('cart.add') }}" class="mb-2">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price"
                                                    value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn ">
                                                    <div class="product-details-action">
                                                        <a href="" class="btn-product btn-cart"><span>Add to
                                                                Cart</span></a>
                                                    </div>
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <button type="submit" class="btn ">
                                            <div class="product-details-action">
                                                <a href="" class="btn-product btn-cart"><span>Add to
                                                        Cart</span></a>
                                            </div>
                                        </button>
                                        <style>
                                            .btn-product.btn-cart:hover span {
                                                color: #fff !important;
                                            }
                                        </style>
                                    @endauth


                                    <div class="details-action-wrapper d-flex flex-column gap-2">
                                        @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                            <form method="POST"
                                                action="{{ route('wishlist.item.remove', ['rowId' => Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-wishlist-plain">
                                                    <div class="product-details-action">
                                                        <a href="#" class="btn-product btn-wishlist mt-1"
                                                            title="Wishlist"><span>Remove to Wishlist</span></a>

                                                    </div>
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('wishlist.add') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price"
                                                    value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn-wishlist-plain">
                                                    <div class="product-details-action">
                                                        <a href="#" class="btn-product btn-wishlist mt-1"
                                                            title="Wishlist"><span>Add to Wishlist</span></a>
                                                    </div>
                                                </button>
                                            </form>
                                        @endif
                                        <style>
                                            .btn-wishlist-plain {
                                                background: none;
                                                /* Remove background */
                                                border: none;
                                                /* Remove border */
                                                margin: none;
                                            }
                                        </style>

                                    </div><!-- End .details-action-wrapper -->
                                </div><!-- End .product-details-action -->



                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        {{ $product->category->name }}
                                    </div><!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div><!-- End .product-details-footer -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="page-content">
            <div class="container">
                <div class="product-details-tab">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                                role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                                role="tab" aria-controls="product-info-tab" aria-selected="false">Additional
                                information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab"
                                href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab"
                                aria-selected="false">Shipping & Returns</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                                role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews
                                ({{ $product->reviews->count() }})</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                            aria-labelledby="product-desc-link">
                            <div class="product-desc-content">
                                <h3>Product Information</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat
                                    mattis
                                    eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit,
                                    posuere a,
                                    pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet
                                    orci.
                                    Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a
                                    lectus. Donec
                                    consectetuer ligula vulputate sem tristique cursus. </p>
                                <ul>
                                    <li>Nunc nec porttitor turpis. In eu risus enim. In vitae mollis elit. </li>
                                    <li>Vivamus finibus vel mauris ut vehicula.</li>
                                    <li>Nullam a magna porttitor, dictum risus nec, faucibus sapien.</li>
                                </ul>

                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat
                                    mattis
                                    eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit,
                                    posuere a,
                                    pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet
                                    orci.
                                    Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a
                                    lectus. Donec
                                    consectetuer ligula vulputate sem tristique cursus. </p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                            aria-labelledby="product-info-link">
                            <div class="product-desc-content">
                                <h3>Information</h3>
                                <div class="item">
                                    <label class="h6">Weight</label>
                                    <span>1.25 kg</span>
                                </div>
                                <div class="item">
                                    <label class="h6">Dimensions</label>
                                    <span>90 x 60 x 90 cm</span>
                                </div>
                                <div class="item">
                                    <label class="h6">Size</label>
                                    <span>XS, S, M, L, XL</span>
                                </div>
                                <div class="item">
                                    <label class="h6">Color</label>
                                    <span>Black, Orange, White</span>
                                </div>
                                <div class="item">
                                    <label class="h6">Storage</label>
                                    <span>Relaxed fit shirt-style dress with a rugged</span>
                                </div>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                            aria-labelledby="product-shipping-link">
                            <div class="product-desc-content">
                                <h3>Delivery & returns</h3>
                                <p>We deliver to over 100 countries around the world. For full details of the delivery
                                    options we
                                    offer, please view our <a href="#">Delivery information</a><br>
                                    We hope you’ll love every purchase, but if you ever need to return an item you can do so
                                    within
                                    a month of receipt. For full details of how to make a return, please view our <a
                                        href="#">Returns information</a></p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                            aria-labelledby="product-review-link">
                            <div class="reviews">
                                <h4>Customer Reviews ({{ $product->reviews->count() }})</h4>

                                <div class="product-single__reviews-list">
                                    @foreach ($product->reviews as $review)
                                        <div class="review border p-4 rounded mb-4">
                                            <div class="row no-gutters items-start">
                                                <div class="col-auto mr-4">
                                                    <h4><a href="#"
                                                            class="text-blue-600 font-semibold">{{ $review->user->name }}</a>
                                                    </h4>
                                                    @auth
                                                        @if (auth()->id() === $review->user_id)
                                                            <div class="flex gap-2 mt-2">
                                                                <a href="{{ route('reviews.edit', $review->id) }}"
                                                                    class="btn btn-sm btn-outline-primary">
                                                                    Edit
                                                                </a>
                                                                <form action="{{ route('reviews.delete', $review->id) }}"
                                                                    method="POST" onsubmit="return confirm('Are you sure?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-outline-danger">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endauth

                                                    <div id="currentRatingDisplay" class="ratings-container my-1">
                                                        <span class="flex gap-1">
                                                            {{-- These stars will be updated by JS after a click --}}
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <svg class="display-star-icon" width="24"
                                                                    height="24"
                                                                    fill="{{ $i <= old('rating', $review->rating) ? '#facc15' : '#d1d5db' }}"
                                                                    viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 .587l3.668 7.568L24 9.423l-6 5.846 1.417 8.254L12 18.897l-7.417 4.626L6 15.269 0 9.423l8.332-1.268z" />
                                                                </svg>
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <style>
                                                        .display-star-icon {
                                                            width: 20px;
                                                            height: 20px;
                                                        }
                                                    </style>
                                                    <span
                                                        class="review-date text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="col">
                                                    <h4 class="text-lg font-semibold mb-1">
                                                        {{ $review->title ?? 'Good item' }}</h4>
                                                    <div class="review-content mb-2">
                                                        <p>{{ $review->comment }}</p>
                                                    </div>

                                                    @if ($review->image)
                                                        <img src="{{ asset($review->image) }}" alt="Review image"
                                                            class="rounded max-w-xs mb-2">
                                                    @endif

                                                    <div class="review-action d-flex align-items-center gap-3">
                                                        @auth
                                                            @if (auth()->id() !== $review->user_id)
                                                                <form action="{{ route('reviews.react', $review->id) }}"
                                                                    method="POST" class="m-0 p-0">
                                                                    @csrf
                                                                    <input type="hidden" name="reaction" value="helpful">

                                                                    <button type="submit"
                                                                        class="btn btn-link text-decoration-none text-primary p-0 m-0 d-flex align-items-center gap-1">
                                                                        @if ($review->reactedByUser('helpful'))
                                                                            {{-- Filled icon if reacted --}}
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-hand-thumbs-up-fill"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
                                                                            </svg>
                                                                        @else
                                                                            {{-- Outline icon if not reacted --}}
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-hand-thumbs-up"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                                                            </svg>
                                                                        @endif
                                                                        Helpful ({{ $review->helpfulCount() }})
                                                                    </button>
                                                                </form>
                                                                <form action="{{ route('reviews.react', $review->id) }}"
                                                                    method="POST" class="m-0 p-0">
                                                                    @csrf
                                                                    <input type="hidden" name="reaction" value="unhelpful">
                                                                    <button type="submit"
                                                                        class="btn btn-link text-decoration-none text-primary p-0 m-0 d-flex align-items-center gap-1">
                                                                        @if ($review->reactedByUser('unhelpful'))
                                                                            {{-- Filled icon if reacted --}}
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-hand-thumbs-down-fill"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.38 1.38 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51q.205.03.443.051c.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.9 1.9 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2 2 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.2 3.2 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.8 4.8 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591" />
                                                                            </svg>
                                                                        @else
                                                                            {{-- Outline icon if not reacted --}}
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-hand-thumbs-down"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1" />
                                                                            </svg>
                                                                        @endif
                                                                        UnHelpful ({{ $review->unhelpfulCount() }})
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="product-single__review-form">
                                    @auth
                                        @php
                                            $hasReviewed = \App\Models\Review::where('user_id', auth()->id())
                                                ->where('product_id', $product->id)
                                                ->exists();
                                        @endphp

                                        @if (!$hasReviewed)
                                            <form action="{{ route('review.store', $product->id) }}" method="POST"
                                                enctype="multipart/form-data">

                                                @csrf

                                                <div class="select-star-rating">
                                                    <label>Your rating *</label>
                                                    <span class="star-rating">
                                                        <svg class="star-rating__star-icon" width="12" height="12"
                                                            fill="#ccc" viewBox="0 0 12 12"
                                                            xmlns="http://www.w3.org/2000/svg" data-value="1">
                                                            <path
                                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                                        </svg>
                                                        <svg class="star-rating__star-icon" width="12" height="12"
                                                            fill="#ccc" viewBox="0 0 12 12"
                                                            xmlns="http://www.w3.org/2000/svg" data-value="2">
                                                            <path
                                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                                        </svg>
                                                        <svg class="star-rating__star-icon" width="12" height="12"
                                                            fill="#ccc" viewBox="0 0 12 12"
                                                            xmlns="http://www.w3.org/2000/svg" data-value="3">
                                                            <path
                                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                                        </svg>
                                                        <svg class="star-rating__star-icon" width="12" height="12"
                                                            fill="#ccc" viewBox="0 0 12 12"
                                                            xmlns="http://www.w3.org/2000/svg" data-value="4">
                                                            <path
                                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                                        </svg>
                                                        <svg class="star-rating__star-icon" width="12" height="12"
                                                            fill="#ccc" viewBox="0 0 12 12"
                                                            xmlns="http://www.w3.org/2000/svg" data-value="">
                                                            <path
                                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                                        </svg>
                                                    </span>
                                                    <input name="rating" type="hidden" id="form-input-rating"
                                                        value="" />
                                                </div>
                                                <div class="mb-4">
                                                    <textarea name="comment" id="form-input-review" class="form-control form-control_gray" placeholder="Your Review"
                                                        cols="30" rows="8"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="image">Upload Image (optional)</label>
                                                    <input type="file" name="image" class="form-control"
                                                        accept="image/*">
                                                </div>

                                                <div class="form-action">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        @else
                                            <p class="text-muted">You’ve already reviewed this product.</p>
                                        @endif
                                    @else
                                        <p><a href="{{ route('login') }}">Log in</a> to leave a review.</p>
                                    @endauth
                                </div>
                            </div>
                        </div><!-- End .reviews -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div>
        </div>




        <div class="container">
            <h2 class="title text-center mb-4">Related Products</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
            "nav": false,
            "dots": true,
            "margin": 20,
            "loop": false,
            "responsive": {
                "0": {"items":1},
                "480": {"items":2},
                "768": {"items":3},
                "992": {"items":4},
                "1200": {"items":4, "nav": true, "dots": false}
            }
        }'>

                @foreach ($rproducts as $rproduct)
                    <div class="product product-7">
                        <figure class="product-media">
                            <a href="{{ route('shop.product.details', ['product_slug' => $rproduct->slug]) }}">
                                <img src="{{ asset('uploads/products/' . $rproduct->image) }}"
                                    alt="{{ $rproduct->name }}" class="product-image">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable">
                                    <span>add to wishlist</span>
                                </a>
                                <a href="#" class="btn-product-icon btn-quickview" title="Quick view">
                                    <span>Quick view</span>
                                </a>
                                <a href="#" class="btn-product-icon btn-compare" title="Compare">
                                    <span>Compare</span>
                                </a>
                            </div><!-- End .product-action-vertical -->

                            <div class="product-action">
                                <a href="{{ route('cart.add', $rproduct->id) }}" class="btn-product btn-cart">
                                    <span>add to cart</span>
                                </a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#">{{ $rproduct->category->name ?? 'Uncategorized' }}</a>
                            </div><!-- End .product-cat -->

                            <h3 class="product-title">
                                <a href="{{ route('shop.product.details', ['product_slug' => $rproduct->slug]) }}">
                                    {{ $rproduct->name }}
                                </a>
                            </h3><!-- End .product-title -->

                            <div class="product-price">
                                @if ($rproduct->sale_price)
                                    <s>₱{{ $rproduct->regular_price }}</s> ₱{{ $rproduct->sale_price }}
                                @else
                                    ₱{{ $rproduct->regular_price }}
                                @endif
                            </div><!-- End .product-price -->

                            <div class="ratings-container">
                                @php
                                    $reviewCount = $rproduct->reviews->count();
                                    $avg = $reviewCount ? $rproduct->reviews->avg('rating') : 0;
                                    $percent = $reviewCount ? ($avg / 5) * 100 : 0;
                                @endphp

                                @if ($reviewCount > 0)
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: {{ $percent }}%;"></div>
                                    </div>
                                    <span class="ratings-text">
                                        ({{ $reviewCount }} {{ Str::plural('Review', $reviewCount) }})
                                    </span>
                                @else
                                    <span class="ratings-text">No reviews yet</span>
                                @endif
                            </div>
                            <!-- End .rating-container -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                @endforeach

            </div><!-- End .owl-carousel -->
        </div>

    </main>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.querySelector(".product-main-image");
        const image = container.querySelector("img");

        container.addEventListener("mousemove", function(e) {
            const rect = container.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;

            image.style.transformOrigin = `${x}% ${y}%`;
            image.style.transform = "scale(2)"; // zoom level
        });

        container.addEventListener("mouseleave", function() {
            image.style.transformOrigin = "center center";
            image.style.transform = "scale(1)";
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const mainImg = document.getElementById("product-zoom");
        const galleryItems = document.querySelectorAll(".product-gallery-item");

        galleryItems.forEach(item => {
            item.addEventListener("click", function(e) {
                e.preventDefault();

                // Get clicked thumbnail image paths
                const newSrc = this.getAttribute("data-image");
                const newZoom = this.getAttribute("data-zoom-image");

                // Update main image
                mainImg.src = newSrc;
                mainImg.setAttribute("data-zoom-image", newZoom);

                // Remove "active" from others, add to clicked
                galleryItems.forEach(el => el.classList.remove("active"));
                this.classList.add("active");

                // If using ElevateZoom, re-init zoom
                if (typeof $.fn.elevateZoom !== "undefined") {
                    $('.zoomContainer').remove(); // remove old zoom
                    $(mainImg).elevateZoom({
                        zoomType: "lens",
                        lensShape: "round",
                        lensSize: 200
                    });
                }
            });
        });
    });
</script>
