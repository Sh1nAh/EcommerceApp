
<x-layout>

    <!-- blog section starts -->
        <section class="blog" id="blog">
            <!-- <div class="blog-heading">
                <span>my recent posts</span>
                <h3>blog</h3>
            </div> -->
            <h1 class="heading">blogs</h1>
            <div class="blog-container">
                <div class="post-slider">
                    <h1 class="slider-title">trending posts</h1>
                    <i class="fas fa-chevron-left prev"></i>
                    <i class="fas fa-chevron-right next"></i>
                    <div class="post-wrapper">
                        <div class="blog-box">
                            <div class="blog-img">
                                <img src="images/blog/ios-17.6.webp" alt="">
                            </div>
                            <div class="blog-text">
                                <span>30 July 2024 | iOS 17.6</span>
                                <a href="#" class="blog-title">iOS 17.6 and iPadOS 17.6 are now available, here’s what’s new</a>
                                <p>
                                    Apple has released the latest versions of its iPhone and iPad software: iOS 17.6 and iPadOS 17.6 are now available for download on your device. Here’s what’s new in these latest OS updates.
                                    iOS 17.6 available with new Catch Up feature, performance improvements
                                    You can install iOS and iPadOS 17.6 now by visiting Settings ⇾ General ⇾ Software Update. Today’s update is compatible with all devices that can run prior versions of iOS and iPadOS.
                                    This new update for iOS and iPadOS is focused largely on bug fixes and performance improvements. All of the key iOS and iPadOS 17 features that Apple announced last year at WWDC have already made their way into prior updates.
                                </p>
                                <a href="#" class="read-more">read more</a>
                            </div>
                        </div>

                        <div class="blog-box">
                            <div class="blog-img">
                                <img src="images/blog/ios-17.6.webp" alt="">
                            </div>
                            <div class="blog-text">
                                <span>30 July 2024 | iOS 17.6</span>
                                <a href="#" class="blog-title">iOS 17.6 and iPadOS 17.6 are now available, here’s what’s new</a>
                                <p>
                                    Apple has released the latest versions of its iPhone and iPad software: iOS 17.6 and iPadOS 17.6 are now available for download on your device. Here’s what’s new in these latest OS updates.
                                    iOS 17.6 available with new Catch Up feature, performance improvements
                                    You can install iOS and iPadOS 17.6 now by visiting Settings ⇾ General ⇾ Software Update. Today’s update is compatible with all devices that can run prior versions of iOS and iPadOS.
                                    This new update for iOS and iPadOS is focused largely on bug fixes and performance improvements. All of the key iOS and iPadOS 17 features that Apple announced last year at WWDC have already made their way into prior updates.
                                </p>
                                <a href="#" class="read-more">read more</a>
                            </div>
                        </div>

                        <div class="blog-box">
                            <div class="blog-img">
                                <img src="images/blog/ios-17.6.webp" alt="">
                            </div>
                            <div class="blog-text">
                                <span>30 July 2024 | iOS 17.6</span>
                                <a href="#" class="blog-title">iOS 17.6 and iPadOS 17.6 are now available, here’s what’s new</a>
                                <p>
                                    Apple has released the latest versions of its iPhone and iPad software: iOS 17.6 and iPadOS 17.6 are now available for download on your device. Here’s what’s new in these latest OS updates.
                                    iOS 17.6 available with new Catch Up feature, performance improvements
                                    You can install iOS and iPadOS 17.6 now by visiting Settings ⇾ General ⇾ Software Update. Today’s update is compatible with all devices that can run prior versions of iOS and iPadOS.
                                    This new update for iOS and iPadOS is focused largely on bug fixes and performance improvements. All of the key iOS and iPadOS 17 features that Apple announced last year at WWDC have already made their way into prior updates.
                                </p>
                                <a href="#" class="read-more">read more</a>
                            </div>
                        </div>

                        <div class="blog-box">
                            <div class="blog-img">
                                <img src="images/blog/ios-17.6.webp" alt="">
                            </div>
                            <div class="blog-text">
                                <span>30 July 2024 | iOS 17.6</span>
                                <a href="#" class="blog-title">iOS 17.6 and iPadOS 17.6 are now available, here’s what’s new</a>
                                <p>
                                    Apple has released the latest versions of its iPhone and iPad software: iOS 17.6 and iPadOS 17.6 are now available for download on your device. Here’s what’s new in these latest OS updates.
                                    iOS 17.6 available with new Catch Up feature, performance improvements
                                    You can install iOS and iPadOS 17.6 now by visiting Settings ⇾ General ⇾ Software Update. Today’s update is compatible with all devices that can run prior versions of iOS and iPadOS.
                                    This new update for iOS and iPadOS is focused largely on bug fixes and performance improvements. All of the key iOS and iPadOS 17 features that Apple announced last year at WWDC have already made their way into prior updates.
                                </p>
                                <a href="#" class="read-more">read more</a>
                            </div>
                        </div>

                        <div class="blog-box">
                            <div class="blog-img">
                                <img src="images/blog/ios-17.6.webp" alt="">
                            </div>
                            <div class="blog-text">
                                <span>30 July 2024 | iOS 17.6</span>
                                <a href="#" class="blog-title">iOS 17.6 and iPadOS 17.6 are now available, here’s what’s new</a>
                                <p>
                                    Apple has released the latest versions of its iPhone and iPad software: iOS 17.6 and iPadOS 17.6 are now available for download on your device. Here’s what’s new in these latest OS updates.
                                    iOS 17.6 available with new Catch Up feature, performance improvements
                                    You can install iOS and iPadOS 17.6 now by visiting Settings ⇾ General ⇾ Software Update. Today’s update is compatible with all devices that can run prior versions of iOS and iPadOS.
                                    This new update for iOS and iPadOS is focused largely on bug fixes and performance improvements. All of the key iOS and iPadOS 17 features that Apple announced last year at WWDC have already made their way into prior updates.
                                </p>
                                <a href="#" class="read-more">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="all-blogs">
                <h1>recent posts</h1>
                @foreach ($blogs as $blog)
                    <x-blog-card :blog="$blog"></x-blog-card>
                @endforeach
                {{ $blogs->links() }}
         </section>
        <!-- blog section ends -->

</x-layout>