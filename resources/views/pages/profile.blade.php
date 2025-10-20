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

        .skeleton-avatar {
            width: 8rem;
            height: 8rem;
            border-radius: 50%;
        }

        .skeleton-text {
            height: 1rem;
            margin-bottom: 0.5rem;
        }

        .skeleton-input {
            height: 2.5rem;
            border-radius: 0.5rem;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* استایل برای آپلود عکس */
        .avatar-uploading {
            opacity: 0.7;
            pointer-events: none;
        }

        .avatar-uploading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* استایل‌های جدید برای حالت دیزیبل */
        .disabled-input {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            color: #6b7280;
            cursor: not-allowed;
            opacity: 0.8;
        }

        .disabled-input:focus {
            outline: none;
            border-color: #e5e7eb;
            box-shadow: none;
        }

        .edit-btn {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.2);
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.3);
        }

        .cancel-btn {
            transition: all 0.3s ease;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .cancel-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-white p-4 md:p-8 font-sans" x-data="profilePage()">
        <!-- اسکلتون لودینگ هدر -->
        <template x-if="loading">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
                <div class="w-full md:w-1/2">
                    <div class="skeleton skeleton-text w-48 mb-2"></div>
                    <div class="skeleton skeleton-text w-64"></div>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="skeleton skeleton-input w-32 h-12"></div>
                </div>
            </div>
        </template>

        <!-- هدر صفحه (داینامیک) -->
        <template x-if="!loading">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">پروفایل کاربری</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">مدیریت اطلاعات شخصی و حساب کاربری</p>
                </div>
            </div>
        </template>

        <!-- تب‌های پروفایل -->
        <div class="flex border-b border-gray-200 mb-6">
            <button @click="activeTab = 'profile'" :class="{'active': activeTab === 'profile'}" class="tab-button px-4 py-3 font-medium text-gray-600">اطلاعات شخصی</button>
            <button @click="activeTab = 'password'" :class="{'active': activeTab === 'password'}" class="tab-button px-4 py-3 font-medium text-gray-600">تغییر رمز عبور</button>
        </div>

        <!-- تب اطلاعات شخصی -->
        <template x-if="activeTab === 'profile'">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- کارت آواتار و اطلاعات کلی (اسکلتون) -->
                <template x-if="loading">
                    <div class="profile-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 lg:col-span-1">
                        <div class="p-6 flex flex-col items-center">
                            <div class="skeleton skeleton-avatar mb-4"></div>
                            <div class="skeleton skeleton-text w-32 mb-2"></div>
                            <div class="skeleton skeleton-text w-24 mb-6"></div>

                            <div class="w-full mt-6 space-y-3">
                                <div class="skeleton skeleton-text w-full"></div>
                                <div class="skeleton skeleton-text w-full"></div>
                                <div class="skeleton skeleton-text w-full"></div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- کارت آواتار و اطلاعات کلی (داینامیک) -->
                <template x-if="!loading">
                    <div class="profile-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 lg:col-span-1">
                        <div class="p-6 flex flex-col items-center">
                            <div class="avatar-upload relative mb-4" :class="{'avatar-uploading': uploadingAvatar}">
                                <div class="w-32 h-32 rounded-full bg-purple-100 border-4 border-white shadow-lg overflow-hidden">
                                    <img id="avatar-preview" :src="user.avatar || '{{ asset('images/avatars/default-avatar.png') }}'" alt="پروفایل کاربر" class="w-full h-full object-cover">
                                    <div x-show="uploadingAvatar" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-full">
                                        <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <label for="avatar-input" class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-md border border-gray-200" :class="{'opacity-50': uploadingAvatar}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <input id="avatar-input" type="file" class="hidden" accept="image/*" @change="handleAvatarUpload" :disabled="uploadingAvatar">
                                </label>
                            </div>

                            <h2 class="text-xl font-bold text-gray-800 mt-2" x-text="user.full_name || 'نام کاربر'"></h2>
                            <p class="text-gray-600 text-sm" x-text="user.role || 'هنرجوی موسیقی'"></p>

                            <div class="w-full mt-6 space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">تاریخ تولد:</span>
                                    <span class="font-medium" x-text="user.birth_date || 'نامشخص'"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">وضعیت حساب:</span>
                                    <span class="text-green-600 font-medium" x-text="user.status || 'فعال'"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- فرم اطلاعات شخصی (اسکلتون) -->
                <template x-if="loading">
                    <div class="profile-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 lg:col-span-2">
                        <div class="p-6">
                            <div class="skeleton skeleton-text w-48 mb-6"></div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- 12 input skeleton -->
                                <template x-for="i in 12" :key="i">
                                    <div>
                                        <div class="skeleton skeleton-text w-24 mb-1"></div>
                                        <div class="skeleton skeleton-input w-full"></div>
                                    </div>
                                </template>
                            </div>

                            <div class="skeleton skeleton-text w-48 mt-8 mb-4"></div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <template x-for="i in 2" :key="i">
                                    <div>
                                        <div class="skeleton skeleton-text w-24 mb-1"></div>
                                        <div class="skeleton skeleton-input w-full"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- فرم اطلاعات شخصی (داینامیک) -->
                <template x-if="!loading">
                    <div class="profile-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 lg:col-span-2">
                        <div class="p-6">
                            <div class="flex flex-row justify-between items-center mb-6">
                                <h3 class="text-lg font-bold text-gray-800 flex items-center">اطلاعات شخصی</h3>
                                <div class="action-buttons">
                                    <!-- دکمه ویرایش (نمایش در حالت دیزیبل) -->
                                    <template x-if="!editMode">
                                        <button @click="enableEditMode" class="edit-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            ویرایش اطلاعات
                                        </button>
                                    </template>

                                    <!-- دکمه‌های حالت ویرایش -->
                                    <template x-if="editMode">
                                        <button @click="cancelEdit" class="cancel-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            انصراف
                                        </button>
                                    </template>
                                    <template x-if="editMode">

                                        <button @click="updateProfile" :disabled="updating" class="save-btn bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                                            <template x-if="!updating">
                                                <span class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    ثبت تغییرات
                                                </span>
                                            </template>
                                            <template x-if="updating">
                                                <div class="flex items-center gap-2">
                                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    در حال ذخیره...
                                                </div>
                                            </template>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- ردیف 1 -->
                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">نام</label>
                                    <input type="text" id="first-name" x-model="formData.first_name"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>
                                <div>
                                    <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">نام خانوادگی</label>
                                    <input type="text" id="last-name" x-model="formData.last_name"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>

                                <!-- ردیف 2 -->
                                <div>
                                    <label for="father-name" class="block text-sm font-medium text-gray-700 mb-1">نام پدر</label>
                                    <input type="text" id="father-name" x-model="formData.father_name"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>
                                <div>
                                    <label for="id-number" class="block text-sm font-medium text-gray-700 mb-1">شماره شناسنامه</label>
                                    <input type="text" id="id-number" x-model="formData.id_number"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>

                                <!-- ردیف 3 -->
                                <div>
                                    <label for="issue-place" class="block text-sm font-medium text-gray-700 mb-1">محل صدور</label>
                                    <input type="text" id="issue-place" x-model="formData.issue_place"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>
                                <div>
                                    <label for="national-code" class="block text-sm font-medium text-gray-700 mb-1">کد ملی</label>
                                    <input type="text" id="national-code" x-model="formData.national_code"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>

                                <!-- ردیف 4 -->
                                <div>
                                    <label for="marital-status" class="block text-sm font-medium text-gray-700 mb-1">وضعیت تاهل</label>
                                    <select id="marital-status" x-model="formData.marital_status"
                                            :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                            :disabled="!editMode">
                                        <option value="0">مجرد</option>
                                        <option value="1">متاهل</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="education" class="block text-sm font-medium text-gray-700 mb-1">مدرک تحصیلی</label>
                                    <select id="education" x-model="formData.education"
                                            :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                            :disabled="!editMode">
                                        <option value="diploma">دیپلم</option>
                                        <option value="bachelor">لیسانس</option>
                                        <option value="master">فوق لیسانس</option>
                                        <option value="phd">دکترا</option>
                                    </select>
                                </div>

                                <!-- ردیف 5 -->
                                <div>
                                    <label for="field" class="block text-sm font-medium text-gray-700 mb-1">رشته تحصیلی</label>
                                    <input type="text" id="field" x-model="formData.field"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>
                                <div>
                                    <label for="job" class="block text-sm font-medium text-gray-700 mb-1">شغل</label>
                                    <input type="text" id="job" x-model="formData.job"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>
                            </div>

                            <!-- اطلاعات تماس -->
                            <h3 class="text-lg font-bold text-gray-800 mt-8 mb-4">اطلاعات تماس</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="mobile" class="block text-sm font-medium text-gray-700 mb-1">تلفن همراه</label>
                                    <input type="tel" id="mobile" x-model="formData.mobile"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">ایمیل</label>
                                    <input type="email" id="email" x-model="formData.email"
                                           :class="editMode ? 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500' : 'disabled-input w-full px-4 py-2 border border-gray-200 rounded-lg'"
                                           :disabled="!editMode">
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </template>

        <!-- تب تغییر رمز عبور -->
        <template x-if="activeTab === 'password'">
            <div class="profile-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">تغییر رمز عبور</h3>

                    <div class="grid grid-cols-1 gap-4 max-w-2xl">
                        <div>
                            <label for="current-password" class="block text-sm font-medium text-gray-700 mb-1">رمز عبور فعلی</label>
                            <input type="password" id="current-password" x-model="passwordData.current_password" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="رمز عبور فعلی خود را وارد کنید">
                        </div>

                        <div>
                            <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">رمز عبور جدید</label>
                            <input type="password" id="new-password" x-model="passwordData.new_password" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="رمز عبور جدید خود را وارد کنید">
                        </div>

                        <div>
                            <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">تکرار رمز عبور جدید</label>
                            <input type="password" id="confirm-password" x-model="passwordData.new_password_confirmation" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="رمز عبور جدید خود را تکرار کنید">
                        </div>

                        <div class="mt-4">
                            <button @click="changePassword" :disabled="changingPassword" class="save-btn bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                                <template x-if="!changingPassword">
                                    <span>تغییر رمز عبور</span>
                                </template>
                                <template x-if="changingPassword">
                                    <div class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        در حال تغییر...
                                    </div>
                                </template>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <script>
        function profilePage() {
            return {
                loading: true,
                updating: false,
                uploadingAvatar: false,
                changingPassword: false,
                activeTab: 'profile',
                editMode: false, // حالت جدید برای مدیریت ویرایش
                originalFormData: {}, // برای ذخیره داده‌های اصلی
                user: {},
                formData: {
                    first_name: '',
                    last_name: '',
                    father_name: '',
                    id_number: '',
                    issue_place: '',
                    national_code: '',
                    marital_status: '0',
                    education: 'diploma',
                    field: '',
                    job: '',
                    mobile: '',
                    email: ''
                },
                passwordData: {
                    current_password: '',
                    new_password: '',
                    new_password_confirmation: ''
                },

                async init() {
                    await waitForCheckToken();
                    await this.fetchUserProfile();

                    // تغییر تب‌ها
                    document.querySelectorAll('.tab-button').forEach(button => {
                        button.addEventListener('click', function() {
                            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                            this.classList.add('active');
                        });
                    });
                },

                async fetchUserProfile() {
                    try {
                        const response = await makeRequest('GET', 'fa', '{{ route('getUser') }}');
                        const user = response.user;
                        let student;
                        if(response.user.user_type_id === 1) student = user.teacher;
                        if(response.user.user_type_id === 2) student = user.student;

                        this.user = {
                            full_name: student.name + " " + student.family,
                            role: 'هنرجوی موسیقی',
                            avatar: student.image ? student.image : '{{ asset('images/avatars/default-avatar.png') }}',
                            birth_date: student.bday ? new Date(student.bday * 1000).toLocaleDateString('fa-IR') : 'نامشخص',
                            status: user.active === 1 ? "فعال" : "غیرفعال"
                        };

                        this.formData = {
                            first_name: student.name,
                            last_name: student.family,
                            father_name: student.father,
                            id_number: student.Pno,
                            issue_place: student.sodor,
                            national_code: student.Mid,
                            marital_status: student.married.toString(),
                            education: student.madrak,
                            field: student.field,
                            job: student.job,
                            mobile: user.mobile,
                            email: user.email
                        };

                        // ذخیره داده‌های اصلی برای امکان بازگشت
                        this.originalFormData = {...this.formData};

                    } catch (err) {
                        showToastAlert(err, 'error');
                    } finally {
                        this.loading = false;
                    }
                },

                // فعال کردن حالت ویرایش
                enableEditMode() {
                    this.editMode = true;
                },

                // لغو ویرایش و بازگشت به حالت اول
                cancelEdit() {
                    this.editMode = false;
                    // بازگرداندن داده‌ها به حالت اولیه
                    this.formData = {...this.originalFormData};
                },

                async updateProfile() {
                    this.updating = true;

                    try {
                        const response = await makeRequest('POST', 'fa', '{{ route('updateProfile') }}', this.formData);
                        showToastAlert(response.message, 'success');

                        // به‌روزرسانی داده‌های اصلی
                        this.originalFormData = {...this.formData};
                        this.editMode = false;

                        // به‌روزرسانی نام کاربر در کارت آواتار
                        this.user.full_name = this.formData.first_name + " " + this.formData.last_name;

                    } catch (err) {
                        showToastAlert(err, 'error');
                    } finally {
                        this.updating = false;
                    }
                },

                async handleAvatarUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    if (file.size > 2 * 1024 * 1024) {
                        showToastAlert({ message: 'حجم فایل باید کمتر از 2 مگابایت باشد' }, 'error');
                        return;
                    }

                    if (!file.type.startsWith('image/')) {
                        showToastAlert({ message: 'لطفاً یک فایل تصویر انتخاب کنید' }, 'error');
                        return;
                    }

                    this.uploadingAvatar = true;

                    try {
                        const formData = new FormData();
                        formData.append('avatar', file);

                        const response = await makeRequest('POST', 'fa', '{{ route('uploadProfile') }}', formData, true);

                        // آپدیت آواتار در صفحه
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.user.avatar = e.target.result;
                            document.getElementById('avatar-preview').src = e.target.result;
                        };
                        reader.readAsDataURL(file);

                        showToastAlert(response.message, 'success');
                    } catch (error) {
                        showToastAlert(error, 'error');
                    } finally {
                        this.uploadingAvatar = false;
                    }
                },

                async changePassword() {
                    // اعتبارسنجی اولیه
                    if (!this.passwordData.current_password || !this.passwordData.new_password) {
                        showToastAlert({ message: 'لطفاً تمام فیلدها را پر کنید' }, 'error');
                        return;
                    }

                    if (this.passwordData.new_password !== this.passwordData.new_password_confirmation) {
                        showToastAlert({ message: 'رمز عبور جدید با تکرار آن مطابقت ندارد' }, 'error');
                        return;
                    }

                    this.changingPassword = true;

                    try {
                        const response = await makeRequest('POST', 'fa', '{{ route('changePassword') }}', this.passwordData);
                        showToastAlert(response.message, 'success');

                        // پاک کردن فرم پس از موفقیت
                        this.passwordData = {
                            current_password: '',
                            new_password: '',
                            new_password_confirmation: ''
                        };
                    } catch (error) {
                        showToastAlert(error, 'error');
                    } finally {
                        this.changingPassword = false;
                    }
                }
            };
        }
    </script>
</x-layouts.app>
