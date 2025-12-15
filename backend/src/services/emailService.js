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
        <p><strong>Área:</strong> ${trabalho.areaAtuacao?.nome || 'Não especificada'}</p>
        <p><strong>Tipo:</strong> ${trabalho.tipo || 'Não especificado'}</p>
      </div>
      
      <p>Por favor, acesse o sistema para realizar a avaliação o quanto antes.</p>
      
      <div style="text-align: center; margin: 30px 0;">
        <a href="${process.env.FRONTEND_URL}/avaliador/trabalhos" 
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
        <a href="${process.env.FRONTEND_URL}/trabalhos" 
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
  const resetUrl = `${process.env.FRONTEND_URL}/reset-password?token=${resetToken}`;
  
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

/**
 * Template: Notificação para orientador avaliar trabalho
 */
const enviarNotificacaoOrientador = async (emailOrientador, nomeOrientador, nomeAluno, tituloTrabalho, trabalhoId) => {
  const subject = 'Novo Trabalho Aguardando sua Avaliação';
  const html = `
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
      <h2 style="color: #155BCB;">Novo Trabalho para Avaliação</h2>
      
      <p>Olá, <strong>${nomeOrientador}</strong>!</p>
      
      <p>Um aluno submeteu um trabalho indicando você como orientador.</p>
      
      <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 20px 0;">
        <h3 style="margin-top: 0;">Dados do Trabalho:</h3>
        <p><strong>Aluno:</strong> ${nomeAluno}</p>
        <p><strong>Título:</strong> ${tituloTrabalho}</p>
        <p><strong>Status:</strong> Aguardando sua avaliação</p>
      </div>
      
      <p><strong>Importante:</strong> O trabalho só será encaminhado para a comissão avaliadora após sua aprovação.</p>
      
      <p>Por favor, acesse o sistema para avaliar o trabalho e aprovar ou reprovar com comentários.</p>
      
      <div style="text-align: center; margin: 30px 0;">
        <a href="${process.env.FRONTEND_URL}/orientador/trabalhos/${trabalhoId}" 
           style="background: #155BCB; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
          Avaliar Trabalho
        </a>
      </div>
      
      <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
      
      <p style="font-size: 12px; color: #666;">
        Esta é uma mensagem automática. Por favor, não responda este email.
      </p>
    </div>
  `;
  
  return await sendEmail({
    to: emailOrientador,
    subject,
    html,
  });
};

/**
 * Template: Notificação de parecer do orientador para o aluno
 */
const enviarParecerOrientador = async (emailAluno, nomeAluno, tituloTrabalho, aprovado, comentarios) => {
  const statusTexto = aprovado ? 'APROVADO' : 'REPROVADO';
  const statusCor = aprovado ? '#28a745' : '#dc3545';
  
  const subject = `Parecer do Orientador - ${tituloTrabalho}`;
  const html = `
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
      <h2 style="color: #155BCB;">Parecer do Orientador</h2>
      
      <p>Olá, <strong>${nomeAluno}</strong>!</p>
      
      <p>Seu orientador avaliou o trabalho submetido.</p>
      
      <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 20px 0;">
        <h3 style="margin-top: 0;">Dados do Trabalho:</h3>
        <p><strong>Título:</strong> ${tituloTrabalho}</p>
        <p>
          <strong>Parecer:</strong> 
          <span style="color: ${statusCor}; font-weight: bold;">
            ${statusTexto}
          </span>
        </p>
      </div>
      
      ${comentarios ? `
        <div style="background: #f8f9fa; border-left: 4px solid #155BCB; padding: 15px; margin: 20px 0;">
          <h4 style="margin-top: 0;">Comentários do Orientador:</h4>
          <p style="margin: 0; white-space: pre-wrap;">${comentarios}</p>
        </div>
      ` : ''}
      
      ${aprovado ? `
        <div style="background: #d4edda; border-left: 4px solid #28a745; padding: 15px; margin: 20px 0;">
          <p style="margin: 0;"><strong>Parabéns!</strong> Seu trabalho foi aprovado pelo orientador e será encaminhado para avaliação da comissão.</p>
        </div>
      ` : `
        <div style="background: #f8d7da; border-left: 4px solid #dc3545; padding: 15px; margin: 20px 0;">
          <p style="margin: 0;"><strong>Atenção:</strong> Seu trabalho foi reprovado pelo orientador. Por favor, faça as correções necessárias e submeta novamente.</p>
        </div>
      `}
      
      <p>Acesse o sistema para ver os detalhes${!aprovado ? ' e fazer as correções necessárias' : ''}.</p>
      
      <div style="text-align: center; margin: 30px 0;">
        <a href="${process.env.FRONTEND_URL}/trabalhos" 
           style="background: #155BCB; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
          Ver Trabalho
        </a>
      </div>
      
      <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
      
      <p style="font-size: 12px; color: #666;">
        Esta é uma mensagem automática. Por favor, não responda este email.
      </p>
    </div>
  `;
  
  return await sendEmail({
    to: emailAluno,
    subject,
    html,
  });
};

