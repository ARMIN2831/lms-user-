<x-layouts.app title="پرداخت‌های دوره">
    <!-- استایل سفارشی -->
    <style>
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

        /* استایل‌های اسکلتون */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .skeleton-tab {
            height: 3.5rem;
            border-radius: 0.75rem;
        }

        .skeleton-stat {
            height: 6rem;
            border-radius: 0.75rem;
        }

        .skeleton-payment {
            height: 8rem;
            border-radius: 0.75rem;
        }

        .skeleton-text {
            height: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.25rem;
        }

        .skeleton-button {
            height: 2.5rem;
            border-radius: 0.5rem;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
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



        /* استایل‌های مخصوص استاد */
        .teacher-badge {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            color: white;
        }

        .session-list {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .session-list.expanded {
            max-height: 500px;
        }

        .unpaid-session {
            border-right: 3px solid #ef4444;
        }

        .paid-session {
            border-right: 3px solid #10b981;
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

            .payment-details {
                flex-direction: column;
            }
        }

        /* استایل‌های تب دوره‌ها */
        .course-tab {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .course-tab::before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 50%;
            transform: translateX(50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #8b5cf6, #ec4899);
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .course-tab.active::before {
            width: 80%;
        }

        .course-tab.active {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
            transform: translateY(-2px);
        }

        .course-tab:hover:not(.active) {
            background: rgba(255, 255, 255, 0.8);
            transform: translateY(-2px);
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-white p-4 md:p-8 font-sans" x-data="PaymentsPage()">
        <template x-if="type == 2">
            <div>
                <!-- هدر صفحه -->
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">پرداخت‌های دوره</h1>
                        <p class="text-gray-600 mt-1 text-sm md:text-base">مدیریت مالی دوره‌های شما</p>
                    </div>
                    <template x-if="loading">
                        <div class="course-tabs-container relative mb-8">
                            <div class="course-tabs flex space-x-3 space-x-reverse">
                                <div class="skeleton skeleton-tab w-40"></div>
                                <div class="skeleton skeleton-tab w-40"></div>
                            </div>
                        </div>
                    </template>
                    <template x-if="!loading && courses.length > 0">
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
                    </template>
                </div>

                <!-- تب‌های دوره‌ها (اسکلتون) -->
                <template x-if="loading">
                    <div class="course-tabs-container relative mb-8">
                        <div class="course-tabs flex space-x-3 space-x-reverse">
                            <div class="skeleton skeleton-tab w-40"></div>
                            <div class="skeleton skeleton-tab w-40"></div>
                            <div class="skeleton skeleton-tab w-40"></div>
                        </div>
                    </div>
                </template>

                <!-- تب‌های دوره‌ها -->
                <template x-if="!loading && courses.length > 0">
                    <div class="course-tabs-container relative mb-8">
                        <div class="course-tabs flex space-x-3 space-x-reverse">
                            <template x-for="(course, index) in courses" :key="course.id">
                                <button
                                    @click="selectCourse(course)"
                                    :class="{'active': selectedCourseId === course.id}"
                                    class="course-tab px-6 py-3 rounded-xl flex flex-col items-center"
                                >
                                    <span class="text-sm md:text-base font-medium" x-text="course.course.title.coTitle"></span>
                                    <span
                                        class="text-xs mt-1"
                                        :class="course.remain >= 0 ? 'text-green-600' : 'text-red-600'"
                                        x-text="course.remain >= 0 ? 'تکمیل شده' : `${Math.abs(course.remain)} جلسه معوق`"
                                    ></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>



                <style>

                    .course-tab {
                        transition: all 0.3s ease;
                        position: relative;
                        overflow: hidden;
                    }

                    .course-tab::before {
                        content: '';
                        position: absolute;
                        bottom: 0;
                        right: 50%;
                        transform: translateX(50%);
                        width: 0;
                        height: 3px;
                        background: linear-gradient(90deg, #8b5cf6, #ec4899);
                        transition: all 0.3s ease;
                        border-radius: 10px;
                    }

                    .course-tab.active::before {
                        width: 80%;
                    }

                    .course-tab.active {
                        background: rgba(255, 255, 255, 0.95);
                        box-shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
                        transform: translateY(-2px);
                    }

                    .course-tab:hover:not(.active) {
                        background: rgba(255, 255, 255, 0.8);
                        transform: translateY(-2px);
                    }
                </style>

                <!-- آمار و خلاصه وضعیت پرداخت (اسکلتون) -->
                <template x-if="loading">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8 stats-grid">
                        <div class="skeleton skeleton-stat"></div>
                        <div class="skeleton skeleton-stat"></div>
                        <div class="skeleton skeleton-stat"></div>
                    </div>
                </template>

                <!-- آمار و خلاصه وضعیت پرداخت (داینامیک) -->
                <template x-if="!loading && selectedCourse">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8 stats-grid">
                        <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">جلسات معوق</p>
                                    <p
                                        class="text-2xl font-bold mt-1"
                                        :class="selectedCourse.remain >= 0 ? 'text-green-600' : 'text-red-600'"
                                        x-text="selectedCourse.remain >= 0 ? '۰ جلسه' : `${Math.abs(selectedCourse.remain)} جلسه`"
                                    ></p>
                                </div>
                                <div class="p-3 rounded-full" :class="selectedCourse.remain >= 0 ? 'bg-green-100' : 'bg-red-100'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" :class="selectedCourse.remain >= 0 ? 'text-green-600' : 'text-red-600'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-3" x-text="selectedCourse.remain >= 0 ? 'دوره کامل پرداخت شده' : 'جلسات پرداخت نشده'"></p>
                        </div>

                        <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">مبلغ کل دوره</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1" x-text="formatPrice(selectedCourse.payment_count) + ' تومان'"></p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-3" x-text="`${selectedCourse.perMonth} جلسه در ماه`"></p>
                        </div>

                        <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">کل پرداختی‌ها</p>
                                    <p class="text-2xl font-bold text-green-600 mt-1" x-text="formatPrice(selectedCourse.total_payed) + ' تومان'"></p>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-3" x-text="`${selectedCourse.total_payed_count} پرداخت انجام شده`"></p>
                        </div>
                    </div>
                </template>

                <!-- فیلترها و جستجو -->
                <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="filter-buttons mb-4 md:mb-0">
                            <div class="filter-buttons-container flex space-x-3 space-x-reverse">
                                <button
                                    @click="filterPayments('all')"
                                    :class="{'active': currentFilter === 'all'}"
                                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium"
                                >
                                    همه پرداخت‌ها
                                </button>
                                <button
                                    @click="filterPayments('success')"
                                    :class="{'active': currentFilter === 'success'}"
                                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium"
                                >
                                    پرداخت موفق
                                </button>
                                <button
                                    @click="filterPayments('pending')"
                                    :class="{'active': currentFilter === 'pending'}"
                                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium"
                                >
                                    در انتظار پرداخت
                                </button>
                            </div>
                        </div>
                        <div class="relative w-full md:w-64">
                            <input
                                type="text"
                                x-model="searchQuery"
                                @input="filterPayments()"
                                placeholder="جستجو در پرداخت‌ها..."
                                class="w-full pr-10 pl-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- لیست پرداخت‌ها (اسکلتون) -->
                <template x-if="loading">
                    <div class="space-y-4">
                        <div class="skeleton skeleton-payment"></div>
                        <div class="skeleton skeleton-payment"></div>
                        <div class="skeleton skeleton-payment"></div>
                    </div>
                </template>

                <!-- لیست پرداخت‌ها (داینامیک) -->
                <template x-if="!loading && selectedCourse">
                    <div class="space-y-4">
                        <template x-for="payment in filteredPayments" :key="payment.id">
                            <div class="payment-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                                <div class="p-5">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                        <div class="mb-4 md:mb-0">
                                            <div class="flex items-center">
                                        <span class="payment-status bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-medium ml-3">
                                            پرداخت موفق
                                        </span>
                                                <span class="text-sm text-gray-600" x-text="'شناسه پرداخت: #' + payment.id"></span>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-800 mt-2">پرداخت دوره <span x-text="selectedCourse.course.title.coTitle"></span></h3>
                                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span x-text="'تاریخ پرداخت: ' + formatDate(payment.pay_date)"></span>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-start md:items-end">
                                            <p class="text-2xl font-bold text-gray-800" x-text="formatPrice(payment.pay_amount) + ' تومان'"></p>
                                            <p class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full" x-text="payment.count + ' جلسه آموزشی'"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="filteredPayments.length === 0">
                            <div class="text-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-600">هیچ پرداختی یافت نشد</p>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </template>


        <template x-if="type == 1">
            <div>

                <!-- هدر صفحه مخصوص استاد -->
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
                    <div>
                        <div class="flex items-center">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">پنل مالی استاد</h1>
                            <span class="teacher-badge text-xs px-3 py-1 rounded-full font-medium mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        استاد
                    </span>
                        </div>
                        <p class="text-gray-600 mt-1 text-sm md:text-base">مدیریت پرداخت‌ها و جلسات دوره‌های شما</p>
                    </div>

                    <template x-if="loading">
                        <div class="mt-4 md:mt-0 flex space-x-3 space-x-reverse">
                            <div class="skeleton skeleton-button w-32"></div>
                            {{--<div class="skeleton skeleton-button w-32"></div>--}}
                        </div>
                    </template>

                    <template x-if="!loading && courses.length > 0">
                        <div class="mt-4 md:mt-0 flex space-x-3 space-x-reverse">
                            <button
                                @click="exportToExcel()"
                                class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                خروجی Excel
                            </button>
                            {{--<button
                                @click="showPaymentModal()"
                                class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                مشاهده جزئیات
                            </button>--}}
                        </div>
                    </template>
                </div>

                <!-- تب‌های دوره‌ها (اسکلتون) -->
                <template x-if="loading">
                    <div class="course-tabs-container relative mb-8">
                        <div class="course-tabs flex space-x-3 space-x-reverse">
                            <div class="skeleton skeleton-tab w-40"></div>
                            <div class="skeleton skeleton-tab w-40"></div>
                            <div class="skeleton skeleton-tab w-40"></div>
                        </div>
                    </div>
                </template>

                <!-- تب‌های دوره‌ها -->
                <template x-if="!loading && courses.length > 0">
                    <div class="course-tabs-container relative mb-8">
                        <div class="course-tabs flex space-x-3 space-x-reverse">
                            <template x-for="course in courses" :key="course.course_id">
                                <button
                                    @click="selectCourse(course)"
                                    :class="{'active': selectedCourseId === course.course_id}"
                                    class="course-tab px-6 py-3 rounded-xl flex flex-col items-center"
                                >
                                    <span class="text-sm md:text-base font-medium" x-text="course.course_name"></span>
                                    <span class="text-xs mt-1 text-gray-600"
                                          x-text="`${course.summary.paid_sessions_count} پرداختی - ${course.summary.unpaid_sessions_count} معوق`"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- خلاصه وضعیت مالی (اسکلتون) -->
                <template x-if="loading">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8 stats-grid">
                        <div class="skeleton skeleton-stat"></div>
                        <div class="skeleton skeleton-stat"></div>
                        <div class="skeleton skeleton-stat"></div>
                        <div class="skeleton skeleton-stat"></div>
                    </div>
                </template>

                <!-- خلاصه وضعیت مالی -->
                <template x-if="!loading && selectedCourse">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8 stats-grid">
                        <!-- کل جلسات -->
                        <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">کل جلسات</p>
                                    <p class="text-2xl font-bold text-blue-600 mt-1" x-text="selectedCourse.summary.total_sessions"></p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-3">تعداد کل جلسات دوره</p>
                        </div>

                        <!-- جلسات پرداخت شده -->
                        <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">جلسات پرداخت شده</p>
                                    <p class="text-2xl font-bold text-green-600 mt-1" x-text="selectedCourse.summary.paid_sessions_count"></p>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-3" x-text="formatPrice(selectedCourse.summary.total_paid) + ' تومان'"></p>
                        </div>

                        <!-- جلسات پرداخت نشده -->
                        <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">جلسات معوق</p>
                                    <p class="text-2xl font-bold text-red-600 mt-1" x-text="selectedCourse.summary.unpaid_sessions_count"></p>
                                </div>
                                <div class="bg-red-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-3" x-text="formatPrice(selectedCourse.summary.total_unpaid) + ' تومان'"></p>
                        </div>

                        <!-- وضعیت کلی -->
                        <div class="stat-card bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">وضعیت دوره</p>
                                    <p class="text-xl font-bold mt-1"
                                       :class="selectedCourse.summary.unpaid_sessions_count === 0 ? 'text-green-600' : 'text-orange-600'"
                                       x-text="selectedCourse.summary.unpaid_sessions_count === 0 ? 'تکمیل شده' : 'در حال برگزاری'">
                                    </p>
                                </div>
                                <div class="p-3 rounded-full"
                                     :class="selectedCourse.summary.unpaid_sessions_count === 0 ? 'bg-green-100' : 'bg-orange-100'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                         :class="selectedCourse.summary.unpaid_sessions_count === 0 ? 'text-green-600' : 'text-orange-600'"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-3"
                               x-text="`${Math.round((selectedCourse.summary.paid_sessions_count / selectedCourse.summary.total_sessions) * 100)}% پیشرفت`">
                            </p>
                        </div>
                    </div>
                </template>

                <!-- فیلترها و جستجو -->
                <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="filter-buttons mb-4 md:mb-0">
                            <div class="filter-buttons-container flex space-x-3 space-x-reverse">
                                <button
                                    @click="currentFilter = 'all'"
                                    :class="{'active': currentFilter === 'all'}"
                                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium"
                                >
                                    همه پرداخت‌ها
                                </button>
                                <button
                                    @click="currentFilter = 'paid'"
                                    :class="{'active': currentFilter === 'paid'}"
                                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium"
                                >
                                    پرداخت شده
                                </button>
                                <button
                                    @click="currentFilter = 'unpaid'"
                                    :class="{'active': currentFilter === 'unpaid'}"
                                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium"
                                >
                                    پرداخت نشده
                                </button>
                            </div>
                        </div>
                        <div class="relative w-full md:w-64">
                            <input
                                type="text"
                                x-model="searchQuery"
                                placeholder="جستجو در پرداخت‌ها..."
                                class="w-full pr-10 pl-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- لیست پرداخت‌ها -->
                <template x-if="!loading && selectedCourse">
                    <div class="space-y-6">
                        <!-- پرداخت‌های انجام شده -->
                        <template x-if="(selectedCourse.paid_sessions.length > 0) && (currentFilter === 'paid' || currentFilter === 'all')">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    پرداخت‌های انجام شده
                                </h3>

                                <div class="space-y-4">
                                    <template x-for="payment in selectedCourse.paid_sessions" :key="payment.payment_id">
                                        <div class="payment-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                                            <div class="p-5">
                                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                                    <div class="mb-4 md:mb-0">
                                                        <div class="flex items-center mb-2">
                                                    <span class="payment-status bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-medium ml-3">
                                                        پرداخت شده
                                                    </span>
                                                            <span class="text-sm text-gray-600" x-text="'شناسه پرداخت: #' + payment.payment_id"></span>
                                                        </div>
                                                        <h3 class="text-lg font-bold text-gray-800">پرداخت دوره
                                                            <span x-text="selectedCourse.course_name"></span>
                                                        </h3>
                                                        <div class="flex items-center mt-2 text-sm text-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                            <span x-text="'تاریخ پرداخت: ' + formatDate(payment.payment_date)"></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col items-start md:items-end">
                                                        <p class="text-2xl font-bold text-gray-800"
                                                           x-text="formatPrice(payment.payment_amount) + ' تومان'"></p>
                                                        <p class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full mt-1"
                                                           x-text="payment.sessions_count + ' جلسه'"></p>
                                                    </div>
                                                </div>

                                                <!-- جزئیات جلسات -->
                                                <div class="mt-4">
                                                    <button
                                                        @click="toggleSessions(payment.payment_id)"
                                                        class="flex items-center text-sm text-purple-600 hover:text-purple-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transition-transform"
                                                             :class="expandedPayments[payment.payment_id] ? 'rotate-180' : ''"
                                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                        مشاهده جلسات (
                                                        <span x-text="payment.sessions_count"></span>
                                                        جلسه)
                                                    </button>

                                                    <div class="session-list mt-2"
                                                         :class="{'expanded': expandedPayments[payment.payment_id]}"
                                                         data-payment="${payment.payment_id}">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                                                            <template x-for="session in payment.sessions" :key="session.attend_id">
                                                                <div class="paid-session bg-gray-50 rounded-lg p-3 text-sm">
                                                                    <div class="flex justify-between items-center">
                                                                        <span class="font-medium" x-text="'جلسه ' + session.attend_id"></span>
                                                                        <span class="text-green-600" x-text="formatPrice(session.amount) + ' تومان'"></span>
                                                                    </div>
                                                                    <div class="text-gray-500 text-xs mt-1"
                                                                         x-text="'تاریخ: ' + (session.session_date ? formatDate(session.session_date) : '--')"></div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- جلسات پرداخت نشده -->
                        <template x-if="(selectedCourse.unpaid_sessions.sessions_count > 0) && (currentFilter === 'unpaid' || currentFilter === 'all')">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    جلسات پرداخت نشده
                                </h3>

                                <div class="unpaid-session bg-red-50 border border-red-200 rounded-xl p-5">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                        <div>
                                            <h4 class="font-bold text-red-800 text-lg">
                                                <span x-text="selectedCourse.unpaid_sessions.sessions_count"></span>
                                                جلسه پرداخت نشده
                                            </h4>
                                            <p class="text-red-600 mt-1"
                                               x-text="'مبلغ کل: ' + formatPrice(selectedCourse.unpaid_sessions.total_amount) + ' تومان'"></p>
                                        </div>
                                        <button class="mt-3 md:mt-0 bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                            درخواست پرداخت
                                        </button>
                                    </div>

                                    <!-- لیست جلسات پرداخت نشده -->
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <template x-for="session in selectedCourse.unpaid_sessions.sessions" :key="session.attend_id">
                                            <div class="unpaid-session bg-white rounded-lg p-3 border border-red-100">
                                                <div class="flex justify-between items-center">
                                                    <span class="font-medium text-sm" x-text="'جلسه ' + session.attend_id"></span>
                                                    <span class="text-red-600 font-bold" x-text="formatPrice(session.amount) + ' تومان'"></span>
                                                </div>
                                                <div class="text-gray-500 text-xs mt-1"
                                                     x-text="'تاریخ: ' + (session.session_date ? formatDate(session.session_date) : '--')"></div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- حالت خالی -->
                        <template x-if="selectedCourse.paid_sessions.length === 0 && selectedCourse.unpaid_sessions.sessions_count === 0">
                            <div class="text-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-600 text-lg">هنوز پرداختی‌ای ثبت نشده است</p>
                                <p class="text-gray-500 text-sm mt-1">پس از برگزاری جلسات، اطلاعات پرداخت در اینجا نمایش داده می‌شود</p>
                            </div>
                        </template>
                    </div>
                </template>

                <!-- حالت بدون دوره -->
                <template x-if="!loading && courses.length === 0">
                    <div class="text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-gray-600 text-lg">هنوز دوره‌ای برای شما ثبت نشده است</p>
                        <p class="text-gray-500 text-sm mt-1">پس از ثبت دوره‌های آموزشی، اطلاعات مالی در اینجا نمایش داده می‌شود</p>
                    </div>
                </template>
            </div>
        </template>
    </div>

    <script>
        function PaymentsPage() {
            return {
                loading: true,
                type : null,

                // داده‌های مشترک
                courses: [],
                selectedCourseId: null,
                selectedCourse: null,
                currentFilter: 'all',
                searchQuery: '',
                expandedPayments: {},

                async init() {
                    await waitForCheckToken();
                    this.type = userType;
                    if (userType === 1) {
                        await this.fetchTeacherPayments();
                    } else {
                        await this.fetchStudentPayments();
                    }
                },

                // متدهای مخصوص استاد
                async fetchTeacherPayments() {
                    try {
                        this.loading = true;
                        const response = await makeRequest('GET', 'fa', '{{ route("getPayments") }}');

                        if (response.status === 'success') {
                            this.courses = response.data.courses;
                            if (this.courses.length > 0) {
                                this.selectedCourseId = this.courses[0].course_id;
                                this.selectedCourse = this.courses[0];
                            }
                        }
                    } catch (error) {
                        showToastAlert('خطا در دریافت اطلاعات پرداخت‌ها', 'error', 3000);
                        console.error('Error fetching payments:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                // متدهای مخصوص دانشجو
                async fetchStudentPayments() {
                    try {
                        this.loading = true;
                        const response = await makeRequest('GET', 'fa', '{{ route("getPayments") }}');

                        if (response.status === 'success' && response.data.payments.length > 0) {
                            this.courses = response.data.payments;
                            this.selectedCourseId = this.courses[0].id;
                            this.selectedCourse = this.courses[0];
                        }
                    } catch (error) {
                        showToastAlert(error, 'error', 3000);
                    } finally {
                        this.loading = false;
                    }
                },

                // متدهای مشترک
                selectCourse(course) {
                    this.selectedCourseId = userType === 1 ? course.course_id : course.id;
                    this.selectedCourse = course;
                    this.expandedPayments = {};
                },

                toggleSessions(paymentId) {
                    this.expandedPayments[paymentId] = !this.expandedPayments[paymentId];
                    this.$nextTick(() => {
                        const element = this.$el.querySelector(`.session-list[data-payment="${paymentId}"]`);
                        if (element) {
                            element.style.maxHeight = this.expandedPayments[paymentId] ? element.scrollHeight + 'px' : '0';
                        }
                    });
                },

                // متدهای فیلتر برای دانشجو
                filterPayments(type = null) {
                    if (type) {
                        this.currentFilter = type;
                    }

                    if (!this.selectedCourse) return [];

                    let filtered = this.selectedCourse.payments;

                    if (this.currentFilter === 'success') {
                        filtered = filtered.filter(p => p.peyment_status_id === 1);
                    } else if (this.currentFilter === 'pending') {
                        filtered = filtered.filter(p => p.peyment_status_id !== 1);
                    }

                    if (this.searchQuery) {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(p =>
                            p.id.toString().includes(query) ||
                            p.pay_amount.toString().includes(query) ||
                            this.formatDate(p.pay_date).includes(query)
                        );
                    }

                    return filtered;
                },

                get filteredPayments() {
                    return this.filterPayments();
                },

                // متدهای کمکی
                formatPrice(price) {
                    return new Intl.NumberFormat('fa-IR').format(price);
                },

                formatDate(dateString) {
                    if (!dateString) return '--';
                    try {
                        // اگر timestamp است (برای دانشجو)
                        if (typeof dateString === 'number') {
                            const date = new Date(dateString * 1000);
                            return new Intl.DateTimeFormat('fa-IR', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit',
                                hour: '2-digit',
                                minute: '2-digit'
                            }).format(date);
                        } else {
                            // اگر string تاریخ است (برای استاد)
                            const date = new Date(dateString);
                            return new Intl.DateTimeFormat('fa-IR', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit',
                                hour: '2-digit',
                                minute: '2-digit'
                            }).format(date);
                        }
                    } catch (e) {
                        return dateString;
                    }
                },

                exportToExcel() {
                    showToastAlert('امکان خروجی Excel به زودی اضافه خواهد شد', 'info', 3000);
                },

                showPaymentModal() {
                    showToastAlert('امکان مشاهده جزئیات به زودی اضافه خواهد شد', 'info', 3000);
                }
            };
        }
    </script>
</x-layouts.app>
