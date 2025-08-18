<x-layouts.app title="پرداخت‌های دوره">
    <!-- استایل سفارشی -->
    <style>
        /* انیمیشن‌ها و ترنزیشن‌ها */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .payment-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .payment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .course-tab {
            transition: all 0.3s ease;
            min-width: 120px;
        }

        .course-tab.active {
            border-bottom: 3px solid #7c3aed;
            color: #7c3aed;
            font-weight: 600;
        }

        .course-tab:hover:not(.active) {
            background-color: #f3f4f6;
        }

        .filter-btn {
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .filter-btn.active {
            background-color: #7c3aed;
            color: white;
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .payment-status {
            transition: all 0.3s ease;
        }

        /* استایل‌های ریسپانسیو */
        @media (max-width: 640px) {
            .course-tabs-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }

            .course-tabs-container::-webkit-scrollbar {
                display: none;
            }

            .course-tabs {
                width: max-content;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .filter-buttons {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                padding-bottom: 8px;
            }

            .filter-buttons::-webkit-scrollbar {
                display: none;
            }

            .filter-buttons-container {
                width: max-content;
            }
        }

        /* استایل‌های عمومی */
        .new-payment-btn {
            transition: all 0.3s ease;
        }

        .new-payment-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px -5px rgba(124, 58, 237, 0.3);
        }

        .disabled-btn {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .disabled-btn:hover {
            transform: none !important;
        }
        .course-tabs-container {
            -webkit-overflow-scrolling: touch;
        }

        .course-tabs {
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding-bottom: 4px;
        }

        .course-tabs::-webkit-scrollbar {
            display: none;
        }

        .course-tab {
            min-width: 110px;
            white-space: nowrap;
            background: white;
            border: 1px solid #f3f4f6;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
        }

        .course-tab.active {
            border-color: #e9d5ff;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(124, 58, 237, 0.1), 0 2px 4px -1px rgba(124, 58, 237, 0.06);
            transform: translateY(-2px);
        }

        .course-tab:not(.active):hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .active-tab-indicator {
            box-shadow: 0 2px 8px -1px rgba(124, 58, 237, 0.4);
            transition: transform 0.4s cubic-bezier(0.65, 0, 0.35, 1), width 0.3s ease;
        }

        @media (max-width: 640px) {
            .course-tab {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
                min-width: 100px;
            }
        }

        /* انیمیشن‌های اضافه برای زیبایی */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .course-tab:hover {
            animation: float 1.5s ease-in-out infinite;
        }

        .course-tab.active:hover {
            animation: none;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-white p-4 md:p-8 font-sans">
        <!-- هدر صفحه -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">پرداخت‌های دوره</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">مدیریت مالی دوره‌های شما</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3 space-x-reverse">
                <button class="new-payment-btn disabled-btn bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-medium shadow-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18V7a1 1 0 00-1-1H4a1 1 0 00-1 1v3zm0 2v5a1 1 0 001 1h16a1 1 0 001-1v-5H3z" />
                    </svg>
                    پرداخت همه دوره‌ها
                </button>
                <button class="new-payment-btn bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    پرداخت جدید
                </button>
            </div>
        </div>

        <!-- تب‌های دوره‌ها -->
        <div class="course-tabs-container relative mb-8 mx-2 md:mx-0">
            <!-- خط زمینه انیمیشنی بهبود یافته -->
            <div class="absolute bottom-0 left-0 right-0 h-[3px] bg-gray-100 z-0 rounded-full"></div>
            {{--<div class="active-tab-indicator absolute bottom-0 left-0 h-[3px] bg-gradient-to-r from-purple-500 to-indigo-600 z-10 transition-all duration-300 ease-[cubic-bezier(0.65,0,0.35,1)] rounded-full" style="width: 120px; transform: translateX(0);"></div>--}}

            <div class="course-tabs flex space-x-1 space-x-reverse relative z-20 overflow-x-auto pb-1 scrollbar-hide pt-2">
                <!-- تب 1 -->
                <button class="course-tab active px-4 md:px-6 py-3 rounded-xl flex flex-col items-center transition-all duration-300 relative group overflow-hidden" data-tab-index="0">
                    <div class="absolute inset-0 bg-gradient-to-b from-purple-50/80 to-white/90 opacity-0 group-hover:opacity-100 rounded-xl transition-all duration-300"></div>
                    <div class="absolute -bottom-4 -left-4 -right-4 top-0 bg-gradient-to-t from-purple-100/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <span class="text-sm md:text-base font-medium text-gray-800 relative z-10 group-hover:text-purple-700 transition-colors duration-200 flex items-center">
                <i class="fas fa-music ml-2 text-purple-500 opacity-70 group-hover:opacity-100 transition-opacity"></i>
                تئوری موسیقی
            </span>

                    <span class="text-xs text-gray-500 mt-1 relative z-10 flex items-center">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1 animate-pulse"></span>
                <span>۴ جلسه معوق</span>
            </span>

                    <div class="absolute -bottom-px left-3 right-3 h-[2px] bg-purple-300 opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-full"></div>
                </button>

                <!-- تب 2 -->
                <button class="course-tab px-4 md:px-6 py-3 rounded-xl flex flex-col items-center transition-all duration-300 relative group overflow-hidden" data-tab-index="1">
                    <div class="absolute inset-0 bg-gradient-to-b from-blue-50/80 to-white/90 opacity-0 group-hover:opacity-100 rounded-xl transition-all duration-300"></div>
                    <div class="absolute -bottom-4 -left-4 -right-4 top-0 bg-gradient-to-t from-blue-100/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <span class="text-sm md:text-base font-medium text-gray-800 relative z-10 group-hover:text-blue-700 transition-colors duration-200 flex items-center">
                <i class="fas fa-guitar ml-2 text-blue-500 opacity-70 group-hover:opacity-100 transition-opacity"></i>
                گیتار کلاسیک
            </span>

                    <span class="text-xs text-gray-500 mt-1 relative z-10 flex items-center">
                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-1 animate-pulse"></span>
                <span>۲ جلسه معوق</span>
            </span>

                    <div class="absolute -bottom-px left-3 right-3 h-[2px] bg-blue-300 opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-full"></div>
                </button>

                <!-- تب 3 -->
                <button class="course-tab px-4 md:px-6 py-3 rounded-xl flex flex-col items-center transition-all duration-300 relative group overflow-hidden" data-tab-index="2">
                    <div class="absolute inset-0 bg-gradient-to-b from-green-50/80 to-white/90 opacity-0 group-hover:opacity-100 rounded-xl transition-all duration-300"></div>
                    <div class="absolute -bottom-4 -left-4 -right-4 top-0 bg-gradient-to-t from-green-100/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <span class="text-sm md:text-base font-medium text-gray-800 relative z-10 group-hover:text-green-700 transition-colors duration-200 flex items-center">
                <i class="fas fa-microphone ml-2 text-green-500 opacity-70 group-hover:opacity-100 transition-opacity"></i>
                آواز سنتی
            </span>

                    <span class="text-xs text-green-600 mt-1 relative z-10 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>پرداخت کامل</span>
            </span>

                    <div class="absolute -bottom-px left-3 right-3 h-[2px] bg-green-300 opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-full"></div>
                </button>

                <!-- تب 4 -->
                <button class="course-tab px-4 md:px-6 py-3 rounded-xl flex flex-col items-center transition-all duration-300 relative group overflow-hidden" data-tab-index="3">
                    <div class="absolute inset-0 bg-gradient-to-b from-orange-50/80 to-white/90 opacity-0 group-hover:opacity-100 rounded-xl transition-all duration-300"></div>
                    <div class="absolute -bottom-4 -left-4 -right-4 top-0 bg-gradient-to-t from-orange-100/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <span class="text-sm md:text-base font-medium text-gray-800 relative z-10 group-hover:text-orange-700 transition-colors duration-200 flex items-center">
                <i class="fas fa-piano-keyboard ml-2 text-orange-500 opacity-70 group-hover:opacity-100 transition-opacity"></i>
                پیانو مقدماتی
            </span>

                    <span class="text-xs text-gray-500 mt-1 relative z-10 flex items-center">
                <span class="w-2 h-2 bg-orange-500 rounded-full mr-1 animate-pulse"></span>
                <span>۱ جلسه معوق</span>
            </span>

                    <div class="absolute -bottom-px left-3 right-3 h-[2px] bg-orange-300 opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-full"></div>
                </button>
            </div>
        </div>

        <!-- آمار و خلاصه وضعیت پرداخت -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8 stats-grid">
            <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">جلسات معوق</p>
                        <p class="text-2xl font-bold text-red-600 mt-1">4 جلسه</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">جلسات ۴، ۵، ۷ و ۸ پرداخت نشده</p>
            </div>

            <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">مبلغ کل دوره</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">2,400,000 تومان</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">برای ۱۲ جلسه آموزشی</p>
            </div>

            <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">مانده حساب</p>
                        <p class="text-2xl font-bold text-blue-600 mt-1">800,000 تومان</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">تا تاریخ ۱۴۰۲/۰۶/۱۰</p>
            </div>
        </div>

        <!-- فیلترها و جستجو -->
        <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div class="filter-buttons mb-4 md:mb-0">
                    <div class="filter-buttons-container flex space-x-3 space-x-reverse">
                        <button class="filter-btn px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium active">همه پرداخت‌ها</button>
                        <button class="filter-btn px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50">پرداخت شده</button>
                        <button class="filter-btn px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50">در انتظار پرداخت</button>
                        <button class="filter-btn px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50">ناموفق</button>
                    </div>
                </div>
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="جستجو در پرداخت‌ها..." class="w-full pr-10 pl-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- لیست پرداخت‌ها -->
        <div class="space-y-4">
            <!-- پرداخت 1 -->
            <div class="payment-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                <div class="p-5">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center">
                                <span class="payment-status bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-medium ml-3">
                                    پرداخت موفق
                                </span>
                                <span class="text-sm text-gray-600">شناسه پرداخت: #P-24578</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mt-2">پرداخت دوره گیتار</h3>
                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>تاریخ پرداخت: ۱۴۰۲/۰۴/۰۵ - ۱۶:۲۳</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <p class="text-2xl font-bold text-gray-800">600,000 تومان</p>
                            <p class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">۳ جلسه آموزشی</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex space-x-3 space-x-reverse mt-3 md:mt-0">
                                <button class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    جزئیات
                                </button>
                                <button class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    فاکتور
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- پرداخت 2 -->
            <div class="payment-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                <div class="p-5">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center">
                                <span class="payment-status bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full font-medium ml-3">
                                    در انتظار پرداخت
                                </span>
                                <span class="text-sm text-gray-600">شناسه پرداخت: #P-24579</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mt-2">پرداخت دوره سنتور</h3>
                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>تاریخ سررسید: ۱۴۰۲/۰۵/۲۰</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <p class="text-2xl font-bold text-gray-800">400,000 تومان</p>
                            <p class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">۲ جلسه آموزشی</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex space-x-3 space-x-reverse mt-3 md:mt-0">
                                <button class="px-4 py-2 bg-white border border-purple-200 text-purple-600 rounded-lg text-sm hover:bg-purple-50 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18V7a1 1 0 00-1-1H4a1 1 0 00-1 1v3zm0 2v5a1 1 0 001 1h16a1 1 0 001-1v-5H3z" />
                                    </svg>
                                    پرداخت آنلاین
                                </button>
                                <button class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    جزئیات
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- صفحه‌بندی -->
        <div class="mt-8 flex items-center justify-center space-x-3 space-x-reverse">
            <button class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="w-10 h-10 flex items-center justify-center bg-purple-600 text-white rounded-lg">1</button>
            <button class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-lg hover:bg-gray-50">2</button>
            <button class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        // فعال کردن تب‌های دوره‌ها
        document.querySelectorAll('.course-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.course-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                // در اینجا می‌توانید کد تغییر محتوای بر اساس دوره انتخاب شده را اضافه کنید
            });
        });

        // فعال کردن فیلترها
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                // در اینجا می‌توانید کد فیلتر کردن پرداخت‌ها را اضافه کنید
            });
        });

        // مدیریت تغییر تب‌ها و انیمیشن نشانگر - بهبود یافته
        document.querySelectorAll('.course-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // انیمیشن حذف active از همه تب‌ها
                document.querySelectorAll('.course-tab').forEach(t => {
                    t.classList.remove('active');
                    t.style.transition = 'all 0.3s ease';
                });

                // اضافه کردن کلاس active به تب انتخاب شده با تأخیر
                setTimeout(() => {
                    this.classList.add('active');
                    this.style.transition = 'all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55)';
                }, 50);

                /*// انیمیشن نشانگر فعال
                const tabIndex = parseInt(this.getAttribute('data-tab-index'));
                const tabWidth = this.offsetWidth;
                const tabOffset = this.offsetLeft;
                const indicator = document.querySelector('.active-tab-indicator');

                // انیمیشن نرم برای تغییر موقعیت نشانگر
                indicator.style.transition = 'transform 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55), width 0.3s ease';
                indicator.style.width = `${tabWidth}px`;
                indicator.style.transform = `translateX(${tabOffset}px)`;

                // تغییر محتوا بر اساس تب انتخاب شده
                console.log(`تب ${tabIndex + 1} انتخاب شد`);

                // برای دمو - تغییر رنگ پس‌زمینه صفحه بر اساس تب انتخاب شده
                const colors = ['bg-purple-50', 'bg-blue-50', 'bg-green-50', 'bg-orange-50'];
                document.body.classList.remove('bg-purple-50', 'bg-blue-50', 'bg-green-50', 'bg-orange-50');
                document.body.classList.add(colors[tabIndex]);*/
            });

            // انیمیشن هنگام لود صفحه
            setTimeout(() => {
                tab.style.transition = 'all 0.5s ease-out';
            }, 100 * parseInt(tab.getAttribute('data-tab-index')));
        });

        // تنظیم اولیه نشانگر بر روی تب فعال
        window.addEventListener('load', () => {
            const activeTab = document.querySelector('.course-tab.active');
            if (activeTab) {
                const tabWidth = activeTab.offsetWidth;
                const tabOffset = activeTab.offsetLeft;
                const indicator = document.querySelector('.active-tab-indicator');

                indicator.style.width = `${tabWidth}px`;
                indicator.style.transform = `translateX(${tabOffset}px)`;
            }
        });
    </script>
</x-layouts.app>
