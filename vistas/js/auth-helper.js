/**
 * Helper de Autenticación
 * Maneja tokens y sesión desde sessionStorage
 */

const AuthHelper = {
    
    /**
     * Obtiene el token de autenticación
     * @returns {string|null}
     */
    getToken: function() {
        return sessionStorage.getItem('authToken');
    },
    
    /**
     * Obtiene el tipo de token (Bearer)
     * @returns {string}
     */
    getTokenType: function() {
        return sessionStorage.getItem('tokenType') || 'Bearer';
    },
    
    /**
     * Obtiene el header de autorización completo
     * @returns {string|null}
     */
    getAuthHeader: function() {
        const authHeader = sessionStorage.getItem('authHeader');
        
        // Si existe, retornarlo
        if (authHeader) {
            return authHeader;
        }
        
        // Si no existe, construirlo desde token y tipo
        const token = this.getToken();
        if (token) {
            return `${this.getTokenType()} ${token}`;
        }
        
        return null;
    },
    
    /**
     * Obtiene los datos del usuario
     * @returns {object}
     */
    getUserData: function() {
        return {
            userId: sessionStorage.getItem('userId'),
            username: sessionStorage.getItem('username'),
            nombre: sessionStorage.getItem('nombre'),
            roles: sessionStorage.getItem('roles')?.split(',') || []
        };
    },
    
    /**
     * Verifica si hay una sesión activa
     * @returns {boolean}
     */
    isAuthenticated: function() {
        return this.getToken() !== null;
    },
    
    /**
     * Cierra la sesión (limpia sessionStorage)
     */
    logout: function() {
        sessionStorage.clear();
        console.log('🔴 Sesión cerrada - sessionStorage limpiado');
        window.location.href = 'salir';
    },
    
    /**
     * Verifica si el token está expirado
     * @returns {boolean}
     */
    isTokenExpired: function() {
        const token = this.getToken();
        if (!token) return true;
        
        try {
            // Decodificar el payload del JWT (segunda parte)
            const payload = JSON.parse(atob(token.split('.')[1]));
            const expiracion = payload.exp * 1000; // Convertir a milisegundos
            
            return Date.now() >= expiracion;
        } catch (error) {
            console.error('Error al validar token:', error);
            return true;
        }
    },
    
    /**
     * Muestra información del token en consola (para debug)
     */
    debugToken: function() {
        console.group('🔐 Información de Autenticación');
        console.log('Token:', this.getToken());
        console.log('Tipo:', this.getTokenType());
        console.log('Auth Header:', this.getAuthHeader());
        console.log('Usuario:', this.getUserData());
        console.log('Autenticado:', this.isAuthenticated());
        console.log('Token expirado:', this.isTokenExpired());
        
        // Decodificar payload del token
        const token = this.getToken();
        if (token) {
            try {
                const payload = JSON.parse(atob(token.split('.')[1]));
                console.log('Payload JWT:', payload);
                
                if (payload.exp) {
                    const fechaExp = new Date(payload.exp * 1000);
                    console.log('Expira el:', fechaExp.toLocaleString());
                }
            } catch (e) {
                console.warn('No se pudo decodificar el token');
            }
        }
        
        console.groupEnd();
    },
    
    /**
     * Realizar petición a la API con autenticación
     * @param {string} url - URL de la API
     * @param {object} options - Opciones de fetch
     * @returns {Promise}
     */
    fetchAPI: async function(url, options = {}) {
        // Verificar autenticación
        if (!this.isAuthenticated()) {
            console.error('❌ No hay sesión activa');
            window.location.href = 'login';
            return Promise.reject('No autenticado');
        }
        
        // Verificar expiración
        if (this.isTokenExpired()) {
            console.error('❌ Token expirado');
            this.logout();
            return Promise.reject('Token expirado');
        }
        
        // Configurar headers por defecto
        const defaultOptions = {
            headers: {
                'Authorization': this.getAuthHeader(),
                'Content-Type': 'application/json'
            }
        };
        
        // Merge options
        const mergedOptions = {
            ...defaultOptions,
            ...options,
            headers: {
                ...defaultOptions.headers,
                ...options.headers
            }
        };
        
        console.log(`🌐 Petición API: ${options.method || 'GET'} ${url}`);
        
        try {
            const response = await fetch(url, mergedOptions);
            
            // Si el backend responde con 401 (no autorizado)
            if (response.status === 401) {
                console.error('❌ No autorizado - Redirigiendo a login');
                this.logout();
                return Promise.reject('No autorizado');
            }
            
            return response;
        } catch (error) {
            console.error('❌ Error en petición:', error);
            throw error;
        }
    }
};

// Hacer disponible globalmente
window.AuthHelper = AuthHelper;

// Log inicial cuando se carga el script
console.log('🔐 AuthHelper cargado');

// Si hay sesión, mostrar info
if (AuthHelper.isAuthenticated()) {
    console.log('✅ Sesión activa detectada');
}
