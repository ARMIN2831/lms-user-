<x-layouts.app title="جلسات دوره">
    <!-- استایل‌های سفارشی -->

    <style>
        @keyframes ping {
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        .animate-ping {
            animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        /* یا اگر می‌خواهید انیمیشن مخصوص خودتان را داشته باشید */
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
            }
        }

        .notification-dot {
            position: relative;
        }

        .notification-dot::after {
            content: '';
            position: absolute;
            top: -2px;
            right: -2px;
            width: 12px;
            height: 12px;
            background-color: #ef4444;
            border-radius: 50%;
            animation: pulse-glow 2s infinite;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* بهبود رنگ‌بندی هدر */
        .course-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transition: all 0.5s ease;
        }

        .course-header h1 {
            color: white;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .course-header p {
            color: rgba(255, 255, 255, 0.9);
        }

        .status-badge {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* استایل‌های مودال */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .modal-container {
            background-color: white;
            border-radius: 1rem;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(20px);
            transition: transform 0.3s ease;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
        }

        .modal-body {
            padding: 1.5rem;
        }

        /* استایل اسکرول برای لیست جلسات */
        .sessions-list {
            max-height: 600px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }

        /* اسکرول بار سفارشی */
        .sessions-list::-webkit-scrollbar {
            width: 6px;
        }

        .sessions-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .sessions-list::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 10px;
        }

        .sessions-list::-webkit-scrollbar-thumb:hover {
            background: #a5b4fc;
        }

        /* بقیه استایل‌ها */
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

        .cursor-not-allowed {
            opacity: 0.8;
        }

        .tab-item {
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .tab-item:hover {
            transform: translateY(-2px);
        }

        .tab-item.active {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(124, 58, 237, 0.3);
        }

        .tab-item:not(.active):not(.cursor-not-allowed):hover {
            background-color: #f3f4f6;
            transform: translateY(-1px);
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

        .skeleton-header {
            height: 2rem;
            margin-bottom: 1rem;
        }

        .skeleton-text {
            height: 1rem;
            margin-bottom: 0.5rem;
        }

        .skeleton-circle {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
        }

        .skeleton-button {
            width: 8rem;
            height: 2.5rem;
            border-radius: 0.5rem;
        }
    </style>

    <div class="min-h-screen bg-gray-50 font-sans" x-data="sessionsPage()">
        <template x-if="type == 2">
            <div>
                <!-- هدر دوره -->
                <div class="course-header text-white pb-12 pt-8  px-4 md:px-8 lg:px-12">
                    <div class="max-w-6xl mx-auto">
                        <template x-if="loading">
                            <!-- اسکلتون هدر -->
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                                <div class="flex items-start gap-4">
                                    <div class="skeleton skeleton-circle"></div>
                                    <div class="flex-1">
                                        <div class="skeleton skeleton-header w-64"></div>
                                        <div class="skeleton skeleton-text w-48"></div>
                                        <div class="flex items-center mt-4">
                                            <div class="skeleton skeleton-circle w-8 h-8"></div>
                                            <div class="skeleton skeleton-text mr-2 w-32"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="skeleton skeleton-button self-start"></div>
                            </div>
                        </template>

                        <template x-if="!loading && courseData">
                            <!-- محتوای واقعی هدر -->
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                                <div class="flex items-start gap-4">
                                    <div class="bg-white/30 backdrop-blur-sm rounded-xl p-1 flex items-center justify-center">
                                        <img width="60px" height="60px" :src="courseData.course.title.coCover ? mainFrontServerUrl + '/' + courseData.course.title.coCover : '/images/default-course.jpg'"
                                             :alt="courseData.course.title.coTitle" class="min-w-[60px] min-h-[60px] rounded-xl object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h1 class="text-2xl md:text-3xl font-bold mb-2" x-text="courseData.course.title.coTitle"></h1>
                                        <p class="text-sm md:text-base leading-relaxed" x-text="`${courseData.perMonth} جلسه در ماه • ${courseData.perclocko} دقیقه هر جلسه`"></p>
                                        <div class="flex items-center mt-4">
                                            <div class="w-8 h-8 rounded-full bg-white/20 overflow-hidden mr-3">
                                                <img :src="courseData.course.teacher.image" :alt="`${courseData.course.teacher.name} ${courseData.course.teacher.family}`" class="w-full h-full object-cover">
                                            </div>
                                            <span class="mr-2 text-sm text-white/90" x-text="`استاد ${courseData.course.teacher.name} ${courseData.course.teacher.family}`"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-1.5 self-start">
                                    <p class="text-xs text-center">وضعیت: <span :class="`font-bold text-${courseData.active ? 'green' : 'red'}-300`" x-text="courseData.active ? 'فعال' : 'غیرفعال'"></span></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- تب‌های صفحه -->
                <div class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 -mt-10">
                    <div class="flex pb-2 scrollbar-hide">
                        <div class="tab_section flex space-x-3 overflow-y-scroll space-x-reverse pt-3 pr-2">
                            <!-- تب محتوای دوره -->
                            <div class="relative">
                                <div class="tab-item bg-gray-100 rounded-xl px-6 py-3 font-medium text-gray-400 flex items-center cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    محتوای دوره
                                    <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-0.5 rounded-full">بزودی</span>
                                </div>
                            </div>

                            <!-- تب جلسات (فعال) -->
                            <a href="#" class="tab-item active bg-purple-600 text-white rounded-xl px-6 py-3 font-medium shadow-md hover:shadow-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                جلسات
                            </a>

                            <!-- تب نمرات (غیرفعال) -->
                            <div class="relative">
                                <div class="tab-item bg-gray-100 rounded-xl px-6 py-3 font-medium text-gray-400 flex items-center cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    نمرات
                                    <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-0.5 rounded-full">بزودی</span>
                                </div>
                            </div>

                            <!-- تب نظرسنجی (غیرفعال) -->
                            <div class="relative">
                                <div class="tab-item bg-gray-100 rounded-xl px-6 py-3 font-medium text-gray-400 flex items-center cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    نظرسنجی
                                    <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-0.5 rounded-full">بزودی</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- محتوای اصلی -->
                <div class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 py-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- لیست جلسات -->
                        <template x-if="loading">
                            <div class="lg:col-span-2 space-y-5">
                                <div class="bg-white rounded-2xl shadow-sm p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <!-- اسکلتون عنوان با انیمیشن -->
                                        <div class="skeleton skeleton-header w-48 h-7 rounded-lg"></div>
                                        <!-- اسکلتون فیلتر (اختیاری) -->
                                        <div class="skeleton skeleton-button w-24 h-8 rounded-lg"></div>
                                    </div>

                                    <!-- کارت جلسات با اسکرول -->
                                    <div class="sessions-list space-y-4">
                                        <!-- اسکلتون جلسات -->
                                        <template x-for="i in 3" :key="i">
                                            <div class="session-card bg-white border border-gray-200 rounded-xl p-5 animate-pulse">
                                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                                    <div class="flex items-start gap-4">
                                                        <!-- اسکلتون آیکون دایره‌ای -->
                                                        <div class="skeleton skeleton-circle w-12 h-12 rounded-xl"></div>

                                                        <div class="flex-1 space-y-3">
                                                            <!-- اسکلتون عنوان جلسه -->
                                                            <div class="skeleton skeleton-text w-40 h-6 rounded"></div>

                                                            <!-- اسکلتون اطلاعات تاریخ و زمان -->
                                                            <div class="flex items-center space-x-2 space-x-reverse">
                                                                <div class="skeleton skeleton-circle w-4 h-4"></div>
                                                                <div class="skeleton skeleton-text w-56 h-4 rounded"></div>
                                                            </div>

                                                            <!-- اسکلتون badge وضعیت -->
                                                            <div class="skeleton skeleton-text w-24 h-6 rounded-full"></div>
                                                        </div>
                                                    </div>

                                                    <!-- اسکلتون دکمه مشاهده جزئیات -->
                                                    <div class="flex items-center gap-2 self-start md:self-center">
                                                        <div class="skeleton skeleton-circle w-5 h-5"></div>
                                                        <div class="skeleton skeleton-button w-32 h-10 rounded-lg"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="!loading && courseData">
                            <div class="lg:col-span-2 space-y-5">
                                <div class="bg-white rounded-2xl shadow-sm p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <h2 class="text-xl font-bold text-gray-800">لیست جلسات دوره</h2>
                                    </div>

                                    <!-- کارت جلسات با اسکرول -->
                                    <div class="sessions-list space-y-4">

                                        <template x-if="sortedAttends.length === 0">
                                            <!-- حالت خالی -->
                                            <div class="text-center py-12">
                                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <h3 class="text-lg font-medium text-gray-900 mb-2">هیچ جلسه‌ای یافت نشد</h3>
                                                <p class="text-gray-500">جلسات این دوره هنوز ثبت نشده است.</p>
                                            </div>
                                        </template>

                                        <template x-if="sortedAttends.length > 0">
                                            <!-- لیست جلسات واقعی -->
                                            <template x-for="(attend, index) in sortedAttends" :key="attend.id">
                                                <div class="session-card bg-white border border-gray-200 rounded-xl p-5 hover:border-purple-200 hover:shadow-md cursor-pointer"
                                                     :data-session-id="attend.id"
                                                     @click="openSessionModal(attend.id)">
                                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                                        <div class="flex items-start gap-4">
                                                            <div :class="`bg-${getStatusClass(attend.attend_status_id).color}-100 text-${getStatusClass(attend.attend_status_id).color}-600 rounded-lg p-3 flex items-center justify-center`">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                </svg>
                                                            </div>
                                                            <div>
                                                                <h3 class="font-bold text-gray-800" x-text="`جلسه ${sortedAttends.length - index}`"></h3>
                                                                <div class="flex items-center mt-2 text-sm text-gray-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                    <span x-text="`${formatDate(attend.date)} • ${formatTime(attend.time, attend.duration)}`"></span>
                                                                </div>
                                                                <div class="mt-2">
                                                        <span :class="`inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border ${getStatusClass(attend.attend_status_id).classes}`">
                                                            <span x-html="getStatusClass(attend.attend_status_id).icon"></span>
                                                            <span x-text="attend.status.ststitle"></span>
                                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center self-start md:self-center relative">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            مشاهده جزئیات
                                                            <template x-if="attend.readComment === 0 && attend.comment != null">
                                                    <span class="absolute -top-1 -right-1 flex items-center justify-center">
                                                        <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-red-400 opacity-75"></span>
                                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                                    </span>
                                                            </template>
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>


                        <!-- سایدبار -->
                        <div class="sidebar_section">
                            <template x-if="loading">
                                <!-- اسکلتون سایدبار -->
                                <div class="space-y-6">
                                    <div class="bg-white rounded-2xl shadow-sm p-6">
                                        <div class="skeleton skeleton-header w-32 mb-4"></div>
                                        <div class="space-y-4">
                                            <template x-for="i in 4" :key="i">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <div class="skeleton skeleton-circle w-3 h-3 ml-2"></div>
                                                        <div class="skeleton skeleton-text w-16"></div>
                                                    </div>
                                                    <div class="skeleton skeleton-text w-8"></div>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="skeleton skeleton-text mt-6"></div>
                                    </div>

                                    <div class="bg-white rounded-2xl shadow-sm p-6">
                                        <div class="skeleton skeleton-header w-32 mb-4"></div>
                                        <div class="space-y-4">
                                            <template x-for="i in 2" :key="i">
                                                <div class="flex items-center justify-between">
                                                    <div class="skeleton skeleton-text w-16"></div>
                                                    <div class="flex">
                                                        <template x-for="j in 5" :key="j">
                                                            <div class="skeleton skeleton-circle w-4 h-4 ml-1"></div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="skeleton skeleton-text mt-6 h-20"></div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="!loading && courseData">
                                <!-- محتوای واقعی سایدبار -->
                                <!-- خلاصه وضعیت -->
                                <div class="bg-white rounded-2xl shadow-sm p-6">
                                    <h2 class="text-lg font-bold text-gray-800 mb-4">وضعیت حضور و غیاب</h2>
                                    <div class="space-y-4 mb-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-green-500 ml-2"></div>
                                                <span class="text-sm text-gray-600">حاضر</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-800" x-text="presentSessions"></span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-yellow-500 ml-2"></div>
                                                <span class="text-sm text-gray-600">غیبت موجه</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-800" x-text="exAbsentSessions"></span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-orange-500 ml-2"></div>
                                                <span class="text-sm text-gray-600">غیبت غیرموجه</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-800" x-text="absentSessions"></span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-purple-500 ml-2"></div>
                                                <span class="text-sm text-gray-600">تعداد کل جلسات</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-800" x-text="totalSessions"></span>
                                        </div>

                                        <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-blue-500 ml-2"></div>
                                                <span class="text-sm font-medium text-gray-700">درصد حضور</span>
                                            </div>
                                            <span class="text-sm font-semibold text-blue-600" x-text="`${attendanceRate}%`"></span>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-green-400 to-blue-500 h-3 rounded-full transition-all duration-700" :style="`width: ${attendanceRate}%`"></div>
                                    </div>
                                </div>

                                <!-- میانگین نمرات -->
                                <div class="bg-white rounded-2xl shadow-sm p-6">
                                    <h2 class="text-lg font-bold text-gray-800 mb-4">میانگین نمرات</h2>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">نمره کل</span>
                                            <div class="flex" x-html="renderStars(averageGrade)"></div>
                                        </div>
                                        <template x-if="bestGrade !== null">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-600">بهترین نمره</span>
                                                <div class="flex" x-html="renderStars(bestGrade)"></div>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="mt-6 bg-purple-100 text-purple-800 rounded-lg p-4 text-center">
                                        <p class="text-sm" x-text="`شما ${gradePercentage}% از کل نمره ممکن را کسب کرده‌اید`"></p>
                                        <div class="mt-2 bg-white rounded-full h-3">
                                            <div class="bg-purple-600 h-3 rounded-full" :style="`width: ${gradePercentage}%`"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- مودال جزئیات جلسه -->
                <div id="sessionModal" class="modal-overlay" :class="{ 'active': modalOpen }" @click="closeModal" x-show="modalOpen" x-transition>
                    <div class="modal-container" @click.stop>
                        <div class="modal-header">
                            <h3 class="text-xl font-bold text-gray-800" x-text="`جزئیات جلسه ${modalSessionNumber}`"></h3>
                            <button class="modal-close" @click="closeModal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <template x-if="modalSessionData">
                                <div>
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
                                                        <p class="font-medium text-gray-800" x-text="formatDate(modalSessionData.date)"></p>
                                                    </div>
                                                </div>
                                                <div class="flex items-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-sm text-gray-500">ساعت برگزاری</p>
                                                        <p class="font-medium text-gray-800" x-text="formatTime(modalSessionData.time, modalSessionData.duration)"></p>
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
                                                                <img :src="courseData.course.teacher.image" :alt="`${courseData.course.teacher.name} ${courseData.course.teacher.family}`" class="w-full h-full object-cover">
                                                            </div>
                                                            <span class="mr-2 text-sm font-medium text-gray-800" x-text="`استاد ${courseData.course.teacher.name} ${courseData.course.teacher.family}`"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <template x-if="modalSessionData.grade !== null">
                                                    <div class="flex items-start">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <div>
                                                            <p class="text-sm text-gray-500">نمره کسب شده</p>
                                                            <div class="flex items-center justify-center gap-2">
                                                                <div class="flex" x-html="renderStars(modalSessionData.grade)"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- حضور و غیاب -->
                                        <div class="bg-gray-50 rounded-xl p-5">
                                            <h3 class="font-medium text-gray-800 mb-4">وضعیت حضور و غیاب</h3>
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white overflow-hidden">
                                                        <img :src="courseData.student.image" alt="هنرجو" class="w-full h-full object-cover">
                                                    </div>
                                                    <span class="mr-2 text-sm font-medium text-gray-800">شما</span>
                                                </div>
                                                <span :class="`inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border ${getStatusClass(modalSessionData.attend_status_id).classes}`">
                                        <span x-html="getStatusClass(modalSessionData.attend_status_id).icon"></span>
                                        <span x-text="modalSessionData.status.ststitle"></span>
                                    </span>
                                            </div>
                                            <div class="text-sm text-gray-600 mb-4">
                                                <p x-text="modalSessionData.status.stsdisc"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <template x-if="modalSessionData.comment">
                                        <!-- کامنت استاد -->
                                        <div class="mt-6">
                                            <h3 class="font-medium text-gray-800 mb-4">نظر استاد درباره این جلسه</h3>
                                            <div class="comment-box bg-blue-50 border border-blue-100 rounded-xl p-4 md:p-5">
                                                <div class="flex flex-col sm:flex-row items-start gap-3">
                                                    <div class="w-10 h-10 rounded-full bg-blue-100 border-2 border-white overflow-hidden flex-shrink-0">
                                                        <img :src="courseData.course.teacher.image" :alt="`${courseData.course.teacher.name} ${courseData.course.teacher.family}`" class="w-full h-full object-cover">
                                                    </div>
                                                    <div class="w-full">
                                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-medium text-gray-800" x-text="`استاد ${courseData.course.teacher.name} ${courseData.course.teacher.family}`"></span>
                                                                <div class="flex" x-html="renderStars(modalSessionData.grade)"></div>
                                                            </div>
                                                        </div>
                                                        <p class="mt-2 text-gray-700 text-sm leading-relaxed" x-text="modalSessionData.comment"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                    <template x-if="modalSessionData.sylabes">
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
                                                            <p class="font-medium text-gray-800 text-sm">سیلابس جلسه</p>
                                                            <p class="text-xs text-gray-500 mt-1">PDF</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-end mt-3">
                                                        <a :href="modalSessionData.sylabes" class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center" download>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                            </svg>
                                                            دانلود
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template x-if="type == 1">
            <div>
                <!-- هدر دوره -->
                <div class="course-header text-white pb-12 pt-8  px-4 md:px-8 lg:px-12">
                    <div class="max-w-6xl mx-auto">
                        <template x-if="loading">
                            <!-- اسکلتون هدر -->
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                                <div class="flex items-start gap-4">
                                    <div class="skeleton skeleton-circle"></div>
                                    <div class="flex-1">
                                        <div class="skeleton skeleton-header w-64"></div>
                                        <div class="skeleton skeleton-text w-48"></div>
                                        <div class="flex items-center mt-4">
                                            <div class="skeleton skeleton-circle w-8 h-8"></div>
                                            <div class="skeleton skeleton-text mr-2 w-32"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="skeleton skeleton-button self-start"></div>
                            </div>
                        </template>

                        <template x-if="!loading && courseData">
                            <!-- محتوای واقعی هدر -->
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                                <div class="flex items-start gap-4">
                                    <div class="bg-white/30 backdrop-blur-sm rounded-xl p-1 flex items-center justify-center">
                                        <img width="60px" height="60px" :src="courseData.title.coCover ? mainFrontServerUrl + '/' + courseData.title.coCover : '/images/default-course.jpg'"
                                             :alt="courseData.title.coTitle" class="min-w-[60px] min-h-[60px] rounded-xl object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h1 class="text-2xl md:text-3xl font-bold mb-2" x-text="courseData.title.coTitle"></h1>
                                        <p class="text-sm md:text-base leading-relaxed" x-text="`${courseData.timeDur} دقیقه هر جلسه`"></p>
                                        <div class="flex items-center mt-4">
                                            <div class="w-8 h-8 rounded-full bg-white/20 overflow-hidden mr-3">
                                                <img :src="courseData.teacher.image" :alt="`${courseData.teacher.name} ${courseData.teacher.family}`" class="w-full h-full object-cover">
                                            </div>
                                            <span class="mr-2 text-sm text-white/90" x-text="`استاد ${courseData.teacher.name} ${courseData.teacher.family}`"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-1.5 self-start">
                                    <p class="text-xs text-center">وضعیت: <span :class="`font-bold text-${courseData.active ? 'green' : 'red'}-300`" x-text="courseData.active ? 'فعال' : 'غیرفعال'"></span></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- تب‌های صفحه -->
                <div class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 -mt-10">
                    <div class="flex pb-2 scrollbar-hide">
                        <div class="tab_section flex space-x-3 overflow-y-scroll space-x-reverse pt-3 pr-2">
                            <!-- تب محتوای دوره -->
                            <div class="relative">
                                <div class="tab-item bg-gray-100 rounded-xl px-6 py-3 font-medium text-gray-400 flex items-center cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    محتوای دوره
                                    <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-0.5 rounded-full">بزودی</span>
                                </div>
                            </div>

                            <!-- تب جلسات (فعال) -->
                            <a href="#" class="tab-item active bg-purple-600 text-white rounded-xl px-6 py-3 font-medium shadow-md hover:shadow-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                جلسات
                            </a>

                            <!-- تب نمرات (غیرفعال) -->
                            <div class="relative">
                                <div class="tab-item bg-gray-100 rounded-xl px-6 py-3 font-medium text-gray-400 flex items-center cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    نمرات
                                    <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-0.5 rounded-full">بزودی</span>
                                </div>
                            </div>

                            <!-- تب نظرسنجی (غیرفعال) -->
                            <div class="relative">
                                <div class="tab-item bg-gray-100 rounded-xl px-6 py-3 font-medium text-gray-400 flex items-center cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    نظرسنجی
                                    <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-0.5 rounded-full">بزودی</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- اسلایدر دانشجویان -->
                <div class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 py-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-800">هنرجویان این دوره</h2>
                            <div class="flex items-center gap-1 text-sm text-gray-500">
                                <span>برای مشاهده بیشتر بکشید</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                        </div>

                        <template x-if="loading">
                            <!-- اسکلتون اسلایدر -->
                            <div class="flex space-x-6 overflow-x-auto pb-4 scrollbar-hide">
                                <template x-for="i in 6" :key="i">
                                    <div class="flex-shrink-0 w-24 text-center animate-pulse">
                                        <div class="skeleton skeleton-circle w-20 h-20 mx-auto rounded-full mb-3"></div>
                                        <div class="skeleton skeleton-text w-16 h-4 mx-auto rounded"></div>
                                        <div class="skeleton skeleton-text w-20 h-3 mx-auto rounded mt-1"></div>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <template x-if="!loading && studentData && studentData.length > 0">
                            <!-- اسلایدر ساده -->
                            <div class="relative">
                                <div class="overflow-x-auto scrollbar-hide pb-4">
                                    <div class="flex space-x-6 min-w-max">
                                        <template x-for="(student, index) in studentData" :key="student.id">
                                            <div class="flex-shrink-0 w-24 text-center cursor-pointer group"
                                                 @click="goCourseFilter('students', student.id)">

                                                <!-- عکس دانشجو -->
                                                <div class="relative mb-3 mx-auto">
                                                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-400 to-blue-500 p-1 group-hover:from-purple-500 group-hover:to-blue-600 transition-all duration-300 shadow-lg">
                                                        <img :src="student.image || '/images/default-avatar.jpg'"
                                                             :alt="`${student.name} ${student.family}`"
                                                             class="w-full h-full rounded-full object-cover border-2 border-white shadow-sm">
                                                    </div>
                                                    <!-- افکت هنگام هاور -->
                                                    <div class="absolute inset-0 rounded-full bg-purple-400 opacity-0 group-hover:opacity-20 transition-all duration-300 -z-10"></div>
                                                </div>

                                                <!-- نام و نام خانوادگی -->
                                                <div class="student-info">
                                                    <h3 class="font-semibold text-gray-800 text-sm group-hover:text-purple-600 transition-colors duration-300"
                                                        x-text="student.name"></h3>
                                                    <p class="text-xs text-gray-500 mt-1 truncate"
                                                       x-text="student.family"></p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- خط نشانگر -->
                                <div class="w-24 h-1 bg-gradient-to-r from-purple-400 to-blue-500 rounded-full mx-auto mt-2 opacity-60"></div>
                            </div>
                        </template>

                        <template x-if="!loading && (!studentData || studentData.length === 0)">
                            <!-- حالت خالی -->
                            <div class="text-center py-8">
                                <div class="bg-gradient-to-r from-purple-100 to-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">هنوز هنرجویی ثبت نام نکرده است</h3>
                                <p class="text-gray-500">هنرجویان این دوره در اینجا نمایش داده خواهند شد.</p>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- محتوای اصلی -->
                <div class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 py-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- لیست جلسات -->
                        <template x-if="loading">
                            <div class="lg:col-span-2 space-y-5">
                                <div class="bg-white rounded-2xl shadow-sm p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <!-- اسکلتون عنوان با انیمیشن -->
                                        <div class="skeleton skeleton-header w-48 h-7 rounded-lg"></div>
                                        <!-- اسکلتون فیلتر (اختیاری) -->
                                        <div class="skeleton skeleton-button w-24 h-8 rounded-lg"></div>
                                    </div>

                                    <!-- کارت جلسات با اسکرول -->
                                    <div class="sessions-list space-y-4">
                                        <!-- اسکلتون جلسات -->
                                        <template x-for="i in 3" :key="i">
                                            <div class="session-card bg-white border border-gray-200 rounded-xl p-5 animate-pulse">
                                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                                    <div class="flex items-start gap-4">
                                                        <!-- اسکلتون آیکون دایره‌ای -->
                                                        <div class="skeleton skeleton-circle w-12 h-12 rounded-xl"></div>

                                                        <div class="flex-1 space-y-3">
                                                            <!-- اسکلتون عنوان جلسه -->
                                                            <div class="skeleton skeleton-text w-40 h-6 rounded"></div>

                                                            <!-- اسکلتون اطلاعات تاریخ و زمان -->
                                                            <div class="flex items-center space-x-2 space-x-reverse">
                                                                <div class="skeleton skeleton-circle w-4 h-4"></div>
                                                                <div class="skeleton skeleton-text w-56 h-4 rounded"></div>
                                                            </div>

                                                            <!-- اسکلتون badge وضعیت -->
                                                            <div class="skeleton skeleton-text w-24 h-6 rounded-full"></div>
                                                        </div>
                                                    </div>

                                                    <!-- اسکلتون دکمه مشاهده جزئیات -->
                                                    <div class="flex items-center gap-2 self-start md:self-center">
                                                        <div class="skeleton skeleton-circle w-5 h-5"></div>
                                                        <div class="skeleton skeleton-button w-32 h-10 rounded-lg"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="!loading && courseData">
                            <div class="lg:col-span-2 space-y-5">
                                <div class="bg-white rounded-2xl shadow-sm p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <h2 class="text-xl font-bold text-gray-800">لیست جلسات دوره</h2>
                                        <a @click="goCourseFilter('courses')" class="text-lg font-bold text-blue-800 cursor-pointer">مشاهده همه</a>
                                    </div>

                                    <!-- کارت جلسات با اسکرول -->
                                    <div class="sessions-list space-y-4">

                                        <template x-if="sortedAttends.length === 0">
                                            <!-- حالت خالی -->
                                            <div class="text-center py-12">
                                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <h3 class="text-lg font-medium text-gray-900 mb-2">هیچ جلسه‌ای یافت نشد</h3>
                                                <p class="text-gray-500">جلسات این دوره هنوز ثبت نشده است.</p>
                                            </div>
                                        </template>

                                        <template x-if="sortedAttends.length > 0">
                                            <!-- لیست جلسات واقعی -->
                                            <template x-for="(attend, index) in sortedAttends" :key="attend.id">
                                                <div class="session-card bg-white border border-gray-200 rounded-xl p-5 hover:border-purple-200 hover:shadow-md cursor-pointer"
                                                     :data-session-id="attend.id"
                                                     @click="openSessionModal(attend.id)">
                                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                                        <div class="flex items-start gap-4">
                                                            <div :class="`bg-${getStatusClass(attend.attend_status_id).color}-100 text-${getStatusClass(attend.attend_status_id).color}-600 rounded-lg p-3 flex items-center justify-center`">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                </svg>
                                                            </div>
                                                            <div>
                                                                <h3 class="font-bold text-gray-800" x-text="`جلسه ${sortedAttends.length - index}`"></h3>
                                                                <div class="flex items-center mt-2 text-sm text-gray-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                    <span x-text="`${formatDate(attend.date)} • ${formatTime(attend.time, attend.duration)}`"></span>
                                                                </div>
                                                                <div class="mt-2">
                                                        <span :class="`inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border ${getStatusClass(attend.attend_status_id).classes}`">
                                                            <span x-html="getStatusClass(attend.attend_status_id).icon"></span>
                                                            <span x-text="attend.status.ststitle"></span>
                                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center self-start md:self-center relative">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            مشاهده جزئیات
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>


                        <!-- سایدبار -->
                        <div class="sidebar_section">
                            <template x-if="loading">
                                <!-- اسکلتون سایدبار -->
                                <div class="space-y-6">
                                    <div class="bg-white rounded-2xl shadow-sm p-6">
                                        <div class="skeleton skeleton-header w-32 mb-4"></div>
                                        <div class="space-y-4">
                                            <template x-for="i in 4" :key="i">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <div class="skeleton skeleton-circle w-3 h-3 ml-2"></div>
                                                        <div class="skeleton skeleton-text w-16"></div>
                                                    </div>
                                                    <div class="skeleton skeleton-text w-8"></div>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="skeleton skeleton-text mt-6"></div>
                                    </div>

                                    <div class="bg-white rounded-2xl shadow-sm p-6">
                                        <div class="skeleton skeleton-header w-32 mb-4"></div>
                                        <div class="space-y-4">
                                            <template x-for="i in 2" :key="i">
                                                <div class="flex items-center justify-between">
                                                    <div class="skeleton skeleton-text w-16"></div>
                                                    <div class="flex">
                                                        <template x-for="j in 5" :key="j">
                                                            <div class="skeleton skeleton-circle w-4 h-4 ml-1"></div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="skeleton skeleton-text mt-6 h-20"></div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="!loading && courseData">
                                <!-- محتوای واقعی سایدبار -->
                                <!-- خلاصه وضعیت -->
                                <div class="bg-white rounded-2xl shadow-sm p-6">
                                    <h2 class="text-lg font-bold text-gray-800 mb-4">وضعیت حضور و غیاب</h2>
                                    <div class="space-y-4 mb-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-green-500 ml-2"></div>
                                                <span class="text-sm text-gray-600">حاضر</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-800" x-text="presentSessions"></span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-yellow-500 ml-2"></div>
                                                <span class="text-sm text-gray-600">غیبت موجه</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-800" x-text="exAbsentSessions"></span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-orange-500 ml-2"></div>
                                                <span class="text-sm text-gray-600">غیبت غیرموجه</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-800" x-text="absentSessions"></span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-purple-500 ml-2"></div>
                                                <span class="text-sm text-gray-600">تعداد کل جلسات</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-800" x-text="totalSessions"></span>
                                        </div>

                                        <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 rounded-full bg-blue-500 ml-2"></div>
                                                <span class="text-sm font-medium text-gray-700">درصد حضور</span>
                                            </div>
                                            <span class="text-sm font-semibold text-blue-600" x-text="`${attendanceRate}%`"></span>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-green-400 to-blue-500 h-3 rounded-full transition-all duration-700" :style="`width: ${attendanceRate}%`"></div>
                                    </div>
                                </div>

                                <!-- میانگین نمرات -->
                                <div class="bg-white rounded-2xl shadow-sm p-6">
                                    <h2 class="text-lg font-bold text-gray-800 mb-4">میانگین نمرات</h2>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">نمره کل</span>
                                            <div class="flex" x-html="renderStars(averageGrade)"></div>
                                        </div>
                                        <template x-if="bestGrade !== null">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-600">بهترین نمره</span>
                                                <div class="flex" x-html="renderStars(bestGrade)"></div>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="mt-6 bg-purple-100 text-purple-800 rounded-lg p-4 text-center">
                                        <p class="text-sm" x-text="`شما ${gradePercentage}% از کل نمره ممکن را کسب کرده‌اید`"></p>
                                        <div class="mt-2 bg-white rounded-full h-3">
                                            <div class="bg-purple-600 h-3 rounded-full" :style="`width: ${gradePercentage}%`"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- مودال جزئیات جلسه -->
                <div id="sessionModal" class="modal-overlay" :class="{ 'active': modalOpen }" @click="closeModal" x-show="modalOpen" x-transition>
                    <div class="modal-container mt-10 mb-16" @click.stop>
                        <div class="modal-header">
                            <h3 class="text-xl font-bold text-gray-800" x-text="`جزئیات جلسه ${modalSessionNumber}`"></h3>
                            <button class="modal-close" @click="closeModal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <template x-if="modalSessionData">
                                <div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- اطلاعات اصلی جلسه -->
                                        <div class="bg-gray-50 rounded-xl p-5">
                                            <h3 class="font-medium text-gray-800 mb-4">اطلاعات جلسه</h3>
                                            <div class="space-y-4">
                                                <div class="flex items-start">
                                                    <i class="fas fa-calendar-day ml-2 text-purple-600 mt-0.5"></i>
                                                    <div>
                                                        <p class="text-sm text-gray-500">تاریخ برگزاری</p>
                                                        <p class="font-medium text-gray-800" x-text="formatDate(modalSessionData.date)"></p>
                                                    </div>
                                                </div>
                                                <div class="flex items-start">
                                                    <i class="fas fa-clock ml-2 text-purple-600 mt-0.5"></i>
                                                    <div>
                                                        <p class="text-sm text-gray-500">ساعت برگزاری</p>
                                                        <p class="font-medium text-gray-800" x-text="formatTime(modalSessionData.time, modalSessionData.duration)"></p>
                                                    </div>
                                                </div>
                                                <template x-if="modalSessionData.grade !== null">
                                                    <div class="flex items-start">
                                                        <i class="fas fa-star ml-2 text-purple-600 mt-0.5"></i>
                                                        <div>
                                                            <p class="text-sm text-gray-500">نمره کسب شده</p>
                                                            <div class="flex items-center justify-center gap-2">
                                                                <div class="flex" x-html="renderStars(modalSessionData.grade)"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- حضور و غیاب -->
                                        <div class="bg-gray-50 rounded-xl p-5">
                                            <h3 class="font-medium text-gray-800 mb-4">وضعیت حضور و غیاب</h3>
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white overflow-hidden">
                                                        <img :src="modalSessionData.student.image" alt="هنرجو" class="w-full h-full object-cover">
                                                    </div>
                                                    <span class="mr-2 text-sm font-medium text-gray-800" x-text="modalSessionData.student.name + ' ' + modalSessionData.student.family"></span>
                                                </div>
                                                <span :class="`inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border ${getStatusInfo(modalSessionData.attend_status_id).classes}`">
                                            <span x-html="getStatusInfo(modalSessionData.attend_status_id).icon"></span>
                                            <span x-text="getStatusInfo(modalSessionData.attend_status_id).ststitle"></span>
                                        </span>
                                            </div>
                                            <div class="text-sm text-gray-600 mb-4">
                                                <p x-text="getStatusInfo(modalSessionData.attend_status_id).stsdisc"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <template x-if="modalSessionData.comment">
                                        <!-- کامنت استاد -->
                                        <div class="mt-6">
                                            <h3 class="font-medium text-gray-800 mb-4">نظر استاد درباره این جلسه</h3>
                                            <div class="comment-box bg-blue-50 border border-blue-100 rounded-xl p-4 md:p-5">
                                                <div class="flex flex-col sm:flex-row items-start gap-3">
                                                    <div class="w-10 h-10 rounded-full bg-blue-100 border-2 border-white overflow-hidden flex-shrink-0">
                                                        <img :src="courseData.teacher.image" :alt="`${courseData.teacher.name} ${courseData.teacher.family}`" class="w-full h-full object-cover">
                                                    </div>
                                                    <div class="w-full">
                                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-medium text-gray-800" x-text="`استاد ${courseData.teacher.name} ${courseData.teacher.family}`"></span>
                                                                <div class="flex" x-html="renderStars(modalSessionData.grade)"></div>
                                                            </div>
                                                        </div>
                                                        <p class="mt-2 text-gray-700 text-sm leading-relaxed" x-text="modalSessionData.comment"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                    <template x-if="!modalSessionData.comment">
                                        <!-- باکس ثبت کامنت توسط استاد -->
                                        <div class="mt-6">
                                            <h3 class="font-medium text-gray-800 mb-4">ثبت نظر برای این جلسه</h3>
                                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-5 md:p-6">
                                                <div class="flex flex-col sm:flex-row items-start gap-4">
                                                    <!-- آواتار استاد -->
                                                    <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white text-sm font-medium shadow-lg flex-shrink-0 overflow-hidden">
                                                        <template x-if="courseData.teacher.image">
                                                            <img :src="courseData.teacher.image" :alt="`${courseData.teacher.name} ${courseData.teacher.family}`" class="w-full h-full object-cover">
                                                        </template>
                                                        <template x-if="!courseData.teacher.image">
                                                            <span x-text="(courseData.teacher.name?.charAt(0) || 'ا') + (courseData.teacher.family?.charAt(0) || 'س')"></span>
                                                        </template>
                                                    </div>

                                                    <!-- فرم ثبت کامنت -->
                                                    <div class="flex-1 w-full">
                                                        <div class="flex items-center gap-3 mb-4">
                                                            <span class="font-semibold text-gray-800" x-text="`استاد ${courseData.teacher.name} ${courseData.teacher.family}`"></span>
                                                            <div class="flex items-center gap-1 text-amber-500">
                                                                <span class="text-sm text-gray-600 ml-2">امتیاز:</span>
                                                                <template x-for="i in 5" :key="i">
                                                                    <button
                                                                        @click="setGrade(i)"
                                                                        class="transition-transform hover:scale-110 focus:outline-none"
                                                                        :class="{'text-amber-500': i <= currentGrade, 'text-gray-300': i > currentGrade}">
                                                                        <i class="fas fa-star text-lg"></i>
                                                                    </button>
                                                                </template>
                                                            </div>
                                                        </div>

                                                        <!-- فیلد متن کامنت -->
                                                        <div class="mb-4">
                        <textarea
                            x-model="newComment"
                            placeholder="نظر خود را درباره این جلسه و عملکرد هنرجو بنویسید..."
                            class="w-full h-32 bg-white border border-gray-300 rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 resize-none"
                            :class="{'border-red-300': commentError}"
                        ></textarea>
                                                            <p x-show="commentError" class="text-red-500 text-xs mt-2" x-text="commentError"></p>
                                                        </div>

                                                        <!-- آپلود فایل سیلابس -->
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                                <i class="fas fa-file-upload ml-2 text-indigo-500"></i>
                                                                آپلود سیلابس جلسه (اختیاری)
                                                            </label>
                                                            <div class="flex items-center gap-3">
                                                                <input
                                                                    type="file"
                                                                    x-ref="sylabesFile"
                                                                    @change="handleFileSelect"
                                                                    accept=".pdf,.doc,.docx,.jpg,.png"
                                                                    class="hidden"
                                                                >
                                                                <button
                                                                    @click="$refs.sylabesFile.click()"
                                                                    class="flex items-center gap-2 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition-all duration-200"
                                                                >
                                                                    <i class="fas fa-paperclip"></i>
                                                                    <span>انتخاب فایل</span>
                                                                </button>
                                                                <span x-show="selectedFileName" class="text-sm text-gray-600" x-text="selectedFileName"></span>
                                                                <button
                                                                    x-show="selectedFileName"
                                                                    @click="clearFile()"
                                                                    class="text-red-500 hover:text-red-700 transition-colors"
                                                                >
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                            <p class="text-xs text-gray-500 mt-2">فرمت‌های مجاز: PDF, Word, JPG, PNG (حداکثر 5MB)</p>
                                                        </div>

                                                        <!-- دکمه‌های اقدام -->
                                                        <div class="flex flex-col sm:flex-row gap-3 justify-end">
                                                            <button
                                                                @click="clearCommentForm()"
                                                                class="px-6 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 flex items-center justify-center gap-2"
                                                            >
                                                                <i class="fas fa-times"></i>
                                                                <span>انصراف</span>
                                                            </button>
                                                            <button
                                                                @click="submitComment()"
                                                                :disabled="submittingComment"
                                                                class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                                                            >
                                                                <i class="fas fa-paper-plane" :class="{'animate-pulse': submittingComment}"></i>
                                                                <span x-text="submittingComment ? 'در حال ارسال...' : 'ثبت نظر'"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- نمونه کامنت‌های قبلی (راهنما) -->
                                            <div class="mt-4 bg-orange-50 border border-orange-200 rounded-xl p-4">
                                                <div class="flex items-start gap-3">
                                                    <i class="fas fa-lightbulb text-orange-500 text-lg mt-0.5"></i>
                                                    <div>
                                                        <h4 class="font-medium text-orange-800 text-sm mb-2">راهنمای ثبت نظر مؤثر:</h4>
                                                        <ul class="text-xs text-orange-700 space-y-1 list-disc list-inside">
                                                            <li>تمرین‌های انجام شده در جلسه را ذکر کنید</li>
                                                            <li>نقاط قوت و ضعف هنرجو را به طور مشخص بیان کنید</li>
                                                            <li>تمرین‌های جلسه بعد را مشخص کنید</li>
                                                            <li>از جملات مثبت و انگیزشی استفاده کنید</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                    <template x-if="modalSessionData.sylabes">
                                        <!-- فایل‌های ضمیمه -->
                                        <div class="mt-8">
                                            <h3 class="font-medium text-gray-800 mb-4">فایل‌های ضمیمه این جلسه</h3>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div class="attachment-card bg-white border border-gray-200 rounded-xl p-4 hover:border-purple-200">
                                                    <div class="flex items-center gap-3">
                                                        <div class="bg-purple-100 text-purple-800 rounded-lg p-2 flex items-center justify-center">
                                                            <i class="fas fa-file-pdf text-lg"></i>
                                                        </div>
                                                        <div>
                                                            <p class="font-medium text-gray-800 text-sm">سیلابس جلسه</p>
                                                            <p class="text-xs text-gray-500 mt-1">PDF</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-end mt-3">
                                                        <a :href="modalSessionData.sylabes" class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center" download>
                                                            <i class="fas fa-download ml-1"></i>
                                                            دانلود
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>




            </div>
        </template>
    </div>

    <script>

        function sessionsPage() {
            return {
                loading: true,
                type : null,
                courseData: null,
                studentData: null,
                modalOpen: false,
                modalSessionData: null,
                modalSessionNumber: 0,

                async init() {
                    await waitForCheckToken();
                    this.type = userType;
                    await this.fetchCourseData();
                },

                async fetchCourseData() {
                    try {
                        const response = await makeRequest('GET', 'fa', '{{ route("getCourseData", ["id" => request()->route("id")]) }}');

                        if (response.message === 'success') {
                            this.courseData = response.data.studentCourse;
                            this.studentData = response.data.students;
                        }
                    } catch (error) {
                        showToastAlert(error, 'error', 3000);
                    } finally {
                        this.loading = false;
                    }
                },

                get sortedAttends() {
                    if (!this.courseData || !this.courseData.attends) return [];
                    return [...this.courseData.attends].sort((a, b) => b.date - a.date);
                },

                get totalSessions() {
                    return this.courseData?.attends?.length || 0;
                },

                get presentSessions() {
                    return this.courseData?.attends?.filter(a => a.attend_status_id === 3).length || 0;
                },

                get absentSessions() {
                    return this.courseData?.attends?.filter(a => a.attend_status_id === 4).length || 0;
                },

                get exAbsentSessions() {
                    return this.courseData?.attends?.filter(a => a.attend_status_id === 7).length || 0;
                },

                get attendanceRate() {
                    return this.totalSessions > 0 ? Math.round((this.presentSessions / this.totalSessions) * 100) : 0;
                },

                get averageGrade() {
                    if (!this.courseData?.attends) return null;
                    const gradedAttends = this.courseData.attends.filter(a => a.grade !== null);
                    return gradedAttends.length > 0 ?
                        (gradedAttends.reduce((sum, a) => sum + a.grade, 0) / gradedAttends.length).toFixed(1) : null;
                },

                get bestGrade() {
                    if (!this.courseData?.attends) return null;
                    const gradedAttends = this.courseData.attends.filter(a => a.grade !== null);
                    return gradedAttends.length > 0 ? Math.max(...gradedAttends.map(a => a.grade)) : null;
                },

                get gradePercentage() {
                    if (!this.averageGrade || this.averageGrade <= 0) return 0;
                    const maxPossibleGrade = 20;
                    return Math.round((this.averageGrade / maxPossibleGrade) * 100);
                },

                async openSessionModal(sessionId) {
                    const sessionData = this.courseData.attends.find(a => a.id == sessionId);

                    if (!sessionData) {
                        showToastAlert({message: 'جلسه مورد نظر یافت نشد'}, 'error', 3000);
                        return;
                    }

                    if (userType === 2){
                        // علامت‌گذاری کامنت به عنوان خوانده شده
                        if (sessionData.readComment === 0 && sessionData.comment != null) {
                            try {
                                await makeRequest('POST', 'fa', '{{ route('readComment') }}/' + sessionId);
                            } catch (error) {
                                console.error('Error marking comment as read:', error);
                            }
                        }
                    }


                    this.modalSessionData = sessionData;
                    this.modalSessionNumber = this.sortedAttends.length - this.sortedAttends.findIndex(a => a.id === sessionId);
                    this.modalOpen = true;
                    document.body.style.overflow = 'hidden';
                },

                closeModal() {
                    this.modalOpen = false;
                    this.modalSessionData = null;
                    this.modalSessionNumber = null;
                },


                getStatusInfo(statusId) {
                    const statusData= {
                        1: {
                            ststitle: 'رزرو',
                            stsdisc: 'کلاس برای هنرجو در حالت رزرو قرار می‌گیرد',
                            classes: 'bg-gray-100 text-gray-800 border-gray-200',
                            icon: '<i class="fas fa-clock text-gray-600"></i>'
                        },
                        2: {
                            ststitle: 'در حال برگزاری',
                            stsdisc: 'کلاس در حال برگزاری است',
                            classes: 'bg-blue-100 text-blue-800 border-blue-200',
                            icon: '<i class="fas fa-music text-blue-600"></i>'
                        },
                        3: {
                            ststitle: 'برگزار',
                            stsdisc: 'کلاس برگزار شده است',
                            classes: 'bg-green-100 text-green-800 border-green-200',
                            icon: '<i class="fas fa-check-circle text-green-600"></i>'
                        },
                        4: {
                            ststitle: 'غیبت غیر موجه',
                            stsdisc: 'عدم برگزاری به دلیل غیبت هنرجو',
                            classes: 'bg-red-100 text-red-800 border-red-200',
                            icon: '<i class="fas fa-times-circle text-red-600"></i>'
                        },
                        5: {
                            ststitle: 'غیبت مدرس',
                            stsdisc: 'عدم برگزاری به دلیل غیبت مدرس',
                            classes: 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            icon: '<i class="fas fa-user-times text-yellow-600"></i>'
                        },
                        6: {
                            ststitle: 'تعطیل رسمی',
                            stsdisc: 'عدم برگزاری به دلیل تعطیلی رسمی',
                            classes: 'bg-red-100 text-red-800 border-red-200',
                            icon: '<i class="fas fa-umbrella-beach text-red-600"></i>'
                        },
                        7: {
                            ststitle: 'غیبت موجه',
                            stsdisc: 'غیبت مجاز توسط هنرجو',
                            classes: 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            icon: '<i class="fas fa-exclamation-triangle text-yellow-600"></i>'
                        }
                    };
                    return statusData[statusId] || {
                        ststitle: 'نامشخص',
                        stsdisc: 'وضعیت نامشخص',
                        classes: 'bg-gray-100 text-gray-800 border-gray-200',
                        icon: '❓'
                    };
                },


                newComment: '',
                currentGrade: 0,
                selectedFileName: '',
                submittingComment: false,
                commentError: '',

                setGrade(grade) {
                    this.currentGrade = grade;
                },

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (file) {
                        // بررسی حجم فایل (5MB)
                        if (file.size > 5 * 1024 * 1024) {
                            this.commentError = 'حجم فایل نباید بیشتر از 5 مگابایت باشد';
                            return;
                        }

                        // بررسی نوع فایل
                        const allowedTypes = ['application/pdf', 'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'image/jpeg', 'image/png'];
                        if (!allowedTypes.includes(file.type)) {
                            this.commentError = 'فرمت فایل مجاز نیست';
                            return;
                        }

                        this.selectedFileName = file.name;
                        this.commentError = '';
                    }
                },

                clearFile() {
                    this.selectedFileName = '';
                    this.$refs.sylabesFile.value = '';
                },

                clearCommentForm() {
                    this.newComment = '';
                    this.currentGrade = 0;
                    this.selectedFileName = '';
                    this.commentError = '';
                    this.clearFile();
                },

                async submitComment() {
                    // اعتبارسنجی
                    if (!this.newComment.trim()) {
                        this.commentError = 'لطفاً نظر خود را وارد کنید';
                        return;
                    }

                    if (this.newComment.trim().length < 10) {
                        this.commentError = 'نظر باید حداقل 10 کاراکتر باشد';
                        return;
                    }

                    this.submittingComment = true;
                    this.commentError = '';

                    try {
                        // آماده‌سازی داده‌ها برای ارسال
                        const formData = new FormData();
                        formData.append('comment', this.newComment.trim());
                        formData.append('grade', this.currentGrade);
                        formData.append('session_id', this.modalSessionData.id);

                        if (this.selectedFileName) {
                            formData.append('sylabes', this.$refs.sylabesFile.files[0]);
                        }

                        // ارسال به سرور
                        const response = await makeRequest('POST', 'fa', '{{ route('submitSessionComment') }}', formData, true);

                        // به‌روزرسانی داده‌ها
                        this.modalSessionData.comment = this.newComment;
                        this.modalSessionData.grade = this.currentGrade;
                        if (this.selectedFileName) {
                            this.modalSessionData.sylabes = response.data.sylabes_path;
                        }
                        this.clearCommentForm();
                        showToastAlert(response.message, 'success');
                    } catch (error) {
                        console.error('خطا در ثبت نظر:', error);
                        this.commentError = error.message || 'خطا در ارسال نظر';
                        showToastAlert('خطا در ثبت نظر', 'error', 3000);
                    } finally {
                        this.submittingComment = false;
                    }
                },

                formatDate(timestamp) {
                    const date = new Date(timestamp * 1000);
                    const persianDate = this.toJalali(date.getFullYear(), date.getMonth() + 1, date.getDate());
                    const dayNames = ['یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه', 'شنبه'];
                    const monthNames = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];

                    return `${dayNames[date.getDay()]} ${persianDate.day} ${monthNames[persianDate.month - 1]} ${persianDate.year}`;
                },

                formatTime(timeString, duration) {
                    if (!timeString) return 'زمان نامشخص';

                    const [hours, minutes] = timeString.split(':');
                    const startTimeInMinutes = parseInt(hours) * 60 + parseInt(minutes);
                    const endTimeInMinutes = startTimeInMinutes + duration;

                    const endHours = Math.floor(endTimeInMinutes / 60) % 24;
                    const endMinutes = endTimeInMinutes % 60;

                    return `${hours.padStart(2, '0')}:${minutes.padStart(2, '0')} - ${endHours.toString().padStart(2, '0')}:${endMinutes.toString().padStart(2, '0')}`;
                },

                toJalali(gy, gm, gd) {
                    let g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
                    let jy = (gy <= 1600) ? 0 : 979;
                    gy -= (gy <= 1600) ? 621 : 1600;
                    let gy2 = (gm > 2) ? (gy + 1) : gy;
                    let days = (365 * gy) + ((Math.floor((gy2 + 3) / 4)) - (Math.floor((gy2 + 99) / 100)) + (Math.floor((gy2 + 399) / 400))) - 80 + gd + g_d_m[gm - 1];
                    let jy2 = (days < 186) ? Math.floor(days / 31) : Math.floor((days - 6) / 30) + 6;
                    let r = (days < 186) ? (days % 31) : ((days - 6) % 30);
                    jy += 33 * Math.floor(jy2 / 12);
                    jy += jy2 % 12;
                    return { year: jy + 1, month: jy2 % 12 + 1, day: r + 1 };
                },

                getStatusClass(statusId) {
                    const statusClasses = {
                        3: { // حاضر/برگزار شده
                            color: 'green',
                            classes: 'bg-green-100 border-green-300 text-green-800',
                            icon: '<svg class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
                        },
                        5: { // غیبت مدرس
                            color: 'orange',
                            classes: 'bg-orange-100 border-orange-300 text-orange-800',
                            icon: '<svg class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>'
                        },
                        7: { // غیبت موجه هنرجو
                            color: 'yellow',
                            classes: 'bg-yellow-100 border-yellow-300 text-yellow-800',
                            icon: '<svg class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                        }
                    };

                    return statusClasses[statusId] || statusClasses[3];
                },

                renderStars(rating) {
                    if (!rating) return '';

                    let stars = '';
                    for (let i = 1; i <= 5; i++) {
                        if (i <= Math.floor(rating)) {
                            stars += '<svg class="w-4 h-4 text-yellow-400 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
                        } else if (i === Math.ceil(rating) && rating % 1 !== 0) {
                            stars += '<svg class="w-4 h-4 text-yellow-400 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
                        } else {
                            stars += '<svg class="w-4 h-4 text-gray-300 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
                        }
                    }
                    return stars;
                },

                goCourseFilter(filter,id = null){
                    if (filter === 'courses')
                        window.location.href = "{{ route('courseFilter') }}"+"?courses="+this.courseData.id;

                    if (filter === 'students')
                        window.location.href = "{{ route('courseFilter') }}"+"?courses="+this.courseData.id+"&students="+id;
                }
            };
        }
    </script>
</x-layouts.app>
