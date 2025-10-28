import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { removeNotification } from '../../store/slices/notificationSlice';
import './NotificationContainer.css';

const NotificationContainer = () => {
  const { notifications } = useSelector((state) => state.notifications);
  const dispatch = useDispatch();

  useEffect(() => {
    notifications.forEach((notification) => {
      const timer = setTimeout(() => {
        dispatch(removeNotification(notification.id));
      }, notification.duration);

      return () => clearTimeout(timer);
    });
  }, [notifications, dispatch]);

  const handleClose = (id) => {
    dispatch(removeNotification(id));
  };

  const getIconClass = (type) => {
    switch (type) {
      case 'success':
        return 'fa-check-circle';
      case 'error':
        return 'fa-times-circle';
      case 'warning':
        return 'fa-exclamation-triangle';
      case 'info':
      default:
        return 'fa-info-circle';
    }
  };

  const getTypeClass = (type) => {
    switch (type) {
      case 'success':
        return 'success';
      case 'error':
        return 'danger';
      case 'warning':
        return 'warning';
      case 'info':
      default:
        return 'info';
    }
  };

  if (notifications.length === 0) return null;

  return (
    <div className="notification-container">
      {notifications.map((notification) => (
        <div
          key={notification.id}
          className={`br-message ${getTypeClass(notification.type)} notification-item`}
        >
          <div className="icon">
            <i className={`fas ${getIconClass(notification.type)}`} aria-hidden="true"></i>
          </div>
          <div className="content">
            <span className="message-body">{notification.message}</span>
          </div>
          <div className="close">
            <button
              className="br-button circle small"
              type="button"
              aria-label="Fechar notificação"
              onClick={() => handleClose(notification.id)}
            >
              <i className="fas fa-times" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      ))}
    </div>
  );
};

export default NotificationContainer;
