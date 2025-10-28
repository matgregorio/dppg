const PaginasEstaticas = require('../models/PaginasEstaticas');
const path = require('path');
const fs = require('fs').promises;

/**
 * @swagger
 * /api/v1/admin/paginas:
 *   get:
 *     summary: Listar todas as páginas estáticas
 *     tags: [PaginasEstaticas]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: Lista de páginas
 */
exports.listar = async (req, res) => {
  try {
    const paginas = await PaginasEstaticas.find({ deleted_at: null })
      .sort({ slug: 1 })
      .lean();

    res.json({
      success: true,
      data: paginas,
    });
  } catch (error) {
    console.error('Erro ao listar páginas:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Erro ao listar páginas' 
    });
  }
};

/**
 * @swagger
 * /api/v1/admin/paginas/{slug}:
 *   get:
 *     summary: Buscar página por slug
 *     tags: [PaginasEstaticas]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: slug
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: Página encontrada
 *       404:
 *         description: Página não encontrada
 */
exports.buscarPorSlug = async (req, res) => {
  try {
    const pagina = await PaginasEstaticas.findOne({ 
      slug: req.params.slug,
      deleted_at: null 
    });
    
    if (!pagina) {
      return res.status(404).json({ 
        success: false, 
        message: 'Página não encontrada' 
      });
    }

    res.json({
      success: true,
      data: pagina,
    });
  } catch (error) {
    console.error('Erro ao buscar página:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Erro ao buscar página' 
    });
  }
};

/**
 * @swagger
 * /api/v1/admin/paginas/{slug}:
 *   put:
 *     summary: Atualizar ou criar página estática
 *     tags: [PaginasEstaticas]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: slug
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
 *               conteudo:
 *                 type: string
 *               linkExterno:
 *                 type: string
 *               pdf:
 *                 type: string
 *                 format: binary
 *     responses:
 *       200:
 *         description: Página atualizada com sucesso
 */
exports.atualizar = async (req, res) => {
  try {
    const { slug } = req.params;
    const { conteudo, linkExterno } = req.body;

    // Busca ou cria a página
    let pagina = await PaginasEstaticas.findOne({ slug });
    
    if (!pagina) {
      pagina = new PaginasEstaticas({ slug });
    }

    // Atualiza campos
    if (conteudo !== undefined) {
      pagina.conteudo = conteudo;
    }
    
    if (linkExterno !== undefined) {
      pagina.linkExterno = linkExterno || null;
    }

    // Se há novo PDF
    if (req.file) {
      // Remove PDF antigo se existir
      if (pagina.pdf) {
        const oldPath = path.join(__dirname, '../../uploads', pagina.pdf);
        try {
          await fs.unlink(oldPath);
        } catch (err) {
          console.error('Erro ao remover PDF antigo:', err);
        }
      }
      pagina.pdf = `paginas/${req.file.filename}`;
    }

    await pagina.save();

    res.json({
      success: true,
      message: 'Página atualizada com sucesso',
      data: pagina,
    });
  } catch (error) {
    console.error('Erro ao atualizar página:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Erro ao atualizar página' 
    });
  }
};

/**
 * @swagger
 * /api/v1/admin/paginas/{slug}/remover-pdf:
 *   delete:
 *     summary: Remover PDF de uma página
 *     tags: [PaginasEstaticas]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: slug
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: PDF removido com sucesso
 */
exports.removerPdf = async (req, res) => {
  try {
    const pagina = await PaginasEstaticas.findOne({ 
      slug: req.params.slug 
    });
    
    if (!pagina) {
      return res.status(404).json({ 
        success: false, 
        message: 'Página não encontrada' 
      });
    }

    if (pagina.pdf) {
      const pdfPath = path.join(__dirname, '../../uploads', pagina.pdf);
      try {
        await fs.unlink(pdfPath);
      } catch (err) {
        console.error('Erro ao remover PDF:', err);
      }
      pagina.pdf = null;
      await pagina.save();
    }

    res.json({ 
      success: true, 
      message: 'PDF removido com sucesso' 
    });
  } catch (error) {
    console.error('Erro ao remover PDF:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Erro ao remover PDF' 
    });
  }
};
