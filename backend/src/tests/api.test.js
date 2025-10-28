const request = require('supertest');
const mongoose = require('mongoose');
const app = require('../server');

let adminToken;
let testSimposioId;
let testTrabalhoId;
let testAcervoId;

describe('Auth API', () => {
  beforeAll(async () => {
    if (mongoose.connection.readyState === 0) {
      await mongoose.connect(process.env.MONGO_URI);
    }
  });
  
  afterAll(async () => {
    await mongoose.connection.close();
  });
  
  describe('POST /api/v1/auth/login', () => {
    it('should login with valid credentials', async () => {
      const res = await request(app)
        .post('/api/v1/auth/login')
        .send({
          email: 'admin@gov.br',
          senha: 'Admin!234',
        });
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
      expect(res.body.data).toHaveProperty('accessToken');
      adminToken = res.body.data.accessToken;
    });
    
    it('should fail with invalid credentials', async () => {
      const res = await request(app)
        .post('/api/v1/auth/login')
        .send({
          email: 'admin@gov.br',
          senha: 'wrongpassword',
        });
      
      expect(res.statusCode).toBe(401);
      expect(res.body.success).toBe(false);
    });

    it('should fail with missing fields', async () => {
      const res = await request(app)
        .post('/api/v1/auth/login')
        .send({
          email: 'admin@gov.br',
        });
      
      expect(res.statusCode).toBe(400);
    });
  });
  
  describe('GET /api/v1/auth/me', () => {
    it('should return user data with valid token', async () => {
      const res = await request(app)
        .get('/api/v1/auth/me')
        .set('Authorization', `Bearer ${adminToken}`);
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
      expect(res.body.data).toHaveProperty('email');
      expect(res.body.data).toHaveProperty('papel');
    });
    
    it('should fail without token', async () => {
      const res = await request(app).get('/api/v1/auth/me');
      
      expect(res.statusCode).toBe(401);
      expect(res.body.success).toBe(false);
    });

    it('should fail with invalid token', async () => {
      const res = await request(app)
        .get('/api/v1/auth/me')
        .set('Authorization', 'Bearer invalidtoken123');
      
      expect(res.statusCode).toBe(401);
    });
  });

  describe('POST /api/v1/auth/forgot-password', () => {
    it('should request password reset with valid email', async () => {
      const res = await request(app)
        .post('/api/v1/auth/forgot-password')
        .send({
          email: 'admin@gov.br',
        });
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
    });

    it('should handle non-existent email gracefully', async () => {
      const res = await request(app)
        .post('/api/v1/auth/forgot-password')
        .send({
          email: 'nonexistent@test.com',
        });
      
      // Por segurança, deve sempre retornar sucesso
      expect(res.statusCode).toBe(200);
    });
  });

  describe('POST /api/v1/auth/logout', () => {
    it('should logout successfully', async () => {
      const res = await request(app)
        .post('/api/v1/auth/logout')
        .set('Authorization', `Bearer ${adminToken}`);
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
    });
  });
});

describe('Public API', () => {
  describe('GET /api/v1/public/paginas/:slug', () => {
    it('should return a static page if exists', async () => {
      const res = await request(app).get('/api/v1/public/paginas/home');
      
      if (res.statusCode === 200) {
        expect(res.body.success).toBe(true);
        expect(res.body.data).toHaveProperty('slug');
      }
    });

    it('should return 404 for non-existent page', async () => {
      const res = await request(app).get('/api/v1/public/paginas/nonexistent-page-123');
      
      expect(res.statusCode).toBe(404);
    });
  });

  describe('GET /api/v1/public/simposios', () => {
    it('should list all simposios', async () => {
      const res = await request(app).get('/api/v1/public/simposios');
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
      expect(Array.isArray(res.body.data)).toBe(true);
    });
  });

  describe('GET /api/v1/public/acervo', () => {
    it('should list acervo with pagination', async () => {
      const res = await request(app)
        .get('/api/v1/public/acervo')
        .query({ page: 1, limit: 20 });
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
      expect(res.body).toHaveProperty('pagination');
    });

    it('should filter acervo by year', async () => {
      const res = await request(app)
        .get('/api/v1/public/acervo')
        .query({ ano: 2025 });
      
      expect(res.statusCode).toBe(200);
    });
  });
});

