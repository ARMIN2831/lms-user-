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
        logout
    };
}
