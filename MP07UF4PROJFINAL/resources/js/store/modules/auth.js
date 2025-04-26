import axios from 'axios';

export default {
    namespaced: true,
    state: {
        isAuthenticated: false,
        user: null,
        token: null
    },
    mutations: {
        SET_AUTH(state, { user, token }) {
            state.isAuthenticated = true;
            state.user = user;
            state.token = token;
            localStorage.setItem('token', token);
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        },
        CLEAR_AUTH(state) {
            state.isAuthenticated = false;
            state.user = null;
            state.token = null;
            localStorage.removeItem('token');
            delete axios.defaults.headers.common['Authorization'];
        }
    },
    actions: {
        initialize({ commit }) {
            const token = localStorage.getItem('token');
            if (token) {
                commit('SET_AUTH', { user: null, token });
                axios.get('/api/me')
                    .then(response => {
                        commit('SET_AUTH', { user: response.data, token });
                    })
                    .catch(() => {
                        commit('CLEAR_AUTH');
                    });
            }
        },
        async login({ commit }, credentials) {
            try {
                const response = await axios.post('/api/login', credentials);
                commit('SET_AUTH', {
                    user: response.data.user,
                    token: response.data.access_token
                });
                return true;
            } catch (error) {
                console.error('Login failed:', error);
                return false;
            }
        },
        async register({ commit }, userData) {
            try {
                const response = await axios.post('/api/register', {
                    name: userData.name,
                    email: userData.email,
                    password: userData.password,
                    password_confirmation: userData.password_confirmation
                });
                commit('SET_AUTH', {
                    user: response.data.user,
                    token: response.data.access_token
                });
                return true;
            } catch (error) {
                console.error('Registration failed:', error.response.data);
                throw error;
            }
        },
        async logout({ commit }) {
            try {
                await axios.post('/api/logout');
            } finally {
                commit('CLEAR_AUTH');
            }
        }
    }
};