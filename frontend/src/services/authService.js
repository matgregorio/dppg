import api from './api';

export const authService = {
  login: async (email, senha) => {
    const { data } = await api.post('/auth/login', { email, senha });
    return data;
  },
  
  register: async (userData) => {
    const { data } = await api.post('/auth/register', userData);
    return data;
  },
  
  logout: async () => {
    const { data } = await api.post('/auth/logout');
    return data;
  },
  
  me: async () => {
    const { data } = await api.get('/auth/me');
    return data;
  },
  
  forgotPassword: async (email) => {
    const { data } = await api.post('/auth/forgot-password', { email });
    return data;
  },
};

export default authService;
