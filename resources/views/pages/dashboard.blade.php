<x-layouts.app title="داشبرد">
    <style>
        .accordion-content {
            transition: max-height 0.3s ease-out, opacity 0.2s ease;
        }

        .slide {
            scroll-snap-type: x mandatory;
        }

        .slide-item {
            scroll-snap-align: start;
            flex: 0 0 100%;
        }

        @media (min-width: 768px) {
            .slide-item {
                flex: 0 0 50%;
            }
        }

        .dashboard-card {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .dashboard-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 0.5rem;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .skeleton-circle {
            border-radius: 50%;
        }

        .skeleton-text {
            height: 1rem;
        }

        .skeleton-header {
            height: 1.75rem;
        }

        .skeleton-button {
            height: 2.5rem;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-white p-4 md:p-6"
         x-data="dashboardPage()"
         x-init="init()">
        <!-- اسلایدر اعلانات -->
        <div class="mb-6 relative">
            <template x-if="loading.cards">
                <!-- اسکلتون اسلایدر اعلانات -->
                <div class="flex overflow-x-auto slide space-x-4 space-x-reverse p-1 hide-scrollbar">
                    <div class="slide-item">
                        <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-xl p-4 border border-purple-100 shadow-xs">
                            <div class="flex items-start space-x-3 space-x-reverse">
                                <div class="skeleton skeleton-circle w-9 h-9"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="skeleton skeleton-text w-3/4"></div>
                                    <div class="skeleton skeleton-text w-1/2"></div>
                                    <div class="skeleton skeleton-text w-1/3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="!loading.cards && cardsData && cardsData.news && cardsData.news.length > 0">
                <!-- محتوای واقعی اسلایدر اعلانات -->
                <div x-data="{ currentIndex: 0 }">
                    <div class="flex overflow-x-auto slide space-x-4 space-x-reverse p-1 hide-scrollbar"
                         @scroll.debounce="currentIndex = Math.round($event.target.scrollLeft / $event.target.offsetWidth)">
                        <template x-for="(news, index) in cardsData.news" :key="index">
                            <div class="slide-item">
                                <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-xl p-4 border border-purple-100 shadow-xs">
                                    <div class="flex items-start space-x-3 space-x-reverse">
                                        <div class="bg-purple-100 text-purple-600 p-2 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-800 mb-1" x-text="news.title"></h3>
                                            <p class="text-sm text-gray-600" x-text="formatDate(news.date)"></p>
                                            <button class="mt-2 text-xs bg-white border border-purple-200 text-purple-600 px-3 py-1 rounded-full hover:bg-purple-50 transition">جزئیات بیشتر</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="flex justify-center space-x-2 space-x-reverse mt-3">
                        <template x-for="(news, index) in cardsData.news" :key="index">
                            <button class="w-2 h-2 rounded-full transition"
                                    :class="currentIndex === index ? 'bg-purple-500' : 'bg-purple-300'"
                                    @click="document.querySelector('.slide').scrollTo({ left: index * document.querySelector('.slide').offsetWidth, behavior: 'smooth' })">
                            </button>
                        </template>
                    </div>
                </div>
            </template>

            <template x-if="!loading.cards && (!cardsData.news || cardsData.news.length === 0)">
                <div class="text-center py-4 text-gray-500">
                    هیچ اعلانی برای نمایش وجود ندارد
                </div>
            </template>
        </div>

        <!-- کارت‌های اصلی دشبورد -->
        <div class="flex justify-between mb-4 lg:px-4">
            <!-- کارت دوره‌ها -->
            <a href="{{ route('course') }}" class="relative flex flex-col items-center justify-center h-full cursor-pointer">
                <div class="relative mb-4">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center shadow-md">
                        <i class="fas fa-book-open text-2xl text-purple-600"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-sm font-bold" x-text="cardsData?.courseCount || '0'"></span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-gray-800">دوره‌ها</h3>
            </a>

            <!-- کارت آزمون‌ها -->
            <a class="relative flex flex-col items-center justify-center h-full cursor-pointer">
                <div class="relative mb-4">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center shadow-md">
                        <i class="fas fa-clipboard-list text-2xl text-blue-600"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-sm font-bold">۰</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-gray-800">آزمون‌ها</h3>
            </a>

            <!-- کارت گواهینامه‌ها -->
            <a class="relative flex flex-col items-center justify-center h-full cursor-pointer">
                <div class="relative mb-4">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center shadow-md">
                        <i class="fas fa-award text-2xl text-green-600"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-sm font-bold">۰</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-gray-800">گواهینامه‌ها</h3>
            </a>

            <!-- کارت پرداخت -->
            <a href="{{ route('payments') }}" class="relative flex flex-col items-center justify-center h-full cursor-pointer">
                <div class="relative mb-4">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center shadow-md">
                        <i class="fas fa-credit-card text-2xl text-red-600"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-sm font-bold" x-text="cardsData?.paymentCount || '0'"></span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-gray-800">پرداخت‌ها</h3>
            </a>
        </div>


        <!-- بخش اصلی -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <!-- ستون سمت چپ -->
            <div class="lg:col-span-2 space-y-5">
                <!-- نمودار تحلیلی -->
                <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                        <h3 class="text-lg font-semibold text-gray-800">نمودار پیشرفت هفتگی</h3>
                        <div class="flex items-center space-x-2 space-x-reverse">
                            <button class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full transition">هفتگی</button>
                            <button class="text-xs bg-purple-100 text-purple-800 hover:bg-purple-200 px-3 py-1 rounded-full transition">ماهانه</button>
                            <button class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full transition">سالانه</button>
                        </div>
                    </div>
                    <div class="h-60">
                        <!-- نمودار خطی دمو -->
                        <div class="w-full h-full flex items-end justify-between px-2">
                            <div class="flex flex-col items-center h-full justify-end">
                                <div class="bg-purple-400 w-4 rounded-t-sm" style="height: 30%"></div>
                                <span class="text-xs text-gray-500 mt-1">ش</span>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <div class="bg-purple-400 w-4 rounded-t-sm" style="height: 50%"></div>
                                <span class="text-xs text-gray-500 mt-1">ی</span>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <div class="bg-purple-400 w-4 rounded-t-sm" style="height: 70%"></div>
                                <span class="text-xs text-gray-500 mt-1">د</span>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <div class="bg-purple-400 w-4 rounded-t-sm" style="height: 90%"></div>
                                <span class="text-xs text-gray-500 mt-1">س</span>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <div class="bg-purple-500 w-4 rounded-t-sm" style="height: 60%"></div>
                                <span class="text-xs text-gray-500 mt-1">چ</span>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <div class="bg-purple-500 w-4 rounded-t-sm" style="height: 40%"></div>
                                <span class="text-xs text-gray-500 mt-1">پ</span>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <div class="bg-purple-500 w-4 rounded-t-sm" style="height: 80%"></div>
                                <span class="text-xs text-gray-500 mt-1">ج</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- آخرین کلاس -->
                <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
                    <template x-if="loading.attends">
                        <!-- اسکلتون آخرین کلاس -->
                        <div class="space-y-4">
                            <div class="skeleton skeleton-header w-1/4"></div>
                            <div class="flex flex-col md:flex-row items-start gap-4">
                                <div class="w-full md:w-1/3 flex justify-center">
                                    <div class="skeleton w-full max-w-xs h-40 rounded-lg"></div>
                                </div>
                                <div class="w-full md:w-2/3 space-y-3">
                                    <div class="skeleton skeleton-text w-3/4"></div>
                                    <div class="skeleton skeleton-text w-1/2"></div>
                                    <div class="skeleton skeleton-text w-1/4"></div>
                                    <div class="skeleton skeleton-text w-full h-20"></div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="!loading.attends && attendsData && attendsData.last_past_attend">
                        <!-- محتوای واقعی آخرین کلاس -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">آخرین کلاس شما</h3>
                            <div class="flex flex-col md:flex-row items-start gap-4">
                                <div class="w-full md:w-1/3 flex justify-center">
                                    <div class="aspect-w-16 aspect-h-9 w-full max-w-xs bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg overflow-hidden flex items-center justify-center text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full md:w-2/3 space-y-3">
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        <h4 class="font-medium text-gray-900 text-sm sm:text-base"
                                            x-text="'کلاس دوره ' + attendsData.last_past_attend.course.title.coTitle"></h4>
                                        <span :class="getStatusClass(attendsData.last_past_attend.status.sColor)"
                                              class="text-xs px-2 py-1 rounded-full whitespace-nowrap"
                                              x-text="attendsData.last_past_attend.status.ststitle"></span>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 text-xs sm:text-sm">
                                        <span class="text-gray-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span x-text="attendsData.last_past_attend.course.teacher.name + ' ' + (attendsData.last_past_attend.course.teacher.family || 'استاد')"></span>
                                        </span>
                                        <span class="text-gray-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span x-text="formatDate(attendsData.last_past_attend.date)"></span>
                                        </span>
                                        <span class="text-gray-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span x-text="attendsData.last_past_attend.time.substring(0, 5) + ' - ' + (attendsData.last_past_attend.duration || 30) + ' دقیقه'"></span>
                                        </span>
                                    </div>

                                    <template x-if="attendsData.last_past_attend.grade">
                                        <div class="flex items-center">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <span class="font-bold text-gray-800 text-sm sm:text-base mr-1"
                                                      x-text="attendsData.last_past_attend.grade"></span>
                                            </div>
                                            <span class="text-gray-500 text-xs mr-1">(از ۵)</span>
                                        </div>
                                    </template>

                                    <div :class="attendsData.last_past_attend.comment ? 'bg-purple-50 border border-purple-100' : 'bg-gray-50 border border-gray-100'"
                                         class="rounded-lg p-3">
                                        <p class="text-gray-800 font-medium mb-1 text-sm sm:text-base">
                                            نظر استاد:
                                        </p>
                                        <p class="text-gray-600 text-xs sm:text-sm leading-relaxed"
                                           x-text="attendsData.last_past_attend.comment || 'هنوز نظری ثبت نشده است'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="!loading.attends && (!attendsData || !attendsData.last_past_attend)">
                        <div class="text-center py-8 text-gray-500">
                            هیچ کلاس گذشته‌ای برای نمایش وجود ندارد
                        </div>
                    </template>
                </div>
            </div>

            <!-- ستون سمت راست -->
            <div class="space-y-5">
                <!-- کلاس‌های رزرو شده -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <template x-if="loading.attends">
                        <!-- اسکلتون کلاس‌های رزرو شده -->
                        <div class="p-4 space-y-4">
                            <div class="skeleton skeleton-header w-1/4"></div>
                            <div class="skeleton skeleton-text w-32 h-8"></div>
                            <div class="space-y-3">
                                <template x-for="i in 2" :key="i">
                                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg border border-blue-100">
                                        <div class="flex items-center space-x-3 space-x-reverse min-w-0">
                                            <div class="skeleton skeleton-circle w-8 h-8"></div>
                                            <div class="min-w-0 space-y-2">
                                                <div class="skeleton skeleton-text w-32"></div>
                                                <div class="skeleton skeleton-text w-24"></div>
                                            </div>
                                        </div>
                                        <div class="skeleton skeleton-circle w-4 h-4"></div>
                                    </div>
                                </template>
                            </div>
                            <div class="skeleton skeleton-button w-full"></div>
                        </div>
                    </template>

                    <template x-if="!loading.attends && attendsData && attendsData.upcoming_attends && attendsData.upcoming_attends.length > 0">
                        <!-- محتوای واقعی کلاس‌های رزرو شده -->
                        <div x-data="{ open: true }">
                            <button @click="open = !open" class="w-full flex items-center justify-between p-4 pb-0 focus:outline-none">
                                <div class="flex items-center">
                                    <h3 class="text-lg font-semibold text-gray-800">کلاس‌های بعدی</h3>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded-full mr-2"
                                          x-text="attendsData.upcoming_attends.length"></span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-200"
                                     :class="{ 'transform rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div class="px-4 pb-2">
                                <button class="mt-2 text-xs bg-white border border-red-200 text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-full transition flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    درخواست کنسلی
                                </button>
                            </div>

                            <div x-show="open" class="accordion-content px-4 pb-4">
                                <div class="space-y-3 max-h-64 overflow-y-auto">
                                    <template x-for="attend in attendsData.upcoming_attends" :key="attend.id">
                                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg border border-blue-100">
                                            <a :href="'/courseDetail/' + attend.students_courses_id" class="flex items-center space-x-3 space-x-reverse min-w-0">
                                                <div class="bg-blue-100 text-blue-600 p-1.5 rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                    </svg>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="font-medium text-gray-800 text-sm sm:text-base truncate"
                                                       x-text="attend.course.title.coTitle"></p>
                                                    <p class="text-xs text-gray-600 truncate"
                                                       x-text="formatDate(attend.date) + ' - ' + attend.time.substring(0, 5)"></p>
                                                </div>
                                            </a>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="!loading.attends && (!attendsData.upcoming_attends || attendsData.upcoming_attends.length === 0)">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">کلاس‌های بعدی</h3>
                            <div class="text-gray-600 text-center py-4">
                                هیچ کلاس آینده‌ای برای نمایش وجود ندارد
                            </div>
                        </div>
                    </template>
                </div>

                <!-- پیام‌های جدید -->
                <template x-if="userData && userData.user_type_id === 2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <template x-if="loading.attends">
                            <!-- اسکلتون پیام‌های جدید -->
                            <div class="p-4 space-y-4">
                                <div class="skeleton skeleton-header w-1/4"></div>
                                <div class="space-y-3">
                                    <template x-for="i in 2" :key="i">
                                        <div class="flex items-start space-x-3 space-x-reverse p-2">
                                            <div class="skeleton skeleton-circle w-8 h-8"></div>
                                            <div class="flex-1 space-y-2">
                                                <div class="skeleton skeleton-text w-3/4"></div>
                                                <div class="skeleton skeleton-text w-1/2"></div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="skeleton skeleton-button w-full"></div>
                            </div>
                        </template>

                        <template x-if="!loading.attends && attendsData && attendsData.comments && attendsData.comments.length > 0">
                            <!-- محتوای واقعی پیام‌های جدید -->
                            <div x-data="{ open: true }">
                                <button @click="open = !open" class="w-full flex items-center justify-between p-4 focus:outline-none">
                                    <div class="flex items-center">
                                        <h3 class="text-lg font-semibold text-gray-800">پیام‌های جدید</h3>
                                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-full mr-2"
                                              x-text="attendsData.comments.length"></span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-200"
                                         :class="{ 'transform rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="open" class="accordion-content px-4 pb-4">
                                    <div class="space-y-3">
                                        <template x-for="comment in attendsData.comments" :key="comment.id">
                                            <a :href="'/courseDetail/' + comment.students_courses_id"
                                               class="flex items-start space-x-3 space-x-reverse p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                                <div class="bg-purple-100 text-purple-600 p-1.5 rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <p class="font-medium text-gray-800 text-sm sm:text-base truncate"
                                                           x-text="comment.teacher_name || 'استاد'"></p>
                                                        <span class="text-2xs text-gray-400 whitespace-nowrap"
                                                              x-text="formatDate(comment.date)"></span>
                                                    </div>
                                                    <p class="text-gray-600 text-xs sm:text-sm truncate"
                                                       x-text="(comment.comment ? comment.comment.substring(0, 50) + '...' : 'نظر جدید')"></p>
                                                </div>
                                            </a>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="!loading.attends && (!attendsData.comments || attendsData.comments.length === 0)">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">پیام‌های جدید</h3>
                                <div class="text-gray-600 text-center py-4">
                                    هیچ پیام جدیدی برای نمایش وجود ندارد
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <script>
        function dashboardPage() {
            return {
                loading: {
                    user: true,
                    cards: true,
                    attends: true
                },
                userData: null,
                cardsData: null,
                attendsData: null,

                async init() {
                    await waitForCheckToken();
                    await Promise.all([
                        this.fetchUserData(),
                        this.fetchCardsData(),
                        this.fetchAttendsData()
                    ]);
                },

                async fetchUserData() {
                    try {
                        const response = await makeRequest('GET', 'fa', '{{ route('getUser') }}');
                        if (response.user) {
                            const user = response.user;
                            const student = user.user_type_id === 1 ? user.teacher : user.student;

                            if (student) {
                                this.userData = {
                                    name: student.name + ' ' + student.family,
                                    level: student.madrak || 'سطح متوسط',
                                    avatar: student.image ? (student.image.startsWith('http') ? student.image : window.location.origin + '/' + student.image) : '/images/default-avatar.jpg',
                                    user_type_id: user.user_type_id
                                };
                            }
                        }
                    } catch (error) {
                        showToastAlert(error, 'error', 3000);
                    } finally {
                        this.loading.user = false;
                    }
                },

                async fetchCardsData() {
                    try {
                        const response = await makeRequest('GET', 'fa', '{{ route('getCardsData') }}');
                        if (response.data) {
                            this.cardsData = response.data;
                        }
                    } catch (error) {
                        showToastAlert(error, 'error', 3000);
                    } finally {
                        this.loading.cards = false;
                    }
                },

                async fetchAttendsData() {
                    try {
                        const response = await makeRequest('GET', 'fa', '{{ route('getAttends') }}');
                        if (response.data) {
                            this.attendsData = response.data;
                        }
                    } catch (error) {
                        showToastAlert(error, 'error', 3000);
                    } finally {
                        this.loading.attends = false;
                    }
                },

                getPaymentText(paymentCount) {
                    if (paymentCount < 0) {
                        return Math.abs(paymentCount) + ' پرداخت معوق دارید';
                    } else if (paymentCount > 0) {
                        return paymentCount + ' پرداخت پیش‌رو دارید';
                    } else {
                        return 'هیچ پرداخت معوقی ندارید';
                    }
                },

                getPaymentAlertClass(paymentCount) {
                    if (paymentCount < 0) {
                        return 'bg-red-500';
                    } else if (paymentCount > 0) {
                        return 'bg-green-500';
                    } else {
                        return 'bg-blue-500';
                    }
                },

                getPaymentAlertText(paymentCount) {
                    if (paymentCount < 0) {
                        return Math.abs(paymentCount) + ' اخطار';
                    } else if (paymentCount > 0) {
                        return 'پیش‌پرداخت';
                    } else {
                        return 'به روز';
                    }
                },

                getStatusClass(statusColor) {
                    const colorMap = {
                        'default': 'bg-gray-100 text-gray-800 border border-gray-200',
                        'info': 'bg-blue-100 text-blue-800 border border-blue-200',
                        'success': 'bg-green-100 text-green-800 border border-green-200',
                        'danger': 'bg-red-100 text-red-800 border border-red-200',
                        'warning': 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                        'primary': 'bg-purple-100 text-purple-800 border border-purple-200',
                        'secondary': 'bg-indigo-100 text-indigo-800 border border-indigo-200'
                    };

                    const cleanColor = statusColor.replace('btn-', '');
                    return colorMap[cleanColor] || colorMap.default;
                },

                formatDate(timestamp) {
                    const date = new Date(timestamp * 1000);
                    return date.toLocaleDateString('fa-IR');
                }
            };
        }
    </script>
</x-layouts.app>
