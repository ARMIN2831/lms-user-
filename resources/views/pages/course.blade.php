<x-layouts.app title="دوره‌های من">
    <!-- افزودن فونت ایران سنس -->
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSans.css">

    <!-- استایل سفارشی -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .course-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .course-card:nth-child(1) { animation-delay: 0.1s; }
        .course-card:nth-child(2) { animation-delay: 0.2s; }
        .course-card:nth-child(3) { animation-delay: 0.3s; }

        .progress-bar {
            transition: width 1s ease-in-out;
        }

        .teacher-avatar {
            transition: all 0.3s ease;
        }

        .teacher-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.3);
        }

        .status-badge {
            transition: all 0.3s ease;
        }

        .action-button {
            transition: all 0.3s ease, transform 0.2s ease;
        }

        .action-button:hover {
            transform: translateY(-2px);
        }

        .pagination-button {
            transition: all 0.3s ease;
        }

        .pagination-button:hover {
            transform: scale(1.1);
        }

        .course-thumbnail {
            transition: all 0.5s ease;
        }

        .course-card:hover .course-thumbnail {
            transform: scale(1.05);
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-white p-4 md:p-8 font-sans">
        <!-- هدر صفحه -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">دوره‌های من</h1>
                <p class="text-gray-600 mt-2 text-sm md:text-base">لیست دوره‌های فعال و گذشته شما</p>
            </div>
            <div class="flex space-x-3 space-x-reverse w-full md:w-auto">
                <button class="flex-1 md:flex-none bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>فیلترها</span>
                </button>
                <button class="flex-1 md:flex-none bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <span>مرتب‌سازی</span>
                </button>
            </div>
        </div>

        <!-- کارت‌های دوره -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- دوره 1 -->
            <div class="course-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="relative overflow-hidden">
                    <!-- تصویر شاخص دوره -->
                    <div class="h-48 bg-gradient-to-r from-purple-500 to-indigo-600 flex items-center justify-center course-thumbnail">
                        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center opacity-30"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                    </div>

                    <!-- وضعیت دوره -->
                    <span class="status-badge absolute top-4 left-4 bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                        در حال برگزاری
                    </span>
                </div>

                <div class="p-5">
                    <!-- عنوان و مدرس -->
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 leading-tight">تئوری موسیقی پیشرفته</h2>
                            <div class="flex items-center mt-3">
                                <div class="teacher-avatar w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 border-2 border-white shadow-md overflow-hidden">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="استاد علی محمدی" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm text-gray-600 mr-3">استاد علی محمدی</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </button>
                    </div>

                    <!-- تاریخ آخرین کلاس -->
                    <div class="flex items-center mt-4 text-sm text-gray-600 bg-gray-50 px-3 py-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>آخرین کلاس: <span class="font-medium">۲ مرداد ۱۴۰۲</span></span>
                    </div>

                    <!-- آمار حضور و غیاب -->
                    <div class="mt-5 space-y-4">
                        <div>
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    جلسات شرکت کرده (۸ از ۱۲)
                                </span>
                                <span class="font-medium">۶۷%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="progress-bar bg-gradient-to-r from-green-400 to-green-600 h-2.5 rounded-full" style="width: 67%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    غیبت‌ها (۲ جلسه)
                                </span>
                                <span class="font-medium">۱۷%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="progress-bar bg-gradient-to-r from-red-400 to-red-600 h-2.5 rounded-full" style="width: 17%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- دکمه‌های اقدام -->
                    <div class="mt-6 flex space-x-3 space-x-reverse">
                        <a href="#" class="flex-1 action-button bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white py-3 px-4 rounded-xl text-center font-medium shadow-md hover:shadow-lg">
                            جزئیات دوره
                        </a>
                        <button class="action-button bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 p-3 rounded-xl shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- دوره 2 -->
            <div class="course-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="relative overflow-hidden">
                    <!-- تصویر شاخص دوره -->
                    <div class="h-48 bg-gradient-to-r from-amber-500 to-orange-600 flex items-center justify-center course-thumbnail">
                        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center opacity-30"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                    </div>

                    <!-- وضعیت دوره -->
                    <span class="status-badge absolute top-4 left-4 bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                        تکمیل شده
                    </span>
                </div>

                <div class="p-5">
                    <!-- عنوان و مدرس -->
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 leading-tight">آموزش گیتار کلاسیک</h2>
                            <div class="flex items-center mt-3">
                                <div class="teacher-avatar w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 border-2 border-white shadow-md overflow-hidden">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="استاد مریم احمدی" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm text-gray-600 mr-3">استاد مریم احمدی</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </button>
                    </div>

                    <!-- تاریخ آخرین کلاس -->
                    <div class="flex items-center mt-4 text-sm text-gray-600 bg-gray-50 px-3 py-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>آخرین کلاس: <span class="font-medium">۱۵ تیر ۱۴۰۲</span></span>
                    </div>

                    <!-- آمار حضور و غیاب -->
                    <div class="mt-5 space-y-4">
                        <div>
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    جلسات شرکت کرده (۱۰ از ۱۲)
                                </span>
                                <span class="font-medium">۸۳%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="progress-bar bg-gradient-to-r from-green-400 to-green-600 h-2.5 rounded-full" style="width: 83%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    غیبت‌ها (۲ جلسه)
                                </span>
                                <span class="font-medium">۱۷%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="progress-bar bg-gradient-to-r from-red-400 to-red-600 h-2.5 rounded-full" style="width: 17%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- دکمه‌های اقدام -->
                    <div class="mt-6 flex space-x-3 space-x-reverse">
                        <a href="#" class="flex-1 action-button bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white py-3 px-4 rounded-xl text-center font-medium shadow-md hover:shadow-lg">
                            جزئیات دوره
                        </a>
                        <button class="action-button bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 p-3 rounded-xl shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- دوره 3 -->
            <div class="course-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="relative overflow-hidden">
                    <!-- تصویر شاخص دوره -->
                    <div class="h-48 bg-gradient-to-r from-emerald-500 to-teal-600 flex items-center justify-center course-thumbnail">
                        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center opacity-30"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                    </div>

                    <!-- وضعیت دوره -->
                    <span class="status-badge absolute top-4 left-4 bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                        در حال ثبت‌نام
                    </span>
                </div>

                <div class="p-5">
                    <!-- عنوان و مدرس -->
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 leading-tight">آواز سنتی ایرانی</h2>
                            <div class="flex items-center mt-3">
                                <div class="teacher-avatar w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 border-2 border-white shadow-md overflow-hidden">
                                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="استاد رضا نوروزی" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm text-gray-600 mr-3">استاد رضا نوروزی</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </button>
                    </div>

                    <!-- تاریخ آخرین کلاس -->
                    <div class="flex items-center mt-4 text-sm text-gray-600 bg-gray-50 px-3 py-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>شروع دوره: <span class="font-medium">۲۰ مرداد ۱۴۰۲</span></span>
                    </div>

                    <!-- آمار حضور و غیاب -->
                    <div class="mt-5 space-y-4">
                        <div>
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    جلسات شرکت کرده (۰ از ۱۲)
                                </span>
                                <span class="font-medium">۰%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="progress-bar bg-gradient-to-r from-green-400 to-green-600 h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    غیبت‌ها (۰ جلسه)
                                </span>
                                <span class="font-medium">۰%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="progress-bar bg-gradient-to-r from-red-400 to-red-600 h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- دکمه‌های اقدام -->
                    <div class="mt-6 flex space-x-3 space-x-reverse">
                        <a href="#" class="flex-1 action-button bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white py-3 px-4 rounded-xl text-center font-medium shadow-md hover:shadow-lg">
                            جزئیات دوره
                        </a>
                        <button class="action-button bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 p-3 rounded-xl shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- صفحه‌بندی -->
        <div class="mt-10 flex items-center justify-center space-x-3 space-x-reverse">
            <button class="pagination-button w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="pagination-button w-10 h-10 flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl shadow-md">1</button>
            <button class="pagination-button w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 shadow-sm hover:shadow-md">2</button>
            <button class="pagination-button w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 shadow-sm hover:shadow-md">3</button>
            <button class="pagination-button w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</x-layouts.app>
