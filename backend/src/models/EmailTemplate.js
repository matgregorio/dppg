const mongoose = require('mongoose');

const emailTemplateSchema = new mongoose.Schema({
  chave: {
    type: String,
    required: true,
    unique: true,
    enum: [
      'NOVA_INSCRICAO',
      'NOVO_USUARIO',
      'RECUPERAR_SENHA',
      'TRABALHO_ENVIADO',
      'AVALIACAO_RECEBIDA',
      'AVALIAR_TRABALHO_ORIENTADOR',
      'AVALIAR_TRABALHO_AVALIADOR_EXTERNO',
    ],
  },
  nome: {
    type: String,
    required: true,
  },
  assunto: {
    type: String,
    required: true,
  },
  corpo: {
    type: String,
    required: true,
  },
  variaveis: [{
    chave: String,
    descricao: String,
  }],
  ativo: {
    type: Boolean,
    default: true,
  },
}, {
  timestamps: true,
});

// Templates padrão
emailTemplateSchema.statics.getDefaults = function() {
  return [
    {
      chave: 'NOVA_INSCRICAO',
      nome: 'Nova Inscrição no Simpósio',
      assunto: 'Bem-vindo(a) ao {{simposio_nome}}!',
      corpo: `
Olá {{usuario_nome}},

Sua inscrição no {{simposio_nome}} foi realizada com sucesso!

Dados da inscrição:
- Nome: {{usuario_nome}}
- Email: {{usuario_email}}
- CPF: {{usuario_cpf}}
- Data: {{data_inscricao}}

Acesse sua área do participante para submeter trabalhos e gerenciar suas inscrições nos subeventos.

Link de acesso: {{url_sistema}}

Atenciosamente,
Equipe {{simposio_nome}}
      `.trim(),
      variaveis: [
        { chave: '{{usuario_nome}}', descricao: 'Nome do usuário' },
        { chave: '{{usuario_email}}', descricao: 'Email do usuário' },
        { chave: '{{usuario_cpf}}', descricao: 'CPF do usuário' },
        { chave: '{{simposio_nome}}', descricao: 'Nome do simpósio' },
        { chave: '{{data_inscricao}}', descricao: 'Data da inscrição' },
        { chave: '{{url_sistema}}', descricao: 'URL do sistema' },
      ],
      ativo: true,
    },
    {
      chave: 'NOVO_USUARIO',
      nome: 'Novo Usuário Cadastrado',
      assunto: 'Cadastro realizado com sucesso - {{simposio_nome}}',
      corpo: `
Olá {{usuario_nome}},

Seu cadastro foi realizado com sucesso no sistema do {{simposio_nome}}!

Dados de acesso:
- Email: {{usuario_email}}
- Senha: Utilize a senha que você criou no momento do cadastro

Acesse o sistema através do link: {{url_sistema}}

Atenciosamente,
Equipe {{simposio_nome}}
      `.trim(),
      variaveis: [
        { chave: '{{usuario_nome}}', descricao: 'Nome do usuário' },
        { chave: '{{usuario_email}}', descricao: 'Email do usuário' },
        { chave: '{{simposio_nome}}', descricao: 'Nome do simpósio' },
        { chave: '{{url_sistema}}', descricao: 'URL do sistema' },
      ],
      ativo: true,
    },
    {
      chave: 'RECUPERAR_SENHA',
      nome: 'Recuperação de Senha',
      assunto: 'Recuperação de senha - {{simposio_nome}}',
      corpo: `
Olá {{usuario_nome}},

Você solicitou a recuperação de senha para sua conta no {{simposio_nome}}.

Clique no link abaixo para criar uma nova senha:
{{link_recuperacao}}

Este link é válido por 1 hora.

Se você não solicitou esta recuperação, ignore este email.

Atenciosamente,
Equipe {{simposio_nome}}
      `.trim(),
      variaveis: [
        { chave: '{{usuario_nome}}', descricao: 'Nome do usuário' },
        { chave: '{{simposio_nome}}', descricao: 'Nome do simpósio' },
        { chave: '{{link_recuperacao}}', descricao: 'Link para recuperação de senha' },
      ],
      ativo: true,
    },
    {
      chave: 'TRABALHO_ENVIADO',
      nome: 'Confirmação de Envio de Trabalho',
      assunto: 'Trabalho submetido com sucesso - {{simposio_nome}}',
      corpo: `
Olá {{usuario_nome}},

Seu trabalho foi submetido com sucesso no {{simposio_nome}}!

Dados do trabalho:
- Título: {{trabalho_titulo}}
- Orientador: {{orientador_nome}}
- Tipo: {{trabalho_tipo}}
- Data de submissão: {{data_submissao}}

Seu trabalho será enviado para avaliação do orientador. Você receberá um email quando houver atualizações.

Acompanhe o status do seu trabalho em: {{url_trabalhos}}

Atenciosamente,
Equipe {{simposio_nome}}
      `.trim(),
      variaveis: [
        { chave: '{{usuario_nome}}', descricao: 'Nome do autor' },
        { chave: '{{trabalho_titulo}}', descricao: 'Título do trabalho' },
        { chave: '{{orientador_nome}}', descricao: 'Nome do orientador' },
        { chave: '{{trabalho_tipo}}', descricao: 'Tipo do trabalho' },
        { chave: '{{data_submissao}}', descricao: 'Data de submissão' },
        { chave: '{{simposio_nome}}', descricao: 'Nome do simpósio' },
        { chave: '{{url_trabalhos}}', descricao: 'URL para visualizar trabalhos' },
      ],
      ativo: true,
    },
    {
      chave: 'AVALIACAO_RECEBIDA',
      nome: 'Avaliação de Trabalho Recebida',
      assunto: 'Trabalho avaliado - {{simposio_nome}}',
      corpo: `
Olá {{usuario_nome}},

Seu trabalho "{{trabalho_titulo}}" foi avaliado.

Status da avaliação: {{avaliacao_status}}
Avaliador: {{avaliador_nome}}
Data da avaliação: {{data_avaliacao}}

{{#if comentarios}}
Comentários do avaliador:
{{avaliacao_comentarios}}
{{/if}}

Acesse o sistema para ver mais detalhes: {{url_trabalho}}

Atenciosamente,
Equipe {{simposio_nome}}
      `.trim(),
      variaveis: [
        { chave: '{{usuario_nome}}', descricao: 'Nome do autor' },
        { chave: '{{trabalho_titulo}}', descricao: 'Título do trabalho' },
        { chave: '{{avaliacao_status}}', descricao: 'Status da avaliação' },
        { chave: '{{avaliador_nome}}', descricao: 'Nome do avaliador' },
        { chave: '{{data_avaliacao}}', descricao: 'Data da avaliação' },
        { chave: '{{avaliacao_comentarios}}', descricao: 'Comentários da avaliação' },
        { chave: '{{simposio_nome}}', descricao: 'Nome do simpósio' },
        { chave: '{{url_trabalho}}', descricao: 'URL do trabalho' },
      ],
      ativo: true,
    },
    {
      chave: 'AVALIAR_TRABALHO_ORIENTADOR',
      nome: 'Solicitação de Avaliação - Orientador',
      assunto: 'Trabalho pendente de avaliação - {{simposio_nome}}',
      corpo: `
Olá {{orientador_nome}},

Um novo trabalho foi submetido sob sua orientação no {{simposio_nome}}.

Dados do trabalho:
- Título: {{trabalho_titulo}}
- Autor: {{autor_nome}}
- Tipo: {{trabalho_tipo}}
- Data de submissão: {{data_submissao}}

Por favor, acesse o sistema para avaliar este trabalho: {{url_avaliar}}

Atenciosamente,
Equipe {{simposio_nome}}
      `.trim(),
      variaveis: [
        { chave: '{{orientador_nome}}', descricao: 'Nome do orientador' },
        { chave: '{{trabalho_titulo}}', descricao: 'Título do trabalho' },
        { chave: '{{autor_nome}}', descricao: 'Nome do autor' },
        { chave: '{{trabalho_tipo}}', descricao: 'Tipo do trabalho' },
        { chave: '{{data_submissao}}', descricao: 'Data de submissão' },
        { chave: '{{simposio_nome}}', descricao: 'Nome do simpósio' },
        { chave: '{{url_avaliar}}', descricao: 'URL para avaliar o trabalho' },
      ],
      ativo: true,
    },
    {
      chave: 'AVALIAR_TRABALHO_AVALIADOR_EXTERNO',
      nome: 'Solicitação de Avaliação - Avaliador Externo',
      assunto: 'Trabalho atribuído para avaliação - {{simposio_nome}}',
      corpo: `
Olá {{avaliador_nome}},

Um trabalho foi atribuído para você avaliar no {{simposio_nome}}.

Dados do trabalho:
- Título: {{trabalho_titulo}}
- Tipo: {{trabalho_tipo}}
- Área: {{trabalho_area}}

Por favor, acesse o sistema para avaliar este trabalho: {{url_avaliar}}

Prazo para avaliação: {{prazo_avaliacao}}

Atenciosamente,
Equipe {{simposio_nome}}
      `.trim(),
      variaveis: [
        { chave: '{{avaliador_nome}}', descricao: 'Nome do avaliador' },
        { chave: '{{trabalho_titulo}}', descricao: 'Título do trabalho' },
        { chave: '{{trabalho_tipo}}', descricao: 'Tipo do trabalho' },
        { chave: '{{trabalho_area}}', descricao: 'Área do trabalho' },
        { chave: '{{prazo_avaliacao}}', descricao: 'Prazo para avaliação' },
        { chave: '{{simposio_nome}}', descricao: 'Nome do simpósio' },
        { chave: '{{url_avaliar}}', descricao: 'URL para avaliar o trabalho' },
      ],
      ativo: true,
    },
  ];
};

module.exports = mongoose.model('EmailTemplate', emailTemplateSchema);
