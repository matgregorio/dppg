import React, { useEffect } from 'react';
import { Routes, Route } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { setUser, setInitializing, clearAuth } from './store/slices/authSlice';
import authService from './services/authService';
import NotificationContainer from './components/notifications/NotificationContainer';

// Pages
import Home from './pages/Home';
import Login from './pages/Login';
import AcessoNegado from './pages/AcessoNegado';
import ForgotPassword from './pages/ForgotPassword';
import ResetPassword from './pages/ResetPassword';

// Public Pages
import Apresentacao from './pages/Apresentacao';
import Regulamento from './pages/Regulamento';
import CorpoEditorial from './pages/CorpoEditorial';
import Expediente from './pages/Expediente';
import NormasPublicacao from './pages/NormasPublicacao';
import Programacao from './pages/Programacao';
import ModeloPoster from './pages/ModeloPoster';
import ValidarCertificado from './pages/ValidarCertificado';
import Acervo from './pages/Acervo';

// Participant Pages
import MeusTrabalhos from './pages/MeusTrabalhos';
import SubmeterTrabalho from './pages/SubmeterTrabalho';
import MinhasInscricoes from './pages/MinhasInscricoes';
import MeusCertificados from './pages/MeusCertificados';

// Evaluator Pages
import TrabalhosAvaliador from './pages/TrabalhosAvaliador';
import AvaliarTrabalho from './pages/AvaliarTrabalho';

// Orientador Pages
import OrientadorTrabalhos from './pages/OrientadorTrabalhos';
import AvaliarTrabalhoOrientador from './pages/AvaliarTrabalhoOrientador';

// Admin Pages
import AdminSimposio from './pages/AdminSimposio';
import AdminCicloSimposio from './pages/AdminCicloSimposio';
import AdminCertificadosConfig from './pages/AdminCertificadosConfig';
import ConfigurarDatas from './pages/ConfigurarDatas';
import AdminTrabalhos from './pages/AdminTrabalhos';
import AdminAreas from './pages/AdminAreas';
import AdminInstituicoes from './pages/AdminInstituicoes';
import AdminDocentes from './pages/AdminDocentes';
import AdminApoios from './pages/AdminApoios';
import AdminParticipantes from './pages/AdminParticipantes';
import AdminAvaliadores from './pages/AdminAvaliadores';
import AdminSubeventos from './pages/AdminSubeventos';
import DashboardAdmin from './pages/DashboardAdmin';
import AdminAcervo from './pages/AdminAcervo';
import AdminPaginas from './pages/AdminPaginas';
import AvaliacoesExternas from './pages/AvaliacoesExternas';
import FuncoesAdministrativas from './pages/FuncoesAdministrativas';
import AdminCertificados from './pages/AdminCertificados';
import AdminEmailTemplates from './pages/AdminEmailTemplates';
import AreaAdministrativa from './pages/AreaAdministrativa';

// Mesario Pages
import MesarioSubeventos from './pages/MesarioSubeventos';
import GerarQRCode from './pages/GerarQRCode';
import PainelPresencas from './pages/PainelPresencas';
import CheckinQRCode from './pages/CheckinQRCode';

// Guards
import RequireAuth from './components/guards/RequireAuth';
import RequireRoles from './components/guards/RequireRoles';

