<x-layouts.app title="جستجوی دوره‌ها">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        @keyframes shimmer {
            0% { background-position: -468px 0; }
            100% { background-position: 468px 0; }
        }

        .course-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .course-card:nth-child(1) { animation-delay: 0.1s; }
        .course-card:nth-child(2) { animation-delay: 0.2s; }
        .course-card:nth-child(3) { animation-delay: 0.3s; }
        .course-card:nth-child(4) { animation-delay: 0.4s; }

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

        .filter-section {
            transition: all 0.3s ease;
        }

        .filter-toggle {
            transition: all 0.3s ease;
        }

        .filter-toggle.active {
            background-color: #6366f1;
        }

        .music-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .music-gradient-light {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .music-gradient-secondary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .music-gradient-success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .music-gradient-warning {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(10px);
        }

        .select-multi {
            max-height: 200px;
            overflow-y: auto;
        }

        .select-multi::-webkit-scrollbar {
            width: 6px;
        }

        .select-multi::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .select-multi::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 10px;
        }

        .select-multi::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 1rem;
            height: 1rem;
            border: 2px solid #d1d5db;
            border-radius: 0.25rem;
            background-color: white;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }

        .custom-checkbox:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .custom-checkbox:checked::after {
            content: "✓";
            position: absolute;
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .custom-checkbox:hover {
            border-color: #4f46e5;
        }

        .custom-checkbox:focus {
            outline: none;
            ring: 2px solid #4f46e5;
            ring-offset: 0;
        }

        /* استایل‌های مودال */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 90%;
            max-width: 850px;
            max-height: 75vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-container {
            transform: scale(1);
        }

        .modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: between;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
            margin-right: auto;
        }

        .modal-close:hover {
            color: #374151;
        }

        .modal-body {
            padding: 2rem;
        }

        .comment-box {
            border-right: 4px solid #3b82f6;
        }

        .attachment-card {
            transition: all 0.3s ease;
        }

        .attachment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/fa.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div x-data="coursesPage()" class="min-h-screen">

        <!-- بخش اصلی محتوا -->
        <main class="container mx-auto px-4 py-8">
            <!-- هدر صفحه -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">جستجوی دوره‌ها</h1>
                    <p class="text-gray-600 mt-2 text-sm md:text-base">دوره‌های متنوع موسیقی را بر اساس نیاز خود پیدا کنید</p>
                </div>
                <div class="flex space-x-3 space-x-reverse w-full md:w-auto">
                    <button @click="toggleFilters()" class="flex-1 md:flex-none bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md filter-toggle" :class="{'active': filtersVisible}">
                        <i class="fas fa-filter ml-2"></i>
                        <span>فیلترها</span>
                        <span x-show="activeFiltersCount > 0" class="bg-indigo-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center mr-2" x-text="activeFiltersCount"></span>
                    </button>
                </div>
            </div>

            <!-- بخش فیلترها -->
            <div x-show="filtersVisible" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 class="filter-section bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">

                <!-- هدر فیلترها -->
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                            <i class="fas fa-filter text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">فیلترهای پیشرفته</h3>
                            <p class="text-sm text-gray-500">دوره‌ها را بر اساس معیارهای مختلف جستجو کنید</p>
                        </div>
                    </div>
                    <button @click="toggleFilters()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- ستون سمت راست -->
                    <div class="space-y-6">
                        <!-- فیلتر تاریخ -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-calendar-day ml-2 text-indigo-500"></i>
                                تاریخ شروع دوره
                            </label>
                            <div class="relative">
                                <input type="text" x-ref="datePicker"
                                       class="w-full bg-white border border-gray-300 rounded-lg py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                                       placeholder="یک تاریخ انتخاب کنید یا خالی بگذارید">
                                <i class="fas fa-calendar-alt absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">می‌توانید تاریخ خاصی انتخاب کنید یا خالی بگذارید</p>
                        </div>

                        <!-- فیلتر وضعیت دوره -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-power-off ml-2 text-indigo-500"></i>
                                وضعیت دوره
                            </label>
                            <div class="grid grid-cols-3 gap-2">
                                <template x-for="status in statusOptions" :key="status.value">
                                    <label class="flex items-center justify-center p-3 border-2 rounded-lg cursor-pointer transition-all duration-200"
                                           :class="filters.activeStatus === status.value ?
                                      'border-indigo-500 bg-indigo-50 text-indigo-700' :
                                      'border-gray-200 bg-white text-gray-600 hover:border-gray-300'">
                                        <input type="radio" x-model="filters.activeStatus" :value="status.value" class="hidden">
                                        <i :class="status.icon" class="ml-2"></i>
                                        <span x-text="status.label" class="text-sm font-medium"></span>
                                    </label>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- ستون سمت چپ -->
                    <div class="space-y-6">
                        <!-- فیلتر دانشجو (چند انتخابی) -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <label class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-user-graduate ml-2 text-indigo-500"></i>
                                    دانشجویان
                                </label>
                                <div class="flex space-x-2 space-x-reverse">
                                    <button @click="selectAllStudents()" class="text-xs bg-white border border-gray-300 text-gray-600 px-2 py-1 rounded-lg hover:bg-gray-50 transition-colors">
                                        انتخاب همه
                                    </button>
                                    <button @click="clearStudents()" class="text-xs bg-white border border-gray-300 text-gray-600 px-2 py-1 rounded-lg hover:bg-gray-50 transition-colors">
                                        حذف همه
                                    </button>
                                </div>
                            </div>

                            <div class="max-h-48 overflow-y-auto space-y-2 select-multi bg-white rounded-lg border border-gray-200 p-3">
                                <template x-if="filtersLoading">
                                    <div class="space-y-3">
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <div class="w-5 h-5 bg-gray-200 rounded skeleton-loading"></div>
                                            <div class="flex items-center space-x-3 space-x-reverse">
                                                <div class="w-8 h-8 bg-gray-200 rounded-full skeleton-loading"></div>
                                                <div class="h-4 bg-gray-200 rounded w-32 skeleton-loading"></div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <div class="w-5 h-5 bg-gray-200 rounded skeleton-loading"></div>
                                            <div class="flex items-center space-x-3 space-x-reverse">
                                                <div class="w-8 h-8 bg-gray-200 rounded-full skeleton-loading"></div>
                                                <div class="h-4 bg-gray-200 rounded w-28 skeleton-loading"></div>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="!filtersLoading">
                                    <template x-for="student in students" :key="student.id">
                                        <label class="flex items-center space-x-3 space-x-reverse p-3 rounded-xl hover:bg-indigo-50 cursor-pointer transition-all duration-300 border border-transparent hover:border-indigo-100 group">
                                            <input type="checkbox" x-model="filters.students" :value="student.id" class="custom-checkbox">
                                            <div class="flex items-center space-x-3 space-x-reverse flex-1">
                                                <!-- آواتار دانشجو -->
                                                <div class="relative">
                                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white text-sm font-medium shadow-md group-hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                                                        <template x-if="student.image">
                                                            <img :src="student.image" :alt="student.name + ' ' + student.family"
                                                                 class="w-full h-full object-cover">
                                                        </template>
                                                        <template x-if="!student.image">
                                                            <span x-text="(student.name?.charAt(0) || '') + (student.family?.charAt(0) || '')"
                                                                  class="font-semibold"></span>
                                                        </template>
                                                    </div>
                                                    <!-- نشانگر وضعیت آنلاین -->
                                                    <div class="absolute -bottom-1 -left-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white shadow-sm"></div>
                                                </div>

                                                <!-- اطلاعات دانشجو -->
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center space-x-2 space-x-reverse">
                                                        <span x-text="student.name + ' ' + student.family"
                                                              class="text-sm font-semibold text-gray-800 truncate group-hover:text-indigo-700 transition-colors duration-200"></span>
                                                        <span x-show="student.code" x-text="'(' + student.code + ')'"
                                                              class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full"></span>
                                                    </div>
                                                    <div class="flex items-center space-x-2 space-x-reverse mt-1">
                                                        <span x-text="student.courses_count + ' دوره'"
                                                              class="text-xs text-gray-500 bg-blue-50 px-2 py-1 rounded-full"></span>
                                                        <span x-show="student.level" x-text="student.level"
                                                              class="text-xs text-gray-500 bg-green-50 px-2 py-1 rounded-full"></span>
                                                    </div>
                                                </div>

                                                <!-- آیکون تأیید شده -->
                                                <div x-show="student.verified" class="text-green-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    <i class="fas fa-check-circle text-sm"></i>
                                                </div>
                                            </div>
                                        </label>
                                    </template>
                                </template>
                            </div>
                            <p class="text-xs text-gray-500 mt-2" x-text="`${filters.students.length} دانشجو انتخاب شده`"></p>
                        </div>

                        <!-- فیلتر دوره خاص (چند انتخابی) -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <label class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-music ml-2 text-indigo-500"></i>
                                    دوره‌های خاص
                                </label>
                                <div class="flex space-x-2 space-x-reverse">
                                    <button @click="selectAllCourses()" class="text-xs bg-white border border-gray-300 text-gray-600 px-2 py-1 rounded-lg hover:bg-gray-50 transition-colors">
                                        انتخاب همه
                                    </button>
                                    <button @click="clearCourses()" class="text-xs bg-white border border-gray-300 text-gray-600 px-2 py-1 rounded-lg hover:bg-gray-50 transition-colors">
                                        حذف همه
                                    </button>
                                </div>
                            </div>

                            <div class="max-h-48 overflow-y-auto space-y-2 select-multi bg-white rounded-lg border border-gray-200 p-3">
                                <template x-if="filtersLoading">
                                    <div class="space-y-3">
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <div class="w-5 h-5 bg-gray-200 rounded skeleton-loading"></div>
                                            <div class="h-4 bg-gray-200 rounded flex-1 skeleton-loading"></div>
                                        </div>
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <div class="w-5 h-5 bg-gray-200 rounded skeleton-loading"></div>
                                            <div class="h-4 bg-gray-200 rounded flex-1 skeleton-loading"></div>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="!filtersLoading">
                                    <template x-for="course in courses" :key="course.id">
                                        <label class="flex items-center space-x-3 space-x-reverse p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors duration-200">
                                            <input type="checkbox" x-model="filters.courses" :value="course.id" class="custom-checkbox">
                                            <div class="flex items-center justify-between flex-1">
                                                <span x-text="course.title" class="text-sm font-medium text-gray-700"></span>
                                            </div>
                                        </label>
                                    </template>
                                </template>
                            </div>
                            <p class="text-xs text-gray-500 mt-2" x-text="`${filters.courses.length} دوره انتخاب شده`"></p>
                        </div>
                    </div>
                </div>

                <!-- دکمه‌های فیلتر -->
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 space-x-0 sm:space-x-4 sm:space-x-reverse pt-6 mt-6 border-t border-gray-200">
                    <div class="text-sm text-gray-500">
                        <span x-text="`${activeFiltersCount} فیلتر فعال`"></span>
                    </div>
                    <div class="flex space-x-3 space-x-reverse">
                        <button @click="resetFilters()"
                                class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center shadow-sm hover:shadow-md font-medium">
                            <i class="fas fa-undo ml-2"></i>
                            <span>بازنشانی فیلترها</span>
                        </button>
                        <button @click="fetchSessions()"
                                class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 flex items-center shadow-lg hover:shadow-xl font-medium">
                            <i class="fas fa-search ml-2"></i>
                            <span>اعمال فیلترها</span>
                            <span x-show="activeFiltersCount > 0" class="bg-white/20 text-white/90 text-xs rounded-full w-6 h-6 flex items-center justify-center mr-2"
                                  x-text="activeFiltersCount"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- بخش نمایش جلسات -->
            <div class="mt-8">
                <template x-if="sessionsLoading">
                    <!-- اسکلتون لودینگ برای جلسات -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                        <template x-for="i in 6" :key="i">
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 animate-pulse">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center space-x-3 space-x-reverse">
                                        <div class="w-12 h-12 bg-gray-200 rounded-xl"></div>
                                        <div>
                                            <div class="h-4 bg-gray-200 rounded w-32 mb-2"></div>
                                            <div class="h-3 bg-gray-200 rounded w-24"></div>
                                        </div>
                                    </div>
                                    <div class="h-6 bg-gray-200 rounded w-20"></div>
                                </div>
                                <div class="space-y-3">
                                    <div class="h-3 bg-gray-200 rounded"></div>
                                    <div class="h-3 bg-gray-200 rounded w-3/4"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                <template x-if="!sessionsLoading && sessions.length > 0">
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                        <template x-for="session in sessions" :key="session.id">
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 group cursor-pointer"
                                 @click="openModal(session)">

                                <!-- هدر کارت -->
                                <div class="p-6 border-b border-gray-100">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <!-- عکس دوره -->
                                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 overflow-hidden flex items-center justify-center">
                                                <template x-if="session.cover">
                                                    <img :src="mainFrontServerUrl + '/' + session.cover"
                                                         :alt="session.title"
                                                         class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!session.cover">
                                                    <i class="fas fa-music text-white text-lg"></i>
                                                </template>
                                            </div>
                                            <div>
                                                <h3 class="font-bold text-gray-800 text-sm"
                                                    x-text="session.title"></h3>
                                                <p class="text-xs text-gray-500 mt-1"
                                                   x-text="'جلسه ' + session.id"></p>
                                            </div>
                                        </div>
                                        <!-- وضعیت جلسه -->
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border"
                                              :class="getStatusInfo(session.attend_status_id).classes">
                                            <span x-html="getStatusInfo(session.attend_status_id).icon" class="ml-1"></span>
                                            <span x-text="getStatusInfo(session.attend_status_id).ststitle"></span>
                                        </span>
                                    </div>

                                    <!-- تاریخ و زمان -->
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-calendar-day ml-2 text-purple-500"></i>
                                            <span x-text="formatDate(session.date)"></span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-clock ml-2 text-blue-500"></i>
                                            <span x-text="formatTime(session.time, session.duration)"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- بدنه کارت -->
                                <div class="p-6">
                                    <!-- اطلاعات دانشجو -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 overflow-hidden">
                                                <template x-if="session.image">
                                                    <img :src="session.image"
                                                         :alt="session.name"
                                                         class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!session.image">
                                                    <div class="w-full h-full flex items-center justify-center text-white text-xs font-medium">
                                                        <span x-text="session.name.charAt(0) + session.family.charAt(0)"></span>
                                                    </div>
                                                </template>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800"
                                                   x-text="session.name + ' ' + session.family"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- امتیاز و وضعیت دوره -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="flex items-center space-x-4 space-x-reverse">
                                            <!-- امتیاز -->
                                            <div class="flex items-center text-sm" x-show="session.grade">
                                                <span class="text-gray-600 ml-2">امتیاز:</span>
                                                <span class="text-yellow-500 font-medium" x-html="renderStars(session.grade)"></span>
                                            </div>

                                            <!-- وضعیت دوره -->
                                            <div class="flex items-center text-sm">
                                                <span class="text-gray-600 ml-2">وضعیت پرداخت:</span>
                                                <span class="font-medium"
                                                      :class="session.feeFlag ? 'text-red-600' : 'text-green-600'"
                                                      x-text="session.feeFlag ? 'پرداخت نشده' : 'پرداخت شده'"></span>
                                            </div>
                                        </div>

                                        <!-- دکمه جزئیات -->
                                        <button class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200 group-hover:translate-x-1 transform transition-transform">
                                            <i class="fas fa-chevron-left text-sm"></i>
                                            <span class="text-xs font-medium mr-1">جزئیات</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                <!-- بعد از نمایش جلسات -->
                <div x-show="!sessionsLoading && sessions.length > 0" class="flex justify-center mt-12">
                    <div class="flex items-center space-x-2 space-x-reverse bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 px-6 py-3">
                        <!-- دکمه قبلی -->
                        <button
                            @click="prevPage()"
                            :disabled="currentPage === 1"
                            class="pagination-button w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 transition-all duration-300 shadow-sm hover:shadow-md disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-white disabled:hover:border-gray-200 group"
                        >
                            <i class="fas fa-chevron-right text-sm group-hover:translate-x-0.5 transition-transform"></i>
                        </button>

                        <!-- صفحه اول -->
                        <button
                            @click="goToPage(1)"
                            :class="currentPage === 1 ?
                'bg-gradient-to-r from-indigo-500 to-purple-500 text-white border-indigo-500 shadow-lg scale-105' :
                'bg-white text-gray-700 border-gray-200 hover:bg-gray-50 hover:border-gray-300'"
                            class="pagination-button w-10 h-10 flex items-center justify-center rounded-full border transition-all duration-300 text-sm font-medium shadow-sm hover:shadow-md"
                        >
                            1
                        </button>

                        <!-- بیضی اگر لازم باشد -->
                        <template x-if="currentPage > 3">
            <span class="w-10 h-10 flex items-center justify-center text-gray-400 text-sm">
                <i class="fas fa-ellipsis-h"></i>
            </span>
                        </template>

                        <!-- صفحات میانی -->
                        <template x-for="page in getMiddlePages()" :key="page">
                            <button
                                @click="goToPage(page)"
                                :class="currentPage === page ?
                    'bg-gradient-to-r from-indigo-500 to-purple-500 text-white border-indigo-500 shadow-lg scale-105' :
                    'bg-white text-gray-700 border-gray-200 hover:bg-gray-50 hover:border-gray-300'"
                                class="pagination-button w-10 h-10 flex items-center justify-center rounded-full border transition-all duration-300 text-sm font-medium shadow-sm hover:shadow-md"
                            >
                                <span x-text="page"></span>
                            </button>
                        </template>

                        <!-- بیضی اگر لازم باشد -->
                        <template x-if="currentPage < lastPage - 2">
            <span class="w-10 h-10 flex items-center justify-center text-gray-400 text-sm">
                <i class="fas fa-ellipsis-h"></i>
            </span>
                        </template>

                        <!-- صفحه آخر -->
                        <template x-if="lastPage > 1">
                            <button
                                @click="goToPage(lastPage)"
                                :class="currentPage === lastPage ?
                    'bg-gradient-to-r from-indigo-500 to-purple-500 text-white border-indigo-500 shadow-lg scale-105' :
                    'bg-white text-gray-700 border-gray-200 hover:bg-gray-50 hover:border-gray-300'"
                                class="pagination-button w-10 h-10 flex items-center justify-center rounded-full border transition-all duration-300 text-sm font-medium shadow-sm hover:shadow-md"
                            >
                                <span x-text="lastPage"></span>
                            </button>
                        </template>

                        <!-- دکمه بعدی -->
                        <button
                            @click="nextPage()"
                            :disabled="currentPage === lastPage"
                            class="pagination-button w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 transition-all duration-300 shadow-sm hover:shadow-md disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-white disabled:hover:border-gray-200 group"
                        >
                            <i class="fas fa-chevron-left text-sm group-hover:-translate-x-0.5 transition-transform"></i>
                        </button>
                    </div>
                </div>

                <!-- اطلاعات صفحه -->
                <div x-show="!sessionsLoading && sessions.length > 0" class="flex justify-center mt-4">
                    <div class="bg-indigo-50 border border-indigo-100 rounded-xl px-4 py-2">
                        <p class="text-sm text-indigo-700 font-medium">
                            نمایش
                            <span class="text-indigo-800" x-text="(currentPage - 1) * perPage + 1"></span>
                            تا
                            <span class="text-indigo-800" x-text="Math.min(currentPage * perPage, totalSessions)"></span>
                            از
                            <span class="text-indigo-800" x-text="totalSessions"></span>
                            جلسه
                        </p>
                    </div>
                </div>

                <template x-if="!sessionsLoading && sessions.length === 0">
                    <div class="text-center py-12">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">جلسه‌ای یافت نشد</h3>
                        <p class="text-gray-500">با فیلترهای فعلی هیچ جلسه‌ای پیدا نشد.</p>
                    </div>
                </template>
            </div>
        </main>

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
                                                <img :src="modalSessionData.image" alt="هنرجو" class="w-full h-full object-cover">
                                            </div>
                                            <span class="mr-2 text-sm font-medium text-gray-800" x-text="modalSessionData.name + ' ' + modalSessionData.family"></span>
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
                                                <img :src="mainFrontServerUrl + '/' + modalSessionData.Timage" :alt="`${modalSessionData.Tname} ${modalSessionData.Tfamily}`" class="w-full h-full object-cover">
                                            </div>
                                            <div class="w-full">
                                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                                                    <div class="flex items-center gap-2">
                                                        <span class="font-medium text-gray-800" x-text="`استاد ${modalSessionData.Tname} ${modalSessionData.Tfamily}`"></span>
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
                                                <template x-if="session.Timage">
                                                    <img :src="mainFrontServerUrl + '/' + session.Timage" :alt="`${session.Tname} ${session.Tfamily}`" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!session.Timage">
                                                    <span x-text="(session.Tname?.charAt(0) || 'ا') + (session.Tfamily?.charAt(0) || 'س')"></span>
                                                </template>
                                            </div>

                                            <!-- فرم ثبت کامنت -->
                                            <div class="flex-1 w-full">
                                                <div class="flex items-center gap-3 mb-4">
                                                    <span class="font-semibold text-gray-800" x-text="`استاد ${session.Tname} ${session.Tfamily}`"></span>
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

    <script>
        function coursesPage() {
            return {
                loading: false,
                filtersVisible: false,
                filtersLoading: true,
                sessionsLoading: false,

                filters: {
                    date: null,
                    students: [],
                    activeStatus: '',
                    courses: []
                },
                students: [],
                courses: [],
                sessions: [],

                // داده‌های کمکی
                coursesData: {},
                studentsData: {},
                statusData: {
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
                },

                statusOptions: [
                    { value: '', label: 'همه', icon: 'fas fa-layer-group' },
                    { value: '1', label: 'فعال', icon: 'fas fa-play-circle' },
                    { value: '0', label: 'غیرفعال', icon: 'fas fa-pause-circle' }
                ],

                get activeFiltersCount() {
                    let count = 0;
                    if (this.filters.date) count++;
                    if (this.filters.students.length > 0) count++;
                    if (this.filters.activeStatus) count++;
                    if (this.filters.courses.length > 0) count++;
                    return count;
                },

                async init() {
                    await this.loadFilterData();

                    if (this.$refs.datePicker) {
                        flatpickr(this.$refs.datePicker, {
                            locale: "fa",
                            enableTime: false,
                            dateFormat: "Y/m/d",
                            altInput: true,
                            altFormat: "l j F Y",
                            onChange: (selectedDates, dateStr) => {
                                this.filters.date = dateStr;
                            }
                        });
                    }

                    // بارگذاری اولیه جلسات
                    await this.readUrlParams();
                    await this.fetchSessions();
                },


                async readUrlParams() {
                    try {
                        const urlParams = getFilterParamsFromUrl();

                        // اعمال پارامترهای URL روی فیلترها
                        this.filters = {
                            ...this.filters,
                            ...urlParams
                        };

                        // تنظیم datepicker اگر تاریخ وجود دارد
                        if (this.filters.date && this.$refs.datePicker && this.$refs.datePicker._flatpickr) {
                            this.$refs.datePicker._flatpickr.setDate(this.filters.date);
                        }

                        // اعمال فیلترها
                        await this.fetchSessions();

                    } catch (error) {
                        console.error('خطا در خواندن پارامترهای URL:', error);
                    }
                },

                updateUrlParams() {
                    // فقط فیلترهای فعال را به URL اضافه کن
                    const activeParams = {};

                    if (this.filters.date) {
                        activeParams.date = this.filters.date;
                    }

                    if (this.filters.students.length > 0) {
                        activeParams.students = this.filters.students;
                    }

                    if (this.filters.activeStatus) {
                        activeParams.activeStatus = this.filters.activeStatus;
                    }

                    if (this.filters.courses.length > 0) {
                        activeParams.courses = this.filters.courses;
                    }

                    updateUrlParams(activeParams, true);
                },

                resetFilters() {
                    this.filters = {
                        date: null,
                        students: [],
                        activeStatus: '',
                        courses: []
                    };

                    // بازنشانی datepicker
                    if (this.$refs.datePicker && this.$refs.datePicker._flatpickr) {
                        this.$refs.datePicker._flatpickr.clear();
                    }

                    // پاک کردن پارامترهای URL
                    updateUrlParams({}, true);

                    this.fetchSessions();
                },

                async loadFilterData() {
                    try {
                        const response = await makeRequest('GET', 'fa', '{{ route('getFilterData') }}');
                        if (response.status === 'success' && response.data) {
                            this.courses = response.data.courses;
                            this.students = response.data.students;
                        } else {
                            throw new Error('خطا در بارگذاری اطلاعات');
                        }
                    } catch (error) {
                        showToastAlert(error, 'error', 3000);
                    } finally {
                        this.filtersLoading = false;
                    }
                },

                getStatusInfo(statusId) {
                    return this.statusData[statusId] || {
                        ststitle: 'نامشخص',
                        stsdisc: 'وضعیت نامشخص',
                        classes: 'bg-gray-100 text-gray-800 border-gray-200',
                        icon: '❓'
                    };
                },

                formatDate(timestamp) {
                    const date = new Date(timestamp * 1000);
                    return date.toLocaleDateString('fa-IR');
                },

                formatTime(time, duration) {
                    const endTime = this.calculateEndTime(time, duration);
                    return `${time} - ${endTime}`;
                },

                calculateEndTime(startTime, duration) {
                    const [hours, minutes] = startTime.split(':').map(Number);
                    const totalMinutes = hours * 60 + minutes + duration;
                    const endHours = Math.floor(totalMinutes / 60);
                    const endMinutes = totalMinutes % 60;
                    return `${endHours.toString().padStart(2, '0')}:${endMinutes.toString().padStart(2, '0')}`;
                },

                renderStars(grade) {
                    if (!grade) return '---';
                    let stars = '';
                    for (let i = 0; i < 5; i++) {
                        stars += i < grade ? '★' : '☆';
                    }
                    return stars;
                },

                // متدهای کمکی برای فیلترها
                selectAllStudents() {
                    this.filters.students = this.students.map(student => student.id);
                },

                clearStudents() {
                    this.filters.students = [];
                },

                selectAllCourses() {
                    this.filters.courses = this.courses.map(course => course.id);
                },

                clearCourses() {
                    this.filters.courses = [];
                },

                toggleFilters() {
                    this.filtersVisible = !this.filtersVisible;
                },

                removeFilter(filterKey) {
                    if (filterKey === 'date') {
                        this.filters.date = null;
                        if (this.$refs.datePicker && this.$refs.datePicker._flatpickr) {
                            this.$refs.datePicker._flatpickr.clear();
                        }
                    } else if (filterKey === 'students') {
                        this.filters.students = [];
                    } else if (filterKey === 'activeStatus') {
                        this.filters.activeStatus = '';
                    } else if (filterKey === 'courses') {
                        this.filters.courses = [];
                    }

                    this.fetchSessions();
                },

                getActiveFilters() {
                    const activeFilters = [];

                    if (this.filters.date) {
                        activeFilters.push({
                            key: 'date',
                            label: `تاریخ: ${this.filters.date}`
                        });
                    }

                    if (this.filters.students.length > 0) {
                        activeFilters.push({
                            key: 'students',
                            label: `دانشجو: ${this.filters.students.length} مورد`
                        });
                    }

                    if (this.filters.activeStatus) {
                        const statusLabel = this.filters.activeStatus === '1' ? 'فعال' : 'غیرفعال';
                        activeFilters.push({
                            key: 'activeStatus',
                            label: `وضعیت: ${statusLabel}`
                        });
                    }

                    if (this.filters.courses.length > 0) {
                        activeFilters.push({
                            key: 'courses',
                            label: `دوره: ${this.filters.courses.length} مورد`
                        });
                    }

                    return activeFilters;
                },

                // مودال
                modalOpen: false,
                modalSessionData: null,
                modalSessionNumber: null,

                openModal(session) {
                    console.log(session)
                    this.modalSessionData = session;
                    this.modalSessionNumber = session.page_order || session.id;
                    this.modalOpen = true;
                },

                closeModal() {
                    this.modalOpen = false;
                    this.modalSessionData = null;
                    this.modalSessionNumber = null;
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


                currentPage: 1,
                perPage: 15,
                totalSessions: 0,
                lastPage: 1,

                async fetchSessions() {
                    try {
                        this.sessionsLoading = true;
                        this.updateUrlParams();

                        const requestData = {
                            ...this.filters,
                            page: this.currentPage,
                            per_page: this.perPage
                        };

                        const response = await makeRequest('POST', 'fa', '{{ route('getAttendFilter') }}', requestData);

                        if (response.status === 'success') {
                            this.sessions = response.data.data;
                            this.totalSessions = response.data.meta.total;
                            this.lastPage = response.data.meta.last_page;
                        }
                    } catch (error) {
                        console.error('خطا در دریافت جلسات:', error);
                        showToastAlert('خطا در دریافت جلسات', 'error', 3000);
                    } finally {
                        this.sessionsLoading = false;
                    }
                },

                getMiddlePages() {
                    const pages = [];
                    const totalPages = this.lastPage;
                    const current = this.currentPage;

                    if (totalPages <= 5) {
                        // اگر صفحات کم هستند، همه را نشان بده (به جز اول و آخر که جدا هستند)
                        for (let i = 2; i <= totalPages - 1; i++) {
                            pages.push(i);
                        }
                    } else {
                        // منطق نمایش صفحات میانی
                        let start = Math.max(2, current - 1);
                        let end = Math.min(totalPages - 1, current + 1);

                        // اگر نزدیک ابتدا هستیم
                        if (current <= 3) {
                            start = 2;
                            end = 4;
                        }
                        // اگر نزدیک انتها هستیم
                        else if (current >= totalPages - 2) {
                            start = totalPages - 3;
                            end = totalPages - 1;
                        }

                        for (let i = start; i <= end; i++) {
                            pages.push(i);
                        }
                    }

                    return pages;
                },

                nextPage() {
                    if (this.currentPage < this.lastPage) {
                        this.currentPage++;
                        this.fetchSessions();
                        this.scrollToTop();
                    }
                },

                prevPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                        this.fetchSessions();
                        this.scrollToTop();
                    }
                },

                goToPage(page) {
                    this.currentPage = page;
                    this.fetchSessions();
                    this.scrollToTop();
                },

                scrollToTop() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            };
        }

        /**
         * دریافت تمام پارامترهای query string از URL
         * @returns {Object} - آبجکت شامل تمام پارامترها
         */
        function getUrlParams() {
            const params = {};
            const url = window.location.href;

            // پیدا کردن بخش query string
            const queryString = url.split('?')[1];

            if (queryString) {
                const pairs = queryString.split('&');

                for (const pair of pairs) {
                    const [key, value] = pair.split('=');
                    if (key) {
                        // decode URI component برای پشتیبانی از فارسی
                        const decodedKey = decodeURIComponent(key);
                        const decodedValue = value ? decodeURIComponent(value) : '';

                        // اگر پارامتر آرایه باشد (مثل students[]=1&students[]=2)
                        if (decodedKey.endsWith('[]')) {
                            const cleanKey = decodedKey.slice(0, -2);
                            if (!params[cleanKey]) {
                                params[cleanKey] = [];
                            }
                            params[cleanKey].push(decodedValue);
                        } else {
                            params[decodedKey] = decodedValue;
                        }
                    }
                }
            }

            return params;
        }

        /**
         * دریافت و تجزیه پارامترهای URL با پشتیبانی از انواع داده
         * @returns {Object} - آبجکت شامل پارامترهای تجزیه شده
         */
        function getUrlParamsAdvanced() {
            const params = {};
            const searchParams = new URLSearchParams(window.location.search);

            for (const [key, value] of searchParams.entries()) {
                // حذف براکت‌ها از کلیدهای آرایه
                const cleanKey = key.replace(/\[\]$/, '');

                try {
                    // سعی در تجزیه JSON (برای آرایه‌ها و آبجکت‌ها)
                    const parsedValue = JSON.parse(value);
                    params[cleanKey] = parsedValue;
                } catch {
                    // اگر JSON نبود، مقدار ساده در نظر بگیر
                    if (searchParams.getAll(key).length > 1) {
                        // اگر چندین مقدار برای یک کلید وجود دارد، آرایه بساز
                        if (!params[cleanKey]) {
                            params[cleanKey] = [];
                        }
                        params[cleanKey].push(value);
                    } else {
                        params[cleanKey] = value;
                    }
                }
            }

            return params;
        }


        /**
         * دریافت پارامترهای فیلتر از URL
         * @returns {Object} - آبجکت فیلترها
         */
        function getFilterParamsFromUrl() {
            const params = getUrlParams();
            const filters = {
                date: null,
                students: [],
                activeStatus: '',
                courses: []
            };

            // تاریخ
            if (params.date) {
                filters.date = params.date;
            }

            // دانشجویان (آرایه)
            if (params.students) {
                if (Array.isArray(params.students)) {
                    filters.students = params.students.map(id => parseInt(id)).filter(id => !isNaN(id));
                } else {
                    filters.students = [parseInt(params.students)].filter(id => !isNaN(id));
                }
            }

            // وضعیت دوره
            if (params.activeStatus) {
                filters.activeStatus = params.activeStatus;
            }

            // دوره‌ها (آرایه)
            if (params.courses) {
                if (Array.isArray(params.courses)) {
                    filters.courses = params.courses.map(id => parseInt(id)).filter(id => !isNaN(id));
                } else {
                    filters.courses = [parseInt(params.courses)].filter(id => !isNaN(id));
                }
            }

            return filters;
        }


        /**
         * به‌روزرسانی URL با پارامترهای جدید
         * @param {Object} newParams - پارامترهای جدید
         * @param {boolean} replace - آیا جایگزین history شود؟
         */
        function updateUrlParams(newParams, replace = false) {
            const url = new URL(window.location.href);

            // حذف پارامترهای موجود
            for (const key of url.searchParams.keys()) {
                url.searchParams.delete(key);
            }

            // اضافه کردن پارامترهای جدید
            for (const [key, value] of Object.entries(newParams)) {
                if (value !== null && value !== '' && value !== undefined) {
                    if (Array.isArray(value) && value.length > 0) {
                        // برای آرایه‌ها
                        value.forEach(item => {
                            url.searchParams.append(`${key}[]`, item.toString());
                        });
                    } else {
                        // برای مقادیر ساده
                        url.searchParams.set(key, value.toString());
                    }
                }
            }

            // به‌روزرسانی URL
            if (replace) {
                window.history.replaceState({}, '', url.toString());
            } else {
                window.history.pushState({}, '', url.toString());
            }
        }
    </script>
</x-layouts.app>
