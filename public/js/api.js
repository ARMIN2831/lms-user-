const mainFrontServerUrl = "http://tolueacademy.ir";
async function makeRequest(method, lan, url, data = {}, isFormData = false) {
    const config = {
        method: method,
        url: url,
        headers: {
            'user_lan': lan
        },
    };
    if (!isFormData) config.headers['Content-Type'] = 'application/json';

    config.data = data;
    const token = localStorage.getItem("access_token");
    if (token) config.headers["Authorization"] = `Bearer ${token}`;

    try {
        const response = await axios(config);
        return response.data;
    } catch (error) {
        throw error;
    }
}

// تابع برای بررسی اعتبار توکن
async function checkTokenValidity() {
    const token = localStorage.getItem("access_token");
    const currentPath = window.location.pathname;

    // اگر توکن وجود ندارد و کاربر در صفحه لاگین نیست، به صفحه لاگین هدایت می‌شود
    if (!token) {
        if (!isLoginPage(currentPath)) {
            redirectToLogin();
        }
        return false;
    }

    // اگر توکن وجود دارد، اعتبار آن را بررسی می‌کنیم
    if (token) {
        try {
            // این endpoint باید در بک‌اند شما وجود داشته باشد و وضعیت توکن را بررسی کند
            const response = await axios.get('/api/check-token', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'user_lan': 'fa'
                }
            });

            // اگر توکن معتبر است و کاربر در صفحه لاگین است، به داشبرد هدایت می‌شود
            if (isLoginPage(currentPath)) {
                redirectToDashboardOrSavedUrl();
            } else {
                // اگر در صفحه لاگین نیست و redirect_url وجود دارد، بررسی می‌کنیم
                checkAndRedirectToSavedUrl();
            }

            return true;

        } catch (error) {
            // اگر توکن نامعتبر است
            if (error.response && error.response.status === 401) {
                if (!isLoginPage(currentPath)) {
                    handleInvalidToken();
                }
            }
            return false;
        }
    }
}

// تابع برای بررسی اینکه آیا کاربر در صفحه لاگین است
function isLoginPage(path) {
    const loginPages = ['/login', '/auth/login', '/register', '/auth/register', '/signin', '/signup'];
    return loginPages.some(loginPage => path.startsWith(loginPage));
}

// تابع برای هدایت به صفحه لاگین
function redirectToLogin() {
    // فقط اگر در حال حاضر در صفحه لاگین نیستیم، redirect_url را ذخیره می‌کنیم
    if (!isLoginPage(window.location.pathname)) {
        localStorage.setItem('redirect_url', window.location.href);
    }
    window.location.href = '/login';
}

// تابع برای هدایت به داشبرد یا URL ذخیره شده
function redirectToDashboardOrSavedUrl() {
    const redirectUrl = localStorage.getItem('redirect_url');

    if (redirectUrl) {
        // حذف redirect_url از localStorage
        localStorage.removeItem('redirect_url');
        // هدایت به صفحه ذخیره شده
        window.location.href = redirectUrl;
    } else {
        // هدایت به صفحه پیش‌فرض (داشبرد)
        window.location.href = '/dashboard';
    }
}

// تابع برای بررسی و هدایت به URL ذخیره شده
function checkAndRedirectToSavedUrl() {
    const redirectUrl = localStorage.getItem('redirect_url');

    if (redirectUrl && redirectUrl !== window.location.href) {
        // حذف redirect_url از localStorage
        localStorage.removeItem('redirect_url');
        // هدایت به صفحه ذخیره شده
        window.location.href = redirectUrl;
    }
}

// تابع برای مدیریت توکن نامعتبر
function handleInvalidToken() {
    // پاک کردن توکن نامعتبر
    localStorage.removeItem('access_token');
    localStorage.removeItem('user_type');
    localStorage.removeItem('token_type');
    localStorage.removeItem('user_data');
    localStorage.removeItem('token_expiry');

    // هدایت به صفحه لاگین اگر در حال حاضر در آن صفحه نیست
    if (!isLoginPage(window.location.pathname)) {
        redirectToLogin();
    }
}

// همچنین می‌توانید یک interval برای بررسی دوره‌ای توکن تنظیم کنید
setInterval(() => {
    checkTokenValidity();
}, 5 * 60 * 1000); // هر 5 دقیقه بررسی کند

// وقتی صفحه load شد، توکن را بررسی کنید
document.addEventListener('DOMContentLoaded', function() {
    // کمی تاخیر برای اطمینان از لود کامل صفحه
    setTimeout(() => {
        checkTokenValidity();
    }, 100);
});

