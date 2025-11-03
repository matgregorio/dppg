const nodemailer = require('nodemailer');

/**
 * Serviço de envio de emails
 * Configuração SMTP deve estar nas variáveis de ambiente:
 * EMAIL_HOST, EMAIL_PORT, EMAIL_USER, EMAIL_PASS, EMAIL_FROM
 */

// Cria o transportador SMTP
const createTransporter = () => {
  // Em desenvolvimento, pode usar Ethereal para testes
  // Em produção, configure com seu servidor SMTP real
  
  const config = {
    host: process.env.EMAIL_HOST || 'smtp.gmail.com',
    port: parseInt(process.env.EMAIL_PORT) || 587,
    secure: false, // true para porta 465, false para outras
    auth: {
      user: process.env.EMAIL_USER,
      pass: process.env.EMAIL_PASS,
    },
  };

  // Se não houver configuração, retorna transporter de teste
  if (!process.env.EMAIL_USER) {
    console.warn('⚠️  Configuração de email não encontrada. Emails não serão enviados.');
    return null;
  }

  return nodemailer.createTransporter(config);
};

/**
 * Envia email genérico
 */
const sendEmail = async ({ to, subject, html, text }) => {
  try {
    const transporter = createTransporter();
    
    if (!transporter) {
      console.log('📧 [MODO TESTE] Email não enviado:', { to, subject });
      return { success: false, message: 'Serviço de email não configurado' };
    }

    const mailOptions = {
      from: process.env.EMAIL_FROM || '"Sistema Simpósio" <noreply@simposio.edu.br>',
      to,
      subject,
      html,
      text: text || html.replace(/<[^>]*>/g, ''), // Remove HTML se text não fornecido
    };

    const info = await transporter.sendMail(mailOptions);
    console.log('✅ Email enviado:', info.messageId, 'para:', to);
    
    return { success: true, messageId: info.messageId };
  } catch (error) {
    console.error('❌ Erro ao enviar email:', error);
    return { success: false, message: error.message };
  }
};

/**
 * Template: Confirmação de submissão de trabalho
 */
const enviarConfirmacaoSubmissao = async (user, trabalho) => {
  const subject = 'Confirmação de Submissão de Trabalho';
  const html = `
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
      <h2 style="color: #155BCB;">Trabalho Submetido com Sucesso!</h2>
      
      <p>Olá, <strong>${user.nome}</strong>!</p>
      
      <p>Seu trabalho foi submetido com sucesso ao simpósio.</p>
      
      <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 20px 0;">
        <h3 style="margin-top: 0;">Dados do Trabalho:</h3>
        <p><strong>Título:</strong> ${trabalho.titulo}</p>
        <p><strong>Status:</strong> Em análise</p>
        <p><strong>Data de submissão:</strong> ${new Date().toLocaleDateString('pt-BR')}</p>
      </div>
      
      <p>O trabalho passará por avaliação e você receberá um email com o resultado em breve.</p>
      
      <p>Você pode acompanhar o status do seu trabalho acessando a área "Meus Trabalhos" no sistema.</p>
      
      <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
      
      <p style="font-size: 12px; color: #666;">
        Esta é uma mensagem automática. Por favor, não responda este email.
      </p>
    </div>
  `;
  
  return await sendEmail({
    to: user.email,
    subject,
    html,
  });
};

/**
 * Template: Notificação de atribuição para avaliador
 */
const enviarAtribuicaoAvaliacao = async (avaliador, trabalho) => {
  const subject = 'Novo Trabalho Atribuído para Avaliação';
  const html = `
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
      <h2 style="color: #155BCB;">Novo Trabalho para Avaliar</h2>
      
      <p>Olá, <strong>${avaliador.nome}</strong>!</p>
      
      <p>Um novo trabalho foi atribuído a você para avaliação.</p>
      
      <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 20px 0;">
        <h3 style="margin-top: 0;">Dados do Trabalho:</h3>
        <p><strong>Título:</strong> ${trabalho.titulo}</p>
        <p><strong>Área:</strong> ${trabalho.grandeArea?.nome || 'Não especificada'}</p>
        <p><strong>Tipo:</strong> ${trabalho.tipo || 'Não especificado'}</p>
      </div>
      
      <p>Por favor, acesse o sistema para realizar a avaliação o quanto antes.</p>
      
      <div style="text-align: center; margin: 30px 0;">
        <a href="${process.env.FRONTEND_URL || 'http://localhost:5173'}/avaliador/trabalhos" 
           style="background: #155BCB; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
          Acessar Sistema
        </a>
      </div>
      
      <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
      
      <p style="font-size: 12px; color: #666;">
        Esta é uma mensagem automática. Por favor, não responda este email.
      </p>
    </div>
  `;
  
  return await sendEmail({
    to: avaliador.email,
    subject,
    html,
  });
};

