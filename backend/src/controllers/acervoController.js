const Acervo = require('../models/Acervo');
const path = require('path');
const fs = require('fs').promises;

/**
 * @swagger
 * /api/v1/admin/acervo:
 *   get:
 *     summary: Listar itens do acervo
 *     tags: [Acervo]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: query
 *         name: ano
 *         schema:
 *           type: number
 *       - in: query
 *         name: busca
 *         schema:
 *           type: string
 *       - in: query
 *         name: page
 *         schema:
 *           type: number
 *       - in: query
 *         name: limit
 *         schema:
 *           type: number
 *     responses:
 *       200:
 *         description: Lista de itens do acervo
 */
exports.listar = async (req, res) => {
  try {
    const { ano, busca, page = 1, limit = 20 } = req.query;
    const query = { deleted_at: null };

    if (ano) {
      query.anoEvento = parseInt(ano);
    }

    if (busca) {
      query.$or = [
        { titulo: { $regex: busca, $options: 'i' } },
        { autores: { $regex: busca, $options: 'i' } },
        { palavras_chave: { $regex: busca, $options: 'i' } },
      ];
    }

    const total = await Acervo.countDocuments(query);
    const acervos = await Acervo.find(query)
      .sort({ anoEvento: -1, titulo: 1 })
      .limit(limit * 1)
      .skip((page - 1) * limit)
      .lean();

    res.json({
      acervos,
      totalPages: Math.ceil(total / limit),
      currentPage: parseInt(page),
      total,
    });
  } catch (error) {
    console.error('Erro ao listar acervo:', error);
    res.status(500).json({ message: 'Erro ao listar acervo' });
  }
};

/**
 * @swagger
 * /api/v1/admin/acervo/{id}:
 *   get:
 *     summary: Buscar item do acervo por ID
 *     tags: [Acervo]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: Item do acervo encontrado
 *       404:
 *         description: Item não encontrado
 */
exports.buscarPorId = async (req, res) => {
  try {
    const acervo = await Acervo.findById(req.params.id);
    
    if (!acervo) {
      return res.status(404).json({ message: 'Item do acervo não encontrado' });
    }

    res.json(acervo);
  } catch (error) {
    console.error('Erro ao buscar item do acervo:', error);
    res.status(500).json({ message: 'Erro ao buscar item do acervo' });
  }
};

/**
 * @swagger
 * /api/v1/admin/acervo:
 *   post:
 *     summary: Criar novo item do acervo
 *     tags: [Acervo]
 *     security:
 *       - bearerAuth: []
 *     requestBody:
 *       required: true
 *       content:
 *         multipart/form-data:
 *           schema:
 *             type: object
 *             required:
 *               - titulo
 *               - anoEvento
 *             properties:
 *               titulo:
 *                 type: string
 *               anoEvento:
 *                 type: number
 *               autores:
 *                 type: string
 *               palavras_chave:
 *                 type: string
 *               arquivo:
 *                 type: string
 *                 format: binary
 *     responses:
 *       201:
 *         description: Item criado com sucesso
 */
exports.criar = async (req, res) => {
  try {
    const { titulo, anoEvento, autores, palavras_chave } = req.body;

    // Parse arrays se enviados como strings
    const autoresArray = typeof autores === 'string' 
      ? autores.split(',').map(a => a.trim()).filter(Boolean)
      : autores || [];
    
    const palavrasChaveArray = typeof palavras_chave === 'string'
      ? palavras_chave.split(',').map(p => p.trim()).filter(Boolean)
      : palavras_chave || [];

    const acervoData = {
      titulo,
      anoEvento: parseInt(anoEvento),
      autores: autoresArray,
      palavras_chave: palavrasChaveArray,
    };

    // Se há arquivo enviado
    if (req.file) {
      acervoData.arquivo = `acervo/${req.file.filename}`;
    }

    const acervo = new Acervo(acervoData);
    await acervo.save();

    res.status(201).json({
      message: 'Item do acervo criado com sucesso',
      acervo,
    });
  } catch (error) {
    console.error('Erro ao criar item do acervo:', error);
    
    // Se erro de duplicação
    if (error.code === 11000) {
      return res.status(400).json({
        message: 'Já existe um item com este título para este ano',
      });
    }

    res.status(500).json({ message: 'Erro ao criar item do acervo' });
  }
};

