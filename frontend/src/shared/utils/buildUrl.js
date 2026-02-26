/**
 * Build a URL with query parameters
 * @param {string} baseUrl - Base API endpoint
 * @param {object} paramsObj - Key-value pairs of query parameters
 * @returns {string} Full URL with encoded query parameters
 */
export function buildUrl(baseUrl, paramsObj = {}) {
  const query = Object.entries(paramsObj)
    .filter(([_, value]) => value !== undefined && value !== null && value !== '')
    .map(([key, value]) => `${encodeURIComponent(key)}=${encodeURIComponent(value)}`)
    .join('&')

  return query ? `${baseUrl}?${query}` : baseUrl
}
