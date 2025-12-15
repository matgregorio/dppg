const path = require('path');
const fs = require('fs');
const { v4: uuidv4 } = require('uuid');
const multer = require('multer');

const uploadsDir = path.join(__dirname, '../../uploads');

// Criar diretórios de upload se não existirem
const ensureUploadDirs = () => {
  const dirs = [
    uploadsDir,
    path.join(uploadsDir, 'trabalhos'),
    path.join(uploadsDir, 'certificados'),
    path.join(uploadsDir, 'acervo'),
    path.join(uploadsDir, 'paginas'),
  ];
  
  dirs.forEach(dir => {
    if (!fs.existsSync(dir)) {
      fs.mkdirSync(dir, { recursive: true });
    }
  });
};

ensureUploadDirs();

/**
 * Salva um arquivo com nome UUID
 * @param {Buffer} fileBuffer - Buffer do arquivo
 * @param {string} originalName - Nome original do arquivo
 * @param {string} subfolder - Subpasta dentro de uploads
 * @returns {string} - Path relativo do arquivo salvo
 */
const saveFile = async (fileBuffer, originalName, subfolder = '') => {
  const ext = path.extname(originalName);
  const filename = `${uuidv4()}${ext}`;
  const dir = subfolder ? path.join(uploadsDir, subfolder) : uploadsDir;
  
  if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, { recursive: true });
  }
  
  const filepath = path.join(dir, filename);
  fs.writeFileSync(filepath, fileBuffer);
  
  return subfolder ? `${subfolder}/${filename}` : filename;
};

/**
 * Deleta um arquivo
 * @param {string} relativePath - Path relativo do arquivo
 */
const deleteFile = async (relativePath) => {
  if (!relativePath) return;
  
  const filepath = path.join(uploadsDir, relativePath);
  if (fs.existsSync(filepath)) {
    fs.unlinkSync(filepath);
  }
};

/**
 * Obtém o path absoluto de um arquivo
 * @param {string} relativePath - Path relativo
 * @returns {string} - Path absoluto
 */
const getAbsolutePath = (relativePath) => {
  if (!relativePath) return null;
  return path.join(uploadsDir, relativePath);
};

// Configuração do Multer para upload de arquivos do acervo
const storageAcervo = multer.diskStorage({
  destination: (req, file, cb) => {
    const dir = path.join(uploadsDir, 'acervo');
    if (!fs.existsSync(dir)) {
      fs.mkdirSync(dir, { recursive: true });
    }
    cb(null, dir);
  },
  filename: (req, file, cb) => {
    const ext = path.extname(file.originalname);
    const filename = `${uuidv4()}${ext}`;
    cb(null, filename);
  }
});

const uploadAcervo = multer({
  storage: storageAcervo,
  limits: { fileSize: 50 * 1024 * 1024 }, // 50MB
  fileFilter: (req, file, cb) => {
    const allowedTypes = /pdf|doc|docx/;
    const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = allowedTypes.test(file.mimetype);
    
    if (extname && mimetype) {
      return cb(null, true);
    }
    cb(new Error('Apenas arquivos PDF, DOC ou DOCX são permitidos'));
  }
});

// Configuração do Multer para upload de trabalhos
const storageTrabalho = multer.diskStorage({
  destination: (req, file, cb) => {
    const dir = path.join(uploadsDir, 'trabalhos');
    if (!fs.existsSync(dir)) {
      fs.mkdirSync(dir, { recursive: true });
    }
    cb(null, dir);
  },
  filename: (req, file, cb) => {
    const ext = path.extname(file.originalname);
    const filename = `${uuidv4()}${ext}`;
    cb(null, filename);
  }
});

const uploadTrabalho = multer({
  storage: storageTrabalho,
  limits: { fileSize: 10 * 1024 * 1024 }, // 10MB
  fileFilter: (req, file, cb) => {
    const allowedTypes = /pdf/;
    const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = allowedTypes.test(file.mimetype);
    
    if (extname && mimetype) {
      return cb(null, true);
    }
    cb(new Error('Apenas arquivos PDF são permitidos'));
  }
});

// Configuração do Multer para upload de PDFs de páginas
const storagePaginas = multer.diskStorage({
  destination: (req, file, cb) => {
    const dir = path.join(uploadsDir, 'paginas');
    if (!fs.existsSync(dir)) {
      fs.mkdirSync(dir, { recursive: true });
    }
    cb(null, dir);
  },
  filename: (req, file, cb) => {
    const ext = path.extname(file.originalname);
    const filename = `${uuidv4()}${ext}`;
    cb(null, filename);
  }
});

const uploadPagina = multer({
  storage: storagePaginas,
  limits: { fileSize: 20 * 1024 * 1024 }, // 20MB
  fileFilter: (req, file, cb) => {
    const allowedTypes = /pdf/;
    const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = allowedTypes.test(file.mimetype);
    
    if (extname && mimetype) {
      return cb(null, true);
    }
    cb(new Error('Apenas arquivos PDF são permitidos'));
  }
});

// Configuração do Multer para upload de imagens de certificados (logos e assinaturas)
const storageCertificadoImagens = multer.diskStorage({
  destination: (req, file, cb) => {
    const dir = path.join(uploadsDir, 'certificados', 'imagens');
    if (!fs.existsSync(dir)) {
      fs.mkdirSync(dir, { recursive: true });
    }
    cb(null, dir);
  },
  filename: (req, file, cb) => {
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
    cb(null, file.fieldname + '-' + uniqueSuffix + path.extname(file.originalname));
  }
});

const uploadCertificadoImagem = multer({
  storage: storageCertificadoImagens,
  limits: { fileSize: 5 * 1024 * 1024 }, // 5MB
  fileFilter: (req, file, cb) => {
    const allowedTypes = /jpeg|jpg|png/;
    const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = allowedTypes.test(file.mimetype);
    
    if (extname && mimetype) {
      return cb(null, true);
    }
    cb(new Error('Apenas imagens (JPEG, JPG, PNG) são permitidas'));
  }
});

module.exports = {
  saveFile,
  deleteFile,
  getAbsolutePath,
  uploadsDir,
  uploadAcervo,
  uploadTrabalho,
  uploadPagina,
  uploadCertificadoImagem,
};
