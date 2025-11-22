const CONFIG = {
    //API_BASE_URL: 'https://backend-clinicarodriguez.onrender.com/api/',
    API_BASE_URL: 'http://localhost:8080/api/',
    
    // Obtener token desde sessionStorage (dinámico)
    get API_AUTH_HEADER() {
        const authHeader = sessionStorage.getItem('authHeader');
        
        if (authHeader) {
            return authHeader;
        }
        
        // Fallback: token hardcodeado para desarrollo (si no hay sesión)
        console.warn('⚠️ No hay token en sessionStorage, usando token de desarrollo');
        return 'null';
    }
};
