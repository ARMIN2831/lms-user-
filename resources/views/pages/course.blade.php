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

        .skeleton-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 0.5rem;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
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

        <!-- کارت‌های دوره (اسکلتون لودینگ) -->
        <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- اسکلتون لودینگ برای دوره‌ها -->
            <div class="course-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="relative overflow-hidden">
                    <div class="h-48 bg-gray-200 skeleton-loading"></div>
                    <div class="status-badge absolute top-4 left-4 bg-gray-200 text-transparent text-xs px-3 py-1 rounded-full font-medium shadow-sm skeleton-loading">در حال برگزاری</div>
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between">
                        <div class="w-full">
                            <div class="h-7 bg-gray-200 rounded skeleton-loading mb-3"></div>
                            <div class="flex items-center mt-3">
                                <div class="teacher-avatar w-10 h-10 rounded-full bg-gray-200 skeleton-loading"></div>
                                <div class="h-4 bg-gray-200 rounded mr-3 w-32 skeleton-loading"></div>
                            </div>
                        </div>
                        <div class="w-6 h-6 bg-gray-200 rounded skeleton-loading"></div>
                    </div>
                    <div class="flex items-center mt-4 text-sm bg-gray-50 px-3 py-2 rounded-lg">
                        <div class="h-5 w-5 ml-2 bg-gray-200 rounded skeleton-loading"></div>
                        <div class="h-4 bg-gray-200 rounded w-40 skeleton-loading"></div>
                    </div>
                    <div class="mt-5 space-y-4">
                        <div>
                            <div class="flex items-center justify-between text-sm mb-2">
                                <div class="h-4 bg-gray-200 rounded w-32 skeleton-loading"></div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 skeleton-loading"></div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-sm mb-2">
                                <div class="h-4 bg-gray-200 rounded w-24 skeleton-loading"></div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 skeleton-loading"></div>
                        </div>
                    </div>
                    <div class="mt-6 flex space-x-3 space-x-reverse">
                        <div class="flex-1 h-12 bg-gray-200 rounded-xl skeleton-loading"></div>
                        <div class="w-12 h-12 bg-gray-200 rounded-xl skeleton-loading"></div>
                    </div>
                </div>
            </div>

            <!-- تکرار اسکلتون برای دو دوره دیگر -->
            <div class="course-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="relative overflow-hidden">
                    <div class="h-48 bg-gray-200 skeleton-loading"></div>
                    <div class="status-badge absolute top-4 left-4 bg-gray-200 text-transparent text-xs px-3 py-1 rounded-full font-medium shadow-sm skeleton-loading">در حال برگزاری</div>
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between">
                        <div class="w-full">
                            <div class="h-7 bg-gray-200 rounded skeleton-loading mb-3"></div>
                            <div class="flex items-center mt-3">
                                <div class="teacher-avatar w-10 h-10 rounded-full bg-gray-200 skeleton-loading"></div>
                                <div class="h-4 bg-gray-200 rounded mr-3 w-32 skeleton-loading"></div>
                            </div>
                        </div>
                        <div class="w-6 h-6 bg-gray-200 rounded skeleton-loading"></div>
                    </div>
                    <div class="flex items-center mt-4 text-sm bg-gray-50 px-3 py-2 rounded-lg">
                        <div class="h-5 w-5 ml-2 bg-gray-200 rounded skeleton-loading"></div>
                        <div class="h-4 bg-gray-200 rounded w-40 skeleton-loading"></div>
                    </div>
                    <div class="mt-5 space-y-4">
                        <div>
                            <div class="flex items-center justify-between text-sm mb-2">
                                <div class="h-4 bg-gray-200 rounded w-32 skeleton-loading"></div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 skeleton-loading"></div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-sm mb-2">
                                <div class="h-4 bg-gray-200 rounded w-24 skeleton-loading"></div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 skeleton-loading"></div>
                        </div>
                    </div>
                    <div class="mt-6 flex space-x-3 space-x-reverse">
                        <div class="flex-1 h-12 bg-gray-200 rounded-xl skeleton-loading"></div>
                        <div class="w-12 h-12 bg-gray-200 rounded-xl skeleton-loading"></div>
                    </div>
                </div>
            </div>

            <div class="course-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="relative overflow-hidden">
                    <div class="h-48 bg-gray-200 skeleton-loading"></div>
                    <div class="status-badge absolute top-4 left-4 bg-gray-200 text-transparent text-xs px-3 py-1 rounded-full font-medium shadow-sm skeleton-loading">در حال برگزاری</div>
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between">
                        <div class="w-full">
                            <div class="h-7 bg-gray-200 rounded skeleton-loading mb-3"></div>
                            <div class="flex items-center mt-3">
                                <div class="teacher-avatar w-10 h-10 rounded-full bg-gray-200 skeleton-loading"></div>
                                <div class="h-4 bg-gray-200 rounded mr-3 w-32 skeleton-loading"></div>
                            </div>
                        </div>
                        <div class="w-6 h-6 bg-gray-200 rounded skeleton-loading"></div>
                    </div>
                    <div class="flex items-center mt-4 text-sm bg-gray-50 px-3 py-2 rounded-lg">
                        <div class="h-5 w-5 ml-2 bg-gray-200 rounded skeleton-loading"></div>
                        <div class="h-4 bg-gray-200 rounded w-40 skeleton-loading"></div>
                    </div>
                    <div class="mt-5 space-y-4">
                        <div>
                            <div class="flex items-center justify-between text-sm mb-2">
                                <div class="h-4 bg-gray-200 rounded w-32 skeleton-loading"></div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 skeleton-loading"></div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-sm mb-2">
                                <div class="h-4 bg-gray-200 rounded w-24 skeleton-loading"></div>
                                <div class="h-4 bg-gray-200 rounded w-8 skeleton-loading"></div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 skeleton-loading"></div>
                        </div>
                    </div>
                    <div class="mt-6 flex space-x-3 space-x-reverse">
                        <div class="flex-1 h-12 bg-gray-200 rounded-xl skeleton-loading"></div>
                        <div class="w-12 h-12 bg-gray-200 rounded-xl skeleton-loading"></div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // نقشه رنگ برای وضعیت‌های مختلف
            const colorMap = {
                'default': 'bg-gray-100 text-gray-800 border border-gray-200',
                'info': 'bg-blue-100 text-blue-800 border border-blue-200',
                'success': 'bg-green-100 text-green-800 border border-green-200',
                'danger': 'bg-red-100 text-red-800 border border-red-200',
                'warning': 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                'primary': 'bg-purple-100 text-purple-800 border border-purple-200',
                'secondary': 'bg-indigo-100 text-indigo-800 border border-indigo-200'
            };

            // تابع برای دریافت داده‌های دوره‌ها
            async function loadCourses() {
                const UserRequest = await makeRequest('GET', 'fa', '{{ route('getCourses') }}')
                    .then(data => {
                        if (data.message === 'success' && data.data && data.data.studentCourse) {
                            renderCourses(data.data.studentCourse);
                        } else {
                            throw new Error('داده‌های دوره‌ها دریافت نشد');
                        }
                    })
                    .catch(err => {
                        showToastAlert(err, 'error', 3000);
                    })
                    .finally(() => {
                        hideSkeleton('skeleton-loading');
                    });
            }

            // تابع برای رندر کردن دوره‌ها
            function renderCourses(coursesData) {
                const coursesContainer = document.getElementById('courses-container');
                coursesContainer.innerHTML = '';

                // ایجاد کارت برای هر دوره
                coursesData.forEach(courseData => {
                    const course = courseData.course;
                    const courseAttends = courseData.attends || [];

                    // محاسبه آمار حضور و غیاب
                    const totalClasses = courseAttends.length;
                    const presentClasses = courseAttends.filter(a => a.attend_status_id === 3).length;
                    const absentClasses = courseAttends.filter(a => [4, 7].includes(a.attend_status_id)).length;

                    const presentPercentage = totalClasses > 0 ? Math.round((presentClasses / totalClasses) * 100) : 0;
                    const absentPercentage = totalClasses > 0 ? Math.round((absentClasses / totalClasses) * 100) : 0;

                    // تعیین وضعیت دوره
                    let status = { text: 'غیر فعال', class: colorMap['warning'] };
                    if (courseData.active === 1) {
                        status =  { text: 'فعال', class: colorMap['success'] };
                    }
                    // ایجاد HTML کارت دوره
                    const courseCard = document.createElement('div');
                    courseCard.className = 'course-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300';
                    courseCard.innerHTML = `
                        <div class="relative overflow-hidden">
                            <div class="h-48 bg-gradient-to-r from-purple-500 to-indigo-600 flex items-center justify-center course-thumbnail">
                                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center opacity-30"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                </svg>
                            </div>
                            <span class="status-badge absolute top-4 left-4 ${status.class} text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                ${status.text}
                            </span>
                        </div>
                        <div class="p-5">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800 leading-tight">${course.title.coTitle}</h2>
                                    <div class="flex items-center mt-3">
                                        <div class="teacher-avatar w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 border-2 border-white shadow-md overflow-hidden">
                                            ${course.teacher.image ?
                        `<img src="${course.teacher.image.startsWith('http') ? course.teacher.image : window.location.origin + '/' + course.teacher.image}" alt="${course.teacher.name} ${course.teacher.family}" class="w-full h-full object-cover">` :
                        `<span class="text-lg font-medium">${course.teacher.name.charAt(0)}${course.teacher.family.charAt(0)}</span>`
                    }
                                        </div>
                                        <span class="text-sm text-gray-600 mr-3">استاد ${course.teacher.name} ${course.teacher.family}</span>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center mt-4 text-sm text-gray-600 bg-gray-50 px-3 py-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>تعداد جلسات: <span class="font-medium">${totalClasses} جلسه</span></span>
                            </div>
                            <div class="mt-5 space-y-4">
                                <div>
                                    <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            جلسات شرکت کرده (${presentClasses} از ${totalClasses})
                                        </span>
                                        <span class="font-medium">${presentPercentage}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="progress-bar bg-gradient-to-r from-green-400 to-green-600 h-2.5 rounded-full" style="width: ${presentPercentage}%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            غیبت‌ها (${absentClasses} جلسه)
                                        </span>
                                        <span class="font-medium">${absentPercentage}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="progress-bar bg-gradient-to-r from-red-400 to-red-600 h-2.5 rounded-full" style="width: ${absentPercentage}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex space-x-3 space-x-reverse">
                                <a href="/courseDetail/${courseData.id}" class="flex-1 action-button bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white py-3 px-4 rounded-xl text-center font-medium shadow-md hover:shadow-lg">
                                    جزئیات دوره
                                </a>
                                <button class="action-button bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 p-3 rounded-xl shadow-md hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `;

                    coursesContainer.appendChild(courseCard);
                });

                // اگر دوره‌ای وجود نداشت
                if (coursesData.length === 0) {
                    coursesContainer.innerHTML = `
                        <div class="col-span-3 flex flex-col items-center justify-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">دوره‌ای یافت نشد</h3>
                            <p class="text-gray-500 text-center">شما در هیچ دوره‌ای ثبت‌نام نکرده‌اید.</p>
                        </div>
                    `;
                }
            }

            // بارگذاری دوره‌ها پس از لود صفحه
            setTimeout(() => {
                loadCourses();
            }, 100);
        });
    </script>
</x-layouts.app>
