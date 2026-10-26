/********************* Programa *********************/
/* --------------- Eliminación --------------- */
function EliminarPrograma(id, foto) {
    var id_programa = id;
    var foto_programa = foto;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el programa?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/programa_eliminar.php", {
                id_programa: id_programa,
                foto_programa: foto_programa
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El programa fue eliminado.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El programa sigue registrado",
                icon: "error"
            });
        }
    });
}

function EliminarProgramaPregunta(id_pro_pre, id_pro) {
    var id_programa_pregunta = id_pro_pre;
    var id_programa = id_pro;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar la pregunta?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/programa_pregunta_eliminar.php", {
                id_programa_pregunta: id_programa_pregunta,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "La pregunta fue eliminada.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "programas_preguntas.php?programa=" + id_programa;
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La pregunta sigue registrada",
                icon: "error"
            });
        }
    });
}

function EliminarProgramaCurso(id_pro_cur, id_pro) {
    var id_programa_curso = id_pro_cur;
    var id_programa = id_pro;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el curso del programa?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/programa_curso_eliminar.php", {
                id_programa_curso: id_programa_curso,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El curso fue eliminado del programa.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "programas_cursos.php?programa=" + id_programa;
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El curso sigue registrado",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarPrograma() {
    Swal.fire({
        title: "¿Desea actualizar el programa?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar").submit();
        }
    });
}

function ActualizarProgramaPregunta(id) {
    var id_programa_preguntas = id;
    Swal.fire({
        title: "¿Desea actualizar la pregunta?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar"+id_programa_preguntas).submit();
        }
    });
}

function ActualizarProgramaCurso(id) {
    var id_programa_curso = id;
    Swal.fire({
        title: "¿Desea actualizar el curso?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar"+id_programa_curso).submit();
        }
    });
}

