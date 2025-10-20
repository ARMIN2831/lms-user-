<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سامانه اساتید موسیقی</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/api.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap');

        :root {
            --primary: #4f46e5;
            --secondary: #7c3aed;
            --accent: #10b981;
            --error: #ef4444;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }

        .form-container {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            border-radius: 1.5rem;
            overflow: hidden;
            background: white;
            /*transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;*/
        }

        /*.form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.15);
        }*/

        .progress-container {
            height: 10px;
            background-color: #e2e8f0;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            background-size: 200% 100%;
            animation: gradient 3s ease infinite;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            padding: 1.5rem 2rem;
            position: relative;
            background: linear-gradient(to right, #f9fafb, #f3f4f6);
        }

        .step-label {
            position: absolute;
            top: 100%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding-top: 0.75rem;
        }

        .step-label span {
            font-size: 0.75rem;
            font-weight: 500;
            color: #64748b;
            text-align: center;
            width: 25%;
            transition: all 0.3s ease;
        }

        .step-label span.active {
            color: var(--primary);
            font-weight: 600;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .step-number {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            background-color: #e2e8f0;
            color: #64748b;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .step.active .step-number {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
            transform: scale(1.1);
        }

        .step.completed .step-number {
            background: linear-gradient(135deg, var(--accent), #34d399);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);
        }

        .step-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e2e8f0;
            transform: translateY(-50%);
            z-index: 1;
        }

        .form-step {
            display: none;
            padding: 2rem;
            animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-step.active {
            display: block;
        }

        .input-field {
            position: relative;
            margin-bottom: 1.75rem;
        }

        .input-field input,
        .input-field select {
            width: 100%;
            padding: 1rem 1rem 1rem 3.25rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.875rem;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
            background-color: #f8fafc;
            line-height: 1.5;
        }

        .input-field.error input,
        .input-field.error select {
            border-color: var(--error);
            background-color: rgba(239, 68, 68, 0.05);
        }

        .input-icon {
            position: absolute;
            left: 1.25rem;
            top: 1.2rem;
            color: #64748b;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            transform: none;
        }

        .input-field.error .input-icon {
            color: var(--error);
        }

        .input-field input:focus + .input-icon,
        .input-field select:focus + .input-icon {
            color: var(--primary);
        }

        .error-message {
            display: none;
            color: var(--error);
            font-size: 0.75rem;
            margin-top: 0.25rem;
            padding-right: 0.5rem;
            animation: fadeIn 0.3s ease;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 1.75rem;
            border-radius: 0.875rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            font-size: 0.9375rem;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #4338ca, #6d28d9);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-outline {
            border: 1px solid #e2e8f0;
            background-color: white;
            color: #64748b;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-outline:hover {
            border-color: #cbd5e1;
            color: #475569;
            background-color: #f8fafc;
        }

        .file-upload {
            border: 2px dashed #cbd5e1;
            border-radius: 0.875rem;
            padding: 2.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .file-upload:hover {
            border-color: var(--primary);
            background-color: rgba(79, 70, 229, 0.05);
        }

        .file-upload.active {
            border-color: var(--primary);
            background-color: rgba(79, 70, 229, 0.05);
        }

        .preview-image {
            max-width: 180px;
            max-height: 180px;
            border-radius: 0.875rem;
            margin: 1.5rem auto 0;
            display: none;
            object-fit: cover;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .preview-image:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.15);
        }

        .confirmation-container {
            background: linear-gradient(to bottom right, #f0f9ff, #e0f2fe);
            border-radius: 0.875rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .confirmation-item {
            display: flex;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 0.75rem;
            background-color: white;
            align-items: center;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .confirmation-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .confirmation-label {
            font-weight: 600;
            color: var(--primary);
            min-width: 120px;
        }

        .confirmation-value {
            color: #1e293b;
            font-weight: 500;
        }

        .confirmation-icon {
            margin-left: 0.75rem;
            color: var(--accent);
            font-size: 1.25rem;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 0.75rem;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        .checkbox-container:hover {
            background-color: #f1f5f9;
        }

        .checkbox-container input {
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 0.375rem;
            border: 1px solid #cbd5e1;
            appearance: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checkbox-container input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .checkbox-container input:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            font-size: 0.75rem;
        }

        .checkbox-container label {
            margin-right: 0.75rem;
            color: #374151;
            cursor: pointer;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 50%;
            font-size: 2.5rem;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @media (max-width: 640px) {
            .step-label span {
                font-size: 0.65rem;
            }

            .step-number {
                width: 2.25rem;
                height: 2.25rem;
                font-size: 0.875rem;
            }

            .form-step {
                padding: 1.5rem;
            }

            .file-upload {
                padding: 1.5rem;
            }

            .preview-image {
                max-width: 140px;
                max-height: 140px;
            }

            .logo {
                width: 100px;
                height: 100px;
                font-size: 2rem;
            }
        }.otp-header {
             background: linear-gradient(135deg, #f8fafc, #f1f5f9);
             padding: 1.5rem;
             border-radius: 1rem;
             border: 1px solid #e2e8f0;
         }

        .otp-container {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .otp-inputs {
            direction: ltr;
        }

        .otp-box {
            width: 3.5rem;
            height: 3.5rem;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            background: #f8fafc;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1e293b;
            outline: none;
        }

        .otp-box:focus {
            border-color: #8b5cf6;
            background: white;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            transform: scale(1.05);
        }

        .otp-box.filled {
            border-color: #10b981;
            background: #f0fdf4;
            color: #047857;
        }

        .otp-box.error {
            border-color: #ef4444;
            background: #fef2f2;
            color: #dc2626;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .otp-box:disabled {
            background: #f1f5f9;
            color: #94a3b8;
            cursor: not-allowed;
        }

        #verify-btn {
            position: relative;
            min-height: 3rem;
        }

        .btn-text, .btn-loading {
            transition: opacity 0.3s ease;
        }

        .btn-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        #verify-btn.loading .btn-text {
            opacity: 0;
        }

        #verify-btn.loading .btn-loading {
            opacity: 1;
        }

        #resend-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .otp-box {
                width: 3rem;
                height: 3rem;
                font-size: 1.25rem;
            }

            .otp-container {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .otp-box {
                width: 2.5rem;
                height: 2.5rem;
                font-size: 1.1rem;
            }

            .otp-inputs {
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">
<div class="w-full max-w-xl form-container">
    <!-- Form Steps -->
    <div class="form-content">
        <!-- Step 1: Phone Number -->
        <div class="form-step active" id="step-phone">
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-music"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mt-4">سامانه اساتید موسیقی</h2>
            </div>

            <div class="input-field">
                <input type="tel" id="nationalCode" placeholder="کد ملی" pattern="[0-9]{10}">
                <i class="input-icon fas fa-mobile-alt"></i>
                <div class="error-message" id="nationalCode-error"></div>
            </div>

            <div class="mt-8">
                <button onclick="checkPhone()" class="btn btn-primary w-full">
                    ادامه
                    <i class="fas fa-arrow-left ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 1: Phone OTP -->
        <div class="form-step" id="step-otp">
            <div class="logo-container mb-6">
                <div class="logo">
                    <i class="fas fa-music"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mt-4">سامانه اساتید موسیقی</h2>
            </div>

            <div class="text-center mb-8">
                <div class="otp-header mb-4">
                    <i class="fas fa-shield-check text-3xl text-purple-500 mb-3"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">تأیید شماره موبایل</h3>
                    <p class="text-gray-600">کد تأیید ۵ رقمی به شماره شما ارسال شد</p>
                    <p class="text-sm text-gray-500 mt-1" id="phone-display">۰۹۱۲••••۱۲۳</p>
                </div>
            </div>

            <!-- OTP Input Boxes -->
            <div class="otp-container mb-6">
                <div class="otp-inputs flex justify-center gap-3" id="otp-inputs">
                    <input type="text" maxlength="1" class="otp-box" data-index="0" inputmode="numeric" pattern="[0-9]">
                    <input type="text" maxlength="1" class="otp-box" data-index="1" inputmode="numeric" pattern="[0-9]">
                    <input type="text" maxlength="1" class="otp-box" data-index="2" inputmode="numeric" pattern="[0-9]">
                    <input type="text" maxlength="1" class="otp-box" data-index="3" inputmode="numeric" pattern="[0-9]">
                    <input type="text" maxlength="1" class="otp-box" data-index="4" inputmode="numeric" pattern="[0-9]">
                </div>
                <div class="error-message text-center mt-3" id="otp-error"></div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4">
                <button onclick="verifyOTP()" class="btn btn-primary w-full relative" id="verify-btn">
                    <span class="btn-text">تأیید و ادامه</span>
                    <div class="btn-loading hidden">
                        <i class="fas fa-spinner fa-spin ml-2"></i>
                        <span>در حال بررسی...</span>
                    </div>
                </button>

                <div class="text-center">
                    <button onclick="resendOTP()" class="text-sm text-purple-600 hover:text-purple-700 font-medium" id="resend-btn">
                        <i class="fas fa-redo ml-1"></i>
                        <span>ارسال مجدد کد</span>
                    </button>
                    <div class="text-xs text-gray-500 mt-2 hidden" id="countdown">
                        امکان ارسال مجدد تا <span id="countdown-timer">120</span> ثانیه دیگر
                    </div>
                </div>

                <div class="text-center">
                    <button onclick="backToPhone()" class="text-sm text-gray-600 hover:text-gray-700">
                        <i class="fas fa-arrow-right ml-1"></i>
                        تغییر شماره موبایل
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 2: Password (for existing users) -->
        <div class="form-step" id="step-password">
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-music"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mt-4">ورود به سامانه</h2>
                <p class="text-gray-600 mt-2">رمز عبور خود را وارد کنید</p>
            </div>

            <div class="input-field">
                <input type="password" id="password" placeholder="رمز عبور">
                <i class="input-icon fas fa-lock"></i>
                <div class="error-message" id="password-error"></div>
            </div>

            <div class="mt-8">
                <button onclick="login()" class="btn btn-primary w-full">
                    ورود
                    <i class="fas fa-sign-in-alt ml-2"></i>
                </button>
            </div>

            <div class="text-center mt-4">
                <button onclick="backToPhone()" class="text-sm text-gray-600 hover:text-primary">
                    <i class="fas fa-arrow-right ml-1"></i>
                    تغییر شماره موبایل
                </button>
            </div>
        </div>

        <!-- Step 3: Personal Info (for new users) -->
        <div class="form-step" id="step-profile">
            <!-- Progress Bar -->
            <div class="progress-container">
                <div class="progress-bar" id="progress-bar" style="width: 25%"></div>
            </div>

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step-line"></div>
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                </div>
                {{--<div class="step" data-step="4">
                    <div class="step-number">4</div>
                </div>--}}
            </div>

            <div id="profile-steps">
                <!-- Step 1: Personal Info -->
                <div class="form-step active" id="step-1">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">اطلاعات شخصی</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="input-field">
                            <input type="text" id="firstName" placeholder="نام">
                            <i class="input-icon fas fa-user"></i>
                            <div class="error-message" id="firstName-error"></div>
                        </div>

                        <div class="input-field">
                            <input type="text" id="lastName" placeholder="نام خانوادگی">
                            <i class="input-icon fas fa-users"></i>
                            <div class="error-message" id="lastName-error"></div>
                        </div>

                        <div class="input-field">
                            <input type="text" id="fatherName" placeholder="نام پدر">
                            <i class="input-icon fas fa-user-friends"></i>
                            <div class="error-message" id="fatherName-error"></div>
                        </div>

                        <div class="input-field">
                            <input type="text" id="idNumber" placeholder="شماره شناسنامه">
                            <i class="input-icon fas fa-id-card"></i>
                            <div class="error-message" id="idNumber-error"></div>
                        </div>

                        <div class="input-field">
                            <input type="text" id="issuePlace" placeholder="محل صدور">
                            <i class="input-icon fas fa-map-marker-alt"></i>
                            <div class="error-message" id="issuePlace-error"></div>
                        </div>

                        <div class="input-field">
                            <input type="text" id="nationalCode" placeholder="کد ملی" pattern="[0-9]{10}">
                            <i class="input-icon fas fa-id-badge"></i>
                            <div class="error-message" id="nationalCode-error"></div>
                        </div>

                        <div class="input-field">
                            <select id="maritalStatus">
                                <option value="">وضعیت تاهل</option>
                                <option value="0">مجرد</option>
                                <option value="1">متأهل</option>
                            </select>
                            <i class="input-icon fas fa-heart"></i>
                            <div class="error-message" id="maritalStatus-error"></div>
                        </div>

                        <div class="input-field">
                            <select id="education">
                                <option value="">مدرک تحصیلی</option>
                                <option value="دیپلم">دیپلم</option>
                                <option value="لیسانس">لیسانس</option>
                                <option value="فوق لیسانس">فوق لیسانس</option>
                                <option value="دکترا">دکترا</option>
                            </select>
                            <i class="input-icon fas fa-graduation-cap"></i>
                            <div class="error-message" id="education-error"></div>
                        </div>

                        <div class="input-field">
                            <input type="text" id="field" placeholder="رشته تخصصی">
                            <i class="input-icon fas fa-music"></i>
                            <div class="error-message" id="field-error"></div>
                        </div>

                        <div class="input-field">
                            <input type="text" id="job" placeholder="شغل">
                            <i class="input-icon fas fa-briefcase"></i>
                            <div class="error-message" id="job-error"></div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button onclick="backToPhone()" class="btn btn-outline">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </button>
                        <button onclick="nextProfileStep(1, 2)" class="btn btn-primary">
                            ادامه
                            <i class="fas fa-arrow-left ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Photo Upload -->
                <div class="form-step" id="step-2">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">تصویر پرسنلی</h2>

                    <div class="file-upload" id="upload-container">
                        <i class="fas fa-cloud-upload-alt text-4xl text-blue-500 mb-3"></i>
                        <p class="text-gray-600 mb-1">تصویر خود را اینجا رها کنید</p>
                        <p class="text-sm text-gray-500 mb-3">یا برای انتخاب فایل کلیک کنید</p>
                        <button type="button" class="btn btn-outline px-4 py-2 text-sm">
                            <i class="fas fa-folder-open ml-2"></i>
                            انتخاب فایل
                        </button>
                        <input type="file" id="profilePhoto" accept="image/*" class="hidden">
                        <img id="preview" class="preview-image">
                        <div class="error-message text-center mt-2" id="photo-error"></div>
                    </div>

                    <p class="text-xs text-gray-500 mt-2 text-center">حداکثر حجم فایل: 2MB • فرمت‌های مجاز: JPG, PNG</p>

                    <div class="flex justify-between mt-8">
                        <button onclick="prevProfileStep(2, 1)" class="btn btn-outline">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </button>
                        <button onclick="nextProfileStep(2, 3)" class="btn btn-primary">
                            ادامه
                            <i class="fas fa-arrow-left ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Confirmation -->
                <div class="form-step" id="step-3">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">تأیید نهایی</h2>

                    <div class="confirmation-container">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-check-circle text-green-500 text-2xl ml-2"></i>
                            <p class="text-gray-700 font-medium">لطفاً اطلاعات وارد شده را بررسی نمایید</p>
                        </div>

                        <div class="confirmation-item">
                            <i class="confirmation-icon fas fa-user"></i>
                            <span class="confirmation-label">نام کامل:</span>
                            <span class="confirmation-value" id="confirm-name"></span>
                        </div>

                        <div class="confirmation-item">
                            <i class="confirmation-icon fas fa-id-card"></i>
                            <span class="confirmation-label">کد ملی:</span>
                            <span class="confirmation-value" id="confirm-national-code"></span>
                        </div>

                        <div class="confirmation-item">
                            <i class="confirmation-icon fas fa-mobile-alt"></i>
                            <span class="confirmation-label">شماره موبایل:</span>
                            <span class="confirmation-value" id="confirm-phone"></span>
                        </div>

                        <div class="confirmation-item">
                            <i class="confirmation-icon fas fa-music"></i>
                            <span class="confirmation-label">رشته تخصصی:</span>
                            <span class="confirmation-value" id="confirm-field"></span>
                        </div>
                    </div>

                    <div class="checkbox-container">
                        <input type="checkbox" id="confirmation">
                        <label for="confirmation">از صحت اطلاعات وارد شده اطمینان دارم</label>
                    </div>

                    <div class="error-message mb-4 text-center" id="confirmation-error"></div>

                    <div class="flex justify-between">
                        <button onclick="prevProfileStep(3, 2)" class="btn btn-outline">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </button>
                        <button id="submit-btn" onclick="submitForm()" class="btn btn-primary disabled:opacity-50" disabled>
                            تکمیل ثبت نام
                            <i class="fas fa-check ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // OTP Management
    let otpTimer = null;
    let otpTimeLeft = 120;

    function initializeOTP() {
        const otpInputs = document.querySelectorAll('.otp-box');

        otpInputs.forEach((input, index) => {
            // Handle input
            input.addEventListener('input', (e) => {
                const value = e.target.value;

                if (value && /[0-9]/.test(value)) {
                    e.target.classList.add('filled');
                    e.target.classList.remove('error');

                    // Auto-focus next input
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                } else {
                    e.target.classList.remove('filled');
                }

                hideOTPError();
            });

            // Handle paste
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text').slice(0, 5);

                pasteData.split('').forEach((char, i) => {
                    if (i < otpInputs.length && /[0-9]/.test(char)) {
                        otpInputs[i].value = char;
                        otpInputs[i].classList.add('filled');
                    }
                });

                if (pasteData.length === 5) {
                    otpInputs[4].focus();
                }

                hideOTPError();
            });

            // Handle backspace
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

        // Start countdown for resend
        startResendCountdown();
    }

    function getOTP() {
        const otpInputs = document.querySelectorAll('.otp-box');
        let otp = '';

        otpInputs.forEach(input => {
            otp += input.value;
        });

        return otp;
    }

    function showOTPError(message) {
        const errorElement = document.getElementById('otp-error');
        const otpInputs = document.querySelectorAll('.otp-box');

        errorElement.textContent = message;
        errorElement.style.display = 'block';

        otpInputs.forEach(input => {
            input.classList.add('error');
        });
    }

    function hideOTPError() {
        const errorElement = document.getElementById('otp-error');
        const otpInputs = document.querySelectorAll('.otp-box');

        errorElement.style.display = 'none';

        otpInputs.forEach(input => {
            input.classList.remove('error');
        });
    }

    function startResendCountdown() {
        const resendBtn = document.getElementById('resend-btn');
        const countdownElement = document.getElementById('countdown');
        const countdownTimer = document.getElementById('countdown-timer');

        resendBtn.disabled = true;
        countdownElement.classList.remove('hidden');

        otpTimer = setInterval(() => {
            otpTimeLeft--;
            countdownTimer.textContent = otpTimeLeft;

            if (otpTimeLeft <= 0) {
                clearInterval(otpTimer);
                resendBtn.disabled = false;
                countdownElement.classList.add('hidden');
            }
        }, 1000);
    }

    async function verifyOTP() {
        const otp = getOTP();
        const verifyBtn = document.getElementById('verify-btn');

        if (otp.length !== 5) {
            showOTPError('لطفاً کد ۵ رقمی را کامل وارد کنید');
            return;
        }

        // Show loading
        verifyBtn.classList.add('loading');
        verifyBtn.disabled = true;
        hideOTPError();

        try {
            // Call your OTP verification API
            const response = await makeRequest('POST', 'fa', '{{ route('verifyOtp') }}', {
                code: otp,
                nationalCode: currentUserNationalCode
            });

            // Success - move to next step
            showToastAlert('کد با موفقیت تأیید شد', 'success');

            // Show profile completion steps
            document.getElementById('step-otp').classList.remove('active');
            document.getElementById('step-profile').classList.add('active');
            nextProfileStep(1, 2);

        } catch (error) {
            let errorMessage = "کد وارد شده معتبر نیست";

            if (error.response && error.response.data) {
                if (error.response.data.message) {
                    errorMessage = error.response.data.message;
                } else if (error.response.data.errors) {
                    errorMessage = Object.values(error.response.data.errors)[0][0];
                }
            }

            showOTPError(errorMessage);
        } finally {
            verifyBtn.classList.remove('loading');
            verifyBtn.disabled = false;
        }
    }

    async function resendOTP() {
        const resendBtn = document.getElementById('resend-btn');

        // Show loading on resend button
        const originalHTML = resendBtn.innerHTML;
        resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin ml-1"></i><span>در حال ارسال...</span>';
        resendBtn.disabled = true;

        try {
            // Call your OTP resend API
            await makeRequest('POST', 'fa', '{{ route('userCheck') }}', {
                nationalCode: currentUserNationalCode
            });

            showToastAlert('کد جدید ارسال شد', 'success');

            // Reset countdown
            clearInterval(otpTimer);
            otpTimeLeft = 120;
            startResendCountdown();

        } catch (error) {
            let errorMessage = "خطا در ارسال کد";

            if (error.response && error.response.data) {
                if (error.response.data.message) {
                    errorMessage = error.response.data.message;
                } else if (error.response.data.errors) {
                    errorMessage = Object.values(error.response.data.errors)[0][0];
                }
            }

            showToastAlert(errorMessage, 'error');
        } finally {
            resendBtn.innerHTML = originalHTML;
        }
    }

    // Initialize OTP when step is shown
    document.addEventListener('DOMContentLoaded', function() {
        // Watch for OTP step activation
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    if (mutation.target.id === 'step-otp' && mutation.target.classList.contains('active')) {
                        initializeOTP();
                        // Set phone number in display
                        document.getElementById('phone-display').textContent =
                            currentUserNationalCode ? `کد ملی: ${currentUserNationalCode}` : '۰۹۱۲••••۱۲۳';
                    }
                }
            });
        });

        observer.observe(document.getElementById('step-otp'), {
            attributes: true,
            attributeFilter: ['class']
        });
    });



    // Global variables
    let currentUserNationalCode = '';
    let isExistingUser = false;

    // Show error for a specific field
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const errorElement = document.getElementById(`${fieldId}-error`);

        if (field && errorElement) {
            field.parentElement.classList.add('error');
            errorElement.textContent = message;
            errorElement.style.display = 'block';

            // Scroll to the error field
            field.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            // اگر المان خطا پیدا نشد، یک alert نمایش دهید
            alert(message);
        }
    }

    // Hide error for a specific field
    function hideError(fieldId) {
        const field = document.getElementById(fieldId);
        const errorElement = document.getElementById(`${fieldId}-error`);

        field.parentElement.classList.remove('error');
        errorElement.style.display = 'none';
    }

    // Clear all errors
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(el => {
            el.style.display = 'none';
        });

        document.querySelectorAll('.input-field').forEach(el => {
            el.classList.remove('error');
        });
    }

    // Check phone number
    async function checkPhone() {
        clearErrors();

        const nationalCode = document.getElementById('nationalCode').value;

        if (!nationalCode) {
            showError('nationalCode', 'لطفاً کدملی را وارد کنید');
            return;
        }
        const type = 'students';


        // Show loading
        const btn = document.querySelector('#step-phone button');
        const originalText = btn.innerHTML;
        btn.innerHTML = `
            <span>در حال بررسی...</span>
            <i class="fas fa-spinner fa-spin ml-2"></i>
        `;
        btn.disabled = true;

        const response = await makeRequest('POST','fa', '{{ route('userCheck') }}', {nationalCode, type})
            .then(data => {
                currentUserNationalCode = nationalCode;
                isExistingUser = data.verified; // تغییر از response.verified به data.verified

                if (isExistingUser) {
                    // Show password step
                    document.getElementById('step-phone').classList.remove('active');
                    document.getElementById('step-password').classList.add('active');
                } else {
                    if (data.remaining_time) otpTimeLeft = data.remaining_time;
                    document.getElementById('step-phone').classList.remove('active');
                    document.getElementById('step-otp').classList.add('active');
                }
            })
            .catch(err => {
                let errorMessage = "خطایی رخ داده است";

                if (err.response && err.response.data) {
                    if (err.response.data.message) {
                        errorMessage = err.response.data.message;
                    }
                    else if (err.response.data.errors) {
                        errorMessage = Object.values(err.response.data.errors)[0][0];
                    }
                } else if (err.message) {
                    errorMessage = err.message;
                }

                showError('nationalCode', errorMessage);
            })
            .finally(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
    }

    // Back to phone input
    function backToPhone() {
        clearErrors();
        document.querySelectorAll('.form-step').forEach(step => {
            step.classList.remove('active');
        });
        document.getElementById('step-phone').classList.add('active');
    }

    // Login with password
    async function login() {
        clearErrors();

        const password = document.getElementById('password').value;
        const nationalCode = currentUserNationalCode;
        const type = 'students';

        if (!password) {
            showError('password', 'لطفاً رمز عبور را وارد کنید');
            return;
        } else if (password.length < 6) {
            showError('password', 'رمز عبور باید حداقل 6 کاراکتر باشد');
            return;
        }

        // Show loading
        const btn = document.querySelector('#step-password button');
        const originalText = btn.innerHTML;
        btn.innerHTML = `
            <span>در حال ورود...</span>
            <i class="fas fa-spinner fa-spin ml-2"></i>
        `;
        btn.disabled = true;


        const response = await makeRequest('POST', 'fa', '{{ route('userLogin') }}', {password,nationalCode,type}, true)
            .then(data => {
                localStorage.setItem('access_token', data.access_token);
                const successMessage = document.createElement('div');
                successMessage.className = 'fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50';
                successMessage.innerHTML = `
                <div class="bg-white rounded-xl p-6 max-w-sm w-full mx-4 text-center animate-fadeIn">
                    <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">ورود موفقیت‌آمیز بود!</h3>
                    <p class="text-gray-600 mb-4">خوش آمدید استاد گرامی</p>
                    <button onclick="this.parentElement.parentElement.remove(); location.reload();" class="btn btn-primary w-full">
                        باشه
                    </button>
                </div>
            `;
                document.body.appendChild(successMessage);
            })
            .catch(err => {
                let errorMessage = "خطایی رخ داده است";

                if (err.response && err.response.data) {
                    if (err.response.data.message) {
                        errorMessage = err.response.data.message;
                    }
                    else if (err.response.data.errors) {
                        errorMessage = Object.values(err.response.data.errors)[0][0];
                    }
                } else if (err.message) {
                    errorMessage = err.message;
                }

                showError('password', errorMessage);
            })
            .finally(() => {
                // Reset button
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
    }

    // Profile completion steps
    function nextProfileStep(current, next) {
        clearErrors();

        if (validateProfileStep(current)) {
            document.getElementById(`step-${current}`).classList.remove('active');
            document.getElementById(`step-${next}`).classList.add('active');
            updateProgress(next);

            // Fill confirmation data if going to last step
            if (next === 3) {
                fillConfirmationData();
            }
        }
    }

    function prevProfileStep(current, prev) {
        clearErrors();
        document.getElementById(`step-${current}`).classList.remove('active');
        document.getElementById(`step-${prev}`).classList.add('active');
        updateProgress(prev);
    }

    // Update progress bar and steps
    function updateProgress(currentStep) {
        const progressPercentage = (currentStep / 3) * 100;
        document.getElementById('progress-bar').style.width = `${progressPercentage}%`;

        // Update step indicators
        document.querySelectorAll('.step').forEach((step, index) => {
            const stepNumber = parseInt(step.getAttribute('data-step'));
            step.classList.remove('active', 'completed');

            if (stepNumber < currentStep) {
                step.classList.add('completed');
            } else if (stepNumber === currentStep) {
                step.classList.add('active');
            }
        });
    }

    // Validate profile step
    function validateProfileStep(step) {
        let isValid = true;

        if (step === 1) {
            const requiredFields = [
                'firstName', 'lastName', 'fatherName', 'idNumber',
                'issuePlace', 'nationalCode', 'maritalStatus',
                'education', 'field', 'job'
            ];

            for (const field of requiredFields) {
                const element = document.getElementById(field);
                if (!element.value) {
                    showError(field, `لطفاً این فیلد را پر کنید`);
                    isValid = false;
                }
            }

            // Validate national code
            const nationalCode = document.getElementById('nationalCode').value;
            if (nationalCode && !/^\d{10}$/.test(nationalCode)) {
                showError('nationalCode', 'کد ملی باید 10 رقم باشد');
                isValid = false;
            }
        } else if (step === 2) {
            const fileInput = document.getElementById('profilePhoto');
            if (!fileInput.files || fileInput.files.length === 0) {
                showError('photo', 'لطفاً تصویر پرسنلی خود را آپلود کنید');
                isValid = false;
            } else {
                const file = fileInput.files[0];
                const validTypes = ['image/jpeg', 'image/png'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!validTypes.includes(file.type)) {
                    showError('photo', 'فرمت فایل باید JPG یا PNG باشد');
                    isValid = false;
                } else if (file.size > maxSize) {
                    showError('photo', 'حجم فایل باید کمتر از 2MB باشد');
                    isValid = false;
                }
            }
        }

        return isValid;
    }

    // File Upload Handling
    document.getElementById('upload-container').addEventListener('click', () => {
        document.getElementById('profilePhoto').click();
    });

    document.getElementById('profilePhoto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const uploadContainer = document.getElementById('upload-container');
            uploadContainer.classList.add('active');

            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('preview');
                preview.src = event.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);

            // Hide error if exists
            hideError('photo');
        }
    });

    // Drag and Drop for file upload
    const uploadContainer = document.getElementById('upload-container');

    uploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadContainer.classList.add('active');
    });

    uploadContainer.addEventListener('dragleave', () => {
        uploadContainer.classList.remove('active');
    });

    uploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadContainer.classList.remove('active');

        const file = e.dataTransfer.files[0];
        if (file) {
            document.getElementById('profilePhoto').files = e.dataTransfer.files;
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('preview');
                preview.src = event.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);

            // Hide error if exists
            hideError('photo');
        }
    });

    // Confirmation Checkbox
    document.getElementById('confirmation').addEventListener('change', function() {
        document.getElementById('submit-btn').disabled = !this.checked;

        // Hide error if exists
        if (this.checked) {
            document.getElementById('confirmation-error').style.display = 'none';
        }
    });

    // Fill confirmation data
    function fillConfirmationData() {
        document.getElementById('confirm-name').textContent =
            `${document.getElementById('firstName').value} ${document.getElementById('lastName').value}`;
        document.getElementById('confirm-national-code').textContent =
            document.getElementById('nationalCode').value;
        document.getElementById('confirm-phone').textContent =
            currentUserNationalCode;
        document.getElementById('confirm-field').textContent =
            document.getElementById('field').value;
    }

    // Form Submission
    async function submitForm() {
        if (!document.getElementById('confirmation').checked) {
            document.getElementById('confirmation-error').textContent = 'لطفاً تأیید کنید که از صحت اطلاعات اطمینان دارید';
            document.getElementById('confirmation-error').style.display = 'block';
            return;
        }

        const submitBtn = document.getElementById('submit-btn');
        const originalText = submitBtn.innerHTML;

        // Show loading state
        submitBtn.innerHTML = `
        <span>در حال ثبت اطلاعات...</span>
        <i class="fas fa-spinner fa-spin ml-2"></i>
    `;
        submitBtn.disabled = true;

        // Disable all fields
        const allInputs = document.querySelectorAll('input, select, button');
        allInputs.forEach(input => {
            input.disabled = true;
        });

        // جمع‌آوری تمام اطلاعات فرم
        const formData = new FormData();

        // اطلاعات پایه
        formData.append('nationalCode', currentUserNationalCode);
        formData.append('type', 'students');

        // اطلاعات شخصی
        formData.append('firstName', document.getElementById('firstName').value);
        formData.append('lastName', document.getElementById('lastName').value);
        formData.append('fatherName', document.getElementById('fatherName').value);
        formData.append('idNumber', document.getElementById('idNumber').value);
        formData.append('issuePlace', document.getElementById('issuePlace').value);
        formData.append('nationalCode', document.getElementById('nationalCode').value);
        formData.append('maritalStatus', document.getElementById('maritalStatus').value);
        formData.append('education', document.getElementById('education').value);
        formData.append('field', document.getElementById('field').value);
        formData.append('job', document.getElementById('job').value);

        // فایل تصویر
        const photoFile = document.getElementById('profilePhoto').files[0];
        if (photoFile) {
            formData.append('profilePhoto', photoFile);
        }

        // ارسال اطلاعات به سرور
        const response = await makeRequest('POST', 'fa', '{{ route('completeProfile') }}', formData, true)
            .then(data => {
                localStorage.setItem('access_token', data.access_token);
                const successMessage = document.createElement('div');
                successMessage.className = 'fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50';
                successMessage.innerHTML = `
            <div class="bg-white rounded-xl p-6 max-w-sm w-full mx-4 text-center animate-fadeIn">
                <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">ثبت نام با موفقیت انجام شد!</h3>
                <p class="text-gray-600 mb-4">اطلاعات شما با موفقیت ثبت گردید</p>
                <button onclick="this.parentElement.parentElement.remove(); location.reload();" class="btn btn-primary w-full">
                    باشه
                </button>
            </div>
        `;
                document.body.appendChild(successMessage);
            })
            .catch(err => {
                let errorMessage = "خطایی در ثبت اطلاعات رخ داده است";

                if (err.response && err.response.data) {
                    if (err.response.data.message) {
                        errorMessage = err.response.data.message;
                    }
                    else if (err.response.data.errors) {
                        // نمایش اولین خطای اعتبارسنجی
                        const firstError = Object.values(err.response.data.errors)[0][0];
                        errorMessage = firstError;
                    }
                } else if (err.message) {
                    errorMessage = err.message;
                }

                // نمایش خطا در یک المان مناسب
                const errorContainer = document.getElementById('confirmation-error');
                errorContainer.textContent = errorMessage;
                errorContainer.style.display = 'block';

                // اسکرول به خطا
                errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });

            })
            .finally(() => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                // Enable all fields
                allInputs.forEach(input => {
                    input.disabled = false;
                });
            });
    }
</script>
</body>
</html>