/**
 * Template: Notificação de resultado da avaliação
 */
const enviarResultadoAvaliacao = async (user, trabalho, status) => {
  const statusTexto = {
    'APROVADO': 'aprovado',
    'APROVADO_CONDICIONAL': 'aprovado condicionalmente',
    'REJEITADO': 'rejeitado',
  };

  const statusCor = {
    'APROVADO': '#28a745',
    'APROVADO_CONDICIONAL': '#ffc107',
    'REJEITADO': '#dc3545',
  };

  const subject = `Resultado da Avaliação - ${trabalho.titulo}`;
  const html = `
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
      <h2 style="color: #155BCB;">Resultado da Avaliação</h2>
      
      <p>Olá, <strong>${user.nome}</strong>!</p>
      
      <p>A avaliação do seu trabalho foi concluída.</p>
      
      <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 20px 0;">
        <h3 style="margin-top: 0;">Dados do Trabalho:</h3>
        <p><strong>Título:</strong> ${trabalho.titulo}</p>
        <p>
          <strong>Status:</strong> 
          <span style="color: ${statusCor[status]}; font-weight: bold;">
            ${statusTexto[status]?.toUpperCase() || status}
          </span>
        </p>
        ${trabalho.media ? `<p><strong>Nota:</strong> ${trabalho.media.toFixed(2)}</p>` : ''}
      </div>
      
      ${status === 'APROVADO_CONDICIONAL' ? `
        <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
          <p><strong>Atenção:</strong> Seu trabalho foi aprovado condicionalmente. 
          Por favor, verifique os pareceres dos avaliadores para realizar os ajustes necessários.</p>
        </div>
      ` : ''}
      
      <p>Acesse o sistema para ver os detalhes da avaliação.</p>
      
      <div style="text-align: center; margin: 30px 0;">
        <a href="${process.env.FRONTEND_URL || 'http://localhost:5173'}/trabalhos" 
           style="background: #155BCB; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
          Ver Detalhes
        </a>
      </div>
      
      <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
      
      <p style="font-size: 12px; color: #666;">
        Esta é uma mensagem automática. Por favor, não responda este email.
      </p>
    </div>
  `;
  
  return await sendEmail({
    to: user.email,
    subject,
    html,
  });
};

/**
 * Template: Recuperação de senha
 */
const enviarRecuperacaoSenha = async (user, resetToken) => {
  const resetUrl = `${process.env.FRONTEND_URL || 'http://localhost:5173'}/reset-password?token=${resetToken}`;
  
  const subject = 'Recuperação de Senha';
  const html = `
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
      <h2 style="color: #155BCB;">Recuperação de Senha</h2>
      
      <p>Olá, <strong>${user.nome}</strong>!</p>
      
      <p>Você solicitou a recuperação de senha da sua conta.</p>
      
      <p>Clique no botão abaixo para criar uma nova senha:</p>
      
      <div style="text-align: center; margin: 30px 0;">
        <a href="${resetUrl}" 
           style="background: #155BCB; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
          Redefinir Senha
        </a>
      </div>
      
      <p style="font-size: 14px; color: #666;">
        Ou copie e cole este link no seu navegador:<br>
        <a href="${resetUrl}" style="color: #155BCB;">${resetUrl}</a>
      </p>
      
      <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
        <p style="margin: 0;"><strong>Importante:</strong> Este link expira em 1 hora.</p>
      </div>
      
      <p>Se você não solicitou esta recuperação, ignore este email.</p>
      
      <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
      
      <p style="font-size: 12px; color: #666;">
        Esta é uma mensagem automática. Por favor, não responda este email.
      </p>
    </div>
  `;
  
  return await sendEmail({
    to: user.email,
    subject,
    html,
  });
};

module.exports = {
  sendEmail,
  enviarConfirmacaoSubmissao,
  enviarAtribuicaoAvaliacao,
  enviarResultadoAvaliacao,
  enviarRecuperacaoSenha,
};
