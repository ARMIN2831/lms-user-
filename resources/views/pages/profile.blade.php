<x-layouts.app title="پروفایل کاربری">
    <!-- استایل سفارشی -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload {
            transition: all 0.3s ease;
        }

        .avatar-upload:hover {
            transform: scale(1.05);
        }

        .avatar-upload label {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .avatar-upload label:hover {
            background-color: rgba(124, 58, 237, 0.1);
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
        }

        .save-btn {
            transition: all 0.3s ease, transform 0.2s ease;
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px -5px rgba(124, 58, 237, 0.3);
        }

        .tab-button {
            transition: all 0.3s ease;
        }

        .tab-button.active {
            border-bottom: 3px solid #7c3aed;
            color: #7c3aed;
        }

        .tab-content {
            animation: fadeIn 0.4s ease-out;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-white p-4 md:p-8 font-sans">
        <!-- هدر صفحه -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">پروفایل کاربری</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">مدیریت اطلاعات شخصی و حساب کاربری</p>
            </div>
            <div class="mt-4 md:mt-0">
                <button class="save-btn bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl">
                    ذخیره تغییرات
                </button>
            </div>
        </div>

        <!-- تب‌های پروفایل -->
        <div class="flex border-b border-gray-200 mb-6">
            <button class="tab-button px-4 py-3 font-medium text-gray-600 active">اطلاعات شخصی</button>
            <button class="tab-button px-4 py-3 font-medium text-gray-600">تغییر رمز عبور</button>
        </div>

        <!-- محتوای پروفایل -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- کارت آواتار و اطلاعات کلی -->
            <div class="profile-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 lg:col-span-1">
                <div class="p-6 flex flex-col items-center">
                    <div class="avatar-upload relative mb-4">
                        <div class="w-32 h-32 rounded-full bg-purple-100 border-4 border-white shadow-lg overflow-hidden">
                            <img id="avatar-preview" src="https://randomuser.me/api/portraits/men/32.jpg" alt="پروفایل کاربر" class="w-full h-full object-cover">
                        </div>
                        <label for="avatar-input" class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-md border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <input id="avatar-input" type="file" class="hidden" accept="image/*">
                        </label>
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 mt-2">محمد حسینی</h2>
                    <p class="text-gray-600 text-sm">هنرجوی موسیقی</p>

                    <div class="w-full mt-6 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">تاریخ عضویت:</span>
                            <span class="font-medium">۱۴۰۱/۰۵/۱۲</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">آخرین ورود:</span>
                            <span class="font-medium">۱۴۰۲/۰۵/۲۰ - ۱۸:۴۵</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">وضعیت حساب:</span>
                            <span class="text-green-600 font-medium">فعال</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- فرم اطلاعات شخصی -->
            <div class="profile-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 lg:col-span-2">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">اطلاعات شخصی</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- ردیف 1 -->
                        <div>
                            <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">نام</label>
                            <input type="text" id="first-name" value="محمد" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">نام خانوادگی</label>
                            <input type="text" id="last-name" value="حسینی" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>

                        <!-- ردیف 2 -->
                        <div>
                            <label for="father-name" class="block text-sm font-medium text-gray-700 mb-1">نام پدر</label>
                            <input type="text" id="father-name" value="علی" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="id-number" class="block text-sm font-medium text-gray-700 mb-1">شماره شناسنامه</label>
                            <input type="text" id="id-number" value="۱۲۳۴۵۶" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>

                        <!-- ردیف 3 -->
                        <div>
                            <label for="issue-place" class="block text-sm font-medium text-gray-700 mb-1">محل صدور</label>
                            <input type="text" id="issue-place" value="تهران" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="national-code" class="block text-sm font-medium text-gray-700 mb-1">کد ملی</label>
                            <input type="text" id="national-code" value="۰۰۱۲۳۴۵۶۷۸" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>

                        <!-- ردیف 4 -->
                        <div>
                            <label for="marital-status" class="block text-sm font-medium text-gray-700 mb-1">وضعیت تاهل</label>
                            <select id="marital-status" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="single" selected>مجرد</option>
                                <option value="married">متاهل</option>
                            </select>
                        </div>
                        <div>
                            <label for="education" class="block text-sm font-medium text-gray-700 mb-1">مدرک تحصیلی</label>
                            <select id="education" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="diploma" selected>دیپلم</option>
                                <option value="bachelor">لیسانس</option>
                                <option value="master">فوق لیسانس</option>
                                <option value="phd">دکترا</option>
                            </select>
                        </div>

                        <!-- ردیف 5 -->
                        <div>
                            <label for="field" class="block text-sm font-medium text-gray-700 mb-1">رشته تحصیلی</label>
                            <input type="text" id="field" value="مهندسی کامپیوتر" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="job" class="block text-sm font-medium text-gray-700 mb-1">شغل</label>
                            <input type="text" id="job" value="برنامه نویس" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>

                    <!-- اطلاعات تماس -->
                    <h3 class="text-lg font-bold text-gray-800 mt-8 mb-4">اطلاعات تماس</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">تلفن همراه</label>
                            <input type="tel" id="phone" value="۰۹۱۲۳۴۵۶۷۸۹" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">ایمیل</label>
                            <input type="email" id="email" value="m.hosseini@example.com" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // تغییر آواتار
        document.getElementById('avatar-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('avatar-preview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // تغییر تب‌ها
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</x-layouts.app>