/**
 * @swagger
 * /api/v1/admin/acervo/{id}:
 *   put:
 *     summary: Atualizar item do acervo
 *     tags: [Acervo]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     requestBody:
 *       required: true
 *       content:
 *         multipart/form-data:
 *           schema:
 *             type: object
 *             properties:
 *               titulo:
 *                 type: string
 *               anoEvento:
 *                 type: number
 *               autores:
 *                 type: string
 *               palavras_chave:
 *                 type: string
 *               arquivo:
 *                 type: string
 *                 format: binary
 *     responses:
 *       200:
 *         description: Item atualizado com sucesso
 */
exports.atualizar = async (req, res) => {
  try {
    const acervo = await Acervo.findById(req.params.id);
    
    if (!acervo) {
      return res.status(404).json({ message: 'Item do acervo não encontrado' });
    }

    const { titulo, anoEvento, autores, palavras_chave } = req.body;

    // Atualiza campos
    if (titulo) acervo.titulo = titulo;
    if (anoEvento) acervo.anoEvento = parseInt(anoEvento);
    
    if (autores !== undefined) {
      acervo.autores = typeof autores === 'string'
        ? autores.split(',').map(a => a.trim()).filter(Boolean)
        : autores;
    }
    
    if (palavras_chave !== undefined) {
      acervo.palavras_chave = typeof palavras_chave === 'string'
        ? palavras_chave.split(',').map(p => p.trim()).filter(Boolean)
        : palavras_chave;
    }

    // Se há novo arquivo
    if (req.file) {
      // Remove arquivo antigo se existir
      if (acervo.arquivo) {
        const oldPath = path.join(__dirname, '../../uploads', acervo.arquivo);
        try {
          await fs.unlink(oldPath);
        } catch (err) {
          console.error('Erro ao remover arquivo antigo:', err);
        }
      }
      acervo.arquivo = `acervo/${req.file.filename}`;
    }

    await acervo.save();

    res.json({
      message: 'Item do acervo atualizado com sucesso',
      acervo,
    });
  } catch (error) {
    console.error('Erro ao atualizar item do acervo:', error);
    
    if (error.code === 11000) {
      return res.status(400).json({
        message: 'Já existe um item com este título para este ano',
      });
    }

    res.status(500).json({ message: 'Erro ao atualizar item do acervo' });
  }
};

/**
 * @swagger
 * /api/v1/admin/acervo/{id}:
 *   delete:
 *     summary: Excluir item do acervo (soft delete)
 *     tags: [Acervo]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: Item excluído com sucesso
 */
exports.excluir = async (req, res) => {
  try {
    const acervo = await Acervo.findById(req.params.id);
    
    if (!acervo) {
      return res.status(404).json({ message: 'Item do acervo não encontrado' });
    }

    await acervo.softDelete();

    res.json({ message: 'Item do acervo excluído com sucesso' });
  } catch (error) {
    console.error('Erro ao excluir item do acervo:', error);
    res.status(500).json({ message: 'Erro ao excluir item do acervo' });
  }
};

/**
 * @swagger
 * /api/v1/public/acervo:
 *   get:
 *     summary: Listar acervo público (sem autenticação)
 *     tags: [Acervo]
 *     parameters:
 *       - in: query
 *         name: ano
 *         schema:
 *           type: number
 *       - in: query
 *         name: busca
 *         schema:
 *           type: string
 *       - in: query
 *         name: page
 *         schema:
 *           type: number
 *       - in: query
 *         name: limit
 *         schema:
 *           type: number
 *     responses:
 *       200:
 *         description: Lista pública do acervo
 */
exports.listarPublico = async (req, res) => {
  try {
    const { ano, busca, page = 1, limit = 20 } = req.query;
    const query = { deleted_at: null };

    if (ano) {
      query.anoEvento = parseInt(ano);
    }

    if (busca) {
      query.$or = [
        { titulo: { $regex: busca, $options: 'i' } },
        { autores: { $regex: busca, $options: 'i' } },
        { palavras_chave: { $regex: busca, $options: 'i' } },
      ];
    }

    const total = await Acervo.countDocuments(query);
    const acervos = await Acervo.find(query)
      .select('-deleted_at -__v')
      .sort({ anoEvento: -1, titulo: 1 })
      .limit(limit * 1)
      .skip((page - 1) * limit)
      .lean();

    res.json({
      acervos,
      totalPages: Math.ceil(total / limit),
      currentPage: parseInt(page),
      total,
    });
  } catch (error) {
    console.error('Erro ao listar acervo público:', error);
    res.status(500).json({ message: 'Erro ao listar acervo' });
  }
};
