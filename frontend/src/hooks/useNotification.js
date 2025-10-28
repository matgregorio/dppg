import { useDispatch } from 'react-redux';
import { addNotification } from '../store/slices/notificationSlice';

const useNotification = () => {
  const dispatch = useDispatch();

  const showNotification = (message, type = 'info', duration = 5000) => {
    dispatch(addNotification({ message, type, duration }));
  };

  const showSuccess = (message, duration) => {
    showNotification(message, 'success', duration);
  };

  const showError = (message, duration) => {
    showNotification(message, 'error', duration);
  };

  const showWarning = (message, duration) => {
    showNotification(message, 'warning', duration);
  };

  const showInfo = (message, duration) => {
    showNotification(message, 'info', duration);
  };

  return {
    showNotification,
    showSuccess,
    showError,
    showWarning,
    showInfo,
  };
};

export default useNotification;
