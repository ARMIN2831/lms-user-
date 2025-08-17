<x-layouts.app title="جزئیات دوره">
    <!-- استایل سفارشی -->
    <style>
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .session-card {
            animation: slideIn 0.4s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .session-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .session-card:nth-child(1) { animation-delay: 0.1s; }
        .session-card:nth-child(2) { animation-delay: 0.2s; }
        .session-card:nth-child(3) { animation-delay: 0.3s; }
        .session-card:nth-child(4) { animation-delay: 0.4s; }

        .attendance-status {
            transition: all 0.3s ease;
        }

        .comment-box {
            transition: all 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }

        .comment-box.active {
            max-height: 500px;
        }

        .file-download {
            transition: all 0.3s ease;
        }

        .file-download:hover {
            transform: translateX(-3px);
        }

        .rating-star {
            transition: all 0.2s ease;
        }

        .rating-star:hover {
            transform: scale(1.2);
        }

        .reply-input {
            transition: all 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }

        .reply-input.active {
            max-height: 200px;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-white p-4 md:p-8 font-sans">
        <!-- هدر صفحه -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
            <div class="flex items-center">
                <a href="#" class="mr-4 text-purple-600 hover:text-purple-800 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">جزئیات دوره</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">مشاهده اطلاعات کامل دوره و جلسات</p>
                </div>
            </div>
            <div class="mt-4 md:mt-0">
                <button class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center shadow-sm hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                    عملیات
                </button>
            </div>
        </div>

        <!-- اطلاعات کلی دوره -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 mb-8">
            <div class="flex flex-col md:flex-row">
                <!-- تصویر شاخص دوره -->
                <div class="md:w-1/3 bg-gradient-to-r from-purple-500 to-indigo-600 flex items-center justify-center p-8 relative">
                    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center opacity-20"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                    </svg>
                </div>

                <!-- اطلاعات دوره -->
                <div class="md:w-2/3 p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">تئوری موسیقی پیشرفته</h2>
                            <div class="flex items-center mt-4">
                                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 border-2 border-white shadow-md overflow-hidden">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="استاد علی محمدی" class="w-full h-full object-cover">
                                </div>
                                <div class="mr-3">
                                    <p class="text-sm text-gray-600">مدرس دوره</p>
                                    <p class="font-medium">استاد علی محمدی</p>
                                </div>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-medium shadow-sm">
                            در حال برگزاری
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-sm text-gray-600">تعداد جلسات</p>
                            <p class="font-medium">12 جلسه</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-sm text-gray-600">جلسات باقیمانده</p>
                            <p class="font-medium">4 جلسه</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-sm text-gray-600">میانگین نمرات</p>
                            <p class="font-medium">18.5 از 20</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                            <span>میزان حضور شما</span>
                            <span>۸۳%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-2.5 rounded-full" style="width: 83%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- لیست جلسات -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">جلسات دوره</h2>

            <!-- فیلتر جلسات -->
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6 flex flex-wrap items-center justify-between">
                <div class="flex space-x-3 space-x-reverse mb-3 md:mb-0">
                    <button class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium">همه جلسات</button>
                    <button class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50">حاضر</button>
                    <button class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50">غایب</button>
                </div>
                <div class="relative w-full md:w-auto">
                    <input type="text" placeholder="جستجو در جلسات..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- کارت‌های جلسات -->
            <div class="space-y-4">
                <!-- جلسه 1 -->
                <div class="session-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">جلسه اول: آشنایی با تئوری موسیقی</h3>
                                <div class="flex items-center mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">شنبه ۵ تیر ۱۴۰۲ - ۱۶:۰۰ تا ۱۸:۰۰</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="attendance-status bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-medium ml-3">
                                    حاضر
                                </span>
                                <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-medium">
                                    نمره: ۱۹
                                </span>
                            </div>
                        </div>

                        <!-- اطلاعات حضور و غیاب -->
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 border-2 border-white shadow-md overflow-hidden">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="استاد علی محمدی" class="w-full h-full object-cover">
                                </div>
                                <div class="mr-3">
                                    <p class="text-sm font-medium">حضور و غیاب توسط استاد محمدی</p>
                                    <p class="text-xs text-gray-500">ثبت شده در ۵ تیر ۱۴۰۲ ساعت ۱۸:۲۳</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-sm text-gray-700 mb-2">نظر استاد:</p>
                                <p class="text-sm bg-white p-3 rounded-lg border border-gray-200">هنرجوی عزیز حضور فعال و تمرین‌های خوبی داشتند. نیاز به تمرین بیشتر روی بخش میزان‌ها دارد.</p>
                            </div>

                            <!-- فایل‌های ضمیمه -->
                            <div class="mt-4">
                                <p class="text-sm text-gray-700 mb-2">فایل‌های ضمیمه:</p>
                                <div class="flex flex-wrap gap-2">
                                    <a href="#" class="file-download flex items-center bg-white border border-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                        </svg>
                                        تمرین‌های جلسه اول.pdf
                                    </a>
                                    <a href="#" class="file-download flex items-center bg-white border border-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                        </svg>
                                        فایل صوتی تمرین.mp3
                                    </a>
                                </div>
                            </div>

                            <!-- نظر سنجی -->
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-700 mb-2">نظر سنجی این جلسه:</p>
                                <div class="flex items-center mb-2">
                                    <span class="text-sm text-gray-600 ml-2">امتیاز شما:</span>
                                    <div class="flex">
                                        <svg class="rating-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <svg class="rating-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <svg class="rating-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <svg class="rating-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <svg class="rating-star w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-sm bg-white p-3 rounded-lg border border-gray-200">جلسه بسیار مفیدی بود. استاد توضیحات کامل و واضحی ارائه دادند.</p>
                            </div>

                            <!-- پاسخ به استاد -->
                            <button class="mt-3 text-sm text-purple-600 hover:text-purple-800 font-medium flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                </svg>
                                پاسخ به استاد
                            </button>

                            <div class="reply-input mt-2">
                                <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" rows="3" placeholder="پاسخ خود را بنویسید..."></textarea>
                                <div class="flex justify-end mt-2">
                                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm mr-2">انصراف</button>
                                    <button class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm">ارسال پاسخ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- جلسه 2 -->
                <div class="session-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">جلسه دوم: آشنایی با نت‌ها</h3>
                                <div class="flex items-center mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">شنبه ۱۲ تیر ۱۴۰۲ - ۱۶:۰۰ تا ۱۸:۰۰</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="attendance-status bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full font-medium ml-3">
                                    غیبت موجه
                                </span>
                                <span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full font-medium">
                                    نمره: -
                                </span>
                            </div>
                        </div>

                        <!-- اطلاعات حضور و غیاب -->
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 border-2 border-white shadow-md overflow-hidden">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="استاد علی محمدی" class="w-full h-full object-cover">
                                </div>
                                <div class="mr-3">
                                    <p class="text-sm font-medium">حضور و غیاب توسط استاد محمدی</p>
                                    <p class="text-xs text-gray-500">ثبت شده در ۱۲ تیر ۱۴۰۲ ساعت ۱۸:۱۵</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-sm text-gray-700 mb-2">توضیحات استاد:</p>
                                <p class="text-sm bg-white p-3 rounded-lg border border-gray-200">غیبت هنرجو با اطلاع قبلی و به دلیل بیماری بوده است. فایل‌های جلسه برای ایشان ارسال شد.</p>
                            </div>

                            <!-- فایل‌های ضمیمه -->
                            <div class="mt-4">
                                <p class="text-sm text-gray-700 mb-2">فایل‌های ضمیمه:</p>
                                <div class="flex flex-wrap gap-2">
                                    <a href="#" class="file-download flex items-center bg-white border border-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                        </svg>
                                        تمرین‌های جلسه دوم.pdf
                                    </a>
                                    <a href="#" class="file-download flex items-center bg-white border border-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                        </svg>
                                        فایل صوتی تمرین.mp3
                                    </a>
                                </div>
                            </div>

                            <!-- نظر سنجی -->
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-700 mb-2">نظر سنجی این جلسه:</p>
                                <div class="text-sm text-gray-500">شما در این جلسه حضور نداشتید</div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- جلسه 3 -->
                <div class="session-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">جلسه دوم: آشنایی با نت‌ها</h3>
                                <div class="flex items-center mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">شنبه ۱۲ تیر ۱۴۰۲ - ۱۶:۰۰ تا ۱۸:۰۰</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="attendance-status bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full font-medium ml-3">
                                    غیبت موجه
                                </span>
                                <span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full font-medium">
                                    نمره: -
                                </span>
                            </div>
                        </div>

                        <!-- اطلاعات حضور و غیاب -->
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 border-2 border-white shadow-md overflow-hidden">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="استاد علی محمدی" class="w-full h-full object-cover">
                                </div>
                                <div class="mr-3">
                                    <p class="text-sm font-medium">حضور و غیاب توسط استاد محمدی</p>
                                    <p class="text-xs text-gray-500">ثبت شده در ۱۲ تیر ۱۴۰۲ ساعت ۱۸:۱۵</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-sm text-gray-700 mb-2">توضیحات استاد:</p>
                                <p class="text-sm bg-white p-3 rounded-lg border border-gray-200">غیبت هنرجو با اطلاع قبلی و به دلیل بیماری بوده است. فایل‌های جلسه برای ایشان ارسال شد.</p>
                            </div>

                            <!-- فایل‌های ضمیمه -->
                            <div class="mt-4">
                                <p class="text-sm text-gray-700 mb-2">فایل‌های ضمیمه:</p>
                                <div class="flex flex-wrap gap-2">
                                    <a href="#" class="file-download flex items-center bg-white border border-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                        </svg>
                                        تمرین‌های جلسه دوم.pdf
                                    </a>
                                    <a href="#" class="file-download flex items-center bg-white border border-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                        </svg>
                                        فایل صوتی تمرین.mp3
                                    </a>
                                </div>
                            </div>

                            <!-- نظر سنجی -->
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-700 mb-2">نظر سنجی این جلسه:</p>
                                <div class="text-sm text-gray-500">شما در این جلسه حضور نداشتید</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
