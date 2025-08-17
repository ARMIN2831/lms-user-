<x-layouts.app title="جلسات دوره">
    <!-- افزودن فونت ایران سنس -->
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSans.css">

    <!-- استایل سفارشی -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .session-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(10px);
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

        .course-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.5s ease;
        }

        .attendance-present {
            background-color: #ecfdf5;
            border-color: #10b981;
            color: #10b981;
        }

        .attendance-absent-excused {
            background-color: #fef2f2;
            border-color: #ef4444;
            color: #ef4444;
        }

        .attendance-absent-unexcused {
            background-color: #fff7ed;
            border-color: #f97316;
            color: #f97316;
        }

        .tab-item {
            transition: all 0.3s ease;
        }

        .tab-item:hover {
            transform: translateY(-2px);
        }

        .tab-item.active {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .comment-box {
            transition: all 0.3s ease;
        }

        .comment-box:hover {
            transform: scale(1.02);
        }

        .attachment-card {
            transition: all 0.3s ease;
        }

        .attachment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .rating-star {
            transition: all 0.2s ease;
        }

        .rating-star:hover {
            transform: scale(1.2);
        }

        .teacher-response {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .floating-action-btn {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(124, 58, 237, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(124, 58, 237, 0); }
            100% { box-shadow: 0 0 0 0 rgba(124, 58, 237, 0); }
        }
    </style>

    <div class="min-h-screen bg-gray-50 font-sans">
        <!-- هدر دوره -->
        <div class="course-header text-white pb-12 pt-8 px-4 md:px-8 lg:px-12">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold">تئوری موسیقی پیشرفته</h1>
                            <p class="mt-2 opacity-90">دوره تخصصی برای هنرجویان سطح پیشرفته</p>
                            <div class="flex items-center mt-4">
                                <div class="w-8 h-8 rounded-full bg-white/20 border-2 border-white overflow-hidden">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="استاد علی محمدی" class="w-full h-full object-cover">
                                </div>
                                <span class="mr-2 text-sm">استاد علی محمدی</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 text-center">
                            <p class="text-sm opacity-80">وضعیت دوره</p>
                            <p class="font-bold mt-1">در حال برگزاری</p>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <button class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg px-4 py-2 text-sm transition-all duration-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                یادداشت
                            </button>
                            <button class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg px-4 py-2 text-sm transition-all duration-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                اطلاعیه‌ها
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- تب‌های صفحه -->
        <div class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 -mt-6">
            <div class="flex overflow-x-auto pb-2 scrollbar-hide">
                <div class="flex space-x-3 space-x-reverse">
                    <a href="#" class="tab-item bg-white rounded-xl px-6 py-3 font-medium text-gray-700 shadow-sm hover:shadow-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        محتوای دوره
                    </a>
                    <a href="#" class="tab-item active bg-purple-600 text-white rounded-xl px-6 py-3 font-medium shadow-md hover:shadow-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        جلسات
                    </a>
                    <a href="#" class="tab-item bg-white rounded-xl px-6 py-3 font-medium text-gray-700 shadow-sm hover:shadow-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        نمرات
                    </a>
                    <a href="#" class="tab-item bg-white rounded-xl px-6 py-3 font-medium text-gray-700 shadow-sm hover:shadow-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        نظرسنجی
                    </a>
                </div>
            </div>
        </div>

        <!-- محتوای اصلی -->
        <div class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- لیست جلسات -->
                <div class="lg:col-span-2 space-y-5">
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-800">لیست جلسات دوره</h2>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>زمان باقیمانده تا جلسه بعدی: <span class="font-medium text-gray-700">۲ روز و ۴ ساعت</span></span>
                            </div>
                        </div>

                        <!-- کارت جلسات -->
                        <div class="space-y-4">
                            <!-- جلسه 1 -->
                            <div class="session-card bg-white border border-gray-200 rounded-xl p-5 hover:border-purple-200 hover:shadow-md">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-purple-100 text-purple-800 rounded-lg p-3 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">جلسه اول: آشنایی با تئوری پایه</h3>
                                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>سه‌شنبه ۵ مرداد ۱۴۰۲ - ساعت ۱۶:۰۰ تا ۱۸:۰۰</span>
                                            </div>
                                            <div class="mt-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border attendance-present">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    حاضر
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center self-start md:self-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        مشاهده جزئیات
                                    </button>
                                </div>
                            </div>

                            <!-- جلسه 2 -->
                            <div class="session-card bg-white border border-gray-200 rounded-xl p-5 hover:border-purple-200 hover:shadow-md">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-purple-100 text-purple-800 rounded-lg p-3 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">جلسه دوم: گام‌ها و فواصل</h3>
                                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>سه‌شنبه ۱۲ مرداد ۱۴۰۲ - ساعت ۱۶:۰۰ تا ۱۸:۰۰</span>
                                            </div>
                                            <div class="mt-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border attendance-absent-excused">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    غیبت موجه
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center self-start md:self-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        مشاهده جزئیات
                                    </button>
                                </div>
                            </div>

                            <!-- جلسه 3 -->
                            <div class="session-card bg-white border border-gray-200 rounded-xl p-5 hover:border-purple-200 hover:shadow-md">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-purple-100 text-purple-800 rounded-lg p-3 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">جلسه سوم: آکوردها و هارمونی</h3>
                                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>سه‌شنبه ۱۹ مرداد ۱۴۰۲ - ساعت ۱۶:۰۰ تا ۱۸:۰۰</span>
                                            </div>
                                            <div class="mt-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border attendance-present">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    حاضر
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center self-start md:self-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        مشاهده جزئیات
                                    </button>
                                </div>
                            </div>

                            <!-- جلسه 4 (آینده) -->
                            <div class="session-card bg-white border border-gray-200 rounded-xl p-5 hover:border-purple-200 hover:shadow-md opacity-80">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-gray-100 text-gray-800 rounded-lg p-3 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">جلسه چهارم: ریتم و متر</h3>
                                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>سه‌شنبه ۲۶ مرداد ۱۴۰۲ - ساعت ۱۶:۰۰ تا ۱۸:۰۰</span>
                                            </div>
                                            <div class="mt-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    برنامه‌ریزی شده
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="bg-gray-100 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center self-start md:self-center cursor-not-allowed" disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        قفل شده
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- جزئیات جلسه انتخابی -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-800">جزئیات جلسه سوم</h2>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="font-medium text-gray-700">حاضر</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- اطلاعات اصلی جلسه -->
                            <div class="bg-gray-50 rounded-xl p-5">
                                <h3 class="font-medium text-gray-800 mb-4">اطلاعات جلسه</h3>
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">تاریخ برگزاری</p>
                                            <p class="font-medium text-gray-800">سه‌شنبه ۱۹ مرداد ۱۴۰۲</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">ساعت برگزاری</p>
                                            <p class="font-medium text-gray-800">۱۶:۰۰ تا ۱۸:۰۰</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">مدرس</p>
                                            <div class="flex items-center mt-1">
                                                <div class="w-8 h-8 rounded-full bg-purple-100 border-2 border-white overflow-hidden">
                                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="استاد علی محمدی" class="w-full h-full object-cover">
                                                </div>
                                                <span class="mr-2 text-sm font-medium text-gray-800">استاد علی محمدی</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">نمره کسب شده</p>
                                            <p class="font-medium text-gray-800">۱۸ از ۲۰</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- حضور و غیاب -->
                            <div class="bg-gray-50 rounded-xl p-5">
                                <h3 class="font-medium text-gray-800 mb-4">وضعیت حضور و غیاب</h3>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white overflow-hidden">
                                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="هنرجو" class="w-full h-full object-cover">
                                        </div>
                                        <span class="mr-2 text-sm font-medium text-gray-800">شما</span>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border attendance-present">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        حاضر
                                    </span>
                                </div>
                                <div class="text-sm text-gray-600 mb-4">
                                    <p>شما در این جلسه حضور داشتید و نمره کامل کسب کردید.</p>
                                </div>
                                <button class="w-full bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                    </svg>
                                    دریافت گواهی حضور
                                </button>
                            </div>
                        </div>

                        <!-- کامنت استاد -->
                        <div class="mt-6">
                            <h3 class="font-medium text-gray-800 mb-4">نظر استاد درباره این جلسه</h3>
                            <div class="comment-box bg-blue-50 border border-blue-100 rounded-xl p-5">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 border-2 border-white overflow-hidden flex-shrink-0">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="استاد علی محمدی" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-medium text-gray-800">استاد علی محمدی</span>
                                            <span class="text-xs text-gray-500">۲ روز پیش</span>
                                        </div>
                                        <p class="mt-2 text-gray-700 text-sm leading-relaxed">
                                            جلسه بسیار خوبی بود. تمرین‌های شما نشان دهنده پیشرفت عالی در درک مفاهیم هارمونی است. لطفاً برای جلسه بعدی تمرین شماره ۵ از کتاب را انجام دهید و روی بخش‌های ۳ و ۴ بیشتر کار کنید.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- پاسخ هنرجو -->
                            <div class="teacher-response mt-4 bg-white border border-gray-200 rounded-xl p-5 ml-10">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 border-2 border-white overflow-hidden flex-shrink-0">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="هنرجو" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-medium text-gray-800">شما</span>
                                            <span class="text-xs text-gray-500">۱ روز پیش</span>
                                        </div>
                                        <p class="mt-2 text-gray-700 text-sm leading-relaxed">
                                            ممنون از راهنمایی‌های شما. حتماً تمرین‌ها را انجام خواهم داد. سوالی در مورد بخش ۴ داشتم که آیا می‌توانم قبل از جلسه بعدی از شما بپرسم؟
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- فرم پاسخ -->
                            <div class="mt-4">
                                <textarea class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent" rows="3" placeholder="پاسخ خود را اینجا بنویسید..."></textarea>
                                <div class="flex justify-end mt-2">
                                    <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300">
                                        ارسال پاسخ
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- فایل‌های ضمیمه -->
                        <div class="mt-8">
                            <h3 class="font-medium text-gray-800 mb-4">فایل‌های ضمیمه این جلسه</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="attachment-card bg-white border border-gray-200 rounded-xl p-4 hover:border-purple-200">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-purple-100 text-purple-800 rounded-lg p-2 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800 text-sm">جزوه هارمونی پیشرفته</p>
                                            <p class="text-xs text-gray-500 mt-1">PDF - 2.4MB</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-end mt-3">
                                        <button class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            دانلود
                                        </button>
                                    </div>
                                </div>
                                <div class="attachment-card bg-white border border-gray-200 rounded-xl p-4 hover:border-purple-200">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-blue-100 text-blue-800 rounded-lg p-2 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800 text-sm">فیلم جلسه سوم</p>
                                            <p class="text-xs text-gray-500 mt-1">MP4 - 45.2MB</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-end mt-3">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            دانلود
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- نظرسنجی -->
                        <div class="mt-8">
                            <h3 class="font-medium text-gray-800 mb-4">نظرسنجی این جلسه</h3>
                            <div class="bg-green-50 border border-green-100 rounded-xl p-5">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="font-medium text-gray-800">چقدر از این جلسه راضی بودید؟</h4>
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">تکمیل شده</span>
                                </div>

                                <div class="space-y-5">
                                    <div>
                                        <p class="text-sm text-gray-700 mb-2">کیفیت تدریس استاد</p>
                                        <div class="flex items-center">
                                            <div class="flex">
                                                <svg class="rating-star w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                <svg class="rating-star w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                <svg class="rating-star w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                <svg class="rating-star w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                <svg class="rating-star w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            </div>
                                            <span class="text-sm text-gray-600 mr-2">عالی</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-700 mb-2">میزان یادگیری شما</p>
                                        <div class="flex items-center">
                                            <div class="flex">
                                                <svg class="rating-star w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                <svg class="rating-star w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                <svg class="rating-star w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                <svg class="rating-star w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                <svg class="rating-star w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            </div>
                                            <span class="text-sm text-gray-600 mr-2">خوب</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-700 mb-2">نظر آزاد</p>
                                        <p class="text-sm text-gray-600">جلسه بسیار مفیدی بود. ممنون از توضیحات کامل استاد. فقط پیشنهاد می‌کنم زمان بیشتری برای تمرین عملی در نظر گرفته شود.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- سایدبار -->
                <div class="space-y-6">
                    <!-- خلاصه وضعیت -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">وضعیت حضور و غیاب</h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-green-500 ml-2"></div>
                                    <span class="text-sm text-gray-600">حاضر</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">۸ جلسه</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-red-500 ml-2"></div>
                                    <span class="text-sm text-gray-600">غیبت موجه</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">۱ جلسه</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-orange-500 ml-2"></div>
                                    <span class="text-sm text-gray-600">غیبت غیرموجه</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">۱ جلسه</span>
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-gray-400 ml-2"></div>
                                    <span class="text-sm text-gray-600">جلسات باقیمانده</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">۸ جلسه</span>
                            </div>
                        </div>
                        <div class="mt-6 bg-gray-100 rounded-full h-3">
                            <div class="bg-gradient-to-r from-green-500 via-orange-500 to-red-500 h-3 rounded-full" style="width: 80%"></div>
                        </div>
                    </div>

                    <!-- میانگین نمرات -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">میانگین نمرات</h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">نمره کل</span>
                                <span class="text-sm font-medium text-gray-800">۱۷.۲ از ۲۰</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">رتبه در کلاس</span>
                                <span class="text-sm font-medium text-gray-800">۳ از ۱۲</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">بهترین نمره</span>
                                <span class="text-sm font-medium text-gray-800">۱۹.۵ از ۲۰</span>
                            </div>
                        </div>
                        <div class="mt-6 bg-purple-100 text-purple-800 rounded-lg p-4 text-center">
                            <p class="text-sm">شما ۸۶% از کل نمره ممکن را کسب کرده‌اید</p>
                            <div class="mt-2 bg-white rounded-full h-3">
                                <div class="bg-purple-600 h-3 rounded-full" style="width: 86%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- تکالیف آینده -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">تکالیف آینده</h2>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="bg-blue-100 text-blue-800 rounded-lg p-2 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">تمرین هارمونی فصل ۳</p>
                                    <p class="text-xs text-gray-500 mt-1">موعد تحویل: ۲۴ مرداد ۱۴۰۲</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="bg-green-100 text-green-800 rounded-lg p-2 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">آهنگسازی با گام C</p>
                                    <p class="text-xs text-gray-500 mt-1">موعد تحویل: ۳۱ مرداد ۱۴۰۲</p>
                                </div>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            افزودن یادآوری
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- دکمه شناور برای پشتیبانی -->
    <div class="fixed bottom-6 left-6 z-50">
        <button class="floating-action-btn bg-purple-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
        </button>
    </div>
</x-layouts.app>