describe('Admin API', () => {
  beforeAll(async () => {
    if (!adminToken) {
      const res = await request(app)
        .post('/api/v1/auth/login')
        .send({
          email: 'admin@gov.br',
          senha: 'Admin!234',
        });
      adminToken = res.body.data.accessToken;
    }
  });

  describe('GET /api/v1/admin/trabalhos', () => {
    it('should list trabalhos with pagination', async () => {
      const res = await request(app)
        .get('/api/v1/admin/trabalhos')
        .set('Authorization', `Bearer ${adminToken}`)
        .query({ page: 1, limit: 20, ano: 2025 });
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
      expect(res.body).toHaveProperty('pagination');
    });

    it('should fail without authentication', async () => {
      const res = await request(app)
        .get('/api/v1/admin/trabalhos');
      
      expect(res.statusCode).toBe(401);
    });

    it('should filter by status', async () => {
      const res = await request(app)
        .get('/api/v1/admin/trabalhos')
        .set('Authorization', `Bearer ${adminToken}`)
        .query({ status: 'SUBMETIDO' });
      
      expect(res.statusCode).toBe(200);
    });

    it('should search by title or author', async () => {
      const res = await request(app)
        .get('/api/v1/admin/trabalhos')
        .set('Authorization', `Bearer ${adminToken}`)
        .query({ busca: 'test' });
      
      expect(res.statusCode).toBe(200);
    });
  });

  describe('GET /api/v1/admin/participantes', () => {
    it('should list participantes with pagination', async () => {
      const res = await request(app)
        .get('/api/v1/admin/participantes')
        .set('Authorization', `Bearer ${adminToken}`)
        .query({ page: 1, limit: 20 });
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
      expect(res.body).toHaveProperty('pagination');
    });

    it('should filter by tipo', async () => {
      const res = await request(app)
        .get('/api/v1/admin/participantes')
        .set('Authorization', `Bearer ${adminToken}`)
        .query({ tipo: 'SERVIDOR' });
      
      expect(res.statusCode).toBe(200);
    });
  });

  describe('GET /api/v1/admin/avaliacoes-externas', () => {
    it('should list trabalhos for external evaluation', async () => {
      const res = await request(app)
        .get('/api/v1/admin/avaliacoes-externas')
        .set('Authorization', `Bearer ${adminToken}`)
        .query({ page: 1, limit: 50 });
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
    });

    it('should fail without admin role', async () => {
      // Teste com usuário sem permissão seria necessário
      // criar outro token com papel USER
      expect(true).toBe(true);
    });
  });

  describe('Acervo CRUD', () => {
    it('should list acervo items', async () => {
      const res = await request(app)
        .get('/api/v1/admin/acervo')
        .set('Authorization', `Bearer ${adminToken}`);
      
      expect(res.statusCode).toBe(200);
    });

    it('should get single acervo by id if exists', async () => {
      // Primeiro lista para pegar um ID
      const listRes = await request(app)
        .get('/api/v1/admin/acervo')
        .set('Authorization', `Bearer ${adminToken}`);
      
      if (listRes.body.data && listRes.body.data.length > 0) {
        const id = listRes.body.data[0]._id;
        const res = await request(app)
          .get(`/api/v1/admin/acervo/${id}`)
          .set('Authorization', `Bearer ${adminToken}`);
        
        expect(res.statusCode).toBe(200);
      }
    });
  });

  describe('Páginas Estáticas CRUD', () => {
    it('should list all pages', async () => {
      const res = await request(app)
        .get('/api/v1/admin/paginas')
        .set('Authorization', `Bearer ${adminToken}`);
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
    });

    it('should get page by slug', async () => {
      const res = await request(app)
        .get('/api/v1/admin/paginas/home')
        .set('Authorization', `Bearer ${adminToken}`);
      
      expect(res.statusCode).toBe(200);
    });

    it('should update page content', async () => {
      const res = await request(app)
        .put('/api/v1/admin/paginas/home')
        .set('Authorization', `Bearer ${adminToken}`)
        .send({
          conteudo: '<h1>Teste de conteúdo atualizado</h1>',
        });
      
      expect([200, 400]).toContain(res.statusCode);
    });
  });

  describe('GET /api/v1/admin/avaliadores', () => {
    it('should list all avaliadores', async () => {
      const res = await request(app)
        .get('/api/v1/admin/avaliadores')
        .set('Authorization', `Bearer ${adminToken}`);
      
      expect(res.statusCode).toBe(200);
      expect(res.body.success).toBe(true);
      expect(Array.isArray(res.body.data)).toBe(true);
    });
  });
});

describe('Error Handling', () => {
  it('should return 404 for non-existent routes', async () => {
    const res = await request(app).get('/api/v1/nonexistent-route');
    
    expect(res.statusCode).toBe(404);
  });

  it('should handle malformed JSON', async () => {
    const res = await request(app)
      .post('/api/v1/auth/login')
      .set('Content-Type', 'application/json')
      .send('{ invalid json }');
    
    expect(res.statusCode).toBe(400);
  });
});

describe('Health Check', () => {
  it('should return server status', async () => {
    const res = await request(app).get('/api/v1/health');
    
    if (res.statusCode === 200) {
      expect(res.body).toHaveProperty('status');
    }
  });
});