/**
 * Renderiza um template com variáveis
 * Substitui {{variavel}} pelos valores fornecidos
 */
const renderTemplate = (template, variables) => {
  let rendered = template;
  
  for (const [key, value] of Object.entries(variables)) {
    const regex = new RegExp(`{{${key}}}`, 'g');
    rendered = rendered.replace(regex, value || '');
  }
  
  return rendered;
};

/**
 * Envia email usando template do banco de dados
 */
const enviarEmail = async (chaveTemplate, emailDestino, variaveis = {}) => {
  try {
    const EmailTemplate = require('../models/EmailTemplate');
    
    // Buscar template
    const template = await EmailTemplate.findOne({ chave: chaveTemplate, ativo: true });
    
    if (!template) {
      console.error(`❌ Template '${chaveTemplate}' não encontrado ou inativo`);
      return { success: false, message: 'Template de email não encontrado' };
    }
    
    // Adicionar variáveis padrão
    const variaveisCompletas = {
      ...variaveis,
      ano_atual: new Date().getFullYear(),
      data_atual: new Date().toLocaleDateString('pt-BR'),
      url_sistema: process.env.FRONTEND_URL || 'http://localhost:5173',
    };
    
    // Renderizar assunto e corpo
    const assunto = renderTemplate(template.assunto, variaveisCompletas);
    const corpo = renderTemplate(template.corpo, variaveisCompletas);
    
    // Enviar email
    return await sendEmail({
      to: emailDestino,
      subject: assunto,
      html: corpo,
    });
  } catch (error) {
    console.error('❌ Erro ao enviar email com template:', error);
    return { success: false, message: error.message };
  }
};

/**
 * Template: Anúncio de Novo Simpósio
 */
