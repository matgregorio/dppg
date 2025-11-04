import React, { useEffect, useRef, useState } from 'react';
import { Html5Qrcode } from 'html5-qrcode';

const QRScanner = ({ onScan, onError, onClose }) => {
  const [isScanning, setIsScanning] = useState(false);
  const [cameras, setCameras] = useState([]);
  const [selectedCamera, setSelectedCamera] = useState('');
  const [errorMsg, setErrorMsg] = useState('');
  const scannerRef = useRef(null);
  const html5QrCodeRef = useRef(null);

  useEffect(() => {
    // Listar câmeras disponíveis
    Html5Qrcode.getCameras()
      .then(devices => {
        if (devices && devices.length) {
          setCameras(devices);
          // Preferir câmera traseira em dispositivos móveis
          const backCamera = devices.find(device => 
            device.label.toLowerCase().includes('back') || 
            device.label.toLowerCase().includes('traseira') ||
            device.label.toLowerCase().includes('environment')
          );
          setSelectedCamera(backCamera ? backCamera.id : devices[0].id);
        } else {
          setErrorMsg('Nenhuma câmera encontrada');
        }
      })
      .catch(err => {
        console.error('Erro ao listar câmeras:', err);
        setErrorMsg('Erro ao acessar câmeras. Verifique as permissões.');
      });

    return () => {
      stopScanning();
    };
  }, []);

  const startScanning = async () => {
    if (!selectedCamera) {
      setErrorMsg('Selecione uma câmera');
      return;
    }

    try {
      setIsScanning(true);
      setErrorMsg('');

      html5QrCodeRef.current = new Html5Qrcode('qr-reader');

      const config = {
        fps: 10,
        qrbox: { width: 250, height: 250 },
        aspectRatio: 1.0,
      };

      await html5QrCodeRef.current.start(
        selectedCamera,
        config,
        (decodedText) => {
          // Sucesso na leitura
          console.log('QR Code lido:', decodedText);
          stopScanning();
          onScan(decodedText);
        },
        (errorMessage) => {
          // Erro ao ler (normal durante scanning)
          // console.log('Escaneando...', errorMessage);
        }
      );
    } catch (err) {
      console.error('Erro ao iniciar scanner:', err);
      setErrorMsg('Erro ao iniciar câmera. Verifique as permissões.');
      setIsScanning(false);
      if (onError) onError(err);
    }
  };

  const stopScanning = async () => {
    if (html5QrCodeRef.current && isScanning) {
      try {
        await html5QrCodeRef.current.stop();
        html5QrCodeRef.current.clear();
        html5QrCodeRef.current = null;
      } catch (err) {
        console.error('Erro ao parar scanner:', err);
      }
    }
    setIsScanning(false);
  };

  const handleClose = () => {
    stopScanning();
    if (onClose) onClose();
  };

  return (
    <div className="qr-scanner-container">
      <div className="qr-scanner-content">
        <div className="qr-scanner-header mb-3">
          <h6 className="text-weight-semi-bold mb-2">
            <i className="fas fa-camera mr-2"></i>
            Scanner de QR Code
          </h6>
          <p className="text-down-01 text-gray-60">
            Posicione o QR Code dentro da área marcada
          </p>
        </div>

        {errorMsg && (
          <div className="br-message danger mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
            </div>
            <div className="content">{errorMsg}</div>
          </div>
        )}

        {cameras.length > 1 && !isScanning && (
          <div className="br-input mb-3">
            <label htmlFor="camera-select">Selecionar Câmera</label>
            <select
              id="camera-select"
              className="br-select"
              value={selectedCamera}
              onChange={(e) => setSelectedCamera(e.target.value)}
            >
              {cameras.map((camera) => (
                <option key={camera.id} value={camera.id}>
                  {camera.label || `Câmera ${camera.id}`}
                </option>
              ))}
            </select>
          </div>
        )}

        <div 
          id="qr-reader" 
          ref={scannerRef}
          style={{
            width: '100%',
            maxWidth: '500px',
            margin: '0 auto',
            border: isScanning ? '2px solid var(--primary)' : '2px dashed var(--gray-40)',
            borderRadius: '8px',
            overflow: 'hidden',
            minHeight: isScanning ? 'auto' : '300px',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            backgroundColor: isScanning ? 'transparent' : 'var(--gray-5)'
          }}
        >
          {!isScanning && (
            <div className="text-center p-4">
              <i className="fas fa-qrcode fa-4x text-gray-40 mb-3"></i>
              <p className="text-gray-60">Clique em "Iniciar Scanner" para começar</p>
            </div>
          )}
        </div>

        <div className="d-flex gap-2 justify-content-center mt-3">
          {!isScanning ? (
            <>
              <button
                className="br-button primary"
                onClick={startScanning}
                disabled={!selectedCamera}
              >
                <i className="fas fa-camera mr-2"></i>
                Iniciar Scanner
              </button>
              <button
                className="br-button secondary"
                onClick={handleClose}
              >
                <i className="fas fa-times mr-2"></i>
                Cancelar
              </button>
            </>
          ) : (
            <button
              className="br-button danger"
              onClick={stopScanning}
            >
              <i className="fas fa-stop mr-2"></i>
              Parar Scanner
            </button>
          )}
        </div>

        {isScanning && (
          <div className="br-message info mt-3" role="alert">
            <div className="icon">
              <i className="fas fa-info-circle fa-lg" aria-hidden="true"></i>
            </div>
            <div className="content">
              <strong>Dica:</strong> Mantenha a câmera estável e certifique-se de que o QR Code esteja bem iluminado.
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default QRScanner;