function App() {
  const dispatch = useDispatch();
  const { initializing } = useSelector((state) => state.auth);
  
  useEffect(() => {
    // Carrega dados do usuário ao iniciar
    const loadUser = async () => {
      const token = localStorage.getItem('accessToken');
      if (token) {
        try {
          const response = await authService.me();
          if (response.success) {
            dispatch(setUser(response.data));
          } else {
            // Token inválido
            dispatch(clearAuth());
          }
        } catch (error) {
          console.error('Erro ao carregar usuário:', error);
          // Limpa autenticação se houver erro
          dispatch(clearAuth());
        } finally {
          // Finaliza inicialização após carregar (com sucesso ou erro)
          dispatch(setInitializing(false));
        }
      } else {
        // Sem token, finaliza inicialização
        dispatch(setInitializing(false));
      }
    };
    
    loadUser();
  }, [dispatch]);
  
  // Mostra loading durante inicialização
  if (initializing) {
    return (
      <div className="d-flex align-items-center justify-content-center min-vh-100">
        <div className="text-center">
          <div className="br-loading" aria-label="Carregando"></div>
          <p className="mt-3 text-up-01">Carregando...</p>
        </div>
      </div>
    );
  }
  
  return (
    <>
      <NotificationContainer />
      <Routes>
        {/* Rotas públicas */}
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="/forgot-password" element={<ForgotPassword />} />
        <Route path="/reset-password" element={<ResetPassword />} />
        <Route path="/checkin" element={<CheckinQRCode />} />
        <Route path="/apresentacao" element={<Apresentacao />} />
      <Route path="/regulamento" element={<Regulamento />} />
      <Route path="/corpo-editorial" element={<CorpoEditorial />} />
      <Route path="/expediente" element={<Expediente />} />
      <Route path="/normas-publicacao" element={<NormasPublicacao />} />
      <Route path="/programacao" element={<Programacao />} />
      <Route path="/modelo-poster" element={<ModeloPoster />} />
      <Route path="/validar-certificado/:hash" element={<ValidarCertificado />} />
      <Route path="/validar-certificado" element={<ValidarCertificado />} />
      <Route path="/acervo" element={<Acervo />} />
      
      {/* Rotas autenticadas - Participante */}
      <Route
        path="/inscricoes"
        element={
          <RequireAuth>
            <RequireRoles roles={['USER', 'MESARIO']}>
              <MinhasInscricoes />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/trabalhos"
        element={
          <RequireAuth>
            <RequireRoles roles={['USER', 'MESARIO']}>
              <MeusTrabalhos />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/submeter-trabalho"
        element={
          <RequireAuth>
            <RequireRoles roles={['USER', 'MESARIO']}>
              <SubmeterTrabalho />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/certificados"
        element={
          <RequireAuth>
            <MeusCertificados />
          </RequireAuth>
        }
      />
      
      {/* Rotas de avaliador */}
      <Route
        path="/avaliador/trabalhos"
        element={
          <RequireAuth>
            <RequireRoles roles={['AVALIADOR']}>
              <TrabalhosAvaliador />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/avaliador/trabalhos/:id/avaliar"
        element={
          <RequireAuth>
            <RequireRoles roles={['AVALIADOR']}>
              <AvaliarTrabalho />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      {/* Rotas de orientador */}
      <Route
        path="/orientador/trabalhos"
        element={
          <RequireAuth>
            <RequireRoles roles={['DOCENTE']}>
              <OrientadorTrabalhos />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/orientador/trabalhos/:id"
        element={
          <RequireAuth>
            <RequireRoles roles={['DOCENTE']}>
              <AvaliarTrabalhoOrientador />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      {/* Rotas de admin */}
      <Route
        path="/area-administrativa"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AreaAdministrativa />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/dashboard"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <DashboardAdmin />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/ciclo-simposio"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminCicloSimposio />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/simposios/:ano"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminSimposio />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/simposios/:ano/datas"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <ConfigurarDatas />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/trabalhos"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminTrabalhos />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/areas"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminAreas />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/instituicoes"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminInstituicoes />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/docentes"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminDocentes />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/apoios"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminApoios />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/participantes"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminParticipantes />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/avaliadores"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminAvaliadores />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/subeventos"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminSubeventos />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/acervo"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminAcervo />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/paginas"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminPaginas />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/avaliacoes-externas"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AvaliacoesExternas />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/funcoes"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN']}>
              <FuncoesAdministrativas />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/certificados"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminCertificados />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/admin/email-templates"
        element={
          <RequireAuth>
            <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
              <AdminEmailTemplates />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      {/* Rotas de mesário */}
      <Route
        path="/mesario/subeventos"
        element={
          <RequireAuth>
            <RequireRoles roles={['MESARIO']}>
              <MesarioSubeventos />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/mesario/subeventos/:subeventoId/qrcode"
        element={
          <RequireAuth>
            <RequireRoles roles={['MESARIO']}>
              <GerarQRCode />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      <Route
        path="/mesario/subeventos/:subeventoId/presencas"
        element={
          <RequireAuth>
            <RequireRoles roles={['MESARIO']}>
              <PainelPresencas />
            </RequireRoles>
          </RequireAuth>
        }
      />
      
      {/* Rota de acesso negado */}
      <Route path="/acesso-negado" element={<AcessoNegado />} />
      
      {/* 404 */}
      <Route path="*" element={<Home />} />
    </Routes>
    </>
  );
}

export default App;
