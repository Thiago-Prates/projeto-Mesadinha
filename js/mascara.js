function mascara_tel() {
  var tel_formatado = document.getElementById("tel").value
  var tel = document.getElementById("tel").value

  // Limitador
  tel = tel.slice(0, 14)
  document.getElementById("tel").value = tel


  if (tel_formatado[0] != "(") {
    if (tel_formatado[0] != undefined) {
      document.getElementById("tel").value = "(" + tel_formatado[0];
    }
  }

  if (tel_formatado[3] != ")") {
    if (tel_formatado[3] != undefined) {
      document.getElementById("tel").value = tel_formatado.slice(0, 3) + ")" + tel_formatado[3];
    }
  }

  if (tel_formatado[9] != "-") {
    if (tel_formatado[9] != undefined) {
      document.getElementById("tel").value = tel_formatado.slice(0, 9) + "-" + tel_formatado[9];
    }
  }
}

function alerta() {
  Swal.fire({

    icon: 'success',
    title: 'Contas cadastrada com sucesso!',
    showConfirmButton: false,
    timer: 1500
  })
}