// تابع برای ذخیره اطلاعات کاربر و توکن
function saveAuthData(responseData) {
    if (responseData.access_token) {
        localStorage.setItem('access_token', responseData.access_token);
        localStorage.setItem('user_type', responseData.user_type);
        localStorage.setItem('token_type', responseData.token_type);

        // محاسبه تاریخ انقضا
        if (responseData.expires_in) {
            const expiryDate = new Date();
            expiryDate.setSeconds(expiryDate.getSeconds() + responseData.expires_in);
            localStorage.setItem('token_expiry', expiryDate.toISOString());
        }

        if (responseData.user) {
            localStorage.setItem('user_data', JSON.stringify(responseData.user));
        }

        return true;
    }
    return false;
}

// تابع برای بررسی آیا کاربر لاگین هست یا نه
function isLoggedIn() {
    return localStorage.getItem('access_token') !== null;
}

// تابع برای گرفتن توکن
function getToken() {
    return localStorage.getItem('access_token');
}

// تابع برای لاگ اوت
function logout() {
    // پاک کردن تمام اطلاعات احراز هویت
    localStorage.removeItem('access_token');
    localStorage.removeItem('user_type');
    localStorage.removeItem('token_type');
    localStorage.removeItem('user_data');
    localStorage.removeItem('token_expiry');

    // هدایت به صفحه لاگین
    window.location.href = '/login';
}


function showToastAlert(err, type = 'error', duration = 3000) {

    let message = 'خطا در دریافت اطلاعات کاربر';
    if (err.response && err.response.data) {
        if (err.response.data.message) message = err.response.data.message;
        else if (err.response.data.errors) message = Object.values(err.response.data.errors)[0][0];
    } else if (err.message) message = err.message;

    // ایجاد المان‌های toast
    const toastContainer = document.createElement('div');
    toastContainer.className = `toast-alert-container fixed top-4 left-4 right-4 z-50 flex justify-center`;

    const toast = document.createElement('div');
    toast.className = `toast-alert bg-white shadow-lg rounded-lg p-4 max-w-md w-full border-l-4 ${
        type === 'error' ? 'border-red-500' :
            type === 'success' ? 'border-green-500' :
                'border-blue-500'
    } transform -translate-y-full opacity-0 transition-all duration-500`;

    toast.innerHTML = `
        <div class="flex items-start justify-between">
            <div class="flex items-start">
                <svg class="w-5 h-5 mt-0.5 mr-2 ${
        type === 'error' ? 'text-red-500' :
            type === 'success' ? 'text-green-500' :
                'text-blue-500'
    }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${
        type === 'error' ?
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
            type === 'success' ?
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' :
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
    }
                </svg>
                <p class="text-gray-800 text-sm">${message}</p>
            </div>
            <button class="toast-close-btn text-gray-400 hover:text-gray-600 transition-colors duration-200 ml-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;

    toastContainer.appendChild(toast);
    document.body.appendChild(toastContainer);

    // انیمیشن نمایش
    setTimeout(() => {
        toast.classList.remove('-translate-y-full', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
    }, 10);

    // مدیریت کلیک روی دکمه بستن
    const closeBtn = toast.querySelector('.toast-close-btn');
    closeBtn.onclick = function() {
        hideToast(toast, toastContainer);
    };

    // بسته شدن خودکار بعد از مدت مشخص
    const timeoutId = setTimeout(() => {
        hideToast(toast, toastContainer);
    }, duration);

    // توقف تایمر وقتی موس روی toast است
    toast.addEventListener('mouseenter', () => {
        clearTimeout(timeoutId);
    });

    // ادامه تایمر وقتی موس از toast خارج می‌شود
    toast.addEventListener('mouseleave', () => {
        setTimeout(() => {
            hideToast(toast, toastContainer);
        }, 1000);
    });

    return {
        close: function() {
            hideToast(toast, toastContainer);
        }
    };
}

function hideToast(toast, container) {
    toast.classList.remove('translate-y-0', 'opacity-100');
    toast.classList.add('-translate-y-full', 'opacity-0');

    setTimeout(() => {
        if (container.parentNode) {
            document.body.removeChild(container);
        }
    }, 500);
}

function hideSkeleton(CName){
    const skeletonElements = document.querySelectorAll('.'+CName);
    skeletonElements.forEach(element => {
        element.classList.remove('skeleton-loading', 'animate-pulse');
        element.classList.remove('h-6', 'w-32', 'h-5', 'w-20', 'h-10', 'w-10', 'rounded');

        const svgElements = element.querySelectorAll('svg');
        svgElements.forEach(svg => {
            svg.classList.remove('opacity-0');
        });

        if (element.tagName === 'BUTTON' || element.tagName === 'SPAN' || element.tagName === 'IMG') {
            element.classList.add('fade-in');
        }
    });
}

// export functions for use in other files
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        makeRequest,
        checkTokenValidity,
        isLoginPage,
        redirectToLogin,
        redirectToDashboardOrSavedUrl,
        handleInvalidToken,
        saveAuthData,
        isLoggedIn,
        getToken,
        logout,
        showToastAlert,
        hideToast,
        hideSkeleton,
    };
}
