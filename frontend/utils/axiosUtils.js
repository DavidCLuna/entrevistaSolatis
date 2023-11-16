async function axiosFunctionUtil(method, endpoint, data = null) {
    try {
        const response = await axios({
            method: method,
            url: `${API_BACKEND}${endpoint}`,
            data: data
        });
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;  // Re-lanza el error para que pueda ser manejado en la parte que llama a esta función.
    }
}
