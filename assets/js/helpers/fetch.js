/**
 * Fetch class to handle HTTP requests with interceptors and base URL.
 */
class Fetch {
    #baseURL;
    #requestInterceptors;
    #responseInterceptors;

    constructor() {
        this.#baseURL = '';
        this.#requestInterceptors = [];
        this.#responseInterceptors = [];
    }

    /**
     * Prepends a base URL to requests.
     * 
     * @param {string} baseURL - The base URL to prepend to requests.
     */
    addBaseURL(baseURL) {
        this.#baseURL = baseURL;
    }

    /**
     * Method to add a request interceptor.
     * 
     * @param {function} interceptor - The interceptor function to modify request options.
     */
    addRequestInterceptor(interceptor) {
        this.#requestInterceptors.push(interceptor);
    }

    /**
     * Method to add a response interceptor.
     * 
     * @param {function} interceptor - The interceptor function to modify response data.
     */
    addResponseInterceptor(interceptor) {
        this.#responseInterceptors.push(interceptor);
    }

    /**
     * Method to make a GET request.
     * 
     * @param {string} url - The URL to send the request to.
     * @param {object} params - URL parameters (optional).
     * @param {object} headers - Request headers (optional).
     * @returns {Promise<object>} The response data.
     */
    async get(url, params = {}, headers = {}) {
        const fullUrl = this.#urlParamsAppend(this.#getFullUrl(url), params);
        return this.#makeRequest(fullUrl, { method: 'GET', headers });
    }

    /**
     * Method to make a POST request.
     * 
     * @param {string} url - The URL to send the request to.
     * @param {object} data - The data to send in the request body (optional).
     * @param {object} headers - Request headers (optional).
     * @returns {Promise<object>} The response data.
     */
    async post(url, data = {}, headers = { 'Content-Type': 'application/json' }) {
        const fullUrl = this.#getFullUrl(url);
        return this.#makeRequest(fullUrl, { method: 'POST', headers, body: JSON.stringify(data) });
    }

    /**
     * Method to make a PUT request.
     * 
     * @param {string} url - The URL to send the request to.
     * @param {object} data - The data to send in the request body (optional).
     * @param {object} params - URL parameters (optional).
     * @param {object} headers - Request headers (optional).
     * @returns {Promise<object>} The response data.
     */
    async put(url, data = {}, params = {}, headers = { 'Content-Type': 'application/json' }) {
        const fullUrl = this.#urlParamsAppend(this.#getFullUrl(url), params);
        return this.#makeRequest(fullUrl, { method: 'PUT', headers, body: JSON.stringify(data) });
    }

    /**
     * Method to make a PATCH request.
     * 
     * @param {string} url - The URL to send the request to.
     * @param {object} data - The data to send in the request body (optional).
     * @param {object} params - URL parameters (optional).
     * @param {object} headers - Request headers (optional).
     * @returns {Promise<object>} The response data.
     */
    async patch(url, data = {}, params = {}, headers = { 'Content-Type': 'application/json' }) {
        const fullUrl = this.#urlParamsAppend(this.#getFullUrl(url), params);
        return this.#makeRequest(fullUrl, { method: 'PATCH', headers, body: JSON.stringify(data) });
    }

    /**
     * Method to make a DELETE request.
     * 
     * @param {string} url - The URL to send the request to.
     * @param {object} params - URL parameters (optional).
     * @param {object} headers - Request headers (optional).
     * @returns {Promise<object>} The response data.
     */
    async delete(url, params = {}, headers = {}) {
        const fullUrl = this.#urlParamsAppend(this.#getFullUrl(url), params);
        return this.#makeRequest(fullUrl, { method: 'DELETE', headers });
    }

    /**
     * Private method to handle the common logic for making HTTP requests.
     * 
     * @param {string} url - The URL to send the request to.
     * @param {object} options - The options for the fetch call.
     * @returns {Promise<object>} A promise resolving to the response data.
     */
    async #makeRequest(url, options) {
        // Apply request interceptors
        for (const interceptor of this.#requestInterceptors) {
            options = await interceptor(url, options);
        }

        try {
            const response = await fetch(url, options);
            let data;

            // Handle successful responses
            if (response.ok) {
                data = response.status === 204 ? null : await response.json();
            } else {
                // Handle error responses
                try {
                    data = await response.json();
                } catch (error) {
                    // If the response is not JSON, fall back to response text
                    data = await response.text();
                }

                // Create an error object with additional information
                const error = new Error(`HTTP error! status: ${response.status}`);
                error.response = response;
                error.data = data;
                throw error; // Throw the error to be caught in the calling code
            }

            // Apply response interceptors
            for (const interceptor of this.#responseInterceptors) {
                data = await interceptor(data, response);
            }

            // Return the response and data
            return { response, data };
        } catch (error) {
            // Rethrow the error to be handled by the caller
            throw error;
        }
    }

    /**
     * Private method to get the full URL by prepending the base URL.
     * 
     * @param {string} url - The URL to prepend the base URL to.
     * @returns {string} The full URL.
     */
    #getFullUrl(url) {
        return this.#baseURL ? `${this.#baseURL}${url}` : url;
    }

    /**
     * Private method to append URL parameters to the URL.
     * 
     * @param {string} url - The URL to append parameters to.
     * @param {object} params - The URL parameters.
     * @returns {string} The URL with appended parameters.
     */
    #urlParamsAppend(url, params) {
        const queryString = new URLSearchParams(params).toString();
        return queryString ? `${url}?${queryString}` : url;
    }
}

export default Fetch;