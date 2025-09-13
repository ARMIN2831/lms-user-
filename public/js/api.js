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
