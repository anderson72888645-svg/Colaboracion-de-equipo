const contenedorQR = document.getElementById('contenedorQR');
const formulario = document.getElementById('formulario');
let urlCertificado = formulario.link.value.replace(/ /g, '%20');
let matricula = formulario.matricula.value;
let idalumno = formulario.idalumno.value;

const QR = new QRCode(contenedorQR, {
    width: 365,
    height: 365
});

QR.makeCode(urlCertificado);

const options = {
    dpi: window.devicePixelRatio * 1,
    scale: 1,
};

html2canvas(document.querySelector("#capture"), options).then(canvas => {
    canvas.toBlob(blob => {
        const formData = new FormData();
        formData.append('imagen', blob, `certificado_${matricula}_${idalumno}.jpg`);
        formData.append('matricula', matricula);
        formData.append('idalumno', idalumno);
        formData.append('idcertificado', idcertificado);

        $.ajax({
            type: 'POST',
            url: 'subirCertificadoActualizado.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                const jsonResponse = JSON.parse(response);
                if (jsonResponse.status === 'OK') {
                    window.location.href = jsonResponse.redirectURL;
                } else {
                    alert('Hubo un problema al actualizar el certificado.');
                }
            },
            error: function (error) {
                alert('Hubo un error en la solicitud.');
            }
        });
    }, 'image/jpeg');
});