const enviarNovoSimposio = async (user, dadosSimposio) => {
  const { ano, tema, dataInicio, dataFim, dataInicioSubmissoes, dataFimSubmissoes, dataInicioInscricoes, dataFimInscricoes } = dadosSimposio;
  
  const formatarData = (data) => {
    if (!data) return null;
    return new Date(data).toLocaleDateString('pt-BR', { 
      day: '2-digit', 
      month: 'long', 
      year: 'numeric' 
    });
  };

  const formatarDataCurta = (data) => {
    if (!data) return null;
    return new Date(data).toLocaleDateString('pt-BR');
  };

  const subject = `🎉 Novo Simpósio ${ano} - ${tema}`;
  
  const html = `
    <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 650px; margin: 0 auto; background: #ffffff;">
      <!-- Header com gradiente -->
      <div style="background: linear-gradient(135deg, #1351B4 0%, #071D41 100%); padding: 40px 30px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
          🎓 Novo Simpósio ${ano}
        </h1>
        <div style="background: rgba(255,255,255,0.2); height: 3px; width: 80px; margin: 15px auto 0; border-radius: 2px;"></div>
      </div>
      
      <!-- Corpo do email -->
      <div style="padding: 40px 30px; background: #ffffff;">
        <p style="font-size: 16px; color: #333; margin: 0 0 25px 0; line-height: 1.6;">
          Olá, <strong style="color: #1351B4;">${user.nome || user.email}</strong>! 👋
        </p>
        
        <p style="font-size: 16px; color: #333; margin: 0 0 25px 0; line-height: 1.6;">
          Temos o prazer de anunciar a abertura das atividades do <strong>Simpósio ${ano}</strong>!
        </p>
        
        <!-- Card do Tema -->
        <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 25px; border-radius: 8px; margin: 30px 0; border-left: 4px solid #1351B4; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
          <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <span style="font-size: 24px; margin-right: 12px;">🎯</span>
            <h3 style="margin: 0; color: #1351B4; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Tema do Simpósio</h3>
          </div>
          <p style="font-size: 20px; color: #071D41; margin: 10px 0 0 0; font-weight: 500; line-height: 1.4;">
            "${tema}"
          </p>
        </div>
        
        <!-- Datas Importantes -->
        <div style="background: #ffffff; border: 2px solid #e9ecef; border-radius: 8px; padding: 25px; margin: 30px 0;">
          <div style="display: flex; align-items: center; margin-bottom: 20px;">
            <span style="font-size: 24px; margin-right: 12px;">📅</span>
            <h3 style="margin: 0; color: #1351B4; font-size: 18px; font-weight: 600;">Datas Importantes</h3>
          </div>
          
          <!-- Data do Evento -->
          <div style="padding: 15px; margin-bottom: 15px; background: linear-gradient(to right, #1351B4, #155BCB); border-radius: 6px;">
            <div style="display: flex; align-items: center;">
              <span style="font-size: 28px; margin-right: 15px;">🎪</span>
              <div>
                <p style="margin: 0; color: rgba(255,255,255,0.9); font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Período do Evento</p>
                <p style="margin: 5px 0 0 0; color: #ffffff; font-size: 18px; font-weight: 600;">
                  ${formatarDataCurta(dataInicio)} a ${formatarDataCurta(dataFim)}
                </p>
              </div>
            </div>
          </div>
          
          ${dataInicioSubmissoes && dataFimSubmissoes ? `
          <!-- Submissões -->
          <div style="padding: 15px; margin-bottom: 15px; background: #f0f7ff; border-radius: 6px; border-left: 3px solid #0068D1;">
            <div style="display: flex; align-items: center;">
              <span style="font-size: 24px; margin-right: 15px;">📝</span>
              <div>
                <p style="margin: 0; color: #071D41; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Submissão de Trabalhos</p>
                <p style="margin: 5px 0 0 0; color: #1351B4; font-size: 16px; font-weight: 500;">
                  ${formatarDataCurta(dataInicioSubmissoes)} a ${formatarDataCurta(dataFimSubmissoes)}
                </p>
              </div>
            </div>
          </div>
          ` : ''}
          
          ${dataInicioInscricoes && dataFimInscricoes ? `
          <!-- Inscrições -->
          <div style="padding: 15px; background: #f0fff4; border-radius: 6px; border-left: 3px solid #168821;">
            <div style="display: flex; align-items: center;">
              <span style="font-size: 24px; margin-right: 15px;">✍️</span>
              <div>
                <p style="margin: 0; color: #071D41; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Período de Inscrições</p>
                <p style="margin: 5px 0 0 0; color: #168821; font-size: 16px; font-weight: 500;">
                  ${formatarDataCurta(dataInicioInscricoes)} a ${formatarDataCurta(dataFimInscricoes)}
                </p>
              </div>
            </div>
          </div>
          ` : ''}
        </div>
        
        <!-- Call to Action -->
        <div style="text-align: center; margin: 40px 0 30px 0;">
          <p style="font-size: 16px; color: #333; margin: 0 0 20px 0; line-height: 1.6;">
            Acesse o sistema para mais informações e para realizar sua inscrição:
          </p>
          <a href="${process.env.FRONTEND_URL || 'http://localhost:5173'}" 
             style="display: inline-block; background: linear-gradient(135deg, #1351B4 0%, #0c3e8a 100%); color: #ffffff; padding: 16px 40px; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 16px; box-shadow: 0 4px 12px rgba(19, 81, 180, 0.3); transition: all 0.3s;">
            🚀 Acessar Sistema
          </a>
        </div>
        
        <!-- Mensagem de encerramento -->
        <div style="background: #fff8e1; border-left: 4px solid #ffc107; padding: 20px; border-radius: 6px; margin: 30px 0;">
          <p style="margin: 0; color: #856404; font-size: 14px; line-height: 1.6;">
            <strong>💡 Dica:</strong> Não perca os prazos! Adicione essas datas ao seu calendário e fique atento às próximas comunicações sobre o evento.
          </p>
        </div>
        
        <p style="font-size: 16px; color: #333; margin: 30px 0 0 0; line-height: 1.6;">
          Esperamos contar com sua participação! 🎉
        </p>
        
        <p style="font-size: 16px; color: #333; margin: 15px 0 0 0; line-height: 1.6;">
          Atenciosamente,<br>
          <strong style="color: #1351B4;">Equipe Organizadora do Simpósio</strong>
        </p>
      </div>
      
      <!-- Footer -->
      <div style="background: #f8f9fa; padding: 25px 30px; border-radius: 0 0 8px 8px; border-top: 3px solid #1351B4;">
        <p style="font-size: 12px; color: #6c757d; margin: 0 0 8px 0; text-align: center;">
          📧 Esta é uma mensagem automática. Por favor, não responda este email.
        </p>
        <p style="font-size: 11px; color: #adb5bd; margin: 0; text-align: center;">
          © ${new Date().getFullYear()} Sistema de Gerenciamento de Simpósios. Todos os direitos reservados.
        </p>
      </div>
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
  enviarEmail,
  renderTemplate,
  enviarConfirmacaoSubmissao,
  enviarAtribuicaoAvaliacao,
  enviarResultadoAvaliacao,
  enviarRecuperacaoSenha,
  enviarNotificacaoOrientador,
  enviarParecerOrientador,
  enviarNovoSimposio,
};
