<x-layouts.app title="جلسات دوره">
    <!-- افزودن فونت ایران سنس -->
    {{--<link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSans.css">--}}

    <!-- استایل سفارشی -->
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
    </style>

    <div class="min-h-screen bg-gray-50 font-sans">
        <!-- هدر دوره (اسکلتون) -->
        <div class="course-header text-white pb-12 pt-8 px-4 md:px-8 lg:px-12">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 flex items-center justify-center skeleton-loading" style="width: 60px; height: 60px;"></div>
                        <div class="flex-1">
                            <div class="h-8 bg-white/20 rounded skeleton-loading mb-3 w-64"></div>
                            <div class="h-4 bg-white/20 rounded skeleton-loading mb-2 w-48"></div>
                            <div class="flex items-center mt-4">
                                <div class="w-8 h-8 rounded-full bg-white/20 skeleton-loading"></div>
                                <div class="h-4 bg-white/20 rounded mr-2 w-32 skeleton-loading"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-1.5 self-start skeleton-loading" style="width: 100px; height: 32px;"></div>
                </div>
            </div>
        </div>

        <!-- تب‌های صفحه -->
        <div class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 -mt-10">
            <div class="flex pb-2 scrollbar-hide">
                <div class="tab_section flex space-x-3 overflow-y-scroll space-x-reverse pt-3 pr-2">
                    <!-- تب محتوای دوره -->
                    <div class="relative">
                        <div class="tab-item bg-gray-100 rounded-xl px-6 py-3 font-medium text-gray-400 flex items-center cursor-not-allowed">
                            <div class="h-5 w-5 ml-2 bg-gray-300 rounded skeleton-loading"></div>
                            <div class="h-4 bg-gray-300 rounded w-20 skeleton-loading"></div>
                            <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-0.5 rounded-full">بزودی</span>
                        </div>
                    </div>

                    <!-- تب جلسات (فعال) -->
                    <div class="tab-item bg-purple-600 text-white rounded-xl px-6 py-3 font-medium shadow-md hover:shadow-lg flex items-center skeleton-loading" style="width: 100px;">
                        <div class="h-5 w-5 ml-2 bg-purple-400 rounded"></div>
                        <div class="h-4 bg-purple-400 rounded w-12"></div>
                    </div>

                    <!-- تب نمرات (غیرفعال) -->
                    <div class="relative">
                        <div class="tab-item bg-gray-100 rounded-xl px-6 py-3 font-medium text-gray-400 flex items-center cursor-not-allowed">
                            <div class="h-5 w-5 ml-2 bg-gray-300 rounded skeleton-loading"></div>
                            <div class="h-4 bg-gray-300 rounded w-16 skeleton-loading"></div>
                            <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-0.5 rounded-full">بزودی</span>
                        </div>
                    </div>

                    <!-- تب نظرسنجی (غیرفعال) -->
                    <div class="relative">
                        <div class="tab-item bg-gray-100 rounded-xl px-6 py-3 font-medium text-gray-400 flex items-center cursor-not-allowed">
                            <div class="h-5 w-5 ml-2 bg-gray-300 rounded skeleton-loading"></div>
                            <div class="h-4 bg-gray-300 rounded w-20 skeleton-loading"></div>
                            <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-0.5 rounded-full">بزودی</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- محتوای اصلی -->
        <div class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- لیست جلسات (اسکلتون) -->
                <div class="lg:col-span-2 space-y-5">
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6 session_header">
                            <div class="h-7 bg-gray-200 rounded skeleton-loading w-48"></div>
                        </div>

                        <!-- کارت جلسات با اسکرول -->
                        <div class="sessions-list space-y-4">
                            <!-- اسکلتون برای 3 جلسه -->
                            <div class="session-card bg-white border border-gray-200 rounded-xl p-5">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-gray-200 rounded-lg p-3 flex items-center justify-center skeleton-loading" style="width: 48px; height: 48px;"></div>
                                        <div class="flex-1">
                                            <div class="h-6 bg-gray-200 rounded skeleton-loading mb-2 w-40"></div>
                                            <div class="h-4 bg-gray-200 rounded skeleton-loading mb-3 w-56"></div>
                                            <div class="h-6 bg-gray-200 rounded skeleton-loading w-24"></div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-200 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium self-start md:self-center skeleton-loading" style="width: 140px; height: 40px;"></div>
                                </div>
                            </div>

                            <div class="session-card bg-white border border-gray-200 rounded-xl p-5">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-gray-200 rounded-lg p-3 flex items-center justify-center skeleton-loading" style="width: 48px; height: 48px;"></div>
                                        <div class="flex-1">
                                            <div class="h-6 bg-gray-200 rounded skeleton-loading mb-2 w-40"></div>
                                            <div class="h-4 bg-gray-200 rounded skeleton-loading mb-3 w-56"></div>
                                            <div class="h-6 bg-gray-200 rounded skeleton-loading w-24"></div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-200 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium self-start md:self-center skeleton-loading" style="width: 140px; height: 40px;"></div>
                                </div>
                            </div>

                            <div class="session-card bg-white border border-gray-200 rounded-xl p-5">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-gray-200 rounded-lg p-3 flex items-center justify-center skeleton-loading" style="width: 48px; height: 48px;"></div>
                                        <div class="flex-1">
                                            <div class="h-6 bg-gray-200 rounded skeleton-loading mb-2 w-40"></div>
                                            <div class="h-4 bg-gray-200 rounded skeleton-loading mb-3 w-56"></div>
                                            <div class="h-6 bg-gray-200 rounded skeleton-loading w-24"></div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-200 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium self-start md:self-center skeleton-loading" style="width: 140px; height: 40px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- سایدبار (اسkelتون) -->
                <div class="sidebar_section space-y-6">
                    <!-- خلاصه وضعیت -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="h-6 bg-gray-200 rounded skeleton-loading mb-4 w-32"></div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-gray-300 ml-2 skeleton-loading"></div>
                                    <div class="h-4 bg-gray-200 rounded w-16 skeleton-loading"></div>
                                </div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-gray-300 ml-2 skeleton-loading"></div>
                                    <div class="h-4 bg-gray-200 rounded w-20 skeleton-loading"></div>
                                </div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-gray-300 ml-2 skeleton-loading"></div>
                                    <div class="h-4 bg-gray-200 rounded w-24 skeleton-loading"></div>
                                </div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-gray-300 ml-2 skeleton-loading"></div>
                                    <div class="h-4 bg-gray-200 rounded w-24 skeleton-loading"></div>
                                </div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                        </div>
                        <div class="mt-6 bg-gray-200 rounded-full h-3 skeleton-loading"></div>
                    </div>

                    <!-- میانگین نمرات -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="h-6 bg-gray-200 rounded skeleton-loading mb-4 w-32"></div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="h-4 bg-gray-200 rounded w-16 skeleton-loading"></div>
                                <div class="flex">
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="h-4 bg-gray-200 rounded w-20 skeleton-loading"></div>
                                <div class="flex">
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                    <div class="w-4 h-4 bg-gray-200 rounded-full ml-1 skeleton-loading"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 bg-gray-200 rounded-lg p-4 skeleton-loading h-20"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- مودال جزئیات جلسه -->
    <div id="sessionModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="text-xl font-bold text-gray-800" id="modalTitle">جزئیات جلسه</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- محتوای مودال اینجا لود می‌شود -->
            </div>
        </div>
    </div>

    <!-- دکمه شناور برای پشتیبانی -->
    {{--<div class="fixed bottom-6 left-6 z-50">
        <button class="floating-action-btn bg-purple-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
        </button>
    </div>--}}

    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            let attends;
            let courseData;
            const courseDataRequest = await makeRequest('GET', 'fa', '{{ route("getCourseData", ["id" => request()->route("id")]) }}')
                .then(data => {
                    courseData = data.data.studentCourse;
                    //header section
                    const headerContainer = document.querySelector('.course-header .max-w-6xl');
                    const course = courseData.course;
                    const title = course.title;
                    const teacher = course.teacher;
                    const coverImage = mainFrontServerUrl+"/"+title.coCover;

                    headerContainer.innerHTML = `
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                            <div class="flex items-start gap-4">
                                <div class="bg-white/30 backdrop-blur-sm rounded-xl p-1 flex items-center justify-center">
                                    <img width="60px" height="60px" src="${coverImage}" alt="${title.coTitle}" class="min-w-[60px] min-h-[60px] rounded-xl object-cover">
                                </div>
                                <div class="flex-1">
                                    <h1 class="text-2xl md:text-3xl font-bold mb-2">${title.coTitle}</h1>
                                    <p class="text-sm md:text-base leading-relaxed">${courseData.perMonth} جلسه در ماه • ${courseData.perclocko} دقیقه هر جلسه</p>
                                    <div class="flex items-center mt-4">
                                        <div class="w-8 h-8 rounded-full bg-white/20 overflow-hidden mr-3">
                                            <img src="${teacher.image}" alt="${teacher.name} ${teacher.family}" class="w-full h-full object-cover">
                                        </div>
                                        <span class="mr-2 text-sm text-white/90">استاد ${teacher.name} ${teacher.family}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-1.5 self-start">
                                <p class="text-xs text-center">وضعیت: <span class="font-bold text-${courseData.active ? 'green' : 'red'}-300">${courseData.active ? 'فعال' : 'غیرفعال'}</span></p>
                            </div>
                        </div>
                    `;

                    //tab section
                    const tabContainer = document.querySelector('.tab_section');
                    tabContainer.innerHTML = `
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
                    `;

                    //main section
                    const mainContainer = document.querySelector('.sessions-list');
                    attends = courseData.attends;
                    const sortedAttends = attends.sort((a, b) => b.date - a.date);
                    if(sortedAttends.length === 0){
                        mainContainer.innerHTML = `
                        <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">هیچ جلسه‌ای یافت نشد</h3>
                <p class="text-gray-500">جلسات این دوره هنوز ثبت نشده است.</p>
            </div>`;
                    }else {
                        const sessionsHTML = sortedAttends.map((attend, index) => {
                            const status = attend.status;
                            const statusClass = getStatusClass(status.id);
                            const statusText = status.ststitle;
                            const date = formatDate(attend.date);
                            const time = formatTime(attend.time,attend.duration);
                            const sessionNumber = attends.length - index; // شماره جلسه از آخر

                            return `
            <div class="session-card bg-white border border-gray-200 rounded-xl p-5 hover:border-purple-200 hover:shadow-md" data-session-id="${attend.id}">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-${statusClass.color}-100 text-${statusClass.color}-600 rounded-lg p-3 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">جلسه ${sessionNumber}</h3>
                                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>${date} • ${time}</span>
                                            </div>
                                            <div class="mt-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border ${statusClass.classes}">
                                                    ${statusClass.icon} ${statusText}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center self-start md:self-center relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round"
stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        مشاهده جزئیات
                                    ${attend.readComment === 0 && attend.comment != null ? `<span class="absolute -top-1 -right-1 flex items-center justify-center">
                                        <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                    </span>` : ''}

                                    </button>
                                </div>
                            </div>
        `;
                        }).join('');

                        mainContainer.innerHTML = sessionsHTML;
                    }



                    //sidebar section
                    const sidebarContainer = document.querySelector('.sidebar_section');

                    const totalSessions = attends.length;
                    const presentSessions = attends.filter(a => a.attend_status_id === 3).length;
                    const absentSessions = attends.filter(a => a.attend_status_id === 4).length;
                    const exAbsentSessions = attends.filter(a => a.attend_status_id === 7).length;
                    const attendanceRate = totalSessions > 0 ? Math.round((presentSessions / totalSessions) * 100) : 0;

                    const hasGrades = attends.some(a => a.grade !== null);
                    const averageGrade = hasGrades ?
                        (attends.reduce((sum, a) => sum + (a.grade || 0), 0) / attends.filter(a => a.grade !== null).length).toFixed(1) : null;

// محاسبه بهترین نمره
                    const bestGrade = hasGrades ?
                        Math.max(...attends.filter(a => a.grade !== null).map(a => a.grade)) : null;

// محاسبه درصد کسب شده از کل نمره ممکن
// فرض می‌کنیم نمره کامل 20 است (می‌توانید بر اساس سیستم نمره‌دهی خود تغییر دهید)
                    const maxPossibleGrade = 20;
                    const gradePercentage = hasGrades && averageGrade > 0 ?
                        Math.round((averageGrade / maxPossibleGrade) * 100) : 0;

                    sidebarContainer.innerHTML = `

                    <!-- خلاصه وضعیت -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">وضعیت حضور و غیاب</h2>
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-green-500 ml-2"></div>
                                    <span class="text-sm text-gray-600">حاضر</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">${presentSessions}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-yellow-500 ml-2"></div>
                                    <span class="text-sm text-gray-600">غیبت موجه</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">${exAbsentSessions}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-orange-500 ml-2"></div>
                                    <span class="text-sm text-gray-600">غیبت غیرموجه</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">${absentSessions}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-purple-500 ml-2"></div>
                                    <span class="text-sm text-gray-600">تعداد کل جلسات</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">${totalSessions}</span>
                            </div>

                            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-blue-500 ml-2"></div>
                                    <span class="text-sm font-medium text-gray-700">درصد حضور</span>
                                </div>
                                <span class="text-sm font-semibold text-blue-600">${attendanceRate}%</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-green-400 to-blue-500 h-3 rounded-full transition-all duration-700" style="width: ${attendanceRate}%"></div>
                        </div>
                    </div>

                    <!-- میانگین نمرات -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">میانگین نمرات</h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">نمره کل</span>
                                <div class="flex">
                                    ${renderStars(averageGrade)}
                                </div>
                            </div>
                            ${bestGrade !== null ? `
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">بهترین نمره</span>
                                <div class="flex">
                                    ${renderStars(bestGrade)}
                                </div>
                            </div>
                            ` : ''}
                        </div>
                        <div class="mt-6 bg-purple-100 text-purple-800 rounded-lg p-4 text-center">
                            <p class="text-sm">شما ${gradePercentage}% از کل نمره ممکن را کسب کرده‌اید</p>
                            <div class="mt-2 bg-white rounded-full h-3">
                                <div class="bg-purple-600 h-3 rounded-full" style="width: ${gradePercentage}%"></div>
                            </div>
                        </div>
                    </div>
                    `;


                    const sessionCards = document.querySelectorAll('.session-card');
                    sessionCards.forEach(card => {
                        card.addEventListener('click', function() {
                            const sessionId = this.dataset.sessionId;
                            if (sessionId) {
                                openModal(`session-${sessionId}`);
                            }
                        });
                    });
                })
                .catch(err => {
                    showToastAlert(err, 'error', 3000);
                })
                .finally(() => {

                    document.querySelector('.session_header').innerHTML = `
                            <h2 class="text-xl font-bold text-gray-800 skeleton-loading animate-pulse">لیست جلسات دوره</h2>`;
                    hideSkeleton('skeleton-loading');
                });
            function renderStars(rating) {
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
            }


            function formatDate(timestamp) {
                const date = new Date(timestamp * 1000);
                const persianDate = toJalali(date.getFullYear(), date.getMonth() + 1, date.getDate());
                const dayNames = ['یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه', 'شنبه'];
                const monthNames = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];

                return `${dayNames[date.getDay()]} ${persianDate.day} ${monthNames[persianDate.month - 1]} ${persianDate.year}`;
            }

            // تابع فرمت زمان
            function formatTime(timeString, duration) {
                if (!timeString) return 'زمان نامشخص';

                // تقسیم زمان به ساعت و دقیقه
                const [hours, minutes] = timeString.split(':');

                // محاسبه زمان پایان
                const startTimeInMinutes = parseInt(hours) * 60 + parseInt(minutes);
                const endTimeInMinutes = startTimeInMinutes + duration;

                // تبدیل زمان پایان به ساعت و دقیقه
                const endHours = Math.floor(endTimeInMinutes / 60) % 24;
                const endMinutes = endTimeInMinutes % 60;

                // فرمت کردن خروجی
                return `${hours.padStart(2, '0')}:${minutes.padStart(2, '0')} - ${endHours.toString().padStart(2, '0')}:${endMinutes.toString().padStart(2, '0')}`;
            }
            function toJalali(gy, gm, gd) {
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
            }
            function getStatusClass(statusId) {
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
            }
            // توابع مدیریت مودال در scope جهانی
            async function openModal(sessionId) {
                // پیدا کردن sessionId واقعی از رشته
                const actualSessionId = sessionId.replace('session-', '');

                // پیدا کردن داده‌های جلسه
                const sessionData = attends.find(a => a.id == actualSessionId);

                if (!sessionData) {
                    showToastAlert({message: 'جلسه مورد نظر یافت نشد'}, 'error', 3000);
                    return;
                }
                if(sessionData.readComment === 0 && sessionData.comment != null){
                    const ReadCommentRequest = await makeRequest('POST', 'fa', '{{ route('readComment') }}/'+actualSessionId)
                        .then(data => {
                            fillModalWithSessionData(sessionData);
                            document.getElementById('sessionModal').classList.add('active');
                            document.body.style.overflow = 'hidden';
                        })
                        .catch(err => {
                            showToastAlert({message: 'مشکلی پیش امد,لطفا دوباره تلاس کنید!'},'error',3000);
                        })
                }else{
                    fillModalWithSessionData(sessionData);
                    document.getElementById('sessionModal').classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }

// تابع برای پر کردن مودال با اطلاعات جلسه
            function fillModalWithSessionData(sessionData) {
                const statusClass = getStatusClass(sessionData.attend_status_id);
                const date = formatDate(sessionData.date);
                const time = formatTime(sessionData.time, sessionData.duration);

                // پیدا کردن شماره جلسه
                const sessionNumber = attends.length - attends.findIndex(a => a.id === sessionData.id);

                // ایجاد محتوای مودال
                const modalContent = `
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
                            <p class="font-medium text-gray-800">${date}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">ساعت برگزاری</p>
                            <p class="font-medium text-gray-800">${time}</p>
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
                                    <img src="${courseData.course.teacher.image}" alt="${courseData.course.teacher.name} ${courseData.course.teacher.family}" class="w-full h-full object-cover">
                                </div>
                                <span class="mr-2 text-sm font-medium text-gray-800">استاد ${courseData.course.teacher.name} ${courseData.course.teacher.family}</span>
                            </div>
                        </div>
                    </div>
                    ${sessionData.grade !== null ? `
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">نمره کسب شده</p>
                            <div class="flex items-center justify-center gap-2">
                                <div class="flex">
                                    ${renderStars(sessionData.grade)}
                                </div>
                            </div>
                        </div>
                    </div>
                    ` : ''}
                </div>
            </div>

            <!-- حضور و غیاب -->
            <div class="bg-gray-50 rounded-xl p-5">
                <h3 class="font-medium text-gray-800 mb-4">وضعیت حضور و غیاب</h3>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white overflow-hidden">
                            <!-- تصویر کاربر - می‌توانید از داده‌های کاربر استفاده کنید -->
                            <img src="${courseData.student.image}" alt="هنرجو" class="w-full h-full object-cover">
                        </div>
                        <span class="mr-2 text-sm font-medium text-gray-800">شما</span>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border ${statusClass.classes}">
                        ${statusClass.icon} ${sessionData.status.ststitle}
                    </span>
                </div>
                <div class="text-sm text-gray-600 mb-4">
                    <p>${sessionData.status.stsdisc}</p>
                </div>
            </div>
        </div>

        ${sessionData.comment ? `
        <!-- کامنت استاد -->
        <div class="mt-6">
            <h3 class="font-medium text-gray-800 mb-4">نظر استاد درباره این جلسه</h3>
            <div class="comment-box bg-blue-50 border border-blue-100 rounded-xl p-4 md:p-5">
                <div class="flex flex-col sm:flex-row items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 border-2 border-white overflow-hidden flex-shrink-0">
                        <img src="${mainFrontServerUrl+"/"+courseData.course.teacher.image}" alt="${courseData.course.teacher.name} ${courseData.course.teacher.family}" class="w-full h-full object-cover">
                    </div>
                    <div class="w-full">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-800">استاد ${courseData.course.teacher.name} ${courseData.course.teacher.family}</span>
                                <div class="flex">
                                    ${renderStars(sessionData.grade)}
                                </div>
                            </div>
                        </div>
                        <p class="mt-2 text-gray-700 text-sm leading-relaxed">
                            ${sessionData.comment}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        ` : ''}

        <!-- فایل‌های ضمیمه -->
        ${sessionData.sylabes ? `
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
                        <a href="${sessionData.sylabes}" class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center" download>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            دانلود
                        </a>
                    </div>
                </div>
            </div>
        </div>
        ` : ''}
    `;

                document.getElementById('modalTitle').textContent = `جزئیات جلسه ${sessionNumber}`;
                document.getElementById('modalContent').innerHTML = modalContent;
            }

// اضافه کردن event listener برای بستن مودال با کلیک خارج از آن
            document.addEventListener('click', function(e) {
                const modal = document.getElementById('sessionModal');
                if (e.target === modal) {
                    closeModal();
                }
            });

// بستن مودال با کلید Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        });


        function closeModal() {
            const modal = document.getElementById('sessionModal');
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
</x-layouts.app>
