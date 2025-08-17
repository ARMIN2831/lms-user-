<x-layouts.app title="پرداخت‌های دوره">
    <!-- استایل سفارشی -->
    <style>
        .payment-card {
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(10px);
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .payment-card:nth-child(1) { animation-delay: 0.1s; }
        .payment-card:nth-child(2) { animation-delay: 0.2s; }
        .payment-card:nth-child(3) { animation-delay: 0.3s; }

        .payment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .payment-status {
            transition: all 0.3s ease;
        }

        .new-payment-btn {
            transition: all 0.3s ease;
        }

        .new-payment-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px -5px rgba(124, 58, 237, 0.3);
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .filter-btn.active {
            background-color: #7c3aed;
            color: white;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-white p-4 md:p-8 font-sans">
        <!-- هدر صفحه -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">پرداخت‌های دوره</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">مدیریت مالی دوره تئوری موسیقی پیشرفته</p>
            </div>
            <div class="mt-4 md:mt-0">
                <button class="new-payment-btn bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    پرداخت جدید
                </button>
            </div>
        </div>

        <!-- آمار و خلاصه وضعیت پرداخت -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">جلسات معوق</p>
                        <p class="text-2xl font-bold text-red-600 mt-1">2 جلسه</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">جلسات ۴ و ۵ هنوز پرداخت نشده‌اند</p>
            </div>

            <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">مبلغ کل دوره</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">4,500,000 تومان</p>
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
                        <p class="text-2xl font-bold text-blue-600 mt-1">1,200,000 تومان</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">تا تاریخ ۱۴۰۲/۰۵/۲۰</p>
            </div>
        </div>

        <!-- فیلترها و جستجو -->
        <div class="bg-white rounded-xl shadow-sm p-4 mb-6 flex flex-wrap items-center justify-between">
            <div class="flex space-x-3 space-x-reverse mb-3 md:mb-0">
                <button class="filter-btn px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium active">همه پرداخت‌ها</button>
                <button class="filter-btn px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50">پرداخت شده</button>
                <button class="filter-btn px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50">در انتظار پرداخت</button>
                <button class="filter-btn px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-50">ناموفق</button>
            </div>
            <div class="relative w-full md:w-auto">
                <input type="text" placeholder="جستجو در پرداخت‌ها..." class="w-full pr-10 pl-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
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
                            <h3 class="text-lg font-bold text-gray-800 mt-2">پرداخت جلسات ۱ تا ۳</h3>
                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>تاریخ پرداخت: ۱۴۰۲/۰۴/۰۵ - ۱۶:۲۳</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <p class="text-2xl font-bold text-gray-800">1,350,000 تومان</p>
                            <p class="text-sm text-gray-600 mt-1">۳ جلسه آموزشی</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-3 md:mb-0">
                                <p class="text-sm text-gray-700 mb-2">جلسات شامل این پرداخت:</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">جلسه ۱</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">جلسه ۲</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">جلسه ۳</span>
                                </div>
                            </div>
                            <div class="flex space-x-3 space-x-reverse">
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
                                <span class="payment-status bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-medium ml-3">
                                    در انتظار پرداخت
                                </span>
                                <span class="text-sm text-gray-600">شناسه پرداخت: #P-24579</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mt-2">پرداخت جلسات ۴ و ۵</h3>
                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>تاریخ سررسید: ۱۴۰۲/۰۵/۲۰</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <p class="text-2xl font-bold text-gray-800">900,000 تومان</p>
                            <p class="text-sm text-gray-600 mt-1">۲ جلسه آموزشی</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-3 md:mb-0">
                                <p class="text-sm text-gray-700 mb-2">جلسات شامل این پرداخت:</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">جلسه ۴</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">جلسه ۵</span>
                                </div>
                            </div>
                            <div class="flex space-x-3 space-x-reverse">
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

            <!-- پرداخت 3 -->
            <div class="payment-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                <div class="p-5">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center">
                                <span class="payment-status bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-medium ml-3">
                                    پرداخت ناموفق
                                </span>
                                <span class="text-sm text-gray-600">شناسه پرداخت: #P-24576</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mt-2">پرداخت جلسه ۶</h3>
                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>تاریخ پرداخت: ۱۴۰۲/۰۵/۱۰ - ۱۱:۴۵</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <p class="text-2xl font-bold text-gray-800">450,000 تومان</p>
                            <p class="text-sm text-gray-600 mt-1">۱ جلسه آموزشی</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-3 md:mb-0">
                                <p class="text-sm text-gray-700 mb-2">جلسات شامل این پرداخت:</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">جلسه ۶</span>
                                </div>
                                <p class="text-sm text-red-600 mt-2">خطا در پرداخت: موجودی حساب کافی نبود</p>
                            </div>
                            <div class="flex space-x-3 space-x-reverse">
                                <button class="px-4 py-2 bg-white border border-purple-200 text-purple-600 rounded-lg text-sm hover:bg-purple-50 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18V7a1 1 0 00-1-1H4a1 1 0 00-1 1v3zm0 2v5a1 1 0 001 1h16a1 1 0 001-1v-5H3z" />
                                    </svg>
                                    پرداخت مجدد
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
        // فعال کردن فیلترها
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</x-layouts.app>