/********************* Membresia *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarMembresia(id, foto) {
    var id_membresia = id;
    var foto_membresia = foto;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar la membresía?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/membresia_eliminar.php", {
                id_membresia: id_membresia,
                foto_membresia: foto_membresia
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminada!",
                        text: "La membresía fue eliminada.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La membresía sigue registrada",
                icon: "error"
            });
        }
    });
}

function EliminarMembresiaPrograma(id_mem_pro, id_mem) {
    var id_membresia_programa = id_mem_pro;
    var id_membresia = id_mem;
    console.log(id_membresia_programa);
    console.log(id_membresia);
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el programa de la membresía?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/membresia_programa_eliminar.php", {
                id_membresia_programa: id_membresia_programa,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El programa fue eliminado de la membresía.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "membresias_programas.php?membresia=" + id_membresia;
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El programa sigue registrado en la membresía",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarMembresia() {
    Swal.fire({
        title: "¿Desea actualizar la membresía?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar").submit();
        }
    });
}

function ActualizarMembresiaPrograma(id) {
    var id_membresia_programa = id;
    Swal.fire({
        title: "¿Desea actualizar el programa de la membresía?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar"+id_membresia_programa).submit();
        }
    });
}

/********************* País *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarPais(id, foto) {
    var id_pais = id;
    var foto_pais = foto;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el país?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/pais_eliminar.php", {
                id_pais: id_pais,
                foto_pais: foto_pais
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El país fue eliminado.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El país sigue registrado",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarPais() {
    Swal.fire({
        title: "¿Desea actualizar el país?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar").submit();
        }
    });
}

/********************* Categoría *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarCategoria(id) {
    var id_categoria = id;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar la categoría?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/categoria_eliminar.php", {
                id_categoria: id_categoria,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminada!",
                        text: "La categoría fue eliminada.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La categoría sigue registrada",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarCategoria() {
    Swal.fire({
        title: "¿Desea actualizar la categoría?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar").submit();
        }
    });
}

/********************* Docente *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarDocente(id, foto) {
    var id_docente = id;
    var foto_docente = foto;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el docente?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/docente_eliminar.php", {
                id_docente: id_docente,
                foto_docente: foto_docente
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El docente fue eliminado.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El docente sigue registrado",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarDocente() {
    Swal.fire({
        title: "¿Desea actualizar el docente?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar").submit();
        }
    });
}

/********************* Administrador *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarAdmin(id, foto) {
    var id_admin = id;
    var foto_admin = foto;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el administrador?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/admin_eliminar.php", {
                id_admin: id_admin,
                foto_admin: foto_admin
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El administrador fue eliminado.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El administrador sigue registrado",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarAdmin() {
    Swal.fire({
        title: "¿Desea actualizar el administrador?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar").submit();
        }
    });
}

/********************* Cursos *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarCurso(id, foto) {
    var id_curso = id;
    var foto_curso = foto;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el curso?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/curso_eliminar.php", {
                id_curso: id_curso,
                foto_curso: foto_curso
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El curso fue eliminado.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El curso sigue registrado",
                icon: "error"
            });
        }
    });
}

function EliminarCursoPregunta(id_cur_pre) {
    var id_curso_pregunta = id_cur_pre;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar la pregunta?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/curso_pregunta_eliminar.php", {
                id_curso_pregunta: id_curso_pregunta,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "La pregunta fue eliminada.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La pregunta sigue registrada",
                icon: "error"
            });
        }
    });
}

function EliminarCursoContenido(id_cur_con, id_cur) {
    var id_curso_contenido = id_cur_con;
    var id_curso = id_cur;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el contenido del curso?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/curso_contenido_eliminar.php", {
                id_curso_contenido: id_curso_contenido,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El contenido fue eliminado del curso.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "modulos.php?curso=" + id_curso;
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El contenido sigue registrado",
                icon: "error"
            });
        }
    });
}

function EliminarCursoContenidoTema(id_cur_con_tem, id_cur) {
    var id_curso_contenido_tema = id_cur_con_tem;
    var id_curso = id_cur;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el tema del curso?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/curso_contenido_tema_eliminar.php", {
                id_curso_contenido_tema: id_curso_contenido_tema,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El tema fue eliminado del curso.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "modulos.php?curso=" + id_curso;
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El tema sigue registrado",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarCurso() {
    Swal.fire({
        title: "¿Desea actualizar el curso?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar").submit();
        }
    });
}

function ActualizarCursoModulo(id) {
    var id_modulo = id;
    Swal.fire({
        title: "¿Desea actualizar el módulo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar"+id_modulo).submit();
        }
    });
}

function ActualizarCursoTema(id) {
    var id_tema = id;
    Swal.fire({
        title: "¿Desea actualizar el tema?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizarTema"+id_tema).submit();
        }
    });
}

function ActualizarCursoPregunta(id) {
    var id_pregunta = id;
    Swal.fire({
        title: "¿Desea actualizar la pregunta?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar"+id_pregunta).submit();
        }
    });
}

/********************* Certificado *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarCertificado(id, foto, alum) {
    var id_certificado = id;
    var certificado = foto;
    var id_alumno = alum;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el certificado?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/certificado_eliminar.php", {
                id_certificado: id_certificado,
                certificado: certificado
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El certificado fue eliminado.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "certificado_alumno.php?alumno=" + id_alumno;
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El certificado sigue registrado",
                icon: "error"
            });
        }
    });
}

/********************* Tipo *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarTipo(id) {
    var id_tipo = id;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el tipo?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/tipo_eliminar.php", {
                id_tipo: id_tipo,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El tipo fue eliminado.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El tipo sigue registrado",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarTipo() {
    Swal.fire({
        title: "¿Desea actualizar el tipo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar").submit();
        }
    });
}

/********************* Nivel *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarNivel(id) {
    var id_nivel = id;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el nivel?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/nivel_eliminar.php", {
                id_nivel: id_nivel,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El nivel fue eliminado.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El nivel sigue registrado",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarNivel() {
    Swal.fire({
        title: "¿Desea actualizar el nivel?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizar").submit();
        }
    });
}

/********************* Horario *********************/
/* --------------- Eliminaciòn --------------- */
function EliminarHorario(id) {
    var id_relacion = id;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-delete"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Seguro de eliminar el horario?",
        text: "¡Luego no podrás cancelar esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("modalActions/horario_eliminar.php", {
                id_relacion: id_relacion,
            },
                function (mensaje) {
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El horario fue eliminado.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "El horario sigue registrado",
                icon: "error"
            });
        }
    });
}

/* --------------- Actualización --------------- */
function ActualizarHorario(id) {
    id_relacion = id;
    Swal.fire({
        title: "¿Desea actualizar el horario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si ¡Actualizar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formActualizarHorario"+id_relacion).submit();
        }
    });
}