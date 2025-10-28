import { Navigate } from 'react-router-dom';
import { useSelector } from 'react-redux';

const RequireRoles = ({ children, roles }) => {
  const { user } = useSelector((state) => state.auth);
  
  if (!user || !user.roles) {
    return <Navigate to="/login" replace />;
  }
  
  const hasRole = roles.some((role) => user.roles.includes(role));
  
  if (!hasRole) {
    return <Navigate to="/acesso-negado" replace />;
  }
  
  return children;
};

export default RequireRoles;